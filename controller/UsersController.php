<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");
/**
* Class UsersController
*
* Controller to login, logout and user registration
*
*/
class UsersController extends BaseController {

    /**
    * Reference to the UserMapper to interact
    * with the database
    *
    * @var UserMapper
    */
    private $userMapper;
    private $date;
    private $currentDate;

    public function __construct() {
        parent::__construct();
        $this->userMapper = new UserMapper();
        $this->view->setLayout("default");
        $this->date = new DateTime();
        $this->currentDate = $this->date->getTimestamp();
    }

    /**
    * Action to list users
    *
    * Loads all the users from the database.
    * No HTTP parameters are needed.
    *
    */
    public function index() {
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Listing users requires login");
      }

      // obtain the data from the database
      if (isset($_GET["search"])) {
        $search = $_GET["search"];
        $users = $this->userMapper->searchAll($search);
      }else
      {
        $users = $this->userMapper->findAll();
      }


      // put the array containing Article object to the view
      $this->view->setVariable("allusers", $users);

      // render the view (/view/articles/index.php)
      $this->view->render("users", "index");
    }

    /**
    * Action to login
    *
    * Logins a user checking its creedentials agains
    * the database
    *
    * When called via GET, it shows the login form
    * When called via POST, it tries to login
    *
    * The expected HTTP parameters are:
    * <ul>
    * <li>login: The login (via HTTP POST)</li>
    * <li>login: The name (via HTTP POST)</li>
    * <li>passwd: The password (via HTTP POST)</li>
    * <li>login: The email (via HTTP POST)</li>
    * </ul>
    *
    * The views are:
    * <ul>
    * <li>posts/login: If this action is reached via HTTP GET (via include)</li>
    * <li>posts/index: If login succeds (via redirect)</li>
    * <li>users/login: If validation fails (via include). Includes these view variables:</li>
    * <ul>
    *  <li>errors: Array including validation errors</li>
    * </ul>
    * </ul>
    *
    * @return void
    */
    public function login() {
        if (isset($_POST["login"])){ // reaching via HTTP Post...
            //process login form
            if ($this->userMapper->isValidUser($_POST["login"],$_POST["password"])) {
                $_SESSION["currentuser"]=$_POST["login"];
                // send user to the restricted area (HTTP 302 code)
                $this->view->redirect("main", "index");
            } else {
                $errors = array();
                $errors["general"] = "Login is not valid";
                //$this->view->setVariable("errors", $errors);
                $this->view->setVariable("loginerrors", $errors, true);
                $this->view->redirectToReferer();
            }
        }
        // render the view (/view/layouts/default.php)
        $this->view->render("main", "index");
    }
    /**
    * Action to register
    *
    * When called via GET, it shows the register form.
    * When called via POST, it tries to add the user
    * to the database.
    *
    * The expected HTTP parameters are:
    * <ul>
    * <li>login: The login (via HTTP POST)</li>
    * <li>passwd: The password (via HTTP POST)</li>
    * </ul>
    *
    * The views are:
    * <ul>
    * <li>users/register: If this action is reached via HTTP GET (via include)</li>
    * <li>users/login: If login succeds (via redirect)</li>
    * <li>users/register: If validation fails (via include). Includes these view variables:</li>
    * <ul>
    *  <li>user: The current User instance, empty or being added
    *  (but not validated)</li>
    *  <li>errors: Array including validation errors</li>
    * </ul>
    * </ul>
    *
    * @return void
    */
    public function register() {

        $user = new User();

        if (isset($_POST["login"])){ // reaching via HTTP Post...
            // populate the User object with data form the form
            $user->setLogin($_POST["login"]);
            $user->setName($_POST["name"]);
            $user->setPassword($_POST["password"]);
            $user->setEmail($_POST["email"]);
            $user->setUser_type("Deportista");
            try{
                $user->checkIsValidForRegister(); // if it fails, ValidationException

                // check if user exists in the database
                if (!$this->userMapper->loginExists($_POST["login"])){

                  // save the User object into the database
                  $this->userMapper->save($user);
                  $this->view->setFlash("Login ".$user->getLogin()." successfully added. Please login now");
                  $this->view->redirectToReferer();
                } else {
                  $errors = array();
                  $errors["general"] = "Login already exist";
                  //$this->view->setVariable("errors", $errors);
                  $this->view->setVariable("loginerrors", $errors, true);
                  $this->view->redirectToReferer();
                }
            } catch(ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "register" errors variable
                $this->view->setVariable("register", $errors, true);
                $this->view->redirectToReferer();
            }
        }
        // Put the User object visible to the view
        $this->view->setVariable("user", $user);

        // render the view (/view/users/register.php)
        $this->view->render("articles", "index");
    }


    /**
    * Action to edit a user
    */
    public function edit() {
      if (!isset($_REQUEST["login"])) {
        throw new Exception("A user login is mandatory");
      }

      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Editing users requires login");
      }

      // Get the user object from the database
      $userlogin = $_REQUEST["login"];
      $user = $this->userMapper->findById($userlogin);

      // Does the user exist?
      if ($user == NULL) {
        throw new Exception("no such user with login: ".$userlogin);
      }

      if (isset($_POST["submit"])) {

        //load images in server folder
        $dir_load = 'resources/profiles/';

        // populate the user object with data form
        $user->setLogin($_POST["login"]);
        $user->setName($_POST["name"]);
        $user->setEmail($_POST["email"]);
        $user->setDescription($_POST["description"]);
        $user->setPassword($_POST["password"]);
        $user->setSurname($_POST["surname"]);
        $user->setPhone($_POST["phone"]);
        $user->setDni($_POST["dni"]);
        $user->setUser_type($_POST["user_type"]);
        if ($user->getUser_type()==usertype::Athlete){
          $user->setAthlete_type($_POST["athlete_type"]);
        }else{
          $user->setAthlete_type(0);
        }

        // Change image just if the user loads a new image profiles
        if ($_FILES["image"]["name"] != NULL) {
          $file_load = $dir_load . $this->currentDate. "_" . basename($_FILES["image"]["name"]);
          move_uploaded_file($_FILES["image"]["tmp_name"], $file_load);
          $user->setProfileImage($this->currentDate."_".$_FILES["image"]["name"]);
        }

        try {
          // validate User object
          $user->checkIsValidForUpdate(); // if it fails, ValidationException

          // update the User object in the database
          $this->userMapper->update($user);

          $this->view->redirect("users", "profile", "login=".$user->getLogin());

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }
      }
      // Put the User object visible to the view
      $this->view->setVariable("profileUser", $user);

      // render the view (/view/users/edit.php)
      $this->view->render("users", "edit");
    }

    /**
    * Action to delete a user
    *
    * This action should only be called via HTTP POST
    *
    * @throws Exception if no id was provided
    * @throws Exception if no user is in session
    * @throws Exception if there is not any user with the provided id
    * @return void
    */
    public function delete() {
      if (!isset($_REQUEST["login"])) {
        throw new Exception("A user login is mandatory");
      }
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Editing users requires login");
      }
      if ($this->currentUser->getUser_type()!=usertype::Administrator){
        throw new Exception("Not valid user. Editing users requires Administrator");
      }

      // Get the user object from the database
      $userlogin = $_REQUEST["login"];
      $user = $this->userMapper->findById($userlogin);

      // Does the user exist?
      if ($user == NULL) {
        throw new Exception("no such user with login: ".$userlogin);
      }

      // Delete the user object from the database
      $this->userMapper->delete($user);
      $this->view->setFlash(sprintf(i18n("User \"%s\" successfully deleted."),$user->getLogin()));

      $this->view->redirect("users", "index");

    }

    /**
    * Get the current user information
    */
    public function profile() {
      if (!isset($_REQUEST["login"])) {
        throw new Exception("A user login is mandatory");
      }

      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Editing users requires login");
      }


      // Get the user object from the database
      $userlogin = $_REQUEST["login"];
      $user = $this->userMapper->findById($userlogin);

      // Does the user exist?
      if ($user == NULL) {
        throw new Exception("no such user with login: ".$userlogin);
      }
      // Put the User object visible to the view
      $this->view->setVariable("profileUser", $user);

      // render the view (/view/users/profile.php)
      $this->view->render("users", "profile");
    }

    /**
    * Action to logout
    *
    * This action should be called via GET
    *
    * No HTTP parameters are needed.
    *
    * The views are:
    * <ul>
    * <li>users/login (via redirect)</li>
    * </ul>
    *
    * @return void
    */
    public function logout() {
        session_destroy();

        $this->view->redirect("articles", "index");

    }

}

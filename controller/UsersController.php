<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once(__DIR__."/../mail/PHPMailer.php");
require_once(__DIR__."/../mail/Exception.php");
require_once(__DIR__."/../mail/SMTP.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/User_table.php");
require_once(__DIR__."/../model/User_tableMapper.php");
require_once(__DIR__."/../model/Notification.php");
require_once(__DIR__."/../model/Notification_user.php");
require_once(__DIR__."/../model/NotificationMapper.php");
require_once(__DIR__."/../model/Notification_userMapper.php");

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
    private $notificationMapper;
    private $notificationUserMapper;
    private $date;
    private $currentDate;

    public function __construct() {
        parent::__construct();
        $this->userMapper = new UserMapper();
        $this->notificationMapper = new NotificationMapper();
        $this->notificationUserMapper = new Notification_userMapper();
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
      if (isset($_POST["search"])) {
        $search = $_POST["search"];
        $filterby = "all";
        $users = $this->userMapper->searchAll($search);
      }else
      {
          if ($this->currentUser->getUser_type() == usertype::Administrator){
              if (isset($_POST["filterby"])) {
                  $filterby = $_POST['filterby'];
              }else{
                  $filterby = "all";
              }
              if ($filterby =="pending") {
                  $users = $this->userMapper->findPending();
              }elseif ($filterby =="all"){
                  $users = $this->userMapper->findAll();
              }elseif ($filterby == "trainers"){
                  $users = $this->userMapper->findAllTrainers();
              }elseif ($filterby =="athlets"){
                  $users = $this->userMapper->findAllAthlets();
              }

          } else {
              if (isset($_POST["filterby"])) {
                  $filterby = $_POST['filterby'];
              }else{
                  $filterby = "all";
              }
              if ($filterby =="myathlets") {
                  $users = $this->userMapper->findMyAthlets($this->currentUser->getId());
              }elseif ($filterby =="all"){
                  $users = $this->userMapper->findAllAthletsT($this->currentUser->getId());
              }elseif ($filterby=="athletsTDU"){
                  $users = $this->userMapper->findAllAthletsTDU();
              }
          }
      }

      // put the array containing Article object to the view
      $this->view->setVariable("allusers", $users);

      // render the view (/view/articles/index.php)
        if ($this->currentUser->getUser_type() == usertype::Administrator){
            $this->view->setVariable("filterby", $filterby);
            $this->view->render("users", "index");
        } else {
            $this->view->setVariable("filterby", $filterby);
            $this->view->render("users", "index_trainer");
        }
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
            if ($this->userMapper->isValidUser($_POST["login"],md5($_POST["password"]))) {
                $_SESSION["currentuser"]=$_POST["login"];
                // send user to the restricted area (HTTP 302 code)
                $this->view->redirect("main", "index");
            } else {
                $errors = array();
                $errors["general"] = i18n("Login is not valid");
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
            $pass = md5($_POST["password"]);
            $user->setPassword($pass);
            $user->setEmail($_POST["email"]);
            if(isset($_POST["user_type"]) && $_POST["user_type"] != 0){
                $user->setUser_type($_POST["user_type"]);
            }
            if(isset($_POST["surname"])){
                $user->setSurname($_POST["surname"]);
            }
            if( $user->getUser_type() == usertype::AthletePEF) {
                    $trainers = $this->userMapper->findAllTrainers();
                    $trainerfree = new User();
                    $times=500000000000000000000;
                    foreach ($trainers as $trainer) {
                        $t =(int) $this->userMapper->countTimes($trainer);
                        if ($times >= $t) {
                            $trainerfree = $trainer;
                            $times = $t;
                        }

                    }
                    $user->setTrainer($trainerfree->getId());
            }
            try{
                $user->checkIsValidForRegister(); // if it fails, ValidationException

                // check if user exists in the database
                if (!$this->userMapper->loginExists($_POST["login"])){
                    if(!isset($this->currentUser)) {
                        // save the User object into the database
                        $admin = $this->userMapper->findAdmin();
                        $notdate = $this->date->modify( '+1 day' )->format('Y-m-d H:i:s');
                        $this->notificationMapper->save(new Notification(NULL, new User(), $notdate, i18n("Confirm User"),
                            i18n("New user added to the app, please, confirm.")));
                        $not = $this->notificationMapper->findLastId();
                        $this->notificationUserMapper->save(new Notification_user(NULL, $admin, $not, NULL));
                        $this->userMapper->save($user);

                        $this->view->setFlash( i18n("Login") . " ". $user->getLogin() . " " . i18n("successfully added. Please, wait to confirm login."));

                        $this->view->redirectToReferer();
                    } else{
                        $this->userMapper->save($user);
                        /*if($_POST["user_type"] != 0){
                            $mail = new PHPMailer();
                            $mail->isSMTP();
                            $mail->SMTPDebug = 4;
                            $mail->Host = 'tls://smtp.gmail.com';
                            $mail->Port = 587;
                            $mail->SMTPSecure = 'tls';
                            $mail->SMTPAuth = true;
                            $mail->AuthType = 'LOGIN';
                            $mail->Username = 'giraldezcastro@gmail.com';
                            $mail->Password = 'giraldezcastro1';
                            $mail->setFrom('giraldezcastro@gmail.com', 'Admin');
                            $mail->addAddress($user->getEmail(), $user->getLogin());
                            $mail->Subject = 'FitnesSuite. Usuario confirmado.';
                            $mail->Body = $user->getName().', '.$user->getSurname().'. Su usuario '.$user->getLogin().' ha sido confirmado. Ya puede iniciar sesión en la app!.';
                            $mail->AltBody = 'Su usuario ha sido confirmado. Ya puedes iniciar sesión';
                            if (!$mail->send()) {
                                echo "Mailer Error: ";
                            } else {
                                echo "Message sent!";
                                $user->setUser_type($_POST["user_type"]);
                            }
                        }*/
                        $this->view->setFlash(i18n("Login") . " " . $user->getLogin() . " " . i18n("successfully added."));
                        $this->view->redirect("users", "index");
                    }

                } else {
                  $errors = array();
                  $errors["general"] = i18n("Login already exist");
                  //$this->view->setVariable("errors", $errors);
                  $this->view->setVariable("loginerrors", $errors, true);
                    $this->view->setVariable("user", $user);
                    if(!isset($this->currentUser)) {
                        $this->view->redirectToReferer();
                    }
                }
            } catch(ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "register" errors variable
                if(isset($this->currentUser)) {
                    $this->view->setVariable("errors", $errors, true);
                }
                $this->view->setVariable("user", $user);
                if(!isset($this->currentUser)) {
                    $this->view->setVariable("loginerrors", $errors, true);
                    $this->view->redirectToReferer();
                }
            }
        }
        $this->view->setVariable("trainers",$this->userMapper->findAllTrainers());
        // Put the User object visible to the view
        $this->view->setVariable("user", $user);
        if(isset($this->currentUser)) {
            $this->view->render("users", "add");
        }
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
        if($_POST["password"] != $user->getPassword()) {
            $pass = md5($_POST["password"]);
            $user->setPassword($pass);
        }
        $user->setSurname($_POST["surname"]);
        $user->setPhone((int)$_POST["phone"]);
        $user->setDni($_POST["dni"]);
        $user->setTrainer($_POST["trainer"]);
        if($user->getUser_type() != $_POST["user_type"] && $user->getUser_type() == null){
            /*$mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = 4;
            $mail->Host = 'tls://smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->AuthType = 'LOGIN';
            $mail->Username = 'giraldezcastro@gmail.com';
            $mail->Password = 'giraldezcastro1';
            $mail->setFrom('giraldezcastro@gmail.com', 'Admin');
            $mail->addAddress($user->getEmail(), $user->getLogin());
            $mail->Subject = 'FitnesSuite. Usuario confirmado.';
            $mail->Body = $user->getName().', '.$user->getSurname().'. Su usuario '.$user->getLogin().' ha sido confirmado. Ya puede iniciar sesión en la app!.';
            $mail->AltBody = 'Su usuario ha sido confirmado. Ya puedes iniciar sesión';
            if (!$mail->send()) {
                echo "Mailer Error: ";
            } else {
                echo "Message sent!";

            }*/
        }
          $user->setUser_type($_POST["user_type"]);



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
        $this->view->setVariable("trainers",$this->userMapper->findAllTrainers());
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
      $this->view->setFlash(sprintf(i18n("User") . " " . i18n("successfully deleted."),$user->getLogin()));

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

        $this->view->redirect("main", "index");

    }

}

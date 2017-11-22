<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Session.php");
require_once(__DIR__."/../model/SessionMapper.php");

require_once(__DIR__."/../model/User_table.php");
require_once(__DIR__."/../model/User_tableMapper.php");

require_once(__DIR__."/../model/Workout_table.php");

require_once(__DIR__."/../controller/BaseController.php");
/**
* Class SessionController
*
* Controller to make a CRUD for public Sessions
*
*/
class SessionsController extends BaseController {

    /**
    * Reference to the sessionMapper to interact
    * with the database
    *
    * @var Session
    */
    private $sessionMapper;
    private $user_tableMapper;
    private $date;
    private $currentDate;

    public function __construct() {
        parent::__construct();
        $this->sessionMapper = new SessionMapper();
        $this->user_tableMapper = new User_tableMapper();
        $this->view->setLayout("default");
        $this->date = new DateTime();
        $this->currentDate = $this->date->getTimestamp();
    }

    /**
    * Action to list public infos
    *
    * Loads all the public info from the database.
    * No HTTP parameters are needed.
    *
    */
    public function index() {
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Listing sessions requires login");
      }
      /*
      // To enable Search input in public info
      // obtain the data from the database
      if (isset($_GET["search"])) {
        $search = $_GET["search"];
        $public_infos = $this->public_infoMapper->searchAll($search);
      }else
      {
        $public_infos = $this->public_infoMapper->findAll();
      }
      */
      $sessions = $this->sessionMapper->searchAll($this->currentUser->getId());
      // put the array containing session objects to the view
      $this->view->setVariable("sessions", $sessions);

      // render the view (/view/sessions/index.php)
      $this->view->render("sessions", "index");
    }

    /**
    * Action to edit a session
    */
    public function edit() {
      if (!isset($_REQUEST["id"])) {
        throw new Exception("A session_id is mandatory");
      }

      // Get the user object from the database
      $id_session = $_REQUEST["id"];
      $session = $this->sessionMapper->findById($id_session);

      // Does the session exist?
      if ($session == NULL) {
        throw new Exception("no such session with id: ".$id_session);
      }

      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Editing session requires login");
      }

      if ($this->currentUser->getId() != $session->getUser()->getId()) {
        throw new Exception("Not in session. Editing session requires author");
      }

      // Get the user_table objects from the database
      $user_tables = $this->user_tableMapper->searchAll($this->currentUser->getId());

      if (isset($_POST["submit"])) {

        // populate the session object with data form
        $session->setId($_POST["id"]);
        $session->setUser($this->currentUser);

        $id_user_table = $_POST["user_table"];

        $user_table = $this->user_tableMapper->findById($id_user_table);
        //$user_table = $this->user_tableMapper->findByUserAndTable($this->currentUser->getId(),$id_workout_table);
        $session->setUser_table($user_table);
        $session->setDate($_POST["date"]);
        $session->setDuration($_POST["duration"]);
        $session->setComment($_POST["comment"]);

        try {
          // validate public info object
          $session->checkIsValidForUpdate(); // if it fails, ValidationException

          // update the public info object in the database
          $this->sessionMapper->update($session);

          $this->view->redirect("sessions", "index");

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }
      }
      // Put the session object visible to the view
      $this->view->setVariable("session", $session);
      $this->view->setVariable("user_tables", $user_tables);

      // render the view (/view/public_info/edit.php)
      $this->view->render("sessions", "edit");
    }


    /**
    * Action to delete a session
    *
    * This action should only be called via HTTP POST
    *
    * The expected HTTP parameters are:
    * <ul>
    * <li>id: Id of the session (via HTTP POST)</li>
    * </ul>
    *
    * The views are:
    * <ul>
    * <li>posts/index: If session was successfully deleted (via redirect)</li>
    * </ul>
    * @throws Exception if no id was provided
    * @throws Exception if no user is in session
    * @throws Exception if there is not any session with the provided id
    * @throws Exception if the author of the session to be deleted is not the current user
    * @return void
    */
    public function delete() {
      if (!isset($_REQUEST["id"])) {
        throw new Exception("id_session is mandatory");
      }
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Deleting session requires login");
      }

      // Get the id_session object from the database
      $id_session = $_REQUEST["id"];
      $session = $this->sessionMapper->findById($id_session);

      // Does the session exist?
      if ($session == NULL) {
        throw new Exception("no such session with id: ".$id_session);
      }

      // Check if the the currentUser (in Session) is the user author
      if ($this->currentUser->getId() != $session->getUser()->getId()) {
        throw new Exception("Not in session. Deleting session requires to be user author");
      }

      // Delete the session object from the database
      $this->sessionMapper->delete($session);

      // POST-REDIRECT-GET
      // Everything OK, we will redirect the user to the list of artcles

      // perform the redirection. More or less:
      // header("Location: index.php?controller=sessions&action=index")
      // die();
      $this->view->redirect("sessions", "index");

    }

    /**
    * Action to add a new session
    *
    * When called via GET, it shows the add form
    * When called via POST, it adds the session to the
    * database
    *
    * The expected HTTP parameters are:
    * <ul>
    * <li>title: Title of the session (via HTTP POST)</li>
    * <li>content: Content of the session (via HTTP POST)</li>
    * </ul>
    *
    * The views are:
    * <ul>
    * <li>sessions/add: If this action is reached via HTTP GET (via include)</li>
    * <li>sessions/index: If session was successfully added (via redirect)</li>
    * <li>sessions/add: If validation fails (via include). Includes these view variables:</li>
    * <ul>
    *  <li>session: The current session instance, empty or
    *  being added (but not validated)</li>
    *  <li>errors: Array including per-field validation errors</li>
    * </ul>
    * </ul>
    * @throws Exception if no user is in session
    * @return void
    */
    public function start() {
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Adding sessions requires login");
      }

      if(isset($_REQUEST["id_user_table"])){
          $id_user_table = $_REQUEST["id_user_table"];

          $user_table = $this->user_tableMapper->findById($id_user_table);

      }
      $user_tables = $this->user_tableMapper->searchAll($this->currentUser->getId());

      // Put the Session object visible to the view
      $this->view->setVariable("user_table", $user_table);
      $this->view->setVariable("user_tables", $user_tables);

      // render the view (/view/sessions/add.php)
      $this->view->render("sessions", "start");

    }

    /**
    * Action to add a new session
    *
    * When called via GET, it shows the add form
    * When called via POST, it adds the session to the
    * database
    *
    * The expected HTTP parameters are:
    * <ul>
    * <li>title: Title of the session (via HTTP POST)</li>
    * <li>content: Content of the session (via HTTP POST)</li>
    * </ul>
    *
    * The views are:
    * <ul>
    * <li>sessions/add: If this action is reached via HTTP GET (via include)</li>
    * <li>sessions/index: If session was successfully added (via redirect)</li>
    * <li>sessions/add: If validation fails (via include). Includes these view variables:</li>
    * <ul>
    *  <li>session: The current session instance, empty or
    *  being added (but not validated)</li>
    *  <li>errors: Array including per-field validation errors</li>
    * </ul>
    * </ul>
    * @throws Exception if no user is in session
    * @return void
    */
    public function add() {
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Adding sessions requires login");
      }

      $session = new Session();
      // Get the user_table objects from the database
      $user_tables = $this->user_tableMapper->searchAll($this->currentUser->getId());

      // populate the session object with data form the form
      $date_now = $_POST["date_now"];
      $duration = $_POST["duration"];
      $duration = new DateTime($duration);
      $duration = $duration->format("H:i:s");
      $session->setUser($this->currentUser);
      $id_user_table = $_POST["user_table"];
      $user_table = $this->user_tableMapper->findById($id_user_table);
      $session->setUser_table($user_table);
      $session->setDate($date_now);
      $session->setDuration($duration);
      if (isset($_POST["submit"])) { // reaching via HTTP Post...
        try {
          $date_now = $_POST["date"];
          $duration = $_POST["duration"];
          $comment = $_POST["comment"];
          $session->setUser($this->currentUser);
          $id_user_table = $_POST["user_table"];
          $user_table = $this->user_tableMapper->findById($id_user_table);
          $session->setUser_table($user_table);
          $session->setDate($date_now);
          $session->setDuration($duration);
          $session->setComment($comment);
          // validate session object
          $session->checkIsValidForCreate(); // if it fails, ValidationException


          // save the session object into the database
          $this->sessionMapper->save($session);
          // POST-REDIRECT-GET
          // Everything OK, we will redirect the user to the list of sessions

          // perform the redirection. More or less:
          // header("Location: index.php?controller=sessions&action=index")
          // die();
          $this->view->redirect("sessions", "index");

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }
    }
      // Put the Article object visible to the view
      $this->view->setVariable("session", $session);
      $this->view->setVariable("user_tables", $user_tables);
      // render the view (/view/activity_schedules/add.php)
      $this->view->render("sessions", "add");
    }
  }

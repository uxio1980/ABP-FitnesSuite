<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Notification.php");
require_once(__DIR__."/../model/Notification_user.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/NotificationMapper.php");
require_once(__DIR__."/../model/Notification_userMapper.php");
require_once(__DIR__."/../controller/BaseController.php");
/**
* Class NotificationController
*
* Controller to make a CRUD for Notification
*
*/
class NotificationController extends BaseController {

    /**
    * Reference to the NotificationMapper to interact
    * with the database
    *
    * @var Notification
    */
    private $userMapper;
    private $notificationMapper;
    private $notification_userMapper;
    private $date;
    private $currentDate;
    private $temporalUsers;

    public function __construct() {
        parent::__construct();
        $this->userMapper = new UserMapper();
        $this->notificationMapper = new NotificationMapper();
        $this->notification_userMapper = new Notification_userMapper();
        $this->view->setLayout("default");
        $this->date = new DateTime();
        $this->currentDate = $this->date->getTimestamp();
    }

    /**
    * Action to list Notifications
    *
    * Loads all the Notification from the database.
    * No HTTP parameters are needed.
    *
    */
    public function index() {

      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Listing notifications requires login");
      }

      if ($this->currentUser->getUser_type() != usertype::Administrator && $this->currentUser->getUser_type() != usertype::Trainer) {
        throw new Exception("Listing notifications requires Administrator or trainer user");
      }

      /*
      // To enable Search input in notification
      // obtain the data from the database
      if (isset($_GET["search"])) {
        $search = $_GET["search"];
        $public_infos = $this->public_infoMapper->searchAll($search);
      }else
      {
        $public_infos = $this->public_infoMapper->findAll();
      }
      */
      //$public_info = $this->public_infoMapper->findById(0); //Solo tendrá la tupla con id = 0

      if (isset($_POST["filterby"])) {
        $filterby = $_POST['filterby'];
      }else{
        $filterby = "active";
      }
      if ($filterby =="active") {
          $notifications = $this->notificationMapper->findAllActives();
      }elseif ($filterby =="lapsed"){
          $notifications = $this->notificationMapper->findAllLapsed();
      }else{
          $notifications = $this->notificationMapper->findAll();
      }

      if($notifications != NULL){
        foreach ($notifications as $notification) {
          //var_dump($notification->getId());
          $count = $this->notification_userMapper->countAllByNotification($notification);
          $notification->setReceivers($count);
        }
      }
      //foreach ($notifications as $notification) {
        //$count = $this->notification_userMapper->countAllByNotification();
        //$notification->setReceivers($count);
      //}
      // put the array containing notification object to the view
      $this->view->setVariable("filterby", $filterby);
      $this->view->setVariable("notifications", $notifications);

      // render the view (/view/notification/index.php)
      $this->view->render("notifications", "index");
    }

    /**
    * Action to edit a notification
    */
    public function edit() {
      if (!isset($_REQUEST["id_notification"])) {
        throw new Exception("A id_notification is mandatory");
      }

      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Editing notification requires login");
      }

      // Get the notification object from the database
      $id_notification = $_REQUEST["id_notification"];
      $notification = $this->notificationMapper->findById($id_notification);
      // Does the notification exist?
      if ($notification == NULL) {
        throw new Exception("no such notification with id: ".$id_notification);
      }
      $notification_users = $this->notification_userMapper->findAllByNotification($notification);
      $users = $this->userMapper->findAll();

      if (isset($_POST["submit"])) {

        // populate the notification object with data form
        $notification->setId($id_notification);
        $notification->setDate($_POST["date"]);
        $notification->setTitle($_POST["title"]);
        $notification->setContent($_POST["content"]);

        try {
          // validate notification object
          $notification->checkIsValidForUpdate(); // if it fails, ValidationException

          // update the notification object in the database
          $this->notificationMapper->update($notification);

          $this->view->redirect("notification", "index");

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }
      }
      // Put the notification object visible to the view
      $this->view->setVariable("edit_notification", $notification);
      $this->view->setVariable("notification_users",$notification_users);
      $this->view->setVariable("users",$users);
      // render the view (/view/notifications/edit.php)
      $this->view->render("notifications", "edit");
    }

    public function view(){
      if (!isset($_GET["id_notification"])) {
        throw new Exception("id notification is mandatory");
      }

      $id_notification = $_GET["id_notification"];

      // Recuperar notificacion según su id.
      $notification = $this->notificationMapper->findById($id_notification);

      if ($notification == NULL) {
        throw new Exception("->no such notification with id: ".$id_notification);
      }
      $notification_users = $this->notification_userMapper->findAllByNotification($notification);
      // put the notification object to the view
      $this->view->setVariable("view_notification", $notification);
      $this->view->setVariable("notification_users",$notification_users);

      // render the view (/view/notifications/view.php)
        $this->view->render("notifications", "view");

    }

    /**
    * Action to delete a notification
    *
    * This action should only be called via HTTP POST
    *
    * The expected HTTP parameters are:
    * <ul>
    * <li>id: Id of the notification (via HTTP POST)</li>
    * </ul>
    *
    * The views are:
    * <ul>
    * <li>posts/index: If notification was successfully deleted (via redirect)</li>
    * </ul>
    * @throws Exception if no id was provided
    * @throws Exception if no user is in session
    * @throws Exception if there is not any notification with the provided id
    * @throws Exception if the author of the notification to be deleted is not the current user
    * @return void
    */
    public function delete() {
      if (!isset($_REQUEST["id_notification"])) {
        throw new Exception("id_notification is mandatory");
      }
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Deleting notification requires login");
      }

      // Get the id_notification object from the database
      $id_notification = $_REQUEST["id_notification"];
      $notification = $this->notificationMapper->findById($id_notification);

      // Does the notification exist?
      if ($notification == NULL) {
        throw new Exception("no such notification with id: ".$id_notification);
      }

      // Delete the notification object from the database
      $this->notificationMapper->delete($notification);

      // POST-REDIRECT-GET
      // Everything OK, we will redirect the user to the list of artcles

      // perform the redirection. More or less:
      // header("Location: index.php?controller=notifications&action=index")
      // die();
      $this->view->redirect("notification", "index");

    }

    /**
    * Action to add a new notification
    *
    * When called via GET, it shows the add form
    * When called via POST, it adds the notification to the
    * database
    *
    * The expected HTTP parameters are:
    * <ul>
    * <li>title: Title of the notification (via HTTP POST)</li>
    * <li>content: Content of the post (via HTTP POST)</li>
    * </ul>
    *
    * The views are:
    * <ul>
    * <li>posts/add: If this action is reached via HTTP GET (via include)</li>
    * <li>posts/index: If post was successfully added (via redirect)</li>
    * <li>posts/add: If validation fails (via include). Includes these view variables:</li>
    * <ul>
    *  <li>post: The current Post instance, empty or
    *  being added (but not validated)</li>
    *  <li>errors: Array including per-field validation errors</li>
    * </ul>
    * </ul>
    * @throws Exception if no user is in session
    * @return void
    */
    public function add() {
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Adding notifications requires login");
      }
      $users = $this->userMapper->findAll();
      $notification = new Notification();
      if (isset($_SESSION['temporalUsers'])){
        $this->temporalUsers = unserialize($_SESSION['temporalUsers']);
      }
      if (isset($_SESSION['NotificationValues'])){
        //var_dump($_SESSION['NotificationValues']);
        //$notification_values = $_SESSION['NotificationValues'];
        //var_dump($notification_values);
        /*$notification->setDate($notification_values["ndate"]);
        $notification->setTitle($notification_values["bar"]);
        $notification->setContent($notification_values["foo"]);*/
      }
      if (isset($_POST["submit"])) { // reaching via HTTP Post...

        // populate the notification object with data form the form
        $notification->setUser_author($this->currentUser);
        $notification->setTitle($_POST["title"]);
        $notification->setDate($_POST["date"]);
        $notification->setContent($_POST["content"]);

        try {
          // validate notification object
          $notification->checkIsValidForCreate(); // if it fails, ValidationException

          // save the notification object into the database
          $this->notificationMapper->save($notification);
          $lastNotification = $this->notificationMapper->findLastNotification();
          if (isset($_SESSION['temporalUsers'])){
            foreach ($this->temporalUsers as $user_forAdd){
              $notification_user = new Notification_user();
              // populate the notification_user object with data form the form
              $notification_user->setNotification($lastNotification);
              $notification_user->setUser_receiver($user_forAdd);
              $check_notification_user = $this->notification_userMapper->findByUserAndNotification($user_forAdd, $lastNotification);
              if($check_notification_user == NULL){
                $this->notification_userMapper->save($notification_user);
              }
            }
          }
          // POST-REDIRECT-GET
          // Everything OK, we will redirect the user to the list of notifications

          // perform the redirection. More or less:
          // header("Location: index.php?controller=notifications&action=index")
          // die();
          $this->view->redirect("notification", "index");

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }
      }

      // Put the notification object visible to the view
      $this->view->setVariable("add_notification", $notification);
      $this->view->setVariable("users", $users);
      $this->view->setVariable("notification_users", $this->temporalUsers);

      // render the view (/view/notifications/add.php)
        $this->view->render("notifications", "add");

    }

}

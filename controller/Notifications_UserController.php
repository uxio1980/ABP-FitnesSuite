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
class Notifications_UserController extends BaseController {

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
    * Action to list Notifications for current user
    *
    * Loads all the Notification for current user from the database.
    * No HTTP parameters are needed.
    *
    */
    public function index() {

      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Listing notifications for current user requires login");
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
          $notifications_user = $this->notification_userMapper->findAllActivesByUser($this->currentUser);
      }elseif ($filterby =="lapsed"){
          $notifications_user = $this->notification_userMapper->findAllLapsedByUser($this->currentUser);
      }else{
          $notifications_user = $this->notification_userMapper->findAllByUser($this->currentUser);
      }

      /*if($notifications_user != NULL){
        foreach ($notifications_user as $notification) {
          $count = $this->notification_userMapper->countAllByNotification($notification);
          $notification->setReceivers($count);
        }
      }*/
      // put the array containing notification object to the view
      $this->view->setVariable("filterby", $filterby);
      $this->view->setVariable("notifications", $notifications_user);

      // render the view (/view/public_info/index.php)
      $this->view->render("notifications_user", "index");
    }

    public function view(){

      if (!isset($_GET["id_notification_user"])) {
        throw new Exception("id notification_user is mandatory");
      }

      $id_notification_user = $_GET["id_notification_user"];

      // Recuperar notificacion según su id.
      $notification_user = $this->notification_userMapper->findById($id_notification_user);

      if ($notification_user == NULL) {
        throw new Exception("->no such notification_user with id: ".$id_notification_user);
      }

      // put the notification object to the view
      $this->view->setVariable("view_notification_user", $notification_user);
      //$this->view->setVariable("currentUser",$this->currentUser);

      // render the view (/view/notifications/view.php)
        $this->view->render("notifications_user", "view");

    }

    public function markAsRead(){
      if (!isset($_POST["id_notification_user"])) {
        if (!isset($_REQUEST["id_notification_user"])) {
          throw new Exception("id_notification_user is mandatory");
        }
      }
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Deleting notification_user requires login");
      }

      // Get the id_notification object from the database
      if (!isset($_POST["id_notification_user"])) {
        $id_notification_user = $_REQUEST["id_notification_user"];
      }else{
        $id_notification_user = $_POST["id_notification_user"];
      }
      $notification_user = $this->notification_userMapper->findById($id_notification_user);

      // Does the notification exist?
      if ($notification_user == NULL) {
        throw new Exception("no such notification_user with id: ".$id_notification_user);
      }

      //if (isset($_POST["submit"])) {
        try {
          $currentDate = date_create(date("Y-m-d"));
            date_time_set($currentDate, date("H")+1, date("i"));
            $currentDate = date_format($currentDate,"Y-m-d\TH:i");


          $notification_user->setViewed($currentDate);
          $notification_user->checkIsValidForUpdate(); // if it fails, ValidationException


          // save the session object into the database
          $this->notification_userMapper->updateAsRead($notification_user);
          // POST-REDIRECT-GET
          // Everything OK, we will redirect the user to the list of sessions

          // perform the redirection. More or less:
          // header("Location: index.php?controller=notifications_user&action=index")
          // die();
          $this->view->redirect("notifications_user", "index");

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }
      //}
        //$this->view->render("notifications_user", "view");
    }

    public function markAsUnread(){
      if (!isset($_POST["id_notification_user"])) {
        if (!isset($_REQUEST["id_notification_user"])) {
          throw new Exception("id_notification_user is mandatory");
        }
      }
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Deleting notification_user requires login");
      }

      // Get the id_notification object from the database
      if (!isset($_POST["id_notification_user"])) {
        $id_notification_user = $_REQUEST["id_notification_user"];
      }else{
        $id_notification_user = $_POST["id_notification_user"];
      }
      $notification_user = $this->notification_userMapper->findById($id_notification_user);

      // Does the notification exist?
      if ($notification_user == NULL) {
        throw new Exception("no such notification_user with id: ".$id_notification_user);
      }

      //if (isset($_POST["submit"])) {
        try {
          $currentDate = NULL;


          $notification_user->setViewed($currentDate);
          $notification_user->checkIsValidForUpdate(); // if it fails, ValidationException


          // save the session object into the database
          $this->notification_userMapper->updateAsRead($notification_user);
          // POST-REDIRECT-GET
          // Everything OK, we will redirect the user to the list of sessions

          // perform the redirection. More or less:
          // header("Location: index.php?controller=notifications_user&action=index")
          // die();
          $this->view->redirect("notifications_user", "index");

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }
    }

    public function delete() {
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. delete notifications_user requires login");
        }
        if ($this->currentUser->getUser_type()!=usertype::Administrator &&
            $this->currentUser->getUser_type()!=usertype::Trainer ){
            throw new Exception("Not valid user. Editing exercise requires Administrator or Trainer");
        }

        // Get the exercise object from the database
        if (!isset($_REQUEST["id_notification_user"])) {
            throw new Exception("Delete notifications_user requires id");
        }
        $id_notification_user = $_REQUEST["id_notification_user"];
        $notification_user = $this->notification_userMapper->findById($id_notification_user);

        // Does the exercise exist?
        if ($notification_user == NULL) {
            throw new Exception("no such notification_user with id: ".$id_notification_user);
        }

        // Delete the notification_user object from the database
        $this->notification_userMapper->delete($notification_user);

        $this->view->setFlash(sprintf(i18n("notification user  \"%s\" with name \"%s\" successfully deleted."),
                                            $notification_user->getId(),$notification_user->getUser_receiver()->getName()));

        $this->view->redirect("notification", "edit", "id_notification= " . $notification_user->getNotification()->getId());

    }

    /**
    * Action to add a new notification_user
    *
    * When called via GET, it shows the add form
    * When called via POST, it adds the notification_user to the
    * database
    *
    * The expected HTTP parameters are:
    * <ul>
    * <li>title: Title of the notification_user (via HTTP POST)</li>
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
    public function updateusers() {
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. update notification_users requires login");
      }

      if (!isset($_REQUEST["id_notification"])) {
          throw new Exception("Add notifications_user requires notification_id");
      }

        // Get the notification object from the database
        $id_notification = $_POST["id_notification"];
        $notification = $this->notificationMapper->findById($id_notification);
        // Does the notification exist?
        if ($notification == NULL) {
          throw new Exception("no such notification with id: ".$id_notification);
        }
        $this->notification_userMapper->deleteUsersByNotification($notification);

        $idusercheckboxes = $_POST['checkbox'];
        foreach ($idusercheckboxes as $user_checked){
          $notification_user = new Notification_user();
          // populate the notification_user object with data form the form
          $notification_user->setNotification($notification);
          $userChecked = $this->userMapper->findById2($user_checked);
          $notification_user->setUser_receiver($userChecked);
          $check_notification_user = $this->notification_userMapper->findByUserAndNotification($userChecked, $notification);
          if($check_notification_user == NULL){
            $this->notification_userMapper->save($notification_user);
          }
        }

        try {
          // validate notification_user object
          //$notification_user->checkIsValidForCreate(); // if it fails, ValidationException
          // save the notification_user object into the database
          //$this->notification_userMapper->save($notification_user);

          // POST-REDIRECT-GET
          // Everything OK, we will redirect the user to the list of posts

          // perform the redirection. More or less:
          // header("Location: index.php?controller=notification_users&action=index")
          // die();
          //$this->view->redirect("notifications_user", "index");

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }



      // render the view (/view/notification_users/add.php)
      if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
        //$this->view->render("notifications_user", "add");
      }
      $this->view->redirectToReferer();
    }

}

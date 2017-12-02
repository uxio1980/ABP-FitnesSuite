<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Notification.php");
require_once(__DIR__."/../model/Notification_user.php");
require_once(__DIR__."/../model/User.php");
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
    private $notificationMapper;
    private $notification_userMapper;
    private $date;
    private $currentDate;

    public function __construct() {
        parent::__construct();
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

      // render the view (/view/public_info/index.php)
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

      // put the notification object to the view
      $this->view->setVariable("view_notification", $notification);

      // render the view (/view/notifications/view.php)
        $this->view->render("notifications", "view");

    }
}

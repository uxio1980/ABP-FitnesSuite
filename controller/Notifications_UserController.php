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
class Notifications_UserController extends BaseController {

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
        throw new Exception("id_notification_user is mandatory");
      }
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Deleting notification_user requires login");
      }

      // Get the id_notification object from the database
      $id_notification_user = $_POST["id_notification_user"];
      $notification_user = $this->notification_userMapper->findById($id_notification_user);

      // Does the notification exist?
      if ($notification_user == NULL) {
        throw new Exception("no such notification_user with id: ".$id_notification_user);
      }

      if (isset($_POST["submit"])) {
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
          // header("Location: index.php?controller=sessions&action=index")
          // die();
          $this->view->redirect("main", "index");

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }
      }
      // Delete the notification object from the database
      //$this->notificationMapper->delete($notification);

        $this->view->render("notifications_user", "view");
    }
}

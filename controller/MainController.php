<?php
//file: controller/MainController.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

require_once(__DIR__."/../model/Public_info.php");
require_once(__DIR__."/../model/Public_infoMapper.php");

require_once(__DIR__."/../model/Notification_user.php");
require_once(__DIR__."/../model/Notification_userMapper.php");

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../model/Activity_schedule.php");
require_once(__DIR__."/../model/Activity_scheduleMapper.php");

/**
* Class MainController
*
* Controller to make a CRUDL of Main entities
*
* @author lipido <lipido@gmail.com>
*/
class MainController extends BaseController {

  private $public_infoMapper;
  private $activityMapper;
  private $activity_schedule;
  private $userMapper;
  private $date;
  private $currentDate;

  public function __construct() {
    parent::__construct();
    $this->public_infoMapper = new Public_infoMapper();
    $this->activityMapper = new ActivityMapper();
    $this->activity_scheduleMapper = new Activity_scheduleMapper();
    $this->userMapper = new UserMapper();
    $this->date = new DateTime();
    $this->currentDate = $this->date->getTimestamp();
  }


  /**
  * Action to show index page
  *
  * Loads all the activities from the database.
  * No HTTP parameters are needed.
  *
  */
  public function index() {
    // obtain the data from the database
    /*  if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $articles = $this->articleMapper->searchAll($search);
  }else
  {
  $articles = $this->articleMapper->findAll();
}

*/
// put the array containing Activities object to the view
$activities = $this->activityMapper->findAll();
$this->view->setVariable("activities", $activities);

$next_events = $this->activity_scheduleMapper->search2NextEvents();
$trainers = $this->userMapper->findAllTrainers();
$this->view->setVariable("trainers", $trainers);

$this->view->setVariable("next_events", $next_events);


// render the view (/view/main/index.php)
$this->view->render("main", "index");
}
/**
* Action to list prices
*
* Loads all the prices.
* No HTTP parameters are needed.
*
*/
public function aboutus() {

  // render the view (/view/main/pricing.php)
  $this->view->render("main", "aboutus");
}

/**
* Action to list prices
*
* Loads all the prices.
* No HTTP parameters are needed.
*
*/
public function pricing() {

  $public_info = $this->public_infoMapper->findFirst(); //Solo tendrá la tupla con id = 0
  // put the array containing public info object to the view
  $this->view->setVariable("public_info", $public_info);
  // render the view (/view/main/pricing.php)
  $this->view->render("main", "pricing");
}

/**
* Action to show the contact page
*
*
* No HTTP parameters are needed.
*
*/
public function contact() {
  $public_info = $this->public_infoMapper->findFirst(); //Solo tendrá la tupla con id = 0
  // put the array containing public info object to the view
  $this->view->setVariable("public_info", $public_info);
  // render the view (/view/main/contact.php)
  $this->view->render("main", "contact");
}

/**
* Action to sending a mail
*
*
*
*/
public function sendmail() {

  if (isset($_POST["submit"])) {
    $public_info = $this->public_infoMapper->findFirst();

    // populate the mail data
    $name = $_POST["name"];
    $from = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    try {
      $headers = "From: " . $from ;
      $to = $public_info->getEmail();

      $bool = mail($to,$subject,$message,$headers);

      if($bool){
        $this->view->setFlash(sprintf(i18n("Mail successfully sended.")));
        $this->view->redirect("main", "contact");
      } else {
        $this->view->setFlash(sprintf(i18n("Error sending mail.")));
        $this->view->redirect("main", "contact");
      }
    }catch(Exception $ex) {
      throw new Exception("Error sending mail");
      // Get the errors array inside the exepction...
      $errors = $ex->getErrors();
      // And put it to the view as "errors" variable
      $this->view->setVariable("errors", $errors);
    }
  }
}
}

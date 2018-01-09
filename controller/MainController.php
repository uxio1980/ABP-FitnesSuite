<?php
//file: controller/MainController.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once(__DIR__."/../mail/PHPMailer.php");
require_once(__DIR__."/../mail/Exception.php");
require_once(__DIR__."/../mail/SMTP.php");

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
    if (isset($_POST["search"])) {
        $search = $_POST["search"];
        $activities = $this->activityMapper->searchAll($search);
    }else{
        $activities = $this->activityMapper->findAll();
    }


// put the array containing Activities object to the view

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
      /*$headers = "From: " . $from ;
      $to = $public_info->getEmail();

      $bool = mail($to,$subject,$message,$headers);

      if($bool){
        $this->view->setFlash(sprintf(i18n("Mail successfully sended.")));
        $this->view->redirect("main", "contact");
      } else {
        $this->view->setFlash(sprintf(i18n("Error sending mail.")));
        $this->view->redirect("main", "contact");
      }*/

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
        $mail->addAddress('sandracangas@gmail.com', 'Admin');
        if ($mail->addReplyTo($from, $name)) {
            $mail->Subject = 'PHPMailer contact form';
            //Keep it simple - don't use HTML
            $mail->isHTML(false);
            //Build a simple message body
            $mail->Body = <<<EOT
Email: {$from}
Name: {$name}
Message: {$message}
EOT;
        }
        $mail->Subject = $subject;
        $mail->AltBody = $message;
        if (!$mail->send()) {
            echo "Mailer Error: " ;
        } else {
            echo "Message sent!";
        }

        $this->view->redirect("main", "contact");

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

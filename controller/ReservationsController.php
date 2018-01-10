<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/Activity_schedule.php");
require_once(__DIR__."/../model/Activity_scheduleMapper.php");

require_once(__DIR__."/../controller/BaseController.php");
/**
* Class reservation_Controller
*
* Controller to make a CRUD for Schedule
*
*/
class ReservationsController extends BaseController {

    /**
    * Reference to the Reservations to interact
    * with the database
    *
    * @var Reservations
    */
    private $activityMapper;
    private $activity_scheduleMapper;
    private $date;
    private $currentDate;

    public function __construct() {
        parent::__construct();
        $this->activityMapper = new ActivityMapper();
        $this->activity_scheduleMapper = new Activity_scheduleMapper();
        $this->view->setLayout("default");
        $this->date = new DateTime();
        $this->currentDate = $this->date->getTimestamp();
    }

    /**
    * Action to list schedules of activities
    *
    * Loads all the schedules from the database.
    * No HTTP parameters are needed.
    *
    */
    public function index() {

      // obtain the data from the database
      $activities = $this->activityMapper->findAll();
      if (isset($_GET["idactivity"])) {
        $id_activity = $_GET["idactivity"];
        if ($id_activity==0){
          $activity_schedules = $this->activity_scheduleMapper->findAllByCurrentWeek();
        }else{
          $activity_schedules = $this->activity_scheduleMapper->findActivityByCurrentWeek($id_activity);
          $this->view->setVariable("current_activity", $id_activity);
        }
      }else{
        $activity_schedules = $this->activity_scheduleMapper->findAllByCurrentWeek();
      }
      // put the array containing Activity object to the view
      $this->view->setVariable("activities", $activities);
      $this->view->setVariable("activity_schedules", $activity_schedules);

      // render the view (/view/schedules/index.php)
      $this->view->render("schedules", "index");
    }

}

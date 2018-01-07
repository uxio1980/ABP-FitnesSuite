<?php
//file: controller/AssistanceController.php

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/Assistance.php");
require_once(__DIR__."/../model/AssistanceMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/User_activity.php");
require_once(__DIR__."/../model/User_activityMapper.php");
require_once(__DIR__."/../model/Activity_schedule.php");
require_once(__DIR__."/../model/Activity_scheduleMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class AssistanceController extends BaseController
{

    private $userMapper;
    private $activityMapper;
    private $assistanceMapper;
    private $user_activityMapper;
    private $activity_schedule;
    public function __construct() {
        parent::__construct();
        $this->user_activityMapper = new User_activityMapper();
        $this->activityMapper = new ActivityMapper();
        $this->userMapper = new UserMapper();
        $this->assistanceMapper = new AssistanceMapper();
        $this->activity_schedule = new Activity_scheduleMapper();
    }

    public function index() {
        if (!isset($_REQUEST["idactivity"])) {
            throw new Exception("A activity id is mandatory");
        }

        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Assitance activitys requires login");
        }
        // Get the activity object from the database
        $idactivity = $_REQUEST["idactivity"];
        $activity = $this->activityMapper->findById($idactivity);
        $schedule = $this->activity_schedule->findActivityByCurrentWeek($activity->getIdactivity());
        $user_act = $this->user_activityMapper->findByIdActivity($activity->getIdactivity());
        $users = array();
        $assistance =array();
        foreach ($user_act as $user){
            array_push($users,$user->getUser());
            foreach ($schedule as $day) {
                $assist = $this->assistanceMapper->findByUserActivityDate($user->getId(),
                    $user->getUser()->getId(),$activity->getIdactivity(),$day->getDate());
                array_push($assistance, $assist);

            }

        }
        $this->view->setVariable("activity", $activity);
        $this->view->setVariable("users", $users);
        $this->view->setVariable("schedule", $schedule);
        $this->view->setVariable("assist", $assistance);
        $this->view->render("assistance", "index");
    }

    public function save() {
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Modify assistance requires login");
        }
        $assistance = new Assistance();

            $assistance->setIdassist($_POST["id"]);
            $assistance->setIduserAct($_POST["idUserAct"]);
            $assistance->setDate($_POST["date"]);
            $assistance->setAssist(1);

            $a = $this->assistanceMapper->findById($assistance->getIdassist(),$assistance->getIduserAct());

            if ($a->getIdassist() != null) {
                $this->assistanceMapper->update($assistance);
            }
            else {
                $this->assistanceMapper->save($assistance);
            }
        $this->view->redirect("activities", "index");
    }

    public function delete() {

        if (!isset($_REQUEST["id"])) {
            throw new Exception("A assist id is mandatory");
        }
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Delete assistance requires login");
        }
        if ($this->currentUser->getUser_type()!=usertype::Trainer){
            throw new Exception("Not valid user. Delete assistance requires Trainer");
        }
        $idassist = $_REQUEST["id"];
        $assist = $this->assistanceMapper->findById2($idassist);
        if ($assist == NULL) {
            throw new Exception("no such assist with id: ".$idassist);
        }
        $assist->setAssist(0);
        $this->assistanceMapper->update($assist);

        $this->view->redirect("activities", "index");
    }

}
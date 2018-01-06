<?php
//file: controller/ActivitysController.php

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Statistic.php");
require_once(__DIR__."/../model/StatisticMapper.php");
require_once(__DIR__."/../model/User_tableMapper.php");
require_once(__DIR__."/../model/User_table.php");
require_once(__DIR__."/../model/Workout_table.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class StatisticsController extends BaseController {

  private $statisticMapper;
  private $user_tableMapper;

  public function __construct() {
    parent::__construct();

    $this->statisticMapper = new StatisticMapper();
    $this->user_tableMapper = new User_tableMapper();
  }

  public function index() {
    
    if(isset($this->currentUser)){
      if ($this->currentUser->getUser_type() == usertype::Administrator){
        $number_users = $this->statisticMapper->athletesRegistered();
        
        $athletes_activity = $this->statisticMapper->athletesByActivity();

        $this->view->setVariable("number_users", $number_users);
        $this->view->setVariable("athletes_activity", $athletes_activity);

        $this->view->render("statistics", "index_admin");
      } else if($this->currentUser->getUser_type() == usertype::Trainer){
        $exercises_type = $this->statisticMapper->exercisesByType();
        $athletes = $this->statisticMapper->athletesTrainer($this->currentUser->getId());

        $this->view->setVariable("exercises_type", $exercises_type);
        $this->view->setVariable("athletes", $athletes);

        if (!isset($_POST["userid"])) {
          if(!empty($athletes->getXaxis())){
            $sessions = $this->findSessions($athletes->getXaxis()[0]->getId());
            $this->view->setVariable("sessions", $sessions);
          }
        } else {
          $sessions = $this->findSessions($_POST["userid"]);
          $this->view->setVariable("sessions", $sessions);
          $this->view->setVariable("user", $_POST["userid"]);
        }

        $this->view->render("statistics", "index_trainer");
      } else{
        $assistance = $this->statisticMapper->athleteAssistance($this->currentUser->getId());
        $sessions = $this->findSessions($this->currentUser->getId());

        $this->view->setVariable("assistance", $assistance);
        $this->view->setVariable("sessions", $sessions);

        $this->view->render("statistics", "index_athlete");
      }
    }
  }

  // Devuelve todas las tablas de un usuario.
  public function findSessions($userid){
    $tables = $this->user_tableMapper->findByUser($userid);
    $sessions = array();
    foreach ($tables as $table) {
      $session = $this->statisticMapper->athleteSessionsTable($userid,$table->getId());
      if($session->getYaxis() != null)
        array_push($sessions, $session);
    }

    return $sessions;
  }

}

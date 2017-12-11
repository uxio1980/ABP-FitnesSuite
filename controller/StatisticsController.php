<?php
//file: controller/ActivitysController.php

require_once(__DIR__."/../model/Statistic.php");
require_once(__DIR__."/../model/StatisticMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class StatisticsController extends BaseController {

  private $statisticMapper;

  public function __construct() {
    parent::__construct();

    $this->statisticMapper = new StatisticMapper();
  }

  public function index() {
    
    if(isset($this->currentUser)){
      if ($this->currentUser->getUser_type() == usertype::Administrator){
        $number_users = $this->statisticMapper->athletesRegistered();
        $exercises_type = $this->statisticMapper->exercisesByType();
        $athletes_activity = $this->statisticMapper->athletesByActivity();

        $this->view->setVariable("number_users", $number_users);
        $this->view->setVariable("exercises_type", $exercises_type);
        $this->view->setVariable("athletes_activity", $athletes_activity);

        $this->view->render("statistics", "index_admin");
      } else if($this->currentUser->getUser_type() == usertype::Trainer){
        $this->currentUser->getId();
        $this->view->render("statistics", "index_trainer");
      } else{
        $assistance = $this->statisticMapper->athleteAssistance($this->currentUser->getId());

        $this->view->setVariable("assistance", $assistance);

        $this->view->render("statistics", "index_athlete");
      }
    }
  }

}

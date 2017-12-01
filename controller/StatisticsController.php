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

    // obtain the data from the database
    $number_users = $this->statisticMapper->athletesRegistered();
    $exercises_type = $this->statisticMapper->exercisesByType();

    // put the array containing Activity object to the view
    
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
      $this->view->setVariable("number_users", $number_users->getStatistic());
      $this->view->setVariable("exercises_type", $exercises_type->getStatistic());
      $this->view->render("statistics", "index_admin");
    } else {
      //$this->view->render("statistics", "index");
    }
  }

}

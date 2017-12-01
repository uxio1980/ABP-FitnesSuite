<?php
// file: model/statistic.php

require_once(__DIR__."/../core/ValidationException.php");

class Statistic {

  private $statistic;
  
  public function __construct($statistic=NULL) {
    $this->statistic = $statistic;
  }
    
  public function getStatistic() {
    return $this->statistic;
  }
   
  public function checkIsValidForCreate() {
      $errors = array();
      
      if (sizeof($errors) > 0){
          throw new ValidationException($errors, "activity is not valid");
      }
  }

  public function checkIsValidForUpdate() {
    $errors = array();
    
    if (!isset($this->idactivity)) {      
      $errors["idactivity"] = "idactivity is mandatory";
    }
    
    try{
      $this->checkIsValidForCreate();
    }catch(ValidationException $ex) {
      foreach ($ex->getErrors() as $key=>$error) {
	$errors[$key] = $error;
      }
    }    
    if (sizeof($errors) > 0) {
      throw new ValidationException($errors, "activity is not valid");
    }
  }
}

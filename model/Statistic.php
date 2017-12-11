<?php
// file: model/statistic.php

require_once(__DIR__."/../core/ValidationException.php");

class Statistic {

  private $xaxis;
  private $yaxis;
  private $extra;
  
  public function __construct($xaxis=NULL, $yaxis=NULL, $extra=NULL) {
    $this->xaxis = $xaxis;
    $this->yaxis = $yaxis;
    $this->extra = $extra;
  }
    
  public function getXaxis() {
    return $this->xaxis;
  }

  public function getYaxis() {
    return $this->yaxis;
  }

  public function extra() {
    return $this->extra;
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

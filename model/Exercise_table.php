<?php
// file: model/activity.php

require_once(__DIR__."/../core/ValidationException.php");

class Activity_resource {
    
  private $id;
  private $id_exercise;
  private $id_workout;

  
  public function __construct($id=NULL, $id_exercise=NULL, $id_workout=NULL) {
    $this->id = $id;
    $this->id_exercise = $id_exercise;
    $this->id_workout = $id_workout;
  }
  
  public function getId() {
    return $this->id;
  }

  public function getExercise() {
    return $this->id_exercise;
  }

  public function setExercise($id_exercise) {
    $this->id_exercise = $id_exercise;
  }

  public function getWorkout() {
    return $this->id_workout;
  }

  public function setWorkout($id_workout) {
    $this->id_workout = $id_workout;
  }
 
   /**
   * Checks if the current instance is valid
   * for being updated in the database.
   * 
   * @throws ValidationException if the instance is
   * not valid
   * 
   * @return void
   */    
  public function checkIsValidForCreate() {
      $errors = array();
      if (sizeof($errors) > 0){
	      throw new ValidationException($errors, "resource is not valid");
      }
  }

  /**
   * Checks if the current instance is valid
   * for being updated in the database.
   * 
   * @throws ValidationException if the instance is
   * not valid
   * 
   * @return void
   */
  public function checkIsValidForUpdate() {
    $errors = array();
    
    if (!isset($this->id)) {      
      $errors["id"] = "id exercise is mandatory";
    }
    
    try{
      $this->checkIsValidForCreate();
    }catch(ValidationException $ex) {
      foreach ($ex->getErrors() as $key=>$error) {
	      $errors[$key] = $error;
      }
    }    
    if (sizeof($errors) > 0) {
      throw new ValidationException($errors, "exercise is not valid");
    }
  }
}

<?php
// file: model/activity.php

require_once(__DIR__."/../core/ValidationException.php");

class Exercise_table {
    
  private $id;
  private $exercise;
  private $id_workout;
  private $series;
  private $repetitions;


  public function __construct($id=NULL, Exercise $exercise=NULL, $id_workout=NULL, $series=NULL, $repetitions=NULL) {
    $this->id = $id;
    $this->exercise = $exercise;
    $this->id_workout = $id_workout;
    $this->series = $series;
    $this->repetitions = $repetitions;

  }
  
  public function getId() {
    return $this->id;
  }

  public function getExercise() {
    return $this->exercise;
  }

  public function setExercise(Exercise $exercise) {
    $this->exercise = $exercise;
  }

  public function getWorkout() {
    return $this->id_workout;
  }

  public function setWorkout($id_workout) {
    $this->id_workout = $id_workout;
  }

    public function getSeries() {
        return $this->series;
    }

    public function setSeries($series) {
        $this->series = $series;
    }

    public function getRepetitions() {
        return $this->repetitions;
    }

    public function setRepetitions($repetitions) {
        $this->repetitions = $repetitions;
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

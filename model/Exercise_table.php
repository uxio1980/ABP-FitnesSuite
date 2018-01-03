<?php
// file: model/activity.php

require_once(__DIR__."/../core/ValidationException.php");

class Exercise_table {

  private $id;
  private $exercise;
  private $id_workout;
  private $series;
  private $repetitions;
  private $duration;


  public function __construct($id=NULL, Exercise $exercise=NULL, $id_workout=NULL, $series=NULL, $repetitions=NULL, $duration=NULL) {
    $this->id = $id;
    $this->exercise = $exercise;
    $this->id_workout = $id_workout;
    $this->series = $series;
    $this->repetitions = $repetitions;
    $this->duration = $duration;
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

    public function getDuration() {
        return $this->duration;
    }

    public function setDuration($duration) {
        $this->duration = $duration;
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
      if ($this->getExercise()->getType()=="Cardiovascular"){
        if (strlen($this->getDuration())<1){
          $errors["duration"] = i18n("You must write a duration");
        }
      }else{
        if (strlen($this->getRepetitions())<1){
          $errors["repetitions"] = i18n("You must write a number of repetitions");
        }
        if (strlen($this->getSeries())<1){
          $errors["series"] = i18n("You must write a number of series");
        }
      }
      if (sizeof($errors) > 0){
	      throw new ValidationException($errors, "Exercise is not valid");
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
    if ($this->getExercise()->getType()=="Cardiovascular"){
      if (strlen($this->getDuration())<1){
        $errors["duration"] = i18n("You must write a duration");
      }
    }else{
      if (strlen($this->getRepetitions())<1){
        $errors["repetitions"] = i18n("You must write a number of repetitions");
      }
      if (strlen($this->getSeries())<1){
        $errors["series"] = i18n("You must write a number of series");
      }
    }
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

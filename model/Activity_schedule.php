<?php
require_once(__DIR__."/../core/ValidationException.php");

class Activity_schedule {
  private $id;
  private $activity;
  private $date;
  private $start_hour;
  private $end_hour;
  private $duration;

  public function __construct($id=NULL, Activity $activity=NULL, $date= NULL,$start_hour=NULL,
  $end_hour=NULL, $duration=NULL) {
    $this->id = $id;
    $this->activity = $activity;
    $this->date = $date;
    $this->start_hour = $start_hour;
    $this->end_hour = $end_hour;
    $this->duration = $duration;
  }

  public function getId() {
    return $this->id;
  }

  public function getActivity() {
    return $this->activity;
  }

  public function getDate() {
    return $this->date;
  }

  public function getStart_hour() {
    return $this->start_hour;
  }

  public function getEnd_hour() {
    return $this->end_hour;
  }

  public function getDuration(){
    return $this->duration;
  }

  public function setActivity(Activity $activity) {
    $this->activity = $activity;
  }

  public function setDate($date) {
    $this->date = $date;
  }

  public function setStart_hour($start_hour) {
    $this->start_hour = $start_hour;
  }

  public function setEnd_hour($end_hour) {
    $this->end_hour = $end_hour;
  }

  public function setDuration($duration){
    $this->duration = $duration;
  }

  /**
  * Checks if the current activity_schedule instance is valid
  * for being registered in the database
  *
  * @throws ValidationException if the instance is
  * not valid
  *
  * @return void
  */
  public function checkIsValidForCreate() {
    $errors = array();
    if ($this->duration <= $this->date ) {
      $errors["end"] = "End date is previous or equal to start date";
    }

    if ($this->end_hour <= $this->start_hour ) {
      $errors["end"] = "End hour is previous or equal to start hour";
    }

    if (sizeof($errors) > 0){
    throw new ValidationException($errors, "activity schedule is not valid");
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

    try{
      $this->checkIsValidForCreate();
    }catch(ValidationException $ex) {
      foreach ($ex->getErrors() as $key=>$error) {
        $errors[$key] = $error;
      }
    }
    if (sizeof($errors) > 0) {
      throw new ValidationException($errors, "User is not valid");
    }
  }
}

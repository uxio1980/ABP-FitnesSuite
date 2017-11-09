<?php
require_once(__DIR__."/../core/ValidationException.php");

class Activity_schedule {
  private $id;
  private $id_activity;
  private $date;
  private $start_hour;
  private $end_hour;

  public function __construct($id=NULL, $id_activity=NULL, $date= NULL,$start_hour=NULL,
  $end_hour=NULL) {
    $this->id = $id;
    $this->id_activity = $id_activity;
    $this->date = $date;
    $this->start_hour = $start_hour;
    $this->end_hour = $end_hour;
  }

  public function getId() {
    return $this->id;
  }

  public function getId_activity() {
    return $this->id_activity;
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

  public function setId_activity($id_activity) {
    $this->id_activity = $id_activity;
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

  /**
  * Checks if the current activity_schedule instance is valid
  * for being registered in the database
  *
  * @throws ValidationException if the instance is
  * not valid
  *
  * @return void
  */
  public function checkIsValidForRegister() {
    $errors = array();

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
      $this->checkIsValidForRegister();
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

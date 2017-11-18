<?php
require_once(__DIR__."/../core/ValidationException.php");

class User_table {
  private $id;
  private $workout_table;
  private $user;

  public function __construct($id=NULL, Workout_table $workout_table=NULL, User $user=NULL) {
    $this->id = $id;
    $this->workout_table = $workout_table;
    $this->user = $user;
  }

  public function getId() {
    return $this->id;
  }

  public function getWorkout_table() {
    return $this->workout_table;
  }

  public function getUser() {
    return $this->user;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setWorkout_table(Workout_table $workout_table) {
    $this->workout_table = $workout_table;
  }

  public function setUser(User $user) {
    $this->user = $user;
  }

  /**
  * Checks if the current user instance is valid
  * for being registered in the database
  *
  * @throws ValidationException if the instance is
  * not valid
  *
  * @return void
  */
  public function checkIsValidForRegister() {
    $errors = array();
    if (sizeof($errors)>0){
      throw new ValidationException($errors, "user is not valid");
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

<?php
require_once(__DIR__."/../core/ValidationException.php");

class User_activity {
  private $id;
  private $user;
  private $activity;

  public function __construct($id=NULL, User $user=NULL, Activity $activity=NULL) {
    $this->id = $id;
    $this->user = $user;
    $this->activity = $activity;
  }

  public function getId() {
    return $this->id;
  }

  public function getUser() {
    return $this->user;
  }

  public function getActivity() {
    return $this->activity;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setUser(User $user) {
    $this->user = $user;
  }

  public function setActivity(Activity $activity) {
    $this->activity = $activity;
  }

  /**
  * Checks if the current Notification instance is valid
  * for being registered in the database
  *
  * @throws ValidationException if the instance is
  * not valid
  *
  * @return void
  */
  public function checkIsValidForCreate() {
    $errors = array();
    /*if (strlen($this->email) < 5) {
      $errors["register-email"] = "You must write your email";
    }*/
    if (sizeof($errors)>0){
      throw new ValidationException($errors, "User_activity is not valid");
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
      throw new ValidationException($errors, "User_activity is not valid");
    }
  }
}

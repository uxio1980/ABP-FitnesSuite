<?php
require_once(__DIR__."/../core/ValidationException.php");

class Session {
  private $id;
  private $User;
  private $User_table;
  private $date;
  private $duration;
  private $comment;

  public function __construct($id=NULL,User $user=NULL, User_table $user_table=NULL, $date=NULL, $duration=NULL, $comment=NULL) {
    $this->id = $id;
    $this->user = $user;
    $this->user_table = $user_table;
    $this->date = $date;
    $this->duration = $duration;
    $this->comment = $comment;
  }

  public function getId() {
    return $this->id;
  }

  public function getUser() {
    return $this->user;
  }

  public function getUser_table() {
    return $this->user_table;
  }

  public function getDate() {
    return $this->date;
  }

  public function getDuration() {
    return $this->duration;
  }

  public function getComment() {
    return $this->comment;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setUser(User $user) {
    $this->user = $user;
  }

  public function setUser_table(User_table $user_table) {
    $this->user_table = $user_table;
  }

  public function setDate($date) {
    $this->date = $date;
  }

  public function setDuration($duration) {
    $this->duration = $duration;
  }

  public function setComment($comment) {
    $this->comment = $comment;
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
  public function checkIsValidForCreate() {
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

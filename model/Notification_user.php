<?php
require_once(__DIR__."/../core/ValidationException.php");

class Notification_user {
  private $id;
  private $user_receiver;
  private $notification;
  private $viewed;

  public function __construct($id=NULL, User $user_receiver=NULL,
   Notification $notification=NULL, $viewed=NULL) {
    $this->id = $id;
    $this->user_receiver = $user_receiver;
    $this->notification = $notification;
    $this->viewed = $viewed;
  }

  public function getId() {
    return $this->id;
  }

  public function getUser_receiver() {
    return $this->user_receiver;
  }

  public function getNotification() {
    return $this->notification;
  }

  public function getViewed() {
    return $this->viewed;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setUser_receiver(User $user) {
    $this->user_receiver = $user;
  }

  public function setNotification(Notification $notification) {
    $this->notification = $notification;
  }

  public function setViewed($viewed) {
    $this->viewed = $viewed;
  }

  /**
  * Checks if the current Notification user instance is valid
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
    }
    if (sizeof($errors)>0){
      throw new ValidationException($errors, "user is not valid");
    }*/
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
    /*
    if (strlen($this->phone) >0 && !is_numeric($this->phone)){
      $errors["phone"] = "You must write a valid phone number";
    }
    try{
      $this->checkIsValidForRegister();
    }catch(ValidationException $ex) {
      foreach ($ex->getErrors() as $key=>$error) {
        $errors[$key] = $error;
      }
    }
    if (sizeof($errors) > 0) {
      throw new ValidationException($errors, "User is not valid");
    }*/
  }
}

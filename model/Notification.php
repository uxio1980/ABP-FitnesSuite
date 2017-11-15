<?php
require_once(__DIR__."/../core/ValidationException.php");

class Notification {
  private $id;
  private $user_author;
  private $date;
  private $title;
  private $content;
  private $receivers;


  public function __construct($id=NULL, User $user_author=NULL, $date=NULL, $title=NULL,
  $content=NULL, $receivers=NULL) {
    $this->id = $id;
    $this->user_author = $user_author;
    $this->date = $date;
    $this->title = $title;
    $this->content = $content;
    $this->receivers = $receivers;
  }

  public function getId() {
    return $this->id;
  }

  public function getUser_author() {
    return $this->user_author;
  }

  public function getDate() {
    return $this->date;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getContent() {
    return $this->content;
  }

  public function getReceivers() {
    return $this->receivers;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setUser_author(User $user) {
    $this->user_author = $user;
  }

  public function setDate($date) {
    $this->date = $date;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function setReceivers($receivers) {
    $this->receivers = $receivers;
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
  public function checkIsValidForRegister() {
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

<?php
require_once(__DIR__."/../core/ValidationException.php");

class Public_info {
  private $id;
  private $phone;
  private $email;
  private $address;

  public function __construct($id=NULL, $phone=NULL, $email=NULL, $address=NULL) {
    $this->id = $id;
    $this->phone = $phone;
    $this->email = $email;
    $this->address = $address;
  }

  public function getId() {
    return $this->id;
  }

  public function getPhone() {
    return $this->phone;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getAddress() {
    return $this->address;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setPhone($phone) {
    $this->phone = $phone;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function setAddress($address) {
    $this->address = $address;
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
    if (strlen($this->email) < 5) {
      $errors["register-email"] = "You must write your email";
    }
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

    if (strlen($this->phone) >0 && !is_numeric($this->phone)){
      $errors["phone"] = "You must write a valid phone number";
    }
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

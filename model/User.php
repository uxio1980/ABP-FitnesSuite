<?php
require_once(__DIR__."/../core/ValidationException.php");

abstract class usertype
{
    const Administrator = 1;
    const Trainer = 2;
    const AthleteTDU = 3;
    const AthletePEF = 4;

    function get_AllNames(){
      $utypeClass = new ReflectionClass('usertype');
      $constants = $utypeClass->getConstants();
      return $constants;
    }

    function getName($idnumber){
      $utypeClass = new ReflectionClass('usertype');
      $constants = $utypeClass->getConstants();
      $constName = null;
      foreach ( $constants as $name => $value ) {
          if ( $value == $idnumber )  {
              $constName = $name;
              break;
          }
      }
      return $constName;
    }

    function getSize(){
      $utypeClass = new ReflectionClass('usertype');
      $constants = $utypeClass->getConstants();
      $const = 0;
      foreach ( $constants as $name => $value ) {
          $const = $const + 1;
          }
      return $const;
      }
}

class User {
  private $id;
  private $login;
  private $password;
  private $name;
  private $surname;
  private $email;
  private $phone;
  private $dni;
  private $confirm_date;
  private $description;
  private $profileImage;
  private $user_type;

  public function __construct($id=NULL, $login=NULL, $name= NULL,$password=NULL,
  $email=NULL, $description=NULL,$profileImage=NULL, $surname=NULL, $phone=NULL,
  $dni=NULL, $confirm_date=NULL, $user_type=NULL) {
    $this->id = $id;
    $this->login = $login;
    $this->name = $name;
    $this->password = $password;
    $this->email = $email;
    $this->description = $description;
    $this->profileImage = $profileImage;
    $this->surname = $surname;
    $this->phone = $phone;
    $this->dni = $dni;
    $this->confirm_date = $confirm_date;
    $this->user_type = $user_type;
  }

  public function getId() {
    return $this->id;
  }

  public function getLogin() {
    return $this->login;
  }

  public function getName() {
    return $this->name;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getProfileImage() {
    return $this->profileImage;
  }

  public function getSurname() {
    return $this->surname;
  }

  public function getPhone() {
    return $this->phone;
  }

  public function getDni() {
    return $this->dni;
  }

  public function getConfirm_date() {
    return $this->confirm_date;
  }

  public function getUser_type() {
    return $this->user_type;
  }

  public function setLogin($login) {
    $this->login = $login;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setProfileImage($profileImage) {
    $this->profileImage = $profileImage;
  }

  public function setSurname($surname) {
    $this->surname = $surname;
  }

  public function setPhone($phone) {
    $this->phone = $phone;
  }

  public function setDni($dni) {
    $this->dni = $dni;
  }

  public function setConfirm_date($confirm_date) {
    $this->confirm_date = $confirm_date;
  }

  public function setUser_type($user_type) {
    $this->user_type = $user_type;
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
    if (strlen($this->login) < 3) {
      $errors["register-login"] = "Login must be at least 5 characters length";
    }
    if (strlen($this->password) < 5) {
      $errors["register-password"] = "Password must be at least 5 characters length";
    }
    if (strlen($this->name) == 0) {
      $errors["register-name"] = "You must write your name";
    }
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

    if (strlen($this->name) == 0) {
      $errors["name"] = "You must write your name";
    }
    if (strlen($this->password) < 5) {
      $errors["password"] = "Password must be at least 5 characters length";
    }
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
    }
  }
}

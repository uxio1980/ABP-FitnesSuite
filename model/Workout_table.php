<?php
require_once(__DIR__."/../core/ValidationException.php");

class Workout_table {
  private $id;
  private $user;
  private $name;
  private $type;
  private $description;

  public function __construct($id=NULL, User $user=NULL, $name=NULL, $type=NULL, $description=NULL) {
    $this->id = $id;
    $this->user = $user;
    $this->name = $name;
    $this->type = $type;
    $this->description = $description;
  }

  public function getId() {
    return $this->id;
  }

  public function getUser() {
    return $this->user;
  }

  public function getName() {
    return $this->name;
  }

  public function getType() {
    return $this->type;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setUser(User $user) {
    $this->user = $user;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function setType($type) {
    $this->type = $type;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  /**
  * Checks if the current workout_table instance is valid
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
      throw new ValidationException($errors, "Workout_table is not valid");
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

    }catch(ValidationException $ex) {
      foreach ($ex->getErrors() as $key=>$error) {
        $errors[$key] = $error;
      }
    }
    if (sizeof($errors) > 0) {
      throw new ValidationException($errors, "Workout_table is not valid");
    }
  }
}

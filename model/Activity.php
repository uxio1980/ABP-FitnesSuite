<?php
// file: model/activity.php

require_once(__DIR__."/../core/ValidationException.php");

class Activity {

  private $idactivity;
  private $iduser; 
  private $name;   
  private $description;   
  private $place;   
  private $type;  
  private $seats;  
  private $image;
  
  public function __construct($idactivity=NULL, $iduser=NULL, $name=NULL, $description=NULL, $place=NULL, $type=NULL, $seats=NULL, $image=NULL) {
    $this->idactivity = $idactivity;
    $this->iduser = $iduser;
    $this->name = $name;
    $this->description = $description;
    $this->place = $place;
    $this->type = $type;
    $this->seats = $seats;
    $this->image = $image;
  }
   
  public function getIdactivity() {
    return $this->idactivity;
  }
    
  public function getIduser() {
    return $this->iduser;
  }

  public function setIduser($iduser) {
    $this->iduser = $iduser;
  }
    
  public function getName() {
    return $this->name;
  }
   
  public function setName($name) {
    $this->name = $name;
  }
  
  public function getDescription() {
    return $this->description;
  }
  
  public function setDescription($description) {
    $this->description = $description;
  }
 
  public function getPlace() {
    return $this->place;
  }
   
  public function setPlace($place) {
    $this->place = $place;
  }
 
  public function getType() {
    return $this->type;
  }
   
  public function setType($type) {
    $this->type = $type;
  }
 
  public function getSeats() {
    return $this->seats;
  }
    
  public function setSeats($seats) {
    $this->seats = $seats;
  }
 
  public function getImage() {
    return $this->image;
  }
 
  public function setImage($image) {
    $this->image = $image;
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
  public function checkIsValidForCreate() {
      $errors = array();
      if (strlen(trim($this->name)) == 0 ) {
	$errors["name"] = "name is mandatory";
      }
      if (strlen(trim($this->description)) == 0 ) {
	$errors["description"] = "description is mandatory";
      }
      
      if (sizeof($errors) > 0){
	throw new ValidationException($errors, "activity is not valid");
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
    
    if (!isset($this->idactivity)) {      
      $errors["idactivity"] = "idactivity is mandatory";
    }
    
    try{
      $this->checkIsValidForCreate();
    }catch(ValidationException $ex) {
      foreach ($ex->getErrors() as $key=>$error) {
	$errors[$key] = $error;
      }
    }    
    if (sizeof($errors) > 0) {
      throw new ValidationException($errors, "activity is not valid");
    }
  }
}

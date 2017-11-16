<?php
// file: model/activity.php

require_once(__DIR__."/../core/ValidationException.php");

class Resource {

  private $idresource;
  private $name; 
  private $description;   
  private $quantity;   
  
  public function __construct($idresource=NULL, $name=NULL, $description=NULL, $quantity=NULL) {
    $this->idresource = $idresource;
    $this->name = $name;
    $this->description = $description;
    $this->quantity = $quantity;
  }
   
  public function getIdresource() {
    return $this->idresource;
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
 
  public function getQuantity() {
    return $this->quantity;
  }
   
  public function setQuantity($quantity) {
    $this->quantity = $quantity;
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
      
      if (sizeof($errors) > 0){
	throw new ValidationException($errors, "resource is not valid");
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
    
    if (!isset($this->idresource)) {      
      $errors["idresource"] = "idresource is mandatory";
    }
    
    try{
      $this->checkIsValidForCreate();
    }catch(ValidationException $ex) {
      foreach ($ex->getErrors() as $key=>$error) {
	$errors[$key] = $error;
      }
    }    
    if (sizeof($errors) > 0) {
      throw new ValidationException($errors, "resource is not valid");
    }
  }
}

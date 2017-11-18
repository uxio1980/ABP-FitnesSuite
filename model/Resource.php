<?php
// file: model/activity.php

require_once(__DIR__."/../core/ValidationException.php");

abstract class resourcetype
{
    const Resource = 1;
    const Place = 2;

    function get_AllNames(){
      $utypeClass = new ReflectionClass('resourcetype');
      $constants = $utypeClass->getConstants();
      return $constants;
    }

    function getName($idnumber){
      $utypeClass = new ReflectionClass('resourcetype');
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
      $utypeClass = new ReflectionClass('resourcetype');
      $constants = $utypeClass->getConstants();
      $const = 0;
      foreach ( $constants as $name => $value ) {
          $const = $const + 1;
          }
      return $const;
      }
}

class Resource {

  private $idresource;
  private $name; 
  private $description;   
  private $quantity;  
  private $type; 
  
  public function __construct($idresource=NULL, $name=NULL, $description=NULL, $quantity=NULL, $type=NULL) {
    $this->idresource = $idresource;
    $this->name = $name;
    $this->description = $description;
    $this->quantity = $quantity;
    $this->type = $type;
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

  public function getType() {
    return $this->type;
  }
   
  public function setType($type) {
    $this->type = $type;
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

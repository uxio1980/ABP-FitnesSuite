<?php
// file: model/activity.php

require_once(__DIR__."/../core/ValidationException.php");

class Activity_resource {

  private $id;
  private $idactivity;
  private $idresource;
  private $quantity;
  private $nameResource;

  public function __construct($id=NULL, $idactivity=NULL, $idresource=NULL, $quantity=NULL, $nameResource =NULL) {
    $this->id = $id;
    $this->idactivity = $idactivity;
    $this->idresource = $idresource;
    $this->quantity = $quantity;
    $this->nameResource = $nameResource;
  }

  public function getId() {
    return $this->id;
  }

  public function getIdresource() {
    return $this->idresource;
  }

  public function getNameResource() {
    return $this->nameResource;
  }


  public function setIdresource($idresource) {
    $this->idresource = $idresource;
  }

  public function getIdactivity() {
    return $this->idactivity;
  }

  public function setIdactivity($idactivity) {
    $this->idactivity = $idactivity;
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

    if (!isset($this->id)) {
      $errors["id"] = "idresource is mandatory";
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

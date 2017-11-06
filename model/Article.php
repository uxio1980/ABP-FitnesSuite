<?php
// file: model/Article.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class Article
 * 
 * Represents a Article in the page. An Article was written by an
 * specific User (author) and contains a list of chatlines
 * 
 * @author lipido <lipido@gmail.com>
 */
class Article {

  /**
   * The id of this article
   * @var string
   */
  private $idarticle;
  
  /**
   * The name of this article
   * @var string
   */  
  private $name;
  
  /**
   * The description of this article
   * @var string
   */    
  private $description;
  
  /**
   * The price of this article
   * @var double
   */    
  private $price;

  /**
   * The  first image file name of this article
   * @var string
   */    
  private $url_image01;

  /**
   * The  second image file name of this article
   * @var string
   */    
  private $url_image02;

  /**
   * The  third image file name of this article
   * @var string
   */    
  private $url_image03;

  /**
   * The author of this article
   * @var User
   */    
  private $user_login;
  
   /**
   * The list of ChatLines of this article
   * @var mixed
   */    
  private $chatlines;
    
  /**
   * The constructor
   * 
   * @param string $idarticle The id of the article
   * @param string $name The name of the article
   * @param string $description The description of the article
   * @param User $user_login The author of the article
   * @param double $price The price of the article      
   * @param string $url_image01 The first image file name of the article
   * @param string $url_image02 The second image file name of the article
   * @param string $url_image03 The third image file name of the article
   */  
  public function __construct($idarticle=NULL, $name=NULL, $description=NULL, $price=NULL, $url_image01=NULL, $url_image02=NULL, $url_image03=NULL, User $user_login=NULL, array $chatlines=NULL) {
    $this->idarticle = $idarticle;
    $this->name = $name;
    $this->description = $description;
    $this->price = $price;
	$this->url_image01 = $url_image01;
	$this->url_image02 = $url_image02;
	$this->url_image03 = $url_image03;
	$this->user_login = $user_login;
	$this->chatlines = $chatlines;
  }

  /**
   * Gets the id of this article
   * 
   * @return string The id of this article
   */     
  public function getIdArticle() {
    return $this->idarticle;
  }
  
  /**
   * Gets the name of this article
   * 
   * @return string The name of this article
   */     
  public function getName() {
    return $this->name;
  }
  
  /**
   * Sets the name of this article
   * 
   * @param string $name the name of this article
   * @return void
   */    
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Gets the description of this article
   * 
   * @return string The description of this article
   */    
  public function getDescription() {
    return $this->description;
  }

  /**
   * Sets the Description of this article
   * 
   * @param string $description the description of this article
   * @return void
   */  
  public function setDescription($description) {
    $this->description = $description;
  }

  /**
   * Gets the price of this article
   * 
   * @return double The price of this article
   */  
  public function getPrice() {
    return $this->price;
  }
  
  /**
   * Sets the price of the article
   * 
   * @param double $price of this article
   * @return void
   */  
  public function setPrice($price) {
    $this->price = $price;
  }

  /**
   * Gets the first image file name of this article
   * 
   * @return string The first image file name of this article
   */  
  public function getUrlImage01() {
    return $this->url_image01;
  }
  
  /**
   * Sets the first image file name of the article
   * 
   * @param string $url_image01 The first image file name of this article
   * @return void
   */  
  public function setUrlImage01($url_image01) {
    $this->url_image01 = $url_image01;
  }

  /**
   * Gets the second image file name of this article
   * 
   * @return string The second image file name of this article
   */  
  public function getUrlImage02() {
    return $this->url_image02;
  }
  
  /**
   * Sets the second image file name of the article
   * 
   * @param string $url_image02 The second image file name of this article
   * @return void
   */  
  public function setUrlImage02($url_image02) {
    $this->url_image02 = $url_image02;
  }
  
  /**
   * Gets the third image file name of this article
   * 
   * @return string The third image file name of this article
   */  
  public function getUrlImage03() {
    return $this->url_image03;
  }
  
  /**
   * Sets the third image file name of the article
   * 
   * @param string $url_image02 The third image file name of this article
   * @return void
   */  
  public function setUrlImage03($url_image03) {
    $this->url_image03 = $url_image03;
  }
  
  /**
   * Gets the author of this article
   * 
   * @return User The author of this article
   */    
  public function getUserLogin() {
    return $this->user_login;
  }
  
  /**
   * Sets the author of this article
   * 
   * @param User $author the author of this article
   * @return void
   */    
  public function setUserLogin(User $user_login) {
    $this->user_login = $user_login;
  }


 /**
   * Gets the list of chatlines of this article
   * 
   * @return mixed The list of chatlines of this article
   */  
  public function getChatLines() {
    return $this->chatlines;
  }
  
  /**
   * Sets the chatlines of the article
   * 
   * @param mixed $chatlines the chatlines list of this article
   * @return void
   */  
  public function setChatLines(array $chatlines) {
    $this->chatlines = $chatlines;
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
      if (strlen(trim($this->price)) == 0 ) {
	$errors["price"] = "price is mandatory";
      }
      if ($this->user_login == NULL ) {
	$errors["user_login"] = "user is mandatory";
      }
      
      if (sizeof($errors) > 0){
	throw new ValidationException($errors, "article is not valid");
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
    
    if (!isset($this->idarticle)) {      
      $errors["idarticle"] = "idarticle is mandatory";
    }
    
    try{
      $this->checkIsValidForCreate();
    }catch(ValidationException $ex) {
      foreach ($ex->getErrors() as $key=>$error) {
	$errors[$key] = $error;
      }
    }    
    if (sizeof($errors) > 0) {
      throw new ValidationException($errors, "article is not valid");
    }
  }
}

<?php
//file: controller/BaseController.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

/**
 * Class BaseController
 *
 * Implements a basic super constructor for
 * the controllers in the Blog App.
 * Basically, it provides some protected
 * attributes and view variables.
 *
 * @author lipido <lipido@gmail.com>
 */
class BaseController {

  /**
   * The view manager instance
   * @var ViewManager
   */
  protected $view;
  protected $i18n;
  /**
   * The current user instance
   * @var User
   */
  protected $currentUser;
  private $userMapper;

  public function __construct() {
    $this->view = ViewManager::getInstance();
    $this->i18n = I18n::getInstance();
    $this->userMapper = new UserMapper();
    // get the current user and put it to the view
    if (session_status() == PHP_SESSION_NONE) {	session_start();
    }

    if(isset($_SESSION["currentuser"])) {
      $this->currentUser = new User(NULL,$_SESSION["currentuser"]);
      $userprofile =  $this->userMapper->findById($this->currentUser->getLogin());
      $this->currentUser->setUser_type($userprofile->getUser_type());
      $this->currentUser->setId($userprofile->getId());
      //add current user to the view, since some views require it
      $this->view->setVariable("currentusername", $this->currentUser->getLogin());
      $this->view->setVariable("typeuser", $userprofile->getUser_type());
      $this->view->setVariable("imageUser", $userprofile->getProfileImage());
    }
  }
}

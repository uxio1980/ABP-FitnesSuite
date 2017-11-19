<?php
//file: controller/ActivitysController.php

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Resource.php");
require_once(__DIR__."/../model/ResourceMapper.php");
require_once(__DIR__."/../model/Activity_resource.php");
require_once(__DIR__."/../model/Activity_resourceMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class ActivitysController
*
* Controller to make a CRUD of Activitys entities
*
* @author lipido <lipido@gmail.com>
*/
class Activity_resourcesController extends BaseController {

  /**
  * Reference to the ActivityMapper to interact
  * with the database
  *
  * @var ActivityMapper
  */
  private $userMapper;
  private $activityMapper;
  private $resourceMapper;
  private $activity_resourceMapper;

  public function __construct() {
    parent::__construct();

    $this->activityMapper = new ActivityMapper();
    $this->resourceMapper = new ResourceMapper();
    $this->activity_resourceMapper = new Activity_resourceMapper();
  }

  /**
  * Action to list activitys
  *
  * Loads all the activitys from the database.
  * No HTTP parameters are needed.
  *
  * The views are:
  * <ul>
  * <li>activitys/index (via include)</li>
  * </ul>
  */
  public function index() {
    if (!isset($_REQUEST["idactivity"])) {
        throw new Exception("A activity id is mandatory");
    }

    if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Editing activitys requires login");
    }
    $idactivity = $_REQUEST["idactivity"];
    $activity_resources = $this->activity_resourceMapper->findAll($idactivity);

    $this->view->setVariable("idactivity", $idactivity);
    $this->view->setVariable("activity_resources", $activity_resources);
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
      $this->view->render("activity_resources", "index");
    }  
  }

  public function add() {
    if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Adding activities requires login");
    } 
    if (!isset($_REQUEST["idactivity"])) {
        throw new Exception("An Activity id is required");
    }  
    $idactivity = $_REQUEST["idactivity"];
    $resources = $this->activity_resourceMapper->findResourcesActivity($idactivity);

    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      $activity_resource = new Activity_resource();

      // populate the activity object with data form the form
      $activity_resource->setIdactivity($_POST["idactivity"]);
      $activity_resource->setIdresource($_POST["idresource"]);
      $activity_resource->setQuantity($_POST["quantity"]);

      try {
        // validate activity object
        $activity_resource->checkIsValidForCreate(); // if it fails, ValidationException

        // save the activity object into the database
        $this->activity_resourceMapper->save($activity_resource);

        $this->view->redirect("activity_resources", "index","idactivity=".$_POST["idactivity"]);

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    } 
    // Put the Activity object visible to the view
    $this->view->setVariable("idactivity", $idactivity);
    $this->view->setVariable("resources", $resources);

    // render the view (/view/activitys/add.php)
    $this->view->render("activity_resources", "add");
  }

  public function edit() {
    if (!isset($_REQUEST["id"])) {
      throw new Exception("An id is mandatory");
    }

    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing activitys requires login");
    }
    $id = $_REQUEST["id"];
    $activity_resource = $this->activity_resourceMapper->findById($id);
    $resource = $this->resourceMapper->findById($activity_resource->getIdresource());
    $resources = $this->activity_resourceMapper->findResourcesActivity($activity_resource->getIdactivity());

    if (isset($_POST["submit"])) { 
        // Get the activity object from the database
        $activity_resource->setIdactivity($_POST["idactivity"]);
        $activity_resource->setIdresource($_POST["idresource"]);
        $activity_resource->setQuantity($_POST["quantity"]);

      try {
        // validate Post object
        $activity_resource->checkIsValidForUpdate(); // if it fails, ValidationException

        // update the Post object in the database
        $this->activity_resourceMapper->update($activity_resource);

        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts
        // perform the redirection. More or less:
        // header("Location: index.php?controller=posts&action=index")
        // die();
        $this->view->redirect("activity_resources", "index","idactivity=".$_POST["idactivity"]);

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Post object visible to the view
    $this->view->setVariable("resource", $resource);
    $this->view->setVariable("resources", $resources);
    $this->view->setVariable("activity_resource", $activity_resource);

    // render the view (/view/activitys/add.php)
    $this->view->render("activity_resources", "edit");
  }

  public function delete() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing users requires login");
    }
    if ($this->currentUser->getUser_type()!=usertype::Administrator){
      throw new Exception("Not valid user. Editing resource requires Administrator");
    }

    // Get the user object from the database
    $id = $_REQUEST["id"];
    $activity_resource = $this->activity_resourceMapper->findById($id);
    $idactivity = $activity_resource->getIdactivity();

    // Does the user exist?
    if ($activity_resource == NULL) {
      throw new Exception("no such resource with id: ".$idresource);
    }

    // Delete the user object from the database
    $this->activity_resourceMapper->delete($activity_resource);

    $this->view->setFlash(sprintf(i18n("Resource \"%s\" successfully deleted."),$activity_resource->getId()));

    $this->view->redirect("activity_resources", "index","idactivity=".$idactivity);

  }
}
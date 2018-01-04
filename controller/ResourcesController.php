<?php
//file: controller/ResourcesController.php

require_once(__DIR__."/../model/Resource.php");
require_once(__DIR__."/../model/ResourceMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class ResourcesController extends BaseController {

  /**
  * Reference to the ResourceMapper to interact
  * with the database
  *
  * @var ResourceMapper
  */
  private $resourceMapper;

  public function __construct() {
    parent::__construct();

    $this->resourceMapper = new ResourceMapper();
  }

  public function index() {

    // obtain the data from the database
    $resources = $this->resourceMapper->findAll();

    // put the array containing Resource object to the view
    $this->view->setVariable("resources", $resources);
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
      $this->view->render("resources", "index");
    }
  }

  public function view(){
    if (!isset($_GET["idresource"])) {
      throw new Exception("idresource is mandatory");
    }

    $resourceid = $_GET["idresource"];

    // Recuperar distintas actividades según usuario.
    $resource = $this->resourceMapper->findById($resourceid);
    // Recupera el array de rutas a las imágenes.

    if ($resource == NULL) {
      throw new Exception("->no such resource with id: ".$resourceid);
    }

    // put the Resource object to the view
    $this->view->setVariable("resource", $resource);

    // render the view (/view/resources/view.php)
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
      $this->view->render("resources", "view");
    }

  }

  public function add_resource() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Adding resources requires login");
    }

    $resource = new Resource();

    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      // populate the resource object with data form the form
      $resource->setName($_POST["name"]);
      $resource->setDescription($_POST["description"]);
      $resource->setQuantity($_POST["quantity"]);
      $resource->setType(resourcetype::Resource);

      try {
        // validate resource object
        $resource->checkIsValidForCreate(); // if it fails, ValidationException

        // save the resource object into the database
        $this->resourceMapper->save($resource);
        $this->view->redirect("resources", "index");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // render the view (/view/resources/add.php)
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
      $this->view->render("resources", "add_res");
    }

  }

  public function add_place() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Adding resources requires login");
    }

    $resource = new Resource();

    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      // populate the resource object with data form the form
      $resource->setName($_POST["name"]);
      $resource->setDescription($_POST["description"]);
      $resource->setQuantity(1);
      $resource->setType(resourcetype::Place);

      try {
        // validate resource object
        $resource->checkIsValidForCreate(); // if it fails, ValidationException

        // save the resource object into the database
        $this->resourceMapper->save($resource);
        $this->view->redirect("resources", "index");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // render the view (/view/resources/add.php)
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
      $this->view->render("resources", "add_place");
    }

  }

  public function edit() {
    if (!isset($_REQUEST["idresource"])) {
      throw new Exception("A resource id is mandatory");
    }

    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing resources requires login");
    }

    // Get the resource object from the database
    $idresource = $_REQUEST["idresource"];
    $resource = $this->resourceMapper->findById($idresource);
    // Does the resource exist?
    if ($resource == NULL) {
      throw new Exception("no such resource with id: ".$idresource);
    }

    if (isset($_POST["submit"])) { // reaching via HTTP Post...

      // populate the resource object with data form the form
      $resource->setName($_POST["name"]);
      $resource->setDescription($_POST["description"]);
      $resource->setQuantity($_POST["quantity"]);
      $resource->setType($_POST["type"]);

      try {
        // validate Post object
        $resource->checkIsValidForUpdate(); // if it fails, ValidationException

        // update the Post object in the database
        $this->resourceMapper->update($resource);

        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts
        // perform the redirection. More or less:
        // header("Location: index.php?controller=posts&action=index")
        // die();
        $this->view->redirect("resources", "index");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Post object visible to the view
    $this->view->setVariable("resource", $resource);

    // render the view (/view/resources/add.php)
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
    $this->view->render("resources", "edit");
    }
  }

  /**
  * Action to delete an resource
  *
  * This action should only be called via HTTP POST
  *
  * @throws Exception if no id was provided
  * @throws Exception if no user is in session
  * @throws Exception if there is not any user with the provided id
  * @return void
  */
  public function delete() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing users requires login");
    }
    if ($this->currentUser->getUser_type()!=usertype::Administrator){
      throw new Exception("Not valid user. Editing resource requires Administrator");
    }

    // Get the user object from the database
    $idresource = $_REQUEST["idresource"];
    $resource = $this->resourceMapper->findById($idresource);

    // Does the user exist?
    if ($resource == NULL) {
      throw new Exception("no such resource with id: ".$idresource);
    }

    // Delete the user object from the database
    $this->resourceMapper->delete($resource);


    $this->view->setFlash(sprintf(i18n("Resource successfully deleted."),$resource->getIdresource()));

    $this->view->redirect("resources", "index");

  }

}

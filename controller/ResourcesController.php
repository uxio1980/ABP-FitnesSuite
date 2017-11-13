<?php
//file: controller/ResourcesController.php

require_once(__DIR__."/../model/Resource.php");
require_once(__DIR__."/../model/ResourceMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class ResourcesController
*
* Controller to make a CRUDL of Resources entities
*
* @author lipido <lipido@gmail.com>
*/
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

  /**
  * Action to list resources
  *
  * Loads all the resources from the database.
  * No HTTP parameters are needed.
  *
  * The views are:
  * <ul>
  * <li>resources/index (via include)</li>
  * </ul>
  */
  public function index() {

    // obtain the data from the database
    $resources = $this->resourceMapper->findAll();

    // put the array containing Resource object to the view
    $this->view->setVariable("resources", $resources);
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
      $this->view->render("resources", "index");
    }
  }

  /**
  * Action to view a given resource
  *
  * This action should only be called via GET
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>id: Id of the resource (via HTTP GET)</li>
  * </ul>
  *
  * The views are:
  * <ul>
  * <li>resources/view: If resource is successfully loaded (via include). Includes these view variables:</li>
  * <ul>
  *  <li>resource: The current Resource retrieved</li>
  * </ul>
  * </ul>
  *
  * @throws Exception If no such resource of the given id is found
  * @return void
  *
  */
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
    $this->view->render("resources", "view");

  }

  /**
  * Action to add a new resource
  *
  * When called via GET, it shows the add form
  * When called via POST, it adds the resource to the
  * database
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>title: Title of the resource (via HTTP POST)</li>
  * <li>content: Content of the post (via HTTP POST)</li>
  * </ul>
  *
  * The views are:
  * <ul>
  * <li>posts/add: If this action is reached via HTTP GET (via include)</li>
  * <li>posts/index: If post was successfully added (via redirect)</li>
  * <li>posts/add: If validation fails (via include). Includes these view variables:</li>
  * <ul>
  *  <li>post: The current Post instance, empty or
  *  being added (but not validated)</li>
  *  <li>errors: Array including per-field validation errors</li>
  * </ul>
  * </ul>
  * @throws Exception if no user is in session
  * @return void
  */
  public function add() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Adding resources requires login");
    }

    $resource = new Resource();

    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      // populate the resource object with data form the form
      $resource->setName($_POST["name"]);
      $resource->setDescription($_POST["description"]);
      $resource->setQuantity($_POST["quantity"]);

      try {
        // validate resource object
        $resource->checkIsValidForCreate(); // if it fails, ValidationException

        // save the resource object into the database
        $this->resourceMapper->save($resource);

        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts

        // perform the redirection. More or less:
        // header("Location: index.php?controller=resources&action=index")
        // die();
        $this->view->redirect("resources", "index");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // render the view (/view/resources/add.php)
    $this->view->render("resources", "add");

  }

  /**
  * Action to edit a resource
  *
  * When called via GET, it shows an edit form
  * including the current data of the resource.
  * When called via POST, it modifies the post in the
  * database.
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>id: Id of the post (via HTTP POST and GET)</li>
  * <li>title: Title of the post (via HTTP POST)</li>
  * <li>content: Content of the post (via HTTP POST)</li>
  * </ul>
  *
  * The views are:
  * <ul>
  * <li>posts/edit: If this action is reached via HTTP GET (via include)</li>
  * <li>posts/index: If post was successfully edited (via redirect)</li>
  * <li>posts/edit: If validation fails (via include). Includes these view variables:</li>
  * <ul>
  *  <li>post: The current Post instance, empty or being added (but not validated)</li>
  *  <li>errors: Array including per-field validation errors</li>
  * </ul>
  * </ul>
  * @throws Exception if no id was provided
  * @throws Exception if no user is in session
  * @throws Exception if there is not any post with the provided id
  * @throws Exception if the current logged user is not the author of the post
  * @return void
  */
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
    $this->view->render("resources", "edit");
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


    $this->view->setFlash(sprintf(i18n("Resource \"%s\" successfully deleted."),$resource->getIdresource()));

    $this->view->redirect("resources", "index");

  }

}

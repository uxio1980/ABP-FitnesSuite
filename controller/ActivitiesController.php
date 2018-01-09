<?php
//file: controller/ActivitysController.php

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/User_activity.php");
require_once(__DIR__."/../model/User_activityMapper.php");
require_once(__DIR__."/../model/Resource.php");
require_once(__DIR__."/../model/ResourceMapper.php");
require_once(__DIR__."/../model/Activity_resource.php");
require_once(__DIR__."/../model/Activity_resourceMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class ActivitysController
*
* Controller to make a CRUDL of Activitys entities
*
* @author lipido <lipido@gmail.com>
*/
class ActivitiesController extends BaseController {

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
  private $user_activityMapper;
  public function __construct() {
    parent::__construct();
    $this->user_activityMapper = new User_activityMapper();
    $this->activityMapper = new ActivityMapper();
    $this->userMapper = new UserMapper();
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

    if (isset($_POST["search"])) {
      $search = $_POST["search"];
      $filterby = "all";
      $activities = $this->activityMapper->searchAll($search);
    }else{
      $activities = $this->activityMapper->findAll();
    }
    // obtain the data from the database


    // put the array containing Activity object to the view
    $this->view->setVariable("activities", $activities);
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator) {
        $this->view->render("activities", "index_admin");
    }elseif (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Trainer){
        $activities = $this->activityMapper->findMyActivities($this->currentUser->getId());
        $this->view->setVariable("activities", $activities);
        $this->view->render("activities", "index_trainer");
    } else {
      $this->view->render("activities", "index");
    }
  }

  /**
  * Action to view a given activity
  *
  * This action should only be called via GET
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>id: Id of the activity (via HTTP GET)</li>
  * </ul>
  *
  * The views are:
  * <ul>
  * <li>activitys/view: If activity is successfully loaded (via include).  Includes these view variables:</li>
  * <ul>
  *  <li>activity: The current Activity retrieved</li>
  * </ul>
  * </ul>
  *
  * @throws Exception If no such activity of the given id is found
  * @return void
  *
  */
  public function view(){
    if (!isset($_GET["idactivity"])) {
      throw new Exception("idactivity is mandatory");
    }


      $activityid = $_GET["idactivity"];

    // Recuperar distintas actividades según usuario.
    $activity = $this->activityMapper->findById($activityid);
    $activity_resources = $this->activity_resourceMapper->findAll($activityid);
    $resources = array();
    if ($activity_resources !=NULL){
      foreach ($activity_resources as $activity_resource) {
        if ($activity_resource->getId() != $activity->getPlace()){
          $resource = $this->resourceMapper->findById($activity_resource->getIdresource());
          if ($resource != NULL && ($resource->getType() == resourcetype::Resource)){
            array_push($resources, $resource);
          }
        }
      }
    }
    $place = $this->resourceMapper->findById($activity->getPlace());
    // Recupera el array de rutas a las imágenes.
    $images = json_decode($activity->getImage());
    //$trainer = $this->activityMapper->findTrainerById($activity->getIduser());
    $trainer = $this->userMapper->findById2($activity->getIduser());
    if ($activity == NULL) {
      throw new Exception("->no such activity with id: ".$activityid);
    }

    if (!isset($this->currentUser)) {
        $isReserved = 0;
    }else{
      if($this->user_activityMapper->countByIdActivityAndIdUser($activityid,$this->currentUser->getId()) != 0){
          $isReserved = 1;
      }else{
          $isReserved = 0;
      }
    }

      $plazasOcupadas = $this->user_activityMapper->countAllByIdActivity($activityid);
      $plazasDisponibles = $activity->getSeats() - $plazasOcupadas;

    // put the Activity object to the view
      $this->view->setVariable("isReserved", $isReserved);
    $this->view->setVariable("activity", $activity);
    $this->view->setVariable("images", $images);
    $this->view->setVariable("trainer", $trainer);
    $this->view->setVariable("place", $place);
    $this->view->setVariable("resources", $resources);
      $this->view->setVariable("plazasDisponibles", $plazasDisponibles);

    // render the view (/view/activities/view.php)

      $this->view->render("activities", "view");

  }

  /**
  * Action to add a new activity
  *
  * When called via GET, it shows the add form
  * When called via POST, it adds the activity to the
  * database
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>title: Title of the activity (via HTTP POST)</li>
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
      throw new Exception("Not in session. Adding activitys requires login");
    }

    $activity = new Activity();
    $trainers = $this->userMapper->findAllTrainers();
    $places = $this->resourceMapper->findAllPlaces();

    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      $i = 0;
      //load images in server folder
      $dir_load = 'resources/images/';

      // populate the activity object with data form the form
      $activity->setIduser($_POST["id_user"]);
      $activity->setName($_POST["name"]);
      $activity->setDescription($_POST["description"]);
      $activity->setType($_POST["type"]);
      $activity->setPlace($_POST["place"]);
      $activity->setSeats($_POST["seats"]);
      // Asigna a la variable image un array con las rutas a todas las imágenes.
      if(count($_FILES['images']['name']) > 0){
        $images = array();
        $tmp = array();
        for($i=0; $i<count($_FILES['images']['name']); $i++) {
          $tmpFilePath = $_FILES['images']['tmp_name'][$i];
          if($tmpFilePath != ""){
            $filePath = $dir_load . date('d-m-Y-H-i-s').'-'.$_FILES['images']['name'][$i];
            array_push($images,$filePath);
            array_push($tmp,$tmpFilePath);
          }
        }
        $activity->setImage(json_encode($images));
      }

      try {
        // validate activity object
        $activity->checkIsValidForCreate(); // if it fails, ValidationException

        // save the activity object into the database
        $this->activityMapper->save($activity);

        if(count($_FILES['images']['name']) > 0){
          $files = json_decode($activity->getImage());
          for($i=0; $i<count($files); $i++) {
            move_uploaded_file($tmp[$i], $files[$i]);
          }
        }
        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts

        // perform the redirection. More or less:
        // header("Location: index.php?controller=activitys&action=index")
        // die();
        $this->view->setFlash(sprintf(i18n("Activity successfully added.")));
        $this->view->redirect("activities", "index");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Activity object visible to the view
    $this->view->setVariable("trainers", $trainers);
    $this->view->setVariable("places", $places);

    // render the view (/view/activitys/add.php)
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
      $this->view->render("activities", "add");
    }

  }

  /**
  * Action to edit a activity
  *
  * When called via GET, it shows an edit form
  * including the current data of the activity.
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
    if (!isset($_REQUEST["idactivity"])) {
      throw new Exception("A activity id is mandatory");
    }

    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing activitys requires login");
    }

    // Get the activity object from the database
    $idactivity = $_REQUEST["idactivity"];
    $activity = $this->activityMapper->findById($idactivity);
    $trainers = $this->userMapper->findAllTrainers();
    $places = $this->resourceMapper->findAllPlaces();
    // Does the activity exist?
    if ($activity == NULL) {
      throw new Exception("no such activity with id: ".$idactivity);
    }

    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      $i = 0;
      //load images in server folder
      $dir_load = 'resources/images/';

      // populate the activity object with data form the form
      $activity->setIduser($_POST["id_user"]);
      $activity->setName($_POST["name"]);
      $activity->setDescription($_POST["description"]);
      $activity->setType($_POST["type"]);
      $activity->setPlace($_POST["place"]);
      $activity->setSeats($_POST["seats"]);

      // Si no se edita mantiene las imágenes actuales.
      if($_FILES['images']['name'][0] == ""){
        $activity->setImage($activity->getImage());
      }// Sube las nuevas imágenes.
      elseif(count($_FILES['images']['name']) > 0){
        $images = array();
        $tmp = array();
        for($i=0; $i<count($_FILES['images']['name']); $i++) {
          $tmpFilePath = $_FILES['images']['tmp_name'][$i];
          if($tmpFilePath != ""){
            $filePath = $dir_load . date('d-m-Y-H-i-s').'-'.$_FILES['images']['name'][$i];
            array_push($images,$filePath);
            array_push($tmp,$tmpFilePath);
          }
        }
        $img = json_decode($activity->getImage());
        for($i=0; $i<count($img); $i++) {
          unlink($img[$i]);
        }
        $activity->setImage(json_encode($images));

      } else {
        $activity->setImage(NULL);
      }

      try {
        // validate Post object
        $activity->checkIsValidForUpdate(); // if it fails, ValidationException

        // update the Post object in the database
        $this->activityMapper->update($activity);

        if(count($_FILES['images']['name']) > 0){
          $files = json_decode($activity->getImage());
          for($i=0; $i<count($files); $i++) {
            move_uploaded_file($tmp[$i], $files[$i]);
          }
        }
        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts
        // perform the redirection. More or less:
        // header("Location: index.php?controller=posts&action=index")
        // die();
        $this->view->setFlash(sprintf(i18n("Activity successfully updated.")));
        $this->view->redirect("activities", "index");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Post object visible to the view
    $this->view->setVariable("activity", $activity);
    $this->view->setVariable("places", $places);
    $this->view->setVariable("trainers", $trainers);

    // render the view (/view/activitys/add.php)
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
      $this->view->render("activities", "edit");
    }
  }

  /**
  * Action to delete an activity
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
      throw new Exception("Not valid user. Editing activity requires Administrator");
    }

    // Get the user object from the database
    $idactivity = $_REQUEST["idactivity"];
    $activity = $this->activityMapper->findById($idactivity);

    // Does the user exist?
    if ($activity == NULL) {
      throw new Exception("no such activity with id: ".$idactivity);
    }

    // Delete the user object from the database
    $images = json_decode($activity->getImage());
    $this->activityMapper->delete($activity);

    if($images != NULL){
      for($i=0; $i<count($images); $i++) {
        unlink($images[$i]);
      }
    }

    $this->view->setFlash(sprintf(i18n("Activity successfully deleted") . ".",$activity->getIdactivity()));

    $this->view->redirect("activities", "index");

  }

}

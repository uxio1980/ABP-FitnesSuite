<?php
//file: controller/ActivitysController.php

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
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

  public function __construct() {
    parent::__construct();

    $this->activityMapper = new ActivityMapper();
    $this->userMapper = new UserMapper();
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

    // obtain the data from the database
    $activities = $this->activityMapper->findAll();

    // put the array containing Activity object to the view
    $this->view->setVariable("activities", $activities);
    if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
      $this->view->render("activities", "index_admin");
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
    $trainer = $this->activityMapper->findTrainerById($activity->getIduser());

    if ($activity == NULL) {
      throw new Exception("->no such activity with id: ".$activityid);
    }

    // put the Activity object to the view
    $this->view->setVariable("activity", $activity);
    $this->view->setVariable("trainer", $trainer);

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

    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      $i = 0;
      //load images in server folder
      $dir_load = 'resources/images/';

      // populate the activity object with data form the form
        $activity->setName($_POST["name"]);
        $activity->setDescription($_POST["description"]);
    	  $activity->setPrice($_POST["price"]);
        $activity->setUrlImage01(($_FILES["images"]["name"][0]?$i++."_".$this->currentDate."_".$_FILES["images"]["name"][0]:NULL));
    	  $activity->setUrlImage02(($_FILES["images"]["name"][1]?$i++."_".$this->currentDate."_".$_FILES["images"]["name"][1]:NULL));
    	  $activity->setUrlImage03(($_FILES["images"]["name"][2]?$i."_".$this->currentDate."_".$_FILES["images"]["name"][2]:NULL));

      // The user of the Activity is the currentUser (user in session)
      $activity->setUserLogin(new  User($this->currentUser->getLogin()));

      try {
        // validate activity object
        $activity->checkIsValidForCreate(); // if it fails, ValidationException

        // save the activity object into the database
        $this->activityMapper->save($activity);
        $j=0;

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
          $file_load = $dir_load . $j++ ."_" . $this->currentDate . "_" . basename($_FILES['images']['name']["$key"]);
          move_uploaded_file($_FILES['images']['tmp_name']["$key"], $file_load);
        }
        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts

        // perform the redirection. More or less:
        // header("Location: index.php?controller=activitys&action=index")
        // die();
        $this->view->redirect("activitys", "index");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Activity object visible to the view
    $this->view->setVariable("activity", $activity);

    // render the view (/view/activitys/add.php)
    $this->view->render("activities", "add");

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
      $activity->setPlace($_POST["place"]);
      $activity->setType($_POST["type"]);
      $activity->setSeats($_POST["seats"]);
      if($_FILES["image"]["name"][0]){
        $activity->setImage(($_FILES["image"]["name"][0]?$i++."_".$this->currentDate."_".$_FILES["image"]["name"][0]:NULL));
      }

      try {
        // validate Post object
        $activity->checkIsValidForUpdate(); // if it fails, ValidationException

        // update the Post object in the database
        $this->activityMapper->update($activity);
        $j=0;

        foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
          $file_load = $dir_load . $j++ ."_" . $this->currentDate . "_" . basename($_FILES['image']['name']["$key"]);
          move_uploaded_file($_FILES['image']['tmp_name']["$key"], $file_load);
        }
        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts
        // perform the redirection. More or less:
        // header("Location: index.php?controller=posts&action=index")
        // die();
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
    $this->view->setVariable("trainers", $trainers);

    // render the view (/view/activitys/add.php)
    $this->view->render("activities", "edit");
  }

  /**
  * Action to delete a post
  *
  * This action should only be called via HTTP POST
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>id: Id of the post (via HTTP POST)</li>
  * </ul>
  *
  * The views are:
  * <ul>
  * <li>posts/index: If post was successfully deleted (via redirect)</li>
  * </ul>
  * @throws Exception if no id was provided
  * @throws Exception if no user is in session
  * @throws Exception if there is not any post with the provided id
  * @throws Exception if the author of the post to be deleted is not the current user
  * @return void
  */
  public function delete() {
    if (!isset($_REQUEST["idactivity"])) {
      throw new Exception("idactivity is mandatory");
    }
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing activitys requires login");
    }

    // Get the activity object from the database
    $idactivity = $_REQUEST["idactivity"];
    $activity = $this->activityMapper->findById($idactivity);
  
    // Does the activity exist?
    if ($activity == NULL) {
      throw new Exception("no such activity with id: ".$idactivity);
    }
    var_dump($activity->getName()); 
    if (isset($_POST["submit"])) {
        if ($_POST["submit"] == "yes"){
          // Delete the activity object from the database
            $this->activityMapper->delete($activity);
            // POST-REDIRECT-GET
            // Everything OK, we will redirect the user to the list of artcles
        }
        // perform the redirection. More or less:
        // header("Location: index.php?controller=posts&action=index")
        // die();
        $activities = $this->activityMapper->findAll();
        $this->view->setVariable("activities", $activities);
        $this->view->redirect("activities", "index_admin");
    }
    $this->view->render("activities", "confirm_delete");

  }

}

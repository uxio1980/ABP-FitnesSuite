<?php
//file: controller/ArticlesController.php

require_once(__DIR__."/../model/Activity_schedule.php");
require_once(__DIR__."/../model/Activity_scheduleMapper.php");
require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class Activity_scheduleController
*
* Controller to make a CRUDL of activity_schedule entities
*
* @author lipido <lipido@gmail.com>
*/
class Activity_scheduleController extends BaseController {

  /**
  * Reference to the Activity_scheduleMapper to interact
  * with the database
  *
  * @var Activity_scheduleMapper
  */
  private $activity_scheduleMapper;
  private $activityMapper;
  private $date;
  private $currentDate;

  public function __construct() {
    parent::__construct();

    $this->activity_scheduleMapper = new Activity_scheduleMapper();
    $this->activityMapper = new ActivityMapper();
    $this->date = new DateTime();
    $this->currentDate = $this->date->getTimestamp();
  }

  /**
  * Action to list activity_schedules
  *
  * Loads all the schedule activities from the database.
  * No HTTP parameters are needed.
  *
  * The views are:
  * <ul>
  * <li>activity_schedule/index (via include)</li>
  * </ul>
  */
  public function index() {
    if (!isset($_GET["idactivity"])) {
      throw new Exception("id_activity is mandatory");
    }
    $id_activity = $_GET["idactivity"];
    //var_dump(1);
    //exit();
    // obtain the data from the database
  /*  if (isset($_GET["search"])) {
      $search = $_GET["search"];
      $articles = $this->articleMapper->searchAll($search);
    }else
    {
      $articles = $this->articleMapper->findAll();
    }
    */
    $activity = $this->activityMapper->findById($id_activity);
    $activity_schedules = $this->activity_scheduleMapper->searchAll($id_activity);
    // put the array containing Article object to the view
    $this->view->setVariable("activity_schedules", $activity_schedules);
    $this->view->setVariable("activity", $activity);
    // render the view (/view/activity_schedules/index.php)
    $this->view->render("activity_schedules", "index");
  }

  /**
  * Action to view a given article
  *
  * This action should only be called via GET
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>id: Id of the article (via HTTP GET)</li>
  * </ul>
  *
  * The views are:
  * <ul>
  * <li>articles/view: If article is successfully loaded (via include).  Includes these view variables:</li>
  * <ul>
  *  <li>article: The current Article retrieved</li>
  * </ul>
  * </ul>
  *
  * @throws Exception If no such article of the given id is found
  * @return void
  *
  */
  public function view(){
    if (!isset($_GET["idarticle"])) {
      throw new Exception("idarticle is mandatory");
    }

    $articleid = $_GET["idarticle"];

    // find the articles object in the database

    if (!isset($this->currentUser)) {
      $article = $this->articleMapper->findById($articleid);
    }else{
        //throw new Exception("->no: ".$articleid. " - ".  $this->currentUser->getLogin());
      $article = $this->articleMapper->findByIdWithChat($articleid, $this->currentUser->getLogin());
      if ($article == NULL) {$article = $this->articleMapper->findById($articleid);};
    }

    if ($article == NULL) {
      throw new Exception("->no such article with id: ".$articleid);
    }

    // put the Article object to the view
    $this->view->setVariable("article", $article);

    // check if chatline is already on the view (for example as flash variable)
    // if not, put an empty chatline for the view
    $chatline = $this->view->getVariable("chatline");
    $this->view->setVariable("chatline", ($chatline==NULL)?new ChatLine():$chatline);
    //$this->view->setVariable("chatline", ($chatline==NULL)?"chatline es null":"chatline no es null");


    // render the view (/view/articles/view.php)
    $this->view->render("articles", "view");

  }

  /**
  * Action to add a new article
  *
  * When called via GET, it shows the add form
  * When called via POST, it adds the article to the
  * database
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>title: Title of the article (via HTTP POST)</li>
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
      throw new Exception("Not in session. Adding activity schedules requires login");
    }

    if ($this->currentUser->getUser_type()!=usertype::Administrator) {
      throw new Exception("Adding activity schedules requires Administrator");
    }

    if (!isset($_GET["id_activity"])) {
      throw new Exception("id_activity is mandatory");
    }
    $id_activity = $_GET["id_activity"];
    $activity = $this->activityMapper->findById($id_activity);
    // Does the activity exist?
    if ($activity == NULL) {
      throw new Exception("no such activity with id: ".$id_activity);
    }
    $activity_schedule = new Activity_schedule();

    if (isset($_POST["submit"])) { // reaching via HTTP Post...

      // populate the article object with data form the form
        $activity_schedule->setActivity($activity);
        $activity_schedule->setDate($_POST["startdate"]);
        $activity_schedule->setStart_hour($_POST["start"]);
        $activity_schedule->setEnd_hour($_POST["end"]);
        $activity_schedule->setDuration($_POST["enddate"]);

      try {
        // validate article object
        $activity_schedule->checkIsValidForCreate(); // if it fails, ValidationException


        // save the activity schedule object into the database
        while ($activity_schedule->getDate() < $activity_schedule->getDuration()){
          var_dump($activity_schedule->getDate());
          $this->activity_scheduleMapper->save($activity_schedule);
          $date = $activity_schedule->getDate();
          $date = strtotime($date);
          $date = strtotime("+7 day", $date);
          $activity_schedule->setDate(date('Y-m-d',$date));
        }

        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts

        // perform the redirection. More or less:
        // header("Location: index.php?controller=articles&action=index")
        // die();
        $this->view->redirect("activity_schedule", "index", "idactivity=".$activity_schedule->getActivity()->getIdactivity());

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Article object visible to the view
    $this->view->setVariable("activity", $activity);

    // render the view (/view/activity_schedules/add.php)
    $this->view->render("activity_schedules", "add");

  }

  /**
  * Action to edit a article
  *
  * When called via GET, it shows an edit form
  * including the current data of the article.
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
    if (!isset($_REQUEST["activity_schedule"])) {
      throw new Exception("An activity schedule id is mandatory");
    }

    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing articles requires login");
    }

    // Get the activity_schedule object from the database
    $idactivity_schedule = $_REQUEST["activity_schedule"];
    $activity_schedule = $this->activity_scheduleMapper->findById($idactivity_schedule);

    // Does the article exist?
    if ($activity_schedule == NULL) {
      throw new Exception("no such activity schedule with id: ".$idactivity_schedule);
    }

    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      try {

        // populate the public info object with data form
        $activity_schedule->setDate($_POST["date"]);
        $activity_schedule->setStart_hour($_POST["start"]);
        $activity_schedule->setEnd_hour($_POST["end"]);

        // validate Post object
        $activity_schedule->checkIsValidForUpdate(); // if it fails, ValidationException
        // update the Post object in the database
        $this->activity_scheduleMapper->update($activity_schedule);

        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts
        // perform the redirection. More or less:
        // header("Location: index.php?controller=posts&action=index")
        // die();
        $this->view->redirect("activity_schedule", "index", "idactivity=".$activity_schedule->getActivity()->getIdactivity());

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Post object visible to the view
    $this->view->setVariable("activity_schedule", $activity_schedule);

    // render the view (/view/articles/add.php)
    $this->view->render("activity_schedules", "edit");
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
    if (!isset($_REQUEST["id_activity_schedule"])) {
      throw new Exception("id_activity_schedule is mandatory");
    }
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing id_activity_schedule requires login");
    }

    // Get the id_activity_schedule object from the database
    $id_activity_schedule = $_REQUEST["id_activity_schedule"];
    $activity_schedule = $this->activity_scheduleMapper->findById($id_activity_schedule);

    // Does the activity_schedule exist?
    if ($activity_schedule == NULL) {
      throw new Exception("no such activity_schedule with id: ".$id_activity_schedule);
    }
    $id_activity = $activity_schedule->getActivity()->getIdactivity();
    $user_type = ($this->currentUser->getUser_type());
    // Check if the the currentUser (in Session) is Administrator
    if ($user_type != usertype::Administrator) {
      throw new Exception("current user is not Administrator");
    }
    // Delete the activity_schedule object from the database
    $this->activity_scheduleMapper->delete($activity_schedule);

    // POST-REDIRECT-GET
    // Everything OK, we will redirect the user to the list of artcles

    // perform the redirection. More or less:
    // header("Location: index.php?controller=$id_activity_schedule&action=index")
    // die();
    $this->view->redirect("activity_schedule", "index", "idactivity=".$id_activity);

    //$this->view->setVariable("article", $article);
    //$this->view->render("articles", "confirm_delete");

  }

  public function listarticles() {
    // obtain the data from the database
    $articles = $this->articleMapper->findByUser($this->currentUser->getLogin());

    // put the array containing Article object to the view
    $this->view->setVariable("articles", $articles);

    // render the view (/view/articles/index.php)
    $this->view->render("users", "articles");


  }

}

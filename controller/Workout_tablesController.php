<?php

require_once(__DIR__."/../model/Exercise.php");
require_once(__DIR__."/../model/ExerciseMapper.php");
require_once(__DIR__."/../model/Exercise_tableMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/Workout_tableMapper.php");
require_once(__DIR__."/../model/Workout_table.php");
require_once(__DIR__."/../model/User_table.php");
require_once(__DIR__."/../model/User_tableMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");
require_once(__DIR__."/../model/Exercise_table.php");


class Workout_tablesController extends BaseController {

  private $exercise_tableMapper;
  private $workout_tableMapper;
  private $user_tableMapper;
  private $userMapper;
  private $exerciseMapper;

  public function __construct() {
    parent::__construct();

    $this->exercise_tableMapper = new Exercise_tableMapper();
    $this->workout_tableMapper = new Workout_tableMapper();
    $this->user_tableMapper = new User_tableMapper();
    $this->userMapper = new UserMapper();
    $this->exerciseMapper = new ExerciseMapper();
  }

  /**
  * Action to list workout tables
  */
  public function index() {

      if (isset($this->currentUser) && ($this->currentUser->getUser_type() == usertype::Trainer)){

          $tables = $this->workout_tableMapper->findAll();

          $this->view->setVariable("tables", $tables);

          $this->view->render("workout_tables", "index_trainer");

      } else {
          if (isset($this->currentUser) && ($this->currentUser->getUser_type() != usertype::Trainer)) {
              $tables_user = $this->user_tableMapper->findByUser($this->currentUser->getId());
              $this->view->setVariable("tables", $tables_user);
              $this->view->render("workout_tables", "index");
          }
      }
  }

    public function view(){

        if (!isset($_GET["id_workout"])) {
            throw new Exception("id_workout is mandatory");
        }

        $id_workout = $_GET["id_workout"];
        $user_table = $this->user_tableMapper->findByUserAndTable($this->currentUser->getId(),$id_workout);
        // Recuperar distintas actividades según usuario.
        $workout_table = $this->workout_tableMapper->findById($id_workout);

        $exercises = $this->exercise_tableMapper->findAll($id_workout);

        if ($workout_table == NULL) {
            throw new Exception("->no such workout_table with id: ".$id_workout);
        }

        // put the Activity object to the view
        $this->view->setVariable("table", $workout_table);
        $this->view->setVariable("exercises", $exercises);

        // render the view (/view/activities/view.php)
        if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Trainer){
            $this->view->render("workout_tables", "view-trainer");
        } else {

            $this->view->setVariable("user_table", $user_table);
            $this->view->render("workout_tables", "view");

        }
    }
    public function add() {
        if (!isset($this->currentUser) || $this->currentUser->getUser_type() != usertype::Trainer ) {
            throw new Exception("Not in session. Adding activitys requires login like Trainer");
        }

        $workout_table = new Workout_table();

        $exercises = $this->exerciseMapper->findAll();

        if (isset($_POST["submit"])) { // reaching via HTTP Post...
            $i = 0;
            $workout_table->setUser($this->currentUser);
            $workout_table->setName($_POST["name"]);
            $workout_table->setType($_POST["type"]);
            $workout_table->setDescription($_POST["description"]);
            try {
                // validate activity object

                $workout_table->checkIsValidForCreate(); // if it fails, ValidationException

                // save the activity object into the database
                $this->workout_tableMapper->save($workout_table);
                var_dump($workout_table);
                $this->view->redirect("workout_tables", "index");

            }catch(ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
            }
        }

        // Put the Activity object visible to the view
        $this->view->setVariable("exercises", $exercises);

        // render the view (/view/activitys/add.php)
        $this->view->render("workout_tables", "add");

    }


    public function edit() {
        if (!isset($_REQUEST["id_workout"])) {
            throw new Exception("A workout id is mandatory");
        }

        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Editing workout tables requires login");
        }

        // Get the activity object from the database
        $id_workout = $_REQUEST["id_workout"];
        $workout_table = $this->workout_tableMapper->findById($id_workout);

        if ($workout_table == NULL) {
            throw new Exception("no such activity with id: ".$id_workout);
        }

        if (isset($_POST["submit"])) { // reaching via HTTP Post...

            // populate the activity object with data form the form
            $workout_table->setUser($this->currentUser);
            if(!empty($_POST["name"])){
            $workout_table->setName($_POST["name"]);
            }
            if(!empty($_POST["description"])) {
                $workout_table->setDescription($_POST["description"]);
            }
            if(!empty($_POST["type"])) {
                $workout_table->setType($_POST["type"]);
            }

            try {
                // validate Post object
                $workout_table->checkIsValidForUpdate(); // if it fails, ValidationException

                // update the Post object in the database
                $this->workout_tableMapper->update($workout_table);


                $this->view->redirect("workout_tables", "index");

            }catch(ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
            }
        }

        // Put the Post object visible to the view
        $this->view->setVariable("workout_table", $workout_table);

        // render the view (/view/activitys/add.php)
        $this->view->render("workout_tables", "edit");
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
        if ($this->currentUser->getUser_type()!=usertype::Trainer){
            throw new Exception("Not valid user. Remove workout table requires Trainer");
        }

        // Get the user object from the database
        $id_workout = $_REQUEST["id_workout"];
        $workout_table = $this->workout_tableMapper->findById($id_workout);

        // Does the user exist?
        if ($workout_table == NULL) {
            throw new Exception("no such workout_table with id: ".$id_workout);
        }


        $this->workout_tableMapper->delete($workout_table);

        $this->view->setFlash(sprintf(i18n("Workout table \"%s\" successfully deleted."),$workout_table->getId()));

        $this->view->redirect("workout_tables", "index");

    }

}

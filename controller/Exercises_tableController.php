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


class Exercises_tableController extends BaseController {

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

    public function index() {
        if (!isset($_REQUEST["id_workout"])) {
            throw new Exception("A workout table id is mandatory");
        }

        if (!isset($this->currentUser) || $this->currentUser->getUser_type() != usertype::Trainer) {
            throw new Exception("Not in session. Editing workout tables exercises requires login like a trainer");
        }
        $id_workout = $_REQUEST["id_workout"];
        $table_exercises = $this->exercise_tableMapper->findAll($id_workout);

        $this->view->setVariable("id_workout", $id_workout);
        $this->view->setVariable("table_exercises", $table_exercises);

            $this->view->render("exercises_table", "index");

    }

    public function view(){

        if (!isset($_GET["id_workout"])) {
            throw new Exception("id_workout is mandatory");
        }

        $id_workout = $_GET["id_workout"];
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
        }
    }

    public function add() {
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Adding activities requires login");
        }
        if (!isset($_REQUEST["id_workout"])) {
            throw new Exception("An Workout table id is required");
        }
        $id_workout = $_REQUEST["id_workout"];
        $exercises = $this->exercise_tableMapper->findExercisesNotInTable($id_workout);

        if (isset($_POST["submit"])) { // reaching via HTTP Post...
            $exercise_table = new Exercise_table();

            // populate the activity object with data form the form

            $exercise = $this->exerciseMapper->findById($_POST["id_exercise"]);

            $exercise_table->setExercise($exercise);
            $exercise_table->setWorkout($_POST["id_workout"]);
            $exercise_table->setSeries($_POST["series"]);
            $exercise_table->setRepetitions($_POST["repetitions"]);

            try {
                // validate activity object
                $exercise_table->checkIsValidForCreate(); // if it fails, ValidationException

                // save the activity object into the database
                $this->exercise_tableMapper->save($exercise_table);

                $this->view->redirect("exercises_table", "index","id_workout=".$_POST["id_workout"]);


            }catch(ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
            }
        }
        // Put the Activity object visible to the view
        $this->view->setVariable("id_workout", $id_workout);
        $this->view->setVariable("exercises", $exercises);

        // render the view (/view/activitys/add.php)
        $this->view->render("exercises_table", "add");
    }

    public function edit() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("An id is mandatory");
        }

        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Editing  requires login");
        }
        $id = $_REQUEST["id"];
        $exercise_table = $this->exercise_tableMapper->findById($id);

        $exercise = $exercise_table->getExercise();
        $exercises = $this->exercise_tableMapper->findExercisesNotInTable($exercise->getId());

        if (isset($_POST["submit"])) {
            // Get the activity object from the database
            $exercise_table->setSeries($_POST["series"]);
            $exercise_table->setRepetitions($_POST["repetitions"]);

            try {
                // validate Post object
                $exercise_table->checkIsValidForUpdate(); // if it fails, ValidationException

                // update the Post object in the database
                $this->exercise_tableMapper->update($exercise_table);

                $this->view->redirect("exercises_table", "index","id_workout=".$_POST["id_workout"]);

            }catch(ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
            }
        }

        // Put the Post object visible to the view
        $this->view->setVariable("exercise", $exercise);
        $this->view->setVariable("exercises", $exercises);
        $this->view->setVariable("exercise_table", $exercise_table);

        // render the view (/view/activitys/add.php)
        $this->view->render("exercises_table", "edit");
    }

    public function delete() {
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. delete exercises from a workout table requires login like trainer");
        }
        if ($this->currentUser->getUser_type()!=usertype::Trainer ){
            throw new Exception("Not in session. delete exercises from a workout table requires login like trainer");

        }

        // Get the exercise object from the database
        $id = $_REQUEST["id"];
        $exercise_table = $this->exercise_tableMapper->findById($id);

        // Does the exercise exist?
        if ($exercise_table == NULL) {
            throw new Exception("no such exercise with id: ".$id);
        }else{
            $this->exercise_tableMapper->delete($exercise_table);
            $this->view->setFlash(sprintf(i18n("Exercise \"%s\" with name \"%s\" successfully deleted."),
                $exercise_table->getExercise()->getId(),$exercise_table->getExercise()->getName()));
        }


        $this->view->redirect("workout_tables", "index");

    }


}

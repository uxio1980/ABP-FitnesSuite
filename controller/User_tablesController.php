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


class User_tablesController extends BaseController {

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
        if (!isset($_REQUEST["login"])) {
            throw new Exception("A login id is mandatory");
        }

        if (!isset($this->currentUser) || $this->currentUser->getUser_type() != usertype::Trainer) {
            throw new Exception("Not in session. View  workout tables  requires login like a trainer");
        }

        $id_user = $_REQUEST["login"];

        $table_exercises = $this->user_tableMapper->findByUser($id_user);

        $this->view->setVariable("table_exercises", $table_exercises);

        $this->view->render("user_tables", "index");

    }

    public function add() {
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Adding activities requires login");
        }
        if (!isset($_REQUEST["login"])) {
            throw new Exception("An user id is required");
        }
        $id_user = $_REQUEST["login"];

        $user = $this->userMapper->findById2($id_user);

        if($user->getUser_type() == usertype::AthletePEF){

            $workout_tables = $this->user_tableMapper->searchNotAssignedTablesPEF($id_user);
        }else{
            if($user->getUser_type() == usertype::AthleteTDU){
                $workout_tables = $this->user_tableMapper->searchNotAssignedTablesTDU($id_user);
            }
        }


        if (isset($_POST["submit"])) { // reaching via HTTP Post...

            $user_table = new User_table();

            $user = new User();

            $workout_table = new Workout_table();

            $user->setId($id_user);

            $workout_table->setId($_POST["id_workout"]);

            $user_table->setUser($user);

            $user_table->setWorkout_table($workout_table);


            try {

                $this->user_tableMapper->save($user_table);

                $this->view->redirect("user_tables", "index","login=".$id_user);


            }catch(ValidationException $ex) {

                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
            }
        }
        // Put the Activity object visible to the view
        $this->view->setVariable("workout_tables", $workout_tables);
        $this->view->setVariable("id_user", $id_user);
        // render the view (/view/activitys/add.php)
        $this->view->render("user_tables", "add");
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

        $user_table = $this->user_tableMapper->findById($id);

        // Does the exercise exist?
        if ($user_table == NULL) {
            throw new Exception("no such user table with id: ".$id);
        }else{
            $this->user_tableMapper->delete($user_table);
            //$this->view->setFlash(sprintf(i18n("Table \"%s\" of user \"%s\" successfully deleted."),
            //  $user_table->getWorkout_table()->getName(),$user_table->getUser()->getName()));
        }

        //$this->view->redirect("user_tables", "index");

        $this->view->redirect("user_tables", "index","login=".$user_table->getUser()->getId());

    }
}

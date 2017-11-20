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


class Workout_tablesController extends BaseController {

  private $exercise_tableMapper;
  private $workout_tableMapper;
  private $user_tableMapper;
  private $userMapper;

  public function __construct() {
    parent::__construct();

    $this->exercise_tableMapper = new Exercise_tableMapper();
    $this->workout_tableMapper = new Workout_tableMapper();
    $this->user_tableMapper = new User_tableMapper();
    $this->userMapper = new UserMapper();
  }

  /**
  * Action to list workout tables
  */
  public function index() {

      if (isset($this->currentUser) && ($this->currentUser->getUser_type() == usertype::Trainer ||
              $this->currentUser->getUser_type() == usertype::Administrator)){

          $tables = $this->workout_tableMapper->findAll();

          $this->view->setVariable("tables", $tables);

          $this->view->render("workout_tables", "index_trainer");
;
      } else {
          $tables_user = $this->user_tableMapper->findByUser($this->currentUser->getId());
          $this->view->setVariable("tables", $tables_user);
          $this->view->render("workout_tables", "index");
      }
  }

    public function view(){
        if (!isset($_GET["id_workout"])) {
            throw new Exception("id_workout is mandatory");
        }

        $id_workout = $_GET["id_workout"];

        // Recuperar distintas actividades según usuario.
        $table = $this->workout_tableMapper->findById($id_workout);


        //

        $place = $this->resourceMapper->findById($activity->getPlace());
        // Recupera el array de rutas a las imágenes.
        $images = json_decode($activity->getImage());
        $trainer = $this->activityMapper->findTrainerById($activity->getIduser());

        if ($activity == NULL) {
            throw new Exception("->no such activity with id: ".$activityid);
        }

        // put the Activity object to the view
        $this->view->setVariable("activity", $activity);
        $this->view->setVariable("images", $images);
        $this->view->setVariable("trainer", $trainer);
        $this->view->setVariable("place", $place);

        // render the view (/view/activities/view.php)
        if (isset($this->currentUser) && $this->currentUser->getUser_type() == usertype::Administrator){
            $this->view->render("activities", "view");
        } else {
            $this->view->render("activities", "view");
        }
    }


}

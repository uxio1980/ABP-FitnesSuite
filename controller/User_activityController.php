<?php

require_once(__DIR__."/../model/User_activity.php");
require_once(__DIR__."/../model/User_activityMapper.php");
require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
/*require_once(__DIR__."/../model/Resource.php");
require_once(__DIR__."/../model/ResourceMapper.php");
require_once(__DIR__."/../model/Activity_resource.php");
require_once(__DIR__."/../model/Activity_resourceMapper.php");*/
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class User_activityController extends BaseController {

  private $userMapper;
  private $activityMapper;
  private $resourceMapper;
  private $user_activityMapper;

  public function __construct() {
    parent::__construct();
    $this->activityMapper = new ActivityMapper();
    $this->userMapper = new UserMapper();
    $this->user_activityMapper = new User_activityMapper();
  }

    public function add() {
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Adding user_activities requires login");
        }
        if (!isset($_GET["id_activity"])) {
          throw new Exception("idactivity is mandatory");
        }
        $idactivity = $_GET["id_activity"];

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
        //$this->view->setVariable("workout_tables", $workout_tables);
        //$this->view->setVariable("activity", $activity);
        // render the view (/view/activitys/add.php)
        //$this->view->render("activities", "view","idactivity="  . $idactivity);
        $this->view->redirect("activities", "view","idactivity="  . $idactivity);
    }
}

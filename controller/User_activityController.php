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

        if($this->user_activityMapper->countByIdActivityAndIdUser($idactivity,$this->currentUser->getId()) != 0){
            Throw new Exception("Usted ya ha reservado esta actividad");
        }

        $currentActivity = $this->activityMapper->findById($idactivity);

        if($this->user_activityMapper->countAllByIdActivity($idactivity) == $currentActivity->getSeats()){
            throw new Exception("Actividad sin plazas disponibles");
        }
        $user_activity = new User_activity();
        $user_activity->setUser($this->currentUser);
        $user_activity->setActivity($currentActivity);
        $this->user_activityMapper->save($user_activity);

        $this->view->redirect("activities", "view","idactivity="  . $idactivity);
    }

    public function delete() {
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. delete user_activity requires login ");
        }
        if ($this->currentUser->getUser_type()!=usertype::AthletePEF && $this->currentUser->getUser_type()!=usertype::AthleteTDU ){
            throw new Exception("Not in session. delete user_activity requires login like athlete");

        }

        // Get the exercise object from the database
        $id_activity = $_REQUEST["id_activity"];

        $user_activity = $this->user_activityMapper->findByIdActivityAndIdUser($id_activity, $this->currentUser->getId());

        // Does the exercise exist?
        if ($user_activity == NULL) {
            throw new Exception("no such user activity with id activity: ".$id_activity);
        }else{
            $this->user_activityMapper->delete($user_activity);
            //$this->view->setFlash(sprintf(i18n("Table \"%s\" of user \"%s\" successfully deleted."),
            //  $user_table->getWorkout_table()->getName(),$user_table->getUser()->getName()));
        }

        //$this->view->redirect("user_tables", "index");

        $this->view->redirect("activities", "view","idactivity="  . $id_activity);

    }
}

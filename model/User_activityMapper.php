<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/User_activity.php");
/**
* Class User_activityMapper
*
* Database interface for user_activity entities
*
* @author lipido <lipido@gmail.com>
*/
class User_activityMapper {
  /**
  * Reference to the PDO connection
  * @var PDO
  */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }


    public function save(User_activity $user_activity) {
        $stmt = $this->db->prepare("INSERT INTO user_activity (id, id_user, id_activity)
            values (0,?,?)");
        $stmt->execute(array($user_activity->getUser()->getId(),$user_activity->getActivity()->getIdactivity()));
    }


  /**
  * Retrieves all trainers
  *
  *
  * @throws PDOException if a database error occurs
  * @return mixed Array of User trainers instances
  */
  public function findByIdActivity($id) {
    $stmt = $this->db->prepare("SELECT U_A.id as 'U_A.id_user_activity',
        U.id as 'U.id', A.id as 'A.id',
        U.name as 'U.name', U.description as 'U.description',
        U.surname as 'U.surname',
        A.name as 'A.name', A.description as 'A.description',
        U_A.*, U.*, A.* FROM user_activity U_A
        	LEFT JOIN user U ON U_A.id_user=U.id
            LEFT JOIN activity A ON U_A.id_activity=A.id
        WHERE U_A.id_activity=?");
    $stmt->execute(array($id));
    $users_activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $user_activities = array();

    foreach ($users_activities_db as $user_activity) {
      $usuario = new User($user_activity["U.id"],$user_activity["login"],$user_activity["U.name"],NULL,$user_activity["email"],
        $user_activity["description"],$user_activity["profile_image"],$user_activity["surname"]);
      $actividad = new Activity($user_activity["A.id"],NULL,$user_activity["A.name"],$user_activity["A.description"],
      $user_activity["type"],$user_activity["place"],$user_activity["seats"], $user_activity["image"]);
      //array_push($user_activities, new User_activity(,$user_activity["phone"],null,$user_activity["user_type"]));
      array_push($user_activities, new User_activity($user_activity["U_A.id_user_activity"],$usuario, $actividad));

    }
    return $user_activities;
  }

  /**
  * Retrieves all activities
  *
  *
  * @throws PDOException if a database error occurs
  * @return mixed Array of User trainers instances
  */
  public function findByIdUser($id) {
    $stmt = $this->db->prepare("SELECT U_A.id as 'U_A.id_user_activity',
        U.id as 'U.id', A.id as 'A.id',
        U.name as 'U.name', U.description as 'U.description',
        U.surname as 'U.surname',
        A.name as 'A.name', A.description as 'A.description',
        U_A.*, U.*, A.* FROM user_activity U_A
          LEFT JOIN user U ON U_A.id_user=U.id
            LEFT JOIN activity A ON U_A.id_activity=A.id
        WHERE U_A.id_user=?");
    $stmt->execute(array($id));
    $users_activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $user_activities = array();

    foreach ($users_activities_db as $user_activity) {
      $usuario = new User($user_activity["U.id"],$user_activity["login"],$user_activity["U.name"],NULL,$user_activity["email"],
        $user_activity["description"],$user_activity["profile_image"],$user_activity["surname"]);
      $actividad = new Activity($user_activity["A.id"],NULL,$user_activity["A.name"],$user_activity["A.description"],
      $user_activity["type"],$user_activity["place"],$user_activity["seats"], $user_activity["image"]);
      //array_push($user_activities, new User_activity(,$user_activity["phone"],null,$user_activity["user_type"]));
      array_push($user_activities, new User_activity($user_activity["U_A.id_user_activity"],$usuario, $actividad));

    }
    return $user_activities;
  }

  public function findDaysActivitiesByIdUser($id_user) {

      $stmt = $this->db->prepare("SELECT distinct daysActivity.id_activity ,
        daysActivity.nameofday, daysActivity.start_hour, daysActivity.end_hour
        FROM
          	(SELECT DAYNAME(A_S.date) as nameofday, A_S.*
               FROM `activity_schedule` A_S
               LEFT JOIN user_activity U_A ON A_S.id_activity=U_A.id_activity
               WHERE U_A.id_user=?
           	 and date >= NOW()
           	 ORDER BY `date` ASC  ) daysActivity");
      $stmt->execute(array($id_user));
      $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if($count != null) {
          return $count;
      } else {
          return NULL;
      }
  }

  /**
  * Retrieves all trainers
  *
  *
  * @throws PDOException if a database error occurs
  * @return mixed Array of User trainers instances
  */
  public function findUsersByIdActivity($id) {
    $stmt = $this->db->prepare("SELECT U_A.id as 'U_A.id_user_activity',
        U.id as 'U.id', A.id as 'A.id',
        U.name as 'U.name', U.description as 'U.description',
        U.surname as 'U.surname',
        A.name as 'A.name', A.description as 'A.description',
        U_A.*, U.*, A.* FROM user_activity U_A
          LEFT JOIN user U ON U_A.id_user=U.id
            LEFT JOIN activity A ON U_A.id_activity=A.id
        WHERE U_A.id_activity=?");
    $stmt->execute(array($id));
    $users_activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $users = array();

    foreach ($users_activities_db as $user_activity) {
      $usuario = new User($user_activity["U.id"],$user_activity["login"],$user_activity["U.name"],NULL,$user_activity["email"],
        $user_activity["description"],$user_activity["profile_image"],$user_activity["surname"]);
      array_push($users, $usuario);

    }

    return $users;
  }

    public function countAllByIdActivity($id_Activity) {

        $stmt = $this->db->prepare("SELECT COUNT(*) FROM user_activity WHERE id_activity=?");
        $stmt->execute(array($id_Activity));
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        if($count != null) {
            return $count["COUNT(*)"];
        } else {
            return 0;
        }
    }

    public function countByIdActivityAndIdUser($id_Activity, $id_User) {

        $stmt = $this->db->prepare("SELECT COUNT(*) FROM user_activity WHERE id_activity=? AND id_user=?");
        $stmt->execute(array($id_Activity, $id_User));
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        if($count != null) {
            return $count["COUNT(*)"];
        } else {
            return 0;
        }
    }
    public function findByIdActivityAndIdUser($id_Activity, $id_User) {

        $stmt = $this->db->prepare("SELECT * FROM user_activity WHERE id_activity=? AND id_user=?");
        $stmt->execute(array($id_Activity, $id_User));
        $user_activityDB = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user_activityDB != null){
            $user = new User($id_User);
            $activity = new Activity($id_Activity);
            return new User_activity($user_activityDB["id"],$user,$activity);
        }else{
            return null;
        }

    }

    public function delete(User_activity $user_activity) {
        $stmt = $this->db->prepare("DELETE from user_activity WHERE id=?");
        $stmt->execute(array( $user_activity->getId()));
    }

}

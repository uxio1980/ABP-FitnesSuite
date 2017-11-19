<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Activity_schedule.php");
require_once(__DIR__."/../model/Activity.php");
/**
* Class UserMapper
*
* Database interface for Activity_schedule entities
*
* @author lipido <lipido@gmail.com>
*/
class Activity_scheduleMapper {
  /**
  * Reference to the PDO connection
  * @var PDO
  */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }
  /**
  * Saves a Activity_schedule into the database
  *
  * @param Activity_schedule $activity_schedule The Activity_schedule to be saved
  * @throws PDOException if a database error occurs
  * @return void $login=NULL, $name= NULL,$password=NULL, $email=NULL, $description=NULL
  */
  public function save(Activity_schedule $activity_schedule) {
    $stmt = $this->db->prepare("INSERT INTO activity_schedule (id, id_activity,
      date, start_hour, end_hour) values (0,?,?,?,?)");
      $stmt->execute(array($activity_schedule->getActivity()->getIdActivity(),
      $activity_schedule->getDate(), $activity_schedule->getStart_hour(),
      $activity_schedule->getEnd_hour()));
    }

    /**
    * Updates a Activity_schedule in the database
    *
    * @param Activity_schedule $user The Activity_schedule to be updated
    * @throws PDOException if a database error occurs
    * @return void
    */
    public function update(Activity_schedule $activity_schedule) {

      $stmt = $this->db->prepare("UPDATE activity_schedule set id_activity=?, date=?,
        start_hour=?, end_hour=? where id=?");
        $n = $stmt->execute(array($activity_schedule->getActivity()->getIdActivity(), $activity_schedule->getDate(),
        $activity_schedule->getStart_hour(), $activity_schedule->getEnd_hour(), $activity_schedule->getId()));

      }

      /**
       * Deletes an Activity_schedule into the database
       *
       * @param Activity_schedule $user The Activity_schedule to be deleted
       * @throws PDOException if a database error occurs
       * @return void
       */
      public function delete(Activity_schedule $activity_schedule) {
        $stmt = $this->db->prepare("DELETE from activity_schedule WHERE id=?");
        $stmt->execute(array($activity_schedule->getId()));
      }

      /**
      * Loads a Activity_schedule from the database given its id
      *
      * @throws PDOException if a database error occurs
      * @return Activity_schedule The Activity_schedule instances. NULL
      * if the Activity_schedule is not found
      */
      public function findById($id_activity){

        $stmt = $this->db->prepare("SELECT A_S.id as idA_S, A.id as idA, A_S.*, A.*  FROM activity_schedule A_S LEFT JOIN activity A ON A_S.id_activity=A.id WHERE A_S.id=?");
        $stmt->execute(array($id_activity));
        $activity_schedule = $stmt->fetch(PDO::FETCH_ASSOC);
        if($activity_schedule != null) {
          $activity = new Activity($activity_schedule["idA"], $activity_schedule["id_user"], $activity_schedule["name"], $activity_schedule["description"], $activity_schedule["place"], $activity_schedule["type"], $activity_schedule["seats"]);
          return new Activity_schedule($activity_schedule["idA_S"],
          $activity, $activity_schedule["date"],
          $activity_schedule["start_hour"], $activity_schedule["end_hour"]);
        } else {
          return NULL;
        }
      }

       /**
       * Retrieves all activity_schedules
       *
       * @throws PDOException if a database error occurs
       * @return mixed Array of activity_schedule instances
       */
      public function findAll() {
        $stmt = $this->db->query("SELECT * FROM activity_schedule");
        $activity_schedules_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $activity_schedules = array();

        foreach ($activity_schedules_db as $activity_schedule) {
          array_push($activity_schedules, new Activity_schedule($activity_schedules["id"],
          $activity_schedules["id_activity"], $activity_schedules["date"],
          $activity_schedules["start_hour"], $activity_schedules["end_hour"]));
        }
        return $activity_schedules;
    }

    /**
    * Retrieves activity_schedules
    *
    *
    * @throws PDOException if a database error occurs
    * @return mixed Array of activity_schedule instances
    */
    public function searchAll($value) {
      $stmt = $this->db->prepare("SELECT A_S.id as idA_S, A.id as idA, A_S.*, A.*  FROM activity_schedule A_S LEFT JOIN activity A ON A_S.id_activity=A.id WHERE id_activity=:search");
      //$stmt = $this->db->query("SELECT * FROM activity_schedule");
      $stmt->execute(array($value));
        $activity_schedules_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $activity_schedules = array();

        foreach ($activity_schedules_db as $activity_schedule) {
          $activity = new Activity($activity_schedule["id_activity"],
          $activity_schedule["id_user"], $activity_schedule["name"],
          $activity_schedule["description"], $activity_schedule["place"],
          $activity_schedule["type"], $activity_schedule["seats"]);

          $a_s = new Activity_schedule($activity_schedule["idA_S"],
          $activity,
          $activity_schedule["date"],
          $activity_schedule["start_hour"],
          $activity_schedule["end_hour"]
        );
        array_push($activity_schedules, $a_s);
      }

      return $activity_schedules;
    }

    /**
    * Retrieves activity_schedules
    *
    *
    * @throws PDOException if a database error occurs
    * @return mixed Array of activity_schedule instances
    */
    public function search2NextEvents() {
      $stmt = $this->db->query("SELECT A_S.id as asId, A_S.*, A.*
        FROM activity_schedule A_S
        LEFT JOIN activity A ON A_S.id_activity=A.id
        WHERE STR_TO_DATE(CONCAT(DATE_FORMAT(A_S.date, '%Y-%m-%d'), A_S.start_hour), '%Y-%m-%d %H:%i:%s') >=NOW() LIMIT 2");
      $activity_schedules_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $activity_schedules = array();

        foreach ($activity_schedules_db as $activity_schedule) {
          $activity = new Activity($activity_schedule["id_activity"],
          $activity_schedule["id_user"], $activity_schedule["name"],
          $activity_schedule["description"], $activity_schedule["place"],
          $activity_schedule["type"], $activity_schedule["seats"], $activity_schedule["image"]);
          $a_s = new Activity_schedule($activity_schedule["asId"],
          $activity,
          $activity_schedule["date"],
          $activity_schedule["start_hour"],
          $activity_schedule["end_hour"]
        );
        array_push($activity_schedules, $a_s);
      }

      return $activity_schedules;
    }
}

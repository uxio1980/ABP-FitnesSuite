<?php

require_once(__DIR__."/../core/PDOConnection.php");


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
  public function save($activity_schedule) {
    $stmt = $this->db->prepare("INSERT INTO activity_schedule (id, id_activity,
      'date', start_hour, end_hour) values (0,?,?,?,?)");
      $stmt->execute(array($activity_schedule->getId_activity(),
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
    public function update(User $activity_schedule) {
      $stmt = $this->db->prepare("UPDATE activity_schedule set id_activity=?, 'date'=?,
        start_hour=?, end_hour=? where id=?");
        $stmt->execute(array($user->getId_activity(), $user->getDate(),
        $user->getStart_hour(), $user->getEnd_hour(), $user->getId()));
      }

      /**
       * Deletes an Activity_schedule into the database
       *
       * @param Activity_schedule $user The Activity_schedule to be deleted
       * @throws PDOException if a database error occurs
       * @return void
       */
      public function delete(User $activity_schedule) {
        $stmt = $this->db->prepare("DELETE from activity_schedule WHERE id=?");
        $stmt->execute(array($user->getId()));
      }

      /**
      * Loads a User from the database given its id
      *
      * @throws PDOException if a database error occurs
      * @return User The User instances. NULL
      * if the User is not found
      */
      public function findById($userlogin){
        $stmt = $this->db->prepare("SELECT * FROM user WHERE login=?");
        $stmt->execute(array($userlogin));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user != null) {
          return new User($user["id"],$user["login"],$user["name"],$user["password"],
          $user["email"], $user["description"], $user["profile_image"],
          $user["surname"], $user["phone"], $user["dni"], $user["confirm_date"],
          $user["user_type"]);
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
          array_push($activity_schedules, new User($activity_schedules["id"],
          $activity_schedules["id_activity"], $activity_schedules["date"],
          $activity_schedules["start_hour"], $activity_schedules["end_hour"]));
        }
        return $activity_schedules;
    }
}

<?php

require_once(__DIR__."/../core/PDOConnection.php");


/**
* Class SessionMapper
*
* Database interface for Session entities
*
* @author lipido <lipido@gmail.com>
*/
class SessionMapper {
  /**
  * Reference to the PDO connection
  * @var PDO
  */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }
  /**
  * Saves a User into the database
  *
  * @param Session $session The session to be saved
  * @throws PDOException if a database error occurs
  * @return void
  */
  public function save($public_info) {
    $stmt = $this->db->prepare("INSERT INTO public_info (phone, email,
      address) values (?,?,?)");
      $stmt->execute(array($public_info->getPhone(), $public_info->getEmail(),
      $public_info->getAddress()));
    }

    /**
    * Updates a public info in the database
    *
    * @param Public_Info $public_info The public info to be updated
    * @throws PDOException if a database error occurs
    * @return void
    */
    public function update(Public_Info $public_info) {
      $stmt = $this->db->prepare("UPDATE public_info set phone=?, email=?,
        address=? where id=?");
        $stmt->execute(array($public_info->getPhone(), $public_info->getEmail(),
        $public_info->getAddress(), $public_info->getId()));
      }

      /**
      * Loads a public info from the database given its id
      *
      * @throws PDOException if a database error occurs
      * @return User The public info instances. NULL
      * if the public info is not found
      */
      public function findById($id){
        $stmt = $this->db->prepare("SELECT * FROM public_info WHERE id=?");
        $stmt->execute(array($id));
        $public_info = $stmt->fetch(PDO::FETCH_ASSOC);

        if($public_info != null) {
          return new Public_Info($public_info["id"], $public_info["phone"],
          $public_info["email"], $public_info["address"]);
        } else {
          return NULL;
        }
      }

    /**
    * Retrieves sessions
    *
    *
    * @throws PDOException if a database error occurs
    * @return mixed Array of session instances
    */
    public function searchAll($value) {
      $stmt = $this->db->prepare("SELECT S.id as S_id, UT.id  as UT_id, WT.id as WT_id,
        WT.name as WT_name, S.duration as S_duration, S.*, U.*, UT.*, WT.*
        FROM session S
        LEFT JOIN user U ON S.id_user=U.id
        LEFT JOIN  user_table UT ON S.id_table=UT.id
        LEFT JOIN workout_table WT ON UT.id_workout=WT.id
        WHERE S.id_user=?");
        $stmt->execute(array($value));
        $sessions_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sessions = array();
        foreach ($sessions_db as $session) {
          $usuario = new User($session["user.id"], $session["user.login"],
            $session["user.name"],
            NULL/*password*/,
            $session["user.email"],
            $session["user.description"]
            );
          $workout_table = new Workout_table($session["WT_id"],
            NULL, //usuario
            $session["WT_name"],
            $session["workout_table.type"],
            $session["workout_table.description"]
            );
          $user_table = new User_table($session["UT_id"], $workout_table,
            $usuario
            );
            var_dump($session["S_duration"]);
        array_push($sessions, new Session($session["S_id"], $usuario, $user_table, $session["date"], $session["S_duration"], $session["comment"]));
      }

      return $sessions;
    }
}

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
  public function save($session) {
    $stmt = $this->db->prepare("INSERT INTO session (id, id_user,
      id_table, date, duration, comment) values (0,?,?,?,?,?)");
      $stmt->execute(array($session->getUser()->getId(), $session->getUser_table()->getId(),
      $session->getDate(), $session->getDuration(), $session->getComment()));
    }

    /**
    * Updates a public info in the database
    *
    * @param Public_Info $public_info The public info to be updated
    * @throws PDOException if a database error occurs
    * @return void
    */
    public function update(Session $session) {
      $stmt = $this->db->prepare("UPDATE session set id_user=?, id_table=?,
        date=?, duration=?, comment=? where id=?");
        $stmt->execute(array($session->getUser()->getId(), $session->getUser_table()->getId(),
        $session->getDate(), $session->getDuration(), $session->getComment(), $session->getId()));
      }

      /**
       * Deletes an session into the database
       *
       * @param Session $session The session to be deleted
       * @throws PDOException if a database error occurs
       * @return void
       */
      public function delete(Session $session) {
        $stmt = $this->db->prepare("DELETE from session WHERE id=?");
        $stmt->execute(array($session->getId()));
      }

      /**
      * Loads a public info from the database given its id
      *
      * @throws PDOException if a database error occurs
      * @return User The public info instances. NULL
      * if the public info is not found
      */
      public function findById($id){
        $stmt = $this->db->prepare("SELECT S.id as 'session.id',
          S.date as 'session.date', S.duration as 'session.duration',
          S.comment as 'session.comment',
          U.id as 'user.id',
          UT.id as 'user_table.id',
          WT.id as 'workout_table.id',
          WT.name as 'workout_table.name'
          FROM session S
            LEFT JOIN user U ON S.id_user=U.id
            LEFT JOIN user_table UT ON S.id_table=UT.id
            LEFT JOIN workout_table WT ON UT.id_workout=WT.id
          WHERE S.id=?");
        $stmt->execute(array($id));
        $session = $stmt->fetch(PDO::FETCH_ASSOC);

        if($session != null) {
          $usuario = new User($session["user.id"]);
          $workout_table = new Workout_table($session["workout_table.id"],
            NULL, //usuario
            $session["workout_table.name"]
            );
          $user_table = new User_table($session["user_table.id"], $workout_table,
            $usuario
            );
          return new Session($session["session.id"], $usuario,
          $user_table, $session["session.date"], $session["session.duration"],$session["session.comment"]);
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
      $stmt = $this->db->prepare("SELECT X.*,UT.id as 'user_table.id', WT.id as 'workout_table.id', WT.name as 'workout_table.name'
        FROM
            (SELECT S.id as 'session.id', S.id_table as 'session_id_table',
              S.date as 'session.date', S.duration as 'session.duration', S.comment as 'session.comment',
              U.id  as 'user.id', U.login as 'user.login', U.name as 'user.name'
            FROM session S
            LEFT JOIN user U ON S.id_user=U.id
	          WHERE S.id_user=?
          order by S.date) X
        LEFT JOIN user_table UT ON session_id_table=UT.id
        LEFT JOIN workout_table WT ON UT.id_workout = WT.id");
        $stmt->execute(array($value));
        $sessions_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sessions = array();
        foreach ($sessions_db as $session) {
          $usuario = new User($session["user.id"], $session["user.login"],
            $session["user.name"]
            );
          $workout_table = new Workout_table($session["workout_table.id"],
            NULL, //usuario
            $session["workout_table.name"]
            );
          $user_table = new User_table($session["user_table.id"], $workout_table,
            $usuario
            );
        array_push($sessions, new Session($session["session.id"], $usuario, $user_table, $session["session.date"], $session["session.duration"], $session["session.comment"]));
      }

      return $sessions;
    }
}

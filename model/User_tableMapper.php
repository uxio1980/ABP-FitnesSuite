<?php

require_once(__DIR__."/../core/PDOConnection.php");


/**
* Class User_tableMapper
*
* Database interface for User_table entities
*
* @author lipido <lipido@gmail.com>
*/
class User_tableMapper {
  /**
  * Reference to the PDO connection
  * @var PDO
  */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }
  /**
  * Saves a User_table into the database
  *
  * @param User_table $user_table The user_table to be saved
  * @throws PDOException if a database error occurs
  * @return void
  */
/**
    * Loads a session from the database given its id
    *
    * @throws PDOException if a database error occurs
    * @return User_table The user_table instances. NULL
    * if the user_table is not found
    */
    public function findById($id){
      $stmt = $this->db->prepare("SELECT UT.id as 'user_table.id',
        U.id as 'user.id', U.login as 'user.login', U.name as 'user.name',
        WT.id as 'workout_table.id', WT.name as 'workout_table.name'
        FROM user_table UT
        LEFT JOIN user U ON UT.id_user=U.id
        LEFT JOIN workout_table WT ON UT.id_workout=WT.id
        WHERE UT.id=?");
      $stmt->execute(array($id));
      $user_table = $stmt->fetch(PDO::FETCH_ASSOC);
      if($user_table != null) {
        $usuario = new User($user_table["user.id"], $user_table["user.login"],
          $user_table["user.name"]
          );
        $workout_table = new Workout_table($user_table["workout_table.id"],
          NULL, //usuario
          $user_table["workout_table.name"]
          );
        return new User_table($user_table["user_table.id"]);
      } else {
        return NULL;
      }
    }

    /**
        * Loads a session from the database given its id
        *
        * @throws PDOException if a database error occurs
        * @return User_table The user_table instances. NULL
        * if the user_table is not found
        */
        public function findByUserAndTable($id_user, $id_table){
          $stmt = $this->db->prepare("SELECT UT.id as 'user_table.id',
            U.id as 'user.id', U.login as 'user.login', U.name as 'user.name',
            WT.id as 'workout_table.id', WT.name as 'workout_table.name'
            FROM user_table UT
            LEFT JOIN user U ON UT.id_user=U.id
            LEFT JOIN workout_table WT ON UT.id_workout=WT.id
            WHERE UT.id_user=? AND UT.id_workout=?");
          $stmt->execute(array($id_user, $id_table));
          $user_table = $stmt->fetch(PDO::FETCH_ASSOC);

          if($user_table != null) {
            $usuario = new User($user_table["user.id"], $user_table["user.login"],
              $user_table["user.name"]
              );
            $workout_table = new Workout_table($user_table["workout_table.id"],NULL, //usuario
              $user_table["workout_table.name"]
              );
            return new User_table($user_table["user_table.id"]);
          } else {
            return NULL;
          }
        }

    /**
    * Retrieves user_tables for an user
    *
    *
    * @throws PDOException if a database error occurs
    * @return mixed Array of user_table instances
    */
    public function searchAll($value) {
      $stmt = $this->db->prepare("SELECT UT.id as 'user_table.id',
        U.id as 'user.id', U.login as 'user.login', U.name as 'user.name',
        WT.id as 'workout_table.id', WT.name as 'workout_table.name'
        FROM user_table UT
        LEFT JOIN user U ON UT.id_user=U.id
        LEFT JOIN workout_table WT ON UT.id_workout=WT.id
        WHERE UT.id_user=?");
        $stmt->execute(array($value));
        $user_tables_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $user_tables = array();
        foreach ($user_tables_db as $user_table) {
          $usuario = new User($user_table["user.id"], $user_table["user.login"],
            $user_table["user.name"]
            );
          $workout_table = new Workout_table($user_table["workout_table.id"],
            NULL, //usuario
            $user_table["workout_table.name"]
            );

            array_push($user_tables, new User_table($user_table["user_table.id"], $workout_table, $usuario));
         }

      return $user_tables;
    }

    public function findByUser($id_user){
        $stmt = $this->db->prepare("SELECT * FROM workout_table WHERE id IN 
            (SELECT id_workout FROM user_table WHERE id_user=?)");

        $stmt->execute(array($id_user));

        $tables_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tables = array();

        foreach ($tables_db as $table) {
            array_push($tables, new Workout_table($table["id"],$table["user"],
                $table["name"],$table["type"],$table["description"]));

        }

        return $tables;
    }

    public function searchNotAssignedTables($id_user){
        $stmt = $this->db->prepare("SELECT * FROM workout_table WHERE id NOT IN 
            (SELECT id_workout FROM user_table WHERE id_user=?)");
        $stmt->execute(array($id_user));
        $tables_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $workout_tables = array();

        foreach ($tables_db as $table) {
            $user = new User();
            $user->setId($table["id_user"]);
            array_push($workout_tables, new Workout_table($table["id"],$user,
                $table["name"],$table["type"], $table["description"]));
        }
        return $workout_tables;
    }

    public function save($user_table) {
        $stmt = $this->db->prepare("INSERT INTO user_table (id, id_workout, id_user) 
            values (0,?,?)");
        $stmt->execute(array($user_table->getUser()->getId(),$user_table->getWorkout_table()->getId()));
    }
}

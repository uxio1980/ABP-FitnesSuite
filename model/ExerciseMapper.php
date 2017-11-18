<?php

require_once(__DIR__."/../core/PDOConnection.php");


/**
* Class ExerciseMapper
*
* Database interface for User entities
*
* @author afsobrino <afsobrino@esei.uvigo.es>
*/
class ExerciseMapper {
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
  * @param Exercise $exercise The exercise to be saved
  * @throws PDOException if a database error occurs
  * @return void $id_user=NULL, $name=NULL, $description=NULL, $type=NULL, $image=NULL, $video=NULL
  */
  public function save($exercise) {
      $stmt = $this->db->prepare("INSERT INTO exercise (id, id_user, name, description, type,
      image,video) values (0,?,?,?,?,?,?)");
      $stmt->execute(array($exercise->getId_User(), $exercise->getName(),
          $exercise->getDescription(), $exercise->getType(), $exercise->getImage(),
          $exercise->getVideo()));
    }

    /**
    * Updates an exercise in the database
    *
    * @param Exercise $exercise the exercise to be updated
    * @throws PDOException if a database error occurs
    * @return void
    */
    public function update(Exercise $exercise) {
        $stmt = $this->db->prepare("UPDATE exercise set id=?, id_user=?, name=?, description=?, type=?,
                                                      image=?, video=? where id=?");
        $stmt->execute(array($exercise->getId(), $exercise->getId_User(), $exercise->getName(), $exercise->getDescription(), $exercise->getType(),
        $exercise->getImage(), $exercise->getVideo(), $exercise->getId()));
      }

      /**
      * Loads a exercise from the database given its id
      *
      * @throws PDOException if a database error occurs
      * @return User The public info instances. NULL
      * if the public info is not found
      */
      public function findById($id){
        $stmt = $this->db->prepare("SELECT * FROM exercise WHERE id=?");
        $stmt->execute(array($id));
        $exercise = $stmt->fetch(PDO::FETCH_ASSOC);

        if($exercise != null) {
          return new Exercise($exercise["id"], $exercise["id_user"],
              $exercise["name"], $exercise["description"], $exercise["type"], $exercise["image"], $exercise["video"]);
        } else {
          return NULL;
        }
      }

      /**
       * Retrieves all exercise
       *
       * @throws PDOException if a database error occurs
       * @return mixed Array of public infos instances
       */
      public function findAll() {
        $stmt = $this->db->query("SELECT * FROM exercise");
        $exercise_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $exercises = array();

        foreach ($exercise_db as $exercise) {
          array_push($exercises, new Exercise($exercise["id"], $exercise["id_user"],
              $exercise["name"], $exercise["description"], $exercise["type"], $exercise["image"], $exercise["video"]));
        }
        return $exercises;
      }

    /**
     * Deletes an exercise from the database
     *
     * @param Article $exercise The Article to be deleted
     * @throws PDOException if a database error occurs
     * @return void
     */
    public function delete(Exercise $exercise) {
        $stmt = $this->db->prepare("DELETE from exercise WHERE id=?");
        $stmt->execute(array($exercise->getId()));
    }
}

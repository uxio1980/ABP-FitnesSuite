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
  public function save($public_info) {
      $stmt = $this->db->prepare("INSERT INTO exercise (id, login, name, password, email,
      description, profile_image, surname, phone, dni, confirm_date, user_type) values (0,?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->execute(array($user->getLogin(), $user->getName(),
          $user->getPassword(), $user->getEmail(), $user->getDescription(),
          $user->getProfileImage(), $user->getSurname(), $user->getPhone(),
          $user->getDni(), $user->getConfirm_date(), $user->getUser_type()));
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
       * Retrieves all public infos
       *
       * @throws PDOException if a database error occurs
       * @return mixed Array of public infos instances
       */
      public function findAll() {
        $stmt = $this->db->query("SELECT * FROM public_info");
        $public_info_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $public_infos = array();

        foreach ($public_info_db as $public_info) {
          array_push($public_infos, new Public_Info($public_info["id"],
          $public_info["phone"], $public_info["email"], $public_info["address"]));
        }
        return $public_infos;
    }
}

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
}

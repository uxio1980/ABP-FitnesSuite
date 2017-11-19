<?php

require_once(__DIR__."/../core/PDOConnection.php");


/**
* Class UserMapper
*
* Database interface for User entities
*
* @author lipido <lipido@gmail.com>
*/
class UserMapper {
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
  * @param User $user The user to be saved
  * @throws PDOException if a database error occurs
  * @return void $login=NULL, $name= NULL,$password=NULL, $email=NULL, $description=NULL
  */
  public function save($user) {
    $stmt = $this->db->prepare("INSERT INTO user (id, login, name, password, email,
      description, profile_image, surname, phone, dni, confirm_date, user_type) values (0,?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->execute(array($user->getLogin(), $user->getName(),
      $user->getPassword(), $user->getEmail(), $user->getDescription(),
      $user->getProfileImage(), $user->getSurname(), $user->getPhone(),
      $user->getDni(), $user->getConfirm_date(), $user->getUser_type()));
    }

    /**
    * Updates a User in the database
    *
    * @param User $user The User to be updated
    * @throws PDOException if a database error occurs
    * @return void
    */
    public function update(User $user) {
      $stmt = $this->db->prepare("UPDATE user set login=?, name=?,
        password=?, email=?, description=?, profile_image=?, surname=?, phone=?,
        dni=?, confirm_date=?, user_type=? where login=?");
        $stmt->execute(array($user->getLogin(), $user->getName(), $user->getPassword(),
        $user->getEmail(), $user->getDescription(), $user->getProfileImage(),
        $user->getSurname(), $user->getPhone(), $user->getDni(),
        $user->getConfirm_date(), $user->getUser_type(),
        $user->getLogin()));
      }

      /**
       * Deletes an User into the database
       *
       * @param User $user The User to be deleted
       * @throws PDOException if a database error occurs
       * @return void
       */
      public function delete(User $user) {
        $stmt = $this->db->prepare("DELETE from user WHERE login=?");
        $stmt->execute(array($user->getLogin()));
      }

      /**
      * Checks if a given login is already in the database
      *
      * @param string $login the login to check
      * @return boolean true if the login exists, false otherwise
      */
      public function loginExists($login) {
        $stmt = $this->db->prepare("SELECT count(login) FROM user where login=?");
        $stmt->execute(array($login));

        if ($stmt->fetchColumn() > 0) {
          return true;
        }
      }

      /**
      * Checks if a given pair of login/password exists in the database
      *
      * @param string $login the login
      * @param string $passwd the password
      * @return boolean true the login/passwrod exists, false otherwise.
      */
      public function isValidUser($login, $password) {
        $stmt = $this->db->prepare("SELECT count(login) FROM user where login=? and password=? AND user_type IS NOT NULL");
        $stmt->execute(array($login, $password));

        if ($stmt->fetchColumn() > 0) {
          return true;
        }
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
      * Retrieves all trainers
      *
      *
      * @throws PDOException if a database error occurs
      * @return mixed Array of User trainers instances
      */
      public function findAllTrainers() {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user_type=?");
          $stmt->execute(array(usertype::Trainer));
          $trainers_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

          $trainers = array();

          foreach ($trainers_db as $trainer) {
            array_push($trainers, new User($trainer["id"],NULL,$trainer["name"],NULL,$trainer["email"],
              $trainer["description"],$trainer["profile_image"],$trainer["surname"]));
          }

          return $trainers;
      }


    /**
     * Retrieves all athlets
     *
     *
     * @throws PDOException if a database error occurs
     * @return mixed Array of User athlets instances
     */
    public function findAllAthlets() {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user_type=? or user_type=?");
        $stmt->execute(array(usertype::AthleteTDU,usertype::AthletePEF));
        $athlets_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $athlets = array();

        foreach ($athlets_db as $athlet) {
            array_push($athlets, new User($athlet["id"],$athlet["login"],$athlet["name"],NULL,
                $athlet["email"], $athlet["description"], $athlet["profile_image"],
                $athlet["surname"], $athlet["phone"], $athlet["dni"], $athlet["confirm_date"],
                $athlet["user_type"]));
        }
        return $athlets;
    }

    /**
     * Retrieves all admins
     *
     *
     * @throws PDOException if a database error occurs
     * @return mixed Array of User admins instances
     */
    public function findAdmin() {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user_type=?");
        $stmt->execute(array(usertype::Administrator));
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if($admin != null) {
            return new User($admin["id"],$admin["login"],$admin["name"],$admin["password"],
                $admin["email"], $admin["description"], $admin["profile_image"],
                $admin["surname"], $admin["phone"], $admin["dni"], $admin["confirm_date"],
                $admin["user_type"]);
        } else {
            return NULL;
        }
    }

      /**
       * Retrieves all users
       *
       * @throws PDOException if a database error occurs
       * @return mixed Array of User instances
       */
      public function findAll() {
        $stmt = $this->db->query("SELECT * FROM user");
        $users_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = array();

        foreach ($users_db as $user) {
          array_push($users, new User($user["id"],$user["login"],$user["name"],$user["password"],
          $user["email"], $user["description"], $user["profile_image"],
          $user["surname"], $user["phone"], $user["dni"], $user["confirm_date"],
          $user["user_type"]));
        }
        return $users;
    }

    /**
     * Retrieves all pending users
     *
     * @throws PDOException if a database error occurs
     * @return mixed Array of pending User instances
     */
    public function findPending() {
        $stmt = $this->db->query("SELECT * FROM user WHERE user_type IS NULL");
        $users_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = array();

        foreach ($users_db as $user) {
            array_push($users, new User($user["id"],$user["login"],$user["name"],$user["password"],
                $user["email"], $user["description"], $user["profile_image"],
                $user["surname"], $user["phone"], $user["dni"], $user["confirm_date"],
                $user["user_type"]));
        }
        return $users;
    }
}

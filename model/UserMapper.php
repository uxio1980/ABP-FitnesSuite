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
    $stmt = $this->db->prepare("INSERT INTO user (login, name, password, email,
      description, profile_image, surname, phone, dni, confirm_date, user_type,
      athlete_type) values (?,?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->execute(array($user->getLogin(), $user->getName(),
      $user->getPassword(), $user->getEmail(), $user->getDescription(),
      $user->getProfileImage(), $user->getSurname(), $user->getPhone(),
      $user->getDni(), $user->getConfirm_date(), $user->getUser_type(), $user->getAthlete_type()));
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
        dni=?, confirm_date=?, user_type=?, athlete_type=? where login=?");
        $stmt->execute(array($user->getLogin(), $user->getName(), $user->getPassword(),
        $user->getEmail(), $user->getDescription(), $user->getProfileImage(),
        $user->getSurname(), $user->getPhone(), $user->getDni(),
        $user->getConfirm_date(), $user->getUser_type(), $user->getAthlete_type(),
        $user->getLogin()));
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
        $stmt = $this->db->prepare("SELECT count(login) FROM user where login=? and password=?");
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
          return new User($user["login"],$user["name"],$user["password"],
          $user["email"], $user["description"], $user["profile_image"],
          $user["surname"], $user["phone"], $user["dni"], $user["confirm_date"],
          $user["user_type"], $user["athlete_type"]);
        } else {
          return NULL;
        }
      }

      /**
      * Retrieves all articles
      *
      * Note: chatlines are not added to the Article instances
      *
      * @throws PDOException if a database error occurs
      * @return mixed Array of Article instances
      */
      public function findAllTrainers() {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user_type=?");
          $stmt->execute(array(usertype::Trainer));
          $trainers_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
/*
          $trainers = array();

          foreach ($trainers_db as $trainer) {
            $usuario = new User($article["user.login"],
            $article["user.name"],
            NULL,
            $article["user.email"],
            $article["user.description"]
            );
            array_push($articles, new Article($article["idarticle"], $article["name"], $article["description"], $article["price"], $article["url_image01"], $article["url_image02"], $article["url_image03"], $usuario));
          }
          */
          return $trainers_db;
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
          array_push($users, new User($user["login"],$user["name"],$user["password"],
          $user["email"], $user["description"], $user["profile_image"],
          $user["surname"], $user["phone"], $user["dni"], $user["confirm_date"],
          $user["user_type"], $user["athlete_type"]));
        }
        return $users;
    }
}

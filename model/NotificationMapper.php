<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
/**
* Class NotificationMapper
*
* Database interface for Notifications entities
*
* @author lipido <lipido@gmail.com>
*/
class NotificationMapper {
  /**
  * Reference to the PDO connection
  * @var PDO
  */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }
  /**
  * Saves a Notification into the database
  *
  * @param Notification $notification The Notification to be saved
  * @throws PDOException if a database error occurs
  * @return void $phone=NULL, $email= NULL,$address=NULL
  */
  public function save($notification) {
    $stmt = $this->db->prepare("INSERT INTO notification (id, id_user, date,
      title, content) values (0,?,?,?,?)");
      $stmt->execute(array($notification->getUser_author()->getId(),
      $notification->getDate(), $notification->getTitle(),$notification->getContent()));
    }

    /**
    * Updates a Notification in the database
    *
    * @param Notification $notification The Notification to be updated
    * @throws PDOException if a database error occurs
    * @return void
    */
    public function update(Notification $notification) {
      $stmt = $this->db->prepare("UPDATE notification set date=?,
        title=?, content=? where id=?");
        $stmt->execute(array($notification->getDate(),
        $notification->getTitle(), $notification->getContent(), $notification->getId()));
      }

      /**
      * Loads a Notification from the database given its id
      *
      * @throws PDOException if a database error occurs
      * @return Notification The Notification instances. NULL
      * if the Notification is not found
      */
      public function findById($id){

        $stmt = $this->db->prepare("SELECT *, U.id as 'id_user' FROM notification N LEFT JOIN user U ON N.id_user=U.id WHERE N.id=?");
        $stmt->execute(array($id));
        $notification = $stmt->fetch(PDO::FETCH_ASSOC);

        if($notification != null) {
          $usuario = new User($notification["id_user"], $notification["login"],
          $notification["name"],
          NULL/*password*/,
          $notification["email"],
          $notification["description"]);
          return new Notification($notification["id"], $usuario,
          $notification["date"], $notification["title"], $notification["content"]);
        } else {
          return NULL;
        }
      }

      /**
       * Retrieves all Notifications
       *
       * @throws PDOException if a database error occurs
       * @return mixed Array of Notifications instances
       */
      public function findAll() {
        $stmt = $this->db->query("SELECT N.*, U.login as 'user.login',
          U.name as 'user.name', U.email as 'user.email',
          U.description as 'user.description'
          FROM notification N LEFT JOIN user U ON N.id_user = U.id ");
        $notification_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $notifications = array();

        foreach ($notification_db as $notification) {
          $usuario = new User($notification["id_user"], $notification["user.login"],
          $notification["user.name"],
          NULL/*password*/,
          $notification["user.email"],
          $notification["user.description"]);
          array_push($notifications, new Notification($notification["id"],
          $usuario, $notification["date"],
          $notification["title"], $notification["content"]));
        }
        return $notifications;
    }

    /**
     * Retrieves all Notifications lapsed
     *
     * @throws PDOException if a database error occurs
     * @return mixed Array of Notifications instances
     */
    public function findAllLapsed() {
      $stmt = $this->db->query("SELECT N.*, U.login as 'user.login',
        U.name as 'user.name', U.email as 'user.email',
        U.description as 'user.description'
        FROM notification N LEFT JOIN user U ON N.id_user = U.id
        WHERE N.date < NOW()");
      $notification_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $notifications = array();

      foreach ($notification_db as $notification) {
        $usuario = new User($notification["id_user"], $notification["user.login"],
        $notification["user.name"],
        NULL/*password*/,
        $notification["user.email"],
        $notification["user.description"]);
        array_push($notifications, new Notification($notification["id"],
        $usuario, $notification["date"],
        $notification["title"], $notification["content"]));
      }
      return $notifications;
  }

  /**
   * Retrieves all Notifications lapsed
   *
   * @throws PDOException if a database error occurs
   * @return mixed Array of Notifications instances
   */
  public function findAllActives() {
    $stmt = $this->db->query("SELECT N.*, U.login as 'user.login',
      U.name as 'user.name', U.email as 'user.email',
      U.description as 'user.description'
      FROM notification N LEFT JOIN user U ON N.id_user = U.id
      WHERE N.date > NOW()");
    $notification_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $notifications = array();

    foreach ($notification_db as $notification) {
      $usuario = new User($notification["id_user"], $notification["user.login"],
      $notification["user.name"],
      NULL/*password*/,
      $notification["user.email"],
      $notification["user.description"]);
      array_push($notifications, new Notification($notification["id"],
      $usuario, $notification["date"],
      $notification["title"], $notification["content"]));
    }
    return $notifications;
}

    public function findLastId(){
        $stmt = $this->db->prepare("SELECT MAX(id) FROM notification");
        $stmt->execute();
        $notification = $stmt->fetch(PDO::FETCH_ASSOC);

        if($notification != null) {
            return new Notification($notification["MAX(id)"]);
        } else {
            return NULL;
        }
    }

}

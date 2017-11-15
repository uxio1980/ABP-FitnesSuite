<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Notification.php");
/**
* Class Notification_userMapper
*
* Database interface for Notifications of users entities
*
* @author lipido <lipido@gmail.com>
*/
class Notification_userMapper {
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
  * @param Notification_user $notification_user The Notification_user to be saved
  * @throws PDOException if a database error occurs
  * @return void $phone=NULL, $email= NULL,$address=NULL
  */
  public function save($notification_user) {
    $stmt = $this->db->prepare("INSERT INTO notification_user (id, id_user, id_notification, viewed
    ) values (0,?,?,?)");
      $stmt->execute(array($notification_user->getUser_receiver()->getId(),
      $notification_user->getNotification()->getId(),
      $notification_user->getViewed()));
    }

    /**
    * Updates a Notification in the database
    *
    * @param Notification $notification The Notification to be updated
    * @throws PDOException if a database error occurs
    * @return void
    */
    public function update(Notification $notification) {
      $stmt = $this->db->prepare("UPDATE notification set id_user=?, date=?,
        title=?, content=? where id=?");
        $stmt->execute(array($notification->getId_User(), $notification->getDate(),
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
        $stmt = $this->db->prepare("SELECT * FROM notification WHERE id=?");
        $stmt->execute(array($id));
        $notification = $stmt->fetch(PDO::FETCH_ASSOC);

        if($notification != null) {
          return new Notification($notification["id"], $notification["id_user"],
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
      public function countAllByNotification(Notification $notification) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM notification_user WHERE id_notification=?");
        $stmt->execute(array($notification->getId()));
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        if($count != null) {
          return $count["COUNT(*)"];
        } else {
          return 0;
        }
      }

      /**
       * Retrieves all Notifications lapsed
       *
       * @throws PDOException if a database error occurs
       * @return mixed Array of Notifications instances
       */
      public function countAllByUser(User $user) {
        $stmt = $this->db->prepare("SELECT COUNT(*)
FROM notification_user  NU LEFT JOIN notification N ON N.id_user = n.id
WHERE nu.id_user=? AND N.date > NOW() AND (NU.viewed IS NULL)");
        //$stmt->execute(array(0));
        $stmt->execute(array($user->getId()));
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        if($count != null) {
          return $count["COUNT(*)"];
        } else {
          return 0;
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
          $usuario = new User($notification["user.login"],
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
        WHERE n.date < NOW()");
      $notification_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $notifications = array();

      foreach ($notification_db as $notification) {
        $usuario = new User($notification["user.login"],
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
      WHERE n.date > NOW()");
    $notification_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $notifications = array();

    foreach ($notification_db as $notification) {
      $usuario = new User($notification["user.login"],
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


}

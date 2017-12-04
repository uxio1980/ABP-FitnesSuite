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
    public function update(Notification_user $notification) {
      $stmt = $this->db->prepare("UPDATE notification_user set id_user=?, date=?,
        title=?, content=? where id=?");
        $stmt->execute(array($notification->getId_User(), $notification->getDate(),
        $notification->getTitle(), $notification->getContent(), $notification->getId()));
      }

      /**
      * Updates a Notification in the database
      *
      * @param Notification $notification The Notification to be updated
      * @throws PDOException if a database error occurs
      * @return void
      */
      public function updateAsRead(Notification_user $notification_user) {
        $stmt = $this->db->prepare("UPDATE notification_user set viewed=? where id=?");
          $stmt->execute(array($notification_user->getViewed(), $notification_user->getId()));
        }

        /**
        * Deletes an activity into the database
        *
        * @param Article $article The Article to be deleted
        * @throws PDOException if a database error occurs
        * @return void
        */
        public function delete(Notification_user $notification_user) {
            $stmt = $this->db->prepare("DELETE from notification_user WHERE id=?");
            $stmt->execute(array($notification_user->getId()));
        }

      /**
      * Loads a Notification from the database given its id
      *
      * @throws PDOException if a database error occurs
      * @return Notification The Notification instances. NULL
      * if the Notification is not found
      */
      public function findById($id){
        $stmt = $this->db->prepare("SELECT NU.*,N.*, NU.id as 'notification_user.id',
             NU.id_user as 'notification_user.id_user',
	         NU.id_notification as 'notification_user.id_notification',
             U.name as 'notification.username',
             N.id_user as 'notification.id_user'
	         FROM `notification_user` NU
             LEFT JOIN notification N ON NU.id_notification = N.id
             LEFT JOIN user U ON N.id_user = U.id
             WHERE NU.id=?");
        $stmt->execute(array($id));
        $notification_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($notification_user != null) {
          $usuario_notification_user = new User($notification_user["notification_user.id_user"]);
          $usuario_notification = new User($notification_user["notification.id_user"],NULL,$notification_user["notification.username"] );
          $notification = new Notification($notification_user["notification_user.id_notification"],
          $usuario_notification, $notification_user["date"],
          $notification_user["title"], $notification_user["content"]);
          return new Notification_User($notification_user["notification_user.id"], $usuario_notification_user,
          $notification, $notification_user["viewed"]);
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
          FROM notification_user  NU LEFT JOIN notification N ON NU.id_notification = N.id
          WHERE NU.id_user=? AND N.date > NOW() AND (NU.viewed IS NULL)");
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
       * Retrieves all Notifications for current user
       *
       * @throws PDOException if a database error occurs
       * @return mixed Array of Notifications instances
       */
      public function findAllByNotification(Notification $notification) {
        $stmt = $this->db->prepare("SELECT NU.*, NU.id as 'notification_user.id', N.*,
          N.id as 'notification.id', U.id as 'user.id', U.login as 'user.login',
          U.name as 'user.name', U.email as 'user.email',
          U.description as 'user.description', U.surname as 'user.surname',
          UN.id as 'user_notification.id', UN.login as 'user_notification.login',
          UN.name as 'user_notification.name', UN.email as 'user_notification.email',
          UN.description as 'user_notification.description'
          FROM notification_user NU
          LEFT JOIN notification N ON NU.id_notification = N.id
          LEFT JOIN user U ON NU.id_user = U.id
          LEFT JOIN user UN ON N.id_user = UN.id
          WHERE NU.id_notification=?");
          $stmt->execute(array($notification->getId()));
        $notification_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $notifications = array();

        foreach ($notification_db as $notification_user) {
          $usuario_Notification_User = new User($notification_user["user.id"], $notification_user["user.login"],
              $notification_user["user.name"],
              NULL/*password*/,
              $notification_user["user.email"],
              $notification_user["user.description"], NULL,$notification_user["user.surname"]);
          $usuario_Notification = new User($notification_user["user_notification.id"], $notification_user["user_notification.login"],
              $notification_user["user_notification.name"],
              NULL/*password*/,
              $notification_user["user_notification.email"],
              $notification_user["user_notification.description"]);
          $notification = new Notification($notification_user["notification.id"],$usuario_Notification, $notification_user["date"],
           $notification_user["title"], $notification_user["content"]);
          array_push($notifications, new Notification_user($notification_user["notification_user.id"],
          $usuario_Notification_User, $notification,
          $notification_user["viewed"]));
        }
        return $notifications;
    }

      /**
       * Retrieves all Notifications for current user
       *
       * @throws PDOException if a database error occurs
       * @return mixed Array of Notifications instances
       */
      public function findAllByUser(User $user) {
        $stmt = $this->db->prepare("SELECT NU.*, NU.id as 'notification_user.id', N.*,
          N.id as 'notification.id', U.id as 'user.id', U.login as 'user.login',
          U.name as 'user.name', U.email as 'user.email',
          U.description as 'user.description',
          UN.id as 'user_notification.id', UN.login as 'user_notification.login',
          UN.name as 'user_notification.name', UN.email as 'user_notification.email',
          UN.description as 'user_notification.description'
          FROM notification_user NU
          LEFT JOIN notification N ON NU.id_notification = N.id
          LEFT JOIN user U ON NU.id_user = U.id
          LEFT JOIN user UN ON N.id_user = UN.id
          WHERE NU.id_user=?");
          $stmt->execute(array($user->getId()));
        $notification_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $notifications = array();

        foreach ($notification_db as $notification_user) {
          $usuario_Notification_User = new User($notification_user["user.id"], $notification_user["user.login"],
              $notification_user["user.name"],
              NULL/*password*/,
              $notification_user["user.email"],
              $notification_user["user.description"]);
          $usuario_Notification = new User($notification_user["user_notification.id"], $notification_user["user_notification.login"],
              $notification_user["user_notification.name"],
              NULL/*password*/,
              $notification_user["user_notification.email"],
              $notification_user["user_notification.description"]);
          $notification = new Notification($notification_user["notification.id"],$usuario_Notification, $notification_user["date"],
           $notification_user["title"], $notification_user["content"]);
          array_push($notifications, new Notification_user($notification_user["notification_user.id"],
          $usuario_Notification_User, $notification,
          $notification_user["viewed"]));
        }
        return $notifications;
    }

    /**
     * Retrieves all Notifications for current user
     *
     * @throws PDOException if a database error occurs
     * @return mixed Array of Notifications instances
     */
    public function findNotReadByUser(User $user) {
      $stmt = $this->db->prepare("SELECT NU.*, NU.id as 'notification_user.id', N.*, N.id as 'notification.id', U.id as 'user.id', U.login as 'user.login',
        U.name as 'user.name', U.email as 'user.email',
        U.description as 'user.description'
        FROM notification_user NU
        LEFT JOIN notification N ON NU.id_notification = N.id
        LEFT JOIN user U ON NU.id_user = U.id
        WHERE NU.id_user=? AND (NU.viewed IS NULL)");
        $stmt->execute(array($user->getId()));
      $notification_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $notifications = array();

      foreach ($notification_db as $notification_user) {
        $usuario = new User($notification_user["user.id"], $notification_user["user.login"],
        $notification_user["user.name"],
        NULL/*password*/,
        $notification_user["user.email"],
        $notification_user["user.description"]);
        $notification = new Notification($notification_user["notification.id"],NULL, NULL, $notification_user["title"]);
        array_push($notifications, new Notification_user($notification_user["notification_user.id"],
        $usuario, $notification,
        $notification_user["viewed"]));
      }
      return $notifications;
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
    public function findAllLapsedByUser(User $user) {
      $stmt = $this->db->prepare("SELECT NU.*, NU.id as 'notification_user.id', N.*,
        N.id as 'notification.id', U.id as 'user.id', U.login as 'user.login',
        U.name as 'user.name', U.email as 'user.email',
        U.description as 'user.description',
        UN.id as 'user_notification.id', UN.login as 'user_notification.login',
        UN.name as 'user_notification.name', UN.email as 'user_notification.email',
        UN.description as 'user_notification.description'
        FROM notification_user NU
        LEFT JOIN notification N ON NU.id_notification = N.id
        LEFT JOIN user U ON NU.id_user = U.id
        LEFT JOIN user UN ON N.id_user = UN.id
        WHERE NU.id_user=? AND N.date < NOW()");
        $stmt->execute(array($user->getId()));
      $notification_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $notifications = array();

      foreach ($notification_db as $notification_user) {
        $usuario_Notification_User = new User($notification_user["user.id"], $notification_user["user.login"],
            $notification_user["user.name"],
            NULL/*password*/,
            $notification_user["user.email"],
            $notification_user["user.description"]);
        $usuario_Notification = new User($notification_user["user_notification.id"], $notification_user["user_notification.login"],
            $notification_user["user_notification.name"],
            NULL/*password*/,
            $notification_user["user_notification.email"],
            $notification_user["user_notification.description"]);
        $notification = new Notification($notification_user["notification.id"],$usuario_Notification, $notification_user["date"],
         $notification_user["title"], $notification_user["content"]);
        array_push($notifications, new Notification_user($notification_user["notification_user.id"],
        $usuario_Notification_User, $notification,
        $notification_user["viewed"]));
      }
      return $notifications;
  }

  /**
   * Retrieves all Notifications lapsed
   *
   * @throws PDOException if a database error occurs
   * @return mixed Array of Notifications instances
   */
  public function findAllActivesByUser(User $user) {
    $stmt = $this->db->prepare("SELECT NU.*, NU.id as 'notification_user.id', N.*,
      N.id as 'notification.id', U.id as 'user.id', U.login as 'user.login',
      U.name as 'user.name', U.email as 'user.email',
      U.description as 'user.description',
      UN.id as 'user_notification.id', UN.login as 'user_notification.login',
      UN.name as 'user_notification.name', UN.email as 'user_notification.email',
      UN.description as 'user_notification.description'
      FROM notification_user NU
      LEFT JOIN notification N ON NU.id_notification = N.id
      LEFT JOIN user U ON NU.id_user = U.id
      LEFT JOIN user UN ON N.id_user = UN.id
      WHERE NU.id_user=? AND N.date > NOW()");
      $stmt->execute(array($user->getId()));
    $notification_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $notifications = array();

    foreach ($notification_db as $notification_user) {
      $usuario_Notification_User = new User($notification_user["user.id"], $notification_user["user.login"],
          $notification_user["user.name"],
          NULL/*password*/,
          $notification_user["user.email"],
          $notification_user["user.description"]);
      $usuario_Notification = new User($notification_user["user_notification.id"], $notification_user["user_notification.login"],
          $notification_user["user_notification.name"],
          NULL/*password*/,
          $notification_user["user_notification.email"],
          $notification_user["user_notification.description"]);
      $notification = new Notification($notification_user["notification.id"],$usuario_Notification, $notification_user["date"],
       $notification_user["title"], $notification_user["content"]);
      array_push($notifications, new Notification_user($notification_user["notification_user.id"],
      $usuario_Notification_User, $notification,
      $notification_user["viewed"]));
    }
    return $notifications;
}


}

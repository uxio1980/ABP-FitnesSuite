<?php

require_once(__DIR__."/../core/PDOConnection.php");


/**
* Class ActivityMapper
*
* Database interface for activity entities
*
* @author lipido <lipido@gmail.com>
*/
class ActivityMapper {
    /**
    * Reference to the PDO connection
    * @var PDO
    */
    private $db;

    public function __construct() {
    $this->db = PDOConnection::getInstance();
    }

    /**
    * Loads an activity from the database given its id
    *
    * @throws PDOException if a database error occurs
    * @return activity The activity instances. NULL
    * if the activity is not found
    */
    public function findById($idactivity){
        $stmt = $this->db->prepare("SELECT * FROM activity WHERE id=?");
        $stmt->execute(array($idactivity));
        $activity = $stmt->fetch(PDO::FETCH_ASSOC);

        if($activity != null) {
            return new activity($activity["id"],$activity["id_user"],$activity["name"],$activity["description"], 
            $activity["place"], $activity["type"],$activity["seats"], $activity["image"]);
        } else {
            return NULL;
        }
    }

    /**
     * Retrieves all activities
     *
     * @throws PDOException if a database error occurs
     * @return mixed Array of activity instances
     */
    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM activity");
        $activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $activities = array();

        foreach ($activities_db as $activity) {
            array_push($activities, new activity($activity["id"],$activity["id_user"],$activity["name"],
            $activity["description"], $activity["place"], $activity["type"],$activity["seats"],$activity["image"]));
        }
        return $activities;
    }

    /**
    * Saves an activity into the database
    *
    * @param activity $activity The activity to be saved
    * @throws PDOException if a database error occurs
    * @return void $login=NULL, $name= NULL,$password=NULL, $email=NULL, $description=NULL
    */
    public function save($activity) {
    $stmt = $this->db->prepare("INSERT INTO activity (id, id_user, name, description, place,
        type, seats, image) values (0,?,?,?,?,?,?,?)");
        $stmt->execute(array($activity->getIduser(),$activity->getName(),$activity->getDescription(),
        $activity->getPlace(),$activity->getType(),$activity->getSeats(),$activity->getImage()));
    }

    /**
    * Updates an activity in the database
    *
    * @param activity $activity The activity to be updated
    * @throws PDOException if a database error occurs
    * @return void
    */
    public function update(Activity $activity) {
        $stmt = $this->db->prepare("UPDATE activity set id=?, id_user=?,
            name=?, description=?, place=?, type=?, seats=?, image=? where id=?");
            $stmt->execute(array($activity->getIdactivity(), $activity->getIduser(), $activity->getName(),
            $activity->getDescription(), $activity->getPlace(), $activity->getType(),
            $activity->getSeats(), $activity->getImage(), $activity->getIdactivity()));
    }

    /**
    * Deletes an activity into the database
    *
    * @param Article $article The Article to be deleted
    * @throws PDOException if a database error occurs
    * @return void
    */
    public function delete(Activity $activity) {
        $stmt = $this->db->prepare("DELETE from activity WHERE id=?");
        $stmt->execute(array($activity->getIdactivity()));
    }

    /**
    * Retrieves one trainers
    *
    *
    * @throws PDOException if a database error occurs
    * @return mixed Array of trainers instances
    */
    public function findTrainerById($userid) {
        $stmt = $this->db->prepare("SELECT name,surname FROM user WHERE id=?");
            $stmt->execute(array($userid));
            $trainer = $stmt->fetch(PDO::FETCH_ASSOC);
            return $trainer["surname"].", ".$trainer["name"];
    }

}

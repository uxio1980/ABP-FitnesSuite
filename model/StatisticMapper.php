<?php

require_once(__DIR__."/../core/PDOConnection.php");

class StatisticMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    // Para admin:
    public function athletesRegistered(){
        $stmt = $this->db->query("SELECT COUNT(*) as users FROM user WHERE user_type=3 OR user_type=4");
        $athletes = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($athletes != null) {
            $statistic = $athletes['users'];
            return new Statistic( $statistic );
        } else {
            return NULL;
        }
    }

    public function athletesByActivity(){
        $stmt = $this->db->query("");
        $athletes = $stmt->fetch(PDO::FETCH_ASSOC);
        // Necesario reservas.
    }

    public function exercisesByType(){
        $stmt = $this->db->query("SELECT COUNT(*) as users FROM exercise GROUP BY type");
        $exercises = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Para deportista/entrenador:
    public function athletesTrainer($trainerid){
        
    }

    public function athleteAssistanceWeek($userid){
        
    }

    public function athleteSessions($userid){
        
    }

    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM activity");
        $activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $activities = array();

        foreach ($activities_db as $activity) {
            array_push($activities, new activity($activity["id"],$activity["id_user"],$activity["name"],$activity["description"],
                $activity["type"],$activity["place"],$activity["seats"],$activity["image"]));
        }
        return $activities;
    }

    public function save($activity) {
    $stmt = $this->db->prepare("INSERT INTO activity (id, id_user, name, description, type, place,
        seats, image) values (0,?,?,?,?,?,?,?)");
        $stmt->execute(array($activity->getIduser(),$activity->getName(),$activity->getDescription(),
        $activity->getType(),$activity->getPlace(),$activity->getSeats(),$activity->getImage()));
    }

    public function update(Activity $activity) {
        $stmt = $this->db->prepare("UPDATE activity set id=?, id_user=?,
            name=?, description=?, type=?, place=?, seats=?, image=? where id=?");
            $stmt->execute(array($activity->getIdactivity(), $activity->getIduser(), $activity->getName(),
            $activity->getDescription(), $activity->getType(), $activity->getPlace(),
            $activity->getSeats(), $activity->getImage(), $activity->getIdactivity()));
    }

    public function delete(Activity $activity) {
        $stmt = $this->db->prepare("DELETE from activity WHERE id=?");
        $stmt->execute(array($activity->getIdactivity()));
    }

}

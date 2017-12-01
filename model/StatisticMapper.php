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
            return new Statistic($statistic);
        } else {
            return NULL;
        }
    }

    public function athletesByActivity(){
        $stmt = $this->db->query("SELECT A.name,count(*) FROM user_activity U,activity_schedule S,activity A 
        WHERE U.id_activity=S.id AND S.id_activity=A.id 
        GROUP BY U.id_activity");
        $athletes_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Falta return
    } 

    public function exercisesByType(){
        $stmt = $this->db->query("SELECT type,COUNT(*) as num FROM exercise GROUP BY type");
        $exercises_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($exercises_db as $exercise) {
            $statistic[$exercise['type']] = $exercise['num'];
        }
        return new Statistic($statistic);
    }

    // Para deportista/entrenador:
    public function athletesTrainer($trainerid){
        // Necesario corregir tablas.
    }

    public function athleteAssistance($userid){
        $stmt = $this->db->prepare("SELECT U.name,A.date FROM assistance A,user_activity UA,user U
            WHERE U.id=? AND A.assist=1 AND U.id=UA.id_user AND UA.id=A.id_userActivity
            ORDER BY A.date");
        $stmt->execute(array($userid));
        $assistance_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Falta return
    }

    public function athleteAssistanceActivity($userid,$activityid){
        $stmt = $this->db->prepare("SELECT U.name,A.date FROM assistance A,user_activity UA,user U
            WHERE U.id=? AND UA.id_activity=? AND A.assist=1 AND U.id=UA.id_user AND UA.id=A.id_userActivity
            ORDER BY A.date");
        $stmt->execute(array($userid,$activityid));
        $assistance_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Falta return
    }

    public function athleteSessions($userid){
        $stmt = $this->db->prepare("SELECT W.name,S.date,S.duration FROM session S,user_table U,workout_table W 
            WHERE S.id_user=? AND S.id_table=U.id AND U.id_workout=W.id 
            ORDER BY S.id_user,S.id_table,S.date");
        $stmt->execute(array($userid));
        $sessions_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Falta return
    }

    public function athleteSessionsTable($userid,$tableid){
        $stmt = $this->db->prepare("SELECT W.name,S.date,S.duration FROM session S,user_table U,workout_table W 
            WHERE S.id_user=? AND S.id_table=? AND S.id_table=U.id AND U.id_workout=W.id 
            ORDER BY S.id_user,S.id_table,S.date");
        $stmt->execute(array($userid,$tableid));
        $sessions_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Falta return
    }

}

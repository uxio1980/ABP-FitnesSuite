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
            return new Statistic($statistic,NULL);
        } else {
            return NULL;
        }
    }

    public function athletesByActivity(){
        $stmt = $this->db->query("SELECT A.name,count(*) as num FROM user_activity U,activity_schedule S,activity A 
        WHERE U.id_activity=S.id AND S.id_activity=A.id 
        GROUP BY U.id_activity");
        $athletes_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $xaxis = array();
        $yaxis = array();

        foreach ($athletes_db as $athletes) {
            array_push($yaxis, $athletes['num']);
            array_push($xaxis, $athletes['name']);
        }
        return new Statistic($xaxis, $yaxis);
    } 

    public function exercisesByType(){
        $stmt = $this->db->query("SELECT type,COUNT(*) as num FROM exercise GROUP BY type");
        $exercises_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $xaxis = array();
        $yaxis = array();

        foreach ($exercises_db as $exercise) {
            array_push($yaxis, $exercise['num']);
            array_push($xaxis, $exercise['type']);
        }
        return new Statistic($xaxis, $yaxis);
    }

    // Para deportista/entrenador:
    public function athletesTrainer($trainerid){
        $stmt = $this->db->prepare("SELECT count(*) as num FROM user WHERE trainer=?");
        $stmt->execute(array($trainerid));
        $num_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt2 = $this->db->prepare("SELECT * FROM user WHERE trainer=?");
        $stmt2->execute(array($trainerid));
        $athletes_db = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $xaxis = array();
        
        foreach ($athletes_db as $athlete) {
            array_push($xaxis, new User($athlete["id"], $athlete["login"], $athlete["name"], NULL, NULL, 
                NULL, NULL, $athlete["surname"], NULL, NULL, $athlete["user_type"],$athlete["trainer"]));
        }
        return new Statistic($xaxis, $num_db[0]['num']);
    }

    public function athleteAssistance($userid){
        $stmt = $this->db->prepare("SELECT count(*) as num,A.date FROM assistance A,user_activity UA,user U
            WHERE U.id=? AND A.assist=1 AND U.id=UA.id_user AND UA.id=A.id_userActivity
            GROUP BY A.date ORDER BY A.date");
        $stmt->execute(array($userid));
        $assistance_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $xaxis = array();
        $yaxis = array();

        foreach ($assistance_db as $assistance) {
            array_push($yaxis, $assistance['num']);
            array_push($xaxis, date('Y-m-d', strtotime($assistance['date'])));
        }
        return new Statistic($xaxis, $yaxis);
    }

    public function athleteAssistanceActivity($userid,$activityid){
        $stmt = $this->db->prepare("SELECT count(*) as num,A.date FROM assistance A,user_activity UA,user U
            WHERE U.id=? AND UA.id_activity=? AND A.assist=1 AND U.id=UA.id_user AND UA.id=A.id_userActivity
            GROUP BY A.date ORDER BY A.date");
        $stmt->execute(array($userid,$activityid));
        $assistance_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $xaxis = array();
        $yaxis = array();

        foreach ($assistance_db as $assistance) {
            array_push($yaxis, $assistance['num']);
            array_push($xaxis, date('Y-m-d', strtotime($assistance['date'])));
        }
        return new Statistic($xaxis, $yaxis);
    }

    public function athleteSessions($userid){
        $stmt = $this->db->prepare("SELECT W.name,S.date,S.duration FROM session S,user_table U,workout_table W 
            WHERE S.id_user=? AND S.id_table=U.id AND U.id_workout=W.id 
            ORDER BY S.id_user,S.id_table,S.date");
        $stmt->execute(array($userid));
        $sessions_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $xaxis = array();
        $yaxis = array();
        $tables = array();

        foreach ($sessions_db as $sessions) {
            $hours = date('H', strtotime($sessions['duration']))*60;
            $mins = date('i', strtotime($sessions['duration']))*1;
            array_push($yaxis, $hours+$mins);
            array_push($xaxis, date('Y-m-d', strtotime($sessions['date'])));
            array_push($tables, $sessions["name"]);
        }
        return new Statistic($xaxis, $yaxis, $tables);
    }

    public function athleteSessionsTable($userid,$tableid){
        $stmt = $this->db->prepare("SELECT W.name,S.date,S.duration FROM session S,user_table U,workout_table W 
            WHERE S.id_user=? AND W.id=? AND S.id_table=U.id AND U.id_workout=W.id 
            ORDER BY S.id_user,S.id_table,S.date");
        $stmt->execute(array($userid,$tableid));
        $sessions_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $xaxis = array();
        $yaxis = array();
        $tables = array();

        foreach ($sessions_db as $sessions) {
            $hours = date('H', strtotime($sessions['duration']))*60;
            $mins = date('i', strtotime($sessions['duration']))*1;
            array_push($yaxis, $hours+$mins);
            array_push($xaxis, date('Y-m-d', strtotime($sessions['date'])));
            array_push($tables, $sessions["name"]);
        }
        return new Statistic($xaxis, $yaxis, $tables);
    }

}

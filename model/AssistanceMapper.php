<?php

require_once(__DIR__."/../core/PDOConnection.php");

class AssistanceMapper
{
    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }


    public function save($assist) {
        $stmt = $this->db->prepare("INSERT INTO assistance (id, id_userActivity, date, assist) values (0,?,?,?)");
        $stmt->execute(array($assist->getIduserAct(),$assist->getDate(),$assist->getAssist()));
    }

    public function update(Assistance $assist) {
        $stmt = $this->db->prepare("UPDATE assistance set id=?, id_userActivity=?,
            date=?, assist=? where id=?");
        $stmt->execute(array($assist->getIdactivity(), $assist->getIduserAct(), $assist->getDate(),
            $assist->getAssist(),$assist->getIdassist()));
    }

    public function findByUserActivityDate($id,$iduser,$idact,$date) {
        $stmt = $this->db->prepare("SELECT * FROM assistance
        WHERE id_userActivity=? AND date=?");
        $stmt->execute(array($id,$date));
        $assist = $stmt->fetch(PDO::FETCH_ASSOC);
        if($assist !=null) {
            $assistance = new Assistance($assist["id"], $assist["id_userActivity"], $iduser, $idact, $date, $assist["assist"]);
        }
        else {
            $assistance = new Assistance(null,$id,$iduser,$idact,$date,null);
        }

        return $assistance;
    }

    public function findById($id,$idUserAct){
        $stmt = $this->db->prepare("SELECT * FROM assistance
        WHERE id=? AND id_userActivity=?");
        $stmt->execute(array($id,$idUserAct));
        $assist = $stmt->fetch(PDO::FETCH_ASSOC);
        if($assist !=null) {
            $assistance = new Assistance($assist["id"], $assist["id_userActivity"], null, null,
                $assist["date"], $assist["assist"]);
        }
        else {
            $assistance = new Assistance();
        }

        return $assistance;
    }
    public function findById2($id){
        $stmt = $this->db->prepare("SELECT * FROM assistance
        WHERE id=?");
        $stmt->execute(array($id));
        $assist = $stmt->fetch(PDO::FETCH_ASSOC);

        if($assist !=null) {
            $assistance = new Assistance($assist["id"], $assist["id_userActivity"], null, null,
                $assist["date"], $assist["assist"]);
        }
        else {
            $assistance = new Assistance();
        }

        return $assistance;
    }


}
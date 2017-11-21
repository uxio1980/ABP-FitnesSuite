<?php

require_once(__DIR__."/../core/PDOConnection.php");


/**
* Class ActivityMapper
*
* Database interface for activity entities
*
* @author lipido <lipido@gmail.com>
*/
class Workout_tableMapper {
    /**
    * Reference to the PDO connection
    * @var PDO
    */
    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    /**
     * Retrieves all workout tables
     *
     * @throws PDOException if a database error occurs
     * @return mixed Array of resource instances
     */
    public function findAll() {

        $stmt = $this->db->query("SELECT * FROM workout_table");
        $tables_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tables = array();

        foreach ($tables_db as $table) {
            array_push($tables, new Workout_table($table["id"], $table["user"], $table["name"], $table["type"], $table["description"]));

        }
        return $tables;
    }

    /**
     * Retrieves all workout tables for a tdu or pef user
     *
     * @throws PDOException if a database error occurs
     * @return mixed Array of resource instances
     */
    public function findAllforUser() {
        $stmt = $this->db->prepare("SELECT * FROM workout_table ");
        $tables_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tables = array();

        if(sizeof($tables_db) > 0){
            foreach ($tables_db as $table) {
                array_push($tables, new Workout_table($table["id"], $table["id_user"], $table["name"], $table["type"], $table["description"]));
            }
            return $tables;
        } else {
            return NULL;
        }
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM workout_table WHERE id=?");
        $stmt->execute(array($id));
        $table = $stmt->fetch(PDO::FETCH_ASSOC);
       //var_dump($table);
        if($table != NULL) {
            //var_dump($table["description"]);
            $user = new User($table["id_user"]);
            return new workout_table($table["id"],$user,$table["name"],$table["type"],$table["description"]);
        } else {
            return NULL;
        }
    }

    public function save($workout_table) {
        $stmt = $this->db->prepare("INSERT INTO workout_table (id, id_user, name, type, description) 
            values (0,?,?,?,?)");
        $stmt->execute(array($workout_table->getUser()->getId(),$workout_table->getName(),$workout_table->getType(),$workout_table->getDescription()));
    }

    public function update($workout_table) {
        $stmt = $this->db->prepare("UPDATE workout_table set id=?,id_user=?, name=?, type=?, description=? where id=?");
        $stmt->execute(array($workout_table->getId(),$workout_table->getUser()->getId(),$workout_table->getName(), $workout_table->getType(),$workout_table->getDescription()));
    }

    public function delete($workout_table) {
        $stmt = $this->db->prepare("DELETE FROM workout_table WHERE id=?");
        $stmt->execute(array($workout_table->getId()));
    }

}
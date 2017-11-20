<?php

require_once(__DIR__."/../core/PDOConnection.php");


/**
* Class ActivityMapper
*
* Database interface for activity entities
*
* @author lipido <lipido@gmail.com>
*/
class Exercise_tableMapper {
    /**
    * Reference to the PDO connection
    * @var PDO
    */
    private $db;

    public function __construct() {
    $this->db = PDOConnection::getInstance();
    }

    /**
     * Retrieves all exercises of a workout table
     *
     * @throws PDOException if a database error occurs
     * @return mixed Array of resource instances
     */
    public function findAll($id_workout) {
        $stmt = $this->db->prepare("SELECT * FROM exercise_table WHERE id_workout=?");
        $stmt->execute(array($id_workout));
        $exercises_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $exercises = array();
        $exerciseMapper = new ExerciseMapper();
        if(sizeof($exercises_db) > 0){
            foreach ($exercises_db as $exercise) {
                $id_exercise = $exercise["id"];
                $exercise_db = $exerciseMapper->findById($id_exercise);

                array_push($exercises, $exercise_db);
            }
            return $exercises;
        } else {
            return NULL;
        }
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM exercise_table WHERE id=?");
        $stmt->execute(array($id));
        $exercise = $stmt->fetch(PDO::FETCH_ASSOC);

        if($exercise != null) {
            return new activity_resource($exercise["id"],$exercise["id_exercise"],
                $exercise["id_workout"]);
        } else {
            return NULL;
        }
    }

    public function save($exercise_table) {
        $stmt = $this->db->prepare("INSERT INTO exercise_table (id, id_exercise, id_workout) 
            values (0,?,?,)");
        $stmt->execute(array($exercise_table->getExercise(),$exercise_table->getWorkout()));
    }

    public function update($exercise_table) {
        $stmt = $this->db->prepare("UPDATE exercise_table set id=?,id_exercise=?,
            id_workout=?");
        $stmt->execute(array($exercise_table->getId(),$exercise_table->getExercise(),
            $exercise_table->getWorkout()));
    }

    public function delete($exercise_table) {
        $stmt = $this->db->prepare("DELETE FROM exercise_table WHERE id=?");
        $stmt->execute(array($exercise_table->getId()));
    }

    // Devuelve los ejercicios que todavía no se han asignado a la tabla.
    public function findExercisesNotInTable($id_workout){
        $stmt = $this->db->prepare("SELECT * FROM exercise WHERE id NOT IN 
            (SELECT id_exercise FROM exercise_table WHERE id_workout=?)");
        $stmt->execute(array($id_workout));
        $exercises_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $exercices = array();

        foreach ($exercises_db as $exercise) {
            array_push($exercices, new resource($exercise["id"],$exercise["id_user"],
                $exercise["name"],$exercise["description"],$exercise["type"],$exercise["image"],$exercise["video"]));
        }
        return $exercices;
    }

    // Devuelve los ejercicios  asignados a la tabla.
    public function findExercisesTable($id_workout){
        $stmt = $this->db->prepare("SELECT * FROM exercise WHERE id IN 
            (SELECT id_exercise FROM exercise_table WHERE id_workout=?)");
        $stmt->execute(array($id_workout));
        $exercises_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $exercices = array();

        foreach ($exercises_db as $exercise) {
            array_push($exercices, new resource($exercise["id"],$exercise["id_user"],
                $exercise["name"],$exercise["description"],$exercise["type"],$exercise["image"],$exercise["video"]));
        }
        return $exercices;
    }

}
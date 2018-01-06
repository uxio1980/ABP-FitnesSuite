<?php

require_once(__DIR__."/../core/PDOConnection.php");


/**
* Class ActivityMapper
*
* Database interface for activity entities
*
* @author lipido <lipido@gmail.com>
*/
class Activity_resourceMapper {
    /**
    * Reference to the PDO connection
    * @var PDO
    */
    private $db;

    public function __construct() {
    $this->db = PDOConnection::getInstance();
    }

    /**
     * Retrieves all resources
     *
     * @throws PDOException if a database error occurs
     * @return mixed Array of resource instances
     */
    public function findAll($idactivity) {
        $stmt = $this->db->prepare("SELECT * FROM activity_resource WHERE id_activity=?");
        $stmt->execute(array($idactivity));
        $resources_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $resources = array();

        if(sizeof($resources_db) > 0){
            foreach ($resources_db as $resource) {
                array_push($resources, new activity_resource($resource["id"],$resource["id_activity"],
                    $resource["id_resource"],$resource["quantity"]));
            }
            return $resources;
        } else {
            return NULL;
        }
    }

    /**
     * Retrieves all resources
     *
     * @throws PDOException if a database error occurs
     * @return mixed Array of resource instances
     */
    public function findByIdActivity($idactivity) {
        $stmt = $this->db->prepare("SELECT A_R.*, R.name as 'R.name'
          FROM activity_resource A_R
          LEFT JOIN resource R ON A_R.id_resource = R.id
          WHERE A_R.id_activity=?");
        $stmt->execute(array($idactivity));
        $resources_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $resources = array();

        if(sizeof($resources_db) > 0){
            foreach ($resources_db as $resource) {
                array_push($resources, new activity_resource($resource["id"],$resource["id_activity"],
                    $resource["id_resource"],$resource["quantity"], $resource["R.name"]));
            }
            return $resources;
        } else {
            return NULL;
        }
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM activity_resource WHERE id=?");
        $stmt->execute(array($id));
        $resource = $stmt->fetch(PDO::FETCH_ASSOC);

        if($resource != null) {
            return new activity_resource($resource["id"],$resource["id_activity"],
                $resource["id_resource"],$resource["quantity"]);
        } else {
            return NULL;
        }
    }

    public function save($activity_resource) {
        $stmt = $this->db->prepare("INSERT INTO activity_resource (id, id_activity, id_resource, quantity)
            values (0,?,?,?)");
        $stmt->execute(array($activity_resource->getIdactivity(),$activity_resource->getIdresource(),$activity_resource->getQuantity()));
    }

    public function update($activity_resource) {
        $stmt = $this->db->prepare("UPDATE activity_resource set id=?,id_activity=?,
            id_resource=?,quantity=? where id=?");
        $stmt->execute(array($activity_resource->getId(),$activity_resource->getIdactivity(),
            $activity_resource->getIdresource(), $activity_resource->getQuantity(),$activity_resource->getId()));
    }

    public function delete($activity_resource) {
        $stmt = $this->db->prepare("DELETE FROM activity_resource WHERE id=?");
        $stmt->execute(array($activity_resource->getId()));
    }

    // Devuelve los recursos que todavía no se han asignado a la actividad.
    public function findResourcesActivity($idactivity){
        $stmt = $this->db->prepare("SELECT * FROM resource WHERE id NOT IN
            (SELECT id_resource FROM activity_resource WHERE id_activity=?) AND type=?");
        $stmt->execute(array($idactivity,resourcetype::Resource));
        $resources_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $resources = array();

        foreach ($resources_db as $resource) {
          array_push($resources, new resource($resource["id"],$resource["name"],
            $resource["description"],$resource["quantity"]));
        }
        return $resources;
    }

}

<?php

require_once(__DIR__."/../core/PDOConnection.php");


/**
* Class resourceMapper
*
* Database interface for resource entities
*
* @author lipido <lipido@gmail.com>
*/
class ResourceMapper {
    /**
    * Reference to the PDO connection
    * @var PDO
    */
    private $db;

    public function __construct() {
    $this->db = PDOConnection::getInstance();
    }

    /**
    * Loads an resource from the database given its id
    *
    * @throws PDOException if a database error occurs
    * @return resource The resource instances. NULL
    * if the resource is not found
    */
    public function findById($idresource){
        $stmt = $this->db->prepare("SELECT * FROM resource WHERE id=?");
        $stmt->execute(array($idresource));
        $resource = $stmt->fetch(PDO::FETCH_ASSOC);

        if($resource != null) {
            return new resource($resource["id"],$resource["name"],$resource["description"],$resource["quantity"],$resource["type"]);
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
    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM resource ORDER BY type");
        $resources_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $resources = array();

        foreach ($resources_db as $resource) {
            array_push($resources, new resource($resource["id"],$resource["name"],
                $resource["description"],$resource["quantity"],$resource["type"]));
        }
        return $resources;
    }

    /**
    * Saves an resource into the database
    *
    * @param resource $resource The resource to be saved
    * @throws PDOException if a database error occurs
    * @return void $login=NULL, $name= NULL,$password=NULL, $email=NULL, $description=NULL
    */
    public function save($resource) {
        $stmt = $this->db->prepare("INSERT INTO resource (id, name, description, quantity, type) 
            values (0,?,?,?,?)");
        $stmt->execute(array($resource->getName(),$resource->getDescription(),$resource->getQuantity(),
            $resource->getType()));
    }

    /**
    * Updates an resource in the database
    *
    * @param resource $resource The resource to be updated
    * @throws PDOException if a database error occurs
    * @return void
    */
    public function update(resource $resource) {
        $stmt = $this->db->prepare("UPDATE resource set id=?,name=?,description=?,quantity=?,type=? where id=?");
        $stmt->execute(array($resource->getIdresource(), $resource->getName(),$resource->getDescription(), 
            $resource->getQuantity(),$resource->getType(),$resource->getIdresource()));
    }

    /**
    * Deletes an resource into the database
    *
    * @param resource $resource The resource to be deleted
    * @throws PDOException if a database error occurs
    * @return void
    */
    public function delete(resource $resource) {
        $stmt = $this->db->prepare("DELETE from resource WHERE id=?");
        $stmt->execute(array($resource->getIdresource()));
    }

    public function findAllPlaces() {
        $stmt = $this->db->query("SELECT * FROM resource WHERE type=2 ORDER BY type");
        $resources_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $resources = array();

        foreach ($resources_db as $resource) {
            array_push($resources, new resource($resource["id"],$resource["name"],
                $resource["description"],$resource["quantity"],$resource["type"]));
        }
        return $resources;
    }
}

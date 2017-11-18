<?php
require_once(__DIR__."/../core/ValidationException.php");

class Exercise {
  private $id;
  private $id_user;
  private $name;
  private $description;
  private $type;
  private $image;
  private $video;

  public function __construct($id=NULL, $id_user=NULL, $name=NULL, $description=NULL, $type=NULL, $image=NULL, $video=NULL) {
    $this->id = $id;
    $this->id_user = $id_user;
    $this->name = $name;
    $this->description = $description;
    $this->type = $type;
    $this->image = $image;
    $this->video = $video;
  }

    public function getId() {
        return $this->id;
    }

    public function getId_User() {
        return $this->id_user;
    }
    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getType() {
        return $this->type;
    }

    public function getImage() {
        return $this->image;
    }

    public function getVideo() {
        return $this->video;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setId_User($id_user) {
        $this->id_user = $id_user;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setVideo($video) {
        $this->video = $video;
    }


    /**
    * Checks if the current Exercise instance is valid
    * for being registered in the database
    *
    * @throws ValidationException if the instance is
    * not valid
    *
    * @return void
    */
    public function checkIsValidForCreate() {
        $errors = array();
        if (strlen($this->name) < 5) {
          $errors["name"] = "You must to add a name with more than 5 characters";
        }
        if (strlen($this->description) <= 0) {
            $errors["description"] = "You must to describe the exercise";
        }
        if (sizeof($errors)>0){
          throw new ValidationException($errors, "Current Exercise Instance is not valid");
        }
    }

    /**
    * Checks if the current Exercise instance is valid
    * for being updated in the database.
    *
    * @throws ValidationException if the instance is
    * not valid
    *
    * @return void
    */
    public function checkIsValidForUpdate() {
        $errors = array();

        if (strlen($this->name) < 5) {
            $errors["name"] = "You must to add a name with more than 5 characters";
        }
        if (strlen($this->description) <= 0) {
            $errors["description"] = "You must to describe the exercise";
        }
        try{
          $this->checkIsValidForCreate();
        }catch(ValidationException $ex) {
          foreach ($ex->getErrors() as $key=>$error) {
            $errors[$key] = $error;
          }
        }
        if (sizeof($errors) > 0) {
          throw new ValidationException($errors, "Current Exercise Instance is not valid");
        }
    }
}

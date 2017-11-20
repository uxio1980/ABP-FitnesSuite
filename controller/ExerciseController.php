<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Exercise.php");
require_once(__DIR__."/../model/ExerciseMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../controller/BaseController.php");
/**
* Class ExerciseController
*
* Controller to make a CRUD for Exercise
*
*/
class ExerciseController extends BaseController {

    private $exerciseMapper;
    private $date;
    private $currentDate;

    public function __construct() {
        parent::__construct();
        $this->exerciseMapper = new ExerciseMapper();
        $this->date = new DateTime();
        $this->currentDate = $this->date->getTimestamp();
    }

    /**
    * Action to list All exercise
    */
    public function index() {

        $exercises = $this->exerciseMapper->findAll();
        $this->view->setVariable("exercises", $exercises);

        if (isset($this->currentUser) && ($this->currentUser->getUser_type() == usertype::Administrator ||
                                          $this->currentUser->getUser_type() == usertype::Trainer)){
            $this->view->render("exercise", "index_admin-trainer");
        } else {
            $this->view->render("exercise", "index");
        }
    }


    public function view(){
        if (!isset($_GET["id_exercise"])) {
            throw new Exception("id exercise is mandatory");
        }

        $id_exercise = $_GET["id_exercise"];

        // Recuperar distintas actividades según usuario.
        $exercise = $this->exerciseMapper->findById($id_exercise);
        // Recupera el array de rutas a las imágenes.
        $images = json_decode($exercise->getImage());
        $videos = json_encode($exercise->getVideo());

        if ($exercise == NULL) {
            throw new Exception("->no such exercise with id: ".$id_exercise);
        }

        // put the Activity object to the view
        $this->view->setVariable("exercise", $exercise);
        $this->view->setVariable("images", $images);
        $this->view->setVariable("videos", $videos);

        // render the view (/view/activities/view.php)
        $this->view->render("exercise", "view");

    }

    /**
     * Action to add a new exercise
     */
    public function add()
    {
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Adding exercises requires admin or trainer login");
        }
        if ($this->currentUser->getUser_type()!=usertype::Administrator &&
            $this->currentUser->getUser_type()!=usertype::Trainer ){
            throw new Exception("Not valid user. Adding exercise requires Administrator or Trainer");
        }
        $exercise = new Exercise();

        if (isset($_POST["submit"])) { // reaching via HTTP Post...
            $i = 0;
            //load images in server folder
            $dir_img_load = 'resources/images/';

            // populate the exercise object with data form the form
            $exercise->setId_User($this->currentUser->getId());
            $exercise->setName($_POST["name"]);
            $exercise->setDescription($_POST["description"]);
            $exercise->setType($_POST["type"]);

            // Asigna a la variable image un array con las rutas a todas las imágenes.
            if (count($_FILES['images']['name']) > 0) {
                $images = array();
                $img_tmp = array();
                for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                    $tmpImgFilePath = $_FILES['images']['tmp_img_name'][$i];
                    if ($tmpImgFilePath != "") {
                        $fileImgPath = $dir_img_load . date('d-m-Y-H-i-s') . '-' . $_FILES['images']['name'][$i];
                        array_push($images, $fileImgPath);
                        array_push($img_tmp, $tmpImgFilePath);
                    }
                }
                $exercise->setImage(json_encode($images));
            }

            $exercise->setVideo($_POST["videos"]);

            try {
                // validate exercise object
                $exercise->checkIsValidForCreate(); // if it fails, ValidationException

                // save the activity object into the database
                $this->exerciseMapper->save($exercise);

                if (count($_FILES['images']['name']) > 0) {
                    $Imgfiles = json_decode($exercise->getImage());
                    for ($i = 0; $i < count($Imgfiles); $i++) {
                        move_uploaded_file($img_tmp[$i], $Imgfiles[$i]);
                    }
                }

                $this->view->redirect("exercise", "index");

            } catch (ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->render("exercise", "add");
    }

    /**
     * Action to edit a activity
     */
    public function edit() {

        if (!isset($_REQUEST["id_exercise"])) {
            throw new Exception("A exercise id is mandatory");
        }

        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Editing exercises requires login");
        }
        if ($this->currentUser->getUser_type()!=usertype::Administrator &&
            $this->currentUser->getUser_type()!=usertype::Trainer ){
            throw new Exception("Not valid user. Editing exercise requires Administrator or Trainer");
        }
        // Get the activity object from the database
        $id_exercise = $_REQUEST["id_exercise"];
        $exercise = $this->exerciseMapper->findById($id_exercise);
        // Does the exercise exist?
        if ($exercise == NULL) {
            throw new Exception("no such exercise with id: ".$id_exercise);
        }

        if (isset($_POST["submit"])) { // reaching via HTTP Post...
            $i = 0;
            //load images in server folder
            $dir_image_load = 'resources/images/';

            // populate the activity object with data form the form
            $exercise->setId_User($this->currentUser->getId());
            $exercise->setName($_POST["name"]);
            $exercise->setDescription($_POST["description"]);
            $exercise->setType($_POST["type"]);

            // Sube las nuevas imágenes.
            if(count($_FILES['images']['name']) > 0){
                $images = array();
                $tmp = array();
                for($i=0; $i<count($_FILES['images']['name']); $i++) {
                    $tmpFilePath = $_FILES['images']['tmp_name'][$i];
                    if($tmpFilePath != ""){
                        $filePath = $dir_image_load . date('d-m-Y-H-i-s').'-'.$_FILES['images']['name'][$i];
                        array_push($images,$filePath);
                        array_push($tmp,$tmpFilePath);
                    }
                }// Borra las imágenes anteriores.
                $img = json_decode($exercise->getImage());
                for($i=0; $i<count($img); $i++) {
                    unlink($img[$i]);
                }
                $exercise->setImage(json_encode($images));
                // Si no se edita mantiene las imágenes actuales.
            } elseif(!is_null($exercise->getImage())) {

                $exercise->setImage($exercise->getImage());
            }

            $exercise->setVideo($_POST["videos"]);

            try {
                // validate Post object
                $exercise->checkIsValidForUpdate(); // if it fails, ValidationException

                // update the Post object in the database
                $this->exerciseMapper->update($exercise);

                if(count($_FILES['images']['name']) > 0){
                    $files = json_decode($exercise->getImage());
                    for($i=0; $i<count($files); $i++) {
                        move_uploaded_file($tmp[$i], $files[$i]);
                    }
                }

                $this->view->redirect("exercise", "index");

            }catch(ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
                $this->view->render("exercise", "index");
            }
        }

        $this->view->setVariable("exercise", $exercise);

        $this->view->render("exercise", "edit");
    }


    public function delete() {
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. delete exercises requires login");
        }
        if ($this->currentUser->getUser_type()!=usertype::Administrator &&
            $this->currentUser->getUser_type()!=usertype::Trainer ){
            throw new Exception("Not valid user. Editing exercise requires Administrator or Trainer");
        }

        // Get the exercise object from the database
        $id_exercise = $_REQUEST["id_exercise"];
        $exercise = $this->exerciseMapper->findById($id_exercise);

        // Does the exercise exist?
        if ($exercise == NULL) {
            throw new Exception("no such exercise with id: ".$id_exercise);
        }

        // Delete the exercise object from the database
        $images = json_decode($exercise->getImage());
        $this->exerciseMapper->delete($exercise);

        if($images != NULL){
            for($i=0; $i<count($images); $i++) {
                unlink($images[$i]);
            }
        }

        $this->view->setFlash(sprintf(i18n("Exercise \"%s\" with name \"%s\" successfully deleted."),
                                            $exercise->getId(),$exercise->getName()));

        $this->view->redirect("exercise", "index");

    }
}

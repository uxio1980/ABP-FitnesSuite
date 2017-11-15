<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Public_Info.php");
require_once(__DIR__."/../model/Public_InfoMapper.php");

require_once(__DIR__."/../controller/BaseController.php");
/**
* Class Public_InfoController
*
* Controller to make a CRUD for public info
*
*/
class Public_InfoController extends BaseController {

    /**
    * Reference to the public_infoMapper to interact
    * with the database
    *
    * @var Public_Info
    */
    private $public_infoMapper;
    private $date;
    private $currentDate;

    public function __construct() {
        parent::__construct();
        $this->public_infoMapper = new Public_InfoMapper();
        $this->view->setLayout("default");
        $this->date = new DateTime();
        $this->currentDate = $this->date->getTimestamp();
    }

    /**
    * Action to list All exercises
    *
    * Loads all the public info from the database.
    * No HTTP parameters are needed.
    *
    */
    public function index() {
      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Listing public info requires login");
      }

      /*
      // To enable Search input in public info
      // obtain the data from the database
      if (isset($_GET["search"])) {
        $search = $_GET["search"];
        $public_infos = $this->public_infoMapper->searchAll($search);
      }else
      {
        $public_infos = $this->public_infoMapper->findAll();
      }
      */
      $public_info = $this->public_infoMapper->findById(0); //Solo tendrá la tupla con id = 0
      // put the array containing public info object to the view
      $this->view->setVariable("public_info", $public_info);

      // render the view (/view/public_info/index.php)
      $this->view->render("public_info", "index");
    }

    /**
    * Action to edit a Exercise
    */
    public function edit() {
      if (!isset($_REQUEST["id"])) {
        throw new Exception("A public id is mandatory");
      }

      if (!isset($this->currentUser)) {
        throw new Exception("Not in session. Editing public info requires login");
      }

      // Get the user object from the database
      $id_public_info = $_REQUEST["id"];
      $public_info = $this->public_infoMapper->findById($id_public_info);

      // Does the public info exist?
      if ($public_info == NULL) {
        throw new Exception("no such public info with id: ".$id_public_info);
      }

      if (isset($_POST["submit"])) {

        // populate the public info object with data form
        $public_info->setId($_POST["id"]);
        $public_info->setPhone($_POST["phone"]);
        $public_info->setEmail($_POST["email"]);
        $public_info->setAddress($_POST["address"]);

        try {
          // validate public info object
          $public_info->checkIsValidForUpdate(); // if it fails, ValidationException

          // update the public info object in the database
          $this->public_infoMapper->update($public_info);

          $this->view->redirect("public_info", "index");

        }catch(ValidationException $ex) {
          // Get the errors array inside the exepction...
          $errors = $ex->getErrors();
          // And put it to the view as "errors" variable
          $this->view->setVariable("errors", $errors);
        }
      }
      // Put the Public info object visible to the view
      $this->view->setVariable("publicInfo", $public_info);

      // render the view (/view/public_info/edit.php)
      $this->view->render("public_info", "edit");
    }
}

<?php
//file: controller/ArticlesController.php

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class TrainersController
*
* Controller to make a CRUDL of Trainers entities
*
* @author lipido <lipido@gmail.com>
*/
class TrainersController extends BaseController {

  /**
  * Reference to the ArticleMapper to interact
  * with the database
  *
  * @var TrainerMapper
  */
  private $trainerMapper;
  private $date;
  private $currentDate;

  public function __construct() {
    parent::__construct();

    $this->trainerMapper = new UserMapper();
    $this->date = new DateTime();
    $this->currentDate = $this->date->getTimestamp();
  }

  /**
  * Action to list trainers
  *
  * Loads all the trainers from the database.
  * No HTTP parameters are needed.
  *
  * The views are:
  * <ul>
  * <li>trainers/index (via include)</li>
  * </ul>
  */
  public function index() {
    // obtain the data from the database
    if (isset($_GET["search"])) {
      $search = $_GET["search"];
      $trainers = $this->trainerMapper->searchAll($search);
    }else
    {
      $trainers = $this->trainerMapper->findAllTrainers();
    }


    // put the array containing Article object to the view
    $this->view->setVariable("trainers", $trainers);

    // render the view (/view/articles/index.php)
    $this->view->render("trainers", "index");
  }

  /**
  * Action to view a given article
  *
  * This action should only be called via GET
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>id: Id of the article (via HTTP GET)</li>
  * </ul>
  *
  * The views are:
  * <ul>
  * <li>articles/view: If article is successfully loaded (via include).  Includes these view variables:</li>
  * <ul>
  *  <li>article: The current Article retrieved</li>
  * </ul>
  * </ul>
  *
  * @throws Exception If no such article of the given id is found
  * @return void
  *
  */
  public function view(){
    if (!isset($_GET["idarticle"])) {
      throw new Exception("idarticle is mandatory");
    }

    $articleid = $_GET["idarticle"];

    // find the articles object in the database

    if (!isset($this->currentUser)) {
      $article = $this->articleMapper->findById($articleid);
    }else{
        //throw new Exception("->no: ".$articleid. " - ".  $this->currentUser->getLogin());
      $article = $this->articleMapper->findByIdWithChat($articleid, $this->currentUser->getLogin());
      if ($article == NULL) {$article = $this->articleMapper->findById($articleid);};
    }

    if ($article == NULL) {
      throw new Exception("->no such article with id: ".$articleid);
    }

    // put the Article object to the view
    $this->view->setVariable("article", $article);

    // check if chatline is already on the view (for example as flash variable)
    // if not, put an empty chatline for the view
    $chatline = $this->view->getVariable("chatline");
    $this->view->setVariable("chatline", ($chatline==NULL)?new ChatLine():$chatline);
    //$this->view->setVariable("chatline", ($chatline==NULL)?"chatline es null":"chatline no es null");


    // render the view (/view/articles/view.php)
    $this->view->render("articles", "view");

  }

  /**
  * Action to add a new article
  *
  * When called via GET, it shows the add form
  * When called via POST, it adds the article to the
  * database
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>title: Title of the article (via HTTP POST)</li>
  * <li>content: Content of the post (via HTTP POST)</li>
  * </ul>
  *
  * The views are:
  * <ul>
  * <li>posts/add: If this action is reached via HTTP GET (via include)</li>
  * <li>posts/index: If post was successfully added (via redirect)</li>
  * <li>posts/add: If validation fails (via include). Includes these view variables:</li>
  * <ul>
  *  <li>post: The current Post instance, empty or
  *  being added (but not validated)</li>
  *  <li>errors: Array including per-field validation errors</li>
  * </ul>
  * </ul>
  * @throws Exception if no user is in session
  * @return void
  */
  public function add() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Adding articles requires login");
    }

    $article = new Article();

    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      $i = 0;
      //load images in server folder
      $dir_load = 'resources/images/';

      // populate the article object with data form the form
        $article->setName($_POST["name"]);
        $article->setDescription($_POST["description"]);
    	  $article->setPrice($_POST["price"]);
        $article->setUrlImage01(($_FILES["images"]["name"][0]?$i++."_".$this->currentDate."_".$_FILES["images"]["name"][0]:NULL));
    	  $article->setUrlImage02(($_FILES["images"]["name"][1]?$i++."_".$this->currentDate."_".$_FILES["images"]["name"][1]:NULL));
    	  $article->setUrlImage03(($_FILES["images"]["name"][2]?$i."_".$this->currentDate."_".$_FILES["images"]["name"][2]:NULL));

      // The user of the Article is the currentUser (user in session)
      $article->setUserLogin(new  User($this->currentUser->getLogin()));

      try {
        // validate article object
        $article->checkIsValidForCreate(); // if it fails, ValidationException

        // save the article object into the database
        $this->articleMapper->save($article);
        $j=0;

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
          $file_load = $dir_load . $j++ ."_" . $this->currentDate . "_" . basename($_FILES['images']['name']["$key"]);
          move_uploaded_file($_FILES['images']['tmp_name']["$key"], $file_load);
        }
        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts

        // perform the redirection. More or less:
        // header("Location: index.php?controller=articles&action=index")
        // die();
        $this->view->redirect("articles", "index");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Article object visible to the view
    $this->view->setVariable("article", $article);

    // render the view (/view/articles/add.php)
    $this->view->render("articles", "add");

  }

  /**
  * Action to edit a article
  *
  * When called via GET, it shows an edit form
  * including the current data of the article.
  * When called via POST, it modifies the post in the
  * database.
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>id: Id of the post (via HTTP POST and GET)</li>
  * <li>title: Title of the post (via HTTP POST)</li>
  * <li>content: Content of the post (via HTTP POST)</li>
  * </ul>
  *
  * The views are:
  * <ul>
  * <li>posts/edit: If this action is reached via HTTP GET (via include)</li>
  * <li>posts/index: If post was successfully edited (via redirect)</li>
  * <li>posts/edit: If validation fails (via include). Includes these view variables:</li>
  * <ul>
  *  <li>post: The current Post instance, empty or being added (but not validated)</li>
  *  <li>errors: Array including per-field validation errors</li>
  * </ul>
  * </ul>
  * @throws Exception if no id was provided
  * @throws Exception if no user is in session
  * @throws Exception if there is not any post with the provided id
  * @throws Exception if the current logged user is not the author of the post
  * @return void
  */
  public function edit() {
    if (!isset($_REQUEST["idarticle"])) {
      throw new Exception("A article id is mandatory");
    }

    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing articles requires login");
    }


    // Get the article object from the database
    $idarticle = $_REQUEST["idarticle"];
    $article = $this->articleMapper->findById($idarticle);
    $user = ($article->getUserLogin()->getLogin());
    $userSession = ($this->currentUser->getLogin());
    // Does the article exist?
    if ($article == NULL) {
      throw new Exception("no such article with id: ".$idarticle);
    }

    // Check if the article author is the currentUser (in Session)
    if ($user != $userSession) {
      throw new Exception("logged user is not the author of the article id ".$idarticle);
   }

    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      $i = 0;
      //load images in server folder
      $dir_load = 'resources/images/';

      // populate the article object with data form the form
        $article->setName($_POST["name"]);
        $article->setDescription($_POST["description"]);
    	  $article->setPrice($_POST["price"]);
        if($_FILES["images"]["name"][0] && $_FILES["images"]["name"][1]!=NULL && $_FILES["images"]["name"][2]!=NULL){
            $article->setUrlImage01(($_FILES["images"]["name"][0]?$i++."_".$this->currentDate."_".$_FILES["images"]["name"][0]:NULL));
            $article->setUrlImage02(($_FILES["images"]["name"][1]?$i++."_".$this->currentDate."_".$_FILES["images"]["name"][1]:NULL));
            $article->setUrlImage03(($_FILES["images"]["name"][2]?$i."_".$this->currentDate."_".$_FILES["images"]["name"][2]:NULL));
          }else{
            if($_FILES["images"]["name"][0] && $_FILES["images"]["name"][1] && $article->getUrlImage01()!=NULL){
              $article->setUrlImage01($article->getUrlImage01());
              $article->setUrlImage02(($_FILES["images"]["name"][0]?$i++."_".$this->currentDate."_".$_FILES["images"]["name"][0]:NULL));
              $article->setUrlImage03(($_FILES["images"]["name"][1]?$i."_".$this->currentDate."_".$_FILES["images"]["name"][1]:NULL));
            }else{
              if($_FILES["images"]["name"][0] && $_FILES["images"]["name"][1] && $article->getUrlImage01()==NULL){
                $article->setUrlImage01(($_FILES["images"]["name"][0]?$i++."_".$this->currentDate."_".$_FILES["images"]["name"][0]:NULL));
                $article->setUrlImage02(($_FILES["images"]["name"][1]?$i."_".$this->currentDate."_".$_FILES["images"]["name"][1]:NULL));
              }else{
                if($_FILES["images"]["name"][0] && $article->getUrlImage01()==NULL){
                  $article->setUrlImage01(($_FILES["images"]["name"][0]?$i."_".$this->currentDate."_".$_FILES["images"]["name"][0]:NULL));
                }else{
                  if($_FILES["images"]["name"][0] && $article->getUrlImage01()!=NULL && $article->getUrlImage02()==NULL ){
                    $article->setUrlImage01($article->getUrlImage01());
                    $article->setUrlImage02(($_FILES["images"]["name"][0]?$i."_".$this->currentDate."_".$_FILES["images"]["name"][0]:NULL));
                  }else{
                    if($_FILES["images"]["name"][0] && $article->getUrlImage01()!=NULL && $article->getUrlImage02()!=NULL ){
                      $article->setUrlImage01($article->getUrlImage01());
                      $article->setUrlImage02($article->getUrlImage02());
                      $article->setUrlImage03(($_FILES["images"]["name"][0]?$i."_".$this->currentDate."_".$_FILES["images"]["name"][0]:NULL));
                    }else{
                      $article->setUrlImage01($article->getUrlImage01());
                      $article->setUrlImage02($article->getUrlImage02());
                      $article->setUrlImage03($article->getUrlImage03());
                  }
                }
              }
            }
          }
        }

      // The user of the Article is the currentUser (user in session)
      $article->setUserLogin(new  User($this->currentUser->getLogin()));

      try {
        // validate Post object
        $article->checkIsValidForUpdate(); // if it fails, ValidationException

        // update the Post object in the database
        $this->articleMapper->update($article);
        $j=0;

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
          $file_load = $dir_load . $j++ ."_" . $this->currentDate . "_" . basename($_FILES['images']['name']["$key"]);
          move_uploaded_file($_FILES['images']['tmp_name']["$key"], $file_load);
        }
        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts
        // perform the redirection. More or less:
        // header("Location: index.php?controller=posts&action=index")
        // die();
        $this->view->redirect("articles", "index");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Post object visible to the view
    $this->view->setVariable("article", $article);

    // render the view (/view/articles/add.php)
    $this->view->render("articles", "edit");
  }

  /**
  * Action to delete a post
  *
  * This action should only be called via HTTP POST
  *
  * The expected HTTP parameters are:
  * <ul>
  * <li>id: Id of the post (via HTTP POST)</li>
  * </ul>
  *
  * The views are:
  * <ul>
  * <li>posts/index: If post was successfully deleted (via redirect)</li>
  * </ul>
  * @throws Exception if no id was provided
  * @throws Exception if no user is in session
  * @throws Exception if there is not any post with the provided id
  * @throws Exception if the author of the post to be deleted is not the current user
  * @return void
  */
  public function delete() {
    if (!isset($_REQUEST["idarticle"])) {
      throw new Exception("idarticle is mandatory");
    }
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing articles requires login");
    }

    // Get the article object from the database
    $idarticle = $_REQUEST["idarticle"];
    $article = $this->articleMapper->findById($idarticle);
    $user = ($article->getUserLogin()->getLogin());
    $userSession = ($this->currentUser->getLogin());
    // Does the article exist?
    if ($article == NULL) {
      throw new Exception("no such article with id: ".$idarticle);
    }

    // Check if the article author is the currentUser (in Session)
    if ($user != $userSession) {
      throw new Exception("Article author is not the logged user");
    }

    if (isset($_POST["submit"])) {
        if ($_POST["submit"] == "yes"){
          // Delete the article object from the database
            $this->articleMapper->delete($article);
            // POST-REDIRECT-GET
            // Everything OK, we will redirect the user to the list of artcles
        }
        // perform the redirection. More or less:
        // header("Location: index.php?controller=posts&action=index")
        // die();
        $this->view->redirect("articles", "listarticles");
    }
    $this->view->setVariable("article", $article);
    $this->view->render("articles", "confirm_delete");

  }

  public function listarticles() {
    // obtain the data from the database
    $articles = $this->articleMapper->findByUser($this->currentUser->getLogin());

    // put the array containing Article object to the view
    $this->view->setVariable("articles", $articles);

    // render the view (/view/articles/index.php)
    $this->view->render("users", "articles");


  }

}

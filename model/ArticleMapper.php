<?php
// file: model/ArticleMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Article.php");

/**
* Class ArticleMapper
*
* Database interface for Article entities
*
* @author lipido <lipido@gmail.com>
*/
class ArticleMapper {

  /**
  * Reference to the PDO connection
  * @var PDO
  */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
  * Retrieves all articles
  *
  * Note: chatlines are not added to the Article instances
  *
  * @throws PDOException if a database error occurs
  * @return mixed Array of Article instances
  */
  public function findAll() {
    $stmt = $this->db->query("SELECT A.*,
      U.login as 'user.login',
      U.name as 'user.name',
      U.email as 'user.email',
      U.description as 'user.description'

      FROM article A LEFT JOIN user U
      ON A.user_login = U.login");
      $articles_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $articles = array();

      foreach ($articles_db as $article) {
        $usuario = new User($article["user.login"],
        $article["user.name"],
        NULL/*password*/,
        $article["user.email"],
        $article["user.description"]
      );
      array_push($articles, new Article($article["idarticle"], $article["name"], $article["description"], $article["price"], $article["url_image01"], $article["url_image02"], $article["url_image03"], $usuario));
    }
    return $articles;
  }

  /**
  * Retrieves articles
  *
  *
  * @throws PDOException if a database error occurs
  * @return mixed Array of Article instances
  */
  public function searchAll($value) {
    $stmt = $this->db->prepare("SELECT A.*,
      U.login as 'user.login',
      U.name as 'user.name',
      U.email as 'user.email',
      U.description as 'user.description'

      FROM article A LEFT JOIN user U
      ON A.user_login = U.login
      WHERE A.description LIKE :search");
      $stmt->execute(array(':search' => '%' . $value . '%'));
      $articles_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $articles = array();

      foreach ($articles_db as $article) {
        $usuario = new User($article["user.login"],
        $article["user.name"],
        NULL/*password*/,
        $article["user.email"],
        $article["user.description"]
      );
      array_push($articles, new Article($article["idarticle"], $article["name"], $article["description"], $article["price"], $article["url_image01"], $article["url_image02"], $article["url_image03"], $usuario));
    }

    return $articles;
  }

  /**
  * Loads a Article from the database given its id
  *
  *
  * @throws PDOException if a database error occurs
  * @return Article The Article instances. NULL
  * if the Article is not found
  */
  public function findById($idarticle){
    $stmt = $this->db->prepare("SELECT A.*,
      U.login as 'user.login',
      U.name as 'user.name',
      U.email as 'user.email',
      U.description as 'user.description',
      U.profile_Image as 'user.profileImage'

      FROM article A LEFT JOIN user U
      ON A.user_login = U.login
      WHERE
      A.idarticle=?");
      $stmt->execute(array($idarticle));
      $article = $stmt->fetch(PDO::FETCH_ASSOC);

      if($article != null) {
        $usuario = new User($article["user.login"],
        $article["user.name"],
        NULL/*password*/,
        $article["user.email"],
        $article["user.description"],
        $article["user.profileImage"]
      );
      return new Article(
      $article["idarticle"],
      $article["name"],
      $article["description"],
      $article["price"],
      $article["url_image01"],
      $article["url_image02"],
      $article["url_image03"],
      $usuario);
    } else {
      return NULL;
    }
  }

  /**
  * Loads an Article from the database given its idarticle
  *
  *
  * @throws PDOException if a database error occurs
  * @return Article The Article instances. NULL
  * if the Article is not found
  */
  public function findByIdWithChat($idarticle,$currentuser){
    $stmt = $this->db->prepare("SELECT
      A.idarticle as 'article.idarticle',
      A.name as 'article.name',
      A.description as 'article.description',
      A.price as 'article.price',
      A.url_image01 as 'article.url_image01',
      A.url_image02 as 'article.url_image02',
      A.url_image03 as 'article.url_image03',
      A.user_login as 'article.user_login',
      U.login as 'user.login',
      U.name as 'user.name',
      U.email as 'user.email',
      U.description as 'user.description',
      U.profile_Image as 'user.profile_Image',
      C.idchat as 'chat.idchat',
      C.time as 'chat.time',
      C.user_login as 'chat.user_login',
      CL.chat_idchat as 'chat_line.chat_idchat',

      CL.idchat_line as 'chat_line.idchat_line',
      CL.line as 'chat_line.line',
      CL.isowner as 'chat_line.isowner'
      FROM
      article A
      LEFT JOIN user U ON (A.user_login = U.login)
      , chat C
      LEFT JOIN chat_line CL ON (C.idchat = CL.chat_idchat)
      WHERE
      A.idarticle=? and C.user_login=?");

      $stmt->execute(array( $idarticle, $currentuser));
      $article_wt_chat= $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (sizeof($article_wt_chat) > 0) {
        $article = new Article($article_wt_chat[0]["article.idarticle"],
        $article_wt_chat[0]["article.name"],
        $article_wt_chat[0]["article.description"],
        $article_wt_chat[0]["article.price"],
        $article_wt_chat[0]["article.url_image01"],
        $article_wt_chat[0]["article.url_image02"],
        $article_wt_chat[0]["article.url_image03"],
        new User($article_wt_chat[0]["user.login"],
          $article_wt_chat[0]["user.name"],
          NULL, //$article_wt_chat[0]["user.password"],
        $article_wt_chat[0]["user.email"],
        $article_wt_chat[0]["user.description"],
        $article_wt_chat[0]["user.profile_Image"]
      ));
      $chat_array = array();
      if ($article_wt_chat[0]["chat.idchat"]!=null) {
        foreach ($article_wt_chat as $chatline){
          $chatline = new ChatLine( $chatline["chat_line.idchat_line"],
          $chatline["chat_line.line"],
          $chatline["chat_line.isowner"],
          New User(),
          new Chat($chatline["chat_line.chat_idchat"]));
          array_push($chat_array, $chatline);
        }
      }
      $article->setChatLines($chat_array);

      return $article;
    }else {
      return NULL;
    }
  }

  public function findByUser($user) {

    $stmt = $this->db->prepare("SELECT A.*,
      U.login as 'user.login',
      U.name as 'user.name',
      U.email as 'user.email',
      U.description as 'user.description'

      FROM article A LEFT JOIN user U
      ON A.user_login = U.login
      WHERE
      A.user_login=?");

      $stmt->execute(array($user));
      $articles_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $articles = array();

      if ($articles_db != NULL){
        $usuario = new User($articles_db[0]["user.login"],
        $articles_db[0]["user.name"],
        NULL/*password*/,
        $articles_db[0]["user.email"],
        $articles_db[0]["user.description"]
      );

      if(sizeof($articles_db) > 0){
        foreach ($articles_db as $article) {
          array_push($articles, new Article($article["idarticle"], $article["name"], $article["description"], $article["price"], $article["url_image01"], $article["url_image02"], $article["url_image03"], $usuario));
        }
      }
    }
    return $articles;
  }

  /**
  * Saves a Article into the database
  *
  * @param Article $article The article to be saved
  * @throws PDOException if a database error occurs
  * @return int The new article idarticle
  */
  public function save(Article $article) {
    $stmt = $this->db->prepare("INSERT INTO article(name, description, price, url_image01, url_image02, url_image03, user_login) values (?,?,?,?,?,?,?)");
    $stmt->execute(array($article->getName(), $article->getDescription(), $article->getprice(), $article->getUrlImage01(), $article->getUrlImage02(), $article->getUrlImage03(), $article->getUserLogin()->getLogin()));
    return $this->db->lastInsertId();
  }

  /**
  * Updates an Article in the database
  *
  * @param Article $article The article to be updated
  * @throws PDOException if a database error occurs
  * @return void
  */
  public function update(Article $article) {
    $stmt = $this->db->prepare("UPDATE article set name=?, description=?, price=?, url_image01=?, url_image02=?, url_image03=? where idarticle=?");
    $stmt->execute(array($article->getName(), $article->getDescription(), $article->getPrice(), $article->getUrlImage01(), $article->getUrlImage02(), $article->getUrlImage03(), $article->getIdArticle()));
  }

  /**
  * Deletes an Article into the database
  *
  * @param Article $article The Article to be deleted
  * @throws PDOException if a database error occurs
  * @return void
  */
  public function delete(Article $article) {
    $stmt = $this->db->prepare("DELETE from article WHERE idarticle=?");
    $stmt->execute(array($article->getIdArticle()));
  }

}

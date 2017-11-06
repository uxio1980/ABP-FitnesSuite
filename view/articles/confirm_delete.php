<?php
 //file: view/articles/delete_confirm.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $article = $view->getVariable("article");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Confirm Delete");

?>

<main id="main-content">
  <div class="form">
    <form action="index.php?controller=articles&amp;action=delete" method="POST">
    	<strong><?= i18n("Are you sure to delete?")?></strong>
      <div class="answer">
        <button type="submit" value="yes" name="submit"><?= i18n("Yes") ?></button>
        <button type="submit" value="no" name="submit"><?= i18n("No") ?></button>
      </div>
      <input type="hidden" name="idarticle" value="<?= $article->getIdArticle() ?>">
  </form>
  </div>
</main>
<script src="js/index.js"></script>

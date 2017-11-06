<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $article = $view->getVariable("article");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit Article");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=articles&amp;action=edit" method="POST"
		 enctype="multipart/form-data">
			<strong><?= i18n("Modify product") ?></strong>
			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name" value="<?= $article->getName() ?>" minlength="2" maxlength="50" required >
			<?= isset($errors["name"])?$errors["name"]:"" ?>

			<label for="form-field"><?= i18n("Price") ?></label>
			<input type="number" min="1" name="price" value="<?= $article->getPrice() ?>" required>
			<?= isset($errors["price"])?$errors["price"]:"" ?>

			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" rows="4" cols="50"><?=$article->getDescription() ?></textarea>
			<?= isset($errors["description"])?$errors["description"]:"" ?><br>

			<label for="name-field"><?= i18n("Images") ?> (<?= i18n("select up to three images") ?>)</label>
			<input type="file" name="images[]" multiple accept="image/*">
			<?= isset($errors["images"])?$errors["images"]:"" ?><br>

      <div class="action">
        <input name="idarticle" value="<?= $article->getIdArticle() ?>" hidden="true">
  			<button type="submit" name="submit"><?= i18n("Modify") ?></button>
        <a href="index.php?controller=articles&amp;action=delete&amp;idarticle=<?= $article->getIdArticle() ?>">
          <?= i18n("Delete") ?>
        </a>
      </div>

    	</form>
    </div>

</main>
<script src="js/index.js"></script>

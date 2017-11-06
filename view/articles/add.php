<?php
 //file: view/articles/add.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $article = $view->getVariable("article");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", i18n("Add article"));

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=articles&amp;action=add" method="POST"
		enctype="multipart/form-data">
			<strong><?= i18n("Upload product") ?></strong>
			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name"  minlength="2" maxlength="50" required>
			<?= isset($errors["name"])?$errors["name"]:"" ?>

			<label for="form-field"><?= i18n("Price") ?></label>
			<input type="number" min="1" name="price" required>
			<?= isset($errors["price"])?$errors["price"]:"" ?>

			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" rows="4" cols="50"> </textarea>
			<?= isset($errors["description"])?$errors["description"]:"" ?><br>

			<label for="name-field"><?= i18n("Images") ?> (<?= i18n("select up to three images") ?>)</label>
			<input type="file" name="images[]" multiple accept="image/*">
			<?= isset($errors["images"])?$errors["images"]:"" ?><br>

			<input type="submit" name="submit" value="<?= i18n("Upload") ?>">
    	</form>
    </div>
</main>

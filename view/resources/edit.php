<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $resource = $view->getVariable("resource");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit Activity");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=resources&amp;action=edit" method="POST"
		 enctype="multipart/form-data">
			<strong><?= i18n("Modify resource") ?></strong>
			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name" value="<?= $resource->getName() ?>" minlength="2" maxlength="50" required >
			<?= isset($errors["name"])?$errors["name"]:"" ?>

			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" rows="4" cols="50"><?=$resource->getDescription() ?></textarea>
			<?= isset($errors["description"])?$errors["description"]:"" ?><br>

            <label for="form-field"><?= i18n("Quantity") ?></label>
			<input type="number" name="quantity" value="<?= $resource->getQuantity() ?>" min="1" required >
			<?= isset($errors["quantity"])?$errors["quantity"]:"" ?>

			<input name="idresource" value="<?= $resource->getIdresource() ?>" hidden="true">
			<input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Add resource");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=resources&amp;action=add_place" method="POST"
		 enctype="multipart/form-data">

			<strong><?= i18n("Add place") ?></strong>

			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name" minlength="2" maxlength="45" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ0-9 ]+" title="Formato incorrecto" required >
			<?= isset($errors["name"])?$errors["name"]:"" ?>

			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" rows="4" cols="50" required></textarea>
			<?= isset($errors["description"])?$errors["description"]:"" ?><br>

			<input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>
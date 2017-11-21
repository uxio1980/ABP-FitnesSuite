<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $trainers = $view->getVariable("trainers");
 $places = $view->getVariable("places");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit Activity");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=activities&amp;action=add" method="POST"
		 enctype="multipart/form-data">
			<strong><?= i18n("Add activity") ?></strong>
			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name" minlength="2" maxlength="45" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ ]+" title="Formato incorrecto" required >
			<?= isset($errors["name"])?$errors["name"]:"" ?>

			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" rows="4" cols="50" required></textarea>
			<?= isset($errors["description"])?$errors["description"]:"" ?><br>

            <label for="form-field"><?= i18n("Trainer") ?></label>
			<select name="id_user">
				<?php foreach ($trainers as $trainer): ?>
				<option value="<?= $trainer->getId()?>"><?= $trainer->getName()?></option>
				<?php endforeach; ?>
			</select>

			<label for="form-field"><?= i18n("Type") ?></label>
			<select name="type">
				<option value="1"><?= i18n("Individual") ?></option>
				<option value="2"><?= i18n("In group") ?></option>
			</select>

			<label for="form-field"><?= i18n("Place") ?></label>
			<select name="place">
				<?php foreach ($places as $place): ?>
				<option value="<?= $place->getIdresource()?>"><?= $place->getName()?></option>
				<?php endforeach; ?>
			</select>

            <label for="form-field"><?= i18n("Seats") ?></label>
			<input type="number" min="1" name="seats" required>
			<?= isset($errors["seats"])?$errors["seats"]:"" ?>

			<label for="name-field"><?= i18n("Images") ?> (<?= i18n("select one image") ?>)</label>
			<input type="file" name="images[]" multiple accept="image/*">
			<?= isset($errors["images"])?$errors["images"]:"" ?><br>

			<input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

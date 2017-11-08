<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $activity = $view->getVariable("activity");
 $trainers = $view->getVariable("trainers");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit Activity");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=activities&amp;action=edit" method="POST"
		 enctype="multipart/form-data">
			<strong><?= i18n("Modify activity") ?></strong>
			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name" value="<?= $activity->getName() ?>" minlength="2" maxlength="50" required >
			<?= isset($errors["name"])?$errors["name"]:"" ?>

			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" rows="4" cols="50"><?=$activity->getDescription() ?></textarea>
			<?= isset($errors["description"])?$errors["description"]:"" ?><br>

            <label for="form-field"><?= i18n("Trainer") ?></label>
			<select name="id_user">
				<?php foreach ($trainers as $trainer): ?>
				<option <?=($activity->getIduser()==$trainer->getId())?'selected="selected"':''?> value="<?= $trainer->getId()?>"><?= $trainer->getName()?></option>
				<?php endforeach; ?>
			</select>

            <label for="form-field"><?= i18n("Place") ?></label>
			<input type="text" name="place" value="<?= $activity->getPlace() ?>" minlength="2" maxlength="50" required >
			<?= isset($errors["place"])?$errors["place"]:"" ?>

            <label for="form-field"><?= i18n("Type") ?></label>
			<input type="text" name="type" value="<?= $activity->getType() ?>" minlength="2" maxlength="50" required >
			<?= isset($errors["type"])?$errors["type"]:"" ?>

            <label for="form-field"><?= i18n("Seats") ?></label>
			<input type="number" min="1" name="seats" value="<?= $activity->getSeats() ?>" required>
			<?= isset($errors["seats"])?$errors["seats"]:"" ?>

			<label for="name-field"><?= i18n("Image") ?> (<?= i18n("select one image") ?>)</label>
			<input type="file" name="image[]" multiple accept="image/*">
			<?= isset($errors["image"])?$errors["image"]:"" ?><br>

			<input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

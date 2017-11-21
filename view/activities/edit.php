<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $activity = $view->getVariable("activity");
 $trainers = $view->getVariable("trainers");
 $places = $view->getVariable("places");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit Activity");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=activities&amp;action=edit" method="POST"
		 enctype="multipart/form-data">
			<strong><?= i18n("Modify activity") ?></strong>
			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name" value="<?= $activity->getName() ?>" minlength="2" maxlength="45" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ ]+" title="Formato incorrecto" required >
			<?= isset($errors["name"])?$errors["name"]:"" ?>

			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" rows="4" cols="50" required><?=$activity->getDescription() ?></textarea>
			<?= isset($errors["description"])?$errors["description"]:"" ?><br>

            <label for="form-field"><?= i18n("Trainer") ?></label>
			<select name="id_user" required="true">
				<?php foreach ($trainers as $trainer): ?>
				<option <?=($activity->getIduser()==$trainer->getId())?'selected="selected"':''?>
					value="<?= $trainer->getId()?>"><?= $trainer->getName()?></option>
				<?php endforeach; ?>
			</select>

			<label for="form-field"><?= i18n("Type") ?></label>
			<select name="type" required="true">
				<option <?=($activity->getType()==1)?'selected="selected"':''?>
					value="1"><?= i18n("Individual") ?></option>
				<option <?=($activity->getType()==2)?'selected="selected"':''?>
					value="2"><?= i18n("In group") ?></option>
			</select>

			<label for="form-field"><?= i18n("Place") ?></label>
			<select name="place" required="true">
				<?php foreach ($places as $place): ?>
				<option <?=($activity->getPlace()==$place->getIdresource())?'selected="selected"':''?>
					value="<?= $place->getIdresource()?>"><?= $place->getName()?></option>
				<?php endforeach; ?>
			</select>

            <label for="form-field"><?= i18n("Seats") ?></label>
			<input type="number" min="1" name="seats" value="<?= $activity->getSeats() ?>" required>
			<?= isset($errors["seats"])?$errors["seats"]:"" ?>

			<label for="name-field"><?= i18n("Images") ?> (<?= i18n("select one image") ?>)</label>
			<input type="file" name="images[]" multiple accept="image/*">
			<?= isset($errors["image"])?$errors["image"]:"" ?><br>

			<input name="idactivity" value="<?= $activity->getIdactivity() ?>" hidden="true">
			<input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

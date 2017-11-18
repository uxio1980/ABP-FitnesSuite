<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Add Exercise");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=exercise&amp;action=add" method="POST"
		 enctype="multipart/form-data">
			<strong><?= i18n("Add Exercise") ?></strong>
			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name" minlength="2" maxlength="50" required >
			<?= isset($errors["name"])?$errors["name"]:"" ?>

			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" rows="4" cols="50"></textarea>
			<?= isset($errors["description"])?$errors["description"]:"" ?><br>

            <label for="form-field"><?= i18n("Type") ?></label>
			<select name="type">
				<option value="<?=i18n("Cardiovascular")?>"><?=i18n("Cardiovascular")?></option>
                <option value="<?=i18n("Muscular")?>"><?=i18n("Muscular")?></option>
                <option value="<?=i18n("Stretch")?>"><?=i18n("Stretch")?></option>
			</select>
			<label for="name-field"><?= i18n("Image") ?> (<?= i18n("select a image") ?>)</label>
			<input type="file" name="images[]" multiple accept="image/*">
			<?= isset($errors["images"])?$errors["images"]:"" ?><br>

           <label for="name-field"><?= i18n("Video") ?> (<?= i18n("enter the url of a video") ?>)</label>
           <input type="url" name="video" placeholder="Video URL">

			<input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

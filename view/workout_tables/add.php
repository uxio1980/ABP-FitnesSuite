<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $exercises = $view->getVariable("exercises");
 $view->setVariable("title", "Add Workout table");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=workout_tables&amp;action=add" method="POST"
		 enctype="multipart/form-data">
			<strong><?= i18n("Add workout table") ?></strong>
			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name" minlength="2" maxlength="45" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ 0-9]+" title="Formato incorrecto" required >
			<?= isset($errors["name"])?$errors["name"]:"" ?>

           <label for="form-field"><?= i18n("Type") ?></label>
           <select name="type">
               <option value="standard"><?= i18n("standard")?></option>
               <option value="customized"><?= i18n("customized")?></option>
           </select>

			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" rows="4" cols="50" required></textarea>
			<?= isset($errors["description"])?$errors["description"]:"" ?><br>

           <input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

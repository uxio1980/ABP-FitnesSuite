<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $workout_table = $view->getVariable("workout_table");
 $view->setVariable("title", "Edit Workout table");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=workout_tables&amp;action=edit" method="POST"
		 enctype="multipart/form-data">
			<strong><?= i18n("Edit workout table") ?></strong>
			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name" placeholder="<?=$workout_table->getName()?>" minlength="2" maxlength="45" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ ]+" title="Formato incorrecto">
			<?= isset($errors["name"])?$errors["name"]:"" ?>

           <label for="form-field"><?= i18n("Type") ?></label>
           <select name="type" placeholder="<?=$workout_table->getType()?>">
               <option value="standard"><?= i18n("standard")?></option>
               <option value="customized"><?= i18n("customized")?></option>
           </select>

			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" placeholder="<?=$workout_table->getDescription()?>" rows="4" cols="50"></textarea>
			<?= isset($errors["description"])?$errors["description"]:"" ?><br>
           <input name="id_workout" value="<?= $workout_table->getId() ?>" hidden="true">
           <input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

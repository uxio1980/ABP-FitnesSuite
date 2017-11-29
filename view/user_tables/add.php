<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $workout_tables = $view->getVariable("workout_tables");
 $id_user =  $view->getVariable("id_user");

 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Add Exercises");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=user_tables&amp;action=add" method="POST">

			<strong><?= i18n("Assign workout table") ?></strong>

			<label for="form-field"><?= i18n("Workout tables") ?></label>
			<select name="id_workout" class="select" required>
				<option value=""></option>
				<?php foreach ($workout_tables as $table): ?>
				<option value="<?= $table->getId()?>">
					<?= $table->getName()?></option>
				<?php endforeach; ?>
			</select>

            <input name="login" value="<?= $id_user ?>" hidden="true">
			<input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

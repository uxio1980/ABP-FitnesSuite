<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $exercises = $view->getVariable("exercises");
 $id_workout = $view->getVariable("id_workout");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Add Exercises");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=exercises_table&amp;action=add" method="POST">

			<strong><?= i18n("Add exercise") ?></strong>

			<label for="form-field"><?= i18n("Exercise") ?></label>
			<select name="id_exercise" class="select" required>
				<option value=""></option>
				<?php foreach ($exercises as $exercise): ?>
				<option value="<?= $exercise->getId()?>">
					<?= $exercise->getName()?></option>
				<?php endforeach; ?>
			</select>

           <label for="form-field"><?= i18n("Number of series") ?></label>
                <input name="series" type="number" name="quantity" min="1" max="99" required>
           <label for="form-field"><?= i18n("Number of repetitions") ?></label>
                <input name="repetitions" type="number" name="quantity" min="1" max="99" required>

            <input name="id_workout" value="<?= $id_workout ?>" hidden="true">
			<input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

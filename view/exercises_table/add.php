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
			<select name="id_exercise" class="select" required onchange="yesnoCheck(this);">
				<?php foreach ($exercises as $exercise): ?>
				<option value="<?= $exercise->getId()?>, <?= $exercise->getType() ?>">
					<?= $exercise->getName()?></option>
				<?php endforeach; ?>
			</select>
      <br>
      <div id="typeCardiovascular" style="display: none;">
        <label for="form-field"><?= i18n("Duration") ?> (<?= i18n("minutes") ?>)</label><br>
             <input name="duration" type="number" name="quantity" value="1" min="1" max="99">
      </div>
      <div id="typeNotCardiovascular" style="display: none;">
       <label for="form-field"><?= i18n("Number of series") ?></label>
            <input name="series" type="number" name="quantity" min="1" max="99" value="1">
        <br><br>
       <label for="form-field"><?= i18n("Number of repetitions") ?></label>
            <input name="repetitions" type="number" name="quantity" min="1" max="99" value="1">
       </div>
        <input name="id_workout" value="<?= $id_workout ?>" hidden="true">
			<input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
      </form>
    </div>

</main>

<script>
   function yesnoCheck(that) {
     var tipo = that.value.split(", ");
       if (tipo[1] == "Cardiovascular" || tipo[1] == "Estiramiento") {
           document.getElementById("typeCardiovascular").style.display = "block";
           document.getElementById("typeNotCardiovascular").style.display = "none";
       } else {
           document.getElementById("typeCardiovascular").style.display = "none";
           document.getElementById("typeNotCardiovascular").style.display = "block";
       }
   }
</script>
<script src="js/index.js"></script>

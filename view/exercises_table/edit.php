<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $exercise = $view->getVariable("exercise");
 $exercises = $view->getVariable("exercises");
 $exercise_table = $view->getVariable("exercise_table");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit exercises from workout table ");

?>
<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=exercises_table&amp;action=edit" method="POST">

			<strong><?= i18n("Modify exercise") ?> <?=i18n("from table")?></strong>

           <input type="hidden" name="id_workout" value="<?= $exercise_table->getWorkout() ?>"/>

           <label for="form-field"><?= i18n("Number of series") ?></label>
           <input name="series" type="number" name="quantity" min="1" max="99" required value="<?= $exercise_table->getSeries() ?>">
           <label for="form-field"><?= i18n("Number of repetitions") ?></label>
           <input name="repetitions" type="number" name="quantity" min="1" max="99" required value="<?= $exercise_table->getRepetitions() ?>">


           <input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
           <input name="id" value="<?= $exercise_table->getId() ?>" hidden="true">
      </form>
    </div>

</main>
<script src="js/index.js"></script>
<script>
$('select').change(function(){
    $('input[type=number]').attr('max', $(this).find(":selected").data('max'));
});
</script>

<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $exercise = $view->getVariable("exercise");
 $exercises = $view->getVariable("exercises");
 $exercise_table = $view->getVariable("exercise_table");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", i18n("Modify exercise"));

?>
<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=exercises_table&amp;action=edit" method="POST">

			<strong><?= i18n("Modify exercise") ?> <?=i18n("from table")?></strong>

           <input type="hidden" name="id_workout" value="<?= $exercise_table->getWorkout() ?>"/>

           <?php if($exercise->getType()=="Cardiovascular" || $exercise->getType()=="Estiramiento"): ?>
             <label for="form-field"><?= i18n("Duration") ?> (<?= i18n("minutes") ?>)</label>
             <input name="duration" type="number" name="quantity" min="1" max="99" value="<?= $exercise_table->getDuration() ?>">
             <?= isset($errors["duration"])?$errors["duration"]:"" ?>
           <?php else: ?>
             <label for="form-field"><?= i18n("Number of series") ?></label>
             <input name="series" type="number" name="quantity" min="1" max="99" value="<?= $exercise_table->getSeries() ?>">
             <?= isset($errors["series"])?$errors["series"]:"" ?>
             <label for="form-field"><?= i18n("Number of repetitions") ?></label>
             <input name="repetitions" type="number" name="quantity" min="1" max="99" value="<?= $exercise_table->getRepetitions() ?>">
             <?= isset($errors["repetitions"])?$errors["repetitions"]:"" ?>
           <?php endif ?>
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

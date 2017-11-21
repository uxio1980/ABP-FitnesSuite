<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $exercise = $view->getVariable("exercise");
 $exercises = $view->getVariable("exercises");
 $exercise_table = $view->getVariable("exercise_table");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit exercises from wrokout table ");

?>
<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=exercises_table&amp;action=edit" method="POST">

			<strong><?= i18n("Modify exercise from a table") ?></strong>



           <label for="form-field"><?= i18n("Number of Series") ?></label>
           <input name="series" type="number" name="quantity" min="1" max="99" required>
           <label for="form-field"><?= i18n("Number of Repetitions") ?></label>
           <input name="repetitions" type="number" name="quantity" min="1" max="99" required>


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
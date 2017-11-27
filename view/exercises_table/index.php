<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $id_workout = $view->getVariable("id_workout");
 $table_exercises = $view->getVariable("table_exercises");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Manage exercises")?></strong><br>
      <a href="index.php?controller=exercises_table&amp;action=add&amp;id_workout=<?= $id_workout ?>"><input type='button' value=<?= i18n("Add")?> /></a>
    </div>
    <table id="table-content">
      <tr class="table-row-content">
        <td><strong><?= i18n("Exercise")?></strong></td>
        <td><strong><?= i18n("Series")?></strong></td>
        <td><strong><?= i18n("Repetitions")?></strong></td>
      <?php if (isset($table_exercises)):
      foreach ($table_exercises as $exercise_table): ?>
        <tr class="table-row-content"
          data-href="index.php?controller=activity_resources&amp;action=edit&amp;id=<?= $exercise_table->getId() ?>">
          <td><?= $exercise_table->getExercise()->getName() ?></td>
          <td><?= $exercise_table->getSeries() ?></td>
          <td><?= $exercise_table->getRepetitions() ?></td>
          <td><a href="index.php?controller=exercises_table&amp;action=edit&amp;id=<?= $exercise_table->getId() ?>">
            <img src="resources/icons/edit_icon.svg" alt="Edit" /></a>
          </td>
          <td><a class="confirmation" href="index.php?controller=exercises_table&amp;action=delete&amp;id=<?= $exercise_table->getId() ?>">
            <img src="resources/icons/delete_icon.svg" alt="Delete"/></a>
          </td>
        </tr>
      <?php endforeach;
    endif; ?>
  </table>
  </div>
</main>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>

 <script src="js/index.js"></script>

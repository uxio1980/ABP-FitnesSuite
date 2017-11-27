<?php
//file: view/articles/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$table = $view->getVariable("table");
$exercises = $view->getVariable("exercises");
$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
    <div id="content-list">
        <div class="content-title">
            <strong><?= i18n("Workout table")." ".i18n("for")." ".$table->getName()?></strong><br>
            <a href=""><input type='button' value=<?= i18n("Print")?> /></a>
        </div>
        <table id="table-content" style="text-align: center;">
            <tr class="table-row-content">
                <td><strong><?= i18n("Name")?></strong></td>
                <td><strong><?= i18n("Series")?></strong></td>
                <td><strong><?= i18n("Repetitions")?></strong></td>
                <td><strong><?= i18n("View")?></strong></td>
                <?php if (isset($exercises)):
                foreach ($exercises as $exercise): ?>
                <tr class="table-row-content"
                  data-href="index.php?controller=activities&amp;action=edit&amp;id_exercise=<?= $exercise->getExercise()->getId() ?>">
                  <td><?= $exercise->getExercise()->getName() ?></td>
                  <td><?= $exercise->getSeries() ?></td>
                  <td><?= $exercise->getRepetitions() ?></td>
                  <td><a href="index.php?controller=exercise&amp;action=view&amp;id_exercise=<?= $exercise->getExercise()->getId() ?>">
                          <img src="resources/icons/ic_visibility_black_24px.svg" alt="View" /></a>
                  </td>

                </tr>
            <?php endforeach; endif;?>

        </table>
    </div>
</main>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>

<script src="js/index.js"></script>

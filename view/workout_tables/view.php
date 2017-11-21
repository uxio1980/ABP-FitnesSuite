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
            <strong><?= i18n("Workout tabale ").$table->getName()?></strong><br>
            <a href="index.php?controller=sessions&amp;action=index"><input type='button' value=<?= i18n("Monitor training session")?> /></a>
        </div>
        <table id="table-content">
            <tr class="table-row-content">
                <td><strong><?= i18n("Name")?></strong></td>
                <td><strong><?= i18n("Series")?></strong></td>
                <td><strong><?= i18n("Repetitions")?></strong></td>
                <td><strong><?= i18n("View")?></strong></td>
                <?php foreach ($exercises as $exercise): ?>
                    <tr class="table-row-content"
                        data-href="index.php?controller=activities&amp;action=edit&amp;idactivity=<?= $exercise->getExercise()->getId() ?>">
                        <td><?= $exercise->getExercise()->getName() ?></td>
                        <td><?= $exercise->getSeries() ?></td>
                        <td><?= $exercise->getRepetitions() ?></td>
                        <td><a href="index.php?controller=exercise&amp;action=view&amp;id_exercise=<?= $exercise->getExercise()->getId() ?>">
                                <img src="resources/icons/ic_visibility_black_24px.svg" alt="View" /></a>
                        </td>

                    </tr>
            <?php endforeach; ?>

        </table>
        <spam class="content-title">
            <strong><?= i18n("Workout tabale ").$table->getName()?></strong><br>
            <a href="index.php?controller=workout_tables&amp;action=print"><input type='button' value=<?= i18n("Print workout table")?> /></a>
        </spam>
    </div>
</main>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>

<script src="js/index.js"></script>

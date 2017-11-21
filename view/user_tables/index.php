<?php
 //file: view/activities/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $tables = $view->getVariable("table_exercises");
 $view->setVariable("title", "FitnesSuite");
?>
<main id="main-content">
    <div id="content-list">
        <div class="content-title">
            <strong><?= i18n("Workout Tables of this user")?></strong><br>

        </div>
        <table id="table-content" style="text-align: center;"  >
            <tr class="table-row-content">
                <td><strong><?= i18n("Name")?></strong></td>
                <td><strong><?= i18n("View")?></strong></td>
                <td><strong><?= i18n("Edit")?></strong></td>
                <td><strong><?= i18n("Manage Exercices")?></strong></td>
                <td><strong><?= i18n("Delete")?></strong></td>
                <td><strong><?= i18n("Print")?></strong></td>
                <?php foreach ($tables as $table): ?>
                    <tr class="table-row-content"
                        data-href="index.php?controller=workout_tables&amp;action=edit&amp;id_workout=<?= $table->getId() ?>">
                        <td><?= $table->getName() ?></td>
                        <td><a href="index.php?controller=workout_tables&amp;action=view&amp;id_workout=<?= $table->getId() ?>">
                                <img src="resources/icons/ic_visibility_black_24px.svg" alt="View" /></a>
                        </td>
                        <td><a href="index.php?controller=workout_tables&amp;action=edit&amp;id_workout=<?= $table->getId() ?>">
                                <img src="resources/icons/edit_icon.svg" alt="Edit" /></a>
                        </td>
                        <td><a href="index.php?controller=exercises_table&amp;action=index&amp;id_workout=<?= $table->getId() ?>">
                                <img src="resources/icons/manage_res.svg" alt="Resources" /></a>
                        </td>
                        <td><a class="confirmation" href="index.php?controller=user_tables&amp;action=delete&amp;id=<?= $table->getId() ?>">
                                <img src="resources/icons/delete_icon.svg" alt="Delete"/></a>
                        </td>
                        <td><a class="confirmation" href="index.php?controller=workout_tables&amp;action=print&amp;id_workout=<?= $table->getId() ?>">
                                <img src="resources/icons/ic_print.svg" alt="Print"/></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
</main>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>

<script src="js/index.js"></script>

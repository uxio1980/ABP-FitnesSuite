<?php
//file: view/exercise/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$exercises = $view->getVariable("exercises");

$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
    <div id="content-list">
        <div class="content-title">
            <strong><?= i18n("Exercises")?></strong><br>
            <a href="index.php?controller=exercise&amp;action=add"><input type='button' value=<?= i18n("New")?> /></a>
        </div>
        <table id="table-content" style="text-align: center;">
            <tr class="table-row-content">
                <td><strong><?= i18n("Name")?></strong></td>
                <td><strong><?= i18n("Type")?></strong></td>
                <td><strong><?= i18n("View")?></strong></td>
                <td><strong><?= i18n("Edit")?></strong></td>
                <td><strong><?= i18n("Delete")?></strong></td>
                <?php foreach ($exercises as $exercise): ?>
            <tr class="table-row-content"
                data-href="index.php?controller=exercise&amp;action=edit&amp;id_exercise=<?= $exercise->getId() ?>">
                <td><?= $exercise->getName() ?></td>
                <td><?= $exercise->getType() ?></td>
                <td><a href="index.php?controller=exercise&amp;action=view&amp;id_exercise=<?= $exercise->getId() ?>">
                        <img src="resources/icons/view_icon.svg" alt="View" /></a>
                </td>
                <td><a href="index.php?controller=exercise&amp;action=edit&amp;id_exercise=<?= $exercise->getId() ?>">
                        <img src="resources/icons/edit_icon.svg" alt="Edit" /></a>
                </td>
                <td><a class="confirmation" href="index.php?controller=exercise&amp;action=delete&amp;id_exercise=<?= $exercise->getId() ?>">
                        <img src="resources/icons/delete_icon.svg" alt="Delete"/></a>
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

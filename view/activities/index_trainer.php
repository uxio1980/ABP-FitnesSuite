<?php
//file: view/articles/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$activities = $view->getVariable("activities");
$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
    <div id="content-list">
        <div class="content-title">
            <strong><?= i18n("Activities")?></strong><br>
        </div>
        <table id="table-content">
            <tr class="table-row-content">
                <td><strong><?= i18n("Name")?></strong></td>
                <td><strong><?= i18n("Seats")?></strong></td>
                <td><strong><?= i18n("Assistance")?></strong></td>
                <?php foreach ($activities as $activity): ?>
            <tr class="table-row-content"
                data-href="index.php?controller=assistance&amp;action=edit&amp;idactivity=<?= $activity->getIdactivity() ?>">
                <td id="id_row" class="ocultable"><span class="field_id"><?= $activity->getIdactivity() ?></span></td>
                <td><span class="field_name"><?= $activity->getName() ?></span>
                </td>
                <td><span class="field_name"><?= $activity->getSeats() ?></span>
                </td>
                <td><a href="index.php?controller=assistance&amp;action=index&amp;idactivity=<?= $activity->getIdactivity() ?>">
                        <img src="resources/icons/ic_schedule_24px.svg" alt="Assistance" /></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</main>

<script src="js/index.js"></script>
<?php
//file: view/articles/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$user = $view->getVariable("user");
$currentuser = $view->getVariable("currentusername");
$sessions = $view->getVariable("sessions");
$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
    <div id="content-list">
        <div class="content-title">
            <strong><?= i18n("Sessions of ")?><?= $user ?></strong><br>
        </div>
        <table id="table-content">
            <tr class="table-row-content">
                <td><strong><?= i18n("Date")?></strong></td>
                <td class="td_ocultable"><strong><?= i18n("Table")?></strong></td>
                <td><strong><?= i18n("Duration")?></strong></td>
                <td class="td_ocultable"><strong><?= i18n("Comment")?></strong></td>
                <?php foreach ($sessions as $session): ?>
            <tr class="table-row-content"
                data-href="index.php?controller=users&amp;action=edit&amp;id=<?= $session->getId() ?>">
                <td><?= date("j M, Y g:ia", strtotime($session->getDate())) ?></td>
                <td class="td_ocultable"><?= $session->getUser_table()->getWorkout_table()->getName() ?></td>
                <td><?= date('H:i:s' ,strtotime($session->getDuration() )) ?></td>
                <td class="td_ocultable"><?= $session->getComment() ?></td>
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

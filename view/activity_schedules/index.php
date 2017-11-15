<?php
//file: view/articles/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$activity = $view->getVariable("activity");
$activity_schedules = $view->getVariable("activity_schedules");
//$currentuser = $view->getVariable("currentusername");
$view->setVariable("title", "FitnesSuite");
?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Activity Schedules for ")?> <?= $activity->getName() ?></strong><br>
      <a href="index.php?controller=activity_schedule&amp;action=add&amp;id_activity=<?= $activity->getIdactivity() ?>"><input type='button' value=<?= i18n("New")?> /></a>
    </div>
    <table id="table-content">
      <tr class="table-row-content">
        <td><strong><?= i18n("Date")?></strong></td>
        <td><strong><?= i18n("Start hour")?></strong></td>
        <td><strong><?= i18n("End hour")?></strong></td>
        <td><strong><?= i18n("Edit")?></strong></td>
        <td><strong><?= i18n("Delete")?></strong></td>
      <?php foreach ($activity_schedules as $activity_schedule): ?>
        <tr class="table-row-content"
          data-href="index.php?controller=activity_schedule&amp;action=add&amp;activity_schedule=<?= $activity_schedule->getId() ?>">
          <td><?= $activity_schedule->getDate() ?></td>
          <td><?= $activity_schedule->getStart_hour() ?></td>
          <td><?= $activity_schedule->getEnd_hour() ?></td>
          <td><a href="index.php?controller=activity_schedule&amp;action=edit&amp;activity_schedule=<?= $activity_schedule->getId() ?>">
            <img src="resources/icons/edit_icon.svg" alt="Edit" /></a>
          </td>
          <td><a class="confirmation" href="index.php?controller=activity_schedule&amp;action=delete&amp;id_activity_schedule=<?= $activity_schedule->getId() ?>">
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

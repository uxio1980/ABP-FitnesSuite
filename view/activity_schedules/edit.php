<?php
//file: view/$activity_schedules/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$activity_schedule = $view->getVariable("activity_schedule");
$view->setVariable("title", "FitnesSuite");
?>

<main id="main-content">
  <div class="form">
    <strong><?= i18n("Modify activity schedule")?></strong>
    <form id="form-sign-up" action="index.php?controller=activity_schedule&amp;action=edit&amp;activity_schedule=<?= $activity_schedule->getId() ?>" method="POST">
      <input type="hidden" name="id" value="<?= $activity_schedule->getId() ?>"/>

      <label for="login-field"><?= i18n("Activity")?></label>
      <span class="field"> <?= $activity_schedule->getActivity()->getName() ?></span>

      <label for="login-field"><?= i18n("Date")?></label>
      <input type="date" name="date" value="<?= $activity_schedule->getDate() ?>" />
      <?= isset($errors["date"])?$errors["date"]:"" ?>

      <label for="login-field"><?=i18n("Start hour")?></label>
      <input type="time" name="start" required="true" value="<?= $activity_schedule->getStart_hour() ?>"/>
      <?= isset($errors["start"])?$errors["start"]:"" ?><br>

      <label for="login-field"><?=i18n("End hour")?></label>
      <input type="time" name="end" required="true" value="<?= $activity_schedule->getEnd_hour() ?>"/>
      <?= isset($errors["end"])?$errors["end"]:"" ?><br>

      <input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
    </form>
  </div>
</main>
<script src="js/index.js"></script>

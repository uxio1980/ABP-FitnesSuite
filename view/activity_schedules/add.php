<?php
//file: view/activitiy_schedules/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$activity = $view->getVariable("activity");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Add Activity schedule");

?>
<main id="main-content">
  <div class="form">
    <form action="index.php?controller=activity_schedule&amp;action=add&amp;id_activity=<?= $activity->getIdactivity()?>/>" method="POST"
    enctype="multipart/form-data">
    <strong><?= i18n("Add activity schedule for") ?> <?= $activity->getName();?></strong>
    <input type="hidden" name="id_activity" value="<?= $activity->getIdactivity()?>"/>

    <label for="login-field"><?=i18n("Start date")?></label>
    <?php $date = getdate(); $actualDate = $date['year']."-".$date['mon']."-".$date['mday'];?>
    <input type="date" name="startdate" required="true" value="<?= $actualDate?>"/>
    <?= isset($errors["startdate"])?$errors["startdate"]:"" ?><br>

    <?php $actualTime = sprintf("%02d",$date['hours']).":".sprintf("%02d", $date['minutes']);?>
    <label for="login-field"><?=i18n("Start hour")?></label>
    <input type="time" name="start" required="true" value="<?= $actualTime?>"/>
    <?= isset($errors["start"])?$errors["start"]:"" ?><br>

    <label for="login-field"><?=i18n("End hour")?></label>
    <input type="time" name="end" required="true" value="<?= $actualTime?>"/>
    <?= isset($errors["end"])?$errors["end"]:"" ?><br>

    <label for="login-field"><?=i18n("End date")?></label>
    <input type="date" name="enddate" required="true" value="<?= $actualDate?>"/>
    <?= isset($errors["enddate"])?$errors["enddate"]:"" ?><br>

    <input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
  </form>
</div>

</main>
<script src="js/index.js"></script>

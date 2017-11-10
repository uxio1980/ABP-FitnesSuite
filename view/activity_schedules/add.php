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
    <strong><?= i18n("Add activity schedule for ") ?><?= $activity->getName();?></strong>
    <input type="hidden" name="id_activity" value="<?= $activity->getIdactivity()?>"/>

    <label for="login-field"><?=i18n("Date")?></label>
    <?php $date = getdate(); $actualDate = $date[year]."-".$date[mon]."-".$date[mday];?>
    <input type="date" name="date" required="true" value="<?= $actualDate?>"/>
    <?= isset($errors["date"])?$errors["date"]:"" ?><br>

    <?php $actualTime = $date[hours].":".$date[minutes];?>
    <label for="login-field"><?=i18n("Start hour")?></label>
    <input type="time" name="start_hour" required="true" value="<?= $actualTime?>"/>
    <?= isset($errors["time"])?$errors["time"]:"" ?><br>

    <label for="login-field"><?=i18n("End hour")?></label>
    <input type="time" name="end_hour" required="true" value="<?= $actualTime?>"/>
    <?= isset($errors["time"])?$errors["time"]:"" ?><br>

    <input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
  </form>
</div>

</main>
<script src="js/index.js"></script>

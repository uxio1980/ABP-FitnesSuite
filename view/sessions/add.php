<?php
//file: view/sessions/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$session = $view->getVariable("session");
$user_tables = $view->getVariable("user_tables");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Add Activity schedule");

?>
<main id="main-content">
  <div class="form">
    <form action="index.php?controller=sessions&amp;action=add" method="POST">
    <strong><?= i18n("Resume for add session") ?></strong>

    <label for="login-field"><?= i18n("Workout table")?></label>
    <select name="user_table">
    <?php foreach ($user_tables as $user_table): ?>
      <option <?=($session->getUser_table()->getId()==$user_table->getId())?'selected="selected"':''?> value=<?= $user_table->getId()?>><?= $user_table->getWorkout_table()->getName()?></option>
    <?php endforeach; ?>
    </select>
    <?= isset($errors["user_table"])?$errors["user_table"]:"" ?>

    <label for="login-field"><?= i18n("Begin")?></label>
    <?php $date = date("Y-m-d\TH:i",strtotime($session->getDate())); ?>
    <input type="datetime-local" name="date" value="<?= ($session->getDate())?$date:'' ?>" />
    <?= isset($errors["date"])?$errors["date"]:"" ?>

    <label for="login-field"><?=i18n("Duration")?></label>
    <input type="time" name="duration" required="true" value="<?= $session->getDuration() ?>"/>
    <?= isset($errors["duration"])?$errors["duration"]:"" ?><br>

    <label for="name-field"><?= i18n("Comment") ?></label>
    <textarea name="comment" rows="4" cols="50" ><?=$session->getComment() ?></textarea>
    <?= isset($errors["comment"])?$errors["comment"]:"" ?><br>

    <input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
  </form>
</div>

</main>
<script src="js/index.js"></script>

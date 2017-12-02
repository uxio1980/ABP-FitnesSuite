<?php
//file: view/sessions/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$notification = $view->getVariable("add_notification");
$currentUserName = $view->getVariable("currentusername");
$errors = $view->getVariable("errors");

$view->setVariable("title", i18n("Add notification"));

?>
<main id="main-content">
  <div class="form">
    <form action="index.php?controller=notification&amp;action=add" method="POST">
    <strong><?= i18n("Add notification") ?></strong>
    <input type="hidden" name="id_notification" value="<?= $notification->getId() ?>"/>

    <label for="login-field"><?= i18n("Author")?></label>
    <span class="field"> <?= $currentUserName ?></span>
    <?= isset($errors["author"])?$errors["author"]:"" ?>

    <label for="login-field"><?= i18n("Expiration")?></label>
    <?php $date = date("Y-m-d\TH:i",strtotime($notification->getDate())); ?>
    <?php $currentDate = date_create(date("Y-m-d"));
      date_time_set($currentDate, date("H")+1, date("i"));
      $currentDate = date_format($currentDate,"Y-m-d\TH:i");
      ?>
    <input type="datetime-local" name="date" value="<?= ($notification->getDate())?$date:$currentDate ?>" required/>
    <?= isset($errors["date"])?$errors["date"]:"" ?>

    <label for="login-field"><?=i18n("Title")?></label>
    <input type="text" name="title" required="true" value="<?= $notification->getTitle() ?>"/>
    <?= isset($errors["title"])?$errors["title"]:"" ?><br>

    <label for="name-field"><?= i18n("Content") ?></label>
    <textarea name="content" rows="4" cols="50" required><?=$notification->getContent() ?></textarea>
    <?= isset($errors["content"])?$errors["content"]:"" ?><br>

    <input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
  </form>
</div>

</main>
<script src="js/index.js"></script>

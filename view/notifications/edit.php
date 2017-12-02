<?php
//file: view/public_info/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$notification = $view->getVariable("edit_notification");
$view->setVariable("title", "FitnesSuite");
?>

<main id="main-content">
  <div class="form">
    <strong><?= i18n("Modify notification")?></strong>
    <form id="form-sign-up" action="index.php?controller=notification&amp;action=edit" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_notification" value="<?= $notification->getId() ?>"/>

      <label for="login-field"><?= i18n("Author")?></label>
      <span class="field"> <?= $notification->getUser_author()->getName() ?></span>
      <?= isset($errors["author"])?$errors["author"]:"" ?>

      <label for="login-field"><?= i18n("Expiration")?></label>
      <?php $date = date("Y-m-d\TH:i",strtotime($notification->getDate())); ?>
      <input type="datetime-local" name="date" value="<?= ($notification->getDate())?$date:'' ?>" />
      <?= isset($errors["date"])?$errors["date"]:"" ?>

      <label for="login-field"><?= i18n("Title")?></label>
      <input type="text" name="title" value="<?= $notification->getTitle() ?>" required/>
      <?= isset($errors["title"])?$errors["title"]:"" ?>

      <label for="login-field"><?= i18n("Content")?></label>
      <textarea name="content" rows="4" cols="50" required><?=$notification->getContent() ?></textarea>
      <?= isset($errors["content"])?$errors["content"]:"" ?>

      <input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
    </form>
  </div>
</main>
<script src="js/index.js"></script>

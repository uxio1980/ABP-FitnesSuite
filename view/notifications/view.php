<?php
//file: view/public_info/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$notification = $view->getVariable("view_notification");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div class="form">
    <div class="form-title">
      <strong><?= i18n("Notification")?></strong>
      <a href="index.php?controller=notification&amp;action=edit&amp;id_notification=<?= $notification->getId() ?>s">
        <img class="image-edit" src="resources/icons/edit_icon.svg" alt="Edit" />
      </a>
    </div>
    <input type="hidden" name="id" value="<?= $notification->getId() ?>"/>

    <label for="login-field"><?= i18n("Author")?></label>
    <span class="field"> <?= $notification->getUser_author()->getName() ?></span>

    <label for="login-field"><?= i18n("Expiration")?></label>
    <span class="field"> <?= $notification->getDate() ?></span>

    <label for="login-field"><?= i18n("Title")?></label>
    <span class="field"> <?= $notification->getTitle() ?></span>

    <label for="login-field"><?= i18n("Content")?></label>
    <span class="field"> <?= $notification->getContent() ?></span>
  </div>
</main>
<script src="js/index.js"></script>

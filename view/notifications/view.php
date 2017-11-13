<?php
//file: view/public_info/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$notifications = $view->getVariable("notifications");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div class="form">
    <div class="form-title">
      <strong><?= i18n("Notifications")?></strong>
      <a href="index.php?controller=public_info&amp;action=edit&amp;id=">
        <img class="image-edit" src="resources/icons/edit_icon.svg" alt="Edit" />
      </a>
    </div>
  <?php foreach ($notifications as $notification): ?>
    <label for="login-field"><?= i18n("Phone")?></label>
    <span class="field"> <?= $notification->getId() ?></span>

    <label for="login-field"><?= i18n("Email")?></label>
    <span class="field"> <?= $notification->getTitle() ?></span>

    <label for="login-field"><?= i18n("Address")?></label>
    <span class="field"> <?= $notification->getContent() ?></span>
  <?php endforeach; ?>
  </div>
</main>
<script src="js/index.js"></script>

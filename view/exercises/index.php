<?php
//file: view/public_info/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$public_info = $view->getVariable("public_info");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div class="form">
    <div class="form-title">
      <strong><?= i18n("Public info")?></strong>
      <a href="index.php?controller=public_info&amp;action=edit&amp;id=<?= $public_info->getId() ?>">
        <img class="image-edit" src="resources/icons/edit_icon.svg" alt="Edit" />
      </a>
    </div>

    <label for="login-field"><?= i18n("Phone")?></label>
    <span class="field"> <?= $public_info->getPhone() ?></span>

    <label for="login-field"><?= i18n("Email")?></label>
    <span class="field"> <?= $public_info->getEmail() ?></span>

    <label for="login-field"><?= i18n("Address")?></label>
    <span class="field"> <?= $public_info->getAddress() ?></span>
  </div>
</main>
<script src="js/index.js"></script>

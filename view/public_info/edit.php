<?php
//file: view/public_info/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$public_info = $view->getVariable("publicInfo");
$view->setVariable("title", "FitnesSuite");
?>

<main id="main-content">
  <div class="form">
    <strong><?= i18n("Modify public info")?></strong>
    <form id="form-sign-up" action="index.php?controller=public_info&amp;action=edit" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $public_info->getId() ?>"/>

      <label for="login-field"><?= i18n("Phone")?></label>
      <input type="tel" name="phone" value="<?= $public_info->getPhone() ?>" />
      <?= isset($errors["phone"])?$errors["phone"]:"" ?>

      <label for="login-field"><?= i18n("E-mail")?></label>
      <input type="email" name="email" value="<?= $public_info->getEmail() ?>" />
      <?= isset($errors["email"])?$errors["email"]:"" ?>

      <label for="login-field"><?= i18n("Address")?></label>
      <textarea name="address" rows="4" cols="50" required><?=$public_info->getAddress() ?></textarea>
      <?= isset($errors["address"])?$errors["address"]:"" ?>

      <input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
    </form>
  </div>
</main>
<script src="js/index.js"></script>

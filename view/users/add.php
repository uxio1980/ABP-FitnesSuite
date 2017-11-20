<?php
//file: view/users/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$loginerr = $view->getVariable("loginerrors");
$user = $view->getVariable("user");
$view->setVariable("title", "Add User");
?>

<main id="main-content">
    <div class="form">
        <form action="index.php?controller=users&amp;action=register" method="POST"
              enctype="multipart/form-data">

            <strong><?= i18n("Add User") ?></strong>

            <?= isset($loginerr["general"])?$loginerr["general"]:"" ?>

            <label for="form-field"><?= i18n("Username") ;?></label>
            <input type="text" name="login" value="<?=$user->getLogin() ?>" placeholder=""/>
            <?= isset($errors["register-login"])?$errors["register-login"]:"" ?>

            <label for="name-field"><?= i18n("Name") ?></label>
            <input type="text" name="name" value="<?=$user->getName() ?>" placeholder=""/>
            <?= isset($errors["register-name"])?$errors["register-name"]:"" ?>

            <label for="form-field"><?= i18n("Password") ?></label>
            <input type="password" name="password" placeholder=""/>
            <?= isset($errors["register-password"])?$errors["register-password"]:"" ?>

            <label for="form-field"><?= i18n("Email") ?></label>
            <input type="text" name="email" value="<?=$user->getEmail() ?>" placeholder=""/>
            <?= isset($errors["register-email"])?$errors["register-email"]:"" ?>

            <input type="submit" name="submit" value="<?= i18n("Register") ?>"/>
        </form>
    </div>

</main>
<script src="js/index.js"></script>
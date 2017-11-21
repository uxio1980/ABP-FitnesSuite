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

            <label for="name-field"><?= i18n("Surname") ?></label>
            <input type="text" name="surname" value="<?=$user->getSurname() ?>" placeholder=""/>


            <label for="form-field"><?= i18n("Password") ?></label>
            <input type="password" name="password" placeholder=""/>
            <?= isset($errors["register-password"])?$errors["register-password"]:"" ?>

            <label for="form-field"><?= i18n("Email") ?></label>
            <input type="text" name="email" value="<?=$user->getEmail() ?>" placeholder=""/>
            <?= isset($errors["register-email"])?$errors["register-email"]:"" ?>

            <label for="login-field"><?= i18n("User type")?></label>
            <select name="user_type">
                <option <?=(0)?'selected="selected"':''?> value=""></option>
                <option <?=($user->getUser_type()==usertype::Administrator)?'selected="selected"':''?> value=<?= usertype::Administrator?>><?= i18n("Administrator")?></option>
                <option <?=($user->getUser_type()==usertype::Trainer)?'selected="selected"':''?> value=<?= usertype::Trainer?>><?= i18n("Trainer")?></option>
                <option <?=($user->getUser_type()==usertype::AthleteTDU)?'selected="selected"':''?> value=<?= usertype::AthleteTDU?>><?= i18n("Athlete TDU")?></option>
                <option <?=($user->getUser_type()==usertype::AthletePEF)?'selected="selected"':''?> value=<?= usertype::AthletePEF?>><?= i18n("Athlete PEF")?></option>
            </select>
            <?= isset($errors["register-type"])?$errors["register-type"]:"" ?>

            <input type="submit" name="submit" value="<?= i18n("Register") ?>"/>
        </form>
    </div>

</main>
<script src="js/index.js"></script>
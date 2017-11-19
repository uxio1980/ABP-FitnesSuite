<?php
//file: view/users/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");

$view->setVariable("title", "Add User");

?>

<main id="main-content">
    <div class="form">
        <form action="index.php?controller=users&amp;action=register" method="POST"
              enctype="multipart/form-data">

            <strong><?= i18n("Add User") ?></strong>

            <label for="form-field"><?= i18n("Username") ;?></label>
            <input type="text" name="login" value="" placeholder=""/>


            <label for="name-field"><?= i18n("Name") ?></label>
            <input type="text" name="name" value="" placeholder=""/>


            <label for="form-field"><?= i18n("Password") ?></label>
            <input type="password" name="password" placeholder=""/>


            <label for="form-field"><?= i18n("Email") ?></label>
            <input type="text" name="email" value="" placeholder=""/>


            <input type="submit" name="submit" value="<?= i18n("Register") ?>"/>
        </form>
    </div>

</main>
<script src="js/index.js"></script>
<?php
 //file: view/users/register.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("user");
 $view->setVariable("title", "FitnesSuite");
?>
<form id="form-sign-up" action="index.php?controller=users&amp;action=register" method="POST" enctype="multipart/form-data">
    <input type="text" name="login" value="<?=$user->getLogin() ?>" placeholder="Usuario"/>
    <?= isset($errors["login"])?$errors["login"]:"" ?><br>

    <input type="text" name="name" value="<?=$user->getName() ?>" placeholder="Nombre"/>

    <input type="password" name="password" placeholder="Contraseña"/>
    <?= isset($errors["password"])?$errors["password"]:"" ?><br>

    <input type="text" name="email" value="<?=$user->getEmail() ?>" placeholder="E-mail"/>
    <?= isset($errors["email"])?$errors["email"]:"" ?><br>

    <input type="submit"/>
    <p class="message">¿Ya estas registrado?
        <a href="index.php?controller=users&amp;action=login" method="POST">Entra</a>
    </p>
</form>

<?php
 //file: view/users/login.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $view->setVariable("title", "FitnesSuite");
 $errors = $view->getVariable("errors");
?>
<?= isset($errors["general"])?$errors["general"]:"" ?>
<form id="form-sign" action="index.php?controller=users&amp;action=login" method="POST">
    <input type="text" name="login" placeholder="Usuario"/>
    <input type="password" name="password" placeholder="Contraseña"/>
    <input type="submit"/>
    <p class="message">¿No estas registrado?
        <a href="index.php?controller=users&amp;action=register" method="POST">Crea una cuenta</a>
    </p>
</form>

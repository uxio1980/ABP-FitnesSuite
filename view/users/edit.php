<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("profileUser");
$typeuser = $view->getVariable("typeuser");
$view->setVariable("title", "FitnesSuite");
?>

<main id="main-content">
  <div class="form">
    <strong><?= i18n("Modify profile")?></strong>
    <form id="form-sign-up" action="index.php?controller=users&amp;action=edit" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="login" value="<?= $user->getLogin() ?>"/>

      <label for="login-field"><?= i18n("Password")?></label>
      <input type="password" name="password" value="<?= $user->getPassword() ?>" minlength="5" maxlength="50" required/>
      <?= isset($errors["password"])?$errors["password"]:"" ?>

      <label for="login-field"><?= i18n("Name")?></label>
      <input type="text" name="name" value="<?= $user->getName() ?>" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" minlength="2" maxlength="50" required/>
      <?= isset($errors["name"])?$errors["name"]:"" ?>

      <label for="login-field"><?= i18n("Surname")?></label>
      <input type="text" name="surname" value="<?= $user->getSurname() ?>" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" minlength="2" maxlength="50" />
      <?= isset($errors["surname"])?$errors["surname"]:"" ?>

      <label for="login-field"><?= i18n("Dni")?></label>
      <input type="text" name="dni" value="<?= $user->getDni() ?>" pattern="[0-9]{8}[a-zA-Z]?" minlength="8" maxlength="12" />
      <?= isset($errors["dni"])?$errors["dni"]:"" ?>

      <label for="login-field"><?= i18n("E-mail")?></label>
      <input type="email" name="email" value="<?= $user->getEmail() ?>" required/>
      <?= isset($errors["email"])?$errors["email"]:"" ?>

      <label for="login-field"><?= i18n("Phone")?></label>
      <input type="tel" name="phone" value="<?= $user->getPhone() ?>" />
      <?= isset($errors["phone"])?$errors["phone"]:"" ?>

      <label for="login-field"><?= i18n("Description")?></label>
      <textarea name="description" rows="4" cols="50"><?=$user->getDescription() ?></textarea>
      <?= isset($errors["description"])?$errors["description"]:"" ?>

      <label for="name-field"><?= i18n("Profile image") ?></label>
      <input type="file" name="image" accept="image/*">
      <?= isset($errors["image"])?$errors["image"]:"" ?><br>

      <?php if(isset($typeuser) == usertype::Administrator): ?>
        <label for="login-field"><?= i18n("User type")?></label>
        <select name="user_type">
          <option <?=($user->getUser_type()==usertype::Administrator)?'selected="selected"':''?> value=<?= usertype::Administrator?>><?= i18n("Administrator")?></option>
          <option <?=($user->getUser_type()==usertype::Trainer)?'selected="selected"':''?> value=<?= usertype::Trainer?>><?= i18n("Trainer")?></option>
          <option <?=($user->getUser_type()==usertype::Athlete)?'selected="selected"':''?> value=<?= usertype::Athlete?>><?= i18n("Athlete")?></option>
        </select>
        <?= isset($errors["user_type"])?$errors["user_type"]:"" ?>
      <?php endif ?>

      <?php if(isset($typeuser) == usertype::Administrator): ?>
        <?php if($user->getUser_type()==usertype::Athlete): ?>
          <label for="login-field"><?= i18n("Athlete type")?></label>
          <select name="athlete_type">
            <?php if($user->getAthlete_type()!=athletetype::TDU && $user->getAthlete_type()!=athletetype::PEF): ?>
              <option value = -1 ><?= i18n("Select")?> </option>
            <?php endif ?>
            <option <?=($user->getAthlete_type()==athletetype::TDU)?'selected="selected"':''?> value=<?= athletetype::TDU ?>><?= i18n("TDU")?></option>
            <option <?=($user->getAthlete_type()==athletetype::PEF)?'selected="selected"':''?> value=<?= athletetype::PEF ?>><?= i18n("PEF")?></option>
          </select>
          <?= isset($errors["athlete_type"])?$errors["athlete_type"]:"" ?>
        <?php endif ?>
      <?php endif ?>
      <input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
    </form>
  </div>
</main>

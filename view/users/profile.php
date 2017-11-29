<?php
 //file: view/users/profile.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $user = $view->getVariable("profileUser");
 $view->setVariable("title", "Mi perfil");
?>
<main id="main-content">
  <div class="form">
    <div class="form-title">
      <?php if ($user->getProfileImage() != NULL): ?>
        <?php $ruta="resources/profiles/". $user->getProfileImage();?>
        <img src='<?=$ruta?>' />
      <?php else: ?>
        <img src="resources/profiles/profile-default.png" />
      <?php endif ?>
      <strong><?= i18n("Profile")?></strong>
      <a href="index.php?controller=users&amp;action=edit&amp;login=<?= $user->getLogin() ?>">
        <img class="image-edit" src="resources/icons/edit_icon.svg" alt="Edit" />
      </a>
    </div>
      <label for="login-field"><?= i18n("Username")?></label>
      <span class="field"> <?= $user->getLogin() ?></span>

      <label for="login-field"><?= i18n("Name")?></label>
      <span class="field"> <?= $user->getName() ?></span>

      <label for="login-field"><?= i18n("Surname")?></label>
      <span class="field"> <?= $user->getSurname() ?></span>

      <label for="login-field"><?= i18n("Dni")?></label>
      <span class="field"> <?= $user->getDni() ?></span>

      <label for="login-field"><?= i18n("E-mail")?></label>
      <span class="field"> <?= $user->getEmail() ?></span>

      <label for="login-field"><?= i18n("Phone")?></label>
      <span class="field"> <?= $user->getPhone() ?></span>

      <label for="login-field"><?= i18n("Description")?></label>
      <span class="field"> <?= $user->getDescription() ?></span>

      <label for="login-field"><?= i18n("User type")?></label>
      <span class="field"> <?= i18n(usertype::getName($user->getUser_type())) ?></span>
  </div>
</main>
<script src="js/index.js"></script>

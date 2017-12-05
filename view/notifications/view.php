<?php
//file: view/public_info/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$notification = $view->getVariable("view_notification");
$currentusername = $view->getVariable("currentusername");
$notification_users = $view->getVariable("notification_users");
$typeuser = $view->getVariable("typeuser");
$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div class="form">
    <div class="form-title">
      <strong><?= i18n("Notification")?></strong>
      <?php if ($typeuser == usertype::Administrator || $typeuser == usertype::Trainer ): ?>
        <a href="index.php?controller=notification&amp;action=edit&amp;id_notification=<?= $notification->getId() ?>">
          <img class="image-edit" src="resources/icons/edit_icon.svg" alt="Edit" />
        </a>
      <?php endif; ?>
    </div>
    <input type="hidden" name="id" value="<?= $notification->getId() ?>"/>

    <label for="login-field"><?= i18n("Author")?></label>
    <span class="field"> <?= $notification->getUser_author()->getName() ?></span>

    <label for="login-field"><?= i18n("Expiration")?></label>
    <span class="field"> <?= $notification->getDate() ?></span>

    <label for="login-field"><?= i18n("Title")?></label>
    <span class="field"> <?= $notification->getTitle() ?></span>

    <label for="login-field"><?= i18n("Content")?></label>
    <span class="field"> <?= $notification->getContent() ?></span>
    <div id="content-list">
      <table id="table-content">
        <tr class="table-row-content">
          <td><strong><?= i18n("Receivers")?></strong></td>
          <?php foreach ($notification_users as $notification_user): ?>
            <tr class="table-row-content"
              data-href="index.php?controller=notification&amp;action=edit&amp;id_notification=<?= $notification_user->getId() ?>">
              <td><?= $notification_user->getUser_receiver()->getSurname() ?>, <?= $notification_user->getUser_receiver()->getName()?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
  </div>
</main>
<script src="js/index.js"></script>

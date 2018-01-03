<?php
//file: view/public_info/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$notification_user = $view->getVariable("view_notification_user");
$currentusername = $view->getVariable("currentusername");
$typeuser = $view->getVariable("typeuser");
$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div class="form">
    <div class="form-title">
      <?php $link = ($notification_user->getViewed() != NULL)?
         'index.php?controller=notifications_user&amp;action=markAsUnread'
        :'index.php?controller=notifications_user&amp;action=markAsRead' ?>
      <strong><?= i18n("Notification")?></strong>
      <?php if ($typeuser == usertype::Administrator || $typeuser == usertype::Trainer ): ?>
        <a href="index.php?controller=notification&amp;action=edit&amp;id_notification=<?= $notification_user->getNotification()->getId() ?>">
          <img class="image-edit" src="resources/icons/edit_icon.svg" alt="Edit" />
        </a>
      <?php endif; ?>
    </div>
    <form id="form-sign-up" action="<?= $link ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_notification_user" value="<?= $notification_user->getId() ?>"/>

    <label for="login-field"><?= i18n("Author")?></label>
    <span class="field"> <?= $notification_user->getNotification()->getUser_author()->getName() ?></span>

    <label for="login-field"><?= i18n("Expiration")?></label>
    <span class="field"> <?= $notification_user->getNotification()->getDate() ?></span>

    <label for="login-field"><?= i18n("Title")?></label>
    <span class="field"> <?= $notification_user->getNotification()->getTitle() ?></span>

    <label for="login-field"><?= i18n("Content")?></label>
    <span class="field"> <?= $notification_user->getNotification()->getContent() ?></span>

    <input type="submit" name="submit" value="<?= i18n("Mark as")?> <?= ($notification_user->getViewed() != NULL)?i18n("unread"):i18n("read"); ?>"/>
    </form>
  </div>
</main>
<script src="js/index.js"></script>

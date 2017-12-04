<?php
//file: view/public_info/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$notification = $view->getVariable("edit_notification");
$notification_users = $view->getVariable("notification_users");
$users = $view->getVariable("users");
$view->setVariable("title", "FitnesSuite");
?>

<main id="main-content">
  <div class="form">
    <strong><?= i18n("Modify notification")?></strong>
    <form id="form-sign-up" action="index.php?controller=notification&amp;action=edit" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_notification" value="<?= $notification->getId() ?>"/>

      <label for="login-field"><?= i18n("Author")?></label>
      <span class="field"> <?= $notification->getUser_author()->getName() ?></span>
      <?= isset($errors["author"])?$errors["author"]:"" ?>

      <label for="login-field"><?= i18n("Expiration")?></label>
      <?php $date = date("Y-m-d\TH:i",strtotime($notification->getDate())); ?>
      <input type="datetime-local" name="date" value="<?= ($notification->getDate())?$date:'' ?>" />
      <?= isset($errors["date"])?$errors["date"]:"" ?>

      <label for="login-field"><?= i18n("Title")?></label>
      <input type="text" name="title" value="<?= $notification->getTitle() ?>" required/>
      <?= isset($errors["title"])?$errors["title"]:"" ?>

      <label for="login-field"><?= i18n("Content")?></label>
      <textarea name="content" rows="4" cols="50" required><?=$notification->getContent() ?></textarea>
      <?= isset($errors["content"])?$errors["content"]:"" ?>

      <div id="content-list">
        <table id="table-content">
          <tr class="table-row-content">
            <td>
              <strong><?= i18n("Receivers")?>
                <!-- Trigger/Open The Modal -->
                <div id="myBtn">
                  <!--a href="index.php?controller=notifications_user&amp;action=add&amp;id_notification= < ?= $notification->getId() ?>"> -->
                    <img class="image-edit" src="resources/icons/ic_users_add.svg" alt="Edit" />
                  <!--</a> -->
                </div>
                <?php include(__DIR__."/modalform.php");?>
                </strong>
            </td>
            <td><strong><?= i18n("Delete")?></strong></td>
            <?php foreach ($notification_users as $notification_user): ?>
              <tr class="table-row-content"
                data-href="index.php?controller=notifications_user&amp;action=delete&amp;id_notification_user=<?= $notification_user->getId() ?>">
                <td><?= $notification_user->getUser_receiver()->getSurname() ?>, <?= $notification_user->getUser_receiver()->getName()?></td>
                <td><a class="confirmation" href="index.php?controller=notifications_user&amp;action=delete&amp;id_notification_user=<?= $notification_user->getId()?>">
                  <img src="resources/icons/delete_icon.svg" alt="Delete"/></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      <input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
    </form>
  </div>
</main>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>
<script src="js/index.js"></script>

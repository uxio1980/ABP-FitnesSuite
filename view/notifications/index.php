<?php
 //file: view/notifications/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $filterby = $view->getVariable("filterby");
 $notifications = $view->getVariable("notifications");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Notifications")?></strong><br>
      <a href="index.php?controller=notification&amp;action=add"><input type='button' value=<?= i18n("New")?> /></a>
    </div>
    <div class="filter-box-notifications">
        <form id="form-notifications-filterby" action="index.php?controller=notification&amp;action=index" method="POST">
          <input id="filter1" class="radio-button" type="radio" name="filterby" value="active" <?= ($filterby == 'active') ? "checked='checked'" : "";?>><?= i18n("Actives")?>
          <input id="filter2" class="radio-button" type="radio" name="filterby" value="lapsed" <?= ($filterby == 'lapsed') ? "checked='checked'" : "";?>><?= i18n("Lapsed")?>
          <input id="filter3" class="radio-button" type="radio" name="filterby" value="all" <?= ($filterby == 'all') ? "checked='checked'" : "";?>><?= i18n("All")?>
        </form>

    </div>
    <table id="table-content">
      <tr class="table-row-content">
        <td><strong><?= i18n("Author")?></strong></td>
        <td><strong><?= i18n("Title")?></strong></td>
        <td><strong><?= i18n("Content")?></strong></td>
        <td><strong><?= i18n("Expiration")?></strong></td>
        <td><strong><?= i18n("Receivers")?></strong></td>
        <td><strong><?= i18n("View")?></strong></td>
        <td><strong><?= i18n("Edit")?></strong></td>
        <td><strong><?= i18n("Delete")?></strong></td>
      <?php foreach ($notifications as $notification): ?>
        <tr class="table-row-content"
          data-href="index.php?controller=notification&amp;action=edit&amp;id_notification=<?= $notification->getId() ?>">
          <td><?= $notification->getUser_author()->getName() ?></td>
          <td><?= $notification->getTitle() ?></td>
          <!-- var_dump(strlen($notification->getTitle())) ?>-->
          <?php if (strlen($notification->getContent())>20): ?>
            <?php $content = substr($notification->getContent(),0,20)  . "..."; ?>
            <?php else:?>
              <?php $content = $notification->getContent(); ?>
              <?php endif ?>
          <td><?= $content ?></td>
          <td><?= $notification->getDate() ?></td>
          <td><?= $notification->getReceivers() ?></td>
          <td><a href="index.php?controller=notification&amp;action=edit&amp;id_notification=<?= $notification->getId() ?>">
            <img src="resources/icons/ic_visibility_black_24px.svg" alt="Edit" /></a></td>
          <td><a href="index.php?controller=notification&amp;action=edit&amp;id_notification=<?= $notification->getId() ?>">
            <img src="resources/icons/edit_icon.svg" alt="Edit" /></a>
          </td>
          <td><a class="confirmation" href="index.php?controller=notification&amp;action=delete&amp;id_notification=<?= $notification->getId() ?>">
            <img src="resources/icons/delete_icon.svg" alt="Delete"/></a>
          </td>
        </tr>
      <?php endforeach; ?>
  </table>
  </div>
</main>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>

<script type="text/javascript">
    var form = document.getElementById("form-notifications-filterby");
    $('.radio-button').on('click', function () {
      //return confirm(ji18n('Are you sure?'));
      if (document.getElementById("filter1").checked || document.getElementById("filter2").checked || document.getElementById("filter3").checked){
        form.submit();
      }
    });
</script>



 <script src="js/index.js"></script>

<?php
 //file: view/notifications/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $filterby = $view->getVariable("filterby");
 $notifications_user = $view->getVariable("notifications");
 $typeuser = $view->getVariable("typeuser");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Notifications")?></strong><br>
      <?php if ($typeuser==usertype::Administrator || $typeuser==usertype::Trainer): ?>
        <a href="index.php?controller=notification&amp;action=add"><input type='button' value=<?= i18n("New")?> /></a>
      <?php endif ?>
    </div>
    <div class="filter-box-notifications">
        <form id="form-notifications-filterby" action="index.php?controller=notifications_user&amp;action=index" method="POST">
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
        <td><strong><?= i18n("View")?></strong></td>
        <td><strong><?= i18n("Read")?></strong></td>
      <?php foreach ($notifications_user as $notification_user): ?>
        <tr class="table-row-content"
          data-href="index.php?controller=notifications_user&amp;action=edit&amp;id_notification_user=<?= $notification_user->getId() ?>">
          <td><?= $notification_user->getNotification()->getUser_author()->getName() ?></td>
          <td><?= $notification_user->getNotification()->getTitle() ?></td>

          <?php if (strlen($notification_user->getNotification()->getContent())>20): ?>
            <?php $content = substr($notification_user->getNotification()->getContent(),0,20)  . "..."; ?>
            <?php else:?>
              <?php $content = $notification_user->getNotification()->getContent(); ?>
              <?php endif ?>
          <td><?= $content ?></td>
          <td><?= $notification_user->getNotification()->getDate() ?></td>
          <td><a href="index.php?controller=notifications_user&amp;action=view&amp;id_notification_user=<?= $notification_user->getNotification()->getId() ?>">
            <img src="resources/icons/ic_visibility_black_24px.svg" alt="View" /></a></td>
            <?php $link = ($notification_user->getViewed() != NULL)?
               'index.php?controller=notifications_user&amp;action=markAsUnread&amp;id_notification_user='.$notification_user->getId()
              :'index.php?controller=notifications_user&amp;action=markAsRead&amp;id_notification_user='.$notification_user->getId() ?>
          <td><a class="confirmation" href="<?= $link ?>">
            <?php $icon = ($notification_user->getViewed() != NULL)?'ic_check_box.svg':'ic_check_box_outline.svg';?>
            <img src="resources/icons/<?= $icon ?>" alt="Delete"/></a>
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

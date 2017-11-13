<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $activities = $view->getVariable("activities");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Activities")?></strong><br>
      <a href="index.php?controller=activities&amp;action=add"><input type='button' value=<?= i18n("New")?> /></a>
    </div>
    <table id="table-content">
      <tr class="table-row-content">
        <td><strong><?= i18n("Name")?></strong></td>
        <td><strong><?= i18n("Description")?></strong></td>
        <td><strong><?= i18n("Place")?></strong></td>
        <td><strong><?= i18n("Type")?></strong></td>
        <td><strong><?= i18n("Seats")?></strong></td>
        <td><strong><?= i18n("Edit")?></strong></td>
        <td><strong><?= i18n("Schedules")?></strong></td>
        <td><strong><?= i18n("Notify")?></strong></td>
        <td><strong><?= i18n("Delete")?></strong></td>
      <?php foreach ($activities as $activity): ?>
        <tr class="table-row-content"
          data-href="index.php?controller=activities&amp;action=edit&amp;idactivity=<?= $activity->getIdactivity() ?>">
          <td><?= $activity->getName() ?></td>
          <td><?= $activity->getDescription() ?></td>
          <td><?= $activity->getPlace() ?></td>
          <td><?= $activity->getType() ?></td>
          <td><?= $activity->getSeats() ?></td>
          <td><a href="index.php?controller=activities&amp;action=edit&amp;idactivity=<?= $activity->getIdactivity() ?>">
            <img src="resources/icons/edit_icon.svg" alt="Edit" /></a>
          </td>

          <td><a href="index.php?controller=activity_schedule&amp;action=index&amp;idactivity=<?= $activity->getIdactivity() ?>">
            <img src="resources/icons/ic_schedule_24px.svg" alt="Schedules" /></a>
          </td>
          <td><a class="notify" href="index.php?controller=activity_schedule&amp;action=index&amp;idactivity=<?= $activity->getIdactivity() ?>">
            <img src="resources/icons/ic_add_notification_24px.svg" alt="Notify" /></a>
          </td>
          <td><a class="confirmation" href="index.php?controller=activities&amp;action=delete&amp;idactivity=<?= $activity->getIdactivity() ?>">
            <img src="resources/icons/delete_icon.svg" alt="Delete"/></a>
          </td>
        </tr>
      <?php endforeach; ?>
  </table>
  </div>
</main>

<script type="text/javascript">
  $('.notify').on('click', function () {
    var message =  prompt(ji18n('Please enter your message to notify at group:'),"");
    if (message == null || message == "") {
      history.back();
    } else {
      //txt = "Your message: " + message;
      //alert(window.location.pathname);
      //window.location.href = "index.php";
    }
  });
</script>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>

 <script src="js/index.js"></script>

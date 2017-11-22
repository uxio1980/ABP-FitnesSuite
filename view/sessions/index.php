<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $currentuser = $view->getVariable("currentusername");
 $sessions = $view->getVariable("sessions");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Sessions")?></strong><br>
      <a href="index.php?controller=sessions&amp;action=start"><input type='button' value=<?= i18n("New")?> /></a>
    </div>
    <table id="table-content">
      <tr class="table-row-content">
        <td><strong><?= i18n("Date")?></strong></td>
        <td><strong><?= i18n("Table")?></strong></td>
        <td><strong><?= i18n("Duration")?></strong></td>
        <td><strong><?= i18n("Comment")?></strong></td>
        <td><strong><?= i18n("Edit")?></strong></td>
        <td><strong><?= i18n("Delete")?></strong></td>
      <?php foreach ($sessions as $session): ?>
        <tr class="table-row-content"
          data-href="index.php?controller=users&amp;action=edit&amp;id=<?= $session->getId() ?>">
          <td><?= date("j M, Y g:ia", strtotime($session->getDate())) ?></td>
          <td><?= $session->getUser_table()->getWorkout_table()->getName() ?></td>
          <td><?= date('H:i:s' ,strtotime($session->getDuration() )) ?></td>
          <td><?= $session->getComment() ?></td>
          <td><a href="index.php?controller=sessions&amp;action=edit&amp;id=<?= $session->getId() ?>">
            <img src="resources/icons/edit_icon.svg" alt="Edit" /></a>
          </td>
          <td><a class="confirmation" href="index.php?controller=sessions&amp;action=delete&amp;id=<?= $session->getId() ?>">
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

 <script src="js/index.js"></script>

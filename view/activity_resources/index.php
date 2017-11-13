<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $activity_resources = $view->getVariable("activity_resources");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Manage resources")?></strong><br>
      <a href="index.php?controller=activity_resources&amp;action=add&amp;idactivity=<?= $activity_resources[0]->getIdactivity() ?>"><input type='button' value=<?= i18n("New")?> /></a>
    </div>
    <table id="table-content">
      <tr class="table-row-content">
        <td><strong><?= i18n("Resource")?></strong></td>
        <td><strong><?= i18n("Quantity")?></strong></td>
      <?php foreach ($activity_resources as $activity_resource): ?>
        <tr class="table-row-content"
          data-href="index.php?controller=activity_resources&amp;action=edit&amp;id=<?= $activity_resource->getId() ?>">
          <td><?= $activity_resource->getIdresource() ?></td>
          <td><?= $activity_resource->getQuantity() ?></td>
          <td><a href="index.php?controller=activity_resources&amp;action=edit&amp;id=<?= $activity_resource->getId() ?>">
            <img src="resources/icons/edit_icon.svg" alt="Edit" /></a>
          </td>
          <td><a class="confirmation" href="index.php?controller=activity_resources&amp;action=delete&amp;id=<?= $activity_resource->getId() ?>">
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

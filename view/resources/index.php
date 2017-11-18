<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $resources = $view->getVariable("resources");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Resources")?></strong><br>
      <a href="index.php?controller=resources&amp;action=add_resource"><input type='button' value="<?= i18n("New resource")?>" /></a>
      <a href="index.php?controller=resources&amp;action=add_place"><input type='button' value="<?= i18n("New place")?>" /></a>
    </div>
    <table id="table-content">
      <tr class="table-row-content">
      <td><strong><?= i18n("Type")?></strong></td>
        <td><strong><?= i18n("Name")?></strong></td>
        <td><strong><?= i18n("Description")?></strong></td>
        <td><strong><?= i18n("Quantity")?></strong></td>
      <?php foreach ($resources as $resource): ?>
        <tr class="table-row-content"
          data-href="index.php?controller=resources&amp;action=edit&amp;idresource=<?= $resource->getIdresource() ?>">
          <td>
            <?php if($resource->getType()==1): ?><?= i18n("Resource") ?>
            <?php else: ?><?= i18n("Place") ?>
            <?php endif ?>
          </td>
          <td><?= $resource->getName() ?></td>
          <td><?= $resource->getDescription() ?></td>
          <td><?= $resource->getQuantity() ?></td>
          <td><a href="index.php?controller=resources&amp;action=edit&amp;idresource=<?= $resource->getIdresource() ?>">
            <img src="resources/icons/edit_icon.svg" alt="Edit" /></a>
          </td>
          <td><a class="confirmation" href="index.php?controller=resources&amp;action=delete&amp;idresource=<?= $resource->getIdresource() ?>">
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

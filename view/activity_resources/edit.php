<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $resource = $view->getVariable("resource");
 $resources = $view->getVariable("resources");
 $activity_resource = $view->getVariable("activity_resource");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit resources");

?>
<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=activity_resources&amp;action=edit" method="POST">

			<strong><?= i18n("Modify resource") ?></strong>
			<label for="form-field"><?= i18n("Resource") ?></label>
			<select name="idresource" required>
				<option value="<?= $resource->getIdresource() ?>" data-max="<?= $resource->getQuantity() ?>" selected>
					<?= $resource->getName()?></option>
				<?php foreach ($resources as $resource): ?>
					<option value="<?= $resource->getIdresource()?>" data-max="<?= $resource->getQuantity() ?>">
						<?= $resource->getName()?></option>
				<?php endforeach; ?>
			</select>

            <label for="form-field"><?= i18n("Quantity") ?></label>
			<input type="number" name="quantity" min="1" max="<?= $activity_resource->getQuantity() ?>" 
				value=<?= $activity_resource->getQuantity() ?> required >
			<?= isset($errors["quantity"])?$errors["quantity"]:"" ?>

			<input name="id" value="<?= $activity_resource->getId() ?>" hidden="true">
            <input name="idactivity" value="<?= $activity_resource->getIdactivity() ?>" hidden="true">
			<input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>
<script>
$('select').change(function(){
    $('input[type=number]').attr('max', $(this).find(":selected").data('max'));
});
</script>
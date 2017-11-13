<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $resources = $view->getVariable("resources");
 $idactivity = $view->getVariable("idactivity");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Add resources");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=activity_resources&amp;action=add" method="POST">

			<strong><?= i18n("Add resource") ?></strong>

			<label for="form-field"><?= i18n("Resource") ?></label>
			<select name="idresource" class="select" required>
				<option value=""></option>
				<?php foreach ($resources as $resource): ?>
				<option value="<?= $resource->getIdresource()?>" data-max="<?= $resource->getQuantity() ?>">
					<?= $resource->getName()?></option>
				<?php endforeach; ?>
			</select>

            <label for="form-field"><?= i18n("Quantity") ?></label>
			<input type="number" name="quantity" min="1" max="" required >
			<?= isset($errors["quantity"])?$errors["quantity"]:"" ?>

            <input name="idactivity" value="<?= $idactivity ?>" hidden="true">
			<input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>
<script>
$('select').change(function(){
    $('input[type=number]').attr('max', $(this).find(":selected").data('max'));
});
</script>
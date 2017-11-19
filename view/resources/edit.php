<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $resource = $view->getVariable("resource");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit Activity");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=resources&amp;action=edit" method="POST"
		 enctype="multipart/form-data">
			<strong><?= i18n("Modify resource") ?></strong>
			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name" value="<?= $resource->getName() ?>" minlength="2" maxlength="45" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ0-9 ]+" title="Formato incorrecto" required >
			<?= isset($errors["name"])?$errors["name"]:"" ?>

			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" rows="4" cols="50" required><?=$resource->getDescription() ?></textarea>
			<?= isset($errors["description"])?$errors["description"]:"" ?><br>

			<?php if($resource->getType() == 1): ?>
				<label for="form-field"><?= i18n("Quantity") ?></label>
				<input type="number" name="quantity" value="<?= $resource->getQuantity() ?>" min="1" required >
				<?= isset($errors["quantity"])?$errors["quantity"]:"" ?>	
			<?php else: ?>
				<input name="quantity" value="<?= $resource->getQuantity() ?>" hidden="true">
			<?php endif ?>

			<input name="type" value="<?= $resource->getType() ?>" hidden="true">
			<input name="idresource" value="<?= $resource->getIdresource() ?>" hidden="true">
			<input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

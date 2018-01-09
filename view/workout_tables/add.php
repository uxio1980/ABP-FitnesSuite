<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $type = $view->getVariable("type");
 $exercises = $view->getVariable("exercises");
 $id_userPEF = $view->getVariable("id_userPEF");
 $view->setVariable("title", i18n("Add workout table"));

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=workout_tables&amp;action=add" method="POST"
		 enctype="multipart/form-data">
			<?php if($type == "standard"):?>
                <strong><?= i18n("Add standad workout table") ?></strong>
            <?php else: ?>
                <strong><?= i18n("Add customized workout table") ?></strong>
            <?php endif ?>
			<label for="form-field"><?= i18n("Name") ?></label>
			<input type="text" name="name" minlength="2" maxlength="45" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ 0-9]+" title="Formato incorrecto" required >
			<?= isset($errors["name"])?$errors["name"]:"" ?>
			<label for="name-field"><?= i18n("Description") ?></label>
			<textarea name="description" rows="4" cols="50" required></textarea>
      <input type="hidden" name="id_userPEF" value="<?= $id_userPEF ?>"/>

			<?= isset($errors["description"])?$errors["description"]:"" ?><br>

           <input type="submit" name="submit" value="<?= i18n("Add") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

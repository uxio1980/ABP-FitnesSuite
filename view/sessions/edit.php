<?php
 //file: view/articles/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $session = $view->getVariable("session");
 $user_tables = $view->getVariable("user_tables");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit Session");

?>

<main id="main-content">
	<div class="form">
	   <form action="index.php?controller=sessions&amp;action=edit" method="POST"
		 enctype="multipart/form-data">
			<strong><?= i18n("Edit Session") ?></strong>
      <input type="hidden" name="id" value="<?= $session->getId() ?>"/>

      <label for="login-field"><?= i18n("Workout table")?></label>
      <select name="user_table">
      <?php foreach ($user_tables as $user_table): ?>
        <option <?=($session->getUser_table()->getId()==$user_table->getId())?'selected="selected"':''?> value=<?= $user_table->getId()?>><?= $user_table->getWorkout_table()->getName()?></option>
      <?php endforeach; ?>
      </select>
      <?= isset($errors["user_type"])?$errors["user_type"]:"" ?>

      <label for="login-field"><?= i18n("Date")?></label>
      <?php $date = date("Y-m-d\Th:i",strtotime($session->getDate())); ?>
      <input type="datetime-local" name="date" value="<?= $date ?>" />
      <?= isset($errors["date"])?$errors["date"]:"" ?>

      <label for="login-field"><?=i18n("Duration")?></label>
      <input type="time" name="duration" required="true" value="<?= $session->getDuration() ?>"/>
      <?= isset($errors["duration"])?$errors["duration"]:"" ?><br>

      <label for="name-field"><?= i18n("Comment") ?></label>
			<textarea name="comment" rows="4" cols="50" required><?=$session->getComment() ?></textarea>
			<?= isset($errors["comment"])?$errors["comment"]:"" ?><br>

			<input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
      </form>
    </div>

</main>
<script src="js/index.js"></script>

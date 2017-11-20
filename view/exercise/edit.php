<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$exercise = $view->getVariable("exercise");
$view->setVariable("title", "Edit Exercise");
?>

<main id="main-content">
    <div class="form">
        <form action="index.php?controller=exercise&amp;action=edit" method="POST"
              enctype="multipart/form-data">
            <strong><?= i18n("Modify exercise") ?></strong>
            <label for="form-field"><?= i18n("Name") ?></label>
            <input type="text" name="name" value="<?= $exercise->getName() ?>" minlength="5" maxlength="50" required >
            <?= isset($errors["name"])?$errors["name"]:"" ?>

            <label for="name-field"><?= i18n("Description") ?></label>
            <textarea name="description" rows="4" cols="50"><?=$exercise->getDescription() ?></textarea>
            <?= isset($errors["description"])?$errors["description"]:"" ?><br>

            <label for="form-field"><?= i18n("Type") ?></label>
            <select name="type" value="<?=i18n($exercise->getType())?>">
                <option value="<?=i18n("Cardiovascular")?>"><?=i18n("Cardiovascular")?></option>
                <option value="<?=i18n("Muscular")?>"><?=i18n("Muscular")?></option>
                <option value="<?=i18n("Stretch")?>"><?=i18n("Stretch")?></option>
            </select>
            <label for="name-field"><?= i18n("Image") ?> (<?= i18n("select a image") ?>)</label>
            <input type="file" name="images[]" multiple accept="image/*">
            <?= isset($errors["image"])?$errors["image"]:"" ?><br>
            <label for="name-field"><?= i18n("Video") ?> (<?= i18n("Enter a video URL") ?>)</label>
            <input type="text" name="videos" placeholder="<?= $exercise->getVideo()?>">
            <input name="id_exercise" value="<?= $exercise->getId() ?>" hidden="true">
            <input type="submit" name="submit" value="<?= i18n("Modify") ?>"/>
        </form>
    </div>

</main>
<script src="js/index.js"></script>

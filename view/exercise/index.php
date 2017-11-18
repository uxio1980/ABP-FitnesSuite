<?php
//file: view/exercise/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$exercises = $view->getVariable("exercises");

$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
    <ul class="article-container">
        <li id="commercial-box" class="commercial-box">
            <div class="commercial-textbox">
                <p class="commercial-title commercial-title-second"><?= i18n("Exercises")?></p>
                <!--<p class="commercial-description"></p>-->

            </div>
        </li>
        <?php foreach ($exercises as $exercise): ?>
            <li class="article-box">
                <a href="index.php?controller=exercise&amp;action=view&amp;id_exercise=<?= $exercise->getId() ?>">
                    <?php if ($exercise->getImage() == NULL):
                        $pathimage = 'resources/images/_missing-thumbnail.png' ?>
                    <?php else:
                        $pathimage = json_decode($exercise->getImage())[0] ?>
                    <?php endif ?>
                    <img src="<?= $pathimage ?>" alt="Image 1"></a>
                <div class="article-footer">
                    <div class="tittle-edit">
                        <p class="article-box-title"><?= $exercise->getName() ?></p>
                    </div>
                    <p><?= $exercise->getDescription() ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</main>
<script src="js/index.js"></script>

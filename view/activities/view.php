<?php
 //file: view/activitys/view.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $activity = $view->getVariable("activity");
 $images = $view->getVariable("images");
 $trainer = $view->getVariable("trainer");
 $place = $view->getVariable("place");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", $activity->getName());

?>
<article id="main-detail-content">
    <div class="article-slideshow">
        <div class="slideshow-picture">
            <?php if ($images != NULL): ?>
                <?php foreach ($images as $image): ?>
                    <img class="slide" src="<?= $image ?>" width="512" height="400" alt="Image 1">
                <?php endforeach; ?>
            <?php else:?>
                <img class="slide" src="resources/images/_missing-thumbnail.png" alt="Image missing">
            <?php endif ?>
          </div>

          <div class="slideshow-button">
                <button class="previous-btn" onclick="plusDivs(-1)"><?= i18n("❮ Prev")?></button>
                <button class="next-btn" onclick="plusDivs(1)"><?= i18n("Next ❯")?></button>
          </div>
        </div>

		<div class="article-user">
			<div class="article-description">
        <div class="article-title">
          <div class="article-name">
            <p><?= $activity->getName()?></p>
          </div>
        </div>
            <p class="article-detail"><?= $activity->getDescription()?></p>
            <?= i18n("Type")?>: <p class="article-detail">
                <?php if($activity->getType()==1): ?>
                    <?= i18n("Individual")?>
                <?php else: ?>
                    <?= i18n("In group")?>
                <?php endif ?>
            </p>
            <?= i18n("Place")?>: <p class="article-detail"><?= $place->getName() ?></p>
            <?= i18n("Trainer")?>: <p class="article-detail"><?= $trainer ?></p>
            <?= i18n("Seats")?>: <p class="article-detail"><?= $activity->getSeats()?></p>
        </div>
    </div>
</article>

<footer>
    <script src="js/index.js"></script>
<script type="text/javascript" src="js/XHConn.js"></script>
</footer>

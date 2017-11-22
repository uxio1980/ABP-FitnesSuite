<?php
 //file: view/activitys/view.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $exercise = $view->getVariable("exercise");
 $images = $view->getVariable("images");
 $videos = $view->getVariable("videos");
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("user");

 $view->setVariable("title", $exercise->getName());

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
                <p><?= $exercise->getName()?></p>
              </div>
            </div>
            <p class="article-detail"><?= $exercise->getDescription()?>
            </p><?= i18n("Type")?>: <p class="article-detail"><?= $exercise->getType()?>
            </p><?= i18n("Aded_by")?>: <p class="article-detail"><?= $user->getName() ?></p>
        </div>
            <div>
                <?= i18n("Video")?>: <p class="article-detail"><?= $exercise->getVideo()?></p>
            </div>
    </div>

</article>

<footer>
    <script src="js/index.js"></script>
<script type="text/javascript" src="js/XHConn.js"></script>
</footer>

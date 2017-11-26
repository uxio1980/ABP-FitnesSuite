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
                    <img class="slide" src="<?= $image ?>" alt="Image 1">
                <?php endforeach; ?>
            <?php else:?>
                <img class="slide" src="resources/images/_missing-thumbnail.png" alt="Image missing">
            <?php endif ?>
          </div>

          <div class="slideshow-button">
                <button class="previous-btn" onclick="plusDivs(-1)"><?= i18n("❮ Prev")?></button>
                <button class="next-btn" onclick="plusDivs(1)"><?= i18n("Next ❯")?></button>
          </div>
          <div class="article-gallery">
      <?php if ($images[0]!= NULL): ?>
        <?php $paththumbnail = file_exists($images[0])  ?
                    $images[0]
                    :'./resources/images/_missing-thumbnail.png' ?>
                <div class="article-gallery-picture" onclick="currentDiv(1)"><img class="thumbnail" src="<?= $paththumbnail ?>" alt="Image 1"></div>
      <?php endif ?>
            <?php if (sizeof($images)>1 && $images[1]!= NULL): ?>
              <?php $paththumbnail = file_exists($images[1])  ?
                    $images[1]
                    :'./resources/images/_missing-thumbnail.png' ?>
                <div class="article-gallery-picture" onclick="currentDiv(2)"><img class="thumbnail" src="<?= $paththumbnail ?>" alt="Image 2"></div>
      <?php endif ?>
            <?php if (sizeof($images)>2 && $images[2]!== NULL): ?>
              <?php $paththumbnail = file_exists($images[2])  ?
                    $images[2]
                    :'./resources/images/_missing-thumbnail.png' ?>
                <div class="article-gallery-picture" onclick="currentDiv(3)"><img class="thumbnail" src="<?= $paththumbnail ?>" alt="Image 3"></div>
      <?php endif ?>
          </div>
        </div>

		<div class="article-user">
      <div class="article-description">
        <div class="article-title">
          <div class="article-name">
            <p><?= $exercise->getName()?></p>
          </div>
        </div>
        <p class="article-detail"><?= $exercise->getDescription()?></p>
        <p class="article-detail">
            <?= i18n("Type")?>: <?= $exercise->getType()?>
        </p>
        <div class="social-network-icon">
          <a href="#"><img src="resources/icons/facebook-icon.svg" alt="Facebook icon"></a>
          <a href="#"><img src="resources/icons/google-plus-icon.svg" alt="Google plus icon"></a>
          <a href="#"><img src="resources/icons/twitter-icon.svg" alt="Twitter icon"></a>
        </div>
      </div>
      <?php if(strlen($exercise->getVideo())>0): ?>
        <div class="article-autor">
          <div class="video-detail"><iframe width="100%" height="100%" src=" <?= $exercise->getVideo()?>" frameborder="0" gesture="media" allowfullscreen=""></iframe></div>

        </div>
      <?php endif ?>
    </div>

</article>

<footer>
    <script src="js/index.js"></script>
<script type="text/javascript" src="js/XHConn.js"></script>
</footer>

<?php
 //file: view/activitys/view.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $activity = $view->getVariable("activity");
 $trainer = $view->getVariable("trainer");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", $activity->getName());

?>
<article id="main-detail-content">
    <div class="article-slideshow">
          <div class="slideshow-picture">
          <?php if ($activity->getImage()!= NULL): ?>
				<?php $pathimage = file_exists('./resources/images/'.$activity->getImage())  ?
				'./resources/images/'.$activity->getImage()
				:'./resources/images/_missing-thumbnail.png' ?>
                <img class="slide" src="<?= $pathimage ?>" alt="Image 1">
          <?php else:?>
                <img class="slide" src="resources/images/_missing-thumbnail.png" alt="Image missing">
		  <?php endif ?>
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
            <?= i18n("Place")?>: <p class="article-detail"><?= $activity->getPlace()?></p>
            <?= i18n("Trainer")?>: <p class="article-detail"><?= $trainer ?></p>
            <?= i18n("Type")?>: <p class="article-detail"><?= $activity->getType()?></p>
            <?= i18n("Seats")?>: <p class="article-detail"><?= $activity->getSeats()?></p>
            <a href="index.php?controller=activities&amp;action=edit&amp;idactivity=<?= $activity->getIdactivity() ?>">Edit</a>
            <a href="index.php?controller=activities&amp;action=delete&amp;idactivity=<?= $activity->getIdactivity() ?>">Delete</a>
        </div>
    </div>
</article>

<footer>
    <script src="js/index.js"></script>
<script type="text/javascript" src="js/XHConn.js"></script>
</footer>

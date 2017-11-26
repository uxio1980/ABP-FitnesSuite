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
                  <?php if ($image!= NULL): ?>
                <?php $pathimage = file_exists('$image')  ?
                    $image
                :'./resources/images/_missing-thumbnail.png' ?>
                    <img class="slide" src="<?= $image ?>"  alt="Image 1">
                    <?php endif ?>
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
            <p><?= $activity->getName()?></p>
          </div>
          <div class="article-price">
            <p><?= $activity->getSeats()?> <?= i18n("Seats")?></p>
        </div>
        </div>
				<p class="article-detail"><?= $activity->getDescription()?></p>
        <p class="article-detail">
            <?= i18n("Type")?>:
            <?php if($activity->getType()==1): ?>
                <?= i18n("Individual")?>
            <?php else: ?>
                <?= i18n("In group")?>
            <?php endif ?>
        </p>
        <p class="article-detail"> <?= i18n("Place")?>: <?= $place->getName() ?></p>
				<div class="social-network-icon">
					<a href="#"><img src="resources/icons/facebook-icon.svg" alt="Facebook icon"></a>
					<a href="#"><img src="resources/icons/google-plus-icon.svg" alt="Google plus icon"></a>
					<a href="#"><img src="resources/icons/twitter-icon.svg" alt="Twitter icon"></a>
				</div>
			</div>
      <div class="article-autor"><p class="article-detail">Entrenador</p>
            <?php
      			$path = $trainer->getProfileImage()!=NULL?
            (file_exists('./resources/profiles/'.$trainer->getProfileImage())  ?
      				'./resources/profiles/'.$trainer->getProfileImage()
      				:'./resources/profiles/profile-default.png'): './resources/profiles/profile-default.png';
      			?>
            <a href="#"><div class="image-profile"><img src="<?= $path ?>" alt="image profile"></div><?= $trainer->getSurname().', '.$trainer->getName() ?></a>
				<p class="autor-detail"> <?= $trainer->getDescription() ?></p>
			</div>
		</div>
	</article>
	<footer>


		<script src="js/index.js"></script>
    <script type="text/javascript" src="js/XHConn.js"></script>
	</footer>

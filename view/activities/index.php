<?php
 //file: view/activities/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $activities = $view->getVariable("activities");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
    <ul class="article-container">
    <li id="commercial-box" class="commercial-box">
      <div class="commercial-textbox">
        <p class="commercial-title commercial-title-second"><?= i18n("Activities")?></p>
        <!--<p class="commercial-description"></p>-->
      </div>
    </li>
    <?php foreach ($activities as $activity): ?>
	   		<li class="article-box">
          <a href="index.php?controller=activities&amp;action=view&amp;idactivity=<?= $activity->getIdactivity() ?>">
            <?php if ($activity->getImage() == NULL):
						  $pathimage = 'resources/images/_missing-thumbnail.png' ?>
					  <?php else:
						  $pathimage = json_decode($activity->getImage())[0] ?>
					  <?php endif ?>
          <img src="<?= $pathimage ?>" alt="Image 1"></a>
                    <div class="article-footer">
                      <div class="tittle-edit">
                        <p class="article-box-title"><?= $activity->getName() ?></p>
                      </div>
                      <p><?= substr ($activity->getDescription(),0,50) ?>...</p>
                    </div>
            </li>
    <?php endforeach; ?>
     </ul>
</main>
 <script src="js/index.js"></script>

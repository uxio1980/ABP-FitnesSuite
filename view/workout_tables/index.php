<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$tables = $view->getVariable("tables");
$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
 <ul class="article-container">
  <li id="commercial-box" class="commercial-box">
   <div class="commercial-textbox">
    <p class="commercial-title commercial-title-second"><?= i18n("Workout Tables")?></p>
    <!--<p class="commercial-description"></p>-->
   </div>
  </li>
     <?php foreach ($tables as $table): ?>
      <li class="article-box">
       <a href="index.php?controller=workout_tables&amp;action=view&amp;id_workout=<?=$table->getId() ?>">

        <img src="../resources/images/grid_image.svg" alt="Workout Table Icon"></a>
       <div class="article-footer">
        <div class="tittle-edit">
         <p class="article-box-title"><?= $table->getName() ?></p>
         <p class="article-box-title"><?= $User ?></p>
        </div>
        <p class="article-box-title"><?= $table->getType() ?></p>
        <p class="article-box-title"><?= $table->getDescription() ?></p>
       </div>
      </li>
     <?php endforeach; ?>
 </ul>
</main>
<script src="js/index.js"></script>

<?php
//file: view/main/pricing.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$trainers = $view->getVariable("trainers");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <ul class="article-container">
    <li id="commercial-box" class="commercial-box">
      <img class="commercial-image" src="resources/images/about_img.jpg" alt="commercial picture" />
      <div class="commercial-textbox">
        <p class="commercial-title commercial-title-second"><?= i18n("Our trainers")?></p>
        <!--<p class="commercial-description"></p>-->
      </div>
    </li>
    <?php foreach ($trainers as $trainer): ?>
        <li class="article-box">
            </li>
    <?php endforeach; ?>
    <li id="commercial-box" class="commercial-box">
      <div class="commercial-textbox">
        <p class="commercial-title commercial-title-second"><?= i18n("Why Join ?")?></p>
        <p class="commercial-title">sed diam nonummy nibh euismod</p>
        <p class="commercial-description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nibh euismod tincidunt ut laoreet dolore magna . </p>
      </div>
    </li>
  </ul>
</main>
<script src="js/index.js"></script>

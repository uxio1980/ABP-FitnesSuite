<?php
//file: view/main/pricing.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$articles = $view->getVariable("articles");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <ul class="article-container">
    <li id="commercial-box" class="commercial-box">
      <img class="commercial-image" src="resources/images/aboutus.jpg" alt="commercial picture" />
      <div class="commercial-textbox">
        <p class="commercial-title commercial-title-second"><?= i18n("About us")?></p>
        <!--<p class="commercial-description"></p>-->
      </div>
    </li>
    <li id="commercial-box-index" class="commercial-box-index">
        <img class="commercial-image-index" src="resources/images/about_img1.jpg" alt="commercial picture" />
        <div class="commercial-textbox-index">
          <p class="commercial-title">Lorem ipsum dolor sit!</p>
          <p class="commercial-description">aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
        </div>
    </li>
    <li id="commercial-box" class="commercial-box">
      <div class="commercial-textbox">
        <p class="commercial-title commercial-title-second"><?= i18n("Have a question?")?></p>
        <p class="commercial-description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
        <p class="commercial-title">555123456</p>
      </div>
    </li>
  </ul>
</main>
<script src="js/index.js"></script>

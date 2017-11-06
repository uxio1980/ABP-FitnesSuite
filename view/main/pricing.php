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
      <img class="commercial-image" src="resources/images/price.jpg" alt="commercial picture" />
      <div class="commercial-textbox">
        <p class="commercial-title commercial-title-second"><?= i18n("Pricing and plans")?></p>
        <!--<p class="commercial-description"></p>-->
      </div>
    </li>
    <li class="article-box">
      <?php $pathimage = '/resources/images/_missing-thumbnail.png' ?>
      <img src="<?= $pathimage ?>" alt="Image 1">
      <div class="article-footer">
        <div class="tittle-edit">
          <p class="article-box-title">Nombre</p>
        </div>
        <p class="article-seller"><?= i18n("sold by ")?><span>Usuario</span></p>
        <p class="article-price">20€</p>
      </div>
    </li>
    <li class="article-box">
      <?php $pathimage = '/resources/images/_missing-thumbnail.png' ?>
      <img src="<?= $pathimage ?>" alt="Image 1">
      <div class="article-footer">
        <div class="tittle-edit">
          <p class="article-box-title">Nombre</p>
        </div>
        <p class="article-seller"><?= i18n("sold by ")?><span>Usuario</span></p>
        <p class="article-price">20€</p>
      </div>
    </li>
    <li class="article-box">
      <?php $pathimage = '/resources/images/_missing-thumbnail.png' ?>
      <img src="<?= $pathimage ?>" alt="Image 1">
      <div class="article-footer">
        <div class="tittle-edit">
          <p class="article-box-title">Nombre</p>
        </div>
        <p class="article-seller"><?= i18n("sold by ")?><span>Usuario</span></p>
        <p class="article-price">20€</p>
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

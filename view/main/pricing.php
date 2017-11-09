<?php
//file: view/main/pricing.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$articles = $view->getVariable("articles");
$currentuser = $view->getVariable("currentusername");
$public_info = $view->getVariable("public_info");
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
    <?php $pathTickImageBlue = '/resources/images/tick-blue.png' ?>
    <li class="article-box pricing-box">
        <div class="tittle-edit">
          <p class="article-box-title pricing-box-title"><?= i18n("ONE DAY TRAINING") ?></p>
        </div>
        <p class="pricing-price1"><?= i18n("FREE") ?></p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
    </li>
    <li class="article-box pricing-box background-color1">
        <div class="tittle-edit">
          <p class="article-box-title pricing-box-title second-color">6 <?= i18n("MONTHS MEMBERSHIP") ?></p>
        </div>
        <div class="pricing-box-price">
          <p class="pricing-price1 second-color">33</p>
          <p class="pricing-price2 second-color">.33</p>
          <p class="pricing-price1 second-color">€</p>
        </div>
        <?php $pathTickImageWhite = '/resources/images/tick.png' ?>
        <p class="article-seller pricing-text second-color"><img src="<?= $pathTickImageWhite ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text second-color"><img src="<?= $pathTickImageWhite ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text second-color"><img src="<?= $pathTickImageWhite ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text second-color"><img src="<?= $pathTickImageWhite ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text second-color"><img src="<?= $pathTickImageWhite ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
    </li>
    <li class="article-box pricing-box" >
        <div class="tittle-edit">
          <p class="article-box-title pricing-box-title" >12 <?= i18n("MONTHS MEMBERSHIP") ?></p>
        </div>
        <div class="pricing-box-price">
          <p class="pricing-price1">120</p>
          <p class="pricing-price2">.00</p>
          <p class="pricing-price1">€</p>
        </div>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Lorem Ipsum dolor sit amet <span>destacado</span></p>
    </li>
    <li id="commercial-box" class="commercial-box">
      <div class="commercial-textbox">
        <p class="commercial-title commercial-title-second"><?= i18n("Have a question?")?></p>
        <p class="commercial-description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
        <p class="commercial-title"><?= $public_info->getPhone() ?></p>
      </div>
    </li>
  </ul>
</main>
<script src="js/index.js"></script>

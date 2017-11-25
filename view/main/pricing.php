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
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> <span>Accede</span> a nuestras instalaciones.</p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Podrás asistir a la clase que desees de manera <span>totalmente gratuita</span>.</p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Nuestros entrenadores responderán todas tus <span>dudas</span>.</p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Un entrenador te informará de nuestros <span>servicios personalizados</span>.</p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Aprovecha las <span>ofertas</span> que tenemos para tí, te informaremos gustosamente.</p>
    </li>
    <li class="article-box pricing-box background-color1">
        <div class="tittle-edit">
          <p class="article-box-title pricing-box-title second-color">6 <?= i18n("MONTHS MEMBERSHIP") ?></p>
        </div>
        <div class="pricing-box-price">
          <p class="pricing-price1 second-color">63</p>
          <p class="pricing-price2 second-color">.33</p>
          <p class="pricing-price1 second-color">€</p>
        </div>
        <?php $pathTickImageWhite = '/resources/images/tick.png' ?>
        <p class="article-seller pricing-text second-color"><img src="<?= $pathTickImageWhite ?>" alt="Image tick"> <span>Accede</span> a todas nuestras instalaciones.</p>
        <p class="article-seller pricing-text second-color"><img src="<?= $pathTickImageWhite ?>" alt="Image tick"> Acceso a todas nuestras clases ofertadas durante el periodo.</p>
        <p class="article-seller pricing-text second-color"><img src="<?= $pathTickImageWhite ?>" alt="Image tick"> Como usuario con Tarjeta de Univeritario <span>TDU</span> tendrás acceso a nuestras tablas preconfiguradas.</p>
        <p class="article-seller pricing-text second-color"><img src="<?= $pathTickImageWhite ?>" alt="Image tick"> Si eres un usuario Ponte En Forma <span>PEF</span> te asignaremos un entrenador personal.</p>
        <p class="article-seller pricing-text second-color"><img src="<?= $pathTickImageWhite ?>" alt="Image tick"> Tu entrenador personal diseñará para ti un <span>plan especifico y personalizado</span> ajustándose a tus necesidades.</p>
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
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> <span>Accede</span> a todas nuestras instalaciones.</p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Acceso a todas nuestras clases ofertadas durante el periodo.</p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Como usuario con Tarjeta de Univeritario <span>TDU</span> tendrás acceso a nuestras tablas preconfiguradas.</p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Si eres un usuario Ponte En Forma <span>PEF</span> te asignaremos un entrenador personal.</p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Tu entrenador personal diseñará para ti un <span>plan especifico y personalizado</span> ajustándose a tus necesidades.</p>
        <p class="article-seller pricing-text"><img src="<?= $pathTickImageBlue ?>" alt="Image tick"> Además, tendrás <span>descuentos especiales</span> en nuestra tienda.</p>
    </li>
    <li id="commercial-box" class="commercial-box">
      <div class="commercial-textbox">
        <p class="commercial-title commercial-title-second"><?= i18n("Have a question?")?></p>
        <p class="commercial-description"><?= i18n("For further information, please do not hesitate to get in contact with us")?>.</p>
        <p class="commercial-title"><?= $public_info->getPhone() ?></p>
      </div>
    </li>
  </ul>
</main>
<script src="js/index.js"></script>

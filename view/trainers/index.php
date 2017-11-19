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
            <img src="resources/profiles/<?= $trainer->getProfileImage() ?>" alt="Image 1"></a>
            <div class="article-footer">
                <div class="tittle-edit">
                    <p class="article-box-title"><?= $trainer->getName() ?></p>
                </div>
                <p><?= $trainer->getDescription() ?></p>
            </div>
        </li>
    <?php endforeach; ?>
    <li id="commercial-box" class="commercial-box">
      <div class="commercial-textbox">
        <p class="commercial-title commercial-title-second"><?= i18n("Why Join ?")?></p>
        <p class="commercial-title">Tú eres lo importante.</p>
        <p class="commercial-description"> Contamos con los profesionales más cualificados, para que tengas una mejor experiencia en nuestras instalaciones.</p>
      </div>
    </li>
  </ul>
</main>
<script src="js/index.js"></script>

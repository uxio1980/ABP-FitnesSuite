<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $number_users = $view->getVariable("number_users");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Statistics")?></strong><br>
    </div>
    Deportistas registrados: <?= $number_users->getStatistic() ?>
    <p>Ejercicios por tipo:

  </div>
</main>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>

 <script src="js/index.js"></script>

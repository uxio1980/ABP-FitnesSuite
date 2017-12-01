<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $number_users = $view->getVariable("number_users");
 $exercises_type = $view->getVariable("exercises_type");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Statistics")?></strong><br>
    </div>
    Deportistas registrados: <?= $number_users ?>
    <p>Ejercicios por tipo:<p>
    <?php foreach ($exercises_type as $type => $number): ?>
      <?= $type.": ".$number."<p>" ?>
    <?php endforeach; ?>
  </div>
</main>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>

 <script src="js/index.js"></script>

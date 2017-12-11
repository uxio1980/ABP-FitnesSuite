<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $number_users = $view->getVariable("number_users");
 $exercises_type = $view->getVariable("exercises_type");
 $athletes_activity = $view->getVariable("athletes_activity");
 $view->setVariable("title", "FitnesSuite");

?>
<head>
  <script type="text/javascript" src="js/plotly-latest.min.js"></script>
</head>

<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Statistics")?></strong><br>
    </div>
    Deportistas registrados: <?= $number_users->getXaxis() ?><p>
    <div id="exercises"></div><p>
    <div id="activities"></div>
  </div>
</main>

<script>
  var exercises = [<?php echo '"'.implode('","', $exercises_type->getYaxis()).'"' ?>];
  var trace1 = {
    x:['Cardiovascular', 'Muscular', 'Estiramiento'],
    y: exercises,
    type: 'bar',
    orientation: 'v'
  };

  var data = [trace1];
  var layout = {
      title: 'Ejercicios por tipo',
      showlegend: false
  };
  Plotly.newPlot('exercises', data, layout, {displayModeBar: true});
</script>
<script>
  var activities = [<?php echo '"'.implode('","', $athletes_activity->getXaxis()).'"' ?>];
  var athletes = [<?php echo '"'.implode('","', $athletes_activity->getYaxis()).'"' ?>];
  var trace1 = {
    x: activities,
    y: athletes,
    type: 'bar',
    orientation: 'v'
  };

  var data = [trace1];
  var layout = {
      title: 'Deportistas por actividad',
      showlegend: false
  };
  Plotly.newPlot('activities', data, layout, {displayModeBar: true});
</script>
<script src="js/index.js"></script>
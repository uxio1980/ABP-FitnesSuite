<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $assistance = $view->getVariable("assistance");
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
    Asistencia:<p>
    <div id="asssistance"></div>
  </div>
</main>

<script>
  var numbers = [<?php echo '"'.implode('","', $assistance->getYaxis()).'"' ?>];
  var dates = [<?php echo '"'.implode('","', $assistance->getXaxis()).'"' ?>];
  var trace1 = {
    x: dates,
    y: numbers,
    type: 'bar',
    orientation: 'v'
  };

  var data = [trace1];
  var layout = {
      title: 'Asistencia por fecha',
      showlegend: false
  };
  Plotly.newPlot('asssistance', data, layout, {displayModeBar: true});
</script>
<script src="js/index.js"></script>
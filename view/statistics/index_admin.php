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
    Deportistas registrados: <?= $number_users->getXaxis() ?>
    <div id="activities"></div>
  </div>
</main>

<script>
  (function() {
    var d3 = Plotly.d3;
    var activities = [<?php echo '"'.implode('","', $athletes_activity->getXaxis()).'"' ?>];
    var athletes = [<?php echo '"'.implode('","', $athletes_activity->getYaxis()).'"' ?>];
    
    var WIDTH_IN_PERCENT_OF_PARENT = 60,
        HEIGHT_IN_PERCENT_OF_PARENT = 80;
    
    var gd3 = d3.select("div[id='activities']")
        .style({
            width: WIDTH_IN_PERCENT_OF_PARENT + '%',
            'margin-left': (100 - WIDTH_IN_PERCENT_OF_PARENT) / 2 + '%',
    
            height: HEIGHT_IN_PERCENT_OF_PARENT + 'vh',
            'margin-top': (100 - HEIGHT_IN_PERCENT_OF_PARENT) / 2 + 'vh'
        });
    
    var gd = gd3.node();
    
    Plotly.plot(gd, [{
        type: 'bar',
        x: activities,
        y: athletes,
        marker: {
            color: '#C8A2C8',
            line: {
                width: 2.5
            }
        }
    }], {
        title: 'Deportistas por actividad',
        font: {
            size: 16
        }
    });
    
    window.onresize = function() {
        Plotly.Plots.resize(gd);
    };  
  })();
</script>
<script src="js/index.js"></script>
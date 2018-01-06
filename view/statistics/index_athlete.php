<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $assistance = $view->getVariable("assistance");
 $sessions = $view->getVariable("sessions");
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
    <?php if($assistance->getXaxis() != null): ?>
        Asistencia:
        <div id="assistance"></div>
    <?php endif ?>
    <?php if($sessions != null): ?>
        Sesiones:
        <div id="sessions"></div>
    <?php endif ?>
  </div>
</main>

<script>
(function() {
    var d3 = Plotly.d3;
    var numbers = [<?php echo '"'.implode('","', $assistance->getYaxis()).'"' ?>];
    var dates = [<?php echo '"'.implode('","', $assistance->getXaxis()).'"' ?>];
    
    var WIDTH_IN_PERCENT_OF_PARENT = 60,
        HEIGHT_IN_PERCENT_OF_PARENT = 80;
    
    var gd3 = d3.select("div[id='assistance']")
        .style({
            width: WIDTH_IN_PERCENT_OF_PARENT + '%',
            'margin-left': (100 - WIDTH_IN_PERCENT_OF_PARENT) / 2 + '%',
    
            height: HEIGHT_IN_PERCENT_OF_PARENT + 'vh',
            'margin-top': (100 - HEIGHT_IN_PERCENT_OF_PARENT) / 2 + 'vh'
        });
    
    var gd = gd3.node();
    
    Plotly.plot(gd, [{
        type: 'bar',
        x: dates,
        y: numbers,
        marker: {
            color: '#C8A2C8',
            line: {
                width: 2.5
            }
        }
    }], {
        title: 'Asistencia por fecha',
        font: {
            size: 16
        }
    });
    
    window.onresize = function() {
        Plotly.Plots.resize(gd);
    };  
  })();
</script>
<script>
(function() {
    var d3 = Plotly.d3;
    
    var WIDTH_IN_PERCENT_OF_PARENT = 100,
        HEIGHT_IN_PERCENT_OF_PARENT = 80;
    
    var gd3 = d3.select("div[id='sessions']")
        .style({
            width: WIDTH_IN_PERCENT_OF_PARENT + '%',
            'margin-left': (100 - WIDTH_IN_PERCENT_OF_PARENT) / 2 + '%',
    
            height: HEIGHT_IN_PERCENT_OF_PARENT + 'vh',
            'margin-top': (100 - HEIGHT_IN_PERCENT_OF_PARENT) / 2 + 'vh'
        });
    
    var gd = gd3.node();
    var data = new Array();
   
    
    <?php foreach($sessions as $session){ ?>
        var tab = "<?php echo $session->extra()[0] ?>";
        var durations = [<?php echo '"'.implode('","', $session->getYaxis()).'"' ?>];
        var dates = [<?php echo '"'.implode('","', $session->getXaxis()).'"' ?>];
        data.push({
            x: dates,
            y: durations,
            mode: 'lines+markers',
            name: tab
        });
    <?php } ?>
    console.log(data);
    Plotly.plot(gd, data, {
        title: 'Duración de sesiones por fecha (en minutos)',
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
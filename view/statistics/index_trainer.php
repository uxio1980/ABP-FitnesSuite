<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $exercises_type = $view->getVariable("exercises_type");
 $athletes = $view->getVariable("athletes");
 $view->setVariable("title", "FitnesSuite");
 $sessions = $view->getVariable("sessions");
 $id = $view->getVariable("user");

?>
<head>
  <script type="text/javascript" src="js/plotly-latest.min.js"></script>
</head>

<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Statistics")?></strong><br>
    </div>  
        <div>
            <h3><?= i18n("Asigned athletes")?>: <?= $athletes->getYaxis() ?></h3>  
        </div>
        <?php if($sessions != null): ?> 
            <div class="filter-box-notifications">
            <form id="form-filterby" action="index.php?controller=statistics&amp;action=index" method="POST">
                <select name="userid">
                <?php foreach($athletes->getXaxis() as $user): ?>
                    <option <?=($id==$user->getId())?'selected="selected"':''?>
                    value="<?= $user->getId() ?>"><?= $user->getName()." ".$user->getSurname() ?></option>
                <?php endforeach; ?>
                </select> 
            </form>      
        </div>
        <?php endif ?>
    <?php if($sessions != null): ?>
        <div id="sessions"></div>
    <?php endif ?>
    <?php if($exercises_type != null): ?>
        <div id="exercises"></div>
    <?php endif ?>
  </div>
</main>

<script>
  (function() {
    var d3 = Plotly.d3;
    var exercises = [<?php echo '"'.implode('","', $exercises_type->getYaxis()).'"' ?>];
    
    var WIDTH_IN_PERCENT_OF_PARENT = 80,
        HEIGHT_IN_PERCENT_OF_PARENT = 80;
    
    var gd3 = d3.select("div[id='exercises']")
        .style({
            width: WIDTH_IN_PERCENT_OF_PARENT + '%',
            'margin-left': (100 - WIDTH_IN_PERCENT_OF_PARENT) / 2 + '%',
    
            height: HEIGHT_IN_PERCENT_OF_PARENT + 'vh',
            'margin-top': (100 - HEIGHT_IN_PERCENT_OF_PARENT) / 2 + 'vh'
        });
    
    var gd = gd3.node();
    
    Plotly.plot(gd, [{
        type: 'bar',
        x: ['Cardiovascular', 'Muscular', 'Estiramiento'],
        y: exercises,
        marker: {
            color: '#C8A2C8',
            line: {
                width: 2.5
            }
        }
    }], {
        title: '<?= i18n("Exercises by type")?>',
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
    
    var WIDTH_IN_PERCENT_OF_PARENT = 80,
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
        title: '<?= i18n("Sessions duration by date (minutes)")?>',
        font: {
            size: 16
        }
    });
    
    window.onresize = function() {
        Plotly.Plots.resize(gd);
    };  
  })();
</script>

<script type="text/javascript">
    var form = document.getElementById("form-filterby");
    $('select').change( function () {
        form.submit();
    });
</script>
<script src="js/index.js"></script>
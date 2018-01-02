<?php
//file: view/sessions/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$user_tables = $view->getVariable("user_tables");
$activity = $view->getVariable("activity");
$errors = $view->getVariable("errors");
$user_table_for_id = $view->getVariable("user_table");
$view->setVariable("title", "Start Session");

?>
<main id="main-content">

  <div class="form classes-box session-box background-color2">
    <label for="login-field"><?= i18n("Workout table")?></label>
    <select id="select_user_table" name="user_table">

    <?php foreach ($user_tables as $user_table):  ?>

      <option <?=(isset($user_table_for_id) && $user_table_for_id->getId()==$user_table->getId())?'selected="selected"':''?> value=<?= $user_table->getId()?>><?= $user_table->getWorkout_table()->getName()?></option>
    <?php endforeach; ?>
    </select>
    <?= isset($errors["user_type"])?$errors["user_type"]:"" ?><br>

    <div id="showtm" style="font-size:21px; font-weight:800;">0 : 0 : 0<sub>0</sub></div>
    <script type="text/javascript"><!--
    // chronometer / stopwatch JS script - coursesweb.net

    // Here set the minutes, seconds, and tenths-of-second when you want the chronometer to stop
    // If all these values are set to 0, the chronometer not stop automatically
    var sthours = 0;
    var stmints = 0;
    var stseconds = 0;
    var stzecsec = 0;

    // function to be executed when the chronometer stops
    function toAutoStop() {
      alert('Your life goes on');
    }

    // the initial tenths-of-second, seconds, and minutes
    var zecsec = 0;
    var seconds = 00;
    var mints = 00;
    var hours = 00

    var date_now;
    var startchron = 0;

    function chronometer() {
      if(startchron == 1) {
        zecsec += 1;       // set tenths of a second

        // set seconds
        if(zecsec > 9) {
          zecsec = 0;
          seconds += 1;
        }

        // set minutes
        if(seconds > 59) {
          seconds = 0;
          mints += 1;
        }

        // set hours
        if(mints > 59) {
          mints = 0;
          hours += 1;
        }

        // adds data in #showtm
        document.getElementById('showtm').innerHTML = hours+ ' : ' +mints+ ' : '+ seconds+ '<sub>'+ zecsec+ '</sub>';

        // if the chronometer reaches to the values for stop, calls whenChrStop(), else, auto-calls chronometer()
        if(zecsec == stzecsec && seconds == stseconds && mints == stmints &&hours == sthours) toAutoStop();
        else setTimeout("chronometer()", 100);
      }
    }

    function startChr() {
      if (startchron == 0){     // starts the chronometer
        startchron = 1;
        date_now = new Date();
        chronometer();
        $('#power-button').css('background-image', 'url(resources/icons/power_red.svg)');
      }else {
        pauseChr();
        $('#power-button').css('background-image', 'url(resources/icons/power_red.svg)');
        var r = confirm(ji18n('Save the session?'));
        if (r == true) {
             var form = document.createElement('form');
             form.setAttribute('method', 'POST');
             form.setAttribute('action', 'index.php?controller=sessions&action=add');
             form.style.display = 'hidden';
             var input = document.createElement("input");
             input.type = "text";
             input.name = "duration";
             var myDate = new Date();
             myDate.setHours(hours+1, mints, seconds, zecsec);
             input.value = myDate.toISOString();
             form.appendChild(input);
             var input2 = document.createElement("input");
             input2.type = "text";
             input2.name = "date_now";
             input2.value = date_now.toISOString();
             form.appendChild(input2);
             var input3 = document.getElementById("select_user_table");
             form.appendChild(input3);
             document.body.appendChild(form);
             form.submit();
        } else {
            startChr() ;
        }
      }
    }
    function pauseChr() {      // stops the chronometer
      startchron = 0;
      $('#power-button').css('background-image', 'url(resources/icons/power_green.svg)');
    }
    function resetChr() {
      zecsec = 0;  seconds = 0; mints = 0; hours = 0; startchron = 0;
      document.getElementById('showtm').innerHTML =hours+ ' : ' +mints+ ' : '+ seconds+ '<sub>'+ zecsec+ '</sub>';
      $('#power-button').css('background-image', 'url(resources/icons/power_green.svg)');
    }
    // auto start the chronometer, delete this line if you want to not automatically start the stopwatch
    //startChr();
    --></script>
    <!--<a class="a-power-button" href="index.php?controller=sessions&amp;action=start"><img class="power-button" src="resources/icons/power_green.svg" alt="power"/></a>-->
    <button id="power-button" class="power-button" onclick="startChr()"></button>
    <div>
      <button class="start-reset-button" onclick="pauseChr()"><?= i18n("Pause") ?></button>
      <button class="start-reset-button" onclick="resetChr()"><?= i18n("Reset") ?></button>
    </div>
</div>

</main>
<script src="js/index.js"></script>

<?php
//file: view/schedule/index.php

	require_once(__DIR__."/../../core/ViewManager.php");
	$view = ViewManager::getInstance();

	$current_activity = $view->getVariable("current_activity");
	$activities = $view->getVariable("activities");
	$activity_schedules = $view->getVariable("activity_schedules");
	$view->setVariable("title", "Horario");

?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
	<link rel="stylesheet" href="view/schedules/css/reset.css">
	<link rel="stylesheet" href="view/schedules/css/style.css">
</head>
<body>
<main id="main-content">
	<div class="box-schedule">
	  <select name="user_table" onChange="jsFunction()" id="selectOpt">
			<option value="0" <?= !isset($current_activity)?'selected':'' ?>><?= i18n("See all activities") ?></option>
			  <?php foreach ($activities as $activity): ?>
						<option <?= ($current_activity==$activity->getIdActivity())?'selected':'' ?>
						 onclick="jsFunction()"
						value="<?= $activity->getIdactivity() ?>"><?= $activity->getName() ?>
					  </option>
			  <?php endforeach; ?>
				<script>
				function jsFunction(){
  				var myselect = document.getElementById("selectOpt");
					window.location.replace('index.php?controller=schedule&action=index&idactivity='+myselect.options[myselect.selectedIndex].value);
				}
				</script>
			</select>
	<div>
<div class="cd-schedule loading">
	<div class="timeline">
		<ul>
			<li><span>09:00</span></li>
			<li><span>09:30</span></li>
			<li><span>10:00</span></li>
			<li><span>10:30</span></li>
			<li><span>11:00</span></li>
			<li><span>11:30</span></li>
			<li><span>12:00</span></li>
			<li><span>12:30</span></li>
			<li><span>13:00</span></li>
			<li><span>13:30</span></li>
			<li><span>14:00</span></li>
			<li><span>14:30</span></li>
			<li><span>15:00</span></li>
			<li><span>15:30</span></li>
			<li><span>16:00</span></li>
			<li><span>16:30</span></li>
			<li><span>17:00</span></li>
			<li><span>17:30</span></li>
			<li><span>18:00</span></li>
			<li><span>18:30</span></li>
			<li><span>19:00</span></li>
			<li><span>19:30</span></li>
		</ul>
	</div> <!-- .timeline -->

	<div class="events">
		<ul>
			<li class="events-group">
				<?php $lunes = date( 'd', strtotime( 'monday this week' ) );?>
				<div class="top-info"><span><?= $lunes . " - " . i18n("Monday")?></span></div>

				<ul>
					<?php foreach ($activity_schedules as $activity_schedule): ?>
						<?php if (date('d',strtotime($activity_schedule->getDate()))==date('d',strtotime( 'monday this week' )) ):?>
							<li class="single-event" data-start="<?= date('H:i',strtotime($activity_schedule->getStart_hour())) ?>"
								data-end="<?= date('H:i',strtotime($activity_schedule->getEnd_hour())) ?>"
								data-content="view/schedules/event-abs-circuit"
								data-event="event-<?= +$activity_schedule->getActivity()->getIdactivity()%8?>">
								<a href="#0">
									<em class="event-name"><?= $activity_schedule->getActivity()->getName()?></em>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</li>

			<li class="events-group">
				<?php $martes = date( 'd', strtotime( 'tuesday this week' ) );?>
				<div class="top-info"><span><?= $martes . " - " . i18n("Tuesday")?></span></div>

				<ul>
					<?php foreach ($activity_schedules as $activity_schedule): ?>
						<?php if (date('d',strtotime($activity_schedule->getDate()))==date('d',strtotime( 'tuesday this week' )) ):?>
							<li class="single-event" data-start="<?= date('H:i',strtotime($activity_schedule->getStart_hour())) ?>"
								data-end="<?= date('H:i',strtotime($activity_schedule->getEnd_hour())) ?>"
								data-content="view/schedules/event-abs-circuit"
								data-event="event-<?= +$activity_schedule->getActivity()->getIdactivity()%8 ?>">
								<a href="#0">
									<em class="event-name"><?= $activity_schedule->getActivity()->getName()?></em>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</li>

			<li class="events-group">
				<?php $miercoles = date( 'd', strtotime( 'wednesday this week' ) );?>
				<div class="top-info"><span><?= $miercoles . " - " . i18n("Wednesday")?></span></div>

				<ul>
					<?php foreach ($activity_schedules as $activity_schedule): ?>
						<?php if (date('d',strtotime($activity_schedule->getDate()))==date('d',strtotime( 'wednesday this week' )) ):?>
							<li class="single-event" data-start="<?= date('H:i',strtotime($activity_schedule->getStart_hour())) ?>"
								data-end="<?= date('H:i',strtotime($activity_schedule->getEnd_hour())) ?>"
								data-content="view/schedules/event-abs-circuit"
								data-event="event-<?= +$activity_schedule->getActivity()->getIdactivity()%8 ?>">
								<a href="#0">
									<em class="event-name"><?= $activity_schedule->getActivity()->getName()?></em>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</li>

			<li class="events-group">
				<?php $jueves = date( 'd', strtotime( 'thursday this week' ) );?>
				<div class="top-info"><span><?= $jueves . " - " . i18n("Thursday")?></span></div>

				<ul>
					<?php foreach ($activity_schedules as $activity_schedule): ?>
						<?php if (date('d',strtotime($activity_schedule->getDate()))==date('d',strtotime( 'thursday this week' )) ):?>
							<li class="single-event" data-start="<?= date('H:i',strtotime($activity_schedule->getStart_hour())) ?>"
								data-end="<?= date('H:i',strtotime($activity_schedule->getEnd_hour())) ?>"
								data-content="view/schedules/event-abs-circuit"
								data-event="event-<?= +$activity_schedule->getActivity()->getIdactivity()%8 ?>">
								<a href="#0">
									<em class="event-name"><?= $activity_schedule->getActivity()->getName()?></em>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</li>

			<li class="events-group">
				<?php $viernes = date( 'd', strtotime( 'friday this week' ) );?>
				<div class="top-info"><span><?= $viernes . " - " . i18n("Friday")?></span></div>

				<ul>
					<?php foreach ($activity_schedules as $activity_schedule): ?>
						<?php if (date('d',strtotime($activity_schedule->getDate()))==date('d',strtotime( 'friday this week' )) ):?>
							<li class="single-event" data-start="<?= date('H:i',strtotime($activity_schedule->getStart_hour())) ?>"
								data-end="<?= date('H:i',strtotime($activity_schedule->getEnd_hour())) ?>"
								data-content="view/schedules/event-abs-circuit"
								data-event="event-<?= +$activity_schedule->getActivity()->getIdactivity()%8 ?>">
								<a href="#0">
									<em class="event-name"><?= $activity_schedule->getActivity()->getName()?></em>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</li>
		</ul>
	</div>

	<div class="event-modal">
		<header class="header">
			<div class="content">
				<span class="event-date"></span>
				<h3 class="event-name"></h3>
			</div>

			<div class="header-bg"></div>
		</header>

		<div class="body">
			<div class="event-info"></div>
			<div class="body-bg"></div>
		</div>

		<a href="#0" class="close">Close</a>
	</div>

	<div class="cover-layer"></div>
</div> <!-- .cd-schedule -->
<script src="view/schedules/js/modernizr.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script>
	if( !window.jQuery ) document.write('<script src="view/schedules/js/jquery-3.0.0.min.js"><\/script>');
</script>
<script src="view/schedules/js/main.js"></script> <!-- Resource jQuery -->
</main>
</body>
<script src="js/index.js"></script>

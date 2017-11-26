<?php
//file: view/articles/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$activities = $view->getVariable("activities");
$next_events = $view->getVariable("next_events");
//$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <ul class="article-container">
    <li id="commercial-box-index" class="commercial-box-index">
      <img class="commercial-image-index" src="resources/images/pic.png" alt="commercial picture" />
      <div class="commercial-textbox-index">
        <p class="commercial-title"><?= i18n("Practice gives the")?> <?= i18n("Perfect results")?></p>
        <p class="commercial-description"><?= i18n("Get healthy with FitnesSuite, because feeling good is being fit. In the end this is about living well")?>.</p>
      </div>
    </li>
    <div class="list-classes-box">
      <p class="commercial-title2 main-color"><?= i18n("ALL CLASSES")?></p>
      <div class="classes-box commercial-description second-color">
        <ul id="list">
          <?php foreach ($activities as $activity): ?>
          <li id="sublist">
            <i class="clock"> </i>
            <a href="index.php?controller=activities&amp;action=view&amp;idactivity=<?= $activity->getIdactivity()?>">
              <?= $activity->getName() ?></a>
            <div class="social-media">
              <a href=""><span class="timetable-icon" data-tooltip="timetable"></span></a>
              <span class="sendto" data-tooltip="Send to"></span>
              <span class="likeit" data-tooltip="like it"></span>
              <span class="share" data-tooltip="share"></span>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="list-classes-box">
      <p class="commercial-title2 main-color"><?= i18n("MEMBERSHIP PRICES")?></p>
      <li class="article-box membershipprices-box background-color1">
          <div class="tittle-edit">
            <p class="article-box-title pricing-box-title second-color"><?= i18n("Discount of for all members") ?></p>
          </div>
          <div class="pricing-box-price">
            <p class="pricing-price1 second-color">25</p>
            <p class="pricing-price2 second-color"></p>
            <p class="pricing-price1 second-color">%</p>
          </div>
          <p class="commercial-description second-color"><?= i18n("Discount on services and treatments at the GymBase for all membership cards holders.") ?></p>
      </li>
    </div>
    <div class="list-classes-box">
      <p class="commercial-title2 main-color uppercase"><?= i18n("Trainers")?></p>
      <li class="article-box membershipprices-box">

      </li>
    </div>
    <div class="list-classes-box">
      <p class="commercial-title2 main-color uppercase"><?= i18n("Next events")?></p>
      <li class="next-events-container background-color1">
        <?php foreach ($next_events as $next_event): ?>
            <div class="next-event-box">
              <div class="tittle-edit next-event-date">
                <p class="article-box-title commercial-description second-color"><?= date("j M, Y", strtotime($next_event->getDate())) ?></p>
                <?php if ($next_event->getActivity()->getImage() == NULL):
    						  $pathimage = 'resources/images/_missing-thumbnail.png' ?>
    					  <?php else:
    						  $pathimage = json_decode($next_event->getActivity()->getImage()) ?>
    					  <?php endif ?>
                <img src="<?= $pathimage[0] ?>" alt="Image 1">
              </div>
              <div class="commercial-description">
                <p class="commercial-description red-color"><span><?= date( 'g:ia' ,strtotime($next_event->getStart_hour())) ?>-<?= date('g:ia', strtotime($next_event->getEnd_hour())) ?></span></p>
                <a href="index.php?controller=activities&amp;action=view&amp;idactivity=<?= $next_event->getActivity()->getIdactivity()?>">
                  <p class="commercial-description uppercase second-color"><span><?= $next_event->getActivity()->getName() ?></span></p></a>
                <div class="commercial-description">
                  <!-- index.php?controller=Reservation&amp;action=add -->
                  <a href=""><input type='button' value=<?= i18n("Reservation")?> /></a>
                </div>
            </div>
          </div>
          <?php endforeach; ?>
      </li>
    </div>
    <div class="list-classes-box">
      <p class="commercial-title2 main-color uppercase"><?= i18n("Partner")?></p>
      <li class="article-box membershipprices-box background-none box-shadow-none">
        <ul class="partner">
			  	<li><img src="resources/images/p6.png" alt=""/></li>
			  	<li><img src="resources/images/p5.png" alt=""/></li>
			  	<li><img src="resources/images/p4.png" alt=""/></li>
			  	<li><img src="resources/images/p3.png" alt=""/></li>
			  	<li><img src="resources/images/p2.png" alt=""/></li>
			  	<li><img src="resources/images/p1.png" alt=""/></li>
			  </ul>
      </li>
    </div>
    <div class="list-classes-box">
      <p class="commercial-title2 main-color uppercase"><?= i18n("Opening hours")?></p>
      <li class="article-box membershipprices-box background-color1">
        <ul class="times">
        			 	<li class="second-color"><?= i18n("Monday")?><div class="hours second-color">h.8:00-h.22:00</div>  </li>
        			 	<li class="second-color"><?= i18n("Tuesday")?><div class="hours second-color">h.8:00-h.22:00</div>  </li>
        			 	<li class="second-color"><?= i18n("Wednesday")?><div class="hours second-color">h.8:00-h.22:00</div> </li>
        			 	<li class="second-color"><?= i18n("Thrusday")?><div class="hours second-color">h.8:00-h.22:00</div> </li>
        			 	<li class="second-color"><?= i18n("Friday")?><div class="hours second-color">h.8:00-h.22:00</div>  </li>
        			 	<li class="second-color"><?= i18n("Saturday")?><div class="hours second-color">h.8:00-h.22:00</div>  </li>
        			 	<li class="second-color"><?= i18n("Sunday")?><div class="hours second-color">h.10:00-h.14:00</div>  </li>
        			 	<h4><?= i18n("Enjoy it!")?></h4>
        			 </ul>
      </li>
    </div>
      </ul>
    </main>
    <script src="js/index.js"></script>

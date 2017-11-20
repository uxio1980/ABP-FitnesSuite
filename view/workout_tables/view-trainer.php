<?php
 //file: view/activitys/view.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $table = $view->getVariable("table");
 $exercises = $view->getVariable("exercises");

 $view->setVariable("title", $table->getName());

?>
<h1>workout_tables view-trainer</h1>
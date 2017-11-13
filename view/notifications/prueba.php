<?php
 //file: view/notifications/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $filterby = $view->getVariable("filterby");
 $notifications = $view->getVariable("notifications");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">

  <div class="container">
   <div class="sap_tabs">
 <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
   <ul class="resp-tabs-list">
       <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>All Classes</span></li>
     <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Gym Fitness</span></li>
     <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Boxing</span></li>
     <div class="clear"></div>
   </ul>
   <div class="resp-tabs-container">
         <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
       <div class="facts">
         <ul class="tab-left">
           <table class="timetable">
   <thead>
     <tr>
       <th></th>	<th>MONDAY</th>	<th>TUESDAY</th>	<th>WEDNESDAY</th>	<th>THURSDAY</th>	<th>FRIDAY</th>	<th>SATURDAY</th>	<th>SUNDAY</th>	</tr>
   </thead>
   <tbody><tr class="row_1 row_gray">
       <td>
         05.00 - 06.00
       </td><td class="event"><a href="#" title="Boxing">Boxing</a>05.00 - 06.00</td><td class="event"><a href="#" title="Boxing">Boxing</a>05.00 - 06.00</td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_2">
       <td>
         06.00 - 07.00
       </td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>06.00 - 07.00</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>06.00 - 07.00</td><td class="event" rowspan="3"><a href="#">Gym Fitness</a>06.00 - 08.30<br><br><a href="#" title="Cardio Fitness">Cardio Fitness</a>06.00 - 08.30</td><td class="event" rowspan="3"><a href="#" title="Gym Fitness">Gym Fitness</a>06.00 - 08.30<br><br><a href="#" title="Cardio Fitness">Cardio Fitness</a>06.00 - 08.30</td><td class="event" rowspan="3"><a href="#" title="Gym Fitness">Gym Fitness</a>06.00 - 08.30<br><br><a href="#" title="Cardio Fitness">Cardio Fitness</a>06.00 - 08.30</td><td></td><td></td></tr><tr class="row_3 row_gray">
       <td>
         07.00 - 08.00
       </td><td class="event"><a href="#" title="Cardio Fitness">Cardio Fitness</a>07.00 - 08.00</td><td class="event"><a href="#" title="Cardio Fitness">Cardio Fitness</a>07.00 - 08.00</td><td></td><td></td></tr><tr class="row_4">
       <td>
         08.00 - 09.00
       </td><td></td><td></td><td class="event" rowspan="2"><a href="#" title="Indoor Cycling">Indoor Cycling</a>08.00 - 09.30</td><td class="event" rowspan="2"><a href="#" title="Indoor Cycling">Indoor Cycling</a>08.00 - 09.30</td></tr><tr class="row_5 row_gray">
       <td>
         09.00 - 10.00
       </td><td class="event" rowspan="3"><a href="#" title="Indoor Cycling">Indoor Cycling</a>09.00 - 11.25</td><td class="event" rowspan="3"><a href="#" title="Indoor Cycling">Indoor Cycling</a>09.00 - 11.25</td><td></td><td class="event"><a href="#" title="Indoor Cycling">Indoor Cycling</a>09.00 - 10.00</td><td class="event"><a href="#" title="Indoor Cycling">Indoor Cycling</a>09.00 - 10.00</td></tr><tr class="row_6">
       <td>
         10.00 - 11.00
       </td><td></td><td class="event" rowspan="2"><a href="#" title="Cardio Fitness">Cardio Fitness</a>10.00 - 11.30</td><td class="event" rowspan="2"><a href="#" title="Cardio Fitness">Cardio Fitness</a>10.00 - 11.30</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>10.00 - 11.00</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>10.00 - 11.00</td></tr><tr class="row_7 row_gray">
       <td>
         11.00 - 12.00
       </td><td></td><td class="event"><a href="#" title="Indoor Cycling">Indoor Cycling</a>11.00 - 12.00</td><td class="event"><a href="#" title="Indoor Cycling">Indoor Cycling</a>11.00 - 12.00</td></tr><tr class="row_8">
       <td>
         12.00 - 13.00
       </td><td></td><td></td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>12.00 - 13.00</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>12.00 - 13.00</td><td class="event" rowspan="4"><a href="#" title="Boxing">Boxing</a>12.00 - 15.45</td><td class="event" rowspan="4"><a href="#" title="Gym Fitness">Gym Fitness</a>12.00 - 13.00<br><br><a href="#" title="Boxing">Boxing</a>12.00 - 15.45<br><br><a href="#" title="Cardio Fitness">Cardio Fitness</a>14.00 - 16.00</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>12.00 - 13.00</td></tr><tr class="row_9 row_gray">
       <td>
         13.00 - 14.00
       </td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_10">
       <td>
         14.00 - 15.00
       </td><td class="event" rowspan="4"><a href="#" title="Gym Fitness">Gym Fitness</a>14.00 - 16.15<br><br><a href="#" title="Indoor Cycling">Indoor Cycling</a>16.00 - 17.30</td><td class="event" rowspan="4"><a href="#" title="Gym Fitness">Gym Fitness</a>14.00 - 16.15<br><br><a href="#" title="Indoor Cycling">Indoor Cycling</a>16.00 - 17.30</td><td></td><td></td><td class="event" rowspan="2"><a href="#" title="Cardio Fitness">Cardio Fitness</a>14.00 - 16.00</td></tr><tr class="row_11 row_gray">
       <td>
         15.00 - 16.00
       </td><td></td><td></td></tr><tr class="row_12">
       <td>
         16.00 - 17.00
       </td><td></td><td class="event" rowspan="2"><a href="#" title="Indoor Cycling">Indoor Cycling</a>16.00 - 17.30</td><td class="event" rowspan="4"><a href="#" title="Indoor Cycling">Indoor Cycling</a>16.00 - 17.30<br><br><a href="#" title="Gym Fitness">Gym Fitness</a>17.30 - 20.00<br><br><a href="#" title="Boxing">Boxing</a>18.00 - 20.00</td><td></td><td></td></tr><tr class="row_13 row_gray">
       <td>
         17.00 - 18.00
       </td><td></td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>17.00 - 18.00</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>17.00 - 18.00</td></tr><tr class="row_14">
       <td>
         18.00 - 19.00
       </td><td class="event" rowspan="2"><a href="#" title="Boxing">Boxing</a>18.00 - 19.00<br><br><a href="#" title="Yoga Pilates">Yoga Pilates</a>18.30 - 20.00</td><td class="event" rowspan="2"><a href="#" title="Boxing">Boxing</a>18.00 - 19.00<br><br><a href="#" title="Yoga Pilates">Yoga Pilates</a>18.30 - 20.00</td><td class="event" rowspan="2"><a href="#" title="Boxing">Boxing</a>18.00 - 20.00<br><br><a href="#" title="Yoga Pilates">Yoga Pilates</a>18.30 - 20.00</td><td class="event" rowspan="2"><a href="#" title="Boxing">Boxing</a>18.00 - 20.00<br><br><a href="#" title="Yoga Pilates">Yoga Pilates</a>18.30 - 20.00</td><td></td><td></td></tr><tr class="row_15 row_gray">
       <td>
         19.00 - 20.00
       </td><td class="event" rowspan="2"><a href="#" title="Yoga Pilates">Yoga Pilates</a>19.00 - 20.30</td><td class="event" rowspan="2"><a href="#" title="Yoga Pilates">Yoga Pilates</a>19.00 - 20.30</td></tr><tr class="row_16">
       <td>
         20.00 - 21.00
       </td><td></td><td></td><td></td><td></td><td></td></tr>
   </tbody>
    </table>
    <div class="timetable_small">
       <ul class="items_list"><h3>Monday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
        <ul class="items_list"><h3>Tuesday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
       <ul class="items_list"><h3>Wednesday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
        <ul class="items_list"><h3>Thrusday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
       <ul class="items_list"><h3>Friday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
       <ul class="items_list"><h3>Saturday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
        <ul class="items_list"><h3>Sunday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
      </div>
    </ul>
  </div>
   </div>
 <div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
   <div class="facts">
   <ul class="tab-left">
     <table class="timetable">
   <thead>
     <tr>
       <th></th>	<th>MONDAY</th>	<th>TUESDAY</th>	<th>WEDNESDAY</th>	<th>THURSDAY</th>	<th>FRIDAY</th>	<th>SATURDAY</th>	<th>SUNDAY</th>	</tr>
   </thead>
   <tbody><tr class="row_1 row_gray">
       <td>
         06.00 - 07.00
       </td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>06.00 - 07.00</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>06.00 - 07.00</td><td class="event" rowspan="3"><a href="#" title="Gym Fitness">Gym Fitness</a>06.00 - 08.30</td><td class="event" rowspan="3"><a href="#" title="Gym Fitness">Gym Fitness</a>06.00 - 08.30</td><td class="event" rowspan="3"><a href="#" title="Gym Fitness">Gym Fitness</a>06.00 - 08.30</td><td></td><td></td></tr><tr class="row_2">
       <td>
         07.00 - 08.00
       </td><td></td><td></td><td></td><td></td></tr><tr class="row_3 row_gray">
       <td>
         08.00 - 09.00
       </td><td></td><td></td><td></td><td></td></tr><tr class="row_4">
       <td>
         09.00 - 10.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_5 row_gray">
       <td>
         10.00 - 11.00
       </td><td></td><td></td><td></td><td></td><td></td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>10.00 - 11.00</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>10.00 - 11.00</td></tr><tr class="row_6">
       <td>
         11.00 - 12.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_7 row_gray">
       <td>
         12.00 - 13.00
       </td><td></td><td></td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>12.00 - 13.00</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>12.00 - 13.00</td><td></td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>12.00 - 13.00</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>12.00 - 13.00</td></tr><tr class="row_8">
       <td>
         13.00 - 14.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_9 row_gray">
       <td>
         14.00 - 15.00
       </td><td class="event" rowspan="3"><a href="#" title="Gym Fitness">Gym Fitness</a>14.00 - 16.15</td><td class="event" rowspan="3"><a href="#" title="Gym Fitness">Gym Fitness</a>14.00 - 16.15</td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_10">
       <td>
         15.00 - 16.00
       </td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_11 row_gray">
       <td>
         16.00 - 17.00
       </td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_12">
       <td>
         17.00 - 18.00
       </td><td></td><td></td><td></td><td></td><td class="event" rowspan="3"><a href="#" title="Gym Fitness">Gym Fitness</a>17.30 - 20.00</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>17.00 - 18.00</td><td class="event"><a href="#" title="Gym Fitness">Gym Fitness</a>17.00 - 18.00</td></tr><tr class="row_13 row_gray">
       <td>
         18.00 - 19.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_14">
       <td>
         19.00 - 20.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
   </tbody>
 </table>
 <div class="timetable_small">
       <ul class="items_list"><h3>Monday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
        <ul class="items_list"><h3>Tuesday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
       <ul class="items_list"><h3>Wednesday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
        <ul class="items_list"><h3>Thrusday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
       <ul class="items_list"><h3>Friday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
       <ul class="items_list"><h3>Saturday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
        <ul class="items_list"><h3>Sunday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
      </div>
   </ul>
  </div>
 </div>
   <div class="tab-3 resp-tab-content" aria-labelledby="tab_item-2">
    <div class="facts">
      <ul class="tab-left">
     <table class="timetable">
   <thead>
     <tr>
       <th></th>	<th>MONDAY</th>	<th>TUESDAY</th>	<th>WEDNESDAY</th>	<th>THURSDAY</th>	<th>FRIDAY</th>	<th>SATURDAY</th>	<th>SUNDAY</th>	</tr>
   </thead>
   <tbody><tr class="row_1 row_gray">
       <td>
         05.00 - 06.00
       </td><td class="event"><a href="#" title="Boxing">Boxing</a>05.00 - 06.00</td><td class="event"><a href="#" title="Boxing">Boxing</a>05.00 - 06.00</td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_2">
       <td>
         06.00 - 07.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_3 row_gray">
       <td>
         07.00 - 08.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_4">
       <td>
         08.00 - 09.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_5 row_gray">
       <td>
         09.00 - 10.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_6">
       <td>
         10.00 - 11.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_7 row_gray">
       <td>
         11.00 - 12.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_8">
       <td>
         12.00 - 13.00
       </td><td></td><td></td><td></td><td></td><td class="event" rowspan="4"><a href="#" title="Boxing">Boxing</a>12.00 - 15.45</td><td class="event" rowspan="4"><a href="#" title="Boxing">Boxing</a>12.00 - 15.45</td><td></td></tr><tr class="row_9 row_gray">
       <td>
         13.00 - 14.00
       </td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_10">
       <td>
         14.00 - 15.00
       </td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_11 row_gray">
       <td>
         15.00 - 16.00
       </td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_12">
       <td>
         16.00 - 17.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_13 row_gray">
       <td>
         17.00 - 18.00
       </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr class="row_14">
       <td>
         18.00 - 19.00
       </td><td class="event"><a href="#" title="Boxing">Boxing</a>18.00 - 19.00</td><td class="event"><a href="#" title="Boxing">Boxing</a>18.00 - 19.00</td><td class="event" rowspan="2"><a href="#" title="Boxing">Boxing</a>18.00 - 20.00</td><td class="event" rowspan="2"><a href="#" title="Boxing">Boxing</a>18.00 - 20.00</td><td class="event" rowspan="2"><a href="#" title="Boxing">Boxing</a>18.00 - 20.00</td><td></td><td></td></tr><tr class="row_15 row_gray">
       <td>
         19.00 - 20.00
       </td><td></td><td></td><td></td><td></td></tr>
   </tbody>
     </table>
     <div class="timetable_small">
       <ul class="items_list"><h3>Monday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
        <ul class="items_list"><h3>Tuesday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
       <ul class="items_list"><h3>Wednesday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
        <ul class="items_list"><h3>Thrusday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
       <ul class="items_list"><h3>Friday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
       <ul class="items_list"><h3>Saturday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
        <ul class="items_list"><h3>Sunday</h3>
       <li><p><a href>Gym Fitness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cardio Fittness</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Boxing</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Yoga Pilates</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       <li><p><a href>Cycling</a></p><span class="m_31">10.00 - 20.00</span><div class="clear"></div></li>
       </ul>
      </div>
     </ul>
     </div>
      </div>
   </div>
      </div>
     </div>
     <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
   <script type="text/javascript">
     $(document).ready(function () {
         $('#horizontalTab').easyResponsiveTabs({
             type: 'default', //Types: default, vertical, accordion
             width: 'auto', //auto or any width like 600px
             fit: true   // 100% fit in a container
         });
     });
    </script>
 <div class="row trainers_middle_bottom">
   <div class="col-md-4">
       <h3 class="m_2">Our Trainers</h3>
        <div class="course_demo">
         <ul id="flexiselDemo3">
     <li><img src="images/pic4.jpg" /><div class="desc">
       <h3>Lorem Ipsum<br><span class="m_text">Spinning</span></h3>
       <p>Lorem ipsum dolor<br> sit amet, consectetuer.</p>
       <div class="coursel_list">
         <i class="heart1"> </i>
         <i class="like"> </i>
       </div>
       <div class="coursel_list1">
         <i class="twt"> </i>
         <i class="fb"> </i>
       </div>
       <div class="clear"></div>
     </div></li>
     <li><img src="images/pic5.jpg" /><div class="desc">
       <h3>Lorem Ipsum<br><span class="m_text">Kik Boxing</span></h3>
       <p>Lorem ipsum dolor<br> sit amet, consectetuer.</p>
       <div class="coursel_list">
         <i class="heart2"> </i>
         <i class="like1"> </i>
       </div>
       <div class="coursel_list1">
         <i class="twt"> </i>
         <i class="fb"> </i>
       </div>
       <div class="clear"></div>
     </div></li>
     <li><img src="images/pic4.jpg" /><div class="desc">
       <h3>Lorem Ipsum<br><span class="m_text">Spinning</span></h3>
       <p>Lorem ipsum dolor<br> sit amet, consectetuer.</p>
       <div class="coursel_list">
         <i class="heart2"> </i>
         <i class="like1"> </i>
       </div>
       <div class="coursel_list1">
         <i class="twt"> </i>
         <i class="fb"> </i>
       </div>
       <div class="clear"></div>
     </div></li>
     <li><img src="images/pic5.jpg" /><div class="desc">
       <h3>Lorem Ipsum<br><span class="m_text">Kik Boxing</span></h3>
       <p>Lorem ipsum dolor<br> sit amet, consectetuer.</p>
       <div class="coursel_list">
         <i class="heart2"> </i>
         <i class="like1"> </i>
       </div>
       <div class="coursel_list1">
         <i class="twt"> </i>
         <i class="fb"> </i>
       </div>
       <div class="clear"></div>
     </div></li>
     <li><img src="images/pic4.jpg" /><div class="desc">
       <h3>Lorem Ipsum<br><span class="m_text">Spinning</span></h3>
       <p>Lorem ipsum dolor<br> sit amet, consectetuer.</p>
       <div class="coursel_list">
         <i class="heart2"> </i>
         <i class="like1"> </i>
       </div>
       <div class="coursel_list1">
         <i class="twt"> </i>
         <i class="fb"> </i>
       </div>
       <div class="clear"></div>
     </div></li>
   </ul>
   <script type="text/javascript">
 $(window).load(function() {
   $("#flexiselDemo3").flexisel({
     visibleItems: 4,
     animationSpeed: 1000,
     autoPlay: true,
     autoPlaySpeed: 3000,
     pauseOnHover: true,
     enableResponsiveBreakpoints: true,
       responsiveBreakpoints: {
         portrait: {
           changePoint:480,
           visibleItems: 1
         },
         landscape: {
           changePoint:640,
           visibleItems: 2
         },
         tablet: {
           changePoint:768,
           visibleItems: 2
         }
       }
     });

 });
</script>
<script type="text/javascript" src="js/jquery.flexisel.js"></script>
</div>
</div>
<div class="col-md-4">
  <h3 class="m_2">Next Events</h3>
  <div class="events">
   <div class="event-top">
     <ul class="event1">
       <h4>26 April, 2014</h4>
       <img src="images/pic.jpg" alt=""/>
     </ul>
     <ul class="event1_text">
       <span class="m_5">h.12.00-h.13.00</span>
       <h4>Aerobics</h4>
       <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,. </p>
       <div class="btn2">
        <a href="#">Reservation</a>
     </div>
     </ul>
     <div class="clear"></div>
   </div>
   <div class="event-bottom">
     <ul class="event1">
       <h4>26 April, 2014</h4>
       <img src="images/pic.jpg" alt=""/>
     </ul>
     <ul class="event1_text">
       <span class="m_5">h.12.00-h.13.00</span>
       <h4>Spinning</h4>
       <p>Lorem ipsum dolor sit amet. </p>
       <div class="btn2">
        <a href="#">Reservation</a>
     </div>
     </ul>
     <div class="clear"></div>
   </div>
  </div>
  </div>
  <div class="col-md-4">
  <h3 class="m_2">From the blog</h3>
  <div class="blog_events">
   <ul class="tab-left1">
   <span class="tab1-img"><img src="images/pic7.jpg" alt=""></span>
   <div class="tab-text1">
    <p><a href="#">nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip</a></p>
    <span class="m_date">25 April, 2014</span>
   </div>
   <div class="clear"></div>
 </ul>
 <ul class="tab-left1">
   <span class="tab1-img"><img src="images/pic6.jpg" alt=""></span>
   <div class="tab-text1">
    <p><a href="#">soluta nobis eleifend option congue nihil imperdiet doming id</a></p>
    <span class="m_date">25 April, 2014</span>
   </div>
   <div class="clear"></div>
 </ul>
 <ul class="tab-last1">
   <span class="tab1-img"><img src="images/pic8.jpg" alt=""></span>
   <div class="tab-text1">
    <p><a href="#">quod mazim placerat facer possim assum. Typi non habent</a></p>
    <span class="m_date">25 April, 2014</span>
   </div>
   <div class="clear"></div>
 </ul>
  </div>
   </div>
   <div class="clear"></div>
  </div>
 </div>
</main>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>

<script type="text/javascript">
    var form = document.getElementById("form-notifications-filterby");
    $('.radio-button').on('click', function () {
      //return confirm(ji18n('Are you sure?'));
      if (document.getElementById("filter1").checked || document.getElementById("filter2").checked || document.getElementById("filter3").checked){
        form.submit();
      }
    });
</script>



 <script src="js/index.js"></script>

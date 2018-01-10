<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $currentuser = $view->getVariable("currentusername");
 $user_Activities = $view->getVariable("user_Activities");
 $daysOfActivities = $view->getVariable("daysOfActivities");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Reservations")?></strong><br>
    </div>
    <table id="table-content">
      <tr class="table-row-content">
        <td><strong><?= i18n("Activity")?></strong></td>
        <td class="td_ocultable"><strong><?= i18n("Schedules of activity")?></strong></td>
      <?php foreach ($user_Activities as $user_Activity): ?>
        <tr class="table-row-content"
          data-href="index.php?controller=users&amp;action=edit&amp;id=<?= $user_Activity->getId() ?>">
          <td><?= $user_Activity->getActivity()->getName() ?></td>
          <td class="td_ocultable">
            <table id="table2-content">
              <?php foreach ($daysOfActivities as $daysOfActivity): ?>
                <?php if($user_Activity->getActivity()->getIdactivity()==$daysOfActivity["id_activity"]): ?>
                  <tr class="table-row-content">
                    <td><?= i18n($daysOfActivity["nameofday"]) ?></td>
                    <td><?= i18n("of") ?> <?= date('H:i' ,strtotime($daysOfActivity["start_hour"])) ?></td>
                    <td><?= i18n("to") ?> <?= date('H:i' ,strtotime($daysOfActivity["end_hour"])) ?></td>
                  </tr>
                <?php endif ?>
            <?php endforeach ?>
            </table>
          </td>
          <td><a href="index.php?controller=activities&amp;action=view&amp;idactivity=<?= $user_Activity->getActivity()->getIdactivity() ?>">
                  <img src="resources/icons/ic_visibility_black_24px.svg" alt="View" /></a>
          </td>
          <td><a class="confirmation" href="index.php?controller=user_activity&amp;action=deleteFromReservations&amp;id_activity=<?= $user_Activity->getActivity()->getIdactivity() ?>">
            <img src="resources/icons/delete_icon.svg" alt="Delete"/></a>
          </td>
        </tr>
      <?php endforeach; ?>
  </table>
  </div>
</main>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>

 <script src="js/index.js"></script>

<!--
SELECT distinct daysActivity.nameofday, daysActivity.start_hour, daysActivity.end_hour FROM
(SELECT DAYNAME(A_S.date) as nameofday, A_S.* FROM `activity_schedule` A_s WHERE id_activity=1
 and date >= NOW()
 ORDER BY `date` ASC  ) daysActivity
-->

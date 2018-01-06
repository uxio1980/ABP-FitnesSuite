<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $activities = $view->getVariable("activities");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Activities")?></strong><br>
      <a href="index.php?controller=activities&amp;action=add"><input type='button' value=<?= i18n("New")?> /></a>
    </div>
    <table id="table-content">
      <tr class="table-row-content">
        <td><strong><?= i18n("Name")?></strong></td>
        <td><strong><?= i18n("View")?></strong></td>
        <td><strong><?= i18n("Edit")?></strong></td>
        <td><strong><?= i18n("Resources")?></strong></td>
        <td><strong><?= i18n("Schedules")?></strong></td>
        <td><strong><?= i18n("Notify")?></strong></td>
        <td><strong><?= i18n("Delete")?></strong></td>
      <?php foreach ($activities as $activity): ?>
        <tr class="table-row-content"
          data-href="index.php?controller=activities&amp;action=edit&amp;idactivity=<?= $activity->getIdactivity() ?>">
          <td id="id_row" class="ocultable"><span class="field_id"><?= $activity->getIdactivity() ?></span></td>
          <td><span class="field_name"><?= $activity->getName() ?></span></td>
          <td><a href="index.php?controller=activities&amp;action=view&amp;idactivity=<?= $activity->getIdactivity() ?>">
            <img src="resources/icons/ic_visibility_black_24px.svg" alt="View" /></a>
          </td>
          <td><a href="index.php?controller=activities&amp;action=edit&amp;idactivity=<?= $activity->getIdactivity() ?>">
            <img src="resources/icons/edit_icon.svg" alt="Edit" /></a>
          </td>
          <td><a href="index.php?controller=activity_resources&amp;action=index&amp;idactivity=<?= $activity->getIdactivity() ?>">
            <img src="resources/icons/manage_res.svg" alt="Resources" /></a>
          </td>
          <td><a href="index.php?controller=activity_schedule&amp;action=index&amp;idactivity=<?= $activity->getIdactivity() ?>">
            <img src="resources/icons/ic_schedule_24px.svg" alt="Schedules" /></a>
          </td>
          <td class="notify"><a href="index.php?controller=notification&amp;action=addByGroup&amp;idactivity=<?= $activity->getIdactivity() ?>">
            <img src="resources/icons/ic_add_notification_24px.svg" alt="Notify" /></a>
          </td>
          <td><a class="confirmation" href="index.php?controller=activities&amp;action=delete&amp;idactivity=<?= $activity->getIdactivity() ?>">
            <img src="resources/icons/delete_icon.svg" alt="Delete"/></a>
          </td>
        </tr>
      <?php endforeach; ?>
  </table>
  </div>
</main>

<script type="text/javascript">
  //Función para envíar mensaje a un grupo de usuarios
  /*
  $('.notify').on('click', function () {
    var message =  prompt(ji18n('Please enter your message to notify at group')+":","");
    var id_activity, name_activity;
    if (message == null || message == "") {
      window.location.href = "index.php?controller=activities&action=index";
    } else {
      txt = "Mensaje: " + message;
      //var id_activity = document.getElementById("id_row").innerText;
      //var id_activity = $(this).closest('tr').index();
      $(this).closest('tr').find('span').each(function(){
        if ($(this).attr("class")=="field_id") id_activity= ($(this).text());//id_activity = $(this).innerHTML;
        if ($(this).attr("class")=="field_name") name_activity= ($(this).text());//id_activity = $(this).innerHTML;
      });
      window.location.href = "index.php?controller=notification&action=addByGroup&activity=" + id_activity ;
    };
    var form = document.createElement('form');
    form.setAttribute('method', 'POST');
    form.setAttribute('action', 'index.php?controller=notification&action=addByGroup');
    form.style.display = 'hidden';
    var input = document.createElement("input");
    input.type = "text";
    input.name = "id_activity";
    input.value = id_activity;
    form.appendChild(input);
    var input2 = document.createElement("input");
    input2.type = "text";
    input2.name = "name_activity";
    input2.value = name_activity;
    form.appendChild(input2);
    var input3 = document.createElement("input");
    input3.type = "text";
    input3.name = "message";
    input3.value = message;
    form.appendChild(input3);
            alert(">>");
    document.body.appendChild(form);
    form.submit();
  });*/

  //Función para confirmar borrado
    $('.confirmation').on('click', function () {
        return confirm(ji18n('Are you sure?'));
    });
</script>

 <script src="js/index.js"></script>

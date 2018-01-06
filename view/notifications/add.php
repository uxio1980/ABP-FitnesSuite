<?php
//file: view/sessions/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$notification = $view->getVariable("add_notification");
$currentUserName = $view->getVariable("currentusername");
$notification_users = $view->getVariable("notification_users");
$users = $view->getVariable("users");
$errors = $view->getVariable("errors");

$view->setVariable("title", i18n("Add notification"));

?>
<main id="main-content">
  <div class="form">
    <form id="form-add-notification_user" action="index.php?controller=notification&amp;action=add" method="POST" enctype="multipart/form-data">
    <strong><?= i18n("Add notification") ?></strong>
    <input type="hidden" name="id_notification" value="<?= $notification->getId() ?>"/>

    <label for="login-field"><?= i18n("Author")?></label>
    <span class="field"> <?= $currentUserName ?></span>
    <?= isset($errors["author"])?$errors["author"]:"" ?>

    <label for="login-field"><?= i18n("Expiration")?></label>
    <?php $date = date("Y-m-d\TH:i",strtotime($notification->getDate())); ?>
    <?php $currentDate = date_create(date("Y-m-d"));
      date_time_set($currentDate, date("H")+1, date("i"));
      $currentDate = date_format($currentDate,"Y-m-d\TH:i");
      ?>
    <input id="ndate" type="datetime-local" name="date" value="<?= ($notification->getDate())?$date:$currentDate ?>" required/>
    <?= isset($errors["date"])?$errors["date"]:"" ?>

    <label for="login-field"><?=i18n("Title")?></label>
    <input id="ntitle" type="text" name="title" required="true" value="<?= $notification->getTitle() ?>"/>
    <?= isset($errors["title"])?$errors["title"]:"" ?><br>

    <label for="name-field"><?= i18n("Content") ?></label>
    <textarea id="ncontent" name="content" rows="4" cols="50" required><?=$notification->getContent() ?></textarea>
    <?= isset($errors["content"])?$errors["content"]:"" ?><br>

  </form>
  <table id="table-content">
    <tr class="table-row-content">
      <td>
        <strong><?= i18n("Receivers")?>
          <!-- Trigger/Open The Modal -->
          <div id="BtnModalForm" class="OnBtnModalForm">
            <!--a href="index.php?controller=notifications_user&amp;action=add&amp;id_notification= < ?= $notification->getId() ?>"> -->
              <img class="image-edit" src="resources/icons/ic_users_add.svg" alt="Add" />
            <!--</a> -->
          </div>
          <?php include(__DIR__."/modalAddForm.php");?>
          </strong>
      </td>
      <td><strong><?= i18n("Delete")?></strong></td>
      <?php if ($notification_users != NULL): ?>
      <?php foreach ($notification_users as $temporal_user): ?>
        <tr class="table-row-content">
          <td><?= $temporal_user->getSurname() ?>, <?= $temporal_user->getName()?></td>
          <td><a class="confirmation" href="index.php?controller=notifications_user&amp;action=deletetemporaluser&amp;id_user=<?= $temporal_user->getId()?>">
            <img src="resources/icons/delete_icon.svg" alt="Delete"/></a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif ?>
    </table>
    <input type="submit" name="submit" form="form-add-notification_user" value="<?= i18n("Add") ?>"/>
</div>

</main>
<script>
  $('div.OnBtnModalForm').click(function(){
    var titulo = document.getElementById("ntitle").value;
    var fechaExp = document.getElementById("ndate").value;
    var contenido = document.getElementById("ncontent").value;
    createCookie("NotificationTitulo",titulo,"10");
    createCookie("NotificationFechaExp",fechaExp,"10");
    createCookie("NotificationContenido",contenido,"10");
    //var toret = "< ?php
    //$_SESSION['NotificationValues'] ="d";
    //echo 'Desde php, Titulo: ' . $notification->getTitle() . '> ' . $_SESSION['NotificationValues'];
    //?>";
    //alert(toret);
  });
  function createCookie(name, value, days){
    var expires;
    if (days){
      var date = new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      expires = "; expires=" + date.toGMTString();
    }else{
      expires = "";
    }
    document.cookie = escape(name)+ "=" + escape(value) + expires + "; path=/";
  }
</script>
<script src="js/index.js"></script>

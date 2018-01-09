<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $articles = $view->getVariable("articles");
$filterby = $view->getVariable("filterby");
 $currentuser = $view->getVariable("currentusername");
 $users = $view->getVariable("allusers");
 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <div id="content-list">
    <div class="content-title">
      <strong><?= i18n("Users")?></strong><br>
      <a href="index.php?controller=users&amp;action=register"><input type='button' value=<?= i18n("New")?> /></a>
    </div>
      <div class="filter-box-notifications">
          <form id="form-notifications-filterby" action="index.php?controller=users&amp;action=index" method="POST">
              <input id="filter2" class="radio-button" type="radio" name="filterby" value="all" <?= ($filterby == 'all') ? "checked='checked'" : "";?>><?= i18n("All")?>
              <input id="filter1" class="radio-button" type="radio" name="filterby" value="pending" <?= ($filterby == 'pending') ? "checked='checked'" : "";?>><?= i18n("Pending")?>
              <input id="filter3" class="radio-button" type="radio" name="filterby" value="athlets" <?= ($filterby == 'athlets') ? "checked='checked'" : "";?>><?= i18n("Athlets")?>
              <input id="filter4" class="radio-button" type="radio" name="filterby" value="trainers" <?= ($filterby == 'trainers') ? "checked='checked'" : "";?>><?= i18n("Trainers")?>
          </form>
      </div>
    <table id="table-content">
      <tr class="table-row-content">
        <td></td>
          <td><strong><?= i18n("User type")?></strong></td>
        <td><strong><?= i18n("Login")?></strong></td>
        <td><strong><?= i18n("Name")?></strong></td>
        <!--<td><strong><?= i18n("Surname")?></strong></td>-->
        <td><strong><?= i18n("Email")?></strong></td>
        <td><strong><?= i18n("Phone")?></strong></td>

      <?php foreach ($users as $user): ?>
        <tr class="table-row-content"
          data-href="index.php?controller=users&amp;action=edit&amp;login=<?= $user->getLogin() ?>">
            <td>
              <?php if ($user->getProfileImage() != NULL): ?>
                <?php $ruta="resources/profiles/". $user->getProfileImage()?>
              <?php else: ?>
                <?php $ruta="resources/profiles/profile-default.png"?>
              <?php endif ?>
              <div class="container-user-circle">
                <div class="circle kitten" style="background-image: url('<?=$ruta?>');">
                  <div class="aligner">
                    <!-- text inside the icon -->
                  </div>
                </div>
              </div>
            </td>
            <td><?= i18n(usertype::getName($user->getUser_type()))?></td>
          <td><?= $user->getLogin() ?></td>
          <td><?= $user->getName() ?></td>
          <!--<td><?= $user->getSurname() ?></td>-->
          <td><?= $user->getEmail() ?></td>
          <td><?= $user->getPhone() ?></td>
          <td><a href="index.php?controller=users&amp;action=edit&amp;login=<?= $user->getLogin() ?>">
            <img src="resources/icons/edit_icon.svg" alt="Edit" /></a>
          </td>
          <td><a class="confirmation" href="index.php?controller=users&amp;action=delete&amp;login=<?= $user->getLogin() ?>">
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
<script type="text/javascript">
    var form = document.getElementById("form-notifications-filterby");
    $('.radio-button').on('click', function () {
        //return confirm(ji18n('Are you sure?'));
        if (document.getElementById("filter1").checked || document.getElementById("filter2").checked ||
            document.getElementById("filter3").checked ||  document.getElementById("filter4").checked){
            form.submit();
        }
    });
</script>



<script src="js/index.js"></script>

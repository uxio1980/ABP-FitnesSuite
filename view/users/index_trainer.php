<?php
//file: view/articles/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$articles = $view->getVariable("articles");
$currentuser = $view->getVariable("currentusername");
$users = $view->getVariable("allusers");
$view->setVariable("title", "FitnesSuite");
$filterby = $view->getVariable("filterby");

?>
<main id="main-content">
    <div id="content-list">
        <div class="content-title">
            <strong><?= i18n("Athlets")?></strong><br>
        </div>
        <div class="filter-box-notifications">
            <form id="form-notifications-filterby" action="index.php?controller=users&amp;action=index" method="POST">
                <input id="filter1" class="radio-button" type="radio" name="filterby" value="all" <?= ($filterby == 'all') ? "checked='checked'" : "";?>><?= i18n("All Athlets")?>
                <input id="filter2" class="radio-button" type="radio" name="filterby" value="myathlets" <?= ($filterby == 'myathlets') ? "checked='checked'" : "";?>><?= i18n("My Athlets")?>
                <input id="filter3" class="radio-button" type="radio" name="filterby" value="athletsTDU" <?= ($filterby == 'athletsTDU') ? "checked='checked'" : "";?>><?= i18n("TDU Athlets")?>
            </form>

        </div>
        <table id="table-content">
            <tr class="table-row-content">
                <td><strong><?= i18n("Login")?></strong></td>
                <td><strong><?= i18n("Name")?></strong></td>
                <td><strong><?= i18n("Surname")?></strong></td>
                <td><strong><?= i18n("Email")?></strong></td>
                <td><strong><?= i18n("Phone")?></strong></td>
                <td><strong><?= i18n("Asign Table")?></strong></td>
                <td><strong><?= i18n("View Tables")?></strong></td>
                <?php foreach ($users as $user): ?>
            <tr class="table-row-content"
                data-href="index.php?controller=users&amp;action=edit&amp;login=<?= $user->getLogin() ?>">
                <td><?= $user->getLogin() ?></td>
                <td><?= $user->getName() ?></td>
                <td><?= $user->getSurname() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getPhone() ?></td>
                <td><a href="index.php?controller=user_tables&amp;action=add&amp;login=<?= $user->getId() ?>">
                        <img src="resources/icons/ic_exercices_table.png" alt="Add table" /></a>
                </td>
                <td><a href="index.php?controller=user_tables&amp;action=index&amp;login=<?= $user->getId() ?>">
                        <img src="resources/icons/ic_visibility_black_24px.svg" alt="View Table"/></a>
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
            document.getElementById("filter3").checked){
            form.submit();
        }
    });
</script>

<script src="js/index.js"></script>
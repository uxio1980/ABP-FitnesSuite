<?php
//file: view/articles/index.php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$activity = $view->getVariable("activity");
$users = $view->getVariable("users");
$schedule = $view->getVariable("schedule");
$assistance = $view->getVariable("assist");
$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
    <div id="content-list">
        <div class="content-title">
            <strong><?= i18n("Assistance this week: ")?><?= $activity->getName() ?></strong><br>
        </div>
        <table id="table-content">
            <tr class="table-row-content">
                <td><strong><?= i18n("Athlets")?></strong></td>
                <?php foreach ($schedule as $day): ?>
                <td><strong><?= $day->getDate() ?></strong></td>
                <?php endforeach; ?>
                <?php foreach ($users as $user): ?>
            <tr class="table-row-content"
                data-href="index.php?controller=activities&amp;action=edit&amp;idactivity="<?= $activity->getIdactivity() ?>">

                <td><span class="field_name"><?= $user->getName() ?></span></td>

                <?php foreach ($schedule as $day): ?>
                <td>
                    <?php foreach ($assistance as $assist): ?>
                        <?php if($assist->getIduser() == $user->getId() && $assist->getDate() == $day->getDate()): ?>

                            <?php if($assist->getAssist() == 1): ?>
                                <a class="confirmation" href="index.php?controller=assistance&amp;action=delete&amp;id=<?= $assist->getIdassist() ?>">
                                <img src="resources/icons/ic_check_box.svg" alt="Assist" />
                                </a>
                            <?php else: ?>
                            <form id="form-notifications-filterby" action="index.php?controller=assistance&amp;action=save" method="POST">
                                <input type="hidden" name="id" value="<?= $assist->getIdassist() ?>"/>
                                <input type="hidden" name="idUserAct" value="<?= $assist->getIduserAct() ?>"/>
                                <input type="hidden" name="date" value="<?= $assist->getDate() ?>"/>
                                <button type="submit">
                                <img src="resources/icons/ic_check_box_outline.svg" alt="Assist" />
                                </button>
                            </form>
                            <?php endif ?>

                        <?php endif ?>
                    <?php endforeach; ?>
                </td>
                <?php endforeach; ?>
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
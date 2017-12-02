<?php
// file: view/layouts/notification_select_element.php
?>
<p class="commercial-textbox-index commercial-description red-color">
	<?= $numberOfNotifications?> <?php if ($numberOfNotifications > 1): ?>
		<?= i18n("new notifications")?>
	<?php else: ?>
		<?= i18n("new notification")?>
	<?php endif;?>
</p>
<ul class="nav-container">
	<?php foreach ($notifications as $notification_CurrentUser): ?>
		<li class="nav-item">
			<a href="index.php?controller=notification&amp;action=view&amp;id_notification=<?= $notification_CurrentUser->getNotification()->getId() ?>">
				<img src="resources/icons/ic_notifications_black_24px.svg" alt="Notification icon"/>
				<div class="text-item"><?= $notification_CurrentUser->getNotification()->getTitle();?></div></a>
			</li>
		<?php endforeach; ?>
	</ul>

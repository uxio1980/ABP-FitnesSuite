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
	<?php foreach ($default_notifications_user as $nCurrentUser): ?>
		<li class="nav-item">
			<a href="index.php?controller=notifications_user&amp;action=view&amp;id_notification_user=<?= $nCurrentUser->getId() ?>">
				<img src="resources/icons/ic_notifications_black_24px.svg" alt="Notification icon"/>
				<?php if (strlen($nCurrentUser->getNotification()->getTitle())>35): ?>
					<?php $content=substr($nCurrentUser->getNotification()->getTitle(),0,35). "..."; ?>
					<?php else:?>
						<?php $content = $nCurrentUser->getNotification()->getTitle(); ?>
						<?php endif ?>
				<div class="text-item"><?= $content;?></div></a>
			</li>
		<?php endforeach; ?>
	</ul>

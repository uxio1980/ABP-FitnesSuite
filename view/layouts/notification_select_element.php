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
			<li class="nav-item">
				<a href="">
					<img src="resources/icons/ic_notifications_black_24px.svg" alt="Notification icon"/>
					<div class="text-item">Notificacion 1</div></a>
				</li>
		</ul>

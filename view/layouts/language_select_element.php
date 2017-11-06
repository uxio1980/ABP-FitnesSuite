<?php
// file: view/layouts/language_select_element.php
?>
		<ul class="nav-container">
			<li class="nav-item">
				<a href="index.php?controller=language&amp;action=change&amp;lang=es">
					<img src="resources/icons/spain_24px.svg" alt="Spain icon"/>
					<div class="text-item"><?= i18n("Spanish") ?></div></a>
				</li>
			<li class="nav-item">
				<a href="index.php?controller=language&amp;action=change&amp;lang=en">
				<img src="resources/icons/uk_24px.svg" alt="United Kingdom icon"/>
				<div class="text-item"><?= i18n("English") ?></div></a>
			</li>
		</ul>

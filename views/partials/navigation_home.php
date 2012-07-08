<h2 class="content_title"><img src="<?= $modules_assets ?>{APP_URL}_32.png"> {APP_NAME}</h2>
<ul class="content_navigation">
	<?= navigation_list_btn('home/{APP_URL}', 'Recent') ?>
	<?= navigation_list_btn('home/{APP_URL}/custom', 'Custom') ?>
	<?php if ($logged_user_level_id <= 2) echo navigation_list_btn('home/{APP_URL}/manage', 'Manage', $this->uri->segment(4)) ?>
</ul>
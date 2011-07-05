<form name="settings_update" id="settings_update" method="post" action="<?= base_url() ?>api/settings/modify" enctype="multipart/form-data">
<div class="content_wrap_inner">

	<div class="content_inner_top_right">
		<h3>App</h3>
		<p><?= form_dropdown('enabled', config_item('enable_disable'), $settings['app-template']['enabled']) ?></p>
		<p><a href="<?= base_url() ?>api/<?= $this_module ?>/uninstall" id="app_uninstall" class="button_delete">Uninstall</a></p>
	</div>
	
	<h3>Permissions</h3>

	<p>Create
	<?= form_dropdown('create_permission', config_item('users_levels'), $settings['app-template']['create_permission']) ?>
	</p>

	<p>Publish
	<?= form_dropdown('publish_permission', config_item('users_levels'), $settings['app-template']['publish_permission']) ?>	
	</p>

	<p>Manage All
	<?= form_dropdown('manage_permission', config_item('users_levels'), $settings['app-template']['manage_permission']) ?>	
	</p>
		
</div>

<span class="item_separator"></span>

<div class="content_wrap_inner">	

	<h3>Display</h3>
	
	<p>Date
	<?= form_dropdown('date_style', config_item('date_style_types'), $settings['app-template']['date_style']) ?>
	</p>

</div>

<span class="item_separator"></span>

<div class="content_wrap_inner">
			
	<h3>Comments</h3>	

	<p>Allow
	<?= form_dropdown('module_allow', config_item('yes_or_no'), $settings['app-template']['comments_allow']) ?>
	</p>

	<p>Comments Per-Page
	<?= form_dropdown('module_per_page', config_item('amount_increments_five'), $settings['app-template']['comments_per_page']) ?>
	</p>

	<input type="hidden" name="module" value="<?= $this_module ?>">

	<p><input type="submit" name="save" value="Save" /></p>

</div>
</form>

<?= $shared_ajax ?>
<?php

/**
 * Provide an admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.fredericgilles.net/fg-joomla-to-wordpress/
 * @since      2.0.0
 *
 * @package    FG_Joomla_to_WordPress_Premium
 * @subpackage FG_Joomla_to_WordPress_Premium/admin/partials
 */
?>
<div id="fgj2wp_admin_page" class="wrap">
	<?php screen_icon(); ?>
	<h2><?php print $data['title'] ?></h2>
	
	<p><?php print $data['description'] ?></p>
	
	<div id="fgj2wp_database_info">
		<h3><?php _e('WordPress database', 'fgj2wp') ?></h3>
		<?php foreach ( $data['database_info'] as $data_row ): ?>
			<?php print $data_row; ?><br />
		<?php endforeach; ?>
	</div>
	
	<form id="form_empty_wordpress_content" method="post">
		<?php wp_nonce_field( 'empty', 'fgj2wp_nonce' ); ?>
		
		<table class="form-table">
			<tr>
				<th scope="row"><?php _e('If you want to restart the import from scratch, you must empty the WordPress content with the button hereafter.', 'fgj2wp'); ?></th>
				<td><input type="radio" name="empty_action" id="empty_action_newposts" value="newposts" /> <label for="empty_action_newposts"><?php _e('Remove only new imported posts', 'fgj2wp'); ?></label><br />
				<input type="radio" name="empty_action" id="empty_action_all" value="all" /> <label for="empty_action_all"><?php _e('Remove all WordPress content', 'fgj2wp'); ?></label><br />
				<?php submit_button( __('Empty WordPress content', 'fgj2wp'), 'primary', 'empty' ); ?></td>
			</tr>
		</table>
	</form>
	
	<form id="form_import" method="post">

		<?php wp_nonce_field( 'parameters_form', 'fgj2wp_nonce' ); ?>

		<table class="form-table">
			<tr>
				<th scope="row"><?php _e('Automatic removal:', 'fgj2wp'); ?></th>
				<td><input id="automatic_empty" name="automatic_empty" type="checkbox" value="1" <?php checked($data['automatic_empty'], 1); ?> /> <label for="automatic_empty" ><?php _e('Automatically remove all the WordPress content before each import', 'fgj2wp'); ?></label></td>
			</tr>
			<tr>
				<th scope="row" colspan="2"><h3><?php _e('Joomla web site parameters', 'fgj2wp'); ?></h3></th>
			</tr>
			<tr>
				<th scope="row"><label for="url"><?php _e('URL of the live Joomla web site', 'fgj2wp'); ?></label></th>
				<td><input id="url" name="url" type="text" size="50" value="<?php echo $data['url']; ?>" /></td>
			</tr>
			<tr>
				<th scope="row" colspan="2"><h3><?php _e('Joomla database parameters', 'fgj2wp'); ?></h3></th>
			</tr>
			<tr>
				<th scope="row"><label for="hostname"><?php _e('Hostname', 'fgj2wp'); ?></label></th>
				<td><input id="hostname" name="hostname" type="text" size="50" value="<?php echo $data['hostname']; ?>" /></td>
			</tr>
			<tr>
				<th scope="row"><label for="port"><?php _e('Port', 'fgj2wp'); ?></label></th>
				<td><input id="port" name="port" type="text" size="50" value="<?php echo $data['port']; ?>" /></td>
			</tr>
			<tr>
				<th scope="row"><label for="database"><?php _e('Database', 'fgj2wp'); ?></label></th>
				<td><input id="database" name="database" type="text" size="50" value="<?php echo $data['database']; ?>" /></td>
			</tr>
			<tr>
				<th scope="row"><label for="username"><?php _e('Username', 'fgj2wp'); ?></label></th>
				<td><input id="username" name="username" type="text" size="50" value="<?php echo $data['username']; ?>" /></td>
			</tr>
			<tr>
				<th scope="row"><label for="password"><?php _e('Password', 'fgj2wp'); ?></label></th>
				<td><input id="password" name="password" type="password" size="50" value="<?php echo $data['password']; ?>" /></td>
			</tr>
			<tr>
				<th scope="row"><label for="prefix"><?php _e('Joomla Table Prefix', 'fgj2wp'); ?></label></th>
				<td><input id="prefix" name="prefix" type="text" size="50" value="<?php echo $data['prefix']; ?>" /></td>
			</tr>
			<tr>
				<th scope="row">&nbsp;</th>
				<td><?php submit_button( __('Test the connection', 'fgj2wp'), 'secondary', 'test' ); ?></td>
			</tr>
			<tr>
				<th scope="row" colspan="2"><h3><?php _e('Behavior', 'fgj2wp'); ?></h3></th>
			</tr>
			<tr>
				<th scope="row"><?php _e('Import introtext:', 'fgj2wp'); ?></th>
				<td>
					<input id="introtext_in_excerpt" name="introtext" type="radio" value="in_excerpt" <?php checked($data['introtext'], 'in_excerpt'); ?> /> <label for="introtext_in_excerpt" title="<?php _e("The text before the «Read more» split will be imported into the excerpt.", 'fgj2wp'); ?>"><?php _e('to the excerpt', 'fgj2wp'); ?></label>&nbsp;&nbsp;
					<input id="introtext_in_content" name="introtext" type="radio" value="in_content" <?php checked($data['introtext'], 'in_content'); ?> /> <label for="introtext_in_content" title="<?php _e("The text before the «Read more» split will be imported into the post content with a «read more» link.", 'fgj2wp'); ?>"><?php _e('to the content', 'fgj2wp'); ?></label>&nbsp;&nbsp;
					<input id="introtext_in_excerpt_and_content" name="introtext" type="radio" value="in_excerpt_and_content" <?php checked($data['introtext'], 'in_excerpt_and_content'); ?> /> <label for="introtext_in_excerpt_and_content" title="<?php _e("The text before the «Read more» split will be imported into both the excerpt and the post content.", 'fgj2wp'); ?>"><?php _e('to both', 'fgj2wp'); ?></label>
				</td>
			<tr>
				<th scope="row"><?php _e('Archived posts:', 'fgj2wp'); ?></th>
				<td>
					<input id="archived_posts_not_imported" name="archived_posts" type="radio" value="not_imported" <?php checked($data['archived_posts'], 'not_imported'); ?> /> <label for="archived_posts_not_imported" title="<?php _e("Do not import archived posts", 'fgj2wp'); ?>"><?php _e('Not imported', 'fgj2wp'); ?></label>&nbsp;&nbsp;
					<input id="archived_posts_drafts" name="archived_posts" type="radio" value="drafts" <?php checked($data['archived_posts'], 'drafts'); ?> /> <label for="archived_posts_drafts" title="<?php _e("Import archived posts as drafts", 'fgj2wp'); ?>"><?php _e('Import as drafts', 'fgj2wp'); ?></label>&nbsp;&nbsp;
					<input id="archived_posts_published" name="archived_posts" type="radio" value="published" <?php checked($data['archived_posts'], 'published'); ?> /> <label for="archived_posts_published" title="<?php _e("Import archived posts as published posts", 'fgj2wp'); ?>"><?php _e('Import as published posts', 'fgj2wp'); ?></label>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Medias:', 'fgj2wp'); ?></th>
				<td><input id="skip_media" name="skip_media" type="checkbox" value="1" <?php checked($data['skip_media'], 1); ?> /> <label for="skip_media" ><?php _e('Skip media', 'fgj2wp'); ?></label>
				<br />
				<div id="media_import_box">
					<?php _e('Import first image:', 'fgj2wp'); ?>&nbsp;
					<input id="first_image_as_is" name="first_image" type="radio" value="as_is" <?php checked($data['first_image'], 'as_is'); ?> /> <label for="first_image_as_is" title="<?php _e('The first image will be kept in the post content', 'fgj2wp'); ?>"><?php _e('as is', 'fgj2wp'); ?></label>&nbsp;&nbsp;
					<input id="first_image_as_featured" name="first_image" type="radio" value="as_featured" <?php checked($data['first_image'], 'as_featured'); ?> /> <label for="first_image_as_featured" title="<?php _e('The first image will be removed from the post content and imported as the featured image only', 'fgj2wp'); ?>"><?php _e('as featured only', 'fgj2wp'); ?></label>&nbsp;&nbsp;
					<input id="first_image_as_is_and_featured" name="first_image" type="radio" value="as_is_and_featured" <?php checked($data['first_image'], 'as_is_and_featured'); ?> /> <label for="first_image_as_is_and_featured" title="<?php _e('The first image will be kept in the post content and imported as the featured image', 'fgj2wp'); ?>"><?php _e('as is and as featured', 'fgj2wp'); ?></label>
					<br />
					<input id="import_external" name="import_external" type="checkbox" value="1" <?php checked($data['import_external'], 1); ?> /> <label for="import_external"><?php _e('Import external media', 'fgj2wp'); ?></label>
					<br />
					<input id="import_duplicates" name="import_duplicates" type="checkbox" value="1" <?php checked($data['import_duplicates'], 1); ?> /> <label for="import_duplicates" title="<?php _e('Checked: download the media with their full path in order to import media with identical names.', 'fgj2wp'); ?>"><?php _e('Import media with duplicate names', 'fgj2wp'); ?></label>
					<br />
					<input id="force_media_import" name="force_media_import" type="checkbox" value="1" <?php checked($data['force_media_import'], 1); ?> /> <label for="force_media_import" title="<?php _e('Checked: download the media even if it has already been imported. Unchecked: Download only media which were not already imported.', 'fgj2wp'); ?>" ><?php _e('Force media import. Keep unchecked except if you had previously some media download issues.', 'fgj2wp'); ?></label>
					<br />
					<?php _e('Timeout for each media:', 'fgj2wp'); ?>&nbsp;
					<input id="timeout" name="timeout" type="text" size="5" value="<?php echo $data['timeout']; ?>" /> <?php _e('seconds', 'fgj2wp'); ?>
				</div></td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Meta keywords:', 'fgj2wp'); ?></th>
				<td><input id="meta_keywords_in_tags" name="meta_keywords_in_tags" type="checkbox" value="1" <?php checked($data['meta_keywords_in_tags'], 1); ?> /> <label for="meta_keywords_in_tags" ><?php _e('Import meta keywords as tags', 'fgj2wp'); ?></label></td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Create pages:', 'fgj2wp'); ?></th>
				<td><input id="import_as_pages" name="import_as_pages" type="checkbox" value="1" <?php checked($data['import_as_pages'], 1); ?> /> <label for="import_as_pages" ><?php _e('Import as pages instead of blog posts (without categories)', 'fgj2wp'); ?></label></td>
			</tr>
			<tr>
				<th scope="row"><?php _e('SEO:', 'fgj2wpp'); ?></th>
				<td>
					<input id="import_meta_seo" name="import_meta_seo" type="checkbox" value="1" <?php checked($data['import_meta_seo'], 1); ?> /> <label for="import_meta_seo" ><?php _e('Import the meta description and the meta keywords to WordPress SEO by Yoast', 'fgj2wpp'); ?></label>
					<br />
					<input id="get_metadata_from_menu" name="get_metadata_from_menu" type="checkbox" value="1" <?php checked($data['get_metadata_from_menu'], 1); ?> /> <label for="get_metadata_from_menu" ><?php _e('Set the meta data from menus instead of articles', 'fgj2wpp'); ?></label>
					<br />
					<input id="get_slug_from_menu" name="get_slug_from_menu" type="checkbox" value="1" <?php checked($data['get_slug_from_menu'], 1); ?> /> <label for="get_slug_from_menu" ><?php _e('Set the post slugs from menus instead of aliases', 'fgj2wpp'); ?></label>
					<br />
					<input id="keep_joomla_id" name="keep_joomla_id" type="checkbox" value="1" <?php checked($data['keep_joomla_id'], 1); ?> /> <label for="keep_joomla_id" ><?php _e('Keep the Joomla articles IDs', 'fgj2wpp'); ?></label>
					<br />
					<input id="url_redirect" name="url_redirect" type="checkbox" value="1" <?php checked($data['url_redirect'], 1); ?> /> <label for="url_redirect" ><?php _e("Redirect the Joomla URLs", 'fgj2wpp'); ?></label>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Partial import:', 'fgj2wpp'); ?></th>
				<td>
					<div id="partial_import_toggle"><?php _e('expand / collapse', 'fgj2wpp'); ?></div>
					<div id="partial_import">
					<input id="skip_categories" name="skip_categories" type="checkbox" value="1" <?php checked($data['skip_categories'], 1); ?> /> <label for="skip_categories" ><?php _e('Don\'t import the categories', 'fgj2wpp'); ?></label>
					<br />
					<input id="skip_articles" name="skip_articles" type="checkbox" value="1" <?php checked($data['skip_articles'], 1); ?> /> <label for="skip_articles" ><?php _e('Don\'t import the articles', 'fgj2wpp'); ?></label>
					<br />
					<input id="skip_weblinks" name="skip_weblinks" type="checkbox" value="1" <?php checked($data['skip_weblinks'], 1); ?> /> <label for="skip_weblinks" ><?php _e('Don\'t import the web links', 'fgj2wpp'); ?></label>
					<br />
					<input id="skip_users" name="skip_users" type="checkbox" value="1" <?php checked($data['skip_users'], 1); ?> /> <label for="skip_users" ><?php _e('Don\'t import the users', 'fgj2wpp'); ?></label>
					<br />
					<input id="skip_menus" name="skip_menus" type="checkbox" value="1" <?php checked($data['skip_menus'], 1); ?> /> <label for="skip_menus" ><?php _e('Don\'t import the menus', 'fgj2wpp'); ?></label>
					<br />
					<input id="skip_modules" name="skip_modules" type="checkbox" value="1" <?php checked($data['skip_modules'], 1); ?> /> <label for="skip_modules" ><?php _e('Don\'t import the modules', 'fgj2wpp'); ?></label>
					<?php do_action('fgj2wp_post_display_partial_import_options', $data); ?>
					</div>
				</td>
			</tr>
			
			<?php do_action('fgj2wp_post_display_behavior_options'); ?>
			<tr>
				<th scope="row">&nbsp;</th>
				<td><?php submit_button( __('Save settings', 'fgj2wp'), 'secondary', 'save' ); ?>
				<?php submit_button( __('Import content from Joomla to WordPress', 'fgj2wp'), 'primary', 'import' ); ?></td>
			</tr>
		</table>
	</form>
	
	<table class="form-table">
		<tr>
			<th scope="row" colspan="2"><h3><?php _e('After the migration', 'fgj2wp'); ?></h3></th>
		</tr>
		<tr>
			<th scope="row"><?php _e('During the migration, prefixes have been added to the categories slugs to avoid categories duplicates. This button will remove these prefixes which are useless after the migration.', 'fgj2wp'); ?></th>
			<td>
				<form id="form_remove_cat" method="post">
					<?php wp_nonce_field( 'remove_cat_prefix', 'fgj2wp_nonce' ); ?>
					<?php submit_button( __('Remove the prefixes from the categories', 'fgj2wp'), 'primary', 'remove_cat_prefix' ); ?>
				</form>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('If you have links between articles, you need to modify internal links.', 'fgj2wp'); ?></th>
			<td>
				<form id="form_modify_links" method="post">
					<?php wp_nonce_field( 'modify_links', 'fgj2wp_nonce' ); ?>
					<?php submit_button( __('Modify internal links', 'fgj2wp'), 'primary', 'modify_links' ); ?>
				</form>
			</td>
		</tr>
	</table>
		
	
	<p><?php _e('If you found this plugin useful and it saved you many hours or days, please rate it on <a href="http://wordpress.org/extend/plugins/fg-joomla-to-wordpress/">FG Joomla to WordPress</a>. You can also make a donation using the button below.', 'fgj2wp'); ?></p>
	
	<div id="fgj2wp_paypal_donate" class="center">
		<form id="form_paypal_donate" action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
			">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
		</form>
	</div>
	
</div>

<?php

/**
 * New/Edit Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<?php 
    //$user_ID = get_current_user_id();
	//echo 'role forum:', bbp_get_user_role($user_ID);  
?>
<?php if ( bbp_is_forum_edit() ) : ?>

<div id="bbpress-forums">

	<?php bbp_breadcrumb(); ?>

	<?php bbp_single_forum_description( array( 'forum_id' => bbp_get_forum_id() ) ); ?>

<?php endif; ?>

<?php if ( bbp_current_user_can_access_create_forum_form() ) : ?>

	<div id="new-forum-<?php bbp_forum_id(); ?>" class="bbp-forum-form">

		<form id="new-post" name="new-post" method="post" action="<?php the_permalink(); ?>">

			<?php do_action( 'bbp_theme_before_forum_form' ); ?>

			<fieldset class="bbp-form">
				<legend>

					<?php
						if ( bbp_is_forum_edit() )
							printf( __( 'Now Editing &ldquo;%s&rdquo;', 'bbpress' ), bbp_get_forum_title() );
						else
							bbp_is_single_forum() ? printf( __( 'Create New Forum in &ldquo;%s&rdquo;', 'bbpress' ), bbp_get_forum_title() ) : _e( 'Create New Forum', 'bbpress' );
					?>

				</legend>

				<?php do_action( 'bbp_theme_before_forum_form_notices' ); ?>

				<?php if ( !bbp_is_forum_edit() && bbp_is_forum_closed() ) : ?>

					<div class="bbp-template-notice">
						<p><?php _e( 'This forum is closed to new content, however your account still allows you to do so.', 'bbpress' ); ?></p>
					</div>

				<?php endif; ?>

				<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>

					<div class="bbp-template-notice">
						<p><?php _e( 'Your account has the ability to post unrestricted HTML content.', 'bbpress' ); ?></p>
					</div>

				<?php endif; ?>

				<?php do_action( 'bbp_template_notices' ); ?>

				<div>

					<?php do_action( 'bbp_theme_before_forum_form_title' ); ?>

					<p>
						<label for="bbp_forum_title"><?php printf( __( 'Forum Name (Maximum Length: %d):', 'bbpress' ), bbp_get_title_max_length() ); ?></label><br />
						<input type="text" id="bbp_forum_title" value="<?php bbp_form_forum_title(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_forum_title" maxlength="<?php bbp_title_max_length(); ?>" />
					</p>

					<?php do_action( 'bbp_theme_after_forum_form_title' ); ?>

					<?php do_action( 'bbp_theme_before_forum_form_content' ); ?>

					<?php bbp_the_content( array( 'context' => 'forum' ) ); ?>

					<?php do_action( 'bbp_theme_after_forum_form_content' ); ?>

					<?php if ( ! ( bbp_use_wp_editor() || current_user_can( 'unfiltered_html' ) ) ) : ?>

						<p class="form-allowed-tags">
							<label><?php _e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:','bbpress' ); ?></label><br />
							<code><?php bbp_allowed_tags(); ?></code>
						</p>

					<?php endif; ?>

					<?php do_action( 'bbp_theme_before_forum_form_type' ); ?>

					<?php do_action( 'bbp_theme_after_forum_form_type' ); ?>

					<?php do_action( 'bbp_theme_before_forum_form_status' ); ?>



					<?php do_action( 'bbp_theme_after_forum_form_status' ); ?>

					<?php do_action( 'bbp_theme_before_forum_form_status' ); ?>

					<!-- Remplacé les champs de saisie par des champs cachés pré remplis -->
					<input type="hidden" name="bbp_forum_type"       value="forum"  >					
					<input type="hidden" name="bbp_forum_status"     value="open"   >				
					<input type="hidden" name="bbp_forum_visibility" value="publish">
					<input type="hidden" name="bbp_forum_parent_id"  value="960"    >

					<?php do_action( 'bbp_theme_after_forum_visibility_status' ); ?>

					<?php do_action( 'bbp_theme_before_forum_form_parent' ); ?>

					<input type="hidden" name="bbp_forum_parent_id" value="960">

					<?php do_action( 'bbp_theme_after_forum_form_parent' ); ?>

					<?php do_action( 'bbp_theme_before_forum_form_submit_wrapper' ); ?>

					<div class="bbp-submit-wrapper">

						<?php do_action( 'bbp_theme_before_forum_form_submit_button' ); ?>

						<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_forum_submit" name="bbp_forum_submit" class="button submit"><?php _e( 'Submit', 'bbpress' ); ?></button>

						<?php do_action( 'bbp_theme_after_forum_form_submit_button' ); ?>

					</div>

					<?php do_action( 'bbp_theme_after_forum_form_submit_wrapper' ); ?>

				</div>

				<?php bbp_forum_form_fields(); ?>

			</fieldset>

			<?php do_action( 'bbp_theme_after_forum_form' ); ?>

		</form>
	</div>

<?php elseif ( bbp_is_forum_closed() ) : ?>

	<div id="no-forum-<?php bbp_forum_id(); ?>" class="bbp-no-forum">
		<div class="bbp-template-notice">
			<p><?php printf( __( 'The forum &#8216;%s&#8217; is closed to new content.', 'bbpress' ), bbp_get_forum_title() ); ?></p>
		</div>
	</div>

<?php else : ?>

	<div id="no-forum-<?php bbp_forum_id(); ?>" class="bbp-no-forum">
		<div class="bbp-template-notice">
			<p><?php is_user_logged_in() ? _e( 'You cannot create new forums.', 'bbpress' ) : _e( 'You must be logged in to create new forums.', 'bbpress' ); ?></p>
		</div>
	</div>

<?php endif; ?>

<?php if ( bbp_is_forum_edit() ) : ?>

</div>

<?php endif; ?>

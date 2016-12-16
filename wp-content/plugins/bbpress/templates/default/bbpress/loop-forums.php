<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

 
if (!function_exists('isMobile')) { 
	// Create the function, so you can use it
	function isMobile() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	} 
}
 
?>

<?php do_action( 'bbp_template_before_forums_loop' ); ?>

<ul id="forums-list-<?php bbp_forum_id(); ?>" class="bbp-forums">

	<li class="bbp-header">

		<ul class="forum-titles">
			<?php if(!isMobile()): ?> 
				<li class="bbp-forum-info">
					<?php _e( 'Forums', 'bbpress' ); ?>
				</li>
				<li class="bbp-forum-topic-count">
					<?php _e( 'Sujets', 'bbpress' ); ?>
				</li>			
				<li class="bbp-forum-reply-count">
			        <?php bbp_show_lead_topic() ? _e( 'Réponses', 'bbpress' ) : _e( 'Contributions', 'bbpress' ); ?>
				</li>
				<li class="bbp-forum-freshness">
					<?php _e( 'Activité récente', 'bbpress' ); ?>
				</li>
			<?php else: ?>
				Forums | Sujets | Contributions | Activité<br>
			<?php endif; ?> 
				
		</ul>

	</li><!-- .bbp-header -->

	<li class="bbp-body">

		<?php while ( bbp_forums() ) : bbp_the_forum(); ?>

			<?php bbp_get_template_part( 'loop', 'single-forum' ); ?>

		<?php endwhile; ?>

	</li><!-- .bbp-body -->

	<li class="bbp-footer">

		<div class="tr">
			<p class="td colspan4">&nbsp;</p>
		</div><!-- .tr -->

	</li><!-- .bbp-footer -->

</ul><!-- .forums-directory -->

<?php do_action( 'bbp_template_after_forums_loop' ); ?>

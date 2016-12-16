<?php

/**
 * Topics Loop
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

<?php do_action( 'bbp_template_before_topics_loop' ); ?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" class="bbp-topics">

	<li class="bbp-header">
		<!--
		<ul class="forum-titles">
			<li class="bbp-topic-title"><?php _e( 'Topic', 'bbpress' ); ?></li>
			<li class="bbp-topic-voice-count"><?php _e( 'Voices', 'bbpress' ); ?></li>
			<li class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></li>
			<li class="bbp-topic-freshness"><?php _e( 'Freshness', 'bbpress' ); ?></li>
		</ul>
        -->
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
		
		
		
	</li>

	<li class="bbp-body">

		<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>

	</li>

	<li class="bbp-footer">

		<div class="tr">
			<p>
				<span class="td colspan<?php echo ( bbp_is_user_home() && ( bbp_is_favorites() || bbp_is_subscriptions() ) ) ? '5' : '4'; ?>">&nbsp;</span>
			</p>
		</div><!-- .tr -->

	</li>

</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

<?php do_action( 'bbp_template_after_topics_loop' ); ?>

<?php

/**
 * Redirect module
 *
 * @link       http://www.fredericgilles.net/fg-joomla-to-wordpress/
 * @since      2.0.0
 *
 * @package    FG_Joomla_to_WordPress_Premium
 * @subpackage FG_Joomla_to_WordPress_Premium/public
 */

if ( !class_exists('FG_Joomla_to_WordPress_Redirect', false) ) {

	/**
	 * Redirect class
	 *
	 * @package    FG_Joomla_to_WordPress_Premium
	 * @subpackage FG_Joomla_to_WordPress_Premium/public
	 * @author     Frédéric GILLES
	 */
	class FG_Joomla_to_WordPress_Redirect {

		const REDIRECT_TABLE = 'fg_redirect';
		private static $canonical_url = '';
		
		/**
		 * Plugin installation
		 */
		static function install() {
			self::create_table_wp();
		}
		
		/**
		 * Create the necessary table
		 */
		private static function create_table_wp() {
			global $wpdb;
			$table_name = $wpdb->prefix . self::REDIRECT_TABLE;
			if ( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {
				$sql = "
				CREATE TABLE " . $table_name . " (
				  `old_url` varchar(255) NOT NULL,
				  `id` bigint(20) unsigned NOT NULL,
				  `type` varchar(20) NOT NULL,
				  `activated` tinyint(1) NOT NULL,
				  PRIMARY KEY (`old_url`)
				) DEFAULT CHARSET=utf8;
				";
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql);
			}
		}
		
		/**
		 * Empty the redirects table
		 * 
		 * @param string $action	newposts = removes only new imported posts
		 * 							all = removes all
		 */
		public static function empty_redirects($action) {
			global $wpdb;
			$table_name = $wpdb->prefix . self::REDIRECT_TABLE;
			if ( $action == 'all' ) {
				$wpdb->query("TRUNCATE $table_name");
			}
		}

		/**
		 * Process the URL
		 *
		 */
		public static function process_url() {
			global $wp;
			$url = urldecode($wp->request);
			$redirect = self::get_redirect($url);
			if ( isset($redirect->type)  && isset($redirect->id) ) {
				switch ( $redirect->type ) {
					case 'post':
					case 'page':
					case 'product':
						self::process_post_url($redirect->id);
						break;
					case 'category':
					case 'product_cat':
						self::process_category_url($redirect->id, $redirect->type);
						break;
				}
			}
		}
		
		/**
		 * Process the post URL
		 *
		 * @param int $post_id Post ID
		 */
		public static function process_post_url($post_id) {
			global $wp;
			if ( !empty($post_id) ) {
				
				$sef_options = get_option('fgj2wp_sef_options');
				$permalink = get_permalink($post_id);
				
				if ( $sef_options['sef_redirect'] == 'keep_url' ) {
					// Keep the URL and load the post
					$post = get_post($post_id);
					if ( !empty($post) ) {
						unset($wp->query_vars['category_name']);
						unset($wp->query_vars['attachment']);
						switch ( $post->post_type ) {
							case 'page':
								$wp->query_vars['pagename'] = $post->post_name;
								$wp->query_vars['name'] = '';
								break;
							case 'product':
							case 'post':
							default:
								$wp->query_vars['name'] = $post->post_name;
								break;
						}
					}
					// Add a canonical link to avoid duplicate content
					self::add_canonical_tag($permalink);
				} else {
					// Redirect
					self::redirect($permalink);
				}
			}
		}
		
		/**
		 * Process the category URL
		 *
		 * @param int $term_id Term ID
		 * @param string $taxonomy Taxonomy (category, product_cat, …)
		 */
		public static function process_category_url($term_id, $taxonomy) {
			global $wp;
			if ( !empty($term_id) ) {
				$term_id = intval($term_id);
				
				$sef_options = get_option('fgj2wp_sef_options');
				$permalink = get_term_link($term_id, $taxonomy);
				
				if ( $sef_options['sef_redirect'] == 'keep_url' ) {
					// Keep the URL and load the category page
					$term = get_term($term_id, $taxonomy);
					unset($wp->query_vars['name']);
					unset($wp->query_vars['attachment']);
					switch ( $taxonomy ) {
						case 'category': $wp->query_vars['category_name'] = $term->slug; break;
						case 'product_cat': $wp->query_vars['product_cat'] = $term->slug; break;
					}
					// Add a canonical link to avoid duplicate content
					self::add_canonical_tag($permalink);
				} else {
					// Redirect
					self::redirect($permalink);
				}
			}
		}
		
		/**
		 * Add a canonical tag to avoid duplicate content
		 * 
		 * @param string $permalink
		 */
		private static function add_canonical_tag($permalink) {
			if ( !empty($permalink) ) {
				self::$canonical_url = $permalink;
				add_action('wp_head', array(__CLASS__, 'add_canonical'));
			}
		}
		
		/**
		 * Redirect to the permalink
		 * 
		 * @param string $permalink
		 */
		private static function redirect($permalink) {
			if ( !empty($permalink) && !is_wp_error($permalink) ) {
				$protocol = (isset($_SERVER['REQUEST_SCHEME']) && !empty($protocol))? $_SERVER['REQUEST_SCHEME']: 'http';
				$host = $_SERVER['HTTP_HOST'];
				$url = $_SERVER['REQUEST_URI'];
				$current_url = "{$protocol}://{$host}{$url}"; // to avoid endless loop
				if ( $permalink != $current_url ) {
					wp_redirect($permalink, 301);
					exit;
				}
			}
		}
		
		/**
		 * Add a redirect in the database
		 *
		 * @param string $old_url
		 * @param int $id
		 * @param string $type
		 */
		public static function add_redirect($old_url, $id, $type) {
			global $wpdb;
			$table_name = $wpdb->prefix . self::REDIRECT_TABLE;
			$wpdb->query($wpdb->prepare("
				INSERT IGNORE INTO $table_name
				(`old_url`, `id`, `type`, `activated`)
				VALUES (%s, %d, '%s', 1)
			", $old_url, $id, $type));
		}
		
		/**
		 * Get the Post ID from the redirect URL
		 *
		 * @param string $url
		 * @result array (Post ID, post type)
		 */
		private static function get_redirect($url) {
			global $wpdb;
			$table_name = $wpdb->prefix . self::REDIRECT_TABLE;
			$sql = "
				SELECT id, type
				FROM $table_name
				WHERE old_url IN (\"$url\", \"$url/\", \"/$url\", \"/$url/\")
				AND activated = 1";
			$result = $wpdb->get_row($sql);
			return $result;
		}
		
		/**
		 * Add a canonical meta tag
		 *
		 */
		public static function add_canonical() {
			echo '<link rel="canonical" href="' . self::$canonical_url . '" />' . "\n";
		}
	}
}

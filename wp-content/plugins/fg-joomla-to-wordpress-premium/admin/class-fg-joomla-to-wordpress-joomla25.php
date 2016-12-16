<?php

/**
 * Joomla 2.5
 *
 * @link       http://www.fredericgilles.net/fg-joomla-to-wordpress/
 * @since      2.0.0
 *
 * @package    FG_Joomla_to_WordPress_Premium
 * @subpackage FG_Joomla_to_WordPress_Premium/admin
 */

if ( !class_exists('FG_Joomla_to_WordPress_Joomla25', false) ) {

	/**
	 * Joomla 2.5 features
	 *
	 * @package    FG_Joomla_to_WordPress_Premium
	 * @subpackage FG_Joomla_to_WordPress_Premium/admin
	 * @author     Frédéric GILLES
	 */
	class FG_Joomla_to_WordPress_Joomla25 {

		/**
		 * Initialize the class and set its properties.
		 *
		 * @since    2.0.0
		 * @param    object    $plugin       Admin plugin
		 */
		public function __construct( $plugin ) {

			$this->plugin = $plugin;

		}

		/**
		 * Add images col in the get_posts request (for Joomla 1.0)
		 *
		 * @param string $cols
		 * @return string Cols separating by commas (with a comma at start)
		 */
		public function add_images_col_in_get_posts($cols) {
			if ( version_compare($this->plugin->plugin_options['version'], '2.5', '>=') ) {
				$cols .= ', p.images';
			}
			return $cols;
		}

		/**
		 * Process featured image (for Joomla 2.5)
		 *
		 * @param array $post Post
		 * @return array Post
		 */
		public function process_featured_image($post) {
			if ( version_compare($this->plugin->plugin_options['version'], '2.5', '>=') && !$this->plugin->plugin_options['skip_media'] ) {
				$image_data = $this->decode_image_field($post['images']);
				
				// Attribs
				$post_attribs = $this->plugin->convert_post_attribs_to_array($post['attribs']);
				
				/* If intro_text is included in the extract
				 *  => the intro image goes into the intro text
				 *     and the full text image goes into the full text
				 * Else (intro_text is included in the content)
				 *  => Either the full text image or the intro image goes into the intro text
				 */
				$show_intro = (is_array($post_attribs) && array_key_exists('show_intro', $post_attribs))? $post_attribs['show_intro'] : '';
				if ( (($this->plugin->plugin_options['introtext'] == 'in_excerpt') && ($show_intro !== '1'))
					|| (($this->plugin->plugin_options['introtext'] == 'in_excerpt_and_content') && ($show_intro == '0')) ) {
					$post['introtext'] = $this->image_tag('intro', $image_data) . $post['introtext'];
					$post['fulltext'] = $this->image_tag('fulltext', $image_data) . $post['fulltext'];
				} else {
					if ( !empty($image_data['image_fulltext']) ) {
						$post['introtext'] = $this->image_tag('fulltext', $image_data) . $post['introtext'];
					} else {
						$post['introtext'] = $this->image_tag('intro', $image_data) . $post['introtext'];
					}
				}
			}
			return $post;
		}
		
		/**
		 * Decode the image field (for Joomla 2.5)
		 *
		 * @param string $string Image field
		 * @return array Image data
		 */
		private function decode_image_field($string) {
			$matches = array();
			$string = preg_replace("/{(.*)}/", "$1", $string);
			$fields = explode(',', $string);
			$image_data = array();
			foreach ($fields as $field) {
				if ( preg_match('/"(.*)":"(.*)"/', $field, $matches) ) {
					$key = $matches[1];
					$value = $matches[2];
					$image_data[$key] = stripslashes($value);
				}
			}
			return $image_data;
		}
		
		/**
		 * Build the <img> tag
		 *
		 * @param string $location (intro | fulltext)
		 * @param array $image_data Image data
		 * @return string Image tag
		 */
		private function image_tag($location, $image_data) {
			$image_tag = '';
			$src = array_key_exists('image_' . $location, $image_data)? $image_data['image_' . $location] : '';
			$float = array_key_exists('float_' . $location, $image_data)? $image_data['float_' . $location] : '';
			$alt = array_key_exists('image_' . $location . '_alt', $image_data)? esc_attr($image_data['image_' . $location . '_alt']) : '';
			$caption_field = 'image_' . $location . '_caption';
			$caption = array_key_exists($caption_field, $image_data) && !empty($image_data[$caption_field])? ' class="caption" title="' . esc_attr($image_data[$caption_field]) . '"' : '';
			$alignment = !empty($float)? ' align="' . $float . '"' : '';
			if ( !empty($src) ) {
				$image_tag = '<img src="' . $src . '" alt="'. $alt . '"' . $caption . $alignment . ' />';
			}
			
			return $image_tag;
		}
		
	}
}

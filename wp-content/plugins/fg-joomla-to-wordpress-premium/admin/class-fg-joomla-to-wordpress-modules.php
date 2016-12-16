<?php

/**
 * Custom modules module
 *
 * @link       http://www.fredericgilles.net/fg-joomla-to-wordpress/
 * @since      2.0.0
 *
 * @package    FG_Joomla_to_WordPress_Premium
 * @subpackage FG_Joomla_to_WordPress_Premium/admin
 */

if ( !class_exists('FG_Joomla_to_WordPress_Modules', false) ) {

	/**
	 * Custom modules class
	 *
	 * @package    FG_Joomla_to_WordPress_Premium
	 * @subpackage FG_Joomla_to_WordPress_Premium/admin
	 * @author     Frédéric GILLES
	 */
	class FG_Joomla_to_WordPress_Modules {

		private $modules_count = 0;

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
		 * Import the Joomla custom modules
		 * 
		 */
		public function import_modules() {
			if ( isset($this->plugin->premium_options['skip_modules']) && $this->plugin->premium_options['skip_modules'] ) {
				return;
			}
			
			do_action('fgj2wp_pre_import_modules');
			
			$text_widget = new WP_Widget('text', 'Text');
			$widget_settings = $text_widget->get_settings();
			$text_widgets_count = count($widget_settings) + 2; // start at 2
			
			$modules = $this->get_modules();
			foreach ( $modules as $module ) {
				$widget_settings = $this->add_module($module, $text_widget, $widget_settings, $text_widgets_count++);
			}
		}
		
		/**
		 * Add a module
		 *
		 * @param array $module module
		 * @param WP_Widget $text_widget Text widget instance
		 * @param array $widget_settings Current widget settings
		 * @param int $id_widget ID of the widget
		 * @return array $widget_settings New widget settings
		 */
		private function add_module($module, $text_widget, $widget_settings, $id_widget) {
			$content = $module['content'];
			
			// Process the media
			if ( !$this->plugin->plugin_options['skip_media'] ) {
				$module_date = ($module['checked_out_time'] != '0000-00-00 00:00:00')? $module['checked_out_time']: date('Y-m-d H:i:s');
				$result = $this->plugin->import_media_from_content($content, $module_date);
				$post_media = $result['media'];
				$content = $this->plugin->process_content($content, $post_media);
				$content = stripslashes($content);
			}

			// Update the widget_text option
			$widget_settings[$id_widget] = array(
				'title'		=> $module['title'],
				'text'		=> $content,
				'filter'	=> false,
			);
			$text_widget->save_settings($widget_settings);
			
			// Update the sidebars_widgets option
			$sidebars_widgets = get_option('sidebars_widgets');
			$sidebars_widgets['wp_inactive_widgets'][] = 'text-' . $id_widget;
			update_option('sidebars_widgets', $sidebars_widgets);
			
			$this->modules_count++;
			
			// Increment the Joomla last imported module ID
			update_option('fgj2wp_last_module_id', $module['id']);
			
			return $widget_settings;
		}
		
		/**
		 * Reset the stored last module id when emptying the database
		 * 
		 */
		public function reset_last_module_id() {
			update_option('fgj2wp_last_module_id', 0);
			
			// Delete all existing text widgets
			update_option('widget_text', array());
			
			// Delete the inactive widgets
			$sidebars_widgets = get_option('sidebars_widgets');
			$sidebars_widgets['wp_inactive_widgets'] = array();
			update_option('sidebars_widgets', $sidebars_widgets);
		}
		
		/**
		 * Get all the Joomla modules
		 * 
		 */
		protected function get_modules() {
			$modules = array();
			
			$last_module_id = (int)get_option('fgj2wp_last_module_id'); // to restore the import where it left
			$prefix = $this->plugin->plugin_options['prefix'];
			$sql = "
				SELECT id, title, content, checked_out_time
				FROM ${prefix}modules
				WHERE published = 1
				AND `module` = 'mod_custom'
				AND id > '$last_module_id'
				ORDER BY id
			";
			$modules = $this->plugin->joomla_query($sql);
			return $modules;
		}
		
		/**
		 * Display the number of imported modules
		 * 
		 */
		public function display_modules_count() {
			if ( isset($this->plugin->premium_options['skip_modules']) && $this->plugin->premium_options['skip_modules'] ) {
				return;
			}
			
			$this->plugin->display_admin_notice(sprintf(_n('%d module imported', '%d modules imported', $this->modules_count, $this->plugin->get_plugin_name()), $this->modules_count));
		}

	}
}

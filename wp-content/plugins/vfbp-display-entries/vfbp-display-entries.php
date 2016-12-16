<?php
/*
Plugin Name:	VFB Pro - Display Entries
Plugin URI:		http://vfbpro.com
Description:	An add-on for VFB Pro that displays entries on the front-end.
Version:		2.0.2
Author:			Matthew Muro
Author URI:		http://matthewmuro.com
Text Domain:	vfbp-display-entries
Domain Path:	/lang/
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) )
	exit;

class VFB_Pro_Addon_Display_Entries {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    2.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name = 'vfbp-display-entries';

	/**
	 * The current version of the plugin.
	 *
	 * @since    2.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version = '2.0.2';

	/**
	 * The main instanace of VFB_Pro_Addon_Display_Entries
	 *
	 * @since	2.0
	 * @var 	mixed
	 * @access 	private
	 * @static
	 */
	private static $instance = null;

	/**
     * Protected constructor to prevent creating a new instance of VFB_Pro_Addon_Display_Entries
     * via the 'new' operator from outside of this class.
     *
     * @return void
     */
	protected function __construct() {
	}

	/**
     * Private clone method to prevent cloning of the instance.
     *
     * @return void
     */
    private function __clone() {
    }

    /**
     * Private unserialize method to prevent unserializing of the instance.
     *
     * @return void
     */
    private function __wakeup() {
    }

	/**
	 * Create a single VFB Pro - Create User instance
	 *
	 * Insures that only one instance of VFB Pro Create User is running.
	 * Otherwise known as the Singleton class pattern
	 *
	 * @since    3.0
	 * @access   public
	 * @static
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new VFB_Pro_Addon_Display_Entries;
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->autoload_classes();

			// Load i18n
			add_action( 'plugins_loaded', array( self::$instance, 'lang' ) );
		}

		return self::$instance;
	}

	/**
	 * Setup constants
	 *
	 * @since 3.0
	 * @access private
	 * @return void
	 */
	private function setup_constants() {
		global $wpdb;

		// Plugin version
		if ( !defined( 'VFB_DISPLAY_ENTRIES_PLUGIN_VERSION' ) )
			define( 'VFB_DISPLAY_ENTRIES_PLUGIN_VERSION', $this->version );

		// Plugin version
		if ( !defined( 'VFB_DISPLAY_ENTRIES_PLUGIN_VERSION' ) )
			define( 'VFB_DISPLAY_ENTRIES_PLUGIN_VERSION', $this->version );

		// Plugin Folder Path
		if ( !defined( 'VFB_DISPLAY_ENTRIES_PLUGIN_DIR' ) )
			define( 'VFB_DISPLAY_ENTRIES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL
		if ( !defined( 'VFB_DISPLAY_ENTRIES_PLUGIN_URL' ) )
			define( 'VFB_DISPLAY_ENTRIES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File
		if ( !defined( 'VFB_DISPLAY_ENTRIES_PLUGIN_FILE' ) )
			define( 'VFB_DISPLAY_ENTRIES_PLUGIN_FILE', __FILE__ );
	}

	/**
	 * Include files
	 *
	 * @since 2.0
	 * @access private
	 * @return void
	 */
	private function includes() {
		require_once( VFB_DISPLAY_ENTRIES_PLUGIN_DIR . 'inc/class-i18n.php' );				// VFB_Pro_Addon_Display_Entries_i18n class
		require_once( VFB_DISPLAY_ENTRIES_PLUGIN_DIR . 'inc/class-plugin-updater.php' );	// VFB_Pro_Addon_Display_Entries_Plugin_Updater class
		require_once( VFB_DISPLAY_ENTRIES_PLUGIN_DIR . 'public/class-display-entries.php' );		// VFB_Pro_Addon_Display_Entries_Main class
		require_once( VFB_DISPLAY_ENTRIES_PLUGIN_DIR . 'public/class-load-css-js.php' );		// VFB_Pro_Addon_Display_Entries_Scripts_Loader class
		require_once( VFB_DISPLAY_ENTRIES_PLUGIN_DIR . 'admin/class-admin-settings.php' );	// VFB_Pro_Addon_Display_Entries_Admin_Settings class
	}

	/**
	 * Load localization file
	 *
	 * @since 3.0
	 * @access public
	 * @return void
	 */
	public function lang() {
		$i18n = new VFB_Pro_Addon_Display_Entries_i18n();
		$i18n->set_domain( $this->plugin_name );

		$i18n->load_lang();
	}

	/**
	 * Autoload some VFB_Pro_Addon_Display_Entries classes that aren't loaded via other files
	 *
	 * @since 2.0
	 * @access public
	 * @return void
	 */
	public function autoload_classes() {
		if ( class_exists( 'VFB_Pro_Plugin_Updater' ) )
			$plugin_updater = new VFB_Pro_Addon_Display_Entries_Plugin_Updater();

		$main           = new VFB_Pro_Addon_Display_Entries_Main();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     2.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     2.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}

/**
 * The main function responsible for returning VFB Pro forms and functionality.
 *
 * Example: <?php $vfb = VFB(); ?>
 *
 * @since 2.7
 * @return object VFB_Pro instance
 */
function vfb_display_entries() {
	return VFB_Pro_Addon_Display_Entries::instance();
}

vfb_display_entries();
<?php
/**
 * Class that controls plugin update API
 *
 * @since 3.0
 */
if ( class_exists( 'VFB_Pro_Plugin_Updater' ) ) {
	class VFB_Pro_Addon_Payments_Plugin_Updater extends VFB_Pro_Plugin_Updater {

		/**
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
			$this->name    = plugin_basename( VFB_PAYMENTS_PLUGIN_FILE );
			$this->slug    = basename( VFB_PAYMENTS_PLUGIN_FILE, '.php');
			$this->version = VFB_PAYMENTS_PLUGIN_VERSION;

			$this->api_data['name']    = $this->name;
			$this->api_data['slug']    = $this->slug;
			$this->api_data['version'] = $this->version;
			$this->api_data['license'] = get_option( 'vfbp_license_status' );

			// Hook into the plugin update check
			add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'api_check' ) );

			// Display plugin details screen for updating
			add_filter( 'plugins_api', array( $this, 'api_info' ), 10, 3 );

			// For testing only
			//add_action( 'init', array( $this, 'delete_transient' ) );
		}
	}
}
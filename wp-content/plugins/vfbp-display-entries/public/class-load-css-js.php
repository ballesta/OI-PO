<?php
/**
 * Loads all CSS and JS files that VFB Pro needs
 *
 * This class should be called when the menu is added
 * so the CSS and JS is added to ONLY our VFB Pro pages.
 *
 * @since      3.0
 */
class VFB_Pro_Addon_Display_Entries_Scripts_Loader {

	/**
	 * Load CSS on VFB pages.
	 *
	 * @access public
	 * @return void
	 */
	public function add_css() {
		wp_enqueue_style( 'vfbp-display-entries', VFB_DISPLAY_ENTRIES_PLUGIN_URL . "public/assets/css/vfb-display-entries.min.css", array(), '2014.12.30' );
	}

	/**
	 * Load JS on VFB pages
	 *
	 * @access public
	 * @return void
	 */
	public function add_js() {
		wp_register_script( 'vfbp-display-entries', VFB_DISPLAY_ENTRIES_PLUGIN_URL . "public/assets/js/vfb-display-entries.min.js", array( 'jquery-datatables' ), '2014.12.30', true );
		wp_register_script( 'jquery-datatables', VFB_DISPLAY_ENTRIES_PLUGIN_URL . "public/assets/js/dataTables.min.js", array( 'jquery' ), '1.10.8', true );
		wp_register_script( 'jquery-datatables-bootstrap', VFB_DISPLAY_ENTRIES_PLUGIN_URL . "public/assets/js/dataTables-bootstrap.min.js", array( 'jquery-datatables' ), '1.0', true );
	}
}
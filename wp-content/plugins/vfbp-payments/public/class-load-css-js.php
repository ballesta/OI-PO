<?php
/**
 * Loads all CSS and JS files that VFB Pro needs
 *
 * This class should be called when the menu is added
 * so the CSS and JS is added to ONLY our VFB Pro pages.
 *
 * @since      3.0
 */
class VFB_Pro_Addon_Payments_Scripts_Loader {

	/**
	 * Load CSS on VFB pages.
	 *
	 * @access public
	 * @return void
	 */
	public function add_css() {
		wp_enqueue_style( 'vfbp-payments', VFB_PAYMENTS_PLUGIN_URL . "public/assets/css/vfb-payments.min.css", array(), '2015.01.16' );
	}

	/**
	 * Load JS on VFB pages
	 *
	 * @access public
	 * @return void
	 */
	public function add_js() {
		wp_register_script( 'vfbp-payments', VFB_PAYMENTS_PLUGIN_URL . "public/assets/js/vfb-payments.min.js", array( 'jquery' ), '2015.03.27', true );
	}
}
<?php

function generate_style_css() {
	ob_start(); // Capture all output (output buffering)
	require (BSP_PLUGIN_DIR . '/css/styles.php');
	$css = ob_get_clean(); // Get generated CSS (output buffering)
	file_put_contents(BSP_PLUGIN_DIR . '/css/bspstyle.css', $css, LOCK_EX ); // Save it
	wp_enqueue_style( 'bsp');
	
	
	}

function bsp_enqueue_css() {
wp_register_style('bsp', plugins_url('css/bspstyle.css',dirname(__FILE__) ), 'bbpress');
wp_enqueue_style( 'bsp');
}
add_action('wp_print_styles', 'bsp_enqueue_css');

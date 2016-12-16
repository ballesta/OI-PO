<?php
/**
 * Plugin Name: Flexible Modals
 * Plugin URI: http://www.wpsnippet.com
 * Description: A very flexible modal plugin using adaptive-modal.js. You can find the jquery version of the plugin in the following url - http://www.onextrapixel.com/2014/06/25/create-modal-windows-that-can-be-morphed-from-anything-with-jquery-adaptive-modal-js/
 * Version: 0.2
 * Author: S. Bage
 * Author URI: http://www.wpsnippet.com
 * License: GPLv2 or later
 */
  
define( 'MODALROOT', plugins_url( '', __FILE__ ) );
define( 'MODALSTYLES', MODALROOT . '/css/' );
define( 'MODALSCRIPTS', MODALROOT . '/js/' );

/*------------------------ Add necessary styles and scripts --------------------------*/

function flmodal_style_script() {
	wp_enqueue_style('flexible-modal', MODALSTYLES . 'flexible-modal.css', false, '0.1', 'all');
	wp_enqueue_script('adaptive-modal', MODALSCRIPTS . 'jquery.adaptive-modal.js', array( 'jquery'), '1.0', true);
}
add_action( 'wp_enqueue_scripts', 'flmodal_style_script' );

/*------------------------ Register FAQ post type --------------------------*/

function flmodal_custom_post_type() {
	$labels = array(
		'name'                  =>   __( 'Modals', 'flfaq' ),
		'singular_name'         =>   __( 'Modal', 'flfaq' ),
		'add_new_item'          =>   __( 'Add New Modal', 'flfaq' ),
		'all_items'             =>   __( 'All Modals', 'flfaq' ),
		'edit_item'             =>   __( 'Edit Modal', 'flfaq' ),
		'new_item'              =>   __( 'New Modal', 'flfaq' ),
		'view_item'             =>   __( 'View Modal', 'flfaq' ),
		'not_found'             =>   __( 'No Modals Found', 'flfaq' ),
		'not_found_in_trash'    =>   __( 'No Modals Found in Trash', 'flfaq' )
	);
	$args = array(
		'label'         =>   __( 'FAQ', 'flfaq' ),
		'labels'        =>   $labels,
		'description'   =>   __( 'A list of faq', 'flfaq' ),
		'public'        =>   true,
		'show_in_menu'  =>   true,
		'menu_icon'     =>   'dashicons-visibility',
		'has_archive'   =>   true,
		'rewrite'       =>   true,
		'hierarchical'	=>	 true,
		'supports'      =>   array('title', 'editor')
	);
	register_post_type( 'modal', $args );
}
add_action( 'init', 'flmodal_custom_post_type' );

/*------------------------ Custom Columns --------------------------*/

function flmodal_custom_columns_head( $defaults ) {
	unset( $defaults['date'] );
	$defaults['modal_id'] = __( 'Modal ID', 'flfaq' );
	return $defaults;
}
add_filter( 'manage_edit-modal_columns', 'flmodal_custom_columns_head', 10 );

function flmodal_custom_columns_content( $column_name ) {
    if ( 'modal_id' == $column_name ) {
    	global $post;
    	echo $post->ID;
    }
}
add_action( 'manage_modal_posts_custom_column', 'flmodal_custom_columns_content', 10, 2 );

/*------------------------ Include additional files --------------------------*/

include( 'inc/shortcodes.php' );

/*------------------------ Flush rewrite rules --------------------------*/

function flmodal_activation_callback() {
    flmodal_custom_post_type();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'flmodal_activation_callback' );
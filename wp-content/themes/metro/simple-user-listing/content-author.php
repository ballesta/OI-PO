<?php
/**
 * The Template for displaying Author listings
 *
 * Override this template by copying it to yourtheme/authors/content-author.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $user;

$user_info = get_userdata( $user->ID );
$num_posts = count_user_posts( $user->ID );
echo '<div id="user-' . $user->ID . ' class="author-block">';
echo 	get_avatar( $user->ID, 90 ); 
echo 	'<h6>';
echo    	 $user_info->display_name;
echo 	'</h6>';
echo '</div>';
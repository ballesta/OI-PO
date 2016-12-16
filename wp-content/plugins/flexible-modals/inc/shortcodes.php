<?php 
//Modal shortcode
add_shortcode( 'modal', 'flmodal_shortcode' );
function flmodal_shortcode( $atts, $content = null ) {
	ob_start();
	global $post;
	//have to add option for remote URL.
	// Put array values in variables
	extract( shortcode_atts( array ('post_type' 	=> 'post',
									'id' 			=> '', 
	                                'background' 	=> 'LightSteelBlue', 
							        'data' 			=> '', 
							        'color' 		=> 'SteelBlue'), 
			                 $atts ) );
	// Now variables $post_type, $id and others have the extracted value						 
	// Post
	// bb $args = array('post_type' => 'modal', 'posts_per_page' => 1, 'p' => $id );
	$args = array('post_type' => $post_type, 
				  'posts_per_page' => 1, 
				  'p' => $id );
	// Get posts
    $flmodal = new WP_Query( $args );
	if ( $flmodal->have_posts() ) : 
		while ($flmodal->have_posts()) : $flmodal->the_post();
		?>
			<a style="padding: 5px; 
					  display:inline-block; 
					  background: <?php echo $background ?>; 
					  color: <?php echo $color ?>; " 
			   href="#<?php echo $post->ID ?>" 
			   data-am-custom-bgcolor="<?php echo $background ?>" 
			   data-toggle="adaptive-modal">
					<?php echo $content ?>
			</a>
			<div id="<?php echo $post->ID ?>">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
		<?php 
		endwhile;
	else :
		echo "Please check your modal ID: $id";	
	endif; 
	wp_reset_query();
	$myvariable = ob_get_clean();
	return $myvariable;
}

//Block shortcode
add_shortcode( 'block', 'flblock_shortcode' );
function flblock_shortcode( $atts ) {
	ob_start();
	global $post;

	extract( shortcode_atts( array ('id' => ''), $atts ) );
	
		$args = array('post_type' => 'modal', 'posts_per_page' => 1, 'p' => $id );
		$flblock = new WP_Query( $args );
		if ( $flblock->have_posts() ) : 
			while ($flblock->have_posts()) : $flblock->the_post();
				echo '<div class"flblock">'. get_the_content() .'</div>';
			endwhile;
		else :
			echo 'Please check your modal ID';	
		endif; 
		wp_reset_query();
	
	$myvariable = ob_get_clean();
	return $myvariable;
}
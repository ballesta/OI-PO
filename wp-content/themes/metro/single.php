<?php
    OI_droits_acces::verifie_droits_acces();
    get_header(); ?>
<?php
	$post_sidebar_show=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'sidebar_show', true);
	if($post_sidebar_show == 'hide')
		$post_sidebar_show=false;
	else
		$post_sidebar_show=true;
?>
<?php if($post_sidebar_show): ?>
		<div class="block-6 no-mar content-with-sidebar">
			<div class="block-full bg-color-main">
<?php else: ?>
		<div class="block-full bg-color-main content-without-sidebar">
<?php endif;?>
	
			<div class="block-inner">
	<?php
	    //if ( current_user_can( 'edit_post', $post->ID ) )
		//    edit_post_link( __('edit', 'om_theme'), 
		//	  			   '<div class="edit-post-link">[',
		//				   ']</div>' );    
		if ( current_user_can( 'edit_post', $post->ID ) )
		{
			echo OI::modifier('/wp-admin/post.php?post=' . $post->ID . '&action=edit');
			//                 /wp-admin/post.php?post=      6972       &action=edit				 
		}				   
	?>
	
	<article>
		<div class="tbl-bottom">
			<div class="tbl-td">
				<h1 class="page-h1">
				<?php
					$format = get_post_format();
					if($format == 'quote')
						echo '&ldquo;'.get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'quote', true);
					else
						// the_title();
				?>
				</h1>
				<?php if($format == 'quote') { ?><div class="clear"></div><p class="post-title-comment" style="margin:0 0 3px 0">&mdash; <?php the_title(); ?></p><?php } ?>
			</div>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
				<?php if(function_exists('bcn_display'))
				{
					//bcn_display();
				}?>
			</div>
			<!--
			<?php if(get_option(OM_THEME_PREFIX . 'show_breadcrumbs') == 'true'): ?>
				<div class="tbl-td">
					<?php om_breadcrumbs(get_option(OM_THEME_PREFIX . 'breadcrumbs_caption')) ?>
				</div>
			<?php endif; ?>
			-->
		</div>
		<div class="clear page-h1-divider"></div>
			
	<?php if (have_posts()): ?>
		<?php echo get_option(OM_THEME_PREFIX . 'code_after_post_h1'); ?>

		<?php 
			while (have_posts()): 
				the_post();
				$format = get_post_format(); 
				if( false === $format )
					$format = 'standard';
				get_template_part( 'includes/post-type-' . $format );
				$auteur = get_field('auteur');
				if($auteur):
				    if(strpos($auteur,',')):
						echo "Auteurs: ";
					else:
						echo "Auteur: ";
					endif;	
					echo '<strong>', $auteur, '</strong>' ;
				endif;	
			endwhile; 
		?>
	<?php endif; ?>
				
<?php 
	wp_link_pages(array('before'         	=>   '<div class="navigation-pages"><span class="title">'
												.__('Pages:', 'om_theme')
												.'</span>', 
						  'after'          	=> 	'</div>', 
						  'pagelink'       	=> 	'<span class="item">%</span>', 
						  'next_or_number' 	=> 	'number')); ?>
	
	<?php echo get_option(OM_THEME_PREFIX . 'code_after_post_content'); ?>

	<?php
		if(     get_option(OM_THEME_PREFIX . 'show_prev_next_post') == 'true' 
		   && ( get_previous_post() || get_next_post() ) ) : 
	?>
		<?php // ob_start();?>
		<div class="navigation-prev-next">				
			<div class="navigation-prev-next">			 
				<div class="navigation-prev">
					<?php 
						$p = get_previous_post_link('%link',
													'%title',
													$in_same_term = false
													);
						if ($p):								
							echo $p;
							echo   '<span style="padding-left: 40px;">'
						         . 	  'Publication précédente'
							     . '</span>';
						endif;		 
					?>
				</div>
				<div class="navigation-next">
					<?php 
						$n = get_next_post_link('%link',
												'%title',
												$in_same_term = false
												);
						if ($n):								
							echo $n;
							echo   '<span style="padding-left: 12px;">'
						         . 	  'Publication suivante'
							     . '</span>';
						endif;		 
					?>					
				</div>
				<div class="clear"></div>
			</div>				
		</div>
		<?php 
			//$s0 = ob_get_contents(); 
			//$s1 = do_shortcode($s0, true);
			//echo $s1;	
		?>
		<center><a href="javascript:history.back();"><strong>Retour à liste</strong></a></center>
	<?php else: ?>
			<h2><?php _e('Error 404 - Not Found', 'om_theme') ?></h2>
			<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'om_theme') ?></p>
	<?php endif; ?>
				
	</article>
		</div>
			</div>
			<?php
				$fb_comments=false;
				if(   function_exists('om_facebook_comments') 
				   && get_option(OM_THEME_PREFIX . 'fb_comments_posts') == 'true') 
				{
						if(get_option(OM_THEME_PREFIX . 'fb_comments_position') == 'after')
							$fb_comments='after';
						else
							$fb_comments='before';
				}
			?>
			
			<?php if($fb_comments == 'before') { om_facebook_comments();	} ?>
			
			<?php if(get_option(OM_THEME_PREFIX . 'hide_comments_post') != 'true') : ?>
				<?php comments_template('',true); ?>
			<?php endif; ?>		
			
			<?php if($fb_comments == 'after') { om_facebook_comments();	} ?>
		
	<?php if($post_sidebar_show): ?>
			
		</div>
		<div class="block-3 no-mar sidebar">
			<?php
				// alternative sidebar
				$alt_sidebar=intval(get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'sidebar', true));
				if(   $alt_sidebar 
				   && $alt_sidebar <= intval(get_option(OM_THEME_PREFIX."sidebars_num"))):
					//if (   !function_exists( 'dynamic_sidebar' ) 
					//    || !dynamic_sidebar( 'alt-sidebar-'.$alt_sidebar ) ) 
					//	;
					null;
				else: 
					get_sidebar();
				endif;
			?>
		</div>
	<?php endif; ?>
		
	<!-- /Content -->
		
	<div class="clear anti-mar">&nbsp;</div>

<?php get_footer(); ?>
<?php
	// Vérifie que l'internaute est connecté pour les pages qui le demandent 
	// Récupère l'identifiant de la page
    //global $post; 
	////OI::affiche($post,'Post');
    //$page_slug=$post->post_name;
	////echo 'Nom:', $page_slug, '<hr>'; die("Page.php");
	//if (($page_slug == 'action-collective-dge')):
	//	// Page "Action collective DGE"
	//	if(!is_user_logged_in()):
	//		// Utilisateur non connecté: 
	//		//	  	lui demander de se connecter ou de s'enregistrer 
	//		// 		s'il n'a pas encore de compte chez nous
	//		wp_redirect( home_url() . '/acces-restreint' ); exit; 
	//	endif;	
	//endif;
	
	// Vérifie que l'internaute est connecté avec les bons droits 
	// pour les pages qui le demandent 
	OI_droits_acces::verifie_droits_acces();	
	get_header(); 
?>
<!--div class="block-6 no-mar content-with-sidebar"-->
<div class="block-9 no-mar ">
	<div class="block-9 bg-color-main">
		<div class="block-inner">
			<?php
				if (   is_user_logged_in()
				    && current_user_can( 'edit_post' ) ):
					edit_post_link( __(// Texte bouton
									   'Modifier', 
									   // Thème
					                   'om_theme'),
									   // Début conteneur
									   '<div class="edit-post-link">[',
									   
									   // Texte ajouté entre les deux
									   
									   // Fin conteneur
									   ']</div>' );
				endif;
			?>
			<article>
			    <!-- Le titre est affiché dans le header 
				     bb 18/02/2016
				<div class="tbl-bottom">
					<div class="tbl-td">
						<br>
						<br>
						<h1 class="page-h1"><?php the_title(); ?></h1>
					</div>

					<?php if(get_option(OM_THEME_PREFIX . 'show_breadcrumbs') == 'true') { ?>
						<div class="tbl-td">
							<?php om_breadcrumbs(get_option(OM_THEME_PREFIX . 'breadcrumbs_caption')) ?>
						</div>
					<?php } ?>
				</div>
				-->
				<div class="clear page-h1-divider"></div>
				<?php echo get_option(OM_THEME_PREFIX . 'code_after_page_h1'); ?>
				<?php while (have_posts()) : the_post(); ?>
					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						<?php the_content(); ?>
					</div>
				<?php endwhile; ?>				
				<?php echo get_option(OM_THEME_PREFIX . 'code_after_page_content'); ?>
			</article>	
		<?php wp_link_pages(array('before' => '<div class="navigation-pages"><span class="title">'.__('Pages:', 'om_theme').'</span>', 'after' => '</div>', 'pagelink' => '<span class="item">%</span>', 'next_or_number' => 'number')); ?>				
		</div>
	</div>

	<?php
		$fb_comments=false;
		if(function_exists('om_facebook_comments') && get_option(OM_THEME_PREFIX . 'fb_comments_pages') == 'true') {
				if(get_option(OM_THEME_PREFIX . 'fb_comments_position') == 'after')
					$fb_comments='after';
				else
					$fb_comments='before';
		}
	?>
	
	<?php if($fb_comments == 'before') { om_facebook_comments();	} ?>
	
	<?php if(get_option(OM_THEME_PREFIX . 'hide_comments_pages') != 'true') : ?>
		<?php comments_template('',true); ?>
	<?php endif; ?>
	
	<?php if($fb_comments == 'after') { om_facebook_comments();	} ?>

</div>

<!-- bb
<div class="block-3 no-mar sidebar">
	<?php
		// alternative sidebar
		$alt_sidebar=intval(get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'sidebar', true));
		if($alt_sidebar && $alt_sidebar <= intval(get_option(OM_THEME_PREFIX."sidebars_num")) ) {
			if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'alt-sidebar-'.$alt_sidebar ) ) ;
		} else {
			get_sidebar();
		}
		?>
</div>
-->		
<!-- /Content -->

<div class="clear anti-mar">&nbsp;</div>

<?php 
	get_footer(); 
?>
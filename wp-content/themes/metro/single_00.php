<?php
			// Voir si contenu limité aux membres
			$reserve_aux_membres = get_field('reserve_aux_membres');
		    //OI::affiche($reserve_aux_membres);
			if ($reserve_aux_membres == 1):
				// See: https://wordpress.org/support/topic/how-to-get-the-current-logged-in-users-role?replies=10
				$current_user = wp_get_current_user();
				$roles = $current_user->roles;
				//OI::affiche($roles, "Roles");
				if (count($roles) == 0) :
					// Non Connecté
					//echo '<hr><h4>Ce Contenu est réservé aux membres. Vous devez être inscrit et connecté pour le voir</h4>';
                    wp_redirect( home_url() . '/acces-restreint' ); exit; 
					$droit_acces = false;
				else:
					$droit_acces = true;
				endif;
			else:
				$droit_acces = true;				
			endif;	
?>

<?php  get_header(); ?>

<div class="block-full bg-color-main content-without-sidebar">	
	<div class="block-inner">
		<?php
			if ($droit_acces):				
				if ( current_user_can( 'edit_post', $post->ID ) )
				{
					//edit_post_link( __('edit', 'om_theme'), '<div class="edit-post-link">[', ']</div>' );
					echo OI::modifier('/wp-admin/post.php?post=' . $post->ID . '&action=edit');
					// /wp-admin/post.php?post=6972&action=edit				 
				}
		?>  		
		<article>
		<br>
		<br>
		<div class="tbl-bottom">
			<div class="tbl-td">
				<h1 class="page-h1"><?php
					the_title();
				?></h1>
			</div>
		</div>
		<div class="clear page-h1-divider"></div>
			<?php if (have_posts()) : ?>
				<?php echo get_option(OM_THEME_PREFIX . 'code_after_post_h1'); ?>
		<?php 
			while (have_posts()): 
				the_post(); 	
				$format = 'standard';
				get_template_part( 'includes/post-type-' . $format );

//-----
//------------
				$reserve_aux_membres = get_field('reserve_aux_membres');
			    //OI::affiche($reserve_aux_membres);
				if ($reserve_aux_membres == 1):
					echo '<hr><h4>Contenu réservé aux membres. Non accessible par le public</h4>'; 
				endif;	
				$auteur_inscrit_sur_le_site = get_field('auteur_inscrit_sur_le_site');
				$r = '';
				if($auteur_inscrit_sur_le_site)
				{
					//OI::affiche($auteur_inscrit_sur_le_site);
					echo '<hr>';
					$r .= ''    // [one_third]'
					   .  '<center>' 
					   .  '    Auteur (inscrit sur le site) : ' 
					   .  '   <strong>' 
					   .           $auteur_inscrit_sur_le_site[display_name] 
					   .  '   </strong>' 
					   .  '   <br>'
					   .  '   <br>'
					   .      $auteur_inscrit_sur_le_site[user_avatar] . '<br>'
					   .  '</center>' 
					   .  '<br>'
					   ;
					echo do_shortcode($r);
				}
				$auteurs_membre = get_field('auteur_membre');
				//OI::affiche($auteurs_membre,'Membre');
				$r = '';
				if($auteurs_membre)
				{
					echo '<hr>';
					$auteur_membre = $auteurs_membre[0];
					//OI::affiche($auteur_membre);
					$r .= ''    
					   .  '<center>' 
					   .  '   Auteur (Membre de l\'OI): ' 
					   .  '   <strong>' 
					   .          $auteur_membre->post_title 
					   .  '   </strong>' 
					   .  '</center>' 
					   .  '<br>'
					   ;
					echo do_shortcode($r);
				}
				// +++++
				$auteur_externe = get_field('auteur_externe');
				//OI::affiche($auteurs_membre,'Membre');
				$r = '';
				if($auteur_externe)
				{
					echo '<hr>';
					//OI::affiche($auteur_membre);
					$r .= '<center>' 
					   .  '   Auteur (Externe à l\'OI): '
					   .  '   <strong>' 
					   .           $auteur_externe 
					   .  '   </strong>'
					   .  '   <br>'
					   .  '</center>' 
					   ;
					echo do_shortcode($r);
				}
			endwhile; 				
			wp_link_pages(array('before'         => '<div class="navigation-pages"><span class="title">'.__('Pages:', 'om_theme').'</span>', 'after' => '</div>', 
			                    'pagelink'       => '<span class="item">%</span>', 
								'next_or_number' => 'number')); 
				
			echo get_option(OM_THEME_PREFIX . 'code_after_post_content'); 

			if(     get_option(OM_THEME_PREFIX . 'show_prev_next_post') == 'true' 
			   && ( get_previous_post() || get_next_post() ) ) : 
		?>
			<div class="navigation-prev-next">				
				<div class="navigation-prev-next">
					<div class="navigation-prev">
						<?php previous_post_link('%link',
						                         '%title',
												 $in_same_term = false
												 //$excluded_terms = '',
												 //$taxonomy = 'les-10-types-dai' 
												 ) 
						?>
						<span style="padding-left: 40px;">
							Publication précédente
						</span>
					</div>
					<div class="navigation-next">
						<?php next_post_link('%link','%title',false) ?>
						<span style="padding-left: 12px;">
							Publication suivante
						</span>
					</div>
					<div class="clear"></div>
				</div>				
			</div>
			<?php endif; ?>
					
			<?php else : ?>

				<h2><?php _e('Error 404 - Not Found', 'om_theme') ?></h2>
			
				<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'om_theme') ?></p>

			<?php endif; ?>
	
		</article>	
		<?php endif; // Droit acces?>
		
	</div>
</div>
		
<!-- /Content -->
		
<div class="clear anti-mar">&nbsp;</div>

<?php get_footer(); ?>
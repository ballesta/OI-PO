<?php get_header(); ?>
***Archives***
<div class="block-9 no-mar">		
	<div class="block-9 bg-color-main">
		<div class="block-inner">
			<div class="tbl-bottom">
				<div class="tbl-td">
					<h1 class="page-h1"><?php	echo om_get_archive_page_title(); ?></h1>
				<div class="clear page-h1-divider">
				</div>					
				<?php if( is_category() ) echo category_description(); ?>
	            <?php 
				if (have_posts()) : ?>
	         		<section>
	         		<?php 
					while (have_posts()) : the_post(); ?>
	         			<article>
						    <?php
								$format = 'standard';
								get_template_part( 'includes/post-type-' . $format );
						    ?>
						</article>
					<?php 
					endwhile; ?>
					</section>
					<?php
						$nav_prev=get_previous_posts_link(__('Newer Entries', 'om_theme'));
						$nav_next=get_next_posts_link(__('Older Entries', 'om_theme'));
						if( $nav_prev || $nav_next ) {
							?>
							<div class="navigation-prev-next">
								<?php if($nav_prev){?><div class="navigation-prev"><?php echo $nav_prev; ?></div><?php } ?>
								<?php if($nav_next){?><div class="navigation-next"><?php echo $nav_next; ?></div><?php } ?>
								<div class="clear"></div>
							</div>
							<?php
						}		
					?>
				<?php 
				else : 
					echo '<h2>';
					if ( is_category() ) {
						printf(__('Sorry, but there aren\'t any posts in the %s category yet.', 'om_theme'), single_cat_title('',false));
					} elseif ( is_tag() ) { 
						printf(__('Sorry, but there aren\'t any posts tagged %s yet.', 'om_theme'), single_tag_title('',false));
					} elseif ( is_date() ) { 
						echo(__('Sorry, but there aren\'t any posts with this date.', 'om_theme'));
					} else {
						echo(__('No posts found.', 'om_theme'));
					}
					echo '</h2>';

				 endif; ?>		
				</div> 
			</div>
		</div>
	</div>	
</div>	
<!-- /Content -->		
<div class="clear anti-mar">&nbsp;</div>		
<?php get_footer(); ?>
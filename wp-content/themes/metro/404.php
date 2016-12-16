<?php
//wp_redirect( home_url() . "/connexion-ou-inscription?original-page=$page_slug" ); exit; 
get_header(); ?>
		<div class="block-9 no-mar content-without-sidebar">
			<div class="block-9 bg-color-main block-inner">
					<div class="tbl-bottom">
						<div class="tbl-td">
						<h1>Tentative d'accès à une page inexistante</h1>
							<h1 class="page-h1"><?php _e('Error 404 - Not Found', 'om_theme') ?></h1>
						</div>
					</div>
					<div class="clear page-h1-divider"></div>
					<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'om_theme') ?></p>
					<p>&nbsp;</p>
			</div>			
		</div>
		<!-- /Content -->
		<div class="clear anti-mar">&nbsp;</div>	
<?php get_footer(); ?>
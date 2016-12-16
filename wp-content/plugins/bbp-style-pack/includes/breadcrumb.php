<?php

//breadcrumb settings page

function bsp_breadcrumb_settings() {
 ?>
			
						<table class="form-table">
					
					<tr valign="top">
						<th colspan="2">
						
						<h3>
						<?php _e ('Breadcrumbs' , 'asc' ) ; ?>
						</h3>


						
<?php echo '<img src="' . plugins_url( 'images/breadcrumb.JPG',dirname(__FILE__)  ) . '"  > '; ?>
	
<p>
<?php _e('Breadcrumbs are shown to allow users to track back and forth, clicking the links to jump to each area.', 'bbp-style-pack'); ?>
</p>
<p/>
<p>
<?php _e('If your theme provides breadcrumbs you may want to disable them, or you may simply not wish to show them.', 'bbp-style-pack'); ?>
</p>
<p/>
<p>
<?php _e('If you do show them, you may wish not to show all the links, or to change what the text says.', 'bbp-style-pack'); ?>
</p>
<p/>
<p>
<?php _e("The home breadcrumb link will take you to your theme's 'front page' as set in wordpress.", 'bbp-style-pack'); ?>
</p>
<p/>
<p>
<?php _e('The root breadcrumb will take you to either : ', 'bbp-style-pack'); ?> 
</p>
<p>
<?php _e('a) The forum root as set in Dashboard>Settings>forums>Forum Root Slug>Forum Root', 'bbp-style-pack'); ?> 
<p>
<?php _e('or', 'bbp-style-pack'); ?> 
</p>
<p>
<?php _e('b) to a page with a shortcode if you have set this up.  To do this create a page in wordpress and include the shortcode [bbp-forum-index] (or other bbpress shortcode). ', 'bbp-style-pack'); ?> 
</p>
<p>
<?php _e('Then either see what the permalink is for that page or set it to what you want (just under the title when editing), and put that exact end permalink into the forum root in', 'bbp-style-pack'); ?> 
</P>
<p>
<?php _e('Dashboard>Settings>forums>Forum Root Slug>Forum Root', 'bbp-style-pack'); ?> 
 

<p>
<?php _e('The following settings let you control the breadcrumbs.', 'bbp-style-pack'); ?> 

<?php 
global $bsp_breadcrumb ;
	?>
	 <Form method="post" action="options.php">
	<?php wp_nonce_field( 'breadcrumb', 'breadcrumb-nonce' ) ?>
	<?php settings_fields( 'bsp_breadcrumb' );
	?>	
	
	
	<table class="form-table">
	<tr valign="top">
	</tr>
	
<!--Don't show breadcrumbs---------------------------------------------------------------------->
	<tr>
	<td colspan="2"><?php _e('Disable All forum Breadcrumbs', 'bbp-style-pack'); ?> </td>
	<td colspan="2">
	<?php
			$item =  'bsp_breadcrumb[no_breadcrumb]' ;
			$item1 = (!empty($bsp_breadcrumb['no_breadcrumb']) ? $bsp_breadcrumb['no_breadcrumb'] : '');
			//$item1 =  $bsp_breadcrumb['no_breadcrumb'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' />' ;
			_e('Click to disable breadcrumbs', 'bbp-style-pack');
  			?>
	</td></tr>
	
<!--Breadcrumb Home ------------------------------------------------------------------->
				
			<tr>
			<?php 
			$name = 'Breadcrumb Home' ;
			$area1='Text' ;
			$item1="bsp_breadcrumb[".$name.$area1."]" ;
					
			?>
			<th><?php echo '1. '.$name ?></th>
			<td><?php _e('Disable Home breadcrumbs', 'bbp-style-pack'); ?> </td>
			<td><?php
			$item =  'bsp_breadcrumb[no_home_breadcrumb]' ;
			//$query_age = (isset($_GET['query_age']) ? $_GET['query_age'] : null);
			$itema = (!empty($bsp_breadcrumb['no_home_breadcrumb']) ? $bsp_breadcrumb['no_home_breadcrumb'] : '');
			//$itema =  $bsp_breadcrumb['no_home_breadcrumb'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$itema, false ) . ' />' ;
			_e('Click to disable home breadcrumb', 'bbp-style-pack') ;
  			?>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $area1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_breadcrumb[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'You can change what the home breadcrumb says eg "back to site", "Exit forums" "Back to home" etc', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
<!--Breadcrumb root ------------------------------------------------------------------->
				
			<tr>
			<?php 
			$name = 'Breadcrumb Root' ;
			$area1='Text' ;
			$item1="bsp_breadcrumb[".$name.$area1."]" ;
					
			?>
			<th><?php echo '2. '.$name ?></th>
			<td><?php _e('Disable Root breadcrumbs', 'bbp-style-pack'); ?> </td>
			<td><?php
			$item =  'bsp_breadcrumb[no_root_breadcrumb]' ;
			$itema = (!empty($bsp_breadcrumb['no_root_breadcrumb']) ? $bsp_breadcrumb['no_root_breadcrumb'] : '');
			//$itema =  $bsp_breadcrumb['no_root_breadcrumb'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$itema, false ) . ' />' ;
			_e('Click to disable root breadcrumb', 'bbp-style-pack') ;
  			?>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $area1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_breadcrumb[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'You can change what the root breadcrumb says eg "The forums",  etc', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
<!--current root ------------------------------------------------------------------->
				
			<tr>
			<?php 
			$name = 'Breadcrumb Current' ;
			$area1='Text' ;
			$item1="bsp_breadcrumb[".$name.$area1."]" ;
					
			?>
			<th><?php echo '3. '.$name ?></th>
			<td><?php _e('Disable current breadcrumb ', 'bbp-style-pack'); ?></td>
			<td><?php
			$item =  'bsp_breadcrumb[no_current_breadcrumb]' ;
			$itema = (!empty($bsp_breadcrumb['no_current_breadcrumb']) ? $bsp_breadcrumb['no_current_breadcrumb'] : '');
			//$itema =  $bsp_breadcrumb['no_current_breadcrumb'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$itema, false ) . ' />' ;
			_e('Click to disable current breadcrumb', 'bbp-style-pack') ;
  			?>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $area1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_breadcrumb[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'You can change what the current breadcrumb says eg "you are here", but this will apply to all "current" entries', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>			
			
			
			</table>
			
			
<!-- save the options -->
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e( 'Save changes', 'bbp-style-pack' ); ?>" />
				</p>
				</form>
		</div><!--end sf-wrap-->
	</div><!--end wrap-->
	

<?php
}



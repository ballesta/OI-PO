<?php

function bsp_forum_templates() {

global $bsp_templates ;
	?>
	 <Form method="post" action="options.php">
	<?php wp_nonce_field( 'templates', 'templates-nonce' ) ?>
	<?php settings_fields( 'bsp_templates' );
	?>	
			
						<table class="form-table">
					
					<tr valign="top">
						<th colspan="2">
						
						<h3>
						<?php _e ('Forum Templates' , 'bsp' ) ; ?>
						</h3>


						

<p/>						



<?php //set up variables

$name =  'bsp_templates[template]' ;
$item = (!empty($bsp_templates['template']) ? $bsp_templates['template'] : '');
if (empty ($item) )  $item=0 ;
?>
<table>
<!--choose template 0 ---------------------------------------------------------------------->	
<tr><td colspan='3' ><h4><span style="color:blue"><?php _e('Default Forum template', 'bbp-style-pack' ) ; ?></span></h4>
<tr><td colspan='3'> <?php _e ('This is the default template in bbpress' , 'bbp-style-pack' ) ; ?> </td><tr>	
</td></tr>	
			<tr>
	<td>
	<?php
			echo '<input name="'.$name.'" id="'.$item.'" type="radio" value="0" class="code"  ' . checked( 0,$item, false ) . ' />' ;
			_e ('Click to select' , 'bbp-style-pack' ) ;?>
			<br><label class="description"><?php _e( '<i>(You can set the sub forum display in the forum display tab)</i>' , 'bbp-style-pack' ); ?></label>
	</td>
<td width="30%"><?php echo '<img src="' . plugins_url( 'images/extras1.JPG',dirname(__FILE__)  ) . '"  > '; ?></td>

<td width="30%">
<?php _e ('or' , 'bbp-style-pack' ) ; ?>
<?php echo '<img src="' . plugins_url( 'images/forum2.JPG',dirname(__FILE__)  ) . '" > '; ?></td>
</tr>

<!--choose template 1---------------------------------------------------------------------->
<tr><td colspan='3'><h4><span style="color:blue"><?php _e('Alternate Forum template 1', 'bbp-style-pack' ) ; ?></span></h4>		
</td></tr>
<tr><td colspan='3'> <?php _e ('This alternate version list the main forums in seperate sections' , 'bbp-style-pack' ) ; ?> </td><tr>
<tr>
	<td>
	<?php
			echo '<input name="'.$name.'" id="'.$item.'" type="radio" value="1" class="code" ' . checked( 1,$item, false ) . ' />' ;
			_e ('Click to select' , 'bbp-style-pack' ) ;
  			?>
	</td>
<td><?php echo '<img src="' . plugins_url( 'images/extras2.JPG',dirname(__FILE__)  ) . '" > '; ?></td>
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

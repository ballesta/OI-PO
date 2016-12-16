<?php

//topics index settings page

function bsp_style_settings_ti () {
	global $bsp_style_settings_ti ;
	?>
	 <Form method="post" action="options.php">
	<?php wp_nonce_field( 'style-settings-ti', 'style-settings-nonce' ) ?>
	<?php settings_fields( 'bsp_style_settings_ti' );
	//create a style.css on entry and on saving
	generate_style_css() ;
	?>
	
	<table>
	<tr>
	<td>
	<p><?php _e('This section allows you to amend styles.', 'bbp-style-pack'); ?>  </p>
	<p>	<?php _e('The majority of style settings are the same as the Forums Index Styling, and only where different are listed here', 'bbp-style-pack'); ?> </p>
	<p> <p>
	<p> <?php _e('You only need to enter those styles and elements within a style that you wish to alter', 'bbp-style-pack'); ?> </p></td>
	<td>	
	<?php
	//show style image
	 echo '<img src="' . plugins_url( 'images/topics-list.JPG',dirname(__FILE__)  ) . '" > '; ?>
	</td>
	</tr>
	</table>
	
	
	<table class="form-table">
	
	
	
	
			
	<!--Font - Pagination font  ------------------------------------------------------------------->
			
			
			<tr>
			<?php 
			$name = 'Pagination Font' ;
			$name0 = __('Pagination Font', 'bbp-style-pack') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name2 = __('Color', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area2='Color' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			$item2="bsp_style_settings_ti[".$name.$area2."]" ;
			$item3="bsp_style_settings_ti[".$name.$area3."]" ;
			$item4="bsp_style_settings_ti[".$name.$area4."]" ;
			?>
			<th><?php echo '1. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter Font eg Arial - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<select name="<?php echo $item4 ; ?>">
			<?php echo '<option value="'.esc_html( $bsp_style_settings_ti[$name.$area4]).'">'.esc_html( $bsp_style_settings_ti[$name.$area4] ) ; ?> 
			<option value="Normal">Normal</option>
			<option value="Italic">Italic</option>
			<option value="Bold">Bold</option>
			<option value="Bold and Italic">Bold and Italic</option>
			</select>
			</td>
			</tr>
			
			
			<!--Font - voice count font  ------------------------------------------------------------------->
			
			
			<tr>
			<?php 
			$name = 'Voice/Post Count Font' ;
			$name0 = __('Voice/Post Count Font', 'bbp-style-pack') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name2 = __('Color', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area2='Color' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			$item2="bsp_style_settings_ti[".$name.$area2."]" ;
			$item3="bsp_style_settings_ti[".$name.$area3."]" ;
			$item4="bsp_style_settings_ti[".$name.$area4."]" ;
			?>
			<th><?php echo '2. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter Font eg Arial - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<select name="<?php echo $item4 ; ?>">
			<?php echo '<option value="'.esc_html( $bsp_style_settings_ti[$name.$area4]).'">'.esc_html( $bsp_style_settings_ti[$name.$area4] ) ; ?> 
			<option value="Normal">Normal</option>
			<option value="Italic">Italic</option>
			<option value="Bold">Bold</option>
			<option value="Bold and Italic">Bold and Italic</option>
			</select>
			</td>
			</tr>
				
					
	<!--Font - links   ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Topic Title Links' ;
			$name0 = __('Topic Title Links', 'bbp-style-pack') ;
			$name1 = __('Link Color', 'bbp-style-pack') ;
			$name2 = __('Visited Color', 'bbp-style-pack') ;
			$name3 = __('Hover Color', 'bbp-style-pack') ;
			$area1='Link Color' ;
			$area2='Visited Color' ;
			$area3='Hover Color' ;
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			$item2="bsp_style_settings_ti[".$name.$area2."]" ;
			$item3="bsp_style_settings_ti[".$name.$area3."]" ;
			?>
			<th><?php echo '3. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
			
	<!--Font - Topic Title  ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Topic Title Font' ;
			$name0 = __('Topic Title Font', 'bbp-style-pack') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			$item3="bsp_style_settings_ti[".$name.$area3."]" ;
			$item4="bsp_style_settings_ti[".$name.$area4."]" ;
			?>
			<th><?php echo '4. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter Font eg Arial - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<select name="<?php echo $item4 ; ?>">
			<?php echo '<option value="'.esc_html( $bsp_style_settings_ti[$name.$area4]).'">'.esc_html( $bsp_style_settings_ti[$name.$area4] ) ; ?> 
			<option value="Normal">Normal</option>
			<option value="Italic">Italic</option>
			<option value="Bold">Bold</option>
			<option value="Bold and Italic">Bold and Italic</option>
			</select>
			</td>
			</tr>
			
			
			<!--Font - template notice font  ------------------------------------------------------------------->
			
			
			<tr>
			<?php 
			$name = 'Template Notice Font' ;
			$name0 = __('Template Notice Font', 'bbp-style-pack') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name2 = __('Color', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area2='Color' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			$item2="bsp_style_settings_ti[".$name.$area2."]" ;
			$item3="bsp_style_settings_ti[".$name.$area3."]" ;
			$item4="bsp_style_settings_ti[".$name.$area4."]" ;
			?>
			<th><?php echo '5. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter Font eg Arial - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<select name="<?php echo $item4 ; ?>">
			<?php echo '<option value="'.esc_html( $bsp_style_settings_ti[$name.$area4]).'">'.esc_html( $bsp_style_settings_ti[$name.$area4] ) ; ?> 
			<option value="Normal">Normal</option>
			<option value="Italic">Italic</option>
			<option value="Bold">Bold</option>
			<option value="Bold and Italic">Bold and Italic</option>
			</select>
			</td>
			</tr>
			
	<!--template notice Background color  ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Template Notice' ;
			$name0 = __('Template Notice', 'bbp-style-pack') ;
			$name1 = __('Background color', 'bbp-style-pack') ;
			$area1='Background color' ;
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			?>
			<th><?php echo '6. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
			
			
		<!--template notice Border  ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Template Notice Border' ;
			$name0 = __('Template Notice Border', 'bbp-style-pack') ;
			$name1 = __('Line width', 'bbp-style-pack') ;
			$name3 = __('Line style', 'bbp-style-pack') ;
			$name4 = __('Line color', 'bbp-style-pack') ;
			$area1='Line width' ;
			$area3='Line style' ;
			$area4='Line color';
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			$item3="bsp_style_settings_ti[".$name.$area3."]" ;
			$item4="bsp_style_settings_ti[".$name.$area4."]" ;
			?>
			<th><?php echo '7. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 1px - Set to 0px to hide border', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default solid - solid, dashed, dotted are common values - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item4.'" class="large-text" name="'.$item4.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area4] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>

<!--Font - topic started by  ------------------------------------------------------------------->
			
			
			<tr>
			<?php 
			$name = 'Topic Started by' ;
			$name0 = __('Topic Started by', 'bbp-style-pack') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name2 = __('Color', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area2='Color' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			$item2="bsp_style_settings_ti[".$name.$area2."]" ;
			$item3="bsp_style_settings_ti[".$name.$area3."]" ;
			$item4="bsp_style_settings_ti[".$name.$area4."]" ;
			?>
			<th><?php echo '8. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter Font eg Arial - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<select name="<?php echo $item4 ; ?>">
			<?php echo '<option value="'.esc_html( $bsp_style_settings_ti[$name.$area4]).'">'.esc_html( $bsp_style_settings_ti[$name.$area4] ) ; ?> 
			<option value="Normal">Normal</option>
			<option value="Italic">Italic</option>
			<option value="Bold">Bold</option>
			<option value="Bold and Italic">Bold and Italic</option>
			</select>
			</td>
			</tr>
			
<!--Sticky Topic background ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Sticky Topic/Reply' ;
			$name0 = __('Sticky Topic/Reply', 'bbp-style-pack') ;
			$name1 = __('Background color - sticky topic', 'bbp-style-pack') ;
			$name2 = __('Background color - super sticky topic', 'bbp-style-pack') ;
			$area1='Background color - sticky topic' ;
			$area2='Background color - super sticky topic' ;
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			$item2="bsp_style_settings_ti[".$name.$area2."]" ;
			?>
			<th><?php echo '9. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default #ffffe0  Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default #ffffe0 Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
			<!--Font - forum info  ------------------------------------------------------------------->
			
			
			<tr>
			<?php 
			$name = 'Forum Information Font' ;
			$name0 = __('Forum Information Font', 'bbp-style-pack') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name2 = __('Color', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area2='Color' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			$item2="bsp_style_settings_ti[".$name.$area2."]" ;
			$item3="bsp_style_settings_ti[".$name.$area3."]" ;
			$item4="bsp_style_settings_ti[".$name.$area4."]" ;
			?>
			<th><?php echo '10. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter Font eg Arial - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<select name="<?php echo $item4 ; ?>">
			<?php echo '<option value="'.esc_html( $bsp_style_settings_ti[$name.$area4]).'">'.esc_html( $bsp_style_settings_ti[$name.$area4] ) ; ?> 
			<option value="Normal">Normal</option>
			<option value="Italic">Italic</option>
			<option value="Bold">Bold</option>
			<option value="Bold and Italic">Bold and Italic</option>
			</select>
			</td>
			</tr>
			
	<!--forum info notice Background color  ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Forum Information' ;
			$name0 = __('Forum Information', 'bbp-style-pack') ;
			$name1 = __('Background color', 'bbp-style-pack') ;
			$area1='Background color' ;
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			?>
			<th><?php echo '11. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
			
			
		<!--forum information Border  ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Forum Information Border' ;
			$name0 = __('Forum Information Border', 'bbp-style-pack') ;
			$name1 = __('Line width', 'bbp-style-pack') ;
			$name3 = __('Line style', 'bbp-style-pack') ;
			$name4 = __('Line color', 'bbp-style-pack') ;
			$area1='Line width' ;
			$area3='Line style' ;
			$area4='Line color';
			$item1="bsp_style_settings_ti[".$name.$area1."]" ;
			$item3="bsp_style_settings_ti[".$name.$area3."]" ;
			$item4="bsp_style_settings_ti[".$name.$area4."]" ;
			?>
			<th><?php echo '12. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 1px - Set to 0px to hide border', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default solid - solid, dashed, dotted are common values - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item4.'" class="large-text" name="'.$item4.'" type="text" value="'.esc_html( $bsp_style_settings_ti[$name.$area4] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
			
			
			
					
					</table>
					<!-- save the options -->
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save changes', 'bsp_style_settings' ); ?>" />
				</p>
				</form>
		</div><!--end sf-wrap-->
	</div><!--end wrap-->
	
	 
		<?php
		}
		

	

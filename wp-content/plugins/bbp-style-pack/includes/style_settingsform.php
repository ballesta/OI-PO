<?php

//forum style settings page

function bsp_style_settings_form () {
	global $bsp_style_settings_form ;
	?>
	 <Form method="post" action="options.php">
	<?php wp_nonce_field( 'style-settings-form', 'style-settings-nonce' ) ?>
	<?php settings_fields( 'bsp_style_settings_form' );
	//create a style.css on entry and on saving
	generate_style_css() ;
	?>
	
	<table>
	<tr>
	<td>
	<p> <?php _e('This section allows you to amend styles.', 'bbp-style-pack'); ?> </p>
	<p> <?php _e('You only need to enter those styles and elements within a style that you wish to alter', 'bbp-style-pack'); ?>  </p></td>
	<td>	
	<?php
	//show style image
	 echo '<img src="' . plugins_url( 'images/topic-form.JPG',dirname(__FILE__)  ) . '" > '; ?>
	</td>
	</tr>
	</table>

			
	<table class="form-table">
	
	

	
	
			
	<!--Topic Title ------------------------------------------------------------------->
			
			
			<tr>
			<?php 
			$name = 'Labels' ;
			$name0 = __('Labels', 'bbp-style-pack') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name2 = __('Color', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area2='Color' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings_form[".$name.$area1."]" ;
			$item2="bsp_style_settings_form[".$name.$area2."]" ;
			$item3="bsp_style_settings_form[".$name.$area3."]" ;
			$item4="bsp_style_settings_form[".$name.$area4."]" ;
			?>
			<th><?php echo '1. '.$name0?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_form[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings_form[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings_form[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter Font eg Arial - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<select name="<?php echo $item4 ; ?>">
			<?php echo '<option value="'.esc_html( $bsp_style_settings_form[$name.$area4]).'">'.esc_html( $bsp_style_settings_form[$name.$area4] ) ; ?> 
			<option value="Normal">Normal</option>
			<option value="Italic">Italic</option>
			<option value="Bold">Bold</option>
			<option value="Bold and Italic">Bold and Italic</option>
			</select>
			</td>
			</tr>
			
			
<!--Text Area background ------------------------------------------------------------------->
			<tr valign='top'>
			<?php 
			$name = 'Text area' ;
			$name0 = __('Text area', 'bbp-style-pack') ;
			$name1 = __('Background Color', 'bbp-style-pack') ;
			$area1='Background Color' ;
			$item1="bsp_style_settings_form[".$name.$area1."]" ;
			?>
			<th><?php echo '2. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_form[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
			<!--Text Area ------------------------------------------------------------------->
			
			
			<tr>
			<?php 
			$name = 'Text area' ;
			$name0 = __('Text area', 'bbp-style-pack') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name2 = __('Color', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area2='Color' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings_form[".$name.$area1."]" ;
			$item2="bsp_style_settings_form[".$name.$area2."]" ;
			$item3="bsp_style_settings_form[".$name.$area3."]" ;
			$item4="bsp_style_settings_form[".$name.$area4."]" ;
			?>
			<th><?php echo '3. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_form[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings_form[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings_form[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter Font eg Arial - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<select name="<?php echo $item4 ; ?>">
			<?php echo '<option value="'.esc_html( $bsp_style_settings_form[$name.$area4]).'">'.esc_html( $bsp_style_settings_form[$name.$area4] ) ; ?> 
			<option value="Normal">Normal</option>
			<option value="Italic">Italic</option>
			<option value="Bold">Bold</option>
			<option value="Bold and Italic">Bold and Italic</option>
			</select>
			</td>
			</tr>
<!--Button background ------------------------------------------------------------------->
			<tr valign='top'>
			<?php 
			$name = 'Button' ;
			$name0 = __('Button', 'bbp-style-pack') ;
			$name1 = __('Background Color', 'bbp-style-pack') ;
			$name2 = __('Text Color', 'bbp-style-pack') ;
			$area1='Background Color' ;
			$area2='Text Color' ;
			$item1="bsp_style_settings_form[".$name.$area1."]" ;
			$item2="bsp_style_settings_form[".$name.$area2."]" ;
			?>
			<th><?php echo '4. '.$name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings_form[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr><td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings_form[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Enter color by name or hex value - see help for further info', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
			
			
			
			
			
			
	</table>
					<!-- save the options -->
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save changes', 'bsp_style_settings_t' ); ?>" />
				</p>
				</form>
		</div><!--end sf-wrap-->
	</div><!--end wrap-->
	
	
	 
		<?php
		}
		

	

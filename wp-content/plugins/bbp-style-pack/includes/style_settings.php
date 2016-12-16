<?php

//style settings page

function bsp_style_settings () {
	global $bsp_style_settings ;
	?>
	 <Form method="post" action="options.php">
	<?php wp_nonce_field( 'style-settings', 'style-settings-nonce' ) ?>
	<?php settings_fields( 'bsp_style_settings' );
	//create a style.css on entry and on saving
	generate_style_css() ;
	?>
			
	<table class="form-table">
	<tr valign="top">
	<th colspan="3"><p>
	<?php _e('This section allows you to amend styles.', 'bbp-style-pack'); ?>
	</p>
	<p>
	<?php _e('You only need to enter those styles and elements within a style that you wish to alter', 'bbp-style-pack'); ?>
	</p></th>
	</tr>
	<!--Forum Content background ---------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Forum Content' ;
			$name0 = __('Forum Content', 'bbp-style-pack') ;
			$name1 = __('Background color - odd numbers', 'bbp-style-pack') ;
			$name2 = __('Background color - even numbers', 'bbp-style-pack') ;
			$area1='Background color - odd numbers' ;
			$area2='Background color - even numbers' ;
			$item1="bsp_style_settings[".$name.$area1."]" ;
			$item2="bsp_style_settings[".$name.$area2."]" ;
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default #fbfbfb', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default #fff', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
	<!--Topic/Reply Content background ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Topic/Reply Content' ;
			$name0 = __('Topic/Reply Content', 'bbp-style-pack') ;
			$name1 = __('Background color - odd numbers', 'bbp-style-pack') ;
			$name2 = __('Background color - even numbers', 'bbp-style-pack') ;
			$area1='Background color - odd numbers' ;
			$area2='Background color - even numbers' ;
			$item1="bsp_style_settings[".$name.$area1."]" ;
			$item2="bsp_style_settings[".$name.$area2."]" ;
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default #fff', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default #fbfbfb', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
	<!--Forum/Topic/Reply headers/footers background ------------------------------------------------------------------->
			<tr valign='top'>
			<?php 
			$name = 'Forum/Topic Headers/Footers' ;
			$name0 = __('Forum/Topic Headers/Footers', 'bbp-style-pack') ;
			$name1 = __('Background Color', 'bbp-style-pack') ;
			$area1='Background Color' ;
			$item1="bsp_style_settings[".$name.$area1."]" ;
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default #f4f4f4', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
	<!--trash/spam background color ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Trash/Spam Content' ;
			$name0 = __('Trash/Spam Content') ;
			$name1 = __('Background color - odd numbers', 'bbp-style-pack') ;
			$name2 = __('Background color - even numbers', 'bbp-style-pack') ;
			$area1='Background color - odd numbers' ;
			$area2='Background color - even numbers' ;
			$item1="bsp_style_settings[".$name.$area1."]" ;
			$item2="bsp_style_settings[".$name.$area2."]" ;
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default #fdd', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default #fee', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
	<!--Closed background color ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Closed Content' ;
			$name0 = __('Closed Content') ;
			$name1 = __('Background color', 'bbp-style-pack') ;
			$area1='Background color' ;
			$item1="bsp_style_settings[".$name.$area1."]" ;
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default #ccc', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<!--Font - Forum titles   ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Forum Headings Font' ;
			$name0 = __('Forum Headings Font') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name2 = __('Color', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area2='Color' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings[".$name.$area1."]" ;
			$item2="bsp_style_settings[".$name.$area2."]" ;
			$item3="bsp_style_settings[".$name.$area3."]" ;
			$item4="bsp_style_settings[".$name.$area4."]" ;
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default inherited from theme - Enter color', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default inherited from theme - Enter Font eg Arial', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item4.'" class="large-text" name="'.$item4.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area4] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default Normal - Enter style eg italic, bold etc', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<!--Font - links   ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Links' ;
			$name0 = __('Links') ;
			$name1 = __('Link Color', 'bbp-style-pack') ;
			$name2 = __('Active Color', 'bbp-style-pack') ;
			$name3 = __('Hover Color', 'bbp-style-pack') ;
			$area1='Link Color' ;
			$area2='Active Color' ;
			$area3='Hover Color' ;
			$item1="bsp_style_settings[".$name.$area1."]" ;
			$item2="bsp_style_settings[".$name.$area2."]" ;
			$item3="bsp_style_settings[".$name.$area3."]" ;
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default inherited from theme - Enter color', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default inherited from theme - Enter color', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default inherited from theme - Enter color', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
			
			<!--Font - forum and category lists   ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Forum and Category List Font' ;
			$name0 = __('Forum and Category List Font') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings[".$name.$area1."]" ;
			$item3="bsp_style_settings[".$name.$area3."]" ;
			$item4="bsp_style_settings[".$name.$area4."]" ;
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default inherited from theme - Enter Font eg Arial', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item4.'" class="large-text" name="'.$item4.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area4] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default Normal - Enter style eg italic, bold etc', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
			
			<!--Font - sub forums   ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Sub Forum List Font' ;
			$name0 = __('Sub Forum List Font') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings[".$name.$area1."]" ;
			$item3="bsp_style_settings[".$name.$area3."]" ;
			$item4="bsp_style_settings[".$name.$area4."]" ;
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default inherited from theme - Enter Font eg Arial', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item4.'" class="large-text" name="'.$item4.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area4] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default Normal - Enter style eg italic, bold etc', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
			<!--Font - forum description  ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Forum Description Font' ;
			$name0 = __('Forum Description Font') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name2 = __('Color', 'bbp-style-pack') ;
			$name3 = __('Font', 'bbp-style-pack') ;
			$name4 = __('Style', 'bbp-style-pack') ;
			$area1='Size' ;
			$area2='Color' ;
			$area3='Font' ;
			$area4='Style';
			$item1="bsp_style_settings[".$name.$area1."]" ;
			$item2="bsp_style_settings[".$name.$area2."]" ;
			$item3="bsp_style_settings[".$name.$area3."]" ;
			$item4="bsp_style_settings[".$name.$area4."]" ;
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default inherited from theme - Enter color', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default inherited from theme - Enter Font eg Arial', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item4.'" class="large-text" name="'.$item4.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area4] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default Normal - Enter style eg italic, bold etc', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
			
	<!--Font - Forum/Topic/Reply/Search Results  ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Forum/Topic/Reply Font' ;
			$name0 = __('Forum/Topic/Reply Font') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$name2 = __('Border', 'bbp-style-pack') ;
			$area1='Size' ;
			$area2='Border' ;
			$item1="bsp_style_settings[".$name.$area1."]" ;
			$item2="bsp_style_settings[".$name.$area2."]" ;			
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 1px solid #eee', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
	<!--Font - Forum/Topic/Reply/title font  ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Forum/Topic/Reply Title Font' ;
			$name0 = __('Forum/Topic/Reply Title Font') ;
			$name1 = __('Size', 'bbp-style-pack') ;
			$area1='Size' ;
			$item1="bsp_style_settings[".$name.$area1."]" ;
			?>
			<th><?php echo $name0 ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 16px', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
	<!--Font - author Role  ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Author Role Font' ;
			$area1='Size' ;
			$item1="bsp_style_settings[".$name.$area1."]" ;
			?>
			<th><?php echo $name ?></th>
			<td> <?php echo $area1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 11px', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
	<!--Font - breadcrumb/topic-tags font  ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Breadcrumb/Topic-tags Font' ;
			$area1='Size' ;
			$item1="bsp_style_settings[".$name.$area1."]" ;
			?>
			<th><?php echo $name ?></th>
			<td> <?php echo $area1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 12px', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
	<!--Font - favorite/subscribe font  ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = 'Favorite/Subscribe Font' ;
			$area1='Size' ;
			$item1="bsp_style_settings[".$name.$area1."]" ;
			?>
			<th><?php echo $name ?></th>
			<td> <?php echo $area1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_style_settings[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default 13px', 'bbp-style-pack' ); ?></label><br/>
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
		

	

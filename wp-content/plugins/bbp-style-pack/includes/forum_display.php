<?php

//forum display settings page

function bsp_forum_display () {
	global $bsp_forum_display ;
	?>
	 <Form method="post" action="options.php">
	<?php wp_nonce_field( 'forum-display', 'forum-display-nonce' ) ?>
	<?php settings_fields( 'bsp_forum_display' );
	//create a style.css on entry and on saving
	generate_style_css() ;
	?>	
	<table class="form-table">
	<tr valign="top">
	<th colspan="3"><p><?php _e('This section allows you to amend the way the forums display.', 'bbp-style-pack'); ?>
	</p>
	</th>
	</tr>
	<th style="text-align:left"><?php _e('CHANGE', 'bbp-style-pack'); ?> </th>
	<th style="text-align:center"><?php _e('FROM', 'bbp-style-pack'); ?>   </th>
	<th style="text-align:center"><?php _e('TO', 'bbp-style-pack'); ?>  </th>
	<th style="text-align:left"><?php _e('Click to activate', 'bbp-style-pack'); ?>   </th>
	
	

	
	<!--forum list vertical ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = __('Forum List', 'bbp-style-pack') ;
			$desc = __('Alter the list from horizontal to vertical', 'bbp-style-pack') ;
			?>
			<th width="10%"><?php echo '1.<br>'.$name.'</p><i>'.$desc.' </i>' ?></th>
			<td width="35%"><?php echo '<img src="' . plugins_url( 'images/forum1.JPG',dirname(__FILE__)  ) . '"  > '; ?></td>
			<td width="35%"><?php echo '<img src="' . plugins_url( 'images/forum2.JPG',dirname(__FILE__)  ) . '" > '; ?></td>
			<td width="15%">
			<?php
			$item =  'bsp_forum_display[forum_list]' ;
			$item1 = (!empty($bsp_forum_display['forum_list']) ? $bsp_forum_display['forum_list'] : '');
			//$item1 =  $bsp_forum_display['forum_list'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' />' ;
			_e('Change to column list','bbp-style-pack');
  			?>
			</td>
			</tr>
<!--hide forum counts ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = __('Hide sub-forum counts','bbp-style-pack')  ;
			?>
			<th width="10%"><?php echo '2.<br>'.$name ; ?></th>
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/forum1.JPG',dirname(__FILE__)  ) . '" > '; ?></td>
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/forum3.JPG',dirname(__FILE__)  ) . '" > '; ?></td>
			<td width="16%">
			<?php
			$item =  'bsp_forum_display[hide_counts]' ;
			$item1 = (!empty($bsp_forum_display['hide_counts']) ? $bsp_forum_display['hide_counts'] : '');
			//$item1 =  $bsp_forum_display['hide_counts'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' />' ;
			_e('Hide counts','bbp-style-pack') ;
  			?>
			</td>
			</tr>
			
<!--Move subscribe to right ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = __('Move subscribe','bbp-style-pack')  ; 
			$desc = __('Stop subscribe resting against the breadcrumb', 'bbp-style-pack') ;
			?>
			<th width="10%"><?php echo '3.<br>'.$name.'</p><i>'.$desc.'</i>' ?></th>
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/forum4.JPG',dirname(__FILE__)  ) . '" > '; ?></td>
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/forum5.JPG',dirname(__FILE__)  ) . '" > '; ?></td>
			<td width="16%">
			<?php
			$item =  'bsp_forum_display[move_subscribe]' ;
			$item1 = (!empty($bsp_forum_display['move_subscribe']) ? $bsp_forum_display['move_subscribe'] : '');
			//$item1 =  $bsp_forum_display['move_subscribe'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' />' ;
			_e('Move subscribe to right','bbp-style-pack') ;
  			?>
			</td>
			</tr>
			
<!--Remove Private title ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = __('Remove "Private" prefix','bbp-style-pack')  ; 
			$desc = __('Remove private prefix for forums and topics', 'bbp-style-pack') ;
			?>
			<th width="10%"><?php echo '4.<br>'.$name.'</p><i>'.$desc.'</i>' ?></th>
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/forum6.JPG',dirname(__FILE__)  ) . '"  > '; ?></td>
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/forum7.JPG',dirname(__FILE__)  ) . '" > '; ?></td>
			<td width="16%">
			<?php
			$item =  'bsp_forum_display[remove_private]' ;
			$item1 = (!empty($bsp_forum_display['remove_private']) ? $bsp_forum_display['remove_private'] : '');
			//$item1 =  $bsp_forum_display['remove_private'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' />';
			_e('Remove private prefix','bbp-style-pack') ;
  			?>
			</td>
			</tr>
<!--create new topic ------------------------------------------------------------------->
			<tr>
			<?php 
			$name = __('Add "Create New Topic" link','bbp-style-pack')  ; 
			$desc = __('Adds a "Create New Topic" for individual forums', 'bbp-style-pack') ;
			?>
			<th width="10%"><?php echo '5.<br>'.$name.'</p><i>'.$desc.'</i>' ?></th>
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/forum7.JPG',dirname(__FILE__)  ) . '"  > '; ?></td>
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/forum8.JPG',dirname(__FILE__)  ) . '" > '; ?></td>
			<td width="16%">
			<?php
			$item =  'bsp_forum_display[create_new_topic]' ;
			$item1 = (!empty($bsp_forum_display['create_new_topic']) ? $bsp_forum_display['create_new_topic'] : '');
			//$item1 =  $bsp_forum_display['create_new_topic'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' />' ;
			_e('Add New topic link','bbp-style-pack') ;
			?>
			</td>
			</tr>
<!--create new topic name ---------------------------------------------------------------------->
			<tr>
			<?php
			$name = __('Create New Topic Description','bbp-style-pack')  ; 
			$area1='Create New Topic Description' ;
			$item1="bsp_forum_display[".$area1."]" ;
			?>
			<th></th>
			<td> <?php echo $name ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_forum_display[$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'By default this will be "Create New Topic".<p> Enter any alternate wording e.g. "Start new Topic", "Begin a debate" etc.', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
<!--add forum description ------------------------------------------------------------------->
			<tr>
			<?php
			$name = __('Add Forum Description','bbp-style-pack')  ; 
			$desc = __('Adds description to the display', 'bbp-style-pack') ;
			?>
			
			<th width="10%"><?php echo '6.<br>'.$name.'</p><i>'.$desc.'</i>' ?></th>
			
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/forum7.JPG',dirname(__FILE__)  ) . '"  > '; ?></td>
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/forum9.JPG',dirname(__FILE__)  ) . '" > '; ?></td>
			<td width="16%">
			<?php
			$item =  'bsp_forum_display[add_forum_description]' ;
			$item1 = (!empty($bsp_forum_display['add_forum_description']) ? $bsp_forum_display['add_forum_description'] : '');
			//$item1 =  $bsp_forum_display['add_forum_description'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' /> Add Forum Description';
  			?>
			</td>
			</tr>
<!--add rounded corners ------------------------------------------------------------------->
			<tr>
			<?php
			$name = __('Add Rounded Corners','bbp-style-pack')  ; 
			$desc = __('Adds rounded corners', 'bbp-style-pack') ;
			
			?>
			
			<th width="10%"><?php echo '7.<br>'.$name.'</p><i>'.$desc.'</i>' ?></th>
			
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/Corners1.JPG',dirname(__FILE__)  ) . '"  > '; ?></td>
			<td width="37%"><?php echo '<img src="' . plugins_url( 'images/Corners2.JPG',dirname(__FILE__)  ) . '" > '; ?></td>
			<td width="16%">
			<?php
			$item =  'bsp_forum_display[rounded_corners]' ;
			$item1 = (!empty($bsp_forum_display['rounded_corners']) ? $bsp_forum_display['rounded_corners'] : '');
			//$item1 =  $bsp_forum_display['rounded_corners'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' /> Add Rounded Corners';
  			?>
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
		
		


	

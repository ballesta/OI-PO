<?php

//login settings page

function bsp_login_settings() {
 ?>
			
						<table class="form-table">
					
					<tr valign="top">
						<th colspan="2">
						
						<h3>
						<?php _e ('Login options' , 'bbp-style-pack' ) ; ?>
						</h3>


						
					
<p>
<?php _e ('There are many ways to get users logged into forums.' , 'bbp-style-pack' ) ; ?>
</p>
<p/>
<p>
<?php _e ('a. Remember bbPress just uses the wordpress login, so any plugin that does wordpress login will also do bbPress.There are lots out there go to' , 'bbp-style-pack' ) ; ?>
<a href="https://wordpress.org/plugins/">https://wordpress.org/plugins</a>
</p>
<p>
<?php _e ('b. Within bbPress you can use the sidebar login widget Dashboard>appearance>widgets and look for (bbpress) Login widget' , 'bbp-style-pack' ) ; ?>
</p>
<p>
<?php _e ('c. Or use a page or post to display the widget using the shortcode  [bbp-login]' , 'bbp-style-pack' ) ; ?>
</p>
<p>
<?php _e ('d. The following adds a simple login/logout to your menu and/or Register/Edit Profile' , 'bbp-style-pack' ) ; ?>
</p>
<p> 
<?php _e ("This can the give you the combination of 'login/Register' and 'logout/edit profile' as a menu display, which means users only see relevant items" , 'bbp-style-pack' ) ; ?>
</p>
<p></p>
<?php 
global $bsp_login ;
	?>
	 <Form method="post" action="options.php">
	<?php wp_nonce_field( 'login', 'login-nonce' ) ?>
	<?php settings_fields( 'bsp_login' );
	?>	
	<table class="form-table">
	<th style="text-align:center">
	<?php _e ('Not Logged in' , 'bbp-style-pack' ) ; ?>
	</th>
	<th style="text-align:center">
	<?php _e ('Logged in ' , 'bbp-style-pack' ) ; ?>
	</th>
	<tr>
	<td>
	<?php echo '<img src="' . plugins_url( 'images/logina.JPG',dirname(__FILE__)  ) . '"  > '; ?></td>
	<td>
	<?php echo '<img src="' . plugins_url( 'images/loginb.JPG',dirname(__FILE__)  ) . '"  > '; ?></td>
	</tr>
	</table>
	
	<table class="form-table">
	<tr valign="top">
	</tr>
	
<!--Click to add login/logout---------------------------------------------------------------------->
	<tr>
	<th colspan="2">1. 
	<?php _e ('Add login/logout to menu items' , 'bbp-style-pack' ) ; ?>
	</th>
	<td colspan="2">
	<?php
			$name = __('Add login/logout to menu items', 'bbp-style-pack') ;
			$name1 = __('Login menu item description', 'bbp-style-pack') ;
			$name2 = __('Logout menu item description', 'bbp-style-pack') ;
			$area1='login' ;
			$area2='logout' ;
			$item1="bsp_login[".$name.$area1."]" ;
			$item2="bsp_login[".$name.$area2."]" ;
			
			$item =  'bsp_login[add_login]' ;
			$item3 = (!empty($bsp_login['add_login']) ? $bsp_login['add_login'] : '') ;
			//$item1 =  $bsp_login['add_login'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item3, false ) . ' />';
			_e ('Click to activate' , 'bbp-style-pack' ) ;
  			?>
	</td></tr>
	<tr>
			<td></td>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_login[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default "Login" Enter the words you want on the menu item eg "log in", "sign in" etc.', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_login[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default "Logout" Enter the words you want on the menu item eg "Log out", "Sign out" etc.', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
	
	
	
	
<!--only show on bbpress pages ---------------------------------------------------------------------->
	<tr>
	<th colspan="2">2. 
	<?php _e ('You can opt to only show these menu items on forum pages' , 'bbp-style-pack' ) ; ?>
	</th>
	<td colspan="2">
	<?php
			$item =  'bsp_login[only_bbpress]' ;
			$item1 = (!empty($bsp_login['only_bbpress']) ? $bsp_login['only_bbpress'] : '');
			//$item1 =  $bsp_login['only_bbpress'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' />' ;
			_e ('Only show on forum pages' , 'bbp-style-pack' ) ;
  			?>
	</td></tr>

<!--login details ---------------------------------------------------------------------->
			<tr>
			<?php 
			$name = __('Login/logout', 'bbp-style-pack') ;
			$name1 = __('Login page', 'bbp-style-pack') ;
			$name2 = __('Logout page', 'bbp-style-pack') ;
			$name3 = __('Logged in text', 'bbp-style-pack') ;
			$name4 = __('Logged in redirect' , 'bbp-style-pack') ;
			$area1='Login page' ;
			$area2='Logout page' ;
			$area3='Logged in text' ;
			$area4='Logged in redirect' ;
			$item1="bsp_login[".$name.$area1."]" ;
			$item2="bsp_login[".$name.$area2."]" ;
			$item3="bsp_login[".$name.$area3."]" ;
			$item4="bsp_login[".$name.$area4."]" ;
			?>
			<th><?php echo '3.'. $name ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_login[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'You should create a wordpress page with a login shortcode such as [bbp-login] and put the full url in here e.g. http://www.mysite.com/loginpage. If left blank the default wordpress login page will be used.', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_login[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'This will be the url of the page you want users sent to on logout. For example this might be the home page or forums page http://www.mysite.com/home or http://www.mysite.com/forums', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name3 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item3.'" type="text" value="'.esc_html( $bsp_login[$name.$area3] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'If you are using [bbp-login], then users will get "you are already logged in" once they log in.  Maybe change this to something nicer such as "You are currently logged in" ', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr> <td></td> <td>OR </td></tr>
			<tr>
			<td></td>
			<td> <?php echo $name4 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item3.'" class="large-text" name="'.$item4.'" type="text" value="'.esc_html( $bsp_login[$name.$area4] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'If you are using [bbp-login], then if you enter a full url of the page with this shortcode here, users will be redirected to that page instead of getting the "you are already logged in" above', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			
<!--show register to non-logged on users ---------------------------------------------------------------------->			
			<tr>
	<th colspan="2">4. 
	<?php _e ("Show a menu 'Register' item to non-logged in users" , 'bbp-style-pack' ) ; ?></th>
	<td colspan="2">
	<?php
			$item =  'bsp_login[register]' ;
			$item1 = (!empty($bsp_login['register']) ? $bsp_login['register'] : '');
			//$item1 =  $bsp_login['register'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' /> ';
			_e ('Click to activate' , 'bbp-style-pack' ) ;
  			?>
	</td></tr>

	
	
<!--register page ---------------------------------------------------------------------->
			<tr>
			<?php 
			$name = __('Register Page', 'bbp-style-pack') ;
			$name1 = __('Register page', 'bbp-style-pack') ;
			$name2 = __('Menu Item Description', 'bbp-style-pack') ;
			$area1='Register page' ;
			$area2='Menu Item Description' ;
			$item1="bsp_login[".$name.$area1."]" ;
			$item2="bsp_login[".$name.$area2."]" ;
			?>
			<th><?php echo '5.'. $name ?></th>
			<td> <?php echo $name1 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item1.'" class="large-text" name="'.$item1.'" type="text" value="'.esc_html( $bsp_login[$name.$area1] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'You should create a wordpress page with a register shortcode such as [bbp-register] and put the full url in here e.g. http://www.mysite.com/loginpage. If left blank the default wordpress login page will be used.', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
			<tr>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_login[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default "Register" Enter the words you want on the menu item eg "Sign-up", "Join this group" etc.', 'bbp-style-pack' ); ?></label><br/>
			</td>
			</tr>
				
			
			
			
<!--show edit profile to logged on users ---------------------------------------------------------------------->			
			<tr>
	<th colspan="2">6. 
	<?php _e ("Show a menu 'Edit profile' item to logged in users" , 'bbp-style-pack' ) ; ?></th>
	</th>
	<td colspan="2">
	<?php
			$item =  'bsp_login[edit_profile]' ;
			$item1 = (!empty($bsp_login['edit_profile']) ? $bsp_login['edit_profile'] : '');
			//$item1 =  $bsp_login['edit_profile'] ;
			echo '<input name="'.$item.'" id="'.$item.'" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' />';
			_e ('Click to activate' , 'bbp-style-pack' ) ;
  			?>
	</td></tr>
	<!--'edit profile' Description ---------------------------------------------------------------------->
			<tr>
			<?php 
			$name = __('edit profile', 'bbp-style-pack') ;
			$name2 = __('Menu Item Description', 'bbp-style-pack') ;
			$area2='Menu Item Description' ;
			$item2="bsp_login[".$name.$area2."]" ;
			?>
			<td></td>
			<td> <?php echo $name2 ; ?> </td>
			<td>
			<?php echo '<input id="'.$item2.'" class="large-text" name="'.$item2.'" type="text" value="'.esc_html( $bsp_login[$name.$area2] ).'"<br>' ; ?> 
			<label class="description"><?php _e( 'Default "Edit Profile" Enter the words you want on the menu item eg "Edit your Profile", "Change your settings",  etc. ', 'bbp-style-pack' ); ?></label><br/>
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



<?php

function bsp_shortcodes_display() {
 ?>
			
						<table class="form-table">
					
					<tr valign="top">
						<th colspan="2">
						
						<h3>
						<?php _e ('Additional Shortcodes' , 'bbp-style-pack' ) ; ?>
						</h3>


						
<p><tt>[bsp-display-topic-index show='5' forum ='10']</tt> 
<?php _e('Displays the latest topics, optionally from a forum or forums - see below for detailed explanation ', 'bbp-style-pack' ) ; ?>
</p>
<p><tt>[bsp-display-forum-index forum= '2932, 2921' breadcrumb='no' search='no']</tt>  
<?php _e('Displays the selected forum indexes - see below for detailed explanation', 'bbp-style-pack' ) ; ?></p>
<p><tt>[bsp-display-newest-users show = '10']</tt>
<?php _e('Displays the newest users together with their joining date in a table - see below for detailed explanation', 'bbp-style-pack' ) ; ?></p>
<p></p> 						
<h4><span style="color:blue"><?php _e('Display latest Topics', 'bbp-style-pack' ) ; ?></span></h4>

<p>
<?php _e('To change the number of topics displayed and optionally display from a single forum, show stickies, or have just the bare minimum.', 'bbp-style-pack' ) ; ?></p> </p>
</p>


<p><em><?php _e("Note : the 'show' attribute is mandatory, the other attributes are optional", 'bbp-style-pack' ) ; ?></em></p>

<p>
<?php _e("use the shortcode   [bsp-display-topic-index show='5']", 'bbp-style-pack' ) ; ?>
</p>
<p></p>
<p>
<?php _e('where 5 is the number of posts you want to display', 'bbp-style-pack' ) ; ?>
</p>
<p></p>
<p><b>
<?php _e('Optional extras !', 'bbp-style-pack' ) ; ?>
</b></p>
<p></p>
<p><i>
<?php _e('Forum(s)', 'bbp-style-pack' ) ; ?>
</i></p>
</strong></p>
<p><?php _e('You can limit to a single forum or forums', 'bbp-style-pack') ; ?> </p>
<p> <?php _e("Single forum eg [bsp-display-topic-index show='5' forum ='10']", 'bbp-style-pack' ) ; ?> </p>
<p> <?php _e("Several forums  eg [bsp-display-topic-index show='5' forum ='10,11,12']", 'bbp-style-pack' ) ; ?> </p>

<p></p>
<p>
<?php _e("To find the ID of a forum go into dashboard>forums>all forums and hover over the 'edit' of the forum you want to use.", 'bbp-style-pack' ) ; ?>

</p>
<p>
<?php _e('You will see at the bottom of the page  http://www.mysite.com/wp-admin/post.php?post=10&amp;action=edit', 'bbp-style-pack' ) ; ?>

</p>
<p></p>
<p>
<?php _e('where post=10 is the ID number of the forum.', 'bbp-style-pack' ) ; ?>
</p>
<p></p>
<p><i>
<?php _e('Just the header and posts', 'bbp-style-pack' ) ; ?>
</i></p>
<p></strong>
<?php _e("If you don't want the search function and 'viewing topics 1-5'", 'bbp-style-pack' ) ; ?>
</strong></p>
<p></p>
<p>
<?php _e("then use    [bsp-display-topic-index show='5' template ='short']", 'bbp-style-pack' ) ; ?>
</p>
<p></p>
<p><i>
<?php _e('Stickies', 'bbp-style-pack' ) ; ?>
</strong></i></p>
<p>
<?php _e("If you want to show stickies then [bsp-display-topic-index show='5' show_stickies='true']", 'bbp-style-pack' ) ; ?>
</p>
<p></p>
<p><b>
<?php _e('You can use these in any combination', 'bbp-style-pack' ) ; ?>
</b></p>
<p>eg</p>
<p>[bsp-display-topic-index show='6' show_stickies='true']</p>
<p>[bsp-display-topic-index show='6' template = 'short' show_stickies='true']</p>
<p>[bsp-display-topic-index show='5' forum ='10' show_stickies='true' template = 'short']</p>

<h4><span style="color:blue"><?php _e('Display one or more forum indexes ', 'bbp-style-pack' ) ; ?></span></h4>

<p>
<?php _e('To display one or more indexes, or create an index display in any order', 'bbp-style-pack' ) ; ?>
</p>

<p><em>
<?php _e("Note : the 'forum' attribute is mandatory, the other attributes are optional", 'bbp-style-pack' ) ; ?>

</em></p>
<p>
<?php _e("use the shortcode   [bsp-display-forum-index forum= '2932' ] ", 'bbp-style-pack' ) ; ?>
</p> 
<p>
<?php _e("or for a list use [bsp-display-forum-index forum= '2932, 2922, 2921']", 'bbp-style-pack' ) ; ?>

</p>
<p></p>
<p>
<?php _e("where the numbers are the ID's of the forum(s)", 'bbp-style-pack' ) ; ?>

</p>
<p></p>
<p>
<?php _e("To find the ID of a forum go into dashboard>forums>all forums and hover over the 'edit' of the forum you want to use.", 'bbp-style-pack' ) ; ?>

</p>
<p>
<?php _e("You will see at the bottom of the page  http://www.mysite.com/wp-admin/post.php?post=10&amp;action=edit", 'bbp-style-pack' ) ; ?>

</p>
<p></p>
<p>
<?php _e("where post=10 is the ID number of the forum.", 'bbp-style-pack' ) ; ?>

<p></p>
<p><i>
<?php _e('Take out search', 'bbp-style-pack' ) ; ?>

</i></p>
<p></strong>
<?php _e("If you don't want the search function", 'bbp-style-pack' ) ; ?>

</strong></p>
<p></p>
<p>
<?php _e("then use    [bsp-display-forum-index forum= '2932, 2922, 2921' search='no']", 'bbp-style-pack' ) ; ?>

</p>
<p></p>
<p><i>
<?php _e('Breadcrumb', 'bbp-style-pack' ) ; ?>
</strong></i></p>
<p>
<?php _e("If you don't want to show the breadcrumb then [bsp-display-forum-index forum= '11326, 2922, 2921' breadcrumb='no']", 'bbp-style-pack' ) ; ?>

</p>
<p></p>
<p><b>
<?php _e('You can use these in any combination', 'bbp-style-pack' ) ; ?>

</b></p>
<p>
<?php _e('eg', 'bbp-style-pack' ) ; ?>

</p>
<p>[bsp-display-forum-index forum= '2932, 2922, 2921' search='no']</p>
<p>[bsp-display-forum-index forum= '2932' breadcrumb='no' search='no']</p>
<p>[bsp-display-forum-index forum= '2932, 2922, 2921' breadcrumb='no']</p>

<h4><span style="color:blue"><?php _e('Display Newest Users ', 'bbp-style-pack' ) ; ?></span></h4>

<p>
<?php _e('This shortcode displays the newest users together with their joining date in a table.', 'bbp-style-pack' ) ; ?>

 </p>

<p>
<?php _e('use the shortcode   [bsp-display-newest-users]  and it will display the latest 5 users.', 'bbp-style-pack' ) ; ?>
 
</p>
<p>
<?php _e("If you wish to display a different number of users use the 'show' parameter eg", 'bbp-style-pack' ) ; ?>

</p>
<p></p>
<p>[display-newest-users show = '10'] 
<?php _e('will show the latest 10 users', 'bbp-style-pack' ) ; ?>
  
 </p>

 
 <?php
}

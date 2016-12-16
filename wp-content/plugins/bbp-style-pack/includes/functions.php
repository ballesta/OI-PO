<?php

//functions 




global $bsp_forum_display ;
global $bsp_login ;
global $bsp_breadcrumb ;
global $bsp_profile ;

/**********forum list create vertical list************/
function bsp_sub_forum_list($args) {
  $args['separator'] = '<br>';
  return $args;
}

if ( !empty ($bsp_forum_display['forum_list'] ))  {
//if ($bsp_forum_display['forum_list'] == true) {
add_filter('bbp_before_list_forums_parse_args', 'bsp_sub_forum_list' );
}

/**********remove counts*********************/
function bsp_remove_counts($args) {
$args['show_topic_count'] = false;
$args['show_reply_count'] = false;
$args['count_sep'] = '';
 return $args;
}

if ( !empty ($bsp_forum_display['hide_counts'] ))  {
//if ($bsp_forum_display['hide_counts'] == true) {
add_filter('bbp_before_list_forums_parse_args', 'bsp_remove_counts' );
}



/**********removes 'private' and protected prefix for forums ********************/
function bsp_remove_private_title($title) {
	if (is_bbpress()  ) {
	return '%s';
	}
		
}


if ( !empty ($bsp_forum_display['remove_private'] ))  {
//if ($bsp_forum_display['remove_private'] == true  ) {
add_filter('private_title_format', 'bsp_remove_private_title');
}



/**********Create new topic    ********/


function bsp_create_new_topica () {
	global $bsp_forum_display ;
	if (!empty ($bsp_forum_display['Create New Topic Description'])) $text=$bsp_forum_display['Create New Topic Description'] ;
	else $text=__('Create New Topic', 'bbp-style-pack') ;
	if ( bbp_current_user_can_access_create_topic_form() && !bbp_is_forum_category() ) echo '<div style="text-align: center;">  <a href ="#topic">'.$text.'</a></div>' ;
	}
	
	
function bsp_create_new_topicb () {
	echo '<a name="topic"></a>' ;
	}


if ( !empty($bsp_forum_display['create_new_topic'] ) ) {	
//if ($bsp_forum_display['create_new_topic'] == true ) {
add_action ( 'bbp_template_before_single_forum', 'bsp_create_new_topica' ) ;
add_action( 'bbp_theme_before_topic_form', 'bsp_create_new_topicb' ) ;
}


/**********Add forum description    ********/

/** filter to add description after forums titles on forum index */
function bsp_add_display_forum_description() {
    echo '<div class="bsp-forum-content">' ;
    bbp_forum_content() ;
    echo '</div>';
    }
	
	

if ( !empty($bsp_forum_display['add_forum_description'] ) ) {
//if ($bsp_forum_display['add_forum_description'] == true ) {
add_action( 'bbp_template_before_single_forum' , 'bsp_add_display_forum_description' );
}




/**********BSP LOGIN*******************/
		
/**********adds login/logout to menu*******************/
if (!empty ($bsp_login['add_login'] )) {
add_filter( 'wp_nav_menu_items', 'bsp_nav_menu_login_link' );
}

function bsp_nav_menu_login_link($menu) {
	global $bsp_login ;
	if (!empty ($bsp_login['only_bbpress'] )) {
	//if ($bsp_login['only_bbpress'] == true ) {
    if(is_bbpress()) {
    $loginlink = bsp_login() ;
    }
    else {
    $loginlink="" ;
    }
	}
	else {
	$loginlink = bsp_login();
	}
        $menu = $menu . $loginlink ;
        return $menu;
	
}

function bsp_login () {
global $bsp_login ;
if (is_user_logged_in()) {
		if (!empty($bsp_login['Login/logoutLogout page'] )) {
        $url=$bsp_login['Login/logoutLogout page'] ;
		}
		else {
		$url=site_url();
		}		
		$url2=wp_logout_url($url) ;
		//add  menu item name
		$link = (!empty($bsp_login['Add login/logout to menu itemslogout']) ? $bsp_login['Add login/logout to menu itemslogout'] : 'Logout') ;
        $loginlink = '<li><a href="'.$url2.'">'.$link.'</a></li>';
		return $loginlink ;
        }
    else {
        if (!empty($bsp_login['Login/logoutLogin page'] )) {
		$url = $bsp_login['Login/logoutLogin page'] ;
		}
		else {
		$url=site_url().'/wp-login.php' ;
		}
		//add  menu item name
		$link = (!empty($bsp_login['Add login/logout to menu itemslogin']) ? $bsp_login['Add login/logout to menu itemslogin'] : 'Login') ;
		$loginlink = '<li><a href="'.$url.'/">'.$link.'</a></li>';
		return $loginlink ;
		
	}
		
}


if (!empty ($bsp_login['edit_profile'] )) {
add_filter( 'wp_nav_menu_items', 'bsp_edit_profile' );
}

function bsp_edit_profile ($menu) { 
global $bsp_login ;		
if (!is_user_logged_in())
		return $menu;
	else
		$current_user = wp_get_current_user();
		$user=$current_user->user_nicename  ;
		$user_slug =  get_option( '_bbp_user_slug' ) ;
			if (get_option( '_bbp_include_root' ) == true  ) {	
			$forum_slug = get_option( '_bbp_root_slug' ) ;
			$slug = $forum_slug.'/'.$user_slug.'/' ;
			}
			else {
			$slug=$user_slug . '/' ;
			}
			if (!empty($bsp_login['edit profileMenu Item Description'] )) {
			$edit_profile=$bsp_login['edit profileMenu Item Description'] ;
			}
			else $edit_profile = __('Edit Profile', 'bbp-style-pack') ;
			//get url
			$url = get_site_url(); 
			$profilelink = '<li><a href="'. $url .'/' .$slug. $user . '/edit">'.$edit_profile.'</a></li>';
			

			
		$menu = $menu . $profilelink;
		return $menu;
	
}

if (!empty ($bsp_login['register'] ) ) {
add_filter( 'wp_nav_menu_items', 'bsp_register' );
}

function bsp_register ($menu) { 
global $bsp_login ;	
if (is_user_logged_in())
		return $menu;
	else
	$url = $bsp_login['Register PageRegister page'] ;
	if (!empty($bsp_login['Register PageMenu Item Description'] )) {
        $desc=$bsp_login['Register PageMenu Item Description'] ;
		}
	else $desc=__('Register', 'bbp-style-pack') ;
	$registerlink = '<li><a href="'.$url.'">'.$desc.'</a></li>';
	
	$menu = $menu . $registerlink;
		return $menu;
	
}


function bsp_login_redirect ()  {
	global $bsp_login ;	
	//find out whether we need to do a redirect
	
	$login_page = $bsp_login['Login/logoutLogin page'] ;
	$login_redirect = $bsp_login['Login/logoutLogged in redirect'] ; 
	$length1 = strlen ( site_url() ) ;
	$length2 = strlen ( $login_page ) ;
	$loginslug = substr( $login_page, $length1, $length2 ) ;
	//if the page that we're on ($_SERVER['REQUEST_URI']) is the one that is used for login ($loginslug) then we know that it is a redirect from out login not a widget redirect, so can do our redirect
		if ($_SERVER['REQUEST_URI']   ==  $loginslug) {
		$redirect_to = $login_redirect ;
		return $redirect_to ;
		}
	}


if (!empty ($bsp_login['Login/logoutLogged in redirect'] )) {	
add_filter ('bbp_user_login_redirect_to' , 'bsp_login_redirect') ;
}






/**********breadcrumbs    ********/

//no breadcrumbs
function bsp_no_breadcrumb ($param) { 
return true;
}

if ( !empty( $bsp_breadcrumb['no_breadcrumb'] ) ) {
//if ($bsp_breadcrumb['no_breadcrumb'] == true ) {
add_filter ('bbp_no_breadcrumb', 'bsp_no_breadcrumb');
}



function bsp_breadcrumbs ($args) {
	global $bsp_breadcrumb ;
	if ( !empty( $bsp_breadcrumb['no_home_breadcrumb'] ) ) $args['include_home'] = false;
	//if ($bsp_breadcrumb['no_home_breadcrumb'] == true) $args['include_home'] = false;
	if ( !empty( $bsp_breadcrumb['no_root_breadcrumb'] ) ) $args['include_root'] = false;
	//if ($bsp_breadcrumb['no_root_breadcrumb'] == true) $args['include_root'] = false;
	if ( !empty( $bsp_breadcrumb['no_current_breadcrumb'] ) ) $args['include_current'] = false;
	//if ($bsp_breadcrumb['no_current_breadcrumb'] == true) $args['include_current'] = false;
	if (!empty ($bsp_breadcrumb['Breadcrumb HomeText'] )) $args['home_text'] = $bsp_breadcrumb['Breadcrumb HomeText'];
	if (!empty ($bsp_breadcrumb['Breadcrumb RootText'] )) $args['root_text'] = $bsp_breadcrumb['Breadcrumb RootText'];
	if (!empty ($bsp_breadcrumb['Breadcrumb CurrentText'] )) $args['current_text'] = $bsp_breadcrumb['Breadcrumb CurrentText'];
	return $args ;
	
	
}


//add the filter - if no args set then this does nothing
add_filter('bbp_before_get_breadcrumb_parse_args', 'bsp_breadcrumbs');





//This function changes the text wherever it is quoted
function bsp_change_text( $translated_text ) {
global $bsp_login ;
	if ( $translated_text == 'You are already logged in.' ) {
	$translated_text = $bsp_login['Login/logoutLogged in text'];
	}
	return $translated_text;
}

if (!empty ($bsp_login['Login/logoutLogged in text'] )) add_filter( 'gettext', 'bsp_change_text', 20 );



//this function adds the gravatar thingy to the profile page


if (!empty ($bsp_profile['gravatar'] )) {
add_action( 'bbp_user_edit_after_name', 'bsp_mention_gravatar' );
}


function bsp_mention_gravatar() {
global $bsp_profile ;
$label = (!empty($bsp_profile['ProfileGravatar Label']) ? $bsp_profile['ProfileGravatar Label'] : '');
$gdesc = (!empty($bsp_profile['ProfileItem Description']) ? $bsp_profile['ProfileItem Description'] : '');
$gurl = (!empty($bsp_profile['ProfilePage URL']) ? esc_html ($bsp_profile['ProfilePage URL']) : '');
$gurl = '<a href="'.$gurl.'" title="Gravatar">' ;
$gurldesc = (!empty($bsp_profile['ProfileURL Description']) ? esc_html ($bsp_profile['ProfileURL Description']) : '');

?>
<div>

	<label for="bbp-gravatar-notice"><?php echo $label ?></label>
	<fieldset style="width: 60%;">
		<span style="margin-left: 0; width: 100%;" name="bbp-gravatar-notice" class="description"><?php echo $gdesc ?> <?php echo $gurl?> <?php echo $gurldesc ?></a>.</span>
	</fieldset>
</div>

<?php

}





//register the new templates location
//so far this just does files in the templates/templates1 directory - set up to allow other variations and only take live those which you need
if (!empty ($bsp_templates['template1'] )) {
add_action( 'bbp_register_theme_packages', 'bsp_register_plugin_template1' );
}


//get the template path
function bsp_get_template1_path() {
	return BSP_PLUGIN_DIR . '/templates/templates1';
}

function bsp_register_plugin_template1() {
	bbp_register_template_stack( 'bsp_get_template1_path', 12 );
}
	



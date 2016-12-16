<?php
function bbptoolkit_basic_sysinfo() {
	$sysinfo = array();
	
	// wp version
	$newarray = array ( 'WP version' => get_bloginfo('version') );
	$sysinfo = array_merge($sysinfo, $newarray);

	// theme
	$mytheme = wp_get_theme();
	$newarray = array ( 'Theme' => $mytheme["Name"].' '.$mytheme["Version"] );
	$sysinfo = array_merge($sysinfo, $newarray);

	// PHP version
	$newarray = array ( 'PHP version' => phpversion() );
	$sysinfo = array_merge($sysinfo, $newarray);

	// bbpress version
	if (function_exists('bbPress')) {
		$bbp = bbpress();
	} else {
		global $bbp;
	}
	if (isset($bbp->version)) {
		$bbpversion = $bbp->version;
	} else {
		$bbpversion = '???';
	}		
	$newarray = array ( 'bbPress version' => $bbpversion );
	$sysinfo = array_merge($sysinfo, $newarray);

	// site url		
	$newarray = array ( 'site url' => get_bloginfo('url') );
	$sysinfo = array_merge($sysinfo, $newarray);

	// Active plugins
	$newarray = array ( 'Active Plugins' => 'Name and Version' );
	$sysinfo = array_merge($sysinfo, $newarray);
	$plugins=get_plugins();
	$activated_plugins=array();
	$i = 1;
	foreach (get_option('active_plugins') as $p){           
		if(isset($plugins[$p])){
			$linetoadd = $plugins[$p]["Name"] . ' ' . $plugins[$p]["Version"] . '<br>';
			$newarray = array ( '- p'.$i => $linetoadd );
		       	$sysinfo = array_merge($sysinfo, $newarray);
		       	$i = $i + 1;
		}           
	}
	// Return array
	return $sysinfo;
}


?>
<?php
/*
Plugin Name: oi Surveillance
Description: Surveille l'installation web
Version:     1.0
Author:      Bernard BALLESTA
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: OI
*/

defined( 'ABSPATH' ) 
or die( '<h1>Syntaxe programme correcte</h1>'
      . '<h3>vous pouvez intégrer ce plugin dans le site</h3>' );
OI_Surveille::init();

// Classe statique contenant et isolant les extensions propres à l'OI 
class OI_Surveille
{

	// Initialisation
	static function init()
	{
		if (!is_readable('/wp-content/themes/metro/lnc.php' ))
		{
			//echo 'Non lisible: /wp-content/themes/metro/lnc.php';
		
			// die('Non lisible: /wp-content/themes/metro/lnc.php' );
		}
	}
}
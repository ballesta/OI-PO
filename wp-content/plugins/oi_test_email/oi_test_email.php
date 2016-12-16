<?php
/*
Plugin Name: OI test email
Description: Envoie un email à chaque page consultée.
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

OI_test_email::init();

// Classe statique contenant et isolant les extensions propres à l'OI 
class OI_test_email
{

	// Initialisation
	static function init()
	{
		//$r = wp_mail('bernard@ballesta.fr', 'Essais','Essais email');
		//echo "email:$r<hr>";
	}
}	
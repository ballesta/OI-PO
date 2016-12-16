<?php
/*
Plugin Name: OI_event_manager
Description: Evènements avec events manager
Version:     1.0
Author:      Bernard BALLESTA
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: OI
*/

defined( 'ABSPATH' ) 
or die( '<h1>Syntaxe programme correcte</h1>'
      . '<h3>vous pouvez integrer ce plugin dans le site</h3>' );

OI_event_manager::init(); 
 
// Classe statique contenant et isolant les extensions propres à  l'OI 
class OI_event_manager
{

	// Initialisation
	static function init()
	{
		// Ajoute des explications sur le paiement d'un billet par Paypal
		add_action( 'em_booking_form_footer_after_buttons', 
					'OI_event_manager::em_booking_form_footer_after_buttons');	
	}
	
	// Ajoute des explications sur le paiement d'un billet par Paypal
	static function em_booking_form_footer_after_buttons()
	{
		echo "<br>",
			 "Pour régler votre inscription, utilisez le bouton ci-dessus.<br> ",
			 "Vous serez ensuite transféré sur le site PayPal<br>",
			 "pour payer le montant du ticket.<br>", 
			 "<br>",
			 "Le paiement se fera alors par votre <strong>compte PayPal</strong><br>",
			 "ou par votre <strong>Carte Bancaire</strong>.<br>";					
	}
	
} // End class

?>
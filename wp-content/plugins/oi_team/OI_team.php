<?php
/*
Plugin Name: OI_team
Description: Extensions de l'Observatoire de l'immatériel. Objectif: Utilisation du plugin "tlp team" basée sur les données de la table utilisateur.
			 -Maintien la table team (post_type='team') 
			  et utilisateur à jour en parallèle. 
			 -Tout changement sur la table utilisateurs 
			  est propagé immédiatement dans la table team 
Version:     1.0
Author:      Bernard BALLESTA
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: OI
*/

defined( 'ABSPATH' ) 
or die( '<h2>Syntaxe plugin correcte</h2>'
      . '<h3>vous pouvez integrer le plugin "OI_team" dans le site</h3>' );
 
OI_team::init();

// Classe statique contenant et isolant les extensions propres à l'OI 
class OI_team
{

	// Initialisation
	static function init()
	{
		add_action( 'profile_update', 'OI_team::user_profile_update', 10, 2 );

		//add_action( 'profile_update', 'user_profile_update', 10, 2 );
	}
	
    static function user_profile_update( $user_id, $old_user_data ) 
	{
	    echo $user_id, '<br>';
		echo 'Old:<br>';
        OI::affiche($old_user_data);
		echo 'get_userdata:<br>';
		OI::affiche(get_userdata( $user_id ));
		echo 'get_usermeta:<br>';
		OI::affiche(get_user_meta( $user_id ));
		//die("++++++++++++"); 
	}
}

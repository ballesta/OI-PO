<?php
/*
Plugin Name: observatoire_immateriel
Description: Forcer les roles utilisateurs.
			 -Problème à résoudre: Les utilsateurs ayant le rol "Membre bureau"
			  n'apparaissent pas dans la liste des auteurs d'un éditorial.
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

//Forcer_Roles::init();

// Classe statique contenant et isolant les extensions propres à l'OI 
class Forcer_Roles
{
	// Initialisation
	static function init()
	{
		// Get all users
		$users = get_users();
		$r = '';
		foreach ( $users as $user ) 
		{
			// Define user level by user role
			//OI::affiche($user);
			//echo $user->display_name . ':' . array_shift( $user->roles ) . '<br>';
			$role = array_shift( $user->roles );
			switch ( $role ) {			
				case 'administrator':
					$user_level = 10;
					break;
				case 'editor':
					$user_level = 7;
					break;
				case 'author':
				case 'Administrateur Métier':
					$user_level = 2;
					break;
				case 'contributor':
				case 'membre':
				case 'membre-bureau':
					$user_level = 1;
					break;
				case 'subscriber':
				case 'autres_visiteurs':
					$user_level = 0;
					break;				
				default:
			        echo  $user->display_name . ':' . $role . '---->Inconnu'. '<br>';
					$user_level = -1;
			}

			If ($user_level >= 0):
				// Update user level
				update_user_meta( $user->ID, 'wp_user_level', $user_level );
			endif;	
		}
	}
} // Class	
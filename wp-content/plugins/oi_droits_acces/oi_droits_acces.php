<?php
/*
Plugin Name: Droits d'accès aux pages
Description: Filtre les pages pour les membres
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

OI_droits_acces::init();

// Classe statique contenant et isolant les extensions propres à l'OI 
class OI_droits_acces
{

	// Initialisation
	static function init()
	{
		session_start();
	}

	static function verifie_droits_acces() 
	{
		global $post; 
		//OI::affiche($post,'Post');
		$nom_page=$post->post_name; // Remonté
		$reserve_aux_membres = get_field('reserve_aux_membres');
		//OI::affiche($reserve_aux_membres,'reserve_aux_membres');
		if ($reserve_aux_membres)
		{
			self::connecte_avec_role(
			                 ['administrator',
							  'author',
							  'membre',
				              'membre-bureau' // Suite au bug découvert par PO
			                 ],
							 "Informations réservées aux membres de l'OI",
							 "Membre adhérent",
							 '/acces-restreint',
							 $nom_page);
		}
		$uri = $_SERVER['REQUEST_URI'];
        //echo $nom_page, '<hr>'; exit();
        //echo $uri, '<hr>';
		if (isset($_SESSION['Page']))
			$_SESSION['Page_appelante'] = $_SESSION['Page'];
		$_SESSION['Page'] = $uri;
		//OI::affiche($_SESSION, 'Variables Session');  
		switch ($nom_page):
		case 'annuaire-des-membres':
		    self::connecte_avec_role(['administrator',
									  'author',
									  'membre'
								     ],
									 "Annuaire des adhérents",
									 "Membre adhérent",
									 '/acces-restreint',
									 $nom_page);
			break;		
		case 'plateforme-echange-adherents':
		    self::connecte_avec_role(['administrator',
									  'author',
									  'membre',
									  'membre-bureau'
								     ],
									 "Plateforme d'échange entre adhérents",
									 "Membre adhérent",
									 '/acces-restreint',
									 $nom_page);
			break; 
		case 'action-collective-dge':
		case 'methode':
			// Page "Action collective DGE"
			if(!is_user_logged_in()):
				// Utilisateur non connecté: 
				//	  	lui demander de se connecter ou de s'enregistrer 
				// 		s'il n'a pas encore de compte chez nous
				wp_redirect( home_url() 
				           . "/connexion-ou-inscription?original-page=$nom_page"
						   );
				exit; 
			endif;	
			break;
			
		case 'plateforme-echange-groupes-travail': 
			self::acces_groupes_de_travail($nom_page);
			// Retour si Connecté 
			//        et Inscrit à au moins 1 groupe de travail.
			// Accès accordé.
			break; 
		case 'general':
		    //echo 'cas: groupes-de-travail<br>';
			self::acces_groupes_de_travail($nom_page);
			// Retour si Connecté 
			//        et Inscrit à au moins 1 groupe de travail.
			// Accès accordé.
			break; 		

		default:
		    $debut = '/forum/groupes-travail/general/';
		    if (self::commence_par($uri, $debut)):
				// Voir si inscrit au groupe de travail 
				// echo "Cas: groupe $nom_page<hr>";
				$groupe_travail = substr($uri, strlen($debut));
				//echo "Groupe $groupe_travail<hr>";
				self::inscrit_a_groupe_de_travail($nom_page);
			endif;
			break; 
		endswitch;
	}

	static function commence_par($uri, $debut)
	{
		return  (strrpos($uri, $debut, -strlen($uri)) !== FALSE);
	}

	// Vérifie si connecté et inscrit au groupe de travail demandé
	static function inscrit_a_groupe_de_travail($groupe_de_travail)
	{
		if(!is_user_logged_in()):
			// Utilisateur non connecté: 
			//	  	lui demander de se connecter ou de s'enregistrer 
			// 		s'il n'a pas encore de compte chez nous
			wp_redirect( home_url() 
					   . "/connexion-ou-inscription"
					   . "?original-page=$nom_page" ); 
			exit;             
		else:			
			// Connecté, peu importe son rôle.
			// Voir s'il est incrit dans un groupe de travail
			$user = wp_get_current_user();
			// Voir s'il est inscrit au groupe de travail
			if (self::utilisateur_inscrit_a_groupe_de_travail($user, $groupe_de_travail)): 
				// Inscrit à au moins 1 groupe de travail: laisse passer
			else:
				// Pas Inscrit au groupe de travail
				wp_redirect( home_url() 
						   . "/inscription-groupe-travail-requise"
						   . "?original-page=$nom_page" ); 
				exit;             
			endif;
		endif;
		// Connecté et Inscrit à au moins 1 groupe de travail
		return true;	
	}
	
	static function acces_groupes_de_travail($nom_page)
	{
		if(!is_user_logged_in()):
			// Utilisateur non connecté: 
			//	  	lui demander de se connecter ou de s'enregistrer 
			// 		s'il n'a pas encore de compte chez nous
			wp_redirect( home_url() 
					   . "/connexion-ou-inscription"
					   . "?original-page=$nom_page" ); 
			exit;             
		else:			
			// Connecté, peu importe son rôle.
			// Voir s'il est incrit dans un groupe de travail
			$user = wp_get_current_user();
			// Voir s'il est membre d'au moins un groupe de travail
			//OI::affiche($user); die();
			if (self::inscrit_a_des_groupes_de_travail($user)): 
				// Inscrit à au moins 1 groupe de travail
			else:
				// Inscrit à aucun groupe de travail
				wp_redirect( home_url() 
						   . "/inscription-aucun-groupe-travail"
						   . "?original-page=$nom_page" ); 
				exit;             
			endif;
		endif;
		// Connecté et Inscrit à au moins 1 groupe de travail
		return true;	
	}

	static function connecte_avec_role($doit_avoir_role,
									   $contenu,	
									   $role_demande,
	                                   $redirection,
									   $nom_page)
	{	
	    $contenu = urlencode($contenu);
	    $role_demande = urlencode($role_demande);
		if(is_user_logged_in()):
			// Connecté
			$user = wp_get_current_user();
			$a_les_droits = false;
			//OI::affiche($user->roles);
			foreach ($user->roles as $role ):
				if (in_array($role, $doit_avoir_role)):
					$a_les_droits = true;
					break;
				endif;	
			endforeach;
			if (!$a_les_droits):
				wp_redirect( home_url() 
						   . '/acces-restreint'
						   . "?contenu=$contenu"
						   . "&role_demande=$role_demande"
						   . "&original-page=$nom_page"
						   ); 
				exit; 	// <==
			endif;
		else:
			// Non connecté
			wp_redirect( home_url() 
			           . '/connexion-ou-inscription' 
					   . "?contenu=$contenu"
					   . "&role_demande=$role_demande"
					   . "&original-page=$nom_page"
					   ); 
			exit; 	// <==
		endif;
		return true;
	}
	
	// Vérifie si l'utilisateur connecté est incrit à au moins un groupe de travail
	// Renvoie vrai si inscrit.
	static function inscrit_a_des_groupes_de_travail($user)
	{
	    $user_id = $user->ID;
		//OI::affiche($user_id, "user_id");
		$groupes = get_field('groupes_de_travail', "user_$user_id");
		//OI::affiche($groupes, "Inscrit aux Groupes");
		if( $groupes ): 
			$inscrit = true;
		else:
			$inscrit = false;
		endif;	
		return $inscrit;
	}

	static function utilisateur_inscrit_a_groupe_de_travail($user, $groupe_de_travail)
	{
	    $user_id = $user->ID;
		//OI::affiche($user_id, "user_id");
		$groupes = get_field('groupes_de_travail', "user_$user_id");
		//OI::affiche($groupes, "Inscrit aux Groupes");
		$inscrit = false;
		foreach ($groupes as $g ): 
			if ($g->post_name == $groupe_de_travail):
				$inscrit = true;
				break;
			endif;
		endforeach;	
		return $inscrit;
	}	
}

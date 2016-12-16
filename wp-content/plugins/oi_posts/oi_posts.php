<?php
/*
Plugin Name: OI_Posts
Description: Lecture des posts avec filtre taxonomie et catégories
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

OI_Posts::init(); 
 
// Classe statique contenant et isolant les extensions propres à  l'OI 
class OI_Posts
{

// Initialisation
static function init()
{
	// Ajoute les Liens et Livrables
	add_filter ('the_content', 'OI_Posts::traite');	
}

static function traite($content)

{
    global $post;
    //OI::affiche($post); //die();
	//if (self::contenu_accessible())
	//{
		//$exclure_posts_types = ['page','homepage'];
        //if (!in_array($post->post_type, $exclure_posts_types)):
        //if (in_array($post->post_type, ['video-et-podcast'])):
        if (is_single()):
			//OI::affiche($content, "Contenu post"); //die();
		    //$content .= '<br>post/post_type: ' . $post->post_type . '<br>';
			$content = self::ajoute_liens_et_livrables($content, $post->ID);
			$content = self::auteurs($content);
		    $content = '<p align="right">' . $content . '</p>'; 
		endif;	
	//}
	//else
	//{
	//	// Ce Contenu est réservé aux membres. 
	//	// qui doivent être inscrit et connecté pour le voir.
	//	// Redirection vers la page explicant à l'utilisateur 
	//	// qu'il n'a pas le droit de voir.
	//	// <!=========================================!> //
	//	// echo 'Ce Contenu est réservé aux membres - ', __FILE__; die();
	//	wp_redirect( home_url() . '/acces-restreint' ); 
	//	// <!=========================================!> //
	//	exit; 	// Pas de retour de la fonction
	//}	
	return $content;
}

// Si le contenu limité aux membres:
//		renvoie  vers la page '/acces-restreint'
//  	qui indique que le contenu réservé aux membres et invite à devenir memebre.
// 07/03/2015 OBSOLETE? ==> Voir oi_droits_access() 
static function contenu_accessible()
{
	// Voir si contenu limité aux membres
	$reserve_aux_membres = get_field('reserve_aux_membres');
	if ($reserve_aux_membres == 1):
		// See: https://wordpress.org/support/topic/how-to-get-the-current-logged-in-users-role?replies=10
		$current_user = wp_get_current_user();
		$roles = $current_user->roles;
		// +++++ vérifier role membre
		if (count($roles) == 0) :
			$droit_acces = false;
			// Ce Contenu est réservé aux membres. 
			// qui doivent être inscrit et connecté pour le voir.
			// Redirection vers la page explicant à l'utilisateur 
			// qu'il n'a pas le droit de voir.
			// <!=========================================!> //
			// echo 'Ce Contenu est réservé aux membres - ', __FILE__; 
			die();
			wp_redirect( home_url() . '/acces-restreint' ); 
			// <!=========================================!> //
			exit; 	// Pas de retour de la fonction

		else:
			$droit_acces = true;
		endif;
	else:
		$droit_acces = true;				
	endif;	
	return $droit_acces;
}
	
// Vérifie que l'utilisateur courant peut voir le post.	
// Ajoute des champs supplémentaires à la fin du contenu du post.
//static function affiche_champs_supplementaires($content)
//{	
//	$content = self::ajoute_liens_et_livrables($content);
//	return $content;
//}
	
	
// Ajoute Liens et Livrables à la fin du contenu d'un post.
static function ajoute_liens_et_livrables($content, $post_id)
{
	// Liens
	$liens = get_field('liens', $post_id);
	$liens_remplis=false;
	if ($liens)
	{
		foreach($liens as $lien)
		{
			if ($lien['lien_en_clair'] != '')
			{
				$liens_remplis=true;
				break;
			}
		}
		if($liens_remplis)
		{
			$content .= '<br><hr><h4>Liens:</h4>';
			$content .= '<ul>';             
			foreach($liens as $lien)
			{
				//OI::affiche($lien);
				$content .='<li>' 
						 . '    <a href="' . $lien['lien'] . '"'  
						 . '       target=_blank>'
						 .            $lien['lien_en_clair']
						 . '    </a>'
						 . '</li>';
			}
			$content .= '</ul>';
		}
	}
	
	// Livrables
	$livrables = get_field('livrables', $post_id);
	//OI::affiche($livrables,'Livrables');
	//echo count($livrables), '<hr>';
	if ($livrables)
	{
		$livrables_remplis=false;
		foreach($livrables as $livrable)
		{
			//OI::affiche($livrable,'Livrable');
			
			if (isset($livrable['livrable']['url']))
			{
				$livrables_remplis=true;
				break;
			}
		}	
		if($livrables_remplis)
		{
			$content .= '<hr><h4>Livrables:</h4>';
			$content .= '<ul>';
			foreach($livrables as $livrable)
			{
				$l = $livrable['livrable'];		
				// Livrable vide?	
				if (isset($l['url'])):
					$content .='<li>' 
							 . '    <a href="' . $l['url'] . '"'  
							 . '       target=_blank>'
							 .            $l['title']
							 . '    </a>'
							 . '</li>';
				endif;		 
			}
			$content .= '</ul>';
		}
    }	
	// Video
	$video = get_field('url_de_la_video', $post_id);
	if($video)
	{
		//OI::affiche($videos); die();
		$bouton_voir_video=
				 '<p style="text-align: center;">'
				.	'[button href="' . $video . '" '  
				.          'target="_blank" '
				.	       'size="large" '
				.	       'textcolor="#ffffff" ' 
				.	       'target="_blank" ' 
				.	       'tooltip=""]'
				.	    "Voir la vidéo"
				.	'[/button]'
				.'</p>';
			$content .= $bouton_voir_video;	 
	}
	return $content;
}

static function auteurs($content)
{		
	// Auteur du site
	$auteur_inscrit_sur_le_site = get_field('auteur_inscrit_sur_le_site');
	$r = '';
	if($auteur_inscrit_sur_le_site)
	{
		//OI::affiche($auteur_inscrit_sur_le_site);
		echo '<hr>';
		$r .= ''    // [one_third]'
		   .  '<center>' 
		   .  '    Auteur (inscrit sur le site) : ' 
		   .  '   <strong>' 
		   .           $auteur_inscrit_sur_le_site[display_name] 
		   .  '   </strong>' 
		   .  '   <br>'
		   .  '   <br>'
		   .      $auteur_inscrit_sur_le_site[user_avatar] . '<br>'
		   .  '</center>' 
		   .  '<br>'
		   ;
		//echo do_shortcode($r);
	}
	
	// Membre de l'OI
	$auteurs_membre = get_field('auteur_membre');
	//OI::affiche($auteurs_membre,'Membre');
	if($auteurs_membre)
	{
		$r .= '<hr>';
		$auteur_membre = $auteurs_membre[0];
		//OI::affiche($auteur_membre);
		$r .= ''    
		   .  '<center>' 
		   .  '   Auteur (Membre de l\'OI): ' 
		   .  '   <strong>' 
		   .          $auteur_membre->post_title 
		   .  '   </strong>' 
		   .  '</center>' 
		   .  '<br>'
		   ;
		//echo do_shortcode($r);
	}
	
	// Auteur externe à l'OI
	$auteur_externe = get_field('auteur_externe');
	//OI::affiche($auteurs_membre,'Membre');
	if($auteur_externe)
	{
		$r .= '<hr>';
		//OI::affiche($auteur_membre);
		$r .= '<center>' 
		   .  '   Auteur (Externe à l\'OI): '
		   .  '   <strong>' 
		   .           $auteur_externe 
		   .  '   </strong>'
		   .  '   <br>'
		   .  '</center>' 
		   ;
		//echo do_shortcode($r);
	}
	$content .= $r;
	return $content;
}

// Renvoie une liste de post.
// Utilisé pour récupérer les posts avant de les afficher. 
public static function lis_posts
						(
						 $type = 'post',			// Type du post à renvoyer
						 $taxonomie = '',           // Taxonomie 
						 $categorie_id_or_slug = '',// Categorie dans taxonomie
						 $classe_par='post_date',	// Classement par le champ
						 $sens='DESC',				//     Ascendant ou descendant
						 $combien = 100, 	    	// Nombre de post à renvoyer
						 $champ_meta=''				// Utilisation champs méta pour tri
  					    ) 	
{
	//echo '<hr>lis_posts'; 
	// Complète les autres paramètres	
	$args_fixes = 
	[
		'numberposts' 		=> $combien,	// Paramètre
		'offset'			=> 0,
		'orderby' 			=> $classe_par,  	// Paramètre
		'order' 			=> $sens,
		'include' 			=> '',
		'exclude' 			=> '',
		'meta_key' 			=> '',
		'meta_value' 		=> '',
		'post_type' 		=> $type,		// Paramètre
		'post_status' 		=> 'publish',
		'suppress_filters' 	=> true 
	]; 
	
	// Remplis les paramètres optionels
	$args_optionnels = [];
	if ($taxonomie != '' )
	{
		// Filtre sur la taxonomie/categorie
		//echo $categorie_id_or_slug, '<br>';
		if ( is_numeric($categorie_id_or_slug )):
			$field = 'term_id';
		else:
			$field = 'slug';
		endif;
		$args_optionnels['tax_query'] = array(
											array(
											'taxonomy' 	=> $taxonomie,
											'field' 	=> $field,
											'terms' 	=> $categorie_id_or_slug
										));
	}
	
	if ($champ_meta != ''	):
		$args_fixes['meta_key'  ] = $champ_meta;  
		$args_fixes['meta_value'] = '';
		
	endif;
	
	$args_tous = array_merge($args_fixes, $args_optionnels);
	//OI::affiche($args_tous, "args_tous");
	
	
	//OI::affiche($args_tous);
	$recent_posts = wp_get_recent_posts( $args_tous, ARRAY_A );
	//echo 'Nombre de posts: ', count($recent_posts),'<br>';
	//OI::affiche($recent_posts, "Sujets DGE");
	//die();
	
	return $recent_posts;
}
} // Class

?>
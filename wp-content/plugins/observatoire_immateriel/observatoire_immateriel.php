<?php
/*
Plugin Name: observatoire_immateriel
Description: Extensions de l'Observatoire de l'immatériel
			 -Objectif: ne pas rajouter le code dans le fichier functions.php du thème
			  afin de pouvoir mettre à jour les versions du thème et de 
			  transférer le code de la version locale à la version hébergée.
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
OI::init();

// Classe statique contenant et isolant les extensions propres à l'OI 
class OI
{

// Initialisation
static function init()
{
	// Ajoute les shortcodes
	self::add_shortcode( 'affiche_dernier_editorial'   			 );
	self::add_shortcode( 'affiche_actualites'          			 );
	self::add_shortcode( 'affiche_logos_membres'       			 );
	self::add_shortcode( 'affiche_logos_partenaires'   			 );
	self::add_shortcode( 'affiche_logos_membres_pour_1_categorie');
	self::add_shortcode( 'affiche_sujets_dge'                    );
	self::add_shortcode( 'affiche_publications_membres'			 );
	self::add_shortcode( 'affiche_en_savoir_plus'      			 );
	self::add_shortcode( 'affiche_un_seul_contenu'     			 );
	self::add_shortcode( 'affiche_un_seul_contenu_detaille'      );
	self::add_shortcode( 'affiche_un_seul_contenu_reactif'       );	
	self::add_shortcode( 'affiche_les_10_types_d_ai'             );
	self::add_shortcode( 'affiche_photo_prochain_evenement'      );
	self::add_shortcode( 'affiche_evenements_a_venir'            );
	self::add_shortcode( 'affiche_evenements_passes'             );
	self::add_shortcode( 'affiche_methodologies_methodes'        );
	self::add_shortcode( 'affiche_derniere_video_ou_podcast'     );
	self::add_shortcode( 'affiche_videos_et_podscasts'           );
	self::add_shortcode( 'affiche_dernieres_videos'              );
	self::add_shortcode( 'affiche_derniers_podcasts'             );
	self::add_shortcode( 'affiche_dernieres_videos_et_podcasts'  );
	self::add_shortcode( 'modification'            				 );
	self::add_shortcode( 'ajout'            					 );
	self::add_shortcode( 'admin'            					 );
	self::add_shortcode( 'affiche_diaporama'                     );
	self::add_shortcode( 'affiche_liens_slogan'                  );
	self::add_shortcode( 'affiche_membres_bureau'                );
	self::add_shortcode( 'affiche_college_experts'               );
	self::add_shortcode( 'admins_seulement'                      );
  //self::add_shortcode( 'admins_membres_seulement'              );

	// Force le traitement des shortcodes
	add_filter( 'the_content', 'shortcode_unautop');
    add_filter( 'the_content', 'do_shortcode');	
	
	// Ajoute éditeur visuel à bbpress
	add_filter( 'bbp_after_get_the_content_parse_args', 'OI::bbp_enable_visual_editor' );

	// Ajoute le déclenchement du filtre d'actualités sur la page d'accueil
	// add_filter('query_vars', 'OI::ajoute_filtre_actualites');
	// Réglé par "[search-form id="actualites" showall="1"]"
	//                                         -----------
	
	self::ajoute_sidebar('Actualité','Actualités','actualite');
	
	// Caroussel: paramètres shortcode sous forme de tableau
	add_action( 'wpc_before_item_content', 
				'OI::wpc_before_item_content_action', 
				$priority=10, 
				$accepted_args=1 );	

	// Caroussel: change url vers site membre
	add_filter( 'wpc_item_featured_image', 
	            'OI::wpc_item_featured_image',
				10,
				2
				);

	// Ajoute le lien vers l'admin du conteneur
	add_filter ('the_content', 'OI::ajoute_admin');		
	
	// Ajoute les Liens et Livrables
	// add_filter ('the_content', 'OI::ajoute_liens_et_livrables');		



	// Types: Access type 
	//     Change user permissions for roles created by other plugins
	define('WP_ACCESS_ADVANCED', true);	 
			
}

// Contenu réservé aux admin et admin_métier.
// Pour interdire temporairement l'accès au bouton de la plateforme
// à partir de la page d'accueil.
static function  admins_seulement($atts, $content)
{
	$r = ''; // Contenu vide à inclure si non admin ou admin_métier
	if (is_user_logged_in()):
		// Connecté, voir si role admin et admin_métier
		$user = wp_get_current_user();
		//OI::affiche((array) $user->roles, 'Roles');
		if (   in_array( 'administrator', (array) $user->roles)
			|| in_array( 'author'       , (array) $user->roles)):
			//The user is admin, include content
			$r = $content;
       endif;		
	endif;
	return do_shortcode($r);	
}

// Ajoute sidebar 
static function ajoute_sidebar($nom_singulier,
							   $nom_pluriel,
							   $identifiant) 
{
	register_sidebar(array(
		'id' => "sidebar-$identifiant", 						 // identifiant
		'name' => "Sidebar $nom_singulier", 					 // Nom a afficher dans le tableau de bord
		'description' => "Sidebar pour les fiches $nom_pluriel.",// description facultatif
		'before_widget' => '<li id="%1$s" class="widget %2$s">', // class attribuer pour le contenu (css)
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">', 			 // class attribuer  pour le titre (css)
		'after_title' => '</h2>',
	));
}

/*
static function ajoute_liens_et_livrables($content)
{
    $content .= "------ajoute_liens_et_livrables-------<br>";
	// Liens et Livrables
	$liens = get_field('liens');
	if($liens)
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
	$livrables = get_field('livrables');
	if($livrables)
	{
		$content .= '<hr><h4>Livrables:</h4>';
		$content .= '<ul>';
		foreach($livrables as $livrable)
		{
			$l = $livrable['livrable'];						
			$content .='<li>' 
					 . '    <a href="' . $l['url'] . '"'  
					 . '       target=_blank>'
					 .            $l['title']
					 . '    </a>'
					 . '</li>';
		}
		$content .= '</ul>';
	}
   return $content;
}
*/

// Ajoute le déclenchement du filtre d'actualités sur la page d'accueil
static function ajoute_filtre_actualites($aVars) 
{
	$aVars[] = '#sf-{"search-id":"actualites"}'; 
	self::affiche($aVars);
	return $aVars;
}

// Ajoute éditeur visuel à bbpress
static function bbp_enable_visual_editor( $args = array() ) {
    $args['tinymce'] = true;
	$args['teeny'] = false;
    return $args;
} 
 
// Ajoute un short code. 
static function add_shortcode($nom_shortcode, $plugin='OI')
{

	$nom = 'oi_' . $nom_shortcode;           	// Préfixe par 'oi_'
	$fonction = $plugin . '::'. $nom_shortcode; // Fonction statique dans la classe OI
	// echo "$nom ==> $fonction<br>";
	add_shortcode( $nom, $fonction);
}
	
// Caroussel: change url vers site membre
static function wpc_before_item_content_action($params)
{
		// self::affiche($params);die();
}

// Url vers site membre
static function wpc_item_featured_image($featured_image, $params)
{
	//echo htmlspecialchars($featured_image);
	//self::affiche($params);die();
	$post_id = $params['post']->ID;
	$lien_site_membre = self::lis_champ($post_id,'url-site-web');
	$fichier_image = $params['image'];
	$image = '<div class="wp-posts-carousel-image"> '
	       . '	  <a href="' . $lien_site_membre .'" ' 
		   . '       title="Site internet de notre membre ou partenaire"'
		   . '       target="_blank"'
		   . '    > '
	       . '		 <img style="max-width:100%;max-height:100%" ' 
	       . '			 data-src="' . $fichier_image . '" ' 
	       . '			 data-src-retina="' . $fichier_image . '" '
	       . '			 class="owl-lazy"> '
	       . '	  </a> '
	       . '</div> ';
	return $image;   
}

//=====================================================
static function affiche_photo_prochain_evenement()
{
	// Voir si un évènement à venir 
	$evenement_a_venir 
	= EM_Events::get([
						'scope'=>"future",
						'limit'=>"1"
					 ]);
	//OI::affiche($evenement, "evenement");
	if (count($evenement_a_venir) == 1):
		// Présence d'un Evènement à venir: l'afficher
		$r  = '[events_list scope="future" limit="1" ]'
			. '		#_EVENTIMAGE                      '
			. '[/events_list]                         '
			;
	else:
		// Aucun evènement à venir: 
		//   voir si dernier evènement à la place
		$dernier_evenement_passe 
		= EM_Events::get(['scope'   => "past",
						  'orderby' => "event_start_date",
						  'order'   => 'DESC',
						  'limit'   => "1"]);
		//OI::affiche($evenement, "dernier evenement passés");
		if (count($dernier_evenement_passe) == 1):
			// Dernier evènement passé
			$r  = '[events_list 						'
			    . '      scope   = "past" 				'
				. '      limit   = "1" 					'
				. '      orderby = "event_start_date" 	'
				. '      order   = "DESC" 				'
				. ']									'
				. '		#_EVENTIMAGE                    '
				. '[/events_list]                       '
				;
		else:
			$r = '<h2>Aucun evènement à afficher</h2>';
		endif;
	endif;
	
	return do_shortcode($r);	
	
	
}

static function affiche_evenements_a_venir()
{
$r  = '[events_list scope="future"]                          		'
    . '	[one_fifth]                                          		'
    . '		#_EVENTIMAGE                                     		'
    . '	[/one_fifth]                                         		'
    . '	[one_fifth]                                          		'
    . '		<h4>#_EVENTLINK</h4>                             		'
    . '		#_ATT{Organisateur}                              		'
    . '		#_EVENTDATES   <br>                              		'
    . '		#_LOCATIONTOWN <br>                              		'
    . '	[/one_fifth]                                         		'
    . '	[two_fifth]                                          		'
    . '		#_EVENTEXCERPT                                   		'
    . '	[/two_fifth]                                         		'
    . '	[one_fifth_last]   											'
    //. '	    #_EVENTPRICERANGEALL                       				'
    //. '		#_BOOKINGBUTTON                        					'
    . '		[button href="#_EVENTURL"                        		'
    . '				size="large"                            		'
    . '				textcolor="#ffffff"                      		'
    . '				target="_blank"                          		'
    . '				tooltip="Inscrivez vous à cet évènement"]		'
    . '			Je m\'inscris                                		' 
    . '		[/button]                                        		'
    . '		[oi_modification 								 		'
	. '      url="/wp-admin/post.php?post=#_EVENTPOSTID&action=edit"]'
    . '	[/one_fifth_last]                                    		'
    . '	<hr>                                                 		'
    . '[/events_list]                                        		'
	. '		[oi_ajout 						  		         		'
	. '      url="/wp-admin/post-new.php?post_type=event"]   		'
	;
	return do_shortcode($r);	
}

static function affiche_evenements_passes()
{
$r  = '[events_list scope="past" order="DESC" ]                                        '
    . '	[one_fifth]                                          '
    . '		#_EVENTIMAGE                                     '
    . '	[/one_fifth]                                         '
    . '	[one_fifth]                                          '
    . '		<h4>#_EVENTLINK</h4>                              '
    . '		#_EVENTDATES   <br>                              '
    . '		#_LOCATIONTOWN <br>                              '
    . '	[/one_fifth]                                         '
    . '	[two_fifth]                                          '
    . '		#_EVENTEXCERPT                                   '
    . '	[/two_fifth]                                         '
    . '	[one_fifth_last]                                     '
    . '		<h4>Inscriptions closes</h4>                     '
    . '		[oi_modification 						  		 '
	. '      url="/wp-admin/post.php                         '
	. '                    ?post=#_EVENTPOSTID&action=edit"] '
    . '	[/one_fifth_last]                                    '
    . '	<hr>                                                 '
    . '[/events_list]                                        '
	;

	return do_shortcode($r);	
}


// Utilisé par la page d'accueil pour afficher le dernier édito.
// Shortcode: [oi_affiche_dernier_editorial]
static function   affiche_dernier_editorial($parametres)
{
    //echo '<hr>';
	$detail = 0;
    if (is_array($parametres)):
		// Paramètres
		$defauts = 	[ 	
					'detail' => 0
					];
		// Transforme le tableau en variables			
		extract($defauts); 	
		extract($parametres); 
	endif;
	//echo $detail;
	$recent_posts = OI_Posts::lis_posts
						(
						 $type = 'editorial' , 
						 $taxonomie = '',           // Taxonomie 
						 $categorie = '',			// Categorie dans taxonomie
						 $classe_par='post_date',	// Classement par le champ
						 $sens='DESC',				//     Ascendant ou descendant
						 $combien = 1   		    // Nombre de post à renvoyer
						);
	// self::affiche($recent_posts, 'Editoriaux');	 
	// Un seul éditorial renvoyé (le dernier)
	foreach( $recent_posts as $recent )
	{	
		// self::affiche($recent);	
		// Le résultat 	
		$r = '';
		
	    $post_id = $recent["ID"];
		
		// Photo de l'auteur de l'éditorial
		$auteur = $recent[post_author];
		$attributes['align'] = "left";
		$attributes['style'] = "margin-right:10px";
		$photo = userphoto__get_userphoto
					($auteur, 
					 USERPHOTO_FULL_SIZE, 
					 $before = '',
					 $after = '', 
					 $attributes, 
					 $default_src = '');
		$photo_et_nom_auteur = '<figure style="margin-left:0px;">'
							. '   <figcaption>'
							. '       Par '
							. '       <strong>' 
							.            get_the_author_meta('display_name' , $auteur) 
							. '       </strong>'
							. '   </figcaption>'
							.     $photo
							. '</figure>';	
		$r .= $photo_et_nom_auteur;

		// Titre
		//$r .= '<center>';
		//$lien = get_permalink($recent["ID"]);
		$lien = "/editoriaux";
		$titre = '<h1>'
			   .  '<a href="' . $lien . '" target="_blank">' 
			   .   	$recent["post_title"]
			   .  '</a>'
			   . '</h1>';
		$r .= $titre;	   
			   
		if ($detail == 1):
			// 'full'
			$image_a_la_une = get_the_post_thumbnail( $post_id, 'large' ); 
		    $r .= '<center>';	   
			$r .=  $image_a_la_une ;
		    $r .= '</center>';	   
		    $r .= '<hr>';
			$contenu = $recent['post_content'];
			$contenu = apply_filters( 'the_content', $contenu );
		else:
			$contenu = $recent['post_excerpt'];
		endif;	
		$r .= $contenu;
        if ($detail == 1):
		    $r = OI_Posts::ajoute_liens_et_livrables($r, $post_id);
		endif;
		// [one_third_last][/one_third_last]
		// Bouton "Détail de l'édito"
		if ( $detail == 0): 
			$bouton_detail=
				 '<p style="text-align: left;">'
				//.	'[button href="' . $lien .'" '
				.	'[button href="/editoriaux" ' 
				.          'target="_blank" '
				.	       'size="large" '
				.	       'textcolor="#ffffff" ' 
				.	       'target="_blank" ' 
				.	       'tooltip=""]'
				.	    "Détail de l'édito"
				.	'[/button]'
				.'</p>';
			$r .= $bouton_detail;
		endif;
	}		
	return do_shortcode($r);
}

// Affiche une liste de posts simplifiée (Image et titre seulement)
static function affiche_posts($type, $combien)
{
	$recent_posts = OI_Posts::lis_posts
						(
						 $type ,
						 $taxonomie = '',          // Taxonomie 
						 $categorie = '',			// Categorie dans taxonomie
						 $classe_par='post_date',	// Classement par le champ
						 $sens='DESC',				//     Ascendant ou descendant
 					     $combien
						);
	
	// Le résultat 	
	$r = '';
	// Parcours les actualités
	foreach( $recent_posts as $recent )
	{	
		// self::affiche($recent);	
	    $post_id = $recent["ID"];

		// Image
		$image_a_la_une =get_the_post_thumbnail( $post_id ); 
		$r .= '<div class="post-small">'
		   .  '    <div class="post-pic block-1 zero-mar">'
		   .  '        <div class="block-inner inner move-left">'
		   .              $image_a_la_une
		   .  '        </div>'
		   .  '    </div>';

		// Titre
		$titre = 	'<div class="post-title">'
		       . 		'<h4>'
			   . 		 '<a href="' . get_permalink($post_id) . '">' 
			   . 		  	$recent["post_title"]
			   . 		 '</a>'
			   . 		'</h4>'
			   . 	'</div>'
			   . '</div>'
			   . '<div class="clear"></div>';

		$r .= $titre;	   
			   
		$r .= '<hr>';		
	}
	$r .= self::modifier("/wp-admin/edit.php?post_type=$type");	
	return do_shortcode($r);
}

static function affiche_dernieres_videos()
{
	return self::affiche_dernieres_videos_ou_postcasts('Vidéo');
}	

static function affiche_derniers_podcasts()
{
	return self::affiche_dernieres_videos_ou_postcasts('Podcast');
}
	
static function	affiche_dernieres_videos_et_podcasts()
{
	return self::affiche_dernieres_videos_ou_postcasts('');
}
	
static function affiche_dernieres_videos_ou_postcasts($quoi = '')
{
	$criteres_selection_posts = array(
		'numberposts' => 4,	// Paramètre
		'offset' => 0,
		'category' => 0,
		'orderby' => '',
		'order' => '',
		'include' => '',
		'exclude' => '',
		'post_type' => 'video-et-podcast',		// Paramètre
		'post_status' => 'publish',
		'suppress_filters' => true );

	if ($quoi != '')
	{
		$criteres_selection_posts['meta_key']   = 'video_ou_podcast';
		$criteres_selection_posts['meta_value'] = $quoi;
    }
		
	$videos = wp_get_recent_posts( $criteres_selection_posts, ARRAY_A );

	// Le résultat 	
	$r = '';
	// Parcours les contenus institutionnels
	foreach( $videos as $video )
	{	
	    // self::affiche($recent);	
	    $post_id = $video["ID"];
		$r .= '<div class="post-small">';

		// Image
		//$image_a_la_une =get_the_post_thumbnail( $post_id ); 
		//   .  '    <div class="post-pic block-1 zero-mar">'
		//   .  '        <div class="block-inner inner move-left">'
		//   .              $image_a_la_une
		//   .  '        </div>'
		//   .  '    </div>';

		// Titre
		$titre = 	'<div class="post-title">'
		       . 		'<h4>'
			   . 		 '<a href="' . get_permalink($post_id) . '">' 
			   . 		  	$video["post_title"]
			   . 		 '</a>'
			   . 		'</h4>'
			   . 	'</div>'
			   . '</div>'
			   . '<div class="clear"></div>';

		$r .= $titre;	   
			   
		$r .= '<hr>';		
	}		
	return do_shortcode($r);
}


// Affiche une liste des  pages du bloc "En savoir plus"
static function affiche_en_savoir_plus()
{
	// Le résultat 	
	$r = ''; 
	$r .= '<br>'; 	

	$r .= self::lien_page("Notre Histoire"					, "/histoire/");
	$r .= self::lien_page("Notre Vision & nos missions"		, "/accueil/qui-sommes-nous/notre-vision-nos-missions/"); 
	$r .= self::lien_page("Notre Organisation"	            , "/membres-de-notre-bureau/");
	$r .= self::lien_page("Nos Membres & Partenaires"		, "/membres-et-partenaires/");
	$r .= self::lien_page("L'Action collective avec la DGE"	, "/action-collective-dge/");
	//$r .= self::lien_page("Nos Réalisations"				, "/f-nos-realisations/");
	$r .= '    </div>';
	$r .= '<div class="clear"></div>';
	return do_shortcode($r);
}

static function lien_page ($titre,$url_page)
{
	$lien =  '<div class="post-title">'
		   . '    <h2>'
		   . '       <a href="' . $url_page . '"'
		   . '          target="_blank"' 
		   . '       >' 
		   . 		  	$titre
		   . '       </a>'
		   . '    </h2>'
		   . '</div>'
		   . '<br>'; 
    return $lien;			   
}



// Affiche une liste de Méthodologies et Méthodes associées
// Shortcode
static function affiche_methodologies_methodes()
{
	$criteres_selection_posts = 
	[
		'numberposts' => 10,	// Paramètre
		'offset' => 0,
		'category' => 0,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'include' => '',
		'exclude' => '',
		'meta_key' =>'' ,
		'meta_value' =>'', 
		'post_type' => 'methodologie',		// Paramètre
		'post_status' => 'publish',
		'suppress_filters' => true 
	];
	
	$methodologies_posts = wp_get_recent_posts( $criteres_selection_posts, ARRAY_A );

	// Le résultat 	
	$r = '';
	// Parcours les methodologies
	foreach( $methodologies_posts as $methodologie )
	{	
	    // self::affiche($methodologie);	
	    $post_id = $methodologie["ID"];
		$r .= '<div class="post-small">';

		// Image
		$image_a_la_une =get_the_post_thumbnail( $post_id, 'full' );
		 
		$image = ''
			   .  '[one_sixth]'
		       .  '    <div class="post-pic block-1 zero-mar">'
		       .  '        <div class="block-inner inner move-left">'
		       .              $image_a_la_une
		       .  '        </div>'
		       .  '    </div>'
			   .  '[/one_sixth]'; 

		$r .= $image;	   

		// Titre
		$titre = ''
			   . '[two_sixth]'                                          
			   .'<div class="post-title">'
		       . 		'<h4>'
			   . 		   '<a href="' . get_permalink($post_id) . '"' . ' target=_blank">' 
			   . 		    	$methodologie["post_title"]
			   . 		   '</a>'
			   . 		'</h4>'
			   . 	'</div>'
  			   . '[/two_sixth]'                                          
			   ;
		$r .= $titre;	   

		//$difficulte   = get_post_meta($post_id,'difficulte', $single = true);
		$difficulte   = 'Méthodes';
		
		// Méthodes
        // Difficulté méthode
  		$texte_methodes = ''
				  . '[three_sixth_last]'
				  . "<h4>$difficulte</h4>";
				  
		// Méthodes		  
		$les_methodes = get_post_meta($post_id,'methodes', $single = true);
		// echo count($les_methodes);
		//self::affiche($les_methodes);	
		//continue;
		if ($les_methodes != null)
		{
		    $texte_methodes .= '<table cellpadding="10">'
							.  '<tr>'; 
			foreach($les_methodes as $post_id_methode)
			{   
				$methode = get_post($post_id_methode);
				//OI::affiche($methode); 
				//break 2;	
				$lien_methode = $methode->guid; 
				//$lien_methode_1 =  str_replace('http://academie-immateriel.com/', 
				//				  			   'http://oi-demo-5.ballesta.fr/', 
				//							   $lien_methode);
				$niveau_difficulte = get_field( 'difficulte', $post_id_methode);
				if (!$niveau_difficulte)
					$niveau_difficulte = '';
				$texte_methodes .= '<td>'
								.  "<a href=\"$lien_methode\" target=_blank>"
								.      $methode->post_title 
								.  '</a>' 
								.  '<br>'
								.  '<i>' . $niveau_difficulte . '</i>' 				
								.  '</td>';
			}
		    $texte_methodes .=  '</tr>'
							.   '</table>';
		}
		else
		{
			$texte_methodes .= 'Pas de méthodes';
		}
				  
  		$texte_methodes .= '		[/three_sixth_last]'                                          
			            .  '	</div>'
			            . '<div class="clear"></div>'
				        ;
		$r .= $texte_methodes;	   
		// break;
		$r .= "<hr>";
			
	}		
	return do_shortcode($r);
}

// Affiche une liste de posts simplifiée (Image et titre seulement)
static function affiche_les_10_types_d_ai()
{
	$criteres_selection_posts = array(
		'numberposts' => 10,	// Paramètre
		'offset' => 0,
		'category' => 0,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'include' => '',
		'exclude' => '',
		'meta_key' =>'categorie' ,
		'meta_value' =>"Les 10 types d'AI",
		'post_type' => 'contenu-instit',		// Paramètre
		'post_status' => 'publish',
		'suppress_filters' => true );
	
	$en_savoir_plus_posts = wp_get_recent_posts( $criteres_selection_posts, ARRAY_A );
	
	// Le résultat 	
	$r = '';
	// Parcours les contenus institutionnels
	foreach( $en_savoir_plus_posts as $recent )
	{	
	    // self::affiche($recent);	
	    $post_id = $recent["ID"];
		$r .= '<div class="post-small">';

		// Image
		//$image_a_la_une =get_the_post_thumbnail( $post_id ); 
		//   .  '    <div class="post-pic block-1 zero-mar">'
		//   .  '        <div class="block-inner inner move-left">'
		//   .              $image_a_la_une
		//   .  '        </div>'
		//   .  '    </div>';

		// Titre
		$titre = 	'<div class="post-title">'
		       . 		'<h4>'
			   . 		 '<a href="' . get_permalink($post_id) . '">' 
			   . 		  	$recent["post_title"]
			   . 		 '</a>'
			   . 		'</h4>'
			   . 	'</div>'
			   . '</div>'
			   . '<div class="clear"></div>';

		$r .= $titre;	   
			   
		// $r .= '<hr>';		
	}		
	return do_shortcode($r);
}
/*
// Affiche une liste de posts simplifiée (Image et titre seulement)
static function affiche_posts($parametres)
{
	$post_type = self::parametre('type');
    $categorie = self::parametre('catagorie');
	$nombre    = self::parametre('nombre');
	$colonnes  = self::parametre('colonnes');
    
	$criteres_selection_posts = array(
		'numberposts' => $nombre,	// Paramètre
		'offset' => 0,
		'category' => 0,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'include' => '',
		'exclude' => '',
		'meta_key' =>'categorie' ,
		'meta_value' =>$categorie,
		'post_type' => $post_type,		// Paramètre
		'post_status' => 'publish',
		'suppress_filters' => true );
	
	$en_savoir_plus_posts = wp_get_recent_posts( $criteres_selection_posts, ARRAY_A );
	
	// Le résultat 	
	$r = '';
	
	// Parcours les contenus institutionnels
	foreach( $en_savoir_plus_posts as $recent )
	{	
	    // self::affiche($recent);	
	    $post_id = $recent["ID"];
		$r .= '<div class="post-small">';

		// Image
		$image_a_la_une =get_the_post_thumbnail( $post_id ); 
		if ($image_a_la_une != '')
		{
			$image = '    <div class="post-pic block-1 zero-mar">'
				   . '        <div class="block-inner inner move-left">'
				   .              $image_a_la_une
				   . '        </div>'
				   . '    </div>';
			$r .= $image;	   
		}
		
		// Titre
		$titre = 	'<div class="post-title">'
		       . 		'<h4>'
			   . 		 '<a href="' . get_permalink($post_id) . '">' 
			   . 		  	$recent["post_title"]
			   . 		 '</a>'
			   . 		'</h4>'
			   . 	'</div>'
			   . '</div>'
			   . '<div class="clear"></div>';

		$r .= $titre;	   			   
	}		
	return do_shortcode($r);
}
*/

// ----------------------
// Affiche un seul posts simplifiée (Image et titre)
static function affiche_un_seul_contenu($parametres)
{
	// Initialise le résultat 	
	$r = '';
	// self::affiche($recent);	
	$defauts = 	[ 	'id' 				=> '',
					'url_modification' 	=> '',
					'explications'     	=> '',
					'statique'          => 0 ,
					'url'     			=> ''
				];
    extract($defauts); 	
    extract($parametres); 	
    
	if ($id != '')	
	{
		// Post id présent	
		$post_id = $id;
		// Lis le post
		$post = get_post($post_id);	
		if ($post)
		{
			// Url cible passée en paramètre?	
			if (!$url):
				$lien = get_permalink($post_id);
			else:
				$lien = $url;
			endif;	
			
			$r .= '<div class="post-small">';

			// Image
			$image_a_la_une =get_the_post_thumbnail( $post_id );
			if($image_a_la_une != '')
			{
				if ($statique == 0):
					// Avec lien sur image
					$image = 	
							 '   <div class="post-pic block-1 zero-mar">'
						   . '       <div class="block-inner inner move-left">'
						   . '           <a href="' . $lien . '">' 
						   .                  $image_a_la_une
						   . '           </a>'
						   . '       </div>'
						   . '   </div>';
				else:
					// Sans lien sur image
					$image = 	
							 '   <div class="post-pic block-1 zero-mar">'
						   . '       <div class="block-inner inner move-left">'
						   .                  $image_a_la_une
						   . '       </div>'
						   . '   </div>';
				endif;	
				$r .= $image;   
			}
			// Titre
			if ($statique == 0):
				// Avec lien sur titre
				$titre = 	'<div class="post-title">'
					   . 		'<h4>'
					   . 		 '<a href="' . $lien . '">' 
					   . 		  	$post->post_title
					   . 		 '</a>'
					   . 		'</h4>'
					   . 	'</div>';
			else:
				// Sans lien sur titre
				$titre = 	'<div class="post-title">'
					   . 		'<h4>'
					   . 		  	$post->post_title
					   . 		'</h4>'
					   . 	'</div>';
			endif;	
			$r .= $titre;

			// Extrait
			$extrait = $post->post_excerpt;
			if ($extrait)
			{
				$r .= $extrait;
			}
			else
			{
				$contenu = $post->post_content;
				$r .= $contenu;
			}
			
			$r = OI_Posts::ajoute_liens_et_livrables($r, $post->ID);

			// Fin post
			$fin = '   </div>'
				 . '<div class="clear"></div>';
			$r .= $fin;

			if ($url_modification == '')
			{
				// Pas d'url particulière: Utiliser le post id passé en paramètre
				$r .= self::modifier('/wp-admin/post.php?post=' . $post_id . '&action=edit',
									 '',
									 $explications); 	
			} 
			else
			{
				// url specifique pour modification
				$r .= self::modifier($url_modification,
									 '',
									 $explications); 	
			}
		}
		else
		{
			$r="<h4>Le contenu N° $post_id n'existe pas!</h4>";
		}
	}
	else
	{
		$r="<h4>Paramètre 'id' manquant</h4>";
	}
	return do_shortcode($r);
}

// Affiche un seul posts détaillé (Image et titre  et texte)
static function affiche_un_seul_contenu_detaille($parametres)
{
	// Initialise le résultat 	
	$r = '';
	$nom = $parametres["id"];
	if (isset($parametres["titre"]))
		$titre = $parametres["titre"];
	else
	    // Affiche par defaut
		$titre = 1;
	$args = array(
	  'name'        => $nom,
	  'post_type'   => 'contenu-instit',
	  'post_status' => 'publish',
	  'numberposts' => 1
	);
	$my_posts = get_posts($args);	
	//self::affiche($my_posts);	
	if (count($my_posts) == 0)
		$r .= "***Erreur: post non trouvé***: $nom<br>";
	$post = $my_posts[0];
	$post_id = $post->ID;
	$r .= '<div class="post-small">';

	// Image
	$image_a_la_une = get_the_post_thumbnail( $post_id, 'post-large' );
    if ($image_a_la_une != '')
    { 	
		$r .= '    <div class="post-pic block-2 zero-mar">'
		   .  '        <div class="block-inner inner move-left">'
		   .              $image_a_la_une
		   .  '        </div>'
		   .  '    </div>';
	}
	// Titre
	if ($titre == 1)
	{
		$titre = 	'<div class="post-title">'
			   . 		'<h3>'
			   . 		 '<a href="' . get_permalink($post_id) . '">' 
			   . 		  	$post->post_title
			   . 		 '</a>'
			   . 		'</h3>'
			   . 	'</div>';
		$r .= $titre;
    }
	// Texte
	$texte = $post->post_content;
	$r .= $texte;

	// Fin post
	$fin = '   </div>'
		 . '<div class="clear"></div>';
	$r .= $fin;
    $r .= self::modifier('/wp-admin/post.php?post=' . $post_id . '&action=edit', ''); 	
	
	return do_shortcode($r);
}

// Affiche un seul posts détaillé réactif (Image et texte en recouvrement)
static function affiche_un_seul_contenu_reactif($parametres)
{
	// Initialise le résultat 	
	$r = '';
	$post_id = $parametres["post_id"];
	$post = wp_get_single_post($post_id);	
	//self::affiche($post);	
	$r .= '<div class="post-small">';

	// Image
	$image_a_la_une = get_the_post_thumbnail( $post_id, 'post-large' );
    if ($image_a_la_une != '')
    { 	
		$r .= '    <div class="post-pic block-2 zero-mar">'
		   .  '        <div class="block-inner inner move-left">'
		   .              $image_a_la_une
		   .  '        </div>'
		   .  '    </div>';
	}
	// Titre
	$titre = $post->post_title;
	$r .= "<h2>$titre</h2>";
	
	// Texte
	$texte = $post->post_content;
	$r .= $texte;

	// Fin post
	$fin = '   </div>'
		 . '<div class="clear"></div>';
	$r .= $fin;
    $r .= self::modifier('/wp-admin/post.php?post=' . $post_id . '&action=edit', ''); 	
	
	return do_shortcode($r);
}

// Renvoi un champ d'un "custom type" (Types = 'wpcf' ou ACF = '')
static function lis_champ($post_id, $nom_champ)
{
	$v = get_post_meta($post_id,'wpcf-' . $nom_champ , $single = true);
    if (!$v)
		$v = get_post_meta($post_id, $nom_champ , $single = true);
	return $v;
}

// Affiche les logos des membre ou des partenaires
static function affiche_logos($type, $titre, $categorie = '')
{   
	$membres = OI_Posts::lis_posts
						(
						 $type ,
						 $taxonomie = '',          // Taxonomie 
						 $categorie = '',			// Categorie dans taxonomie
						 $classe_par='post_date',	// Classement par le champ
						 $sens='DESC',				//     Ascendant ou descendant
 					     100
						);
	// Le résultat
	$r = "<h2>$titre</h2>"
	   . '[logos]';
	// Parcours les actualités
	foreach( $membres as $membre )
	{	
		// self::affiche($membre);			
	    // self::affiche(get_post_meta($post_id, '' , $single = true));
		$post_id = $membre["ID"];
		$image_a_la_une = get_the_post_thumbnail( $post_id, 'full' );
		$lien_site_membre = self::lis_champ($post_id,'url-site-web');
		$r .= '<item> '
		   .  '    <a href="' . $lien_site_membre . '" target="_blank">' 
		   .          $image_a_la_une 
		   .  '    </a>'
		   .  '</item> ';		
	}		
	$r .= '[/logos]';
	$r .= self::modifier("/wp-admin/edit.php?post_type=$type",'');
	return do_shortcode($r);
}

// Affiche les logos des membres
// Shortcode: [oi_affiche_logos_membres]
static function affiche_logos_membres()
{
	// $r = self::affiche_logos('membre','Nos Membres');
	// Voir page "tttt carousel"
    $r = '<h2>Nos Membres</h2>'
	   . '[wp_posts_carousel template="simple.css" post_type="membre" all_items="100" show_only="id" posts="" ordering="asc" categories="" tags="" show_title="false" show_created_date="false" show_description="false" allow_shortcodes="false" show_category="false" show_tags="false" show_more_button="false" show_featured_image="true" image_source="full" image_height="100" image_width="100" items_to_show="5" slide_by="1" margin="2" loop="true" stop_on_hover="true" auto_play="true" auto_play_timeout="1200" auto_play_speed="800" nav="true" nav_speed="800" dots="false" dots_speed="800" lazy_load="true" mouse_drag="true" mouse_wheel="true" touch_drag="true" easing="linear" auto_height="false"]'; 	
	return do_shortcode($r);
}

// Affiche les logos des membres
// Shortcode: [oi_affiche_logos_membres_pour_1_categorie]
static function   affiche_logos_membres_pour_1_categorie($parametres)
{
	$titre        = $parametres["titre"];
	$slug = $parametres["categorie_id"];
	$category = get_term_by( 'slug', $slug, 'membre_category', OBJECT );
	$categorie_id= $category->term_id;
	//echo '<hr>', $slug, '==>', $categorie_id; 
	//self::affiche($category);
    $r = "<h2>$titre</h2>"
	   . '[wp_posts_carousel template="simple.css" post_type="membre" all_items="100" '
	   . ' show_only="id" posts="" ordering="asc" categories="' . $categorie_id . '" tags="" '
	   . ' show_title="false" show_created_date="false" show_description="false"'
	   . ' allow_shortcodes="false" show_category="false" show_tags="false" '
	   . ' show_more_button="false" show_featured_image="true" image_source="full"'
       . ' image_height="100" image_width="100" items_to_show="2" slide_by="1" '
	   . ' margin="2" loop="true" stop_on_hover="true" auto_play="true" '
	   . ' auto_play_timeout="1200" auto_play_speed="800" nav="true" '
	   . ' nav_speed="800" dots="false" dots_speed="800" lazy_load="true" '
	   . ' mouse_drag="true" mouse_wheel="true" touch_drag="true" easing="linear" '
	   . ' auto_height="false"]'; 	
	
	return do_shortcode($r);
}

// Affiche les sujets DGE
// Shortcode: [oi_affiche_sujets_dge]
static function   affiche_sujets_dge($parametres)
{
    //echo '<hr>';
	$taxonomie    = $parametres["taxonomie"];
	$categorie_id = $parametres["categorie_id"];
    //echo "taxonomie = $taxonomie<br>";						
    //echo "categorie_id = $categorie_id<br>";						

	// Lis les sujets DGE appartenant à la catégorie
	$sujets = OI_Posts::lis_posts
						( $type = 'sujet-dge',			// Type du post à renvoyer
						  $taxonomie, 					// Custom taxonomie
						  $categorie_id,                // Filtre categorie
						  $classe_par='post_date',		// Classement par le champ
						  $sens='DESC',					// Ascendant ou descendant
                          $combien = 100				// Nombre de post à renvoyer
						); 
	//self::affiche($sujets, 'affiche_sujets_dge');	
	$r ='';
	$i =1;
	foreach ($sujets as $s)
	{
		// Prépare les données sur chaque sujet DGE
		//self::affiche($s, 'sujet_dge');	
		if ($i > 1)
		{
			// Sépare les lignes à partir de la deuxième.
			$r .= "<hr>";
	    }
		$i++;
		$post_id = $s['ID'];
		// Champs de l'ACF 'Auteurs'
		$origine    = self::lis_champ($post_id,'origine'	);
		$contact    = self::lis_champ($post_id,'contact'	);
		$subvention = self::lis_champ($post_id,'subvention'	);
		// Champ Documents livrables
		$livrables = get_field('livrables', $post_id);
		//self::affiche($livrables, 'livrables');
		$documents_livrables = '';
		if ($livrables)
		{
			// Présence de documents livrables
			$documents_livrables .= '<hr><h5>Livrables</h5>';
			foreach ($livrables as $livrable)
			{
				$l = $livrable['livrable'];
                if (isset( $l['title']))
				{
					$html_lien_fichier 	= '<a href="' . $l['url'] . '"'
										. '   target="_blank"' 
										.  '>' 
										.     $l['title']
										. '</a><hr>';
					$documents_livrables .=  $html_lien_fichier;	
				}	
			}
		}	
		
		//self::affiche($url_fichier);

		// Met en forme le sujet DGE pour la liste.
		$r .= '[one_fifth]'		
		   .      '<strong>' .  $s['post_title'] . '</strong>'  . '<br>'
		   .  '[/one_fifth]';
		$r .= '[three_fifth]'	
		   .        $s['post_content']
		   .		'<br>'
		   .		'<br>'
		   .        $documents_livrables
		   . '[/three_fifth]';
		$r .= '[one_fifth_last]';
		if ($origine):
		   $r .= 'Origine' . '<br>'
		      .  '<strong>' . $origine . '</strong>'   
		      .  '<hr>';
		endif;	
		if ($subvention):
		   $r .= 'Subvention publique' . '<br>'		   
		      .   '<strong>' . $subvention . '</strong>'  
		      .	  '<hr>';
		endif;	
		if ($contact):
		   $r .= 'Contact' . '<br>'
		      .  '<strong>' . $contact . '</strong>'  
		      .  '<hr>';
		endif;	
			  
		$r .= '' 				
		   .  '[/one_fifth_last]';
		
		$r .= self::modifier('/wp-admin/post.php?post=' . $post_id . '&action=edit', 'Sujet'); 	
	} 
	return do_shortcode($r);
}

// Affiche les logos des partenaires
// Shortcode: [oi_affiche_logos_partenaires]
static function affiche_logos_partenaires()
{
	// $r = self::affiche_logos('partenaire', 'Nos Partenaires');     
	// Voir page "tttt carousel"
	$r = '<h2>Nos Partenaires</h2>'
       . '[wp_posts_carousel template="simple.css" post_type="partenaire" '
	   . 'all_items="100" show_only="id" posts="" ordering="asc" categories="" '
	   . 'tags="" show_title="false" show_created_date="false" ' 
	   . 'show_description="false" allow_shortcodes="false" show_category="false" '
	   . 'show_tags="false" show_more_button="false" show_featured_image="true" '
	   . 'image_source="full" image_height="100" image_width="100" '
	   . 'items_to_show="3" slide_by="1" margin="2" loop="true" '
	   . 'stop_on_hover="true" auto_play="true" auto_play_timeout="1200" ' 
	   . 'auto_play_speed="800" nav="true" nav_speed="800" dots="false" '
	   . 'dots_speed="800" lazy_load="true" mouse_drag="true" mouse_wheel="true" '
	   . 'touch_drag="true" easing="linear" auto_height="false"]'; 	

	return do_shortcode($r);
}

static function affiche_actualites()
{
	return self::affiche_posts($type    = 'actualite' , 
							  $combien = 3);
}

static function affiche_publications_membres()
{
	return self::affiche_posts($type    = 'publication-membre' , 
							   $combien = 3);
}

static function affiche_videos_et_podscasts()
{
	$r = ''
	   . '[search-form id="video" showall="1"]'
	   . '[oi_ajout url="/wp-admin/post-new.php?post_type=video-et-podcast"]';
	return do_shortcode($r);
}

static function affiche_derniere_video_ou_podcast()
{
	$criteres_selection_posts = 
	[
		'numberposts' => 1,	
		'offset' => 0,
		'category' => 0,
		'orderby' => 'date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' =>'' ,
		'meta_value' =>'',
		'post_type' => 'video-et-podcast',		
		'post_status' => 'publish',
		'suppress_filters' => true 
	];
	
	$videos_posts = wp_get_recent_posts( $criteres_selection_posts, ARRAY_A );

	// Le résultat 	
	$r = '<h3>Dernière Video ou Podcast</h3><hr>';
	// Parcours les videos
	// En fait une seule video ou podcast
	foreach( $videos_posts as $video )
	{	

		$post_id = $video["ID"];
		$url_de_la_video =  self::lis_champ($post_id, 'url_de_la_video');
		$titre = $video["post_title"];

		// Image
		$image_a_la_une =get_the_post_thumbnail( $post_id, 'full' );
		$image_a_la_une = wp_get_attachment_url(get_post_thumbnail_id($post_id));
		$image = ''
			   .  '[one_half]'
			   .   OI_image_hover::image_reactive
						($image        = $image_a_la_une,
						 $titre        = $titre,
						 $texte        = '', 
						 $lien         = $url_de_la_video,
						 $texte_bouton = 'Voir la vidéo'
						)
			   .  '[/one_half]'; 	
		$r .= $image;	   
				
		// Titre
		$titre = '[one_half_last]'                                           
			   .'<div class="post-title">'
		       . 		'<h3>'
			   . 		 '<a href="' . get_permalink($post_id) . '"' 
			   .            'target="_blank">' 
			   . 		  	$video["post_title"]
			   . 		 '</a>'
			   . 		'</h3>'
			   . 	'</div>'
			   ;
		$r .= $titre;	   

		// Date et thème
		$date = get_the_date( get_option('date_format') );
		$texte_themes = '';
		// $c = get_the_category($post_id);
        //$themes = self::lis_categories($post_id, 'theme-video-et-podcast' );
		////self::affiche($themes);	
		//$texte_themes = "<hr><h3>Thèmes</h3>";
		//foreach( $themes as $id => $theme )
		//{
		//	$texte_themes .= "<h4 style=\"font-style: italic;\">$theme</h4>";
		//}
		$date = ''
			  . $date 
			  . '<br>'
		//	  . $texte_themes 
			  . '<hr>'
			  ;
		$r .= $date;
		
		// Extrait 
		$extrait = $video["post_excerpt"];
		$r .= $extrait;
		
  		$r .= '[/one_half_last]';
  		$fin .= '' //'</div>'
			 .  '<div class="clear"></div>'
			 ;
		$r .= $fin;	   
		// break;			
	}		
	return do_shortcode($r);
}

static function modification($parametres)
{
	$url = $parametres["url"];
	if (isset($parametres["texte"]))
		$texte = $parametres["texte"];
	else	
		$texte = '';
	$r = self::modifier($url, $texte);
	return do_shortcode($r);
}

static function ajout($parametres)
{
	$url = $parametres["url"];
	if (isset($parametres["texte"]))
		$texte = $parametres["texte"];
	else	
		$texte = '';
	if (isset($parametres["explications"]))
		$explications = $parametres["explications"];
	else	
		$explications = '';
	$r = self::ajouter($url, $texte, $explications);
	return do_shortcode($r);
}


static function ajoute_admin($content) 
{
   //if(is_single()) {
		$content .= self::admin();
   //}
   return $content;
}

static function admin($parametres=[])
{
	$id = get_the_ID();
	//$r = "id: $id<br>";
	$url = "/wp-admin/post.php?post=$id&action=edit";  
	if (isset($parametres["texte"]))
		$texte = $parametres["texte"];
	else	
		$texte = '';
	$r .= self::administrer($url, $texte);
	return do_shortcode($r);
}


//
static function creer_contenu($parametres)
{
//	$url = $parametres["url"];
//	if (isset($parametres["texte"]))
//		$texte = $parametres["texte"];
//	else	
//		$texte = '';
//	$r = self::modifier($url, $texte);
//	return do_shortcode($r);
}	

static function affiche_diaporama($parametres)
{	
	$id_diaporama = $parametres["id"];
	$r  = "[metaslider id=$id_diaporama]"
	    . self::modifier( "/wp-admin/admin.php"
	                    . "?page=metaslider&id=$id_diaporama",
						'');
	return do_shortcode($r);
}

static function affiche_liens_slogan()
{	
	//[space size="60"]
	//<span style="font-size: 50px; color:rgb(247,168,23);">
	//[cooltext sequence="cool29-words" speed="20" stager="50" settings="antialias"]
	//<span style="color: white;">
	//Osez
	//<br/>&nbsp;<br/>
	//l'Immatériel
	//<br/>&nbsp;<br/>
	//pour vous
	//<br/>&nbsp;<br/>
	//développer!
	//</span>
	//[/cooltext]
	//</span>
	//[space size="50"]

	//[wpmem_logged_out]
	//[button href="/wp-login.php" size="large"]Accès membres[/button]
	//[/wpmem_logged_out]
	//[wpmem_logged_in]
	//[button href="http://oi-demo-5.ballesta.fr/homepage/1-accueil/12-slogan/?a=logout" size="large"]Déconnexion[/button]
	//[/wpmem_logged_in] 
	
	
	$r=<<<FIN
	[hupso url="http://oi-demo-5.ballesta.fr/"]
FIN;
	return do_shortcode($r); 
}

static function affiche_membres_bureau()
{
    echo 'Membres du bureau';
	$membres_bureau = self::lis_membres_bureau();
	// self::affiche($membres_bureau);
	if ($membres_bureau)
	{
		$nombre_membres_dans_rangee = 4;
		self::affiche_membres_debut($nombre_membres_dans_rangee);
		// Affiche les membres en plusieurs rangées
		self::affiche_premiere_rangee  ($membres_bureau, 
		                                $nombre_membres_dans_rangee);
		self::affiche_rangee_president ($membres_bureau, 
		                                $nombre_membres_dans_rangee);
		self::affiche_rangees_suivantes($membres_bureau, 
		                                $nombre_membres_dans_rangee);
		self::affiche_membres_fin();
	}
/*
    // Lis les utilisateurs membres du bureau
	$blogusers = get_users( 'blog_id=1'
	                      . '&orderby=nicename'
						  . '&meta_key=wpcf-membre-bureau'
						  . '&meta_compare="="'
						  . '&meta_value=1'
						  );
	// $blogusers is an Array of WP_User objects.
	$nombre_membres = count($blogusers);
	// Il y a des membres du bureau?
	if ($nombre_membres > 0)
	{
		// Membres trouvés
		$position_membre=1;
		$rangee=1; 
		foreach ( $blogusers as $user ) 
		{ 
			//self::affiche($user); 
			$user_id = $user->ID;
			$role_dans_observatoire = get_user_meta($user_id, 'wpcf-role-observatoire', true);
			//$user->role_dans_observatoire = $role_dans_observatoire;

			$description_role       = get_user_meta($user_id, 'wpcf-description-role' , true);
			$president              = get_user_meta($user_id, 'wpcf-president'        , true);
			if ($rangee <> 2) 
			{
				if ($president == 0) 
				{
					// Exclure le président des autre rangées
					// echo '<hr>';
					echo $rangee, " ",$position_membre, '<br>'; 
					echo esc_html( $user->display_name ), '<br>';
					echo esc_html( $user->user_email ), '<br>';
					echo $role_dans_observatoire, '<br>';
					echo $description_role, '<br>';
					echo $president, '<br>';
				}
			}	
			else
			{
			    // Rangée 2: président seul
				if ($president == 1) 
				{
					echo "***Président***<br>";
					echo esc_html( $user->display_name ), '<br>';
					echo esc_html( $user->user_email ), '<br>';
					echo $role_dans_observatoire, '<br>';
					echo $description_role, '<br>';
					echo $president, '<br>';
				}			
			}
			if (($position_membre % 5) == 0 )
			{
				$rangee++;
			}
			$position_membre++;
			echo '<hr>';
			//break;
		}
	}	
	else
	{
		echo "<h3>Aucun utilisateur membre du bureau!</h3>";
	}
*/	
}

static function affiche_membres_debut($nombre_membres_dans_rangee)
{
	echo '
	<div class="sf-wrapper">
	
	<script>',
		"var sf_columns = $nombre_membres_dans_rangee;",
	'</script>
	
	<style>
		ul.sf-result > li
		{
			margin: 2% 0;
			margin-right: 2%;
			float: left; 
			width: 24%;
		}

		ul.sf-result > li:nth-child(3n)
		{
			margin-right: 0;
		}

		
		ul.sf-result > li:nth-child(3n+1)
		{
			clear: both;
		}
		
		.sf-result li
		{
			border: 1px solid #cacaca;
		}
		
		.sf-result li
		{
			background: #f0f0f0;
		}
		
		ul.sf-nav > li > span.sf-nav-click
		{
			background: #f0f0f0;
		}
					
		ul.sf-result > li.sf-noresult
		{
			float: none;
			width: 100%;
			margin: 0;
		}	
	</style>
	
	
	';
}

static function affiche_membre($membre, $position)
{	
	echo 
	'
		<li data-postid="9999">
			<div style="float:left; padding-right:10px;">',
				$membre['utilisateur']->display_name,
	'		</div> 
		</li>
	';
}

static function affiche_membres_fin()
{
	echo 
	'
	</div>	
	';
}

// Lis les utilisateurs membres du bureau
static function lis_membres_bureau()
{
	$membres_bureau = [];	
	$blogusers = get_users( 'blog_id=1'
	                      . '&orderby=nicename'
						  . '&meta_key=wpcf-membre-bureau'
						  . '&meta_compare="="'
						  . '&meta_value=1'
						  );
	// $blogusers is an Array of WP_User objects.
	$nombre_membres = count($blogusers);
	echo "nombre_membres=$nombre_membres<br>";  
	// Il y a des membres du bureau?
	if ($nombre_membres > 0)
	{
		// Membres trouvés
		foreach ( $blogusers as $user ) 
		{ 
			
			//self::affiche($user); break; 
			$user_id = $user->ID;
			// Lis les champs étendus ("meta") de l'utilisateur
			$role_dans_observatoire = get_user_meta($user_id, 
			                                       'wpcf-role-observatoire', 
												   true);
			$description_role       = get_user_meta($user_id, 
			                                       'wpcf-description-role', 
												   true);
			$president              = get_user_meta($user_id, 
			                                       'wpcf-president', 
												   true);
			// Utilisateur + champs étendus									   
			$membre_bureau = 
			[ 
				'utilisateur' 			=> $user,
				'role_dans_observatoire'=> $role_dans_observatoire,
				'description_role' 		=> $description_role,
				'president' 			=> $president
			]; 		
			// Ajoute à la liste des membres
			$membres_bureau[] = $membre_bureau;
		}	
	}	
	else
	{
		echo "<h3>Aucun utilisateur membre du bureau!</h3>";
		$membres_bureau = false;
	}
	return 	$membres_bureau;
}

// ++++++++++++
static function affiche_college_experts()
{
	$experts = self::lis_membres_college_experts();
	$i=1;
	$r='';
	foreach($experts as $expert)
	{
		$nom = $expert->display_name;
		$photo = userphoto__get_userphoto
				   (
					$expert->ID, 
					USERPHOTO_THUMBNAIL_SIZE, 
					$before = '',
					$after = '', 
					$attributes, 
					$default_src = ''
				   );
		if (($i % 3) > 0)	
			$last = '';
		else
			$last = '_last';	
				
		$r  .= "[one_third$last]"
			.  		'<center>'	   
		    . 			$photo . '<br>'
		    . 			$nom   . '<br>'
		    . 		'</center>'
			.  "[/one_third$last]"
			;	
        $i++;			
	}
	$r  .= self::modifier($url = '/wp-admin/users.php',
     	                  $texte='Modifier Utilisateurs', 
						  $explications='Case à cocher "Membre du collège des Experts"');
	return do_shortcode($r);
}	

// Lis les utilisateurs membres du collège des experts
static function lis_membres_college_experts()
{

	$experts = get_users
	
				( 
				[
				 'blog_id=1'
				// Classement par noms
				//, 'fields'			=> 'all_with_meta'
				// The meta field (or key) we want to target
				//, 'meta_query' 		=> [['key' => 'last_name']] 	
				// Membre du collège d'experts? 
				, 'meta_key'		=> 'wpcf-membre-college-experts'
				, 'meta_compare'	=> '='
				, 'meta_value'		=> '1'
				]);
	$nombre_experts = count($experts);
	// Il y a des membres du collège des experts?
	if ($nombre_experts > 0)
	{
		$experts_classes=[];
		// Classe les experts 
		// 	-En premier celui dont l'ordre est égal à 1
		foreach($experts as $expert)
		{
		    //OI::affiche($expert,"Expert"); 
			$expert_all_meta = get_user_meta( $expert->ID );
			//OI::affiche($expert_all_meta,"Expert meta"); die();
			//OI::affiche($expert_all_meta,"expert_all_meta");
			if (   isset($expert_all_meta['wpcf-ordre-des-membres'])
				&&       $expert_all_meta['wpcf-ordre-des-membres'][0] == '1')
			{	
				$experts_classes[] = $expert;	
			}
		}
		// 	-Ensuite par ordre alphabétique.
		$expert_avec_nom = [];
		// Ajoute le nom à chaque expert
		foreach($experts as $expert)
		{
			$expert_all_meta = get_user_meta( $expert->ID );
			$nom = $expert_all_meta[last_name][0];
			if ( !isset($expert_all_meta['wpcf-ordre-des-membres']))
			{	
				// Ajoute le nom sous forme de tableau
				//  				 [0]	[1]                
				$expert_avec_nom[] = [$nom, $expert];	
			}
		}
		// Tri les experts par nom
		usort($expert_avec_nom, 'OI::sort_by_last_name');
		foreach($expert_avec_nom as $nom_expert)
		{
			$experts_classes[] = $nom_expert[1];
		}
	}
	else
	{
		echo "<h3>Aucun membre dans le collège des experts!</h3>";
		$experts = false;
	}
	return 	$experts_classes;
}

static function sort_by_last_name($a, $b){
    //OI::affiche($a); die();
	//THIS IS THE CHANGE THAT MAKES ALPHA SORTING HAPPEN
	return strcasecmp($a[0], $b[0]); 
}


static function affiche_premiere_rangee($membres_bureau,
										$nombre_membres_dans_rangee)

{
	//self::affiche($membres_bureau);
    echo '<ul class="sf-result">';
	$nombre_membres_affiches = 0;
	foreach ($membres_bureau as $membre_bureau)
	{
	    if ($membre_bureau['president'] == 0)
		{
            // Le président sera affiché seul dans la deuxième rangée		
			$nombre_membres_affiches++;
			self::affiche_membre($membre_bureau, 
								 $nombre_membres_affiches);
			if ($nombre_membres_affiches == $nombre_membres_dans_rangee)
			{
				// Rangée pleine: sortir
				break;
			}	

		}
	}
    echo '</ul>';

}	

// Affiche le président seul dans une seule rangée.
static function affiche_rangee_president($membres_bureau)
{
	foreach ($membres_bureau as $membre_bureau)
	{
	    if ($membre_bureau['president'] == 1)
		{
			echo '<ul class="sf-result">';
            // Le président est affiché seul dans la deuxième rangée		
			self::affiche_membre($membre_bureau, 
								 $nombre_membres_affiches=1);
			echo '</ul>';
			break;
		}
	}
}

static function affiche_rangees_suivantes($membres_bureau,
										  $nombre_membres_dans_rangee)
{
	$nombre_membres_bureau = count($membres_bureau);
	if($nombre_membres_bureau > $nombre_membres_dans_rangee + 1)
	{
		// Plus d'une rangée + Président
		$nombre_rangees_completes 	= $nombre_membres_bureau 
									  / 		// Division entière
									  $nombre_membres_dans_rangee;
		$nombre_derniere_rangee 	= $nombre_membres_bureau 
									  % 		// Reste de la division entière
									  $nombre_membres_dans_rangee;
		if ($nombre_derniere_rangee > 0)
			$nombre_rangees = $nombre_rangees_completes + 1;
		$numero_membre = 0;
		// Pour chaque rangée
		for ($r = 0; $r < $nombre_rangees; $r++)
		{
			// Pour chaque membre de la rangée
			for ($m = 0; $m < $nombre_membres_dans_rangee; $m++)
			{
				$membre_bureau = $membres_bureau[$numero_membre++];
				if ($membre_bureau['president'] == 1)
				{
					// Le président a déjà été affiché seul dans la deuxième rangée		
					// L'exclure des membre et ne pas faire progresser le compteur des 
					// membres de la rangée.
					$m--;	
				}
				else
				{
					// Le président a déjà été affiché seul dans la deuxième rangée		
					$nombre_membres_affiches++;
					self::affiche_membre($membre_bureau, 
										 $nombre_membres_affiches);
					if ($numero_membre == $nombre_membres_bureau)
					{
						// Dernier membre: sortir
						break;
					}
				}
			}	
		}
		echo '</ul>';
	}
}

// Génère le lien pour modifier si le rôle le permet.
static function modifier($url, $texte='Modifier', $explications='')
{
	if (  self::is_user_logged_in_as_admin()) :
		$r = self::lien_backoffice( $icone = "/wp-content/uploads/2015/09/stylo.png",
									$url, 
									$texte, 
									$explications);								
	endif;
	return do_shortcode($r);
}

// Test if user is logged in as administrator or administrateur_metier 
static function is_user_logged_in_as_admin()
{

	if (   current_user_can( 'administrator' ) 
	    || current_user_can( 'author'        )):
		return true;	
	else:	
	    return false;
	endif;	
}

// Génère le lien pour administrer si le rôle le permet.
static function administrer($url, $texte='Modifier', $explications='')
{
	$r = '';
	if (   is_user_logged_in() 
	    && current_user_can( 'manage_options' ) ): 
		$r = self::lien_backoffice($icone = "/wp-content/uploads/2015/11/admin.png",
								   $url, 
								   $texte, 
								   $explications);								
	endif;

	return do_shortcode($r);
}

// Génère le lien pour modifier si le rôle le permet.
static function ajouter($url, $texte='Ajouter', $explications='')
{
	$r = '';
	if (  self::is_user_logged_in_as_admin()) :
		$r = self::lien_backoffice($icone = "/wp-content/uploads/2015/11/plus.png",
									$url, 
									$texte, 
									$explications);								
	endif;	
	return do_shortcode($r);
}

// Génère le lien pour ajouter, modifier, ... du backoffice
static function lien_backoffice($icone, $url, $texte, $explications)
{
	if ( is_user_logged_in() ) 
	{ 
		$r = '&nbsp;&nbsp;'
		   . '<a href="' . $url . '"' . 'target = _blank>'
		   .     '<img src="' . $icone  . '"'
		   .     '      style="width:50px">' 
		   .     $texte
		   
		   . '</a>';
		if ($explications != '')   
		   $r .= "<h4  style=\"color:BlueViolet \">Attention: $explications!</h3>";
		return do_shortcode($r);
	}
	else
	{
		return '';
	}
}	


static function lis_categories($post_id, $categorie )
{
	$terms = get_the_terms($post_id, $categorie );
	//self::affiche($terms);
	if ($terms && ! is_wp_error($terms)) :
		$term_slugs_arr = array();
		foreach ($terms as $term) 
		{
			$term_slugs_arr[$term->slug] = $term->name;
		}
	endif;
	return 	$term_slugs_arr;
}

static function affiche($v, $titre = '')
{
    echo "<h3>$titre</h3>";
	echo '<pre>';
	print_r($v);	   
	echo '</pre>';
}
} // End of static class OI

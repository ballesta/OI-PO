<?php 
/*
 if (    !function_exists( 'dynamic_sidebar' ) 
           || !dynamic_sidebar() ) 

*/
?>
<?php

sidebars();

// Barre de droite
// Index fonction du type de contenu 
function sidebars()
{
	$post_id = get_the_ID();
	$type_article = get_post_type($post_id);  
	switch ($type_article)
	{
		case 'realisation': 
			$pluriel = 'Réalisations';
			$recent  = 'Récentes';
			break;
		case 'publication-membre': 
			$pluriel = 'Publications';
			$recent  = 'Récentes';
			break;			
		case 'video-et-podcast': 
			$pluriel = 'Videos et Podcasts';
			$recent  = 'Récentes';
			break;			
		case 'sujet-dge': 
			$pluriel = 'Sujets DGE';
			$recent  = 'Récents';
			break;			
		case 'outil': 
			$pluriel = 'Outils';
			$recent  = 'Récents';
			break;			
		case 'editorial': 
			$pluriel = 'Editoriaux';
			$recent  = 'Récents';
			break;			
		case 'actualite': 
			$pluriel = 'Actualités';
			$recent  = 'Récentes';
			break;			
		case 'methodologie': 
			$pluriel = 'Méthodologies';
			$recent  = 'Récentes';
			break;		
		case 'methode': 
			$pluriel = 'Méthodes';
			$recent  = 'Récentes';
			break;		
		case 'contenu-instit': 
			$pluriel = 'Contenu institutionnel';
			$recent  = 'Récents';
			break;	
		case 'te_announcements': 
			$pluriel = 'Notre histoire';
			$recent  = '';
			break;	

		default:
			$pluriel = 'Articles';
			$recent  = 'Récents';
	}

	echo '<div class="block-inner widgets-area">';		
		if ($type_article == 'contenu-instit'):
			contenu_instit_meme_theme($post_id, $type_article, $pluriel, $recent);
		elseif ($type_article == 'methodologie'):
			methodes_de_methodologie($post_id, $type_article, $pluriel, $recent);
		elseif ($type_article == 'methode'):
			methodes_de_meme_methodologie($post_id, $type_article, $pluriel, $recent);
		else:	
			articles_recents   ($post_id, $type_article, $pluriel, $recent);
		endif;	
	echo '</div>';		
}
 
// 'announcement_date'
 
 
function articles_recents($post_id, $type_article, $pluriel, $recent)
{
    if ($type_article == 'te_announcements'):
		$champ_meta='announcement_date';
		// Lis les publications récentes
		$articles_recents 
		= OI_Posts::lis_posts
			( 
			$type_article ,					// Type du post à renvoyer
			$taxonomie = '',         		// Taxonomie 
			$categorie = '',				// Categorie dans taxonomie
			$classe_par='announcement_date',// Classement par le champ
			$sens='ASC',					//     Ascendant ou descendant
			$combien = 100, 		    	// Nombre de post à renvoyer
			$champ_meta						// Utilisation champs méta pour tri
			);
	else:	
		$champ_meta='';
		$articles_recents 
		= OI_Posts::lis_posts
			( 
			$type_article ,				// Type du post à renvoyer
			$taxonomie = '',         	// Taxonomie 
			$categorie = '',			// Categorie dans taxonomie
			$classe_par='post_date',	// Classement par le champ
			$sens='DESC',				//     Ascendant ou descendant
			$combien = 5, 		    	// Nombre de post à renvoyer
			$champ_meta					// Utilisation champs méta pour tri
			);
		endif;	

	//OI::affiche($articles_recents );	
 	if ( count($articles_recents)>0 ): 
	    echo '<div class="widget-header">';
		if ($recent != ''):
			echo "$pluriel les plus $recent";
		else:
			echo "$pluriel";
		endif;
		echo '</div>';
	    echo '<ul>';
		foreach ( $articles_recents as $a): 
			//$url = $a['post_name'];
			$url = $a['guid'];
			echo '<li>';
			echo '    <a href="' . $url . '">';
			echo          $a['post_title'];
			echo '    </a>';
			echo '</li>';
		endforeach;
	    echo '</ul>';
	endif;	
	echo '<br>';
}

function contenu_instit_meme_theme($post_id, $type_article, $pluriel, $recent)
{	 
	$taxonomie = 'type-contenu-institutionnel';
	//echo $taxonomie, '<br>';

	// Récupère toutes les catégories de la taxonomie 'type-contenu-institutionnel'
	$terms = wp_get_post_terms( $post_id, $taxonomie); 
	//OI::affiche($terms, 'taxonomies');
	if( !is_wp_error( $terms ) ):
		$les_10_types_dai = false;
		foreach($terms as $t):
			if($t->slug == 'les-10-types-dai'):
				$categorie_id = $t->term_id;
				$les_10_types_dai = true;
				break;
			endif;	
		endforeach;
		if ($les_10_types_dai):
			// Lis les publications récentes avec filtrage par taxonomie et catégorie
			$articles_recents 
			= OI_Posts::lis_posts
							( 
							   $type_article,			// Type du post à renvoyer
							   $taxonomie,         		// Taxonomie 
							   $categorie_id,			// Categorie dans taxonomie
							   $classe_par='post_date',	// Classement par le champ
							   $sens='DESC',			//     Ascendant ou descendant
							   $combien = 100 		    // Nombre de post à renvoyer
							);
			//OI::affiche($articles_recents );	
			if ( count($articles_recents)>0 ): 
				echo '<div class="widget-header">';
				echo "     Les 10 types d'actifs immatériels";
				echo '</div>';
				echo '<ul>';
				foreach ( $articles_recents as $a): 
					//OI::affiche($a);
					$url = $a['post_name'];
					echo '<li>';
					echo '    <a href="' . $url . '">';
					echo          $a['post_title'];
					echo '    </a>';
					echo '</li>';
				endforeach;
				echo '</ul>';
			endif;	
		endif;	
		echo '<br>';
	endif;	
}

// Méthodes reliées à la méthodologie courante
function methodes_de_methodologie($post_id, $type_article, $pluriel, $recent)
{	 
	global $post;
	//OI::affiche($post, 'méthodologie');
	// Lis les identifiants des méthodes
	$methodes = OI::lis_champ($post_id,'methodes');
	//OI::affiche($methodes, 'méthodes');
	if ( count($methodes)>0 ): 
		echo '<div class="widget-header">';
		echo     "Méthodes";
		echo '</div>';
		echo '<ul>';
		foreach($methodes as $m):
			$methode  = get_post( $m );
			//OI::affiche($methode, 'méthode');
			$url = $methode->post_name;
			echo '<li>';
			echo '    <a href="' . $url . '" ' . 'target=_blank>';
			echo          $methode->post_title;
			echo '    </a>';
			echo '</li>';
			//echo $methode->post_title, '<br>';
		endforeach;
		echo '</ul>';

	endif;	
}

// Méthodes reliées de la même méthodologie 
// que la méthode courante.
function methodes_de_meme_methodologie($post_id, $type_article, $pluriel, $recent)
{	 
	global $post;
	// Lis la méthodologie à laquelle est reliée la méthode
    $methodologie = get_field('methodologie',$post_id);	
	//OI::affiche($methodologie, 'Méthodologie');
	
	$methodes = get_field('methodes', $methodologie[0]->ID);
	//OI::affiche($methodes, 'méthodes');
	if ( count($methodes)>0 ): 
		echo '<div class="widget-header">';
		echo     "Autres Méthodes";
		echo '</div>';
		echo '<ul>';
		foreach($methodes as $m):
			$methode  = get_post( $m );
			//OI::affiche($methode, 'méthode');
			$url = $methode->post_name;
			echo '<li>';
			echo '    <a href="' . $url . '" ' . 'target=_blank>';
			echo          $methode->post_title;
			echo '    </a>';
			echo '</li>';
			//echo $methode->post_title, '<br>';
		endforeach;
		echo '</ul>';

	endif;	
}
?>
		   
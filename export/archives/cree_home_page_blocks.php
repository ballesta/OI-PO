<?php

/*
	Automatisation de la création des pages de l'OI

	------
	Modèle
	------
	
	Site
		->* pages
			->1 home pages block principal
			->* home pages block secondaires
				<> est un Diaporama
				<> est un Liens
				<> est un Contenu institutionnel
				<> est un liste (type contenu)
				<> est un Logos memebre, partenaires
		->* Diaporamas
		->* Contenu
				<?> Institutionnel
				<?> ...
*/

include "Site.php";

include "Home_page_block.php";

include "Post.php";

include "Fichier.php";

include "Base_donnees.php";

cree_contenu();


//
// Création des "home pages block"
// 
function cree_contenu()
{
	$s=new Site();
    $b = new Base_donnees('oi-demo-4');

	// Lire le dernier $post_id 	
	$r = $b->exec_sql("SELECT MAX(ID) AS last_post_id FROM wp_posts");
	$s->last_post_id = $r->last_post_id;
	echo $s->last_post_id, '<br>';
	
	// Lire la position du dernier sous bloc  	
	$r = $b->exec_sql( "SELECT MAX(menu_order) AS last_menu_order "
	                 . "  FROM wp_posts"
					 . " WHERE post_type = 'homepage'");
	$s->last_menu_order = $r->last_menu_order;
	echo $s->last_menu_order, '<br>';
	die();

	cree_home_page_block($s,'page', 'g', 'PRINCIPAL'  , 9);
	cree_home_page_block($s,''    , 'g', 'SOUS BLOC 1', 5);
	cree_home_page_block($s,''    , 'g', 'SOUS BLOC 2', 4);
	cree_home_page_block($s,''    , 'g', 'SOUS BLOC 3', 9);
	
	$s->genere_export_xml();
}	

function cree_home_page_block($s,
							  $type, 
							  $numero,
							  $nom,
							  //$pere,
							  $largeur)
{
	$block = new Home_page_block($s, $type);
	$block->numero  = $numero;
	$block->nom     = $nom;
	$block->largeur = $largeur;
	$s->home_page_blocks[] = $block;
}


?>   
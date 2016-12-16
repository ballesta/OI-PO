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
				<> est un Logos membre, partenaires
		->* Diaporamas
		->* Contenu
				<?> Institutionnel
				<?> ...
*/

include "modele/Site.php"       ;
include "modele/Page.php"       ;
include "modele/Bloc.php"       ;
include "modele/Contenu_bloc.php";

include "utilitaires/Fichier.php";
include "utilitaires/Base_donnees.php";

cree_contenu();

//
// Création des "home pages block"
// 
function cree_contenu()
{
	$site=new Site();
	lis_derniers_identifiants($site);
	cree_pages($site);
	// affiche("Site", $site);
	$site->genere_export_xml();
}	

function lis_derniers_identifiants(Site $site)
{
	$b = new Base_donnees('oi-demo-4');

	// Lire le dernier $post_id 	
	$r = $b->exec_sql( "SELECT MAX(ID) AS last_post_id "
					 . "  FROM wp_posts");
	$site->last_post_id = $r->last_post_id;
	echo $site->last_post_id, '<br>';
	
	// Lire la position du dernier sous bloc  	
	$r = $b->exec_sql( "SELECT MAX(menu_order) AS last_menu_order "
					 . "  FROM wp_posts"
					 . " WHERE post_type = 'homepage'");
	$site->last_menu_order = $r->last_menu_order;
	echo $site->last_menu_order, '<br>';
}

function cree_pages(Site $site)
{
	// cree_page_g_rejoignez_nous($site);
	cree_page_r_bibliographie ($site);
}

function cree_page_g_rejoignez_nous(Site $site)
{
	$page = cree_page($site,"g", "rejoignez-nous");
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'g-diapos'		 , 5  , new Diaporama  ($site));
		cree_bloc($site, $page, 'g-liens'		 , 4  , new Liens      ($site));
		cree_bloc($site, $page, 'g-mot-president', 9  , new Contenu    ($site,"Le mot du président"));
		cree_bloc($site, $page, 'g-avantage-1'	 , 3  , new Contenu    ($site,"Avantage 1"         ));
		cree_bloc($site, $page, 'g-avantage-2'	 , 3  , new Contenu    ($site,"Avantage 2"         ));
		cree_bloc($site, $page, 'g-avantage-3'	 , 3  , new Contenu    ($site,"Avantage 3"         ));
		cree_bloc($site, $page, 'g-avantage-4'	 , 3  , new Contenu    ($site,"Avantage 4"         ));
		cree_bloc($site, $page, 'g-avantage-5'	 , 3  , new Contenu    ($site,"Avantage 5"         ));
		cree_bloc($site, $page, 'g-avantage-6'	 , 3  , new Contenu    ($site,"Avantage 6"         ));
		cree_bloc($site, $page, 'g-adherez'      , 9  , new Contenu    ($site,"Adherez!"));
		cree_bloc($site, $page, 'g-membres'		 , 7  , new Membres    ($site));
		cree_bloc($site, $page, 'g-partenaires'	 , 2  , new Partenaires($site));
	fin_page($site);
}


function cree_page_r_bibliographie(Site $site)
{
	$prefixe = 'r';
	$titre = "Bibliographie";
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, $prefixe . '-diapos'		, 5  , new Diaporama  ($site));
		cree_bloc($site, $page, $prefixe . '-liens'		    , 4  , new Liens      ($site));
		cree_bloc($site, $page, $prefixe . '-bibliographie'	, 9  , new Contenu    ($site,"Bibliopgraphie"));
		cree_bloc($site, $page, $prefixe . '-membres'		, 7  , new Membres    ($site));
		cree_bloc($site, $page, $prefixe . '-partenaires'	, 2  , new Partenaires($site));
	fin_page($site);
}

function cree_page(Site $site,  $numero, $nom)
{
	$page = new Page($site, $numero, $nom);
	$site->page_courante = $page;
	$site->pages[]=$page;
	return $page;
}	


// Les blocs suivants sont les enfants de ce bloc.
// La page sera composée des enfants de ce bloc.
function cree_bloc_principal(Site $site, Page $page)
{
	$bloc = new Bloc($site, $page, 'page');
	$site->page_courante->indice_bloc = 0;
	$bloc->numero  = $site->page_courante->indice_bloc;
	$bloc->nom = 'principal';
	$bloc->largeur = 9;
	// Ajouter le bloc à la page courante
	$site->page_courante->blocs[] = $bloc;
}

function cree_bloc(Site $site,
				   Page $page,
				   $nom,
				   $largeur,
				   $contenu = null)
{
	$bloc = new Bloc($site, $page, 'sous_bloc');
	$bloc->numero  = ++$site->page_courante->indice_bloc;
	$bloc->nom     = $nom;
	$bloc->largeur = $largeur;
	$bloc->contenu = $contenu;
	// Ajouter le bloc au site
	$site->page_courante->blocs[] = $bloc;
}

function fin_page(Site $site)
{
	$site->page_courante = null;
}	

function affiche($t, $v)
{
    echo "<h2>$t</h2>";
	echo "<pre>";
	print_r($v);
	echo "</pre>";
	die();
}

?>   
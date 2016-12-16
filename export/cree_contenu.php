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
	vide_corbeille();
	//supprime_dernière_generation(); // !!!! Attention !!!!! //
	lis_derniers_identifiants($site);
	cree_pages($site);
	// affiche("Site", $site);
	$site->genere_export_xml();
}	

// Vide la vorbeille.
// Necessaire car les post mis à la corbeille existent toujours dans la base
// et bloquent l'ajout de nouveaux post avec la même étiquette (slug).
function vide_corbeille()
{
	$b = new Base_donnees();

	// Lire le dernier $post_id 	
	$r = $b->exec_sql( "DELETE                         "
					 . "  FROM `wp_posts`              "
					 . " WHERE `post_status` = 'trash' "  
					 );  
}

// Supprime les pages, homepage blocs, diaporamas, 
// et contenu instututionnels
// crées par l'import à partir du fichier export.xml
function supprime_dernière_generation()
{
	$b = new Base_donnees();

	// Avant le post 6989; tout avait été crée à la main.
	// Lire le dernier $post_id 	
	$r = $b->exec_sql( "DELETE              "
					 . "  FROM `wp_posts`   "
					 . " WHERE `ID` >= 7286" // !!!!!  
					 );  
}

function lis_derniers_identifiants(Site $site)
{
	$b = new Base_donnees();

	// Lire le dernier $post_id 	
	$r = $b->exec_sql( "SELECT MAX(ID) AS last_post_id "
					 . "  FROM wp_posts");
	$site->last_post_id = $r->last_post_id;
	echo 'Dernier post: ', $site->last_post_id, '<br>';
	
	// Lire la position du dernier sous bloc  	
	$r = $b->exec_sql( "SELECT MAX(menu_order) AS last_menu_order "
					 . "  FROM wp_posts"
					 . " WHERE post_type = 'homepage'");
	$site->last_menu_order = $r->last_menu_order;
	echo $site->last_menu_order, '<br>';
}

function cree_pages(Site $site)
{
	//cree_page_rejoignez_nous         ($site, 'g', "rejoignez-nous");
	//cree_page_bibliographie          ($site, 'r', "Bibliographie" );
	//cree_page_edito                  ($site, "i", "Editoriaux"    );
	//cree_page_actualites             ($site, "j", "Actualités");
	//cree_page_bibliotheque_actualites($site, "k", "Bibliothèque d'Actualités");
	//cree_page_boite_a_outils($site, "o", "Boîte à outils");
	//cree_page_histoire($site, "a", "Histoire");
	//cree_page_vision_missions($site, "b", "Notre Vision & Nos missions");
	//cree_page_membres_bureau($site, "c", "Membres de notre bureau");
	//cree_page_membres_et_partenaires($site, "d", "Membres et partenaires");
	//cree_page_action_DGE($site, "e", "Action collective DGE");
	//cree_page_realisations($site, "f", "Nos réalisations");
	  cree_page_actifs_immateriels($site, "gg", "Les 10 types d'Actifs Immatériels");
}

function cree_page_rejoignez_nous(Site $site, $prefixe, $titre)
{
	$page = cree_page($site, $prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'		, 5  , new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		 	, 4  , new Liens      ($site));
		cree_bloc($site, $page, 'mot-president'	, 9  , new Contenu    ($site,"Le mot du président"));
		cree_bloc($site, $page, 'avantage-1'	, 3  , new Contenu    ($site,"Avantage 1"         ));
		cree_bloc($site, $page, 'avantage-2'	, 3  , new Contenu    ($site,"Avantage 2"         ));
		cree_bloc($site, $page, 'avantage-3'	, 3  , new Contenu    ($site,"Avantage 3"         ));
		cree_bloc($site, $page, 'avantage-4'	, 3  , new Contenu    ($site,"Avantage 4"         ));
		cree_bloc($site, $page, 'avantage-5'	, 3  , new Contenu    ($site,"Avantage 5"         ));
		cree_bloc($site, $page, 'avantage-6'	, 3  , new Contenu    ($site,"A                                                                                                                            vantage 6"         ));
		cree_bloc($site, $page, 'adherez'      	, 9  , new Contenu    ($site,"Adherez!"));
		cree_bloc($site, $page, 'membres'		, 7  , new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	, 2  , new Partenaires($site));
	fin_page($site);
}

function cree_page_bibliographie(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'		, 5  , new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		    , 4  , new Liens      ($site));
		cree_bloc($site, $page, 'bibliographie'	, 9  , new Contenu    ($site,'Bibliographie','[search-form id="bibliographie" showall="1"]'));
		cree_bloc($site, $page, 'membres'		, 7  , new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	, 2  , new Partenaires($site));
	fin_page($site);
}

function cree_page_edito(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'		    , 5  , new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		        , 4  , new Liens      ($site));
		cree_bloc($site, $page, 'identite-edito'    , 9  , new Contenu    ($site,"identite-edito"));
		cree_bloc($site, $page, 'edito'	            , 6  , new Contenu    ($site,"Editorial",'[oi_affiche_dernier_editorial]'));
		cree_bloc($site, $page, 'editos-precedents'	, 3  , new Contenu    ($site,"edito-precedents"));
		cree_bloc($site, $page, 'membres'		    , 7  , new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	    , 2  , new Partenaires($site));
	fin_page($site);
}

function cree_page_actualites(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'		    	, 5  , new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		        	, 4  , new Liens      ($site));
		cree_bloc($site, $page, 'actualité'         	, 9  , new Contenu    ($site,"Actualités",'[search-form id="actualites" showall="1"]'));
		cree_bloc($site, $page, 'membres'		    	, 7  , new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	    	, 2  , new Partenaires($site));
	fin_page($site);
}

function cree_page_bibliotheque_actualites(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'		    		, 5  , new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		        		, 4  , new Liens      ($site));
		cree_bloc($site, $page, 'actualites'         		, 6  , new Contenu    ($site,"Actualités",'[search-form id="actualites" showall="1"]'));
		cree_bloc($site, $page, 'actualites-plus-partagees'	, 3  , new Contenu    ($site,"Actualités les plus partagées",'[search-form id="actualites" showall="1"]'));
		cree_bloc($site, $page, 'membres'		    		, 7  , new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	    		, 2  , new Partenaires($site));
	fin_page($site);
}

function cree_page_boite_a_outils(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'		    	, 5  , new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		        	, 4  , new Liens      ($site));
		cree_bloc($site, $page, 'outils'         		, 6  , new Contenu    ($site,
		                                                                       "Outils",
																			   '[search-form id="outils" showall="1"]'));
		cree_bloc($site, $page, 'outils-plus-partagees'	, 3  , new Contenu    ($site,
																			   "Outils les plus partagés",
																			   '[search-form id="outils-liste" showall="1"]'));
		cree_bloc($site, $page, 'membres'		    	, 7  , new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	    	, 2  , new Partenaires($site));
	fin_page($site);
}

function cree_page_histoire(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'		    	, 5  , new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		        	, 4  , new Liens      ($site));
		cree_bloc($site, $page, 'histoire'         		, 9  , new Contenu    ($site,
		                                                                       "Notre histoire",
																			   '[oi_affiche_un_seul_contenu id ="7095"]'));
		cree_bloc($site, $page, 'membres'		    	, 7  , new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	    	, 2  , new Partenaires($site));
	fin_page($site);
}


function cree_page_vision_missions(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'		    	, 5  , new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		        	, 4  , new Liens      ($site));
		cree_bloc($site, $page, 'vision-missions'  		, 9  , new Contenu    ($site,
		                                                                       "Notre histoire",
																			   '[oi_affiche_un_seul_contenu id ="7109"]'));
		cree_bloc($site, $page, 'membres'		    	, 7  , new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	    	, 2  , new Partenaires($site));
	fin_page($site);
}

function cree_page_membres_bureau(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'		    	, 5  , new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		        	, 4  , new Liens      ($site));
		cree_bloc($site, $page, 'fonction-bureau'  		, 9  , new Contenu    ($site,"fonction-bureau",''));
		cree_bloc($site, $page, 'membres-bureau'  		, 9  , new Contenu    ($site,"membres-bureau" ,''));
		cree_bloc($site, $page, 'membres'		    	, 7  , new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	    	, 2  , new Partenaires($site));
	fin_page($site);
}

function cree_page_membres_et_partenaires(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'	   , 5, new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		   , 4, new Liens      ($site));
		cree_bloc($site, $page, 'Nos Membres'  , 9, new Contenu    ($site,"Nos Membres",''));
		cree_bloc($site, $page, 'audit_conseil', 6, new Contenu    ($site,"entreprises" ,''));
		cree_bloc($site, $page, 'entreprises'  , 3, new Contenu    ($site,"entreprises" ,''));
		cree_bloc($site, $page, 'academique'   , 6, new Contenu    ($site,"academique" ,''));
		cree_bloc($site, $page, 'public'  	   , 3, new Contenu    ($site,"public" ,''));
		cree_bloc($site, $page, 'partenaires'  , 9, new Partenaires($site));
	fin_page($site);
}

// 
function cree_page_action_DGE(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'	      , 5, new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		      , 4, new Liens      ($site));
		cree_bloc($site, $page, 'action_DGE'      , 9, new Contenu    ($site,"L'action collective avec la DGE"  ,''));
		cree_bloc($site, $page, 'sujets_a_venir'  , 6, new Contenu    ($site,"Les sujets de travail à venir"    ,''));
		cree_bloc($site, $page, 'college_experts' , 3, new Contenu    ($site,"Un collège des Experts"           ,'Description des rôles et du fonctionnement'));
		cree_bloc($site, $page, 'sujets_en_cours' , 6, new Contenu    ($site,"Les sujets de travail en cours"   ,''));
		cree_bloc($site, $page, 'vide 1 ' 		  , 3, new Contenu    ($site,"Vide 1"           					,''));
		cree_bloc($site, $page, 'sujets_passes'   , 6, new Contenu    ($site,"Les sujets de travail passés"     ,''));
		cree_bloc($site, $page, 'vide 2 ' 		  , 3, new Contenu    ($site,"Vide 2"           						,''));
		cree_bloc($site, $page, 'membres'		  , 9, new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	  , 9, new Partenaires($site));
	fin_page($site);
}

function cree_page_realisations(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'	      , 5, new Diaporama  ($site));
		cree_bloc($site, $page, 'liens'		      , 4, new Liens      ($site));
		cree_bloc($site, $page, 'realisation'     , 6, new Contenu    ($site,"Réalisations"    ,'[search-form id="realisations" showall="1"]'));
		cree_bloc($site, $page, 'plus_partagees'  , 3, new Contenu    ($site,"Réalisations les plus partagées"           ,'[wpp post_type="realisation"]'));
		cree_bloc($site, $page, 'membres'		  , 9, new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	  , 9, new Partenaires($site));
	fin_page($site);
}

//
function cree_page_actifs_immateriels(Site $site, $prefixe, $titre)
{
	$page = cree_page($site,$prefixe, $titre);
		cree_bloc_principal($site, $page);
		cree_bloc($site, $page, 'diapos'	        , 5, new Diaporama  ($site));
		cree_bloc($site, $page, 'explications'      , 4, new Liens      ($site));
		cree_bloc($site, $page, 'les-10-types-ai'   , 9, new Contenu    ($site,
		                                                                 "Les 10 types d'Actifs Immatériels"    ,
																		 "[mindcat cat='les-10-types-dai' size=60 title='ACTIFS IMMATERIELS' hide_empty=0 count=0 max_level=2]"));
		cree_bloc($site, $page, 'membres'		    , 9, new Membres    ($site));
		cree_bloc($site, $page, 'partenaires'	    , 9, new Partenaires($site));
	fin_page($site);
}




function cree_page(Site $site,  $numero, $nom)
{
     
	echo "<hr><h1>cree_page( $numero, $nom)</h1>";
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
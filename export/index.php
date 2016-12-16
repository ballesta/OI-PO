<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<h1>Pour créer des pages et leurs blocs par un script</h1>
<h2>Définir page</h2>
		http://academie-immateriel.com/export/cree_contenu.php
	Une fonction par page :			
<pre>
		function cree_page_r_bibliographie(Site $site)
			{
			  $prefixe = 'r';
			  $titre = "Bibliographie";
			  $page = cree_page($site,$prefixe, $titre);
					  cree_bloc_principal($site, $page);
					  cree_bloc($site, $page, $prefixe . '-diapos'       , 5  , new Diaporama  ($site));
					  cree_bloc($site, $page, $prefixe . '-liens'        , 4  , new Liens      ($site));
					  cree_bloc($site, $page, $prefixe . '-bibliographie', 9  , new Contenu    ($site,"Bibliopgraphie"));
					  cree_bloc($site, $page, $prefixe . '-membres'      , 7  , new Membres    ($site));
					  cree_bloc($site, $page, $prefixe . '-partenaires'  , 2  , new Partenaires($site));
			  fin_page($site);
			}
</pre>
<h2>Générer script d'export</h2>
	<a href="http://oi-demo-5.ballesta.fr/export/cree_contenu.php">
		Générer avec "http://oi-demo-5.ballesta.fr/export/cree_contenu.php"
	</a>	
<h2>Transférer script vers poste local</h2>
	De /export/export.xml<br>
	Vers H:\telechargements\academie_immateriel\export\ export.xml
<h2>Importer dans WP</h2>
	Outils/Importer<br>
	Choisir fichier importé dans téléchargement<br>
	Affecter à Flore Naiman<br>

** fin ***

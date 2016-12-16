<?php
class Contenu_bloc
{
	function __construct(Site $site,$nom )
	{
		echo "Contenu_bloc: $nom";
		$this->nom = $nom;
		$this->post_id = null;
		$this->date = date("Y-m-d H:i:s");
	}
}

// Le contenu du bloc contient la référence vers un post qu'i sera généré
class Post_bloc extends Contenu_bloc
{
	function __construct(Site $site, $nom )
	{
		parent::__construct($site, $nom);
		$this->post_id = $site->prochain_post_id();
		echo "---- ---- ", $this->post_id, "<br>"; 
	}
}


// 
class Diaporama extends Post_bloc
{
	function __construct(Site $site,$nom = '')
	{
		parent::__construct($site,$nom);
	}

	function genere_export_xml(Site $site, Page $page, Bloc $bloc)
	{
	    $this->genere_diaporama($site, $page, $bloc);
		return "[oi_affiche_diaporama id={$this->post_id}]";
	}

	
	function genere_diaporama(Site $site, Page $page, Bloc $bloc)
	{
		// post id du diaporama à créer
		//$this->post_id = ++$site->last_post_id;
		//affiche("Site:",$this->site); 
		$nom_diaporama = $page->numero . '-diaporama';
		echo "nom_diaporama: $nom_diaporama<br>";
		$diaporama =<<<FIN
    <!-- Diaporama -->	
	<item>
		<title>$nom_diaporama</title>
		<link>http://oi-demo-5.ballesta.fr/?post_type=ml-slider&#038;p={$this->post_id}</link>
		<pubDate>Sat, 01 Aug 2015 21:21:15 +0000</pubDate>
		<dc:creator><![CDATA[bb]]></dc:creator>
		<guid isPermaLink="false">http://oi-demo-5.ballesta.fr/?post_type=ml-slider&#038;p={$this->post_id}</guid>
		<description></description>
		<content:encoded><![CDATA[]]></content:encoded>
		<excerpt:encoded><![CDATA[]]></excerpt:encoded>
		<wp:post_id>{$this->post_id}</wp:post_id>
		<wp:post_date>{$this->date}</wp:post_date>
		<wp:post_date_gmt>{$this->date}</wp:post_date_gmt>
		<wp:comment_status>open</wp:comment_status>
		<wp:ping_status>open</wp:ping_status>
		<wp:post_name>$nom_diaporama</wp:post_name>
		<wp:status>publish</wp:status>
		<wp:post_parent>0</wp:post_parent>
		<wp:menu_order>0</wp:menu_order>
		<wp:post_type>ml-slider</wp:post_type>
		<wp:post_password></wp:post_password>
		<wp:is_sticky>0</wp:is_sticky>
		<wp:postmeta>
			<wp:meta_key>ml-slider_settings</wp:meta_key>
			<wp:meta_value><![CDATA[a:35:{s:4:"type";s:10:"responsive";s:6:"random";s:5:"false";s:8:"cssClass";s:0:"";s:8:"printCss";s:4:"true";s:7:"printJs";s:4:"true";s:5:"width";s:3:"600";s:6:"height";s:3:"400";s:3:"spw";s:1:"7";s:3:"sph";s:1:"5";s:5:"delay";s:4:"4000";s:6:"sDelay";s:2:"30";s:7:"opacity";s:1:"0";s:10:"titleSpeed";s:3:"500";s:6:"effect";s:4:"fade";s:10:"navigation";s:4:"true";s:5:"links";s:4:"true";s:10:"hoverPause";s:4:"true";s:5:"theme";s:7:"default";s:9:"direction";s:10:"horizontal";s:7:"reverse";s:5:"false";s:14:"animationSpeed";s:4:"1500";s:8:"prevText";s:1:"<";s:8:"nextText";s:1:">";s:6:"slices";s:2:"15";s:6:"center";s:4:"true";s:9:"smartCrop";s:4:"true";s:12:"carouselMode";s:5:"false";s:14:"carouselMargin";s:1:"5";s:6:"easing";s:13:"easeInOutQuad";s:8:"autoPlay";s:4:"true";s:11:"thumb_width";i:150;s:12:"thumb_height";i:100;s:9:"fullWidth";s:4:"true";s:10:"noConflict";s:5:"false";s:12:"smoothHeight";s:5:"false";}]]></wp:meta_value>
		</wp:postmeta>
	</item>

FIN;
	$site->f->write($diaporama);	
}
}

// 
class Liens extends Contenu_bloc
{
	function __construct(Site $site, $nom = '')
	{
		parent::__construct($site, $nom);
	}

	function genere_export_xml()
	{
		return "[oi_affiche_liens_slogan]";
	}	
}


// 
class Contenu extends Post_bloc
{
	function __construct(Site $site, $nom = '', $contenu='')
	{
		parent::__construct($site, $nom);
		$this->contenu = $contenu;
	}

	function genere_export_xml(Site $site, Page $page, Bloc $bloc)
	{
	    $this->genere_contenu($site, $page, $bloc);
		return "[oi_affiche_un_seul_contenu id={$this->post_id}]";
	}	
	
	// Génère le post correpondant au contenu du bloc
	function genere_contenu(Site $site, Page $page, Bloc $bloc)
	{
		// Post id du post à créer
		// $this->post_id = ++$site->last_post_id;
		//affiche("Site:",$this->site); 
		$nom_post = $page->numero . '-' . $bloc->nom;
		echo "$nom_post: $nom_post<br>";
		$post =<<<FIN
		
    <!-- Post de contenu d'un bloc -->	
	<item>
		<title>{$this->nom}</title>
		<link>http://oi-demo-5.ballesta.fr/contenu-instit/{$bloc->nom}/</link>
		<pubDate>Thu, 24 Sep 2015 16:39:28 +0000</pubDate>
		<dc:creator><![CDATA[bb]]></dc:creator>
		<guid isPermaLink="false">http://oi-demo-5.ballesta.fr/?post_type=contenu-instit&#038;p={$this->post_id}</guid>
		<description>{$this->nom}</description>
		<content:encoded><![CDATA[{$this->contenu}]]></content:encoded>
		<excerpt:encoded><![CDATA[]]></excerpt:encoded>
		<wp:post_id>{$this->post_id}</wp:post_id>
		<wp:post_date>{$this->date}</wp:post_date>
		<wp:post_date_gmt>{$this->date}</wp:post_date_gmt>
		<wp:comment_status>closed</wp:comment_status>
		<wp:ping_status>closed</wp:ping_status>
		<wp:post_name>$nom_post</wp:post_name>
		<wp:status>publish</wp:status>
		<wp:post_parent>0</wp:post_parent>
		<wp:menu_order>0</wp:menu_order>
		<wp:post_type>contenu-instit</wp:post_type>
		<wp:post_password></wp:post_password>
		<wp:is_sticky>0</wp:is_sticky>
		<wp:postmeta>
			<wp:meta_key>_edit_last</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_thumbnail_id</wp:meta_key>
			<wp:meta_value><![CDATA[980]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_wp_old_slug</wp:meta_key>
			<wp:meta_value><![CDATA[titre-ci]]></wp:meta_value>
		</wp:postmeta>
	</item>

FIN;
	$site->f->write($post);		
	}
}
// 
class  Membres extends Contenu_bloc
{
	function __construct(Site $site, $nom = '')
	{
		parent::__construct($site, $nom);
	}

	function genere_export_xml()
	{
		return "[oi_affiche_logos_membres]";
	}	
}

// 
class partenaires extends Contenu_bloc
{
	function __construct(Site $site, $nom = '')
	{
		parent::__construct($site, $nom);
	}

	function genere_export_xml()
	{
		return "[oi_affiche_logos_partenaires]";
	}	
}


?>
<?php
class Bloc
{
	function __construct(Site $site, Page $page, $type)
	{
		$this->site = $site;
		$this->post_id = $site->prochain_post_id();
		$this->menu_order  = ++$this->site->last_menu_order;
		$this->contenu = null;
				
		if ($type == 'page')
		{
			// Bloc correspondant à la page (pas de parent).
			$this->post_id_parent = 0;
			// Les bloc suivants seront raccrochés à ce bloc
			// (Sous blocs de ce bloc ).
			//$this->site->last_post_id_parent = $this->post_id;
			$page->bloc_principal = $this->post_id;
			//$this->site->last_post_id_parent = $this->post_id;
		}
		else
		{
			$this->post_id_parent = $page->bloc_principal;
		}	
		echo "---- ", $this->post_id, "<br>";
	}
	
	function genere_export_xml(Site $site, Page $page)
	{
		$contenu = '';
		if ($this->contenu != null)
		{
			$contenu = $this->contenu->genere_export_xml($site, $page, $this);
		}
		// "x99"
		$nom_page = $page->numero 
		          . sprintf("%02d", $this->numero)
				  . '-'
				  . $this->nom;

		echo '---- ', $nom_page 		, ' ',  
		              $this->post_id	, ' ', 
		              'Largeur: ',$this->largeur	, ' ', 
					  $this->menu_order	, ' ==> ',
					  $contenu,
					  '<br/>';
// ------------------------------------------------------------------
		$block=<<<FIN
   	<!-- Bloc -->	
	<item>
		<title>$nom_page</title>
		<link>http://localhost/oi_demo_5_test/homepage/{$this->nom}/</link>
		<pubDate>Sun, 28 Jun 2015 10:47:22 +0000</pubDate>
		<dc:creator><![CDATA[bb]]></dc:creator>
		<guid isPermaLink="false">http://localhost/oi-demo-4/?post_type=homepage&#038;p={$this->post_id}</guid>
		<description></description>
		<content:encoded><![CDATA[$contenu]]></content:encoded>
		<excerpt:encoded><![CDATA[]]></excerpt:encoded>
		<wp:post_id>{$this->post_id}</wp:post_id>
		<wp:post_date>2015-06-28 11:47:22</wp:post_date>
		<wp:post_date_gmt>2015-06-28 10:47:22</wp:post_date_gmt>
		<wp:comment_status>closed</wp:comment_status>
		<wp:ping_status>closed</wp:ping_status>
		<wp:post_name>$nom_page</wp:post_name>
		<wp:status>publish</wp:status>
		<wp:post_parent>{$this->post_id_parent}</wp:post_parent>
		<wp:menu_order>{$this->menu_order}</wp:menu_order>
		<wp:post_type>homepage</wp:post_type>
		<wp:post_password></wp:post_password>
		<wp:is_sticky>0</wp:is_sticky>
		<wp:postmeta>
			<wp:meta_key>_edit_last</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>om_homepage_size</wp:meta_key>
			<wp:meta_value><![CDATA[{$this->largeur}]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_views_template</wp:meta_key>
			<wp:meta_value><![CDATA[0]]></wp:meta_value>
		</wp:postmeta>
	</item>

FIN;
// ------------------------------------------------------------------
  		$this->site->f->write($block);
		//echo '<hr>';

	}
}
?>
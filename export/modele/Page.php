<?php
class Page
{
	function __construct(Site $site, $numero, $nom)
	{
		$this->numero = $numero;
		$this->nom = $nom;
		// Les post_id sont affectés à la création des modeles.
		// ILs sont mémorisés dans les objets (dans la page dans ce cas)
		// pour être ensuite utilisés dans la génération de l'export en xml. 
		$this->post_id = $site->prochain_post_id();
		echo  "$numero $nom {$this->post_id} <br>";
	}
	
	function genere_export_xml(Site $site)
	{	
		// Blocs à générer avant la page.
		// La page fait référence au bloc principal qui doit exister.
		foreach ($this->blocs as $bloc)
		{
			$bloc->genere_export_xml($site, $this);
		}
		$this->genere_page($site);
	}
	
	function genere_page(Site $site)
	{
		// Id de la page
		$post_id = $this->post_id;
		// Titre et nom de la page
		$post_name = $this->numero . '-' . $this->nom;
		echo "genere_page: $post_name<br>";
		// Bloc principal de la page
		$homepage_block = $this->bloc_principal;
	    echo "Page:$post_id<br>"; 
		echo "this->bloc_principal:$this->bloc_principal<hr>";
		$page =<<<FIN
	<!-- Page -->	
	<item>
		<title>$post_name</title>
		<link>http://oi-demo-5.ballesta.fr/{$post_name}/</link>
		<pubDate>Thu, 25 Jun 2015 21:05:18 +0000</pubDate>
		<dc:creator><![CDATA[bb]]></dc:creator>
		<guid isPermaLink="false">http://oi-demo-5.ballesta.fr/?page_id=$post_id</guid>
		<description></description>
		<content:encoded><![CDATA[]]></content:encoded>
		<excerpt:encoded><![CDATA[]]></excerpt:encoded>
		<wp:post_id>$post_id</wp:post_id>
		<wp:post_date>2015-06-25 22:05:18</wp:post_date>
		<wp:post_date_gmt>2015-06-25 21:05:18</wp:post_date_gmt>
		<wp:comment_status>closed</wp:comment_status>
		<wp:ping_status>closed</wp:ping_status>
		<wp:post_name>$post_name</wp:post_name>
		<wp:status>publish</wp:status>
		<wp:post_parent>0</wp:post_parent>
		<wp:menu_order>0</wp:menu_order>
		<wp:post_type>page</wp:post_type>
		<wp:post_password></wp:post_password>
		<wp:is_sticky>0</wp:is_sticky>
		<wp:postmeta>
			<wp:meta_key>_views_template</wp:meta_key>
			<wp:meta_value><![CDATA[29]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_edit_last</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_wp_page_template</wp:meta_key>
			<wp:meta_value><![CDATA[template-home.php]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>om_homepage_blocks</wp:meta_key>
			<wp:meta_value><![CDATA[$homepage_block]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>om_portfolio_categories</wp:meta_key>
			<wp:meta_value><![CDATA[0]]></wp:meta_value>
		</wp:postmeta>
	</item>
	
FIN;
		$site->f->write($page);	
	}
}

?>
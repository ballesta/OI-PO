<?php
/*
Plugin Name: observatoire_immateriel Image Hover effects 
Description: Image Hover effects 
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

// Dossier Racine	  
define( 'IMAGE_HOVER_ROOT'   , plugins_url( '', __FILE__ ) );
// Dossier Styles (CSS)
define( 'IMAGE_HOVER_STYLES' , IMAGE_HOVER_ROOT . '/css/'  );
// Dossier scripts (js)	  
define( 'IMAGE_HOVER_SCRIPTS', IMAGE_HOVER_ROOT . '/js/'   );

OI_image_hover::init();

// Classe statique contenant et isolant les extensions propres à l'OI 
class OI_image_hover
{

	// Initialisation
	static function init()
	{
		// Inclut les CSS du plugin
		add_action( 'wp_enqueue_scripts', 'OI_image_hover::include_scripts' );
	}

	// Inclut les CSS et les scripts js
	static function include_scripts() {
		wp_enqueue_style('oi_image_hover_default'  , IMAGE_HOVER_STYLES . 'oi_default.css'  , false, '0.1', 'all');
		wp_enqueue_style('oi_image_hover_component', IMAGE_HOVER_STYLES . 'oi_component.css', false, '0.1', 'all');
	}
	
	// Image avec hover et lien
	static function image_reactive($image_url, $titre, $texte, $lien, $texte_bouton) 
	{
		$html= ''
			 . '<div class="oi_ih_container">'		
			 . '	<ul class="oi_ih_grid cs-style-3">'
			 . '		<li>'
			 . '			<figure>'
			 . '				<div>'
			 . '	                <img src="'. $image_url . '">'
			 . '				</div>'
			 . '				<figcaption>'
			 . '					<h3>' . $titre . '</h3>'
			 . '					<span>' . $texte . '</span>'
			 . '					<a href="' . $lien .'"' .' target=_blank>'
			 . 						    $texte_bouton
			 . '					</a>'
			 . '				</figcaption>'
			 . '			</figure>'
			 . '		</li>'
			 . '	</ul>'
			 . '</div>'			 
			 ;		 
		return $html;
	}
}	
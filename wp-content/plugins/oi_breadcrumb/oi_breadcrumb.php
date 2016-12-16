<?php
/*
Plugin Name: OI Breadcrumb
Description: Affiche breadcrumb
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

OI_breadcrumb::init();

// Classe statique contenant et isolant les extensions propres à l'OI 
class OI_breadcrumb
{

	// Initialisation
	static function init()
	{
		OI::add_shortcode( 'affiche_breadcrumb', 'OI_breadcrumb');
	}
	
	static function affiche_breadcrumb()
	{
	    $b = '';
		if(get_option(OM_THEME_PREFIX . 'show_breadcrumbs') 
		   == 
		   'true'):
            $caption = get_option(OM_THEME_PREFIX . 'breadcrumbs_caption');	   
			$b = self::om_breadcrumbs($caption);
			
		endif;
		return $b;
	}
	
	// Breadcrumb à partir de la page courante par les liens de parentés
	static	function om_breadcrumbs($caption='', 
	                                $before='<div class="breadcrumbs">', 
									$after='</div>', 
									$separator=' > ') 
	{
		global $page_post; 
		
		$show_last=(get_option(OM_THEME_PREFIX . 'breadcrumbs_show_current') == 'true');
		$show_last=false; //++++
		
		$out = [];
	
		if($show_last)
		{
			$out[]=$page_post->post_title;
			self::om_breadcrumbs_add_parents($out,$page_post);
		}
	
		// Remonte sur le lien "parent" ++++
		
		if(!empty($out)) 
		{
			//$out[] = '<a href="'. home_url() .'">'
			//       .     __('Accueil','om_theme')
			//	   .'</a>';
			return   $before 
			       . $caption 
				   . implode( $separator, array_reverse($out)) 
				   . (!$show_last ? $separator.'' : '') 
				   . $after;
		}
	}


	static function om_breadcrumbs_add_parents(&$out,$post) 
	{

		if($post->post_parent) 
		{
			$parent=$post->post_parent;
			while($parent) 
			{
				$tmp=get_post($parent);
				if($tmp) 
				{
					$out[]=  '<a href="'. get_permalink($tmp->ID) .'">'
						   .     $tmp->post_title
						   . '</a>';
					$parent=$tmp->post_parent;
				} 
				else 
				{
					break;
				}
			}
		}

	}
}	

<?php
/*
Plugin Name: Extensions bbPress
Description: Ajoute extraits, breadcrumb, ...
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

OI_bbpress::init();

// Classe statique contenant et isolant les extensions propres à l'OI 
class OI_bbpress
{
	// Initialisation
	// Crée les filtres et les actions
	static function init()
	{ 
		add_filter( 'bbp_get_form_forum_parent', 'OI_bbpress::get_form_forum_parent', 10, 2 );
		add_filter( 'bbp_get_caps_for_role'    , 'OI_bbpress::add_role_caps_filter' , 10, 2 );
		add_filter( 'bbp_get_dynamic_roles'    , 'OI_bbpress::add_new_roles'        , 1 );
		// 29/01/2016: Formulaire de création pour membres ++++
	    // OI::add_shortcode('cree_forum_pfa', 'OI_bbpress');
		add_filter('bbp_before_get_breadcrumb_parse_args', 
		           'OI_bbpress::breadcrumb_options');
		add_action('bbp_theme_after_topic_title',
		           'OI_bbpress::add_topic_description_label');
		add_action('bbp_theme_before_topic_form_content',
		           'OI_bbpress::description_label');
		add_filter('bbp_get_single_forum_description', 
		           'OI_bbpress::single_forum_description');
		//add_action('bbp_template_before_forums_loop',
		//           'OI_bbpress::add_new_forum');
		// Trace all actions
		//add_action( 'all', 'OI_bbpress::trace'  );	
		add_filter('bbp_no_breadcrumb', 
		           'OI_bbpress::supprime_breadcrumb' );
		add_filter('bbp_get_breadcrumb', 
		           'OI_bbpress::change_breadcrumb_text' );
		//add_action( 'wp_insert_post', 
		//			'OI_bbpress::insert_forum' );		
		add_filter('bbp_get_form_forum_content', 
		           'OI_bbpress::bbp_get_form_forum_content' );
		add_filter('bbp_get_forum_content', 
		           'OI_bbpress::bbp_get_forum_content' );
		// Modif auteurs (Forums, sujets, réponses)
		// Pour attribuer tous les forums à FNA et pas à BB
		// 15/02/2016
		add_action('init',
		           'OI_bbpress::allowAuthorEditing');	
		// do_action( 'get_template_part_' . $slug, $slug, $name );				   
	}
	

// 	Modif auteurs (Forums, sujets, réponses)
static function allowAuthorEditing()
{
	add_post_type_support( 'forum'   , 'author' );
	add_post_type_support( 'topic'   , 'author' );
	add_post_type_support( 'response', 'author' );
}

	
// PFA par defaut dans boite déroulante Forum parent	
static function get_form_forum_parent($parent)
{
	if ($parent == 0):
		$parent = 960; // PFA
	endif;
	return $parent;
}	

// Ajoute le role dynamique 'bbp_membre_adherent' 
// bb 29/01/2016

// Permet à un adhérent de créer un forum sur la PFA
//
// Utilisation:
// 		Page: Accueil 
//			> Bouton: Accéder à la plateforme d’échange entre adhérents
//      		> Lien: Ajouter un nouveau forum

// Pas besoin de filtrer sur le role membre car seul les membres ont accès à la PFA

static function add_new_roles( $bbp_roles )
{
    /* Add a role called tutor */
    $bbp_roles['bbp_membre_adherent'] = array(
        'name' => 'Membre adhérent',
        'capabilities' => self::custom_capabilities( 'bbp_membre_adherent' )
        );
    return $bbp_roles;
}
 
static function add_role_caps_filter( $caps, $role )
{
    /* Only filter for roles we are interested in! */
    if( $role == 'bbp_membre_adherent' )
        $caps = self::custom_capabilities( $role );
    return $caps;
}

static function custom_capabilities( $role )
{
    switch ( $role )
    {
 
        /* Capabilities for 'tutor' role */
        case 'bbp_membre_adherent':
            return array(
                // Primary caps
                'spectate'              => true,
                'participate'           => true,
                'moderate'              => false,
                'throttle'              => false,
                'view_trash'            => false,
 
                // Forum caps
                'publish_forums'        => true,
                'edit_forums'           => true, // bb+
                'edit_others_forums'    => false,
                'delete_forums'         => false,
                'delete_others_forums'  => false,
                'read_private_forums'   => true,
                'read_hidden_forums'    => false,
 
                // Topic caps
                'publish_topics'        => true,
                'edit_topics'           => true, 
                'edit_others_topics'    => false,
                'delete_topics'         => false,
                'delete_others_topics'  => false,
                'read_private_topics'   => true,
 
                // Reply caps
                'publish_replies'       => true,
                'edit_replies'          => true,
                'edit_others_replies'   => false,
                'delete_replies'        => false,
                'delete_others_replies' => false,
                'read_private_replies'  => true,
 
                // Topic tag caps
                'manage_topic_tags'     => false,
                'edit_topic_tags'       => true,
                'delete_topic_tags'     => false,
                'assign_topic_tags'     => true,
            );

        default :
            return $role;
    }
}
// Fin roles	 
	
	static function cree_forum_pfa()
	{
		ob_start();	
	
		echo
		  '<div id="new-forum class="bbp-forum-form">'
		. '		<form id="new-post" name="new-post" method="post" action="' . the_permalink() . '">'
		. '			<fieldset class="bbp-form">'
		. '				<legend>'
		. '		 		   Nouveau Forum'		
		. '		        </legend>';

		if ( current_user_can( 'unfiltered_html' ) ) : 
			echo
					  '<div class="bbp-template-notice">'
					. '	<p>Votre statut sur ce forum vous permet de poster du contenu HTML sans restriction</p>'
					. '</div>';
		endif;

		echo
			  '	 <p>'
			. '		<label for="bbp_forum_title">'
			. '         Nom du forum'
			. '     </label><br />'
			. '			<input type="text" id="bbp_forum_title"  size="100%" name="bbp_forum_title" maxlength="100" />'
			. '	</p>';
		
		bbp_the_content( array( 'context' => 'forum' ) );

		echo 
					  '<input type="hidden" name="bbp_forum_type" 		value="forum">'
					. '<input type="hidden" name="bbp_forum_status" 	value="open">'
					. '<input type="hidden" name="bbp_forum_visibility" value="publish">'		
					. '<input type="hidden" name="bbp_forum_parent_id" 	value="960">'		
					. '<div class="bbp-submit-wrapper">'
					. '	<button type="submit"  id="bbp_forum_submit" name="bbp_forum_submit" class="button submit">'
					. '    Créer nouveau forum'
					. '	</button>'
					. '</div>'
					//. bbp_forum_form_fields()
					. '</fieldset>'
				. '</form>'
			. '</div>';
		$formulaire_forum = ob_get_contents();
		ob_end_clean();
		return  $formulaire_forum;
	}
	
	static function insert_forum( $post_id ) 
	{
		$post = get_post($post_id);
		OI::affiche($post , '$post');
		//$meta = get_post_meta( $post_id );
		//OI::affiche($meta , '$meta');	
		$post->post_parent = 960; // Forcer PFA	
		//wp_update_post( $post );
	}

	function supprime_breadcrumb($args) 
	{ 
		//OI::affiche($args); die();
		//return true; 
		return false;
	} 
	
	function change_breadcrumb_text($trail) 
	{
		//OI::affiche(htmlentities ($trail));
		$trail = str_replace ('Forums','',$trail) ;
		$trail = str_replace ('pfa00-Plateforme adhérents','',$trail) ;
		return $trail ;
	}
	
	static function trace() 
	{
		$f = current_filter();
		if (self::startsWith($f, 'bbp_')):
			echo "<code>$f</code><br>";
		endif;	
	}
	
	static function startsWith($haystack, $needle) 
	{
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
	
	
	static function breadcrumb_options() 
	{
	    $args = [];
		// Home - default = true
		$args['include_home']    = false;
		// Forum root - default = true
		$args['include_root']    = true;
		// Current - default = true
		$args['include_current'] = true;	 
		return $args;
	}
	
	static function add_topic_description_label() 
	{
	   	echo '<hr>';
		bbp_topic_excerpt();
	}

	static function description_label() 
	{
       echo '<label for="bbp-the-content">';
	   echo     'Description du sujet';
	   echo '</label>';
	   //echo '<hr>';
	}

	static function single_forum_description($val, $attr = [], $content = null) 
	{
       return '';
	}
	
	// Ajoute le lien de creation de nouveau forum
	// Action bbp_template_before_single_forum
	static function add_new_forum() 
	{
       echo '*** --- Crée un nouveau forum ***<br>';
	}
	
	static function bbp_get_form_forum_content($forum_content)
	{
		return  $forum_content;
	}
	
	static function bbp_get_forum_content($content ) 
	{
		return  wp_trim_words($content, $num_words = 55, $more = null);
	}
	
}
<?php
/*
Plugin Name: oi_custom_types
Description: Manage custom types (delete, clone, batch operations)
Version:     1.0
Author:      Bernard BALLESTA
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: OI
*/
 
defined( 'ABSPATH' ) 
or die( '<h1>Syntaxe programme correcte</h1>'
      . '<h3>vous pouvez integrer ce plugin dans le site</h3>' );

	  
OI_custom_types::init(); 
 
// Classe statique contenant et isolant les extensions propres ра l'OI 
class OI_custom_types
{

	// Initialisation du plugin
	static function init()
	{
		OI::add_shortcode('copy_custom_posts','OI_custom_types');
		//die('OI_custom_types::init()');
	}
	
	
	// Bulk copy of custom posts types to other custom posts types.
	// Copy all posts changing post type.
	static function copy_custom_posts($source_post_type='membre' ,
									  $destination_post_type='annuaire-membres' )
	{
		global $wpdb;
		
		$source_post_type='membre';
		$destination_post_type='annuaire-membres';
		
		self::delete_destination_custom_posts($destination_post_type);
		
		// Get all sources posts
		$all_posts = -1;
		$source_posts = get_posts ( ['post_type' 		=> $source_post_type,
									 'posts_per_page'	=> $all_posts
									] 
								  );
		if ($source_posts):
			foreach ($source_posts as $post)
			{
				//if ($post->post_title == 'Winnotek'):  //+++++
				//if ($post->post_title != 'Test'):  //+++++
					// Post data exists? create the post duplicate
					if (isset( $post ) && $post != null):
						//  Create the post duplicate just changing the post type to destination post type
						self::duplicate_custom_post($source_post_type, $post, $destination_post_type);
					endif;
				//endif;
			}
		else:
			echo "No '$source_post_type' to copy<br>";
		endif;		
	}	

	static function delete_destination_custom_posts($destination_post_type)
	{
		$all_posts = -1;
		$destination_posts = get_posts ( ['post_type' 		=> $destination_post_type,
								          'posts_per_page'	=> $all_posts
								         ] 
							           );
		if ($destination_posts):
			foreach ($destination_posts as $post)
			{
			    // Post data exists? create the post duplicate
				if (isset( $post ) && $post != null):
				    // Delete's each post.
					wp_delete_post( $post->ID, true);
				endif;
			}
		else:
			echo "No '$destination_post_type' to delete<br>";
		endif;		

	}

	// Duplicate source post.
	// Creates one destination post per member for each person.
	// Example for Member Winnotek:
	//		- Create one post for Pierre ollivier
	//		- And one other for Philippe Simon
	static function  duplicate_custom_post($source_post_type, $post, $destination_post_type)
	{
		//echo $source_post_type, ' ',$post->post_type, ' ', $post->post_title, '<br> ';
		//echo  'POST: ', $post->post_title, '<br> ';
		
		$post_id = $post->ID;

		// Get all person in member 
		$persons_jobs = get_field('personnes_physiques', $post_id);
		//OI::affiche($persons_jobs);
		if ($persons_jobs):	
			foreach ($persons_jobs as $personne_fonction):
				self::create_annuaire_membre($source_post_type, 
											 $post, 
											 $destination_post_type,
											 $personne_fonction);
			endforeach; // person
		endif;
	} // duplicate_custom_post

	// Create person member combining member and person fields
	static function	create_annuaire_membre($source_post_type, 
										   $post, 
										   $destination_post_type, 
										   $personne_fonction)
	{
		$post_id = $post->ID;
		// Get person (=user) and function in member organisation
		$p = $personne_fonction['personne_membre_oi'];

		// Construct new post default values	
		$args = 
		[
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => $post->post_status,
			'post_type'      => $destination_post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		];

		if (isset($p['display_name'])):
			$args['post_title'] = $p['display_name'];
		endif;
		// Insert the new post 
		$new_post_id = wp_insert_post( $args );
		//echo $new_post_id, '<br>';
		
		// Add meta for person
		if (isset($p['user_avatar'])):
			self::add_person_post_meta($new_post_id, 
									   'photo',
									   $p['user_avatar']);
		endif;
		if (isset($p['user_lastname'])):		
			self::add_person_post_meta($new_post_id, 
									   'nom-famille', 
									   $p['user_lastname']);
		endif;
		if (isset($personne_fonction['fonction'])):		
			self::add_person_post_meta($new_post_id, 
									   'fonction', 
									   $personne_fonction['fonction']);
		endif;
		if (isset($post->post_title)):		
			self::add_person_post_meta($new_post_id, 
									   'entreprise', 
									   $post->post_title);
		endif;
		if (isset($p['user_email'])):		
			self::add_person_post_meta($new_post_id, 
									   'email', 
									   $p['user_email']);
		endif;
		
		// Get all current post terms and set them to the newly created post.
		// Returns array of taxonomy names for post type, ex array("category", "post_tag");
		$taxonomies = get_object_taxonomies($post->post_type); 
		//OI::affiche($taxonomies, 'Taxonomies');
		// Returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) 
		{
		    //echo "taxonomy: $taxonomy <br>";
			// Get taxonomies of source post
		    //echo "post_id: $post_id <br>";
			$post_terms = wp_get_object_terms($post_id, 
			                                  $taxonomy, 
											  ['fields' => 'slugs']);
			//OI::affiche($post_terms, 'Values Taxo');					  
			// Transfert taxonomies to new destination post
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
	}

	// Add meta for person
	static function add_person_post_meta($new_post_id, $meta_key, $meta_value)
	{
		//echo "$meta_key: $meta_value <br>";
		add_post_meta($new_post_id, $meta_key, $meta_value);
	}
	
} // class OI_custom_types 
?>
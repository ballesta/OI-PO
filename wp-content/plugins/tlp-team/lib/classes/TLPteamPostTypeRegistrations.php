<?php

if(!class_exists('TLPteamPostTypeRegistrations')):

	class TLPteamPostTypeRegistrations {
		public function __construct() {
			// Add the team post type and taxonomies
			add_action( 'init', array( $this, 'register' ) );
		}
		/**
		 * Initiate registrations of post type and taxonomies.
		 *
		 * @uses Portfolio_Post_Type_Registrations::register_post_type()
		 */
		public function register() {
			$this->register_post_type();
		}
		public function activate() {
			flush_rewrite_rules();
		}
		/**
		 * Fired for each blog when the plugin is deactivated.
		 *
		 * @since 0.1.0
		 */
		public function deactivate() {
			flush_rewrite_rules();
		}
		/**
		 * Register the custom post type.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		protected function register_post_type() {
			$team_labels = array(
			    'name'                => _x( 'TLP Team', TPL_TEAM_SLUG ),
			    'singular_name'       => _x( 'Member', TPL_TEAM_SLUG ),
			    'menu_name'           => __( 'TLP Team', TPL_TEAM_SLUG ),
			    'name_admin_bar'      => __( 'Member', TPL_TEAM_SLUG ),
			    'parent_item_colon'   => __( 'Parent Member:', TPL_TEAM_SLUG ),
			    'all_items'           => __( 'All Members', TPL_TEAM_SLUG ),
			    'add_new_item'        => __( 'Add New Member', TPL_TEAM_SLUG ),
			    'add_new'             => __( 'Add Member', TPL_TEAM_SLUG ),
			    'new_item'            => __( 'New Member', TPL_TEAM_SLUG ),
			    'edit_item'           => __( 'Edit Member', TPL_TEAM_SLUG ),
			    'update_item'         => __( 'Update Member', TPL_TEAM_SLUG ),
			    'view_item'           => __( 'View Member', TPL_TEAM_SLUG ),
			    'search_items'        => __( 'Search Member', TPL_TEAM_SLUG ),
			    'not_found'           => __( 'Not found', TPL_TEAM_SLUG ),
			    'not_found_in_trash'  => __( 'Not found in Trash', TPL_TEAM_SLUG ),
			);
			$team_args = array(
			    'label'               => __( 'TLP Team', TPL_TEAM_SLUG ),
			    'description'         => __( 'Member', TPL_TEAM_SLUG ),
			    'labels'              => $team_labels,
			    'supports'            => array( 'title', 'editor','thumbnail', 'page-attributes' ),
			    'taxonomies'          => array(),
			    'hierarchical'        => false,
			    'public'              => true,
			    'rewrite'            => true,
			    'show_ui'             => true,
			    'show_in_menu'        => true,
			    'menu_position'       => 5,
			    'menu_icon'              => 'dashicons-groups',
			    'show_in_admin_bar'   => true,
			    'show_in_nav_menus'   => true,
			    'can_export'          => true,
			    'has_archive'         => false,
			    'exclude_from_search' => false,
			    'publicly_queryable'  => true,
			    'capability_type'     => 'page',
			);
			global $TLPteam;
			register_post_type( $TLPteam->post_type, $team_args );
			flush_rewrite_rules();
		}
	}

endif;

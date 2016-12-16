<?php
/**
 * @package Export_Users_to_CSV
 * @version 1.0.0
 */
/*
Plugin Name: Export Users to CSV
Plugin URI: http://wordpress.org/extend/plugins/export-users-to-csv/
Description: Export Users data and metadata to a csv file.
Version: 1.0.0
Author: Ulrich Sossou
Author URI: http://ulrichsossou.com/
License: GPL2
Text Domain: export-users-to-csv
*/
/*  Copyright 2011  Ulrich Sossou  (http://github.com/sorich87)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

load_plugin_textdomain( 'export-users-to-csv', false, basename( dirname( __FILE__ ) ) . '/languages' );

/**
 * Main plugin class
 *
 * @since 0.1
 **/
class PP_EU_Export_Users 
{

	/**
	 * Class contructor
	 *
	 * @since 0.1
	 **/
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
		add_action( 'init', array( $this, 'generate_csv' ) );
		add_filter( 'pp_eu_exclude_data', array( $this, 'exclude_data' ) );
	}

	/**
	 * Add export capability to administration user menus
	 *
	 * @since 0.1
	 **/
	public function add_admin_pages() {
		add_users_page( __( 'Export to CSV', 'export-users-to-csv' ),
						__( 'Export to CSV', 'export-users-to-csv' ), 
						'list_users', 
						'export-users-to-csv', 
						array( $this, 'users_page' ) );
	}

	/**
	 * Generate CSV file to export from current user table
	 *
	 * @since 0.1
	 **/
	public function generate_csv() {
		if ( isset( $_POST['_wpnonce-pp-eu-export-users-users-page_export'] ) ) {
			check_admin_referer( 'pp-eu-export-users-users-page_export', 
			                     '_wpnonce-pp-eu-export-users-users-page_export' );
			$args = array(
				'fields' => 'all_with_meta',
				'role' => stripslashes( $_POST['role'] )
			);

			add_action( 'pre_user_query', array( $this, 'pre_user_query' ) );
			$users = get_users( $args );
			remove_action( 'pre_user_query', array( $this, 'pre_user_query' ) );

			if ( ! $users ) 
			{
				// No users: notify
				$referer = add_query_arg( 'error', 'empty', wp_get_referer() );
				wp_redirect( $referer );
				exit;
			}

			$sitename = sanitize_key( get_bloginfo( 'name' ) );
			if ( ! empty( $sitename ) )
				$sitename .= '.';
			$filename = $sitename . 'users.' . date( 'Y-m-d-H-i-s' ) . '.csv';

			// CSV text file destination
			header( 'Content-Description: File Transfer' );
			header( 'Content-Disposition: attachment; filename=' . $filename );
			header( 'Content-Type: text/csv; charset=' . get_option( 'blog_charset' ), true );

			$exclude_data = apply_filters( 'pp_eu_exclude_data', array() );

			global $wpdb;

			$data_keys = array(
				'ID', 'user_login', 'user_pass',
				'user_nicename', 'user_email', 'user_url',
				'user_registered', 'user_activation_key', 'user_status',
				'display_name'
			);
			$meta_keys = $wpdb->get_results( "SELECT distinct(meta_key) FROM $wpdb->usermeta" );
			$meta_keys = wp_list_pluck( $meta_keys, 'meta_key' );
			$fields = array_merge( $data_keys, $meta_keys );

			$headers = array();
			foreach ( $fields as $key => $field ) {
				if (     in_array( $field, $exclude_data ) 
				    || (!in_array( $field, $this->fields_to_keep()) ) )
					// Remove field from list: will not be shown in export file
					unset( $fields[$key] );
				else
					// Include field in result
					$headers[] = '"' . strtolower( $field ) . '"';
			}
			
			//bb
			$utf8_bom = chr(239) . chr(187) . chr(191);
			echo $utf8_bom;
			
			// First line of excel sheet containing fields names
			echo implode( ';', $headers ) . "\n";

			foreach ( $users as $user ) {
				$data = array();
				foreach ( $fields as $field ) {
					$value = isset( $user->{$field} ) ? $user->{$field} : '';
					$value = is_array( $value ) ? serialize( $value ) : $value;
					$data[] = '"' . str_replace( '"', '""', $value ) . '"';
				}
				echo implode( ';', $data ) . "\n";
			}

			exit;
		}
	}

	/**
	 * List of fields to keep in export file
	 *
	 * @since 0.1
	 **/
	private function fields_to_keep() 
	{
		return
		[	"id",
			"user_login",
			"user_nicename",
			"user_email",
			"user_url",
			"user_registered",
			"user_status",
			"display_name",
			"nickname",
			"first_name",
			"last_name",
			"description",
			"wp_user_level",
			"userphoto_image_file",
			"dbem_name",
			"dbem_email",
			"dbem_address",
			"dbem_zip",
			"dbem_city",
			"dbem_country",
			"dbem_address_2",
			"dbem_company",
			"dbem_phone",
			"extended_user_info_phone_number",
			"extended_user_info_mobile_phone_number"
		];
	}	
	
	/**
	 * Export parameters page
	 *
	 * @since 0.1
	 **/
	public function users_page() 
	{
		if ( ! current_user_can( 'list_users' ) ):
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'export-users-to-csv' ) );
		else:
			echo '<div class=wrap>';
			echo '    <h2>'; 
			echo 	      __( 'Export users to a CSV file', 'export-users-to-csv' ); 
			echo '    </h2>';
			if ( isset( $_GET['error'] ) ): 
				echo '<div class="updated"><p><strong>' . __( 'No user found.', 'export-users-to-csv' ) . '</strong></p></div>';
			else:
				// Roles for for drop down list 
				global $wp_roles;
				$roles = '\n\t<option value="">Tous les roles</option>';
				foreach ( $wp_roles->role_names as $role => $name ) 
				{
					$roles .= '\n\t<option value="' . esc_attr( $role ) . '">' . $name . '</option>';
				}	
				echo  '<form method="post" action="" enctype="multipart/form-data">'
					 . 		wp_nonce_field( 'pp-eu-export-users-users-page_export', 
										 '_wpnonce-pp-eu-export-users-users-page_export' )
					 .'		<table class="form-table">'
					 .'			<tr valign="top">'
					 .'				<th scope="row">'
					 .'					<label for="pp_eu_users_role">'
					 .						__( 'Role', 'export-users-to-csv' )
					 .'					</label>'
					 .'				</th>'
					 .'				<td>'
					 .'					<select name="role" id="pp_eu_users_role">'
					 .						$roles
					 .'					</select>'
					 .'				</td>'
					 .'			</tr>'
					 .'			<tr valign="top">'
					 .'				<th scope="row">'
					 .'                 <label>'
					 .                      __( 'Date range', 'export-users-to-csv' )
					 .'					</label>'
					 .'				</th>'
					 .'				<td>'
					 .'					<select name="start_date" id="pp_eu_users_start_date">'
					 .'						<option value="0">'
					 .							__( 'Start Date', 'export-users-to-csv' )
					 .'						</option>'
					 .						$this->export_date_options()
					 .'					</select>'
					 .'					<select name="end_date" id="pp_eu_users_end_date">'	
					 .'						<option value="0">'
					 .							__( 'End Date', 'export-users-to-csv' )
					 .'                 	</option>'
					 .						$this->export_date_options() 
					 .'					</select>'
					 .'				</td>'
					 .'			</tr>'
					 .'		</table>'
					 .'		<p class="submit">'
					 .'			<input type="hidden" name="_wp_http_referer" value="' . $_SERVER['REQUEST_URI'] . '" />'
					 .'			<input type="submit" class="button-primary" '
					 .'				   value="' .  'Exporte les utilisateurs' .  '"' 
					 .'         />'
					 .'		</p>'
					 .'	</form>'
					 .'	</div>'
					 ;
					 
				echo $form;
			endif; // isset( $_GET['error'] 
		endif; // !current_user_can( 'list_users' ) 
	}

	public function exclude_data() {
		$exclude = array( 'user_pass', 'user_activation_key' );

		return $exclude;
	}

	public function pre_user_query( $user_search ) {
		global $wpdb;

		$where = '';

		if ( ! empty( $_POST['start_date'] ) )
			$where .= $wpdb->prepare( " AND $wpdb->users.user_registered >= %s", date( 'Y-m-d', strtotime( $_POST['start_date'] ) ) );

		if ( ! empty( $_POST['end_date'] ) )
			$where .= $wpdb->prepare( " AND $wpdb->users.user_registered < %s", date( 'Y-m-d', strtotime( '+1 month', strtotime( $_POST['end_date'] ) ) ) );

		if ( ! empty( $where ) )
			$user_search->query_where = str_replace( 'WHERE 1=1', "WHERE 1=1$where", $user_search->query_where );

		return $user_search;
	}

	private function export_date_options() {
		global $wpdb, $wp_locale;

		$months = $wpdb->get_results( "
			SELECT DISTINCT YEAR( user_registered ) AS year, MONTH( user_registered ) AS month
			FROM $wpdb->users
			ORDER BY user_registered DESC
		" );

		$month_count = count( $months );
		if ( !$month_count || ( 1 == $month_count && 0 == $months[0]->month ) )
			return;

		$r='';	
		foreach ( $months as $date ) {
			if ( 0 == $date->year )
				continue;

			$month = zeroise( $date->month, 2 );
			$r .= '<option value="' . $date->year . '-' . $month . '">' . $wp_locale->get_month( $month ) . ' ' . $date->year . '</option>';
		}
		return $r;
	}
} // class PP_EU_Export_Users 

new PP_EU_Export_Users;

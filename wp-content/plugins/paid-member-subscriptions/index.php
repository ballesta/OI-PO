<?php
/**
 * Plugin Name: Paid Member Subscriptions
 * Plugin URI: http://www.cozmoslabs.com/
 * Description: Accept payments, create subscription plans and restrict content on your membership website.
 * Version: 1.0.2
 * Author: Cozmoslabs, Mihai Iova, Madalin Ungureanu, Adrian Spiac, Cristian Antohe
 * Author URI: http://www.cozmoslabs.com/
 * Text Domain: paid-member-subscriptions
 * License: GPL2

== Copyright ==
Copyright 2015 Cozmoslabs (www.cozmoslabs.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */


Class Paid_Member_Subscriptions {

    public $prefix;

    public function __construct() {

        // The prefix of the plugin
        $this->prefix = 'pms_';

        // Install needed components on plugin activation
        register_activation_hook( __FILE__, array( $this, 'install' ) );

        register_deactivation_hook(__FILE__, array($this, 'uninstall') );

        // Define global constants
        $this->define_constants();

        // Include dependencies
        $this->include_dependencies();

        // Initialize the components
        $this->init();

    }


    /*
     * Method that gets executed on plugin activation
     *
     */
    public function install() {

        // Handle multi-site installation
        if( function_exists( 'is_multisite' ) && is_multisite() ) {

            global $wpdb;

            $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

            foreach( $blog_ids as $blog_id ) {

                switch_to_blog( $blog_id );

                // Create needed tables
                $this->create_tables();

                // Add default settings
                $this->add_default_settings();

                restore_current_blog();

            }

        // Handle single site installation
        } else {

            // Create needed tables
            $this->create_tables();

            // Add default settings
            $this->add_default_settings();

        }


        // Add a cron job to be executed daily
        $this->cron_job();

    }

    /*
     * Method that gets executed on plugin deactivation
     *
     */
    public function uninstall() {

        // Clear cron job
        $this->clear_cron_job();

    }



    /*
     * Function that schedules a hook to be executed daily (cron job)
     *
     */
    public function cron_job() {

        // Schedule event for checking subscription status
        wp_schedule_event(time(), 'daily', 'pms_check_subscription_status');

        //Schedule event for deleting expired activation keys used for password reset
        wp_schedule_event(time(), 'daily', 'pms_remove_activation_key');


    }

    /*
     * Function that cleans the scheduler on plugin deactivation:
     *
     */
    public function clear_cron_job() {

        wp_clear_scheduled_hook('pms_check_subscription_status');

        wp_clear_scheduled_hook('pms_remove_activation_key');

    }


    /*
     * Function in which we define the global constants used in the plugin
     *
     */
    public function define_constants() {
        define( 'PMS_VERSION', '1.0.2' );
        define( 'PMS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
        define( 'PMS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
        define( 'PMS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

    }


    /*
     * Add the default settings if they do not exist
     *
     */
    public function add_default_settings() {

        $settings = get_option( 'pms_settings', array() );

        // General tab
        if( !isset( $settings['general']['use_pms_css'] ) )
            $settings['general']['use_pms_css'] = 1;

        // Payments tab
        if( !isset( $settings['payments']['currency'] ) )
            $settings['payments']['currency'] = 'USD';

        if( !isset( $settings['payments']['active_pay_gates'] ) )
            $settings['payments']['active_pay_gates'][] = 'paypal_standard';

        // Messages tab
        if( !isset( $settings['messages']['logged_out'] ) )
            $settings['messages']['logged_out'] = __( 'You must be logged in to view this content.', 'paid-member-subscriptions' );

        if( !isset( $settings['messages']['non_members'] ) )
            $settings['messages']['non_members'] = __( 'This content is restricted for your membership level.', 'paid-member-subscriptions' );

        // E-mails tab
        $mail_general_options = PMS_Emails::get_email_general_options();

        if( !empty( $mail_general_options ) ) {
            foreach( $mail_general_options as $option_slug => $mail_general_option ) {

                if( !isset( $settings['emails'][$option_slug] ) )
                    $settings['emails'][$option_slug] = $mail_general_option;

            }
        }

        $mail_subjects = PMS_Emails::get_email_subjects();

        if( !empty( $mail_subjects ) ) {
            foreach( $mail_subjects as $mail_slug => $subject ) {

                if( !isset( $settings['emails'][$mail_slug. '_sub_subject'] ) )
                    $settings['emails'][$mail_slug. '_sub_subject'] = $subject;

            }
        }

        $mail_contents = PMS_Emails::get_email_content();

        if( !empty( $mail_contents ) ) {
            foreach( $mail_contents as $mail_slug => $content ) {

                if( !isset( $settings['emails'][$mail_slug. '_sub'] ) )
                    $settings['emails'][$mail_slug. '_sub'] = $content;

            }
        }

        // Update settings
        update_option( 'pms_settings', $settings );

    }

    /*
     * Function to include the files needed
     *
     */
    public function include_dependencies() {

        /*
         * Notices
         */
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-notices.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-notices.php';

        /*
         * Core files
         */
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-form-handler.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-form-handler.php';

        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/functions-core.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/functions-core.php';

        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-success.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-success.php';


        /*
         * Custom post types and meta boxes base classes
         */

        // Include the class file for the custom post types
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-custom-post-types.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-custom-post-types.php';

        // Include class file for the meta boxes
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-meta-boxes.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-meta-boxes.php';


        /*
         * Admin Submenu Page Class
         */
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-submenu-page.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-submenu-page.php';


        /*
         * Shortcodes files
         */
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-shortcodes.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-shortcodes.php';

        /*
         * Email files
         */
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-emails.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-emails.php';

        /*
         * Merge Tags
         */
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-merge-tags.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-merge-tags.php';

        /*
         * User roles functions
         */
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/functions-user-roles.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/functions-user-roles.php';

        /*
         * Basic Information
         */
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-basic-info.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-basic-info.php';


        /*
         * Subscription Plans
         */

        // Subscription plan object class
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-subscription-plan.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-subscription-plan.php';

        // Subscription plan functions
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/functions-subscription-plan.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/functions-subscription-plan.php';

        // Subscription plans cpt
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-subscription-plans.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-subscription-plans.php';

        // Meta box for subscription cpt
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/meta-boxes/class-meta-box-subscription-plan-details.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/meta-boxes/class-meta-box-subscription-plan-details.php';

        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/meta-boxes/class-meta-box-subscription-plan-user-roles.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/meta-boxes/class-meta-box-subscription-plan-user-roles.php';

        /*
         * Members
         */

        // Member object class
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-member.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-member.php';

        // Member functions
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/functions-member.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/functions-member.php';

        // Members admin page list table class
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-members-list-table.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-members-list-table.php';

        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-member-subscription-list-table.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-member-subscription-list-table.php';

        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-members-add-new-bulk-list-table.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-members-add-new-bulk-list-table.php';

        // Members admin page
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-members.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-members.php';


        /*
         * Payments
         */

        // Payment object class
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/class-payment.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/class-payment.php';

        // Payment functions
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/functions-payment.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/functions-payment.php';

        // Payment admin list table class
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-payments-list-table.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-payments-list-table.php';

        // Payments admin page
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-payments.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-payments.php';


        /*
         * Settings
         */

        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-settings.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-settings.php';

        /*
         * Add-ons
         */

        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-addons.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/class-admin-addons.php';

        /*
         * Add-ons update
         */
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/class-update-checker.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/class-update-checker.php';

        /*
         * Payment gateways
         */

        // PayPal listener
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/gateways/paypal/ipnlistener.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/gateways/paypal/ipnlistener.php';

        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/gateways/paypal_standard/paypal_standard.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/gateways/paypal_standard/paypal_standard.php';

        /*
         * Content restriction
         */

        // Content filtering functions
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/functions-content-filtering.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/functions-content-filtering.php';

        // Meta box with content restriction options on pages
        if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/meta-boxes/class-meta-box-single-content-restriction.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/meta-boxes/class-meta-box-single-content-restriction.php';


        /*
         * Profile Builder Compatibility
         */

        if( file_exists( PMS_PLUGIN_DIR_PATH . 'extend/admin/manage-fields.php' ) )
            include_once PMS_PLUGIN_DIR_PATH . 'extend/admin/manage-fields.php';

        /* for the time being the PB field is not compatible when Email Confirmation or Admin Approval are on */
        $wppb_generalSettings = get_option( 'wppb_general_settings' );
        if( ! ( ( !empty( $wppb_generalSettings['emailConfirmation'] ) && $wppb_generalSettings['emailConfirmation'] == 'yes' ) || ( !empty( $wppb_generalSettings['adminApproval'] ) && $wppb_generalSettings['adminApproval'] == 'yes' ) ) ) {
            if( file_exists( PMS_PLUGIN_DIR_PATH . 'extend/functions.php' ) )
                include_once PMS_PLUGIN_DIR_PATH . 'extend/functions.php';

            if (file_exists(PMS_PLUGIN_DIR_PATH . 'extend/front-end/subscription-plans-field.php'))
                include_once PMS_PLUGIN_DIR_PATH . 'extend/front-end/subscription-plans-field.php';

            if (file_exists(PMS_PLUGIN_DIR_PATH . 'extend/functions-pb-redirect.php'))
                include_once PMS_PLUGIN_DIR_PATH . 'extend/functions-pb-redirect.php';
        }


    }


    /*
     * Create or update the database tables needed for the plugin to work
     * as needed
     *
     */
    public function create_tables() {

        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $sql_query = "CREATE TABLE {$wpdb->prefix}{$this->prefix}member_subscriptions (
          user_id bigint(20) NOT NULL,
          subscription_plan_id int(10) NOT NULL,
          start_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          expiration_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          status varchar(32) NOT NULL,
          KEY user_id (user_id),
          KEY subscription_plan_id (subscription_plan_id)
        ) {$charset_collate};
        CREATE TABLE {$wpdb->prefix}{$this->prefix}payments (
          id bigint(20) NOT NULL AUTO_INCREMENT,
          user_id bigint(20) NOT NULL,
          subscription_plan_id bigint(20) NOT NULL,
          status varchar(32) NOT NULL,
          date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          amount float(10) NOT NULL,
          currency varchar(32) NOT NULL,
          type varchar(32) NOT NULL,
          transaction_id varchar(32) NOT NULL,
          logs longtext NOT NULL,
          UNIQUE KEY id (id),
          KEY user_id (user_id)
        ) {$charset_collate};";

        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

        dbDelta( $sql_query );

    }


    /*
     * Initialize the plugin
     *
     */
    public function init() {

        // Set the main menu page
        add_action( 'admin_menu', array( $this, 'add_menu_page' ), 1 );

        add_action( 'admin_menu', array( $this, 'remove_submenu_page' ) );

        // Enqueue scripts on the front end side
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front_end_scripts' ) );

        // Enqueue scripts on the admin side
        if( is_admin() )
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

        // Initialize shortcodes
        add_action( 'init', array( 'PMS_Shortcodes', 'init' ) );

        //Show row meta on the plugin screen (used to add links like Documentation, Support etc.).
        add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );

        // Hook to be executed on a specific interval, by the cron job (wp_schedule_event); used to check if a subscription has expired
        add_action('pms_check_subscription_status','pms_member_check_expired_subscriptions');

        // Hook to be executed on a daily interval, by the cron job (wp_schedule_event); used to remove the user activation key from the db (make it expire) every 24 hours
        add_action('pms_remove_activation_key','pms_remove_expired_activation_key');

    }


    public function add_menu_page() {

        add_menu_page( __( 'Paid Member Subscriptions', 'paid-member-subscriptions' ), __( 'Paid Member Subscriptions', 'paid-member-subscriptions' ), 'manage_options', 'paid-member-subscriptions', null, plugin_dir_url( __FILE__ ).'/assets/images/pms_ico.png', '71.1' );

    }


    public function remove_submenu_page() {

        remove_submenu_page( 'paid-member-subscriptions', 'paid-member-subscriptions' );

    }


    /*
     * Enqueue scripts for the back-end (dashboard) part of the website
     *
     * @return void
     *
     */
    public function enqueue_admin_scripts() {

        wp_enqueue_style( 'pms-style-back-end', PMS_PLUGIN_DIR_URL . 'assets/css/style-back-end.css' );

    }


    /*
     * Enqueue scripts for the front-end part of the website
     *
     * @return void
     *
     */
    public function enqueue_front_end_scripts() {

        $pms_settings = get_option( 'pms_settings' );

        if( isset( $pms_settings['general']['use_pms_css'] ) && !empty( $pms_settings['general']['use_pms_css'] ) )
            wp_enqueue_style( 'pms-style-front-end', PMS_PLUGIN_DIR_URL . 'assets/css/style-front-end.css' );

        wp_register_script( 'pms-front-end', PMS_PLUGIN_DIR_URL . 'assets/js/front-end.js', array( 'jquery' ) );
        wp_enqueue_script( 'pms-front-end' );

    }

    /**
     * Show row meta on the plugin screen. (Used to add links like Documentation, Support etc.)
     *
     * @param	mixed $links Plugin Row Meta
     * @param	mixed $file  Plugin Base file
     * @return	array
     */
    public static function plugin_row_meta( $links, $file ) {
        if ( $file == PMS_PLUGIN_BASENAME ) {
            $row_meta = array(
                'documentation'    => '<a href="' . esc_url( apply_filters( 'pms_docs_url', 'http://www.cozmoslabs.com/docs/paid-member-subscriptions/' ) ) . '" title="' . esc_attr( __( 'View Documentation', 'woocommerce' ) ) . '">' . __( 'Documentation', 'paid-member-subscriptions' ) . '</a>',
            );

            return array_merge( $links, $row_meta );
        }

        return (array) $links;
    }

}

// Let's get the party started
new Paid_Member_Subscriptions;
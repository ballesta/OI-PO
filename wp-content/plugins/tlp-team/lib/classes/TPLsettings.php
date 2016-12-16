<?php

/**
*
*/
class TPLsettings
{

    function __construct()
    {

        add_action( 'init', array($this, 'tlp_pluginInit') );
        add_action( 'wp_ajax_tlpTeamSettings', array($this, 'tlpTeamSettings'));
        add_action( 'admin_menu' , array($this, 'tlp_menu_register'));
    }
    function tlpTeamSettings(){
        global $TLPteam;

        $error = true;
        if($TLPteam->verifyNonce()){
            unset($_REQUEST['action']);

            update_option( $TLPteam->options['settings'], $_REQUEST);

            $response = array(
                    'error'=> $error,
                    'msg' => __('Settings successsully updated',TPL_TEAM_SLUG)
                );
        }else{
            $response = array(
                    'error'=> true,
                    'msg' => __('Security Error !!',TPL_TEAM_SLUG)
                );
        }
        wp_send_json( $response );
        die();

    }

    function tlp_pluginInit(){
        $this->load_plugin_textdomain();
        global $TLPteam;
        $settings = get_option($TLPteam->options['settings']);
        $width = ($settings['genaral']['img']['width'] ? (int) $settings['genaral']['img']['width'] : 250);
        $height = ($settings['genaral']['img']['height'] ? (int) $settings['genaral']['img']['height'] : 250);

        add_theme_support( 'post-thumbnails' );
        add_image_size( 'team-thumb', $width, $height, true );
    }


    function tlp_menu_register() {
        $page = add_submenu_page( 'edit.php?post_type=team', __('TLP TEAM Settings', TPL_TEAM_SLUG), __('Settings', TPL_TEAM_SLUG), 'administrator', 'tlp_team_settings', array($this, 'tlp_team_settings') );

        add_action('admin_print_styles-' . $page, array( $this,'tlp_style'));
        add_action('admin_print_scripts-'. $page, array( $this,'tlp_script'));

    }

    function tlp_style(){
        global $TLPteam;
        wp_enqueue_style( 'tpl_css_settings', $TLPteam->assetsUrl . 'css/settings.css');
    }

    function tlp_script(){
        global $TLPteam;
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'tpl_js_settings',  $TLPteam->assetsUrl. 'js/settings.js', array('jquery','wp-color-picker'), '', true );
        $nonce = wp_create_nonce( $TLPteam->nonceText() );
        wp_localize_script( 'tpl_js_settings', 'tpl_var', array('tlp_nonce' => $nonce) );
    }

    function tlp_team_settings(){
        global $TLPteam;
        $TLPteam->render('settings');
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since 0.1.0
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain( TPL_TEAM_SLUG, FALSE,  TPL_TEAM_LANGUAGE_PATH );
    }

}

<?php

if (!defined('ABSPATH')) exit;

final class sss_defaults {
    public $settings = array(
        '__version__' => '2.6.1',
        '__date__' => '2015.05.31.',
        '__build__' => 3683,
        '__status__' => 'stable',
        '__product_id__' => 'smart-sidebars-slider',
        'show_install_screen' => false,
        'show_update_screen' => false,
        'std_position' => 'fixed',
        'std_embed' => 'append',
        'std_wrapOffset' => 48,
        'std_wrapEdge' => 48,
        'std_wrapSpace' => 8,
        'std_minWindowWidth' => 0,
        'std_minWindowHeight' => 0,
        'std_drawerWidth' => 300,
        'std_drawerHeight' => 720,
        'std_drawerPadding' => 15,
        'std_zIndex' => 9000,
        'std_zIndexOpen' => 10000,
        'auto_tab_positioning' => false,
        'auto_tab_offset' => 32,
        'auto_tab_spacing' => 8,
        'auto_tab_left_active' => false,
        'auto_tab_right_active' => false,
        'auto_tab_left_disable_single' => true,
        'auto_tab_right_disable_single' => true,
        'auto_tab_left_full_size' => 'none',
        'auto_tab_right_full_size' => 'none',
        'auto_wrap_left_offset' => 40,
        'auto_wrap_left_edge' => 16,
        'auto_tab_left_offset' => 32,
        'auto_tab_left_edge' => 32,
        'auto_tab_left_spacing' => 8,
        'auto_wrap_right_offset' => 40,
        'auto_wrap_right_edge' => 16,
        'auto_tab_right_offset' => 32,
        'auto_tab_right_edge' => 32,
        'auto_tab_right_spacing' => 8,
        'load_fontawesome' => false
    );

    public $sidebars = array(
        '__build__' => 3445,
        'sidebars' => array(),
        'order' => array(),
        'sidebar_id' => 1
    );

    public $styler = array(
        '__build__' => 3445,
        'styles' => array(),
        'style_id' => 1
    );

    function __construct() { }

    public function upgrade($old, $scope = 'settings') {
        $work = $scope == 'styler' ? $this->styler : ($scope == 'sidebars' ? $this->sidebars : $this->settings);

        foreach ($work as $key => $value) {
            if (!isset($old[$key])) {
                $old[$key] = $value;
            }
        }

        $unset = array();
        foreach ($old as $key => $value) {
            if (!isset($work[$key])) {
                $unset[] = $key;
            }
        }

        if (!empty($unset)) {
            foreach ($unset as $key) {
                unset($old[$key]);
            }
        }

        foreach ($work as $key => $value) {
            if (substr($key, 0, 2) == '__') {
                $old[$key] = $value;
            }
        }

        return $old;
    }
}

?>
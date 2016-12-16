<?php

/*
Plugin Name: Smart Sidebars Slider
Plugin URI: http://www.smartplugins.info/plugin/wordpress/smart-sidebars-slider/
Description: Add extra sidebars that will be hidden behind tab on left or right side of the screen.
Version: 2.6.1
Author: Milan Petrovic
Author URI: http://www.dev4press.com/

== Copyright ==
Copyright 2008 - 2015 Milan Petrovic (email: milan@gdragon.info)
*/

class sss_loader {
    public $plugins;
    public $styles = array();
    public $custom = array();

    public $settings = array();
    public $styler = array();
    public $sidebars = array();

    function __construct() {
        global $wp_version;

        define('SSS_WP_VERSION', intval(substr(str_replace('.', '', $wp_version), 0, 2)));
        define('SSS_WP_VERSION_MAJOR', substr($wp_version, 0, 3));

        if (SSS_WP_VERSION < 35) exit;

        $_dirname = trailingslashit(dirname(__FILE__));
        $_urlname = plugin_dir_url(__FILE__);

        define('SSS_PATH', $_dirname);
        define('SSS_URL', $_urlname);

        if (!defined('SSS_EOL')) {
            define('SSS_EOL', "\r\n");
        }

        require_once(SSS_PATH.'core/defaults.php');
        require_once(SSS_PATH.'core/classes.php');
        require_once(SSS_PATH.'core/render.php');
        require_once(SSS_PATH.'core/plugins.php');

        if (is_admin()) {
            require_once(SSS_PATH.'core/functions.php');
            require_once(SSS_PATH.'core/admin.php');
        }

        add_action('plugins_loaded', array(&$this, 'plugins_loaded'));
        add_action('after_setup_theme', array(&$this, 'theme_loaded'));
    }

    public function plugins_loaded() {
        $this->init_plugin_settings();
        $this->init_plugin_translation();

        require_once(SSS_PATH.'core/sidebars.php');
    }

    public function theme_loaded() {
        $this->init_styles();

        $this->plugins = new sss_plugins_expander();
    }

    public function init_plugin_translation() {
        $this->l = get_locale();

        if(!empty($this->l)) {
            load_plugin_textdomain('smart-sidebars-slider', false, 'smart-sidebars-slider/languages');
        }
    }

    public function init_plugin_settings() {
        $_d = new sss_defaults();

        $this->settings = get_option('smart-sidebars-slider');
        $this->styler = get_option('smart-sidebars-slider-styler');
        $this->sidebars = get_option('smart-sidebars-slider-sidebars');

        if (!is_array($this->settings)) {
            $this->settings = $_d->settings;
            $this->settings['show_install_screen'] = true;

            update_option('smart-sidebars-slider', $this->settings);
        } else if ($this->settings['__build__'] != $_d->settings['__build__']) {
            $this->settings = $_d->upgrade($this->settings);
            $this->settings['show_update_screen'] = true;

            if ($this->settings['auto_tab_positioning']) {
                $this->settings['auto_tab_positioning'] = false;
                $this->settings['auto_tab_left_active'] = true;
                $this->settings['auto_tab_right_active'] = true;

                $this->settings['auto_tab_left_offset'] = $this->settings['auto_tab_offset'];
                $this->settings['auto_tab_right_offset'] = $this->settings['auto_tab_offset'];
                $this->settings['auto_tab_left_spacing'] = $this->settings['auto_tab_spacing'];
                $this->settings['auto_tab_right_spacing'] = $this->settings['auto_tab_spacing'];
            }

            update_option('smart-sidebars-slider', $this->settings);
        }

        if (!is_array($this->styler)) {
            $this->styler = $_d->styler;
            update_option('smart-sidebars-slider-styler', $this->styler);
        } else if ($this->styler['__build__'] != $_d->styler['__build__']) {
            $this->styler = $_d->upgrade($this->styler, 'styler');
            update_option('smart-sidebars-slider-styler', $this->styler);
        }

        if (!is_array($this->sidebars)) {
            $this->sidebars = $_d->sidebars;
            update_option('smart-sidebars-slider-sidebars', $this->sidebars);
        } else if ($this->sidebars['__build__'] != $_d->sidebars['__build__']) {
            $this->sidebars = $_d->upgrade($this->sidebars, 'sidebars');

            $this->sidebars_array_cleanup();
        }

        define('SMART_SIDEBARS_SLIDER', $this->settings['__version__']);

        do_action('sss_init_plugin_settings');
    }

    public function sidebars_array_cleanup() {
        if (isset($this->sidebars['sidebars'][0])) {
            unset($this->sidebars['sidebars'][0]);
        }

        $unique_ids = array();
        foreach (array_keys($this->sidebars['sidebars']) as $id) {
            if (!in_array($id, $this->sidebars['order'])) {
                $this->sidebars['order'][] = $id;
                $unique_ids[] = $id;
            }
        }

        $old_order = $this->sidebars['order'];
        $this->sidebars['order'] = array();

        foreach ($old_order as $id) {
            if (in_array($id, $unique_ids)) {
                $this->sidebars['order'][] = $id;
            }
        }

        update_option('smart-sidebars-slider-sidebars', $this->sidebars);
    }

    public function init_styles() {
        $this->styles = array(
            '1' => array('_name' => 'Flat Olive', '_code' => 'default-flat-olive', 'tabRound' => 4, 'drawerRound' => 5, 'background' => '#3a4508 1.00', 'color' => '#ffffff 1', 'link_color' => '#e9ffb2 1.00', 'border' => '0 px solid #3a4508 1.00', 'tab_color' => '#ffffff 1', 'tab_font_size' => '1.2 em', 'tab_font_family' => 'inherit', 'tab_font_weight' => '700', 'tab_font_style' => 'normal', 'nano_pane_background' => '#ffffff 0.1', 'nano_slider_background' => '#e9ffb2 0.70'),
            '2' => array('_name' => 'Flat Blue', '_code' => 'default-flat-blue', 'tabRound' => 4, 'drawerRound' => 5, 'background' => '#1778b0 1.00', 'color' => '#ffffff 1.00', 'link_color' => '#ededed 1.00', 'border' => '0 px solid #1778b0 1.00', 'tab_color' => '#ffffff 1.00', 'tab_font_size' => '1.2 em', 'tab_font_family' => 'inherit', 'tab_font_weight' => '700', 'tab_font_style' => 'normal', 'nano_pane_background' => '#ffffff 0.10', 'nano_slider_background' => '#ffffff 0.70'),
            '3' => array('_name' => 'Flat Light', '_code' => 'default-flat-light', 'tabRound' => 4, 'drawerRound' => 5, 'background' => '#e0e0e0 1.00', 'color' => '#000000 1.00', 'link_color' => '#990000 1.00', 'border' => '0 px solid #e0e0e0 1.00', 'tab_color' => '#990000 1.00', 'tab_font_size' => '1.2 em', 'tab_font_family' => 'inherit', 'tab_font_weight' => '700', 'tab_font_style' => 'normal', 'nano_pane_background' => '#000000 0.10', 'nano_slider_background' => '#000000 0.70'),
            '4' => array('_name' => 'Flat Dark', '_code' => 'default-flat-dark', 'tabRound' => 4, 'drawerRound' => 5, 'background' => '#2e2e2e 1.00', 'color' => '#ffffff 1.00', 'link_color' => '#ffcccc 1.00', 'border' => '0 px solid #e0e0e0 1', 'tab_color' => '#ffffff 1.00', 'tab_font_size' => '1.2 em', 'tab_font_family' => 'inherit', 'tab_font_weight' => '700', 'tab_font_style' => 'normal', 'nano_pane_background' => '#ffffff 0.10', 'nano_slider_background' => '#ffffff 0.70'),
            '5' => array('_name' => 'Plain White', '_code' => 'default-plain', 'tabRound' => 4, 'drawerRound' => 5, 'background' => '#fefefe 1', 'color' => '#333333 1', 'link_color' => '#990000 1', 'border' => '2 px solid #111111 1', 'tab_color' => '#990000 1', 'tab_font_size' => '1.2 em', 'tab_font_family' => 'inherit', 'tab_font_weight' => '700', 'tab_font_style' => 'normal', 'nano_pane_background' => '#333333 0.1', 'nano_slider_background' => '#111111 0.7'),
            '6' => array('_name' => 'Plain Dark', '_code' => 'default-plain-dark', 'tabRound' => 4, 'drawerRound' => 5, 'background' => '#000000 1.00', 'color' => '#ffffff 1.00', 'link_color' => '#fc9c9c 1.00', 'border' => '2 px solid #a8a8a8 1.00', 'tab_color' => '#ffffff 1.00', 'tab_font_size' => '1.1 em', 'tab_font_family' => 'inherit', 'tab_font_weight' => '700', 'tab_font_style' => 'normal', 'nano_pane_background' => '#ffffff 0.10', 'nano_slider_background' => '#ffffff 0.70')
        );

        $this->custom = apply_filters('sss_custom_style_classes', array());
    }

    public function get($name) {
        return $this->settings[$name];
    }

    public function set($name, $value) {
        $this->settings[$name] = $value;
    }

    public function save() {
        update_option('smart-sidebars-slider', $this->settings);
    }

    public function save_all_styles() {
        update_option('smart-sidebars-slider-styler', $this->styler);
    }

    public function save_all_sidebars() {
        update_option('smart-sidebars-slider-sidebars', $this->sidebars);
    }

    public function get_sidebar($id) {
        $id = intval($id);

        if (isset($this->sidebars['sidebars'][$id])) {
            return $this->sidebars['sidebars'][$id];
        } else {
            return array();
        }
    }

    public function get_custom_style($code) {
        foreach ($this->custom as $key => $obj) {
            if ($key == $code) {
                return $obj;
            }
        }

        return null;
    }

    public function get_style($id) {
        $id = intval($id);

        if (isset($this->styler['styles'][$id])) {
            return $this->styler['styles'][$id];
        } else {
            return array();
        }
    }

    public function next_sidebar_id() {
        $id = $this->sidebars['sidebar_id'];

        $this->sidebars['sidebar_id']++;

        return $id;
    }

    public function next_style_id() {
        $id = $this->styler['style_id'];

        $this->styler['style_id']++;

        return $id;
    }

    public function duplicate_sidebar($sidebar) {
        if (isset($this->sidebars['sidebars'][$sidebar])) {
            $id = $this->next_sidebar_id();

            $new = $this->sidebars['sidebars'][$sidebar];
            $new['_id'] = $id;
            $new['_name'].= ' (2)';

            $this->sidebars['sidebars'][$id] = $new;

            update_option('smart-sidebars-slider-sidebars', $this->sidebars);
        }
    }

    public function duplicate_style($style) {
        if (isset($this->styler['styles'][$style])) {
            $id = $this->next_style_id();

            $new = $this->styler['styles'][$style];
            $new['_id'] = $id;
            $new['_name'].= ' (2)';
            $new['_code'].= '-2';

            $this->styler['styles'][$id] = $new;

            update_option('smart-sidebars-slider-styler', $this->styler);
        }
    }

    public function delete_sidebar($sidebar) {
        if (isset($this->sidebars['sidebars'][$sidebar])) {
            unset($this->sidebars['sidebars'][$sidebar]);

            $this->sidebars['order'] = array_diff($this->sidebars['order'], array($sidebar));
        }

        update_option('smart-sidebars-slider-sidebars', $this->sidebars);
    }

    public function delete_style($style) {
        if (isset($this->styler['styles'][$style])) {
            unset($this->styler['styles'][$style]);
        }

        update_option('smart-sidebars-slider-styler', $this->styler);
    }

    public function save_sidebar($sidebar) {
        $this->sidebars['sidebars'][$sidebar->_id] = $sidebar->to_array();

        update_option('smart-sidebars-slider-sidebars', $this->sidebars);
    }

    public function save_style($style) {
        $this->styler['styles'][$style->_id] = $style->to_array();

        update_option('smart-sidebars-slider-styler', $this->styler);
    }

    public function get_ordered_sidebars() {
        foreach (array_keys($this->sidebars['sidebars']) as $id) {
            if (!in_array($id, $this->sidebars['order'])) {
                $this->sidebars['order'][] = $id;
            }
        }

        $list = array();

        foreach ($this->sidebars['order'] as $id) {
            if ($id > 0 && isset($this->sidebars['sidebars'][$id])) {
                $list[$id] = $this->sidebars['sidebars'][$id];
            }
        }

        return $list;
    }
}

global $sss_core_loader;
$sss_core_loader = new sss_loader();

function smart_sss_core() {
    global $sss_core_loader;
    return $sss_core_loader;
}

?>
<?php

if (!defined('ABSPATH')) exit;

class sss_admin {
    public $page_ids = array();
    public $admin_page_url = 'options-general.php';

    function __construct() {
        add_action('admin_init', array(&$this, 'save_settings'));
        add_action('admin_menu', array(&$this, 'admin_menu'));

        add_filter('plugin_row_meta', array(&$this, 'plugin_row_meta'), 10, 2);
        add_filter('plugin_action_links_smart-sidebars-slider/smart-sidebars-slider.php', array(&$this, 'plugin_action_links'));

        add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts'));

        add_action('wp_ajax_sss_sidebars_change_order', array(&$this, 'ajax_change_order'));
    }

    public function ajax_change_order() {
        check_ajax_referer('smart-sidebars-slider');

        $raw = array_map('intval', $_POST['list']);
        smart_sss_core()->sidebars['order'] = array();

        foreach ($raw as $value) {
            if ($value > 0) {
                smart_sss_core()->sidebars['order'][] = $value;
            }
        }

        update_option('smart-sidebars-slider-sidebars', smart_sss_core()->sidebars);

        die('ok');
    }

    public function plugin_action_links($links) {
        $links[] = '<a href="'.$this->admin_page_url.'?page=smart-sidebars-slider">'.__("Settings", "smart-sidebars-slider").'</a>';

	return $links;
    }

    public function plugin_row_meta($links, $plugin_file) {
        if ($plugin_file == 'smart-sidebars-slider/smart-sidebars-slider.php') {
            $links[] = 'SMART Plugins: <a href="http://www.smartplugins.info/" target="_blank">Website</a>';
            $links[] = '<a href="http://codecanyon.net/user/GDragoN/portfolio?ref=GDragoN" target="_blank">On CodeCanyon</a>';
        }

        return $links;
    }

    public function admin_enqueue_scripts($hook) {
        if ($hook == 'settings_page_smart-sidebars-slider' || $hook == 'smart-plugins_page_smart-sidebars-slider') {
            wp_enqueue_script('jquery');

            $depend = array('jquery', 'sss-jqueryui');

            wp_enqueue_script('sss-jqueryui', SSS_URL.'js/jquery-ui.js', array('jquery'), smart_sss_core()->get('__version__'), true);
            wp_enqueue_style('sss-jqueryui', SSS_URL.'css/smoothness/jquery-ui.css', array(), smart_sss_core()->get('__version__'));

            if (isset($_GET['tab']) && $_GET['tab'] == 'styler') {
                wp_enqueue_script('sss-minicolors', SSS_URL.'js/jquery.minicolors.min.js', array('jquery'), smart_sss_core()->get('__version__'), true);
                wp_enqueue_style('sss-minicolors', SSS_URL.'css/minicolors/jquery.minicolors.css', array(), smart_sss_core()->get('__version__'));

                wp_enqueue_script('sss-nanoscroller', SSS_URL.'js/jquery.nanoscroller.min.js', array('jquery'), smart_sss_core()->get('__version__'), true);
                wp_enqueue_style('sss-nanoscroller', SSS_URL.'css/jquery.nanoscroller.min.css', array(), smart_sss_core()->get('__version__'));

                wp_enqueue_style('sss-styler-admin', SSS_URL.'css/styler.css', array('sss-minicolors', 'sss-nanoscroller'));

                if (isset($_GET['sss-task']) && $_GET['sss-task'] == 'css') {
                    wp_enqueue_script('scs-styler-syntax', SSS_URL.'js/syntaxhighlighter.js', array(), null, true);
                    wp_enqueue_style('scs-styler-syntax', SSS_URL.'css/syntaxhighlighter.css');
                }

                $depend[] = 'sss-minicolors';
            }

            if (isset($_GET['tab']) && $_GET['tab'] == 'sidebars') {
                if (smart_sss_core()->get('load_fontawesome')) {
                    wp_enqueue_style('sss-fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
                }
            }

            wp_enqueue_script('sss-admin', (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? SSS_URL.'js/admin.js' : SSS_URL.'js/admin.min.js'), $depend, smart_sss_core()->get('__version__'), true);
            wp_enqueue_style('sss-admin', SSS_URL.'css/admin.css', array(), smart_sss_core()->get('__version__'));

            wp_localize_script('sss-admin', 'sss_admin_data', array(
                'confirm_areyousure' => __("Are you sure that you want to do this? Operation is not reversable.", "smart-sidebars-slider"),
                'init_styler' => isset($_GET['tab']) && $_GET['tab'] == 'styler',
                'init_sidebars' => isset($_GET['tab']) && $_GET['tab'] == 'sidebars',
                'init_export' => isset($_GET['tab']) && $_GET['tab'] == 'impexp',
                'nonce' => wp_create_nonce('smart-sidebars-slider')
            ));

            do_action('sss_admin_enqueue_scripts');
        }

        if ($hook == 'post-new.php' || $hook == 'post.php') {
            
        }
    }

    public function save_settings() {
        if (defined('SMART_PLUGINS_CENTRAL')) {
            $this->admin_page_url = 'admin.php';
        }

        do_action('sss_admin_save_settings');

        if (isset($_GET['page']) && $_GET['page'] == 'smart-sidebars-slider' && isset($_GET['tab']) && $_GET['tab'] == 'styler' && isset($_GET['sss-task']) && isset($_GET['job']) && $_GET['job'] > 0) {
            if ($_GET['sss-task'] == 'delete') {
                smart_sss_core()->delete_style(intval($_GET['job']));

                wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&tab=styler&style-deleted=true');
                exit;
            }

            if ($_GET['sss-task'] == 'copy') {
                smart_sss_core()->duplicate_style(intval($_GET['job']));

                wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&tab=styler&style-saved=true');
                exit;
            }
        }

        if (isset($_GET['page']) && $_GET['page'] == 'smart-sidebars-slider' && isset($_GET['tab']) && $_GET['tab'] == 'sidebars' && isset($_GET['sss-task']) && isset($_GET['job']) && $_GET['job'] > 0) {
            if ($_GET['sss-task'] == 'delete') {
                smart_sss_core()->delete_sidebar(intval($_GET['job']));

                wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&tab=sidebars&sidebar-deleted=true');
                exit;
            }

            if ($_GET['sss-task'] == 'copy') {
                smart_sss_core()->duplicate_sidebar(intval($_GET['job']));

                wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&tab=sidebars&sidebar-saved=true');
                exit;
            }
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'smart-sidebars-slider-import') {
            check_admin_referer('smart-sidebars-slider-import-options');

            if (is_uploaded_file($_FILES['import_file']['tmp_name'])) {
                $data = file_get_contents($_FILES['import_file']['tmp_name']);
                $data = maybe_unserialize($data);

                if (is_object($data)) {
                    $import_done = false;

                    $settings = isset($_POST['import_settings']) && isset($data->{'smart-sidebars-slider'});
                    $styler = isset($_POST['import_styles']) && isset($data->{'smart-sidebars-slider-styler'});
                    $sidebars = isset($_POST['import_sidebars']) && isset($data->{'smart-sidebars-slider-sidebars'});

                    if ($settings) {
                        $import_done = true;

                        smart_sss_core()->settings = $data->{'smart-sidebars-slider'};
                        smart_sss_core()->save();
                    }

                    if ($styler) {
                        $import_done = true;

                        smart_sss_core()->styler = $data->{'smart-sidebars-slider-styler'};
                        smart_sss_core()->save_all_styles();
                    }

                    if ($sidebars) {
                        $import_done = true;

                        smart_sss_core()->sidebars = $data->{'smart-sidebars-slider-sidebars'};
                        smart_sss_core()->save_all_sidebars();
                    }

                    if ($import_done) {
                        wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&tab=impexp&settings-updated=true');
                    } else {
                        wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&tab=impexp&import-nothing=true');
                    }
                    exit;
                }
            }

            wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&tab=impexp&import-failed=true');
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'smart-sidebars-slider-settings') {
            check_admin_referer('smart-sidebars-slider-settings-options');

            $sss = $_POST['sss'];

            smart_sss_core()->set('std_position', strip_tags(stripslashes($sss['std_position'])));
            smart_sss_core()->set('std_embed', strip_tags(stripslashes($sss['std_embed'])));
            smart_sss_core()->set('std_zIndex', intval(stripslashes($sss['std_zIndex'])));
            smart_sss_core()->set('std_zIndexOpen', intval(stripslashes($sss['std_zIndexOpen'])));

            smart_sss_core()->set('load_fontawesome', isset($sss['load_fontawesome']));

            smart_sss_core()->save();

            wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&settings-updated=true');
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'smart-sidebars-slider-auto') {
            check_admin_referer('smart-sidebars-slider-auto-options');

            $sss = $_POST['sss'];

            smart_sss_core()->set('auto_tab_left_active', isset($sss['auto_tab_left_active']));
            smart_sss_core()->set('auto_wrap_left_offset', intval(stripslashes($sss['auto_wrap_left_offset'])));
            smart_sss_core()->set('auto_wrap_left_edge', intval(stripslashes($sss['auto_wrap_left_edge'])));
            smart_sss_core()->set('auto_tab_left_offset', intval(stripslashes($sss['auto_tab_left_offset'])));
            smart_sss_core()->set('auto_tab_left_edge', intval(stripslashes($sss['auto_tab_left_edge'])));
            smart_sss_core()->set('auto_tab_left_spacing', intval(stripslashes($sss['auto_tab_left_spacing'])));

            smart_sss_core()->set('auto_tab_left_full_size', strip_tags(stripslashes($sss['auto_tab_left_full_size'])));
            smart_sss_core()->set('auto_tab_right_full_size', strip_tags(stripslashes($sss['auto_tab_right_full_size'])));

            smart_sss_core()->set('auto_tab_right_active', isset($sss['auto_tab_right_active']));
            smart_sss_core()->set('auto_wrap_right_offset', intval(stripslashes($sss['auto_wrap_right_offset'])));
            smart_sss_core()->set('auto_wrap_right_edge', intval(stripslashes($sss['auto_wrap_right_edge'])));
            smart_sss_core()->set('auto_tab_right_offset', intval(stripslashes($sss['auto_tab_right_offset'])));
            smart_sss_core()->set('auto_tab_right_edge', intval(stripslashes($sss['auto_tab_right_edge'])));
            smart_sss_core()->set('auto_tab_right_spacing', intval(stripslashes($sss['auto_tab_right_spacing'])));

            smart_sss_core()->save();

            wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&settings-updated=true&tab=auto');
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'smart-sidebars-slider-defaults') {
            check_admin_referer('smart-sidebars-slider-defaults-options');

            $sss = $_POST['sss'];

            smart_sss_core()->set('std_wrapOffset', intval(stripslashes($sss['std_wrapOffset'])));
            smart_sss_core()->set('std_wrapEdge', intval(stripslashes($sss['std_wrapEdge'])));
            smart_sss_core()->set('std_wrapSpace', intval(stripslashes($sss['std_wrapSpace'])));
            smart_sss_core()->set('std_drawerWidth', intval(stripslashes($sss['std_drawerWidth'])));
            smart_sss_core()->set('std_drawerHeight', intval(stripslashes($sss['std_drawerHeight'])));
            smart_sss_core()->set('std_drawerPadding', intval(stripslashes($sss['std_drawerPadding'])));
            smart_sss_core()->set('std_minWindowWidth', intval(stripslashes($sss['std_minWindowWidth'])));
            smart_sss_core()->set('std_minWindowHeight', intval(stripslashes($sss['std_minWindowHeight'])));

            smart_sss_core()->save();

            wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&settings-updated=true&tab=defaults');
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'smart-sidebars-slider-styler-builder') {
            check_admin_referer('smart-sidebars-slider-styler-builder-options');

            $raw = $_POST['sss-styler'];
            $id = isset($raw['_id']) ? intval($raw['_id']) : 0;

            $style = new sss_style_core(smart_sss_core()->get_style($id));
            $style->save($raw);

            smart_sss_core()->save_style($style);

            wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&tab=styler&sss-task=edit&job='.$style->_id.'&style-saved=true');
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'smart-sidebars-slider-sidebar-builder') {
            check_admin_referer('smart-sidebars-slider-sidebar-builder-options');

            $raw = $_POST['sss-sidebar'];
            $id = isset($raw['_id']) ? intval($raw['_id']) : 0;

            $job = smart_sss_core()->get_sidebar($id);
            $sidebar = new sss_sidebar_core($job);
            $sidebar->save($raw);

            smart_sss_core()->save_sidebar($sidebar);

            wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&tab=sidebars&sss-task=edit&job='.$sidebar->_id.'&sidebar-saved=true');
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'smart-sidebars-slider-sidebar-rules') {
            check_admin_referer('smart-sidebars-slider-sidebar-rules-options');

            $raw = $_POST['sss-sidebar'];
            $id = isset($raw['_id']) ? intval($raw['_id']) : 0;

            $job = smart_sss_core()->get_sidebar($id);
            $sidebar = new sss_sidebar_core($job);
            $sidebar->save_rules($raw);

            smart_sss_core()->save_sidebar($sidebar);

            wp_redirect($this->admin_page_url.'?page=smart-sidebars-slider&tab=sidebars&sss-task=rules&job='.$sidebar->_id.'&sidebar-saved=true');
            exit;
        }
    }

    public function admin_menu() {
        if (defined('SMART_PLUGINS_CENTRAL')) {
            $this->page_ids[] = add_submenu_page('smart-plugins-central', __("Smart Sidebars Slider", "smart-sidebars-slider"), __("Sidebars Slider", "smart-sidebars-slider"), 'activate_plugins', 'smart-sidebars-slider', array(&$this, 'tools_menu'));
        } else {
            $this->page_ids[] = add_options_page(__("Smart Sidebars Slider", "smart-sidebars-slider"), __("Smart Sidebars Slider", "smart-sidebars-slider"), 'activate_plugins', 'smart-sidebars-slider', array(&$this, 'tools_menu'));
        }

        foreach ($this->page_ids as $id) {
            add_action('load-'.$id, array(&$this, 'load_admin_page_shared'));
        }
    }

    public function load_admin_page_shared() {
        $screen = get_current_screen();

        $screen->set_help_sidebar('
            <p><strong>SMART Plugins:</strong></p>
            <p><a target="_blank" href="http://www.smartplugins.info/">'.__("Website", "smart-sidebars-slider").'</a></p>
            <p><a target="_blank" href="http://codecanyon.net/user/GDragoN/portfolio?ref=GDragoN">'.__("On CodeCanyon", "smart-sidebars-slider").'</a></p>
            <p><a target="_blank" href="http://twitter.com/millanrs">'.__("On Twitter", "smart-sidebars-slider").'</a></p>
            <p><a target="_blank" href="http://facebook.com/smartplugins">'.__("On Facebook", "smart-sidebars-slider").'</a></p>');

        $screen->add_help_tab(array(
            'id' => 'scs-screenhelp-info',
            'title' => __("Information", "smart-sidebars-slider"),
            'content' => '<p>'.__("Add newsletter subscription forms to the website using widgets, shortcodes or functions with support for many subscription services.", "smart-sidebars-slider").'</p>
                <h5>'.__("Useful Links", "smart-sidebars-slider").'</h5>
                <p><a target="_blank" href="http://www.smartplugins.info/plugin/wordpress/smart-sidebars-slider/">'.__("Plugin Homepage", "smart-sidebars-slider").'</a></p>
                <p><a target="_blank" href="http://d4p.me/ccsss">'.__("Plugin On CodeCanyon", "smart-sidebars-slider").'</a></p>'
        ));

        $screen->add_help_tab(array(
            'id' => 'scs-screenhelp-support',
            'title' => __("Support", "smart-sidebars-slider"),
            'content' => '<h5>'.__("Support Reources", "smart-sidebars-slider").'</h5>
                <p><a target="_blank" href="http://forum.smartplugins.info/forums/forum/smart/smart-ajax-subscribe/">'.__("Official Support Forum", "smart-sidebars-slider").'</a></p>'
        ));
    }

    public function tools_menu() {
        if (isset($_GET['tab']) && $_GET['tab'] == 'about') {
            $about = smart_sss_core()->settings;
        } else if (isset($_GET['tab']) && $_GET['tab'] == 'styler') {
            $styler = smart_sss_core()->styler;
        } else if (isset($_GET['tab']) && $_GET['tab'] == 'sidebars') {
            $sidebars = smart_sss_core()->sidebars;
        } else {
            $settings = smart_sss_core()->settings;
        }

        $task = isset($_GET['sss-task']) ? $_GET['sss-task'] : '';
        $job = isset($_GET['job']) ? $_GET['job'] : 0;

        if (isset($_GET['tab']) && $_GET['tab'] == 'styler') {
            if ($task != '') {
                if ($job > 0 && $styler['styles'][$job]) {
                    $style = $styler['styles'][$job];
                } else {
                    $style = array();
                }
            }
        }

        if (isset($_GET['tab']) && $_GET['tab'] == 'sidebars') {
            if ($task != '') {
                if ($job > 0 && $sidebars['sidebars'][$job]) {
                    $sidebar = $sidebars['sidebars'][$job];
                } else {
                    $sidebar = array();
                }
            }
        }

        include(SSS_PATH.'forms/index.php');
    }
}

global $sss_core_admin;
$sss_core_admin = new sss_admin();

?>
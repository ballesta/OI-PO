<?php

if (!defined('ABSPATH')) exit;

class sss_object_core {
    public $_id = 0;

    function __construct($args = array()) {
        if (is_array($args) && !empty($args)) {
            $this->from_array($args);
        }
    }

    function __clone() {
        foreach($this as $key => $val) {
            if(is_object($val)||(is_array($val))){
                $this->{$key} = unserialize(serialize($val));
            }
        }
    }

    public function to_array() {
        return get_object_vars($this);
    }

    public function from_array($args) {
        foreach ($args as $key => $value) {
            $this->$key = $value;
        }
    }
}

class sss_sidebar_core extends sss_object_core {
    public $_name = 'New Sidebar';
    public $_description = 'This is my new Slider Sidebar';

    public $rules = array('mode' => 'sitewide');
    public $content = 'sidebar';
    public $full_size = false;
    public $content_custom = '';
    public $content_html = '';
    public $content_action = '';

    public $style = 'dfl-1';
    public $location = 'right';
    public $anchor = 'top';
    public $opacity = 100;
    public $opacityOpen = 100;
    public $openOnLoad = false;
    public $outClickToClose = false;

    public $wrapClass = '';
    public $wrapOffset = 64;
    public $wrapEdge = 40;
    public $wrapSpace = 8;
    
    public $minWindowWidth = 0;
    public $minWindowHeight = 0;

    public $drawerClass = '';
    public $drawerWidth = 300;
    public $drawerHeight = 600;
    public $drawerPadding = 15;

    public $tabClass = '';
    public $tabWidth = 128;
    public $tabHeight = 36;
    public $tabOffset = 32;
    public $tabEdge = 32;
    public $tabRotate = true;
    public $tabContent = 'Sidebar';
    public $tabContentClosed = '';
    public $tabTitle = '';

    public $animateOpenDuration = 600;
    public $animateOpenEffect = 'easeInBack';
    public $animateCloseDuration = 300;
    public $animateCloseEffect = 'easeOutBack';

    public function __construct($args = array()) {
        if (empty($args)) {
            $this->minWindowWidth = smart_sss_core()->get('std_minWindowWidth');
            $this->minWindowHeight = smart_sss_core()->get('std_minWindowHeight');
            $this->wrapOffset = smart_sss_core()->get('std_wrapOffset');
            $this->wrapEdge = smart_sss_core()->get('std_wrapEdge');
            $this->wrapSpace = smart_sss_core()->get('std_wrapSpace');
            $this->drawerWidth = smart_sss_core()->get('std_drawerWidth');
            $this->drawerHeight = smart_sss_core()->get('std_drawerHeight');
            $this->drawerPadding = smart_sss_core()->get('std_drawerPadding');
        } else {
            parent::__construct($args);
        }
    }

    public function active() {
        $is = false;

        if ($this->rules['mode'] == 'sitewide') {
            $is = true;
        } else if ($this->rules['mode'] == 'rules') {
            foreach ($this->rules as $rule => $values) {
                if ($rule == 'mode') {
                    continue;
                }

                $fnc_match = false;
                switch ($rule) {
                    case 'post_id_single':
                        foreach ($values as $id) {
                            if (is_single($id) || is_page($id)) {
                                $is = true;
                                break;
                            }
                        }
                        break;
                    case 'post_type_archive':
                        $is = is_post_type_archive($values);
                        break;
                    case 'post_type_single':
                        $is = is_singular($values);
                        break;
                    case 'taxonomy_archive':
                        if (in_array('category', $values)) {
                            $is = is_category();
                        }

                        if (!$is) {
                            if (in_array('post_tag', $values)) {
                                $is = is_tag();
                            }
                        }

                        if (!$is) {
                            $is = is_tax($values);
                        }                        
                        break;
                    case 'date_archive':
                    case 'special_pages':
                    case 'plugins_pages':
                        foreach ($values as $function_call) {
                            $is = $function_call();

                            if ($is) {
                                $fnc_match = $function_call;
                                break;
                            }
                        }
                        break;
                }

                if ($is) {
                    $this->_match = array('type' => $rule, 'item' => $fnc_match);
                    break;
                }
            }
        }

        return apply_filters('sss_sidebar_activation_'.$this->_id, $is, $this);
    }
    
    public function save($post) {
        $core = array('_id', '_name', '_description');
        $types = array(
            'int' => array('minWindowWidth', 'minWindowHeight', 'opacity', 'opacityOpen', 'animateOpenDuration', 'animateCloseDuration', 'wrapOffset', 'wrapEdge', 'wrapSpace', 'drawerWidth', 'drawerHeight', 'drawerPadding', 'tabWidth', 'tabHeight', 'tabOffset', 'tabEdge'),
            'bool' => array('tabRotate', 'openOnLoad', 'full_size', 'outClickToClose'),
            'html' => array('tabContent', 'tabContentClosed', 'content_custom', 'content_html', 'tabTitle')
        );

        $this->_id = isset($post['_id']) ? intval($post['_id']) : 0;
        $this->_name = strip_tags(stripslashes($post['_name']));
        $this->_description = strip_tags(stripslashes($post['_description']));

        foreach ($types['bool'] as $key) {
            $this->$key = false;
        }

        foreach ($post as $key => $vars) {
            if (!in_array($key, $core)) {
                if (in_array($key, $types['int'])) {
                    $this->$key = intval($vars);
                } else if (in_array($key, $types['bool'])) {
                    $this->$key = true;
                } else if (in_array($key, $types['html'])) {
                    $this->$key = stripslashes($vars);
                } else {
                    $this->$key = strip_tags(stripslashes($vars));
                }
            }
        }

        if ($this->opacity > 100) {
            $this->opacity = 100;
        }

        if ($this->opacityOpen > 100) {
            $this->opacityOpen = 100;
        }

        if ($this->_id == 0) {
            $this->_id = smart_sss_core()->next_sidebar_id();
        }
    }

    public function save_rules($post) {
        $this->rules = array('mode' => $post['mode']);

        if ($this->rules['mode'] == 'rules') {
            $active = isset($post['active']) ? (array)$post['active'] : array();

            $list = array();
            if (!empty($active)) {
                foreach ($active as $key) {
                    if (isset($post[$key])) {
                        if ($key == 'post_id_single') {
                            $raw = explode(',', $post[$key]);

                            $raw = array_map('trim', $raw);
                            $raw = array_map('intval', $raw);
                            $raw = array_unique($raw);

                            $settings = array_filter($raw);
                        } else {
                            $settings = (array)$post[$key];
                        }

                        if (!empty($settings)) {
                            $list[] = $key;
                            $this->rules[$key] = $settings;
                        }
                    }
                }
            }

            if (empty($list)) {
                $this->rules['mode'] = 'manual';
            }
        }
    }

    public function display_rules() {
        if ($this->rules['mode'] == 'sitewide') {
            return __("Site wide active", "smart-sidebars-slider");
        } else if ($this->rules['mode'] == 'manual') {
            return __("Manual activation", "smart-sidebars-slider");
        } else {
            include(SSS_PATH.'core/rules.php');

            $list = array();
            foreach ($this->rules as $code => $values) {
                if ($code == 'mode') continue;

                $label = $rules_types[$code];

                switch ($code) {
                    case 'post_id_single':
                        $list[] = $label.': <strong>'.join(', ', $values).'</strong>';
                        break;
                    default:
                        $find = array();
                        $source = $$code;

                        foreach ($source as $key => $val) {
                            if (in_array($key, $values)) {
                                $find[] = $val;
                            }
                        }

                        $list[] = $label.': <strong>'.join(', ', $find).'</strong>';
                        break;
                }
            }

            return join('<br/>', $list);
        }
    }

    public function rule_settings($name) {
        return isset($this->rules[$name]) ? $this->rules[$name] : array();
    }
    
    public function rule_active($name) {
        return isset($this->rules[$name]);
    }

    public function sidebar_id() {
        return 'sss-sidebar-'.$this->_id;
    }

    public function build_html() {
        echo SSS_EOL.'<div class="sss-sidebar-wrapper" style="width: 100%; max-width: '.$this->drawerWidth.'px; display: none" id="sss-sidebar-source-div-'.$this->_id.'">'.SSS_EOL;

        do_action('sss_sidebar_display_before');
        do_action('sss_sidebar_display_before_'.$this->_id);

        switch ($this->content) {
            default:
            case 'sidebar':
                echo '<ul>';
                dynamic_sidebar($this->sidebar_id());
                echo '</ul>';
                break;
            case 'html':
                echo do_shortcode($this->content_html);
                break;
            case 'custom':
                eval('?>'.$this->content_custom);
                break;
            case 'action':
                do_action($this->content_action);
                break;
        }

        do_action('sss_sidebar_display_after_'.$this->_id);
        do_action('sss_sidebar_display_after');

        echo SSS_EOL.'</div>'.SSS_EOL;
    }

    public function build_js($a = array(), $o = array(), $full_size = true) {
        $args = array(
            'style' => $a['style'], 
            'border' => $a['border'], 
            'tabRound' => $a['tabRound'], 
            'drawerRound' => $a['drawerRound'], 
            'scrollerActive' => 'nano', 
            'embed' => smart_sss_core()->get('std_embed'), 
            'zIndex' => smart_sss_core()->get('std_zIndex'), 
            'zIndexOpen' => smart_sss_core()->get('std_zIndexOpen'),
            'scrollerOptions' => array(
                'sliderMaxHeight' => 160, 
                'preventPageScrolling' => true, 
                'iOSNativeScrolling' => true),
            'position' => smart_sss_core()->get('std_position'));

        $opacity = array('opacity', 'opacityOpen');
        $skip = array(
            '_name', '_match', '_args', '_description', '_id', 'rules', 
            'full_size', 'style', 'content', 'content_custom', 'content_action'
        );

        foreach ($this as $key => $val) {
            if (!in_array($key, $skip)) {
                if (in_array($key, $opacity)) {
                    $args[$key] = $val / 100;
                } else {
                    $args[$key] = $val;
                }
            }
        }

        if ($args['tabContentClosed'] == '') {
            $args['tabContentClosed'] = false;
        }

        foreach ($o as $key => $v) {
            $args[$key] = $v;
        }

        if ($full_size && $this->full_size) {
            $args['drawerHeight'] = 4096;
            $args['wrapOffset'] = 0;
            $args['wrapEdge'] = 0;
        }

        $args = apply_filters('sss_sidebar_arguments', $args, $this);

        $render = 'var sss_source_args_'.$this->_id.' = '.json_encode($args).';'.SSS_EOL;

        if ($full_size && $this->full_size && is_admin_bar_showing()) {
            $what = $args['anchor'] == 'top' ? 'wrapOffset' : 'wrapEdge';
            $render.= 'sss_source_args_'.$this->_id.'.'.$what.' = jQuery("#wpadminbar").height();'.SSS_EOL;
        }

        $render.= 'jQuery("#sss-sidebar-source-div-'.$this->_id.'").smartTabDrawer(sss_source_args_'.$this->_id.');'.SSS_EOL;

        return $render;
    }

    public function get_tab_height() {
        return $this->tabRotate ? $this->tabWidth : $this->tabHeight;
    }
}

class sss_style_core extends sss_object_core {
    private $fonts = array(
        'arial' => 'Arial, "Helvetica Neue", Helvetica, sans-serif',
        'arial-black' => '"Arial Black", "Arial Bold", Gadget, sans-serif',
        'century-gothic' => '"Century Gothic", CenturyGothic, AppleGothic, sans-serif',
        'helvetica' => '"Helvetica Neue", Helvetica, Arial, sans-serif',
        'tahoma' => 'Tahoma, Verdana, Segoe, sans-serif',
        'trebuchet-ms' => '"Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif',
        'verdana' => 'Verdana, Geneva, sans-serif',
        'garmond' => 'Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif',
        'georgia' => 'Georgia, Times, "Times New Roman", serif',
        'palatino' => 'Palatino, "Palatino Linotype", "Palatino LT STD", "Book Antiqua", Georgia, serif',
        'times-new-roman' => 'TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif',
        'courier-new' => '"Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace',
        'lucida-sans-typewriter' => '"Lucida Sans Typewriter", "Lucida Console", Monaco, "Bitstream Vera Sans Mono", monospace;',
        'copperplate' => 'Copperplate, "Copperplate Gothic Light", fantasy',
        'papyrus' => 'Papyrus, fantasy',
        'brush-script-mt' => '"Brush Script MT", cursive'
    );

    public $_name = 'New Style';
    public $_code = 'new-style';

    public $tabRound = 4;
    public $drawerRound = 5;

    public $background = '#fefefe 1';
    public $color = '#333333 1';
    public $link_color = '#990000 1';
    public $border = '2 px solid #111111 1';

    public $tab_color = '#990000 1';
    public $tab_font_size = '1.1 em';
    public $tab_font_family = 'inherit';
    public $tab_font_weight = '700';
    public $tab_font_style = 'normal';

    public $nano_pane_background = "#333333 .1";
    public $nano_slider_background = "#111111 .7";
    
    public function border_width() {
        $parts = explode(' ', $this->border);

        return intval($parts[0]);
    }

    public function save($post) {
        $core = array('_id', '_name', '_code', 'fonts');
        $types = array(
            'int' => array('tabRound', 'drawerRound')
        );

        $this->_id = isset($post['_id']) ? intval($post['_id']) : 0;
        $this->_name = strip_tags(stripslashes($post['_name']));
        $this->_code = strip_tags(stripslashes($post['_code']));

        foreach ($post as $key => $vars) {
            if (!in_array($key, $core)) {
                if (in_array($key, $types['int'])) {
                    $this->$key = intval($vars[0]);
                } else {
                    $this->$key = is_array($vars) ? join(' ', $vars) : $vars;
                }
            }
        }

        if ($this->_id == 0) {
            $this->_id = smart_sss_core()->next_style_id();
        }
    }

    private function template() {
        $this->tpl = '
.%style% .std-drawer {
    background-color: %background%;
    color: %color%;
    border: %border%;
}

.%style% .std-drawer a {
    color: %link_color%;
}

.%style% .std-tab {
    background-color: %background%;
    border: %border%;
    color: %tab_color%;
    font-family: %tab_font_family%;
    font-weight: %tab_font_weight%;
    font-style: %tab_font_style%;
    font-size: %tab_font_size%;
}

.%style% .nano .nano-pane {
    background: %nano_pane_background%;
}

.%style% .nano .nano-slider {
    background: %nano_slider_background%;
}';
    }

    public function build($print = false) {
        $this->template();

        $core = array('_id', '_name', '_code', 'fonts');
        $this->tpl = str_replace('%style%', 'std-style-'.$this->_code, $this->tpl);

        foreach ($this as $key => $value) {
            if (!in_array($key, $core)) {
                $parts = explode(' ', $value);

                $replace = '';
                if (strpos($key, 'font_family') !== false) {
                    if ($value == 'inherit') {
                        $replace = 'inherit';
                    } else if ($value != 'none') {
                        $replace = $this->fonts[$value];
                    }
                } else if (strpos($key, 'font_weight') !== false || strpos($key, 'font_style') !== false) {
                    $replace = $value;
                } else if (strpos($key, 'font_size') !== false) {
                    $replace = $parts[0].$parts[1];
                } else if (strpos($key, 'color') !== false || strpos($key, 'background') !== false) {
                    if ($parts[1] < 1) {
                        $replace = sss_styler_hex_to_rgba($parts[0], $parts[1]);
                    } else {
                        $replace = $parts[0];
                    }
                } else if (strpos($key, 'border') !== false) {
                    $replace = $parts[0].$parts[1].' '.$parts[2].' ';

                    if ($parts[4] < 1) {
                        $replace.= sss_styler_hex_to_rgba($parts[3], $parts[4]);
                    } else {
                        $replace.= $parts[3];
                    }
                }

                $this->tpl = str_replace('%'.$key.'%', $replace, $this->tpl);
            }
        }

        if (!$print) {
            $this->tpl = str_replace('    ', '', $this->tpl);
            $this->tpl = str_replace("\r\n", '', $this->tpl);
        }

        return $this->tpl;
    }

    public function to_array_string() {
        $list = $this->to_array();
        
        $p = array();

        foreach ($list as $name => $value) {
            if (is_bool($value)) {
                $v = $value === false ? 'false' : 'true';
            } else if (is_null($value)) {
                $v = 'null';
            } else {
                $v = is_string($value) ? "'".str_replace("'", "\'", $value)."'" : $value;
            }

            $p[] = $tab."'$name' => $v";
        }

        return 'array('.join(', ', $p).')';
    }
}

?>
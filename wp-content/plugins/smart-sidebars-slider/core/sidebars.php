<?php

if (!defined('ABSPATH')) exit;

class sss_sidebars {
    public $js = array();
    public $sidebars = array();
    public $active = array();
    public $styles = array();
    public $styles_map = array();
    public $styles_borders = array();
    public $styles_radius = array('tab' => array(), 'drawer' => array());
    public $sides = array();
    public $wrap_offset = array();
    public $wrap_edge = array();
    public $tab_edge = array();
    public $anchors = array('left' => '', 'right' => '');
    public $opened = array('left' => '', 'right' => '');

    function __construct() {
        add_action('widgets_init', array(&$this, 'register'), 10000);

        if (!is_admin()) {
            add_action('wp', array(&$this, 'init'));
        }
    }

    public function id($sidebar) {
        return 'sss-sidebar-'.$sidebar->_id;
    }

    public function args($sidebar) {
        $args = apply_filters('sss_sidebar_registration_args', array(
            'class' => '',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>'
        ), $sidebar);

        $args['name'] = $sidebar->_name;
        $args['description'] = $sidebar->_description;
        $args['id'] = $this->id($sidebar);

        return $args;
    }

    public function register() {
        foreach (smart_sss_core()->get_ordered_sidebars() as $raw) {
            $this->sidebars[$raw['_id']] = new sss_sidebar_core($raw);
            $this->sidebars[$raw['_id']]->_args = $this->args($this->sidebars[$raw['_id']]);

            register_sidebar($this->sidebars[$raw['_id']]->_args);
        }
    }

    public function init() {
        foreach ($this->sidebars as $id => $sidebar) {
            if ($sidebar->active()) {
                $this->active[] = $id;
                $this->styles[] = $sidebar->style;
            }
        }

        if (!empty($this->active)) {
            add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
            add_action('wp_head', array(&$this, 'wp_head'), 1000);
            add_action('wp_footer', array(&$this, 'wp_footer_top'), 0);
            add_action('wp_footer', array(&$this, 'wp_footer_bottom'), 10000000);
        }
    }

    public function wp_head() {
        $this->styles = array_unique($this->styles);

        echo SSS_EOL.'<style type="text/css">'.SSS_EOL;
        echo '/* Smart Sidebars Slider */'.SSS_EOL;

        foreach ($this->styles as $code) {
            $id = substr($code, 4);
            $type = substr($code, 0, 3);

            if ($type != 'cst') {
                if ($type == 'dfl') {
                    $raw = smart_sss_core()->styles[$id];
                } else if ($type == 'stl') {
                    $raw = smart_sss_core()->get_style($id);
                }

                $style = new sss_style_core($raw);
                $this->styles_map[$code] = $style->_code;
                $this->styles_borders[$code] = $style->border_width();
                $this->styles_radius['tab'][$code] = $style->tabRound;
                $this->styles_radius['drawer'][$code] = $style->drawerRound;

                echo SSS_EOL.'/* '.$style->_name.' */'.SSS_EOL;
                echo $style->build();
                echo SSS_EOL;
            } else {
                $obj = smart_sss_core()->get_custom_style($id);

                $this->styles_map[$code] = $id;
                $this->styles_borders[$code] = $obj['border'];
            }
        }

        do_action('sss_embed_styles_css');

        echo SSS_EOL.'</style>'.SSS_EOL;
    }

    public function wp_footer_top() {
        $this->js = array();
        $on = array('left' => 0, 'right' => 0);

        foreach ($this->active as $id) {
            $sidebar = $this->sidebars[$id];
            $location = $sidebar->location;

            if ($sidebar->openOnLoad && $this->opened[$location] == '') {
                $this->opened[$location] = $id;
            }

            $on[$location]++;
        }

        $left_one = smart_sss_core()->get('auto_tab_left_disable_single');
        $right_one = smart_sss_core()->get('auto_tab_right_disable_single');

        $left_active = smart_sss_core()->get('auto_tab_left_active');
        $right_active = smart_sss_core()->get('auto_tab_right_active');

        $left_full = smart_sss_core()->get('auto_tab_left_full_size');
        $right_full = smart_sss_core()->get('auto_tab_right_full_size');

        if ($left_one && $on['left'] < 2) {
            $left_active = false;
        }

        if ($right_one && $on['right'] < 2) {
            $right_active = false;
        }

        if ($left_active || $right_active) {
            $left_wrap_offset = smart_sss_core()->get('auto_wrap_left_offset');
            $left_wrap_edge = smart_sss_core()->get('auto_wrap_left_edge');
            $left_tab_offset = smart_sss_core()->get('auto_tab_left_offset');
            $left_tab_edge = smart_sss_core()->get('auto_tab_left_edge');
            $left_tab_spacing = smart_sss_core()->get('auto_tab_left_spacing');

            $right_wrap_offset = smart_sss_core()->get('auto_wrap_right_offset');
            $right_wrap_edge = smart_sss_core()->get('auto_wrap_right_edge');
            $right_tab_offset = smart_sss_core()->get('auto_tab_right_offset');
            $right_tab_edge = smart_sss_core()->get('auto_tab_right_edge');
            $right_tab_spacing = smart_sss_core()->get('auto_tab_right_spacing');

            foreach ($this->active as $id) {
                $sidebar = $this->sidebars[$id];
                $location = $sidebar->location;

                if ($location == 'left' && $left_active) {
                    if ($this->anchors['left'] == '') {
                        $this->anchors['left'] = $sidebar->anchor;
                    }

                    $this->sides[$id] = $left_tab_offset;

                    $this->wrap_offset[$id] = $left_wrap_offset;
                    $this->wrap_edge[$id] = $left_wrap_edge;
                    $this->tab_edge[$id] = $left_tab_edge;

                    $left_tab_offset+= $sidebar->get_tab_height() + $left_tab_spacing;
                } else if ($location == 'right' && $right_active) {
                    if ($this->anchors['right'] == '') {
                        $this->anchors['right'] = $sidebar->anchor;
                    }

                    $this->sides[$id] = $right_tab_offset;

                    $this->wrap_offset[$id] = $right_wrap_offset;
                    $this->wrap_edge[$id] = $right_wrap_edge;
                    $this->tab_edge[$id] = $right_tab_edge;

                    $right_tab_offset+= $sidebar->get_tab_height() + $right_tab_spacing;
                }
            }
        }

        foreach ($this->active as $id) {
            $sidebar = $this->sidebars[$id];

            $a = array(
                'style' => $this->styles_map[$sidebar->style],
                'border' => $this->styles_borders[$sidebar->style],
                'tabRound' => $this->styles_radius['tab'][$sidebar->style],
                'drawerRound' => $this->styles_radius['drawer'][$sidebar->style]
            );

            $o = array('fullSize' => true,
                'openOnLoad' => $this->opened[$sidebar->location] != '' && $this->opened[$sidebar->location] == $id
            );

            if (isset($this->wrap_offset[$id])) {
                $o['wrapOffset'] = $this->wrap_offset[$id];
            }

            if (isset($this->wrap_edge[$id])) {
                $o['wrapEdge'] = $this->wrap_edge[$id];
            }

            if (isset($this->tab_edge[$id])) {
                $o['tabEdge'] = $this->tab_edge[$id];
            }

            if (isset($this->sides[$id])) {
                $o['tabOffset'] = $this->sides[$id];
            }

            if ($this->anchors[$sidebar->location] != '') {
                $o['anchor'] = $this->anchors[$sidebar->location];
            }

            if ($left_full == 'none') {
                $sidebar->full_size = false;
            } else if ($left_full == 'all') {
                $sidebar->full_size = true;
            }

            $this->js[] = $sidebar->build_js($a, $o);

            $sidebar->build_html();
        }
    }

    public function wp_footer_bottom() {
        echo SSS_EOL.'<script type="text/javascript">'.SSS_EOL;
        echo 'jQuery(document).ready(function() {'.SSS_EOL;

        do_action('sss_embed_scripts_before');

        echo join(SSS_EOL, $this->js);

        do_action('sss_embed_scripts_after');

        echo '});'.SSS_EOL;
        echo '</script>'.SSS_EOL;
    }

    public function wp_enqueue_scripts() {
        if (smart_sss_core()->get('load_fontawesome')) {
            wp_enqueue_style('sss-fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
        }

        wp_enqueue_style('sss-scroller', SSS_URL.'css/jquery.nanoscroller.min.css', array(), SMART_SIDEBARS_SLIDER);
        wp_enqueue_style('sss-drawer', SSS_URL.'css/drawer.core.min.css', array('sss-scroller'), SMART_SIDEBARS_SLIDER);
        wp_enqueue_style('sss-sidebars', SSS_URL.'css/sidebars.css', array('sss-drawer'), SMART_SIDEBARS_SLIDER);

        wp_enqueue_script('sss-easing', SSS_URL.'js/jquery.easing.min.js', array('jquery'), SMART_SIDEBARS_SLIDER, true);
        wp_enqueue_script('sss-scroller', SSS_URL.'js/jquery.nanoscroller.min.js', array('jquery'), SMART_SIDEBARS_SLIDER, true);
        wp_enqueue_script('sss-drawer', SSS_URL.'js/drawer.core.min.js', array('jquery', 'sss-easing', 'sss-scroller'), SMART_SIDEBARS_SLIDER, true);
    }
}

global $sss_sidebars_obj;
$sss_sidebars_obj = new sss_sidebars();

function sss_sidebars() {
    global $sss_sidebars_obj;
    return $sss_sidebars_obj;
}

?>
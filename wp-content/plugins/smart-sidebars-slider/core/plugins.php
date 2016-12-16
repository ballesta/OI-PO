<?php

if (!defined('ABSPATH')) exit;

class sss_plugins_expander {
    public $plugins = array();

    function __construct() {
        $this->detect();

        if (!empty($this->plugins)) {
            add_filter('sss_rules_list_thirdparty_plugins', array(&$this, 'rules_list'));
        }
    }

    public function rules_list($list) {
        return $list + $this->plugins;
    }

    public function detect() {
        // bbPress //
        if (function_exists('bbp_version')) {
            $version = bbp_get_version();
            $version = intval(substr(str_replace('.', '', $version), 0, 2));

            if ($version > 22) {
                $this->plugins['is_bbpress'] = __("bbPress Content", "smart-sidebars-slider");
            }
        }

        // BuddyPress //
        if (function_exists('bp_version') && function_exists('is_buddypress')) {
            $version = bp_get_version();
            $version = intval(substr(str_replace('.', '', $version), 0, 2));

            if ($version > 16) {
                $this->plugins['is_buddypress'] = __("BuddyPress Content", "smart-sidebars-slider");
            }
        }

        // WooCommerce //
        if (defined('WOOCOMMERCE_VERSION') && function_exists('is_woocommerce')) {
            $version = WOOCOMMERCE_VERSION;
            $version = intval(substr(str_replace('.', '', $version), 0, 2));

            if ($version > 19) {
                $this->plugins['is_woocommerce'] = __("WooCommerce Content", "smart-sidebars-slider");
            }
        }

        // Smart Audio Playlist //
        if (defined('SMART_AUDIO_PLAYER')) {
            $version = SMART_AUDIO_PLAYER;
            $version = intval(substr(str_replace('.', '', $version), 0, 2));

            if ($version > 15) {
                $this->plugins['is_smart_audio_playlists'] = __("Smart Audio Playlist Content", "smart-sidebars-slider");
            }
        }

        // JigoShop //
        if (defined('JIGOSHOP_VERSION') && function_exists('is_jigoshop')) {
            $this->plugins['is_jigoshop'] = __("JigoShop Content", "smart-sidebars-slider");
        }
    }
}

?>
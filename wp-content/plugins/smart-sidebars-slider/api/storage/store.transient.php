<?php

/*
Name:    Smart Envato API: Storage - Transient
Version: 3.3
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: http://www.dev4press.com/

== Copyright ==
Copyright 2008 - 2015 Milan Petrovic (email: milan@gdragon.info)
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('smart_envato_storage_transient')) {
    final class smart_envato_storage_transient extends smart_envato_api_storage {
        public function get($name) {
            return get_transient($name);
        }

        public function set($name, $value, $ttl = 0) {
            return set_transient($name, $value, $ttl);
        }

        public function delete($name) {
            return delete_transient($name);
        }

        public function clear($base) {
            global $wpdb;

            $sql = sprintf("DELETE FROM %soptions WHERE option_name LIKE '%s' OR option_name LIKE '%s'", $wpdb->prefix, '_transient_'.$base.'%', '_transient_timeout_'.$base.'%');
            $wpdb->query($sql);
        }
    }
}

?>
<?php

if (!defined('ABSPATH')) exit;

global $wp_post_types, $wp_taxonomies;

$rules_types = array(
    'post_type_archive' => __("Post Types Archives", "smart-sidebars-slider"),
    'post_type_single' => __("Post Types Single Posts", "smart-sidebars-slider"),
    'post_id_single' => __("Posts by ID", "smart-sidebars-slider"),
    'taxonomy_archive' => __("Taxonomies Archives", "smart-sidebars-slider"),
    'date_archive' => __("Date Based Archives", "smart-sidebars-slider"),
    'special_pages' => __("Other Pages", "smart-sidebars-slider"),
    'plugins_pages' => __("Plugins Content", "smart-sidebars-slider")
);

$taxonomy_archive = array();
$post_type_archive = array();
$post_type_single = array();

foreach ($wp_taxonomies as $tax => $obj) {
    if ($obj->public) {
        $taxonomy_archive[$tax] = $obj->labels->name;
    }
}

foreach ($wp_post_types as $cpt => $obj) {
    if ($obj->has_archive !== false) {
        $post_type_archive[$cpt] = $obj->labels->name;
    }

    if ($obj->public) {
        $post_type_single[$cpt] = $obj->labels->name;
    }
}

$date_archive = array(
    'is_date' => __("Any date archive", "smart-sidebars-slider"),
    'is_year' => __("Year archives", "smart-sidebars-slider"),
    'is_month' => __("Month archives", "smart-sidebars-slider"),
    'is_day' => __("Day archives", "smart-sidebars-slider")
);

$special_pages = array(
    'is_front_page' => __("Front Page", "smart-sidebars-slider"),
    'is_search' => __("Search Results Page", "smart-sidebars-slider"),
    'is_404' => __("404 Error Page", "smart-sidebars-slider"),
    'is_author' => __("Author Archive Pages", "smart-sidebars-slider")
);

$plugins_pages = apply_filters('sss_rules_list_thirdparty_plugins', array());

?>
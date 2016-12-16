<?php

$validxpr = array('styles', 'settings', 'sidebars');

define('SMART_PLUGINS_WPLOAD', '');

function smart_export_settings($export) {
    $settings = array(
        'settings' => 'smart-sidebars-slider',
        'styles' => 'smart-sidebars-slider-styler',
        'sidebars' => 'smart-sidebars-slider-sidebars'
    );

    $data = new stdClass();

    foreach ($export as $key) {
        $option = $settings[$key];
        $data->$option = get_option($option);
    }

    return serialize($data);
}

function smart_is_current_user_role($role = 'administrator') {
    global $current_user;

    if (is_array($current_user->roles)) {
        return in_array($role, $current_user->roles);
    } else {
        return false;
    }
}

function smart_get_wpload_path() {
    if (SMART_PLUGINS_WPLOAD == '') {
        $d = 0;

        while (!file_exists(str_repeat('../', $d).'wp-load.php'))
            if (++$d > 16) exit;
        return str_repeat('../', $d).'wp-load.php';
    } else {
        return SMART_PLUGINS_WPLOAD;
    }
}

$wpload = smart_get_wpload_path();
require($wpload);

@ini_set('memory_limit', '128M');
@set_time_limit(360);

check_ajax_referer('sss-settings-export');

if (!smart_is_current_user_role()) {
    wp_die(__("Only administrators can use export features.", "smart-sidebars-slider"));
}

$export_date = date('Y-m-d');

$export = array_values(array_intersect($validxpr, explode(',', $_GET['export'])));

if (empty($export)) {
    wp_die(__("Nothing is selected for export.", "smart-sidebars-slider"));
}

header('Content-type: application/force-download');
header('Content-Disposition: attachment; filename="smart_sidebars_slider_settings_'.$export_date.'.sss"');

echo smart_export_settings($export);

?>
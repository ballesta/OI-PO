<?php

$current = isset($_GET['tab']) ? $_GET['tab'] : 'settings';
$tabs = array(
    'settings' => array(__("Settings", "smart-sidebars-slider"), '__inner__'),
    'auto' => array(__("Auto Position", "smart-sidebars-slider"), '__inner__'),
    'defaults' => array(__("Defaults", "smart-sidebars-slider"), '__inner__'),
    'sidebars' => array(__("Sidebars", "smart-sidebars-slider"), '__inner__'),
    'styler' => array(__("Styler", "smart-sidebars-slider"), '__inner__'),
    'impexp' => array(__("Export / Import", "smart-sidebars-slider"), '__inner__')
);

$tabs = apply_filters('sss_admin_tabs_list', $tabs);

$tabs['about'] = array(__("About", "smart-sidebars-slider"), '__inner__');

?>

<div class="wrap sct-wordpress-<?php echo SSS_WP_VERSION; ?>">
    <h2><?php _e("Smart Sidebars Slider", "smart-sidebars-slider"); ?>
        <span class="sct-version"> | <?php echo smart_sss_core()->get('__version__'); ?></span></h2>
    <?php if (isset($_GET['settings-updated'])) { ?>
        <div id="message" class="updated"><p><strong><?php _e("Settings saved.", "smart-sidebars-slider"); ?></strong></p></div>
    <?php } if (isset($_GET['style-saved'])) { ?>
        <div id="message" class="updated"><p><strong><?php _e("Style settings saved.", "smart-sidebars-slider"); ?></strong></p></div>
    <?php } if (isset($_GET['style-deleted'])) { ?>
        <div id="message" class="updated"><p><strong><?php _e("Style deleted.", "smart-sidebars-slider"); ?></strong></p></div>
    <?php } if (isset($_GET['sidebar-saved'])) { ?>
        <div id="message" class="updated"><p><strong><?php _e("Sidebar settings saved.", "smart-sidebars-slider"); ?></strong></p></div>
    <?php } if (isset($_GET['sidebar-deleted'])) { ?>
        <div id="message" class="updated"><p><strong><?php _e("Sidebar deleted.", "smart-sidebars-slider"); ?></strong></p></div>
    <?php } if (isset($_GET['import-failed'])) { ?>
        <div id="message" class="error"><p><strong><?php _e("File import failed.", "smart-sidebars-slider"); ?></strong></p></div>
    <?php } if (isset($_GET['import-nothing'])) { ?>
        <div id="message" class="error"><p><strong><?php _e("Nothing imported.", "smart-sidebars-slider"); ?></strong></p></div>
    <?php } ?>
    <div id="icon-themes" class="icon32"><br></div>
    <h2 class="nav-tab-wrapper">
    <?php

    foreach ($tabs as $tab => $data) {
        $class = $tab == $current ? ' nav-tab-active' : '';
        echo '<a class="nav-tab'.$class.'" href="'.$this->admin_page_url.'?page=smart-sidebars-slider&tab='.$tab.'">'.$data[0].'</a>';
    }

    ?>
    </h2>
    <div id="ddw-panel" class="ddw-panel-<?php echo $current; ?>">
        <?php

        $location = $tabs[$current][1];

        if ($location == '__inner__') {
            if ($current == 'styler' && $job != '') {
                if ($task == 'css') {
                    include(SSS_PATH.'forms/css.php');
                } else {
                    include(SSS_PATH.'forms/style.php');
                }
            } else if ($current == 'sidebars' && $job != '') {
                if ($task == 'rules') {
                    include(SSS_PATH.'forms/rules.php');
                } else if ($task == 'jquery') {
                    include(SSS_PATH.'forms/jquery.php');
                } else {
                    include(SSS_PATH.'forms/sidebar.php');
                }
            } else {
                include(SSS_PATH.'forms/'.$current.'.php');
            }
        } else {
            include($location);
        }

        ?>
    </div>  
</div>

<?php

$s = new sss_sidebar_core($sidebar);

$code = 'sss-sidebar';

$all_content = array(
    'sidebar' => __("Widgets", "smart-sidebars-slider"),
    'html' => __("HTML / Shortcodes", "smart-sidebars-slider"),
    'custom' => __("PHP / HTML", "smart-sidebars-slider"),
    'action' => __("Custom Action", "smart-sidebars-slider")
);

$all_locations = array(
    'left' => __("Left", "smart-sidebars-slider"),
    'right' => __("Right", "smart-sidebars-slider")
);

$all_anchors = array(
    'top' => __("Top", "smart-sidebars-slider"),
    'bottom' => __("Bottom", "smart-sidebars-slider")
);

$all_effects = array(
    'swing' => 'Swing', 
    'linear' => 'Linear', 
    'easeInQuad' => 'Quad In', 
    'easeOutQuad' => 'Quad Out', 
    'easeInOutQuad' => 'Quad In Out', 
    'easeInCubic' => 'Cubic In', 
    'easeOutCubic' => 'Cubic Out', 
    'easeInOutCubic' => 'Cubic In Out', 
    'easeInQuart' => 'Quart In', 
    'easeOutQuart' => 'Quart Out', 
    'easeInOutQuart' => 'Quart In Out', 
    'easeInQuint' => 'Quint In', 
    'easeOutQuint' => 'Quint Out', 
    'easeInOutQuint' => 'Quint In Out', 
    'easeInSine' => 'Sine In', 
    'easeOutSine' => 'Sine Out', 
    'easeInOutSine' => 'Sine in Out', 
    'easeInExpo' => 'Expo In', 
    'easeOutExpo' => 'Expo Out', 
    'easeInOutExpo' => 'Expo in Out', 
    'easeInCirc' => 'Circ In', 
    'easeOutCirc' => 'Circ Out', 
    'easeInOutCirc' => 'Circ In Out', 
    'easeInElastic' => 'Elastic In', 
    'easeOutElastic' => 'Elastic Out', 
    'easeInOutElastic' => 'Elastic In Out', 
    'easeInBack' => 'Back In', 
    'easeOutBack' => 'Back Out', 
    'easeInOutBack' => 'Back In Out', 
    'easeInBounce' => 'Bounce In',
    'easeOutBounce' => 'Bounce Out',
    'easeInOutBounce' => 'Bounce In Out'
);

$all_styles = array(
    array('title' => __("Default Styles", "smart-sidebars-slider"), 'values' => array()),
    array('title' => __("Styler Styles", "smart-sidebars-slider"), 'values' => array())
);

foreach (smart_sss_core()->styles as $key => $style) {
    $all_styles[0]['values']['dfl-'.$key] = $style['_name'];
}

foreach (smart_sss_core()->styler['styles'] as $id => $obj) {
    $all_styles[1]['values']['stl-'.$id] = $obj['_name'];
}

if (!empty(smart_sss_core()->custom)) {
    $all_styles[] = array('title' => __("Custom Styles", "smart-sidebars-slider"), 'values' => array());

    foreach (smart_sss_core()->custom as $css => $obj) {
        $all_styles[2]['values']['cst-'.$css] = $obj['name'];
    }
}

?>
<form method="post" action="">
    <?php settings_fields('smart-sidebars-slider-sidebar-builder'); ?>
    <input type="hidden" name="sss-sidebar[_id]" value="<?php echo $s->_id; ?>" />

    <div class="sct-cleanup-left">
        <div id="scs-scroll-sidebar" class="scs-scroll-active">
            <p>
                <?php _e("Set up sidebar on this panel, the way it will look like, size and animation.", "smart-sidebars-slider"); ?>
            </p>
            <input class="button-primary" type="submit" value="<?php _e("Save Sidebar", "smart-sidebars-slider"); ?>" />
            <p class="sct-left-info sct-top-notice">
                <?php _e("For more information about all settings, the way the sidebar is positioned, please consult the user guide. Guide contains examples on how the offset, edge and other parameters are used to define the sidebar and tab.", "smart-sidebars-slider"); ?>
            </p>
        </div>
    </div>
    <div class="sct-cleanup-right sct-normal">
        <h3 style="margin-top: 0;"><?php _e("Sidebar Name And Description", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 600px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Name", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Name", "smart-sidebars-slider"); ?></span></legend>
                            <input type="text" class="widefat" name="sss-sidebar[_name]" value="<?php echo $s->_name; ?>" />
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Description", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Description", "smart-sidebars-slider"); ?></span></legend>
                            <input type="text" class="widefat stw-slug-input" name="sss-sidebar[_description]" value="<?php echo $s->_description; ?>" />

                            <br/><em>
                                <?php _e("Displayed on the Widgets panel.", "smart-sidebars-slider"); ?>
                            </em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Content", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 600px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Sidebar Content", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Sidebar Content", "smart-sidebars-slider"); ?></span></legend>
                            <?php sss_render_select($all_content, array('selected' => $s->content, 'id' => 'sidebar-content-select', 'name' => $code.'[content]')); ?>

                            <br/><em>
                                <?php _e("By design, sidebar is registered and you can place widgets in it. But, you can choose to place any other content instead: custom PHP/HTML or use action to add content though code.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr style="display: <?php echo $s->content == 'sidebar' ? 'table-row' : 'none' ?>;" valign="top" id="sidebar-content-sidebar" class="sidebar-content">
                    <th scope="row"><?php _e("Widgets", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Widgets", "smart-sidebars-slider"); ?></span></legend>
                            <?php _e("Add widgets from the WordPress Appearance / Widgets panel for this sidebar", "smart-sidebars-slider"); ?>: 
                            <a href="widgets.php"><?php _e("Widgets Panel", "smart-sidebars-slider"); ?></a>
                        </fieldset>
                    </td>
                </tr>
                <tr style="display: <?php echo $s->content == 'custom' ? 'table-row' : 'none' ?>;" valign="top" id="sidebar-content-custom" class="sidebar-content">
                    <th scope="row"><?php _e("PHP / HTML", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("PHP / HTML", "smart-sidebars-slider"); ?></span></legend>
                            <textarea name="sss-sidebar[content_custom]" style="width: 100%; height: 128px"><?php echo esc_html($s->content_custom); ?></textarea>

                            <br/><em>
                                <?php _e("This can be any HTML and PHP code you want.", "smart-sidebars-slider"); ?> 
                                <?php _e("If you added widgets to this sidebar, they will not be displayed.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr style="display: <?php echo $s->content == 'html' ? 'table-row' : 'none' ?>;" valign="top" id="sidebar-content-html" class="sidebar-content">
                    <th scope="row"><?php _e("HTML / Shortcodes", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("HTML / Shortcodes", "smart-sidebars-slider"); ?></span></legend>
                            <textarea name="sss-sidebar[content_html]" style="width: 100%; height: 128px"><?php echo esc_html($s->content_html); ?></textarea>

                            <br/><em>
                                <?php _e("This can be any HTML (with shortcodes) code you want.", "smart-sidebars-slider"); ?> 
                                <?php _e("If you added widgets to this sidebar, they will not be displayed.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr style="display: <?php echo $s->content == 'action' ? 'table-row' : 'none' ?>;" valign="top" id="sidebar-content-action" class="sidebar-content">
                    <th scope="row"><?php _e("Custom Action", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Custom Action", "smart-sidebars-slider"); ?></span></legend>
                            <input type="text" class="widefat" name="sss-sidebar[content_action]" value="<?php echo esc_attr($s->content_action); ?>" />

                            <br/><em>
                                <?php _e("This is the name of the custom action. Plugin will run this action, and you need to hook a function to it to print whatever you want to appear in the sidebar.", "smart-sidebars-slider"); ?> 
                                <?php _e("If you added widgets to this sidebar, they will not be displayed.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Style and Location", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 600px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Screen Location", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Screen Location", "smart-sidebars-slider"); ?></span></legend>
                            <?php sss_render_select($all_locations, array('selected' => $s->location, 'name' => $code.'[location]')); ?>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Color Style", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Style", "smart-sidebars-slider"); ?></span></legend>
                            <?php sss_render_select_grouped($all_styles, array('selected' => $s->style, 'name' => $code.'[style]')); ?>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Minimal Browser Size", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Width and Height", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[minWindowWidth]" value="<?php echo esc_attr($s->minWindowWidth); ?>" /> x 
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[minWindowHeight]" value="<?php echo esc_attr($s->minWindowHeight); ?>" />

                            <br/><em>
                                <?php _e("If the browser size is smaller than dimensions set here, sidebar will not be active. This can be used if you want to hide sidebar on small screen devices.", "smart-sidebars-slider"); ?> 
                                <?php _e("These values have to be positive numbers, and both in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Sidebar Wrapper", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 600px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Anchor", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Screen Anchor", "smart-sidebars-slider"); ?></span></legend>
                            <?php sss_render_select($all_anchors, array('selected' => $s->anchor, 'name' => $code.'[anchor]')); ?>

                            <br/><em>
                                <?php _e("This option is used to set fixed point for the sidebar. Tab offset and resizing depend on this value.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Full Size", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Full Size", "smart-sidebars-slider"); ?></span></legend>
                            <label for="s_full_size">
                                <input<?php echo $s->full_size ? ' checked="checked"' : ''; ?> type="checkbox" value="1" id="s_full_size" name="sss-sidebar[full_size]">
                                <?php _e("Auto size sidebar to full available height", "smart-sidebars-slider"); ?></label>

                            <br/><em>
                                <?php _e("If this option is active, Offset and Edge values will be ignored. Sidebar height will be ignored also. WordPress toolbar will be taken into account.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Offset", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Offset", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[wrapOffset]" value="<?php echo esc_attr($s->wrapOffset); ?>" />

                            <br/><em>
                                <?php _e("Offset is space between sidebar and the screen edge defined by Anchor.", "smart-sidebars-slider"); ?> 
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Edge", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Edge", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[wrapEdge]" value="<?php echo esc_attr($s->wrapEdge); ?>" />

                            <br/><em>
                                <?php _e("Edge is space between sidebar and the screen edge oposite to Anchor.", "smart-sidebars-slider"); ?> 
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Side Offset", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Side Offset", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[wrapSpace]" value="<?php echo esc_attr($s->wrapSpace); ?>" />

                            <br/><em>
                                <?php _e("Side offset is extra space on the side oposite to sidebar location.", "smart-sidebars-slider"); ?> 
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Extra CSS Class", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Extra CSS Class", "smart-sidebars-slider"); ?></span></legend>
                            <input type="text" class="widefat" name="sss-sidebar[wrapClass]" value="<?php echo esc_attr($s->wrapClass); ?>" />
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Sidebar Container", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 600px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Width and Height", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Width and Height", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[drawerWidth]" value="<?php echo esc_attr($s->drawerWidth); ?>" /> x 
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[drawerHeight]" value="<?php echo esc_attr($s->drawerHeight); ?>" />

                            <br/><em>
                                <?php _e("These values have to be positive numbers, and both in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Padding", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Padding", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[drawerPadding]" value="<?php echo esc_attr($s->drawerPadding); ?>" />

                            <br/><em>
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Extra CSS Class", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Extra CSS Class", "smart-sidebars-slider"); ?></span></legend>
                            <input type="text" class="widefat" name="sss-sidebar[drawerClass]" value="<?php echo esc_attr($s->drawerClass); ?>" />
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Sidebar Tab", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 600px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Tab Label, Open", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Tab Label, Open", "smart-sidebars-slider"); ?></span></legend>
                            <input type="text" class="widefat" name="sss-sidebar[tabContent]" value="<?php echo esc_attr($s->tabContent); ?>" />

                            <br/><em>
                                <?php _e("This can be plain text or HTML. Make it short to fit the size of the tab.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Tab Label, Closed", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Tab Label, Closed", "smart-sidebars-slider"); ?></span></legend>
                            <input type="text" class="widefat" name="sss-sidebar[tabContentClosed]" value="<?php echo esc_attr($s->tabContentClosed); ?>" />

                            <br/><em>
                                <?php _e("This can be plain text or HTML. Make it short to fit the size of the tab.", "smart-sidebars-slider"); ?> 
                                <?php _e("Leave this value empty, and it will use Open value for closed tab state.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Tab Title", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Tab Title", "smart-sidebars-slider"); ?></span></legend>
                            <input type="text" class="widefat" name="sss-sidebar[tabTitle]" value="<?php echo esc_attr($s->tabTitle); ?>" />

                            <br/><em>
                                <?php _e("It will be set as 'title' attribute to tab element and will act as tooltip on hover.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Tab Rotation", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Tab Rotation", "smart-sidebars-slider"); ?></span></legend>
                            <label for="s_tabRotate">
                                <input<?php echo $s->tabRotate ? ' checked="checked"' : ''; ?> type="checkbox" value="1" id="s_tabRotate" name="sss-sidebar[tabRotate]">
                                <?php _e("90 degree rotation", "smart-sidebars-slider"); ?></label>

                            <br/><em>
                                <?php _e("If you use single character for sidebar label, disable rotation and make width and height the same. If you use text, enable rotation to display tab label vertical.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Width and Height", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Width and Height", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[tabWidth]" value="<?php echo esc_attr($s->tabWidth); ?>" /> x 
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[tabHeight]" value="<?php echo esc_attr($s->tabHeight); ?>" />

                            <br/><em>
                                <?php _e("These values have to be positive numbers, and both in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Tab Offset", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Top Offset", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[tabOffset]" value="<?php echo esc_attr($s->tabOffset); ?>" />

                            <br/><em>
                                <?php _e("Offset is space between tab and sidebar content on the side defined by Anchor.", "smart-sidebars-slider"); ?> 
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Tab Edge", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Top Edge", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[tabEdge]" value="<?php echo esc_attr($s->tabEdge); ?>" />

                            <br/><em>
                                <?php _e("Edge is on oposite side to offset for the tab, and it is minimal space allowed when resizing sidebar.", "smart-sidebars-slider"); ?> 
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Extra CSS Class", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Extra CSS Class", "smart-sidebars-slider"); ?></span></legend>
                            <input type="text" class="widefat" name="sss-sidebar[tabClass]" value="<?php echo esc_attr($s->tabClass); ?>" />
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Opacity", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 600px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Open Opacity", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Open Opacity", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[opacityOpen]" value="<?php echo esc_attr($s->opacityOpen); ?>" />

                            <br/><em>
                                <?php _e("Opacity for the whole sidebar when it is open. Range from 0 to 100.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Closed Opacity", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Closed Opacity", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[opacity]" value="<?php echo esc_attr($s->opacity); ?>" />

                            <br/><em>
                                <?php _e("Opacity for the whole sidebar when it is closed. Range from 0 to 100.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Slider Animation", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 600px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Open Duration", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Open Duration", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[animateOpenDuration]" value="<?php echo esc_attr($s->animateOpenDuration); ?>" />

                            <br/><em>
                                <?php _e("This value has to be positive number, and it is in miliseconds.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Open Effect", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Open Effect", "smart-sidebars-slider"); ?></span></legend>
                            <?php sss_render_select($all_effects, array('selected' => $s->animateOpenEffect, 'name' => $code.'[animateOpenEffect]')); ?>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Close Duration", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Close Duration", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss-sidebar[animateCloseDuration]" value="<?php echo esc_attr($s->animateCloseDuration); ?>" />

                            <br/><em>
                                <?php _e("This value has to be positive number, and it is in miliseconds.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Close Effect", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Close Effect", "smart-sidebars-slider"); ?></span></legend>
                            <?php sss_render_select($all_effects, array('selected' => $s->animateCloseEffect, 'name' => $code.'[animateCloseEffect]')); ?>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Advanced Settings", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 600px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Open on Load", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Open on Load", "smart-sidebars-slider"); ?></span></legend>
                            <label for="s_openOnLoad">
                                <input<?php echo $s->openOnLoad ? ' checked="checked"' : ''; ?> type="checkbox" value="1" id="s_openOnLoad" name="sss-sidebar[openOnLoad]">
                                <?php _e("Sidebar will be open on page load", "smart-sidebars-slider"); ?></label>

                            <br/><em>
                                <?php _e("Be careful with this option, if you have more than one sidebar on the page. If you set more then one sidebar to open on load, it can create a mess on the screen. Also, plugin will allow only one open sidebar on each side of the screen.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Close on outside Click", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Close on outside Click", "smart-sidebars-slider"); ?></span></legend>
                            <label for="s_outClickToClose">
                                <input<?php echo $s->outClickToClose ? ' checked="checked"' : ''; ?> type="checkbox" value="1" id="s_outClickToClose" name="sss-sidebar[outClickToClose]">
                                <?php _e("If open, Sidebar will close when you click anywhere outside of it", "smart-sidebars-slider"); ?></label>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>
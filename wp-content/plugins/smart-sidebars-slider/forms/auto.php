<?php

$form_full_size = array(
    'none' => __("Disable full size for all sidebars"),
    'all' => __("Enable full size for all sidebars"),
    'manual' => __("Leave as it is for all sidebars")
);

?>
<form method="post" action="">
    <?php settings_fields('smart-sidebars-slider-auto'); ?>

    <div class="sct-cleanup-left">
        <div id="scs-scroll-sidebar" class="scs-scroll-active">
            <p>
                <?php _e("With auto positioning, plugin will ignore some of the sidebars individual settings and it will automatically calculate location of tabs to prevent overlaps.", "smart-sidebars-slider"); ?>
            </p>
            <input class="button-primary" type="submit" value="<?php _e("Save Settings", "smart-sidebars-slider"); ?>" />
            <p class="sct-left-info sct-top-notice">
                <?php _e("With too many sidebars with big tabs are on one screen side, proper positioning can be a problem.", "smart-sidebars-slider"); ?>
            </p>
            <p class="sct-left-info sct-top-notice">
                <?php _e("For more information about all settings, the way the sidebar is positioned, please consult the user guide.", "smart-sidebars-slider"); ?>
            </p>
        </div>
    </div>
    <div class="sct-cleanup-right">
        <h3 style="margin-top: 0;"><?php _e("Left Screen Side", "smart-sidebars-slider"); ?></h3>

        <table class="form-table" style="width: 600px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Auto Position", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Auto Position", "smart-sidebars-slider"); ?></span></legend>
                            <label for="auto_tab_left_active">
                                <input<?php echo $settings['auto_tab_left_active'] ? ' checked="checked"' : ''; ?> type="checkbox" value="1" id="auto_tab_left_active" name="sss[auto_tab_left_active]">
                                <?php _e("Active", "smart-sidebars-slider"); ?></label>
                            <hr/>
                            <label for="auto_tab_left_disable_single">
                                <input<?php echo $settings['auto_tab_left_disable_single'] ? ' checked="checked"' : ''; ?> type="checkbox" value="1" id="auto_tab_left_disable_single" name="sss[auto_tab_left_disable_single]">
                                <?php _e("Disable if only one sidebar added", "smart-sidebars-slider"); ?></label>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Wrapper Full Size", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Wrapper Full Size", "smart-sidebars-slider"); ?></span></legend>
                            <?php sss_render_select($form_full_size, array('selected' => $settings['auto_tab_left_full_size'], 'name' => 'sss[auto_tab_left_full_size]')); ?>

                            <br/><em>
                                <?php _e("This will control full size for all sidebars on this side.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Wrapper Offset", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Wrapper Offset", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[auto_wrap_left_offset]" value="<?php echo esc_attr($settings['auto_wrap_left_offset']); ?>" />

                            <br/><em>
                                <?php _e("Offset is space between sidebar and the screen edge defined by Anchor.", "smart-sidebars-slider"); ?> 
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Wrapper Edge", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Wrapper Edge", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[auto_wrap_left_edge]" value="<?php echo esc_attr($settings['auto_wrap_left_edge']); ?>" />

                            <br/><em>
                                <?php _e("Edge is space between sidebar and the screen edge oposite to Anchor.", "smart-sidebars-slider"); ?> 
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Tab Offset", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Tab Offset", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[auto_tab_left_offset]" value="<?php echo esc_attr($settings['auto_tab_left_offset']); ?>" />

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
                            <legend class="screen-reader-text"><span><?php _e("Tab Edge", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[auto_tab_left_edge]" value="<?php echo esc_attr($settings['auto_tab_left_edge']); ?>" />

                            <br/><em>
                                <?php _e("Edge is on oposite side to offset for the tab, and it is minimal space allowed when resizing sidebar.", "smart-sidebars-slider"); ?> 
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Tab Spacing", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Tab Spacing", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[auto_tab_left_spacing]" value="<?php echo esc_attr($settings['auto_tab_left_spacing']); ?>" />

                            <br/><em>
                                <?php _e("This option defines space between two tabs. This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Right Screen Side", "smart-sidebars-slider"); ?></h3>

        <table class="form-table" style="width: 600px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Auto Position", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Auto Position", "smart-sidebars-slider"); ?></span></legend>
                            <label for="auto_tab_right_active">
                                <input<?php echo $settings['auto_tab_right_active'] ? ' checked="checked"' : ''; ?> type="checkbox" value="1" id="auto_tab_right_active" name="sss[auto_tab_right_active]">
                                <?php _e("Active", "smart-sidebars-slider"); ?></label>
                        </fieldset>
                            <hr/>
                            <label for="auto_tab_right_disable_single">
                                <input<?php echo $settings['auto_tab_right_disable_single'] ? ' checked="checked"' : ''; ?> type="checkbox" value="1" id="auto_tab_right_disable_single" name="sss[auto_tab_right_disable_single]">
                                <?php _e("Disable if only one sidebar added", "smart-sidebars-slider"); ?></label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Wrapper Full Size", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Wrapper Full Size", "smart-sidebars-slider"); ?></span></legend>
                            <?php sss_render_select($form_full_size, array('selected' => $settings['auto_tab_right_full_size'], 'name' => 'sss[auto_tab_right_full_size]')); ?>

                            <br/><em>
                                <?php _e("This will control full size for all sidebars on this side.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Wrapper Offset", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Wrapper Offset", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[auto_wrap_right_offset]" value="<?php echo esc_attr($settings['auto_wrap_right_offset']); ?>" />

                            <br/><em>
                                <?php _e("Offset is space between sidebar and the screen edge defined by Anchor.", "smart-sidebars-slider"); ?> 
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Wrapper Edge", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Wrapper Edge", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[auto_wrap_right_edge]" value="<?php echo esc_attr($settings['auto_wrap_right_edge']); ?>" />

                            <br/><em>
                                <?php _e("Edge is space between sidebar and the screen edge oposite to Anchor.", "smart-sidebars-slider"); ?> 
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Tab Offset", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Tab Offset", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[auto_tab_right_offset]" value="<?php echo esc_attr($settings['auto_tab_right_offset']); ?>" />

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
                            <legend class="screen-reader-text"><span><?php _e("Tab Edge", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[auto_tab_right_edge]" value="<?php echo esc_attr($settings['auto_tab_right_edge']); ?>" />

                            <br/><em>
                                <?php _e("Edge is on oposite side to offset for the tab, and it is minimal space allowed when resizing sidebar.", "smart-sidebars-slider"); ?> 
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Tab Spacing", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Tab Spacing", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[auto_tab_right_spacing]" value="<?php echo esc_attr($settings['auto_tab_right_spacing']); ?>" />

                            <br/><em>
                                <?php _e("This option defines space between two tabs. This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>
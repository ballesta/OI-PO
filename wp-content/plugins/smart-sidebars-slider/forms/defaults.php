<form method="post" action="">
    <?php settings_fields('smart-sidebars-slider-defaults'); ?>

    <div class="sct-cleanup-left">
        <div id="scs-scroll-sidebar" class="scs-scroll-active">
            <p>
                <?php _e("This panel contains default sidebar settings will be used only by newely added sidebars.", "smart-sidebars-slider"); ?>
            </p>
            <input class="button-primary" type="submit" value="<?php _e("Save Settings", "smart-sidebars-slider"); ?>" />
            <p class="sct-left-info sct-top-notice">
                <?php _e("For more information about all settings, the way the sidebar is positioned, please consult the user guide.", "smart-sidebars-slider"); ?>
            </p>
        </div>
    </div>
    <div class="sct-cleanup-right">

        <h3><?php _e("Style and Location", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="width: 600px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Minimal Browser Size", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Width and Height", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[std_minWindowWidth]" value="<?php echo esc_attr($settings['std_minWindowWidth']); ?>" /> x 
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[std_minWindowHeight]" value="<?php echo esc_attr($settings['std_minWindowHeight']); ?>" />

                            <br/><em>
                                <?php _e("If the browser size is smaller than dimensions set here, sidebar will not be active. This can be used if you want to hide sidebar on small screen devices.", "smart-sidebars-slider"); ?> 
                                <?php _e("These values have to be positive numbers, and both in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Sidebar Wrapper", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="width: 600px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Offset", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Offset", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[std_wrapOffset]" value="<?php echo esc_attr($settings['std_wrapOffset']); ?>" />

                            <br/><em>
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Edge", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Edge", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[std_wrapEdge]" value="<?php echo esc_attr($settings['std_wrapEdge']); ?>" />

                            <br/><em>
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Space", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Space", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[std_wrapSpace]" value="<?php echo esc_attr($settings['std_wrapSpace']); ?>" />

                            <br/><em>
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Sidebar Container", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="width: 600px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Padding", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Top Offset", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[std_drawerPadding]" value="<?php echo esc_attr($settings['std_drawerPadding']); ?>" />

                            <br/><em>
                                <?php _e("This value has to be positive number, and it is in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Width and Height", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Width and Height", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[std_drawerWidth]" value="<?php echo esc_attr($settings['std_drawerWidth']); ?>" /> x 
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[std_drawerHeight]" value="<?php echo esc_attr($settings['std_drawerHeight']); ?>" />

                            <br/><em>
                                <?php _e("These values have to be positive numbers, and both in pixels.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</form>
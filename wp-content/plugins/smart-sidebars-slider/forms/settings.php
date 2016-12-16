<?php

$form_embed = array(
    'append' => __("Append, to the BODY bottom", "smart-sidebars-slider"),
    'prepend' => __("Prepend, to the BODY top", "smart-sidebars-slider")
);

$form_position = array(
    'fixed' => __("Fixed", "smart-sidebars-slider"),
    'absolute' => __("Absolute", "smart-sidebars-slider")
);

$form_anchors = array(
    'top' => __("Top", "smart-sidebars-slider"),
    'bottom' => __("Bottom", "smart-sidebars-slider")
);

?>

<form method="post" action="">
    <?php settings_fields('smart-sidebars-slider-settings'); ?>

    <div class="sct-cleanup-left">
        <div id="scs-scroll-sidebar" class="scs-scroll-active">
            <p>
                <?php _e("This panel contains general plugin settings. If you want for plugin to auto position tabs for each sidebar slider, use Tab auto position options.", "smart-sidebars-slider"); ?>
            </p>
            <input class="button-primary" type="submit" value="<?php _e("Save Settings", "smart-sidebars-slider"); ?>" />
            <p class="sct-left-info sct-top-notice">
                <?php _e("For more information about all settings, the way the sidebar is positioned, please consult the user guide.", "smart-sidebars-slider"); ?>
            </p>
        </div>
    </div>
    <div class="sct-cleanup-right">
        <h3 style="margin-top: 0;"><?php _e("Sidebars Sliders Position", "smart-sidebars-slider"); ?></h3>

        <table class="form-table" style="width: 600px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Page Position", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Page Position", "smart-sidebars-slider"); ?></span></legend>
                            <?php sss_render_select($form_position, array('selected' => $settings['std_position'], 'name' => 'sss[std_position]')); ?>

                            <br/><em>
                                <?php _e("This is position relative to browser window. Fixed will keep sidebars always on screen is same location even when page is scrolling.", "smart-sidebars-slider"); ?> 
                                <strong><?php _e("Relative position can cause some strange scrollbars effects with many themes.", "smart-sidebars-slider"); ?></strong>
                            </em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Embed Location", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Embed Location", "smart-sidebars-slider"); ?></span></legend>
                            <?php sss_render_select($form_embed, array('selected' => $settings['std_embed'], 'name' => 'sss[std_embed]')); ?>

                            <br/><em>
                                <?php _e("In some cases (related to some themes), DOM location to add sidebars can be relevant, so here you can switch between bottom or top of BODY to embed sidebars HTML.", "smart-sidebars-slider"); ?>
                            </em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("zIndex Settings", "smart-sidebars-slider"); ?></h3>

        <table class="form-table" style="width: 600px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Normal", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Normal", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[std_zIndex]" value="<?php echo esc_attr($settings['std_zIndex']); ?>" />

                            <br/><em>
                                <?php _e("All sidebars will use this as basic zIndex. If you have more than one sidebar active, each will get unique zIndex based on this value.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Open Sidebar", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Open Sidebar", "smart-sidebars-slider"); ?></span></legend>
                            <input style="width: 128px" type="text" class="widefat sct-input-numeric" name="sss[std_zIndexOpen]" value="<?php echo esc_attr($settings['std_zIndexOpen']); ?>" />

                            <br/><em>
                                <?php _e("Sidebar currently open will use this value for zIndex.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3><?php _e("Extras", "smart-sidebars-slider"); ?></h3>

        <table class="form-table" style="width: 600px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("FontAwesome", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("FontAwesome", "smart-sidebars-slider"); ?></span></legend>
                            <label for="load_fontawesome">
                                <input<?php echo $settings['load_fontawesome'] ? ' checked="checked"' : ''; ?> type="checkbox" value="1" id="load_fontawesome" name="sss[load_fontawesome]">
                                <?php _e("Load from MaxCDN", "smart-sidebars-slider"); ?></label>

                            <br/><em>
                                <?php _e("If you want to use FontAwesome icons for tabs, you can enable this to load this font.", "smart-sidebars-slider"); ?></em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>
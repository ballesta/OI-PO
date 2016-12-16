<?php

$s = new sss_sidebar_core($sidebar);
$code = 'sss-sidebar';

$all_methods = array(
    'sitewide' => __("Site wide", "smart-sidebars-slider"),
    'manual' => __("Manual only", "smart-sidebars-slider"),
    'rules' => __("Custom rules", "smart-sidebars-slider")
);

require_once(SSS_PATH.'core/rules.php');

?>
<form method="post" action="">
    <?php settings_fields('smart-sidebars-slider-sidebar-rules'); ?>
    <input type="hidden" name="sss-sidebar[_id]" value="<?php echo $s->_id; ?>" />

    <div class="sct-cleanup-left">
        <div id="scs-scroll-sidebar" class="scs-scroll-active">
            <p>
                <?php _e("Here you can setup when the sidebar will be display. You can set it as site wide, manual or you can create set of rules.", "smart-sidebars-slider"); ?>
            </p>
            <input class="button-primary" type="submit" value="<?php _e("Save Sidebar", "smart-sidebars-slider"); ?>" />
        </div>
    </div>
    <div class="sct-cleanup-right sct-normal">
        <h3 style="margin-top: 0;"><?php _e("Select Rules Mode", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 700px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Mode", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Mode", "smart-sidebars-slider"); ?></span></legend>
                            <?php sss_render_select($all_methods, array('selected' => $s->rules['mode'], 'id' => 'sss-rules-mode', 'name' => $code.'[mode]')); ?>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <div id="sss-custom-rules" style="display: <?php echo $s->rules['mode'] == 'rules' ? 'block' : 'none'; ?>;">
            <h3><?php _e("Custom Rules", "smart-sidebars-slider"); ?></h3>
            <table class="form-table sss-form-rules" style="max-width: 700px; margin-top: 15px;">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><?php _e("Notice", "smart-sidebars-slider"); ?></th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text"><span><?php _e("Notice", "smart-sidebars-slider"); ?></span></legend>
                                <?php _e("Sidebar will be visible on pages that have at least one of the rules matched.", "smart-sidebars-slider"); ?>
                            </fieldset>
                        </td>
                    </tr>
                    <?php if (!empty($post_type_archive)) { ?>
                        <tr valign="top">
                            <th scope="row"><?php _e("Post Types Archives", "smart-sidebars-slider"); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text"><span><?php _e("Post Types Archives", "smart-sidebars-slider"); ?></span></legend>
                                    <label for="rule_post_type_archive_active">
                                        <input<?php echo $s->rule_active('post_type_archive') ? ' checked="checked"' : ''; ?> type="checkbox" value="post_type_archive" id="rule_post_type_archive_active" name="sss-sidebar[active][]" class="widefat sss-rule-active">
                                        <?php _e("Active", "smart-sidebars-slider"); ?></label>

                                    <div style="display: <?php echo $s->rule_active('post_type_archive') ? 'block' : 'none'; ?>">
                                        <?php

                                        $active = $s->rule_settings('post_type_archive');
                                        foreach ($post_type_archive as $cpt => $name) { ?>
                                            <label for="rule_post_type_archive_<?php echo $cpt; ?>">
                                                <input<?php echo in_array($cpt, $active) ? ' checked="checked"' : ''; ?> type="checkbox" value="<?php echo $cpt; ?>" id="rule_post_type_archive_<?php echo $cpt; ?>" name="sss-sidebar[post_type_archive][]" class="widefat">
                                                <?php echo $name; ?></label>
                                        <?php }

                                        ?>
                                    </div>
                                </fieldset>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr valign="top">
                        <th scope="row"><?php _e("Post Types Single Posts", "smart-sidebars-slider"); ?></th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text"><span><?php _e("Post Types Single Posts", "smart-sidebars-slider"); ?></span></legend>
                                <label for="rule_post_type_single_active">
                                    <input<?php echo $s->rule_active('post_type_single') ? ' checked="checked"' : ''; ?> type="checkbox" value="post_type_single" id="rule_post_type_single_active" name="sss-sidebar[active][]" class="widefat sss-rule-active">
                                    <?php _e("Active", "smart-sidebars-slider"); ?></label>

                                <div style="display: <?php echo $s->rule_active('post_type_single') ? 'block' : 'none'; ?>">
                                    <?php

                                    $active = $s->rule_settings('post_type_single');
                                    foreach ($post_type_single as $cpt => $name) { ?>
                                        <label for="rule_post_type_single_<?php echo $cpt; ?>">
                                            <input<?php echo in_array($cpt, $active) ? ' checked="checked"' : ''; ?> type="checkbox" value="<?php echo $cpt; ?>" id="rule_post_type_single_<?php echo $cpt; ?>" name="sss-sidebar[post_type_single][]" class="widefat">
                                            <?php echo $name; ?></label>
                                    <?php }

                                    ?>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e("Posts by ID", "smart-sidebars-slider"); ?></th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text"><span><?php _e("Posts by ID", "smart-sidebars-slider"); ?></span></legend>
                                <label for="rule_post_id_single_active">
                                    <input<?php echo $s->rule_active('post_id_single') ? ' checked="checked"' : ''; ?> type="checkbox" value="post_id_single" id="rule_post_id_single_active" name="sss-sidebar[active][]" class="widefat sss-rule-active">
                                    <?php _e("Active", "smart-sidebars-slider"); ?></label>

                                <div style="display: <?php echo $s->rule_active('post_id_single') ? 'block' : 'none'; ?>">
                                    <?php

                                    $active = $s->rule_settings('post_id_single');

                                    ?>
                                    <label for="rule_post_type_id_list"><?php _e("List of post/page ID's, comma separated", "smart-sidebars-slider"); ?>:</label>
                                    <input class="widefat" type="text" name="sss-sidebar[post_id_single]" value="<?php echo join(',', $active); ?>" id="rule_post_type_id_list" />
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e("Taxonomies Archives", "smart-sidebars-slider"); ?></th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text"><span><?php _e("Taxonomies Archives", "smart-sidebars-slider"); ?></span></legend>
                                <label for="rule_taxonomy_archive_active">
                                    <input<?php echo $s->rule_active('taxonomy_archive') ? ' checked="checked"' : ''; ?> type="checkbox" value="taxonomy_archive" id="rule_taxonomy_archive_active" name="sss-sidebar[active][]" class="widefat sss-rule-active">
                                    <?php _e("Active", "smart-sidebars-slider"); ?></label>

                                <div style="display: <?php echo $s->rule_active('taxonomy_archive') ? 'block' : 'none'; ?>">
                                    <?php

                                    $active = $s->rule_settings('taxonomy_archive');
                                    foreach ($taxonomy_archive as $cpt => $name) { ?>
                                        <label for="rule_taxonomy_archive_<?php echo $cpt; ?>">
                                            <input<?php echo in_array($cpt, $active) ? ' checked="checked"' : ''; ?> type="checkbox" value="<?php echo $cpt; ?>" id="rule_taxonomy_archive_<?php echo $cpt; ?>" name="sss-sidebar[taxonomy_archive][]" class="widefat">
                                            <?php echo $name; ?></label>
                                    <?php }

                                    ?>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e("Date Based Archives", "smart-sidebars-slider"); ?></th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text"><span><?php _e("Date Based Archives", "smart-sidebars-slider"); ?></span></legend>
                                <label for="rule_date_archive_active">
                                    <input<?php echo $s->rule_active('date_archive') ? ' checked="checked"' : ''; ?> type="checkbox" value="date_archive" id="rule_date_archive_active" name="sss-sidebar[active][]" class="widefat sss-rule-active">
                                    <?php _e("Active", "smart-sidebars-slider"); ?></label>

                                <div style="display: <?php echo $s->rule_active('date_archive') ? 'block' : 'none'; ?>">
                                    <?php

                                        $active = $s->rule_settings('date_archive');
                                        foreach ($date_archive as $cpt => $name) { ?>
                                            <label for="rule_date_archive_<?php echo $cpt; ?>">
                                                <input<?php echo in_array($cpt, $active) ? ' checked="checked"' : ''; ?> type="checkbox" value="<?php echo $cpt; ?>" id="rule_date_archive_<?php echo $cpt; ?>" name="sss-sidebar[date_archive][]" class="widefat">
                                                <?php echo $name; ?></label>
                                        <?php }

                                        ?>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e("Other Pages and Archives", "smart-sidebars-slider"); ?></th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text"><span><?php _e("Other Pages and Archives", "smart-sidebars-slider"); ?></span></legend>
                                <label for="rule_special_pages_active">
                                    <input<?php echo $s->rule_active('special_pages') ? ' checked="checked"' : ''; ?> type="checkbox" value="special_pages" id="rule_special_pages_active" name="sss-sidebar[active][]" class="widefat sss-rule-active">
                                    <?php _e("Active", "smart-sidebars-slider"); ?></label>

                                <div style="display: <?php echo $s->rule_active('special_pages') ? 'block' : 'none'; ?>">
                                    <?php

                                    $active = $s->rule_settings('special_pages');
                                    foreach ($special_pages as $cpt => $name) { ?>
                                        <label for="rule_special_pages_<?php echo $cpt; ?>">
                                            <input<?php echo in_array($cpt, $active) ? ' checked="checked"' : ''; ?> type="checkbox" value="<?php echo $cpt; ?>" id="rule_special_pages_<?php echo $cpt; ?>" name="sss-sidebar[special_pages][]" class="widefat">
                                            <?php echo $name; ?></label>
                                    <?php }

                                    ?>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <?php if (!empty($plugins_pages)) { ?>
                        <tr valign="top">
                            <th scope="row"><?php _e("Plugins Content", "smart-sidebars-slider"); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text"><span><?php _e("Plugins Content", "smart-sidebars-slider"); ?></span></legend>
                                    <label for="rule_plugins_pages_active">
                                        <input<?php echo $s->rule_active('plugins_pages') ? ' checked="checked"' : ''; ?> type="checkbox" value="plugins_pages" id="rule_plugins_pages_active" name="sss-sidebar[active][]" class="widefat sss-rule-active">
                                        <?php _e("Active", "smart-sidebars-slider"); ?></label>

                                    <div style="display: <?php echo $s->rule_active('plugins_pages') ? 'block' : 'none'; ?>">
                                        <?php

                                        $active = $s->rule_settings('plugins_pages');
                                        foreach ($plugins_pages as $cpt => $name) { ?>
                                            <label for="rule_plugins_pages_<?php echo $cpt; ?>">
                                                <input<?php echo in_array($cpt, $active) ? ' checked="checked"' : ''; ?> type="checkbox" value="<?php echo $cpt; ?>" id="rule_plugins_pages_<?php echo $cpt; ?>" name="sss-sidebar[plugins_pages][]" class="widefat">
                                                <?php echo $name; ?></label>
                                        <?php }

                                        ?>
                                    </div>
                                </fieldset>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <h3><?php _e("Manual Activation Hook", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 700px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Notice", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Notice", "smart-sidebars-slider"); ?></span></legend>

                            <?php _e("Manual activation hook can be used always, regardless of the mode you selected. This hook (WordPress filter) is unique for each sidebar, and it expects values TRUE/FALSE (to display/hide sidebar).", "smart-sidebars-slider"); ?><br/>
                            <?php _e("If you set mode to manual, this filter initial value is always FALSE. If you set to site wide, value is always TRUE. If mode is on custom rules, initial value for this filter depends on the rules detection.", "smart-sidebars-slider"); ?>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Filter Name", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Filter Name", "smart-sidebars-slider"); ?></span></legend>

                            <pre style="display: inline-block; background-color: #FFFFFF; margin: 0; padding: 3px 6px;">sss_sidebar_activation_<?php echo $s->_id; ?></pre>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>
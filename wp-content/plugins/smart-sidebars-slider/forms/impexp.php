<div class="sct-cleanup-left sct-export-left">
    <h3 style="margin-top: 0;"><?php _e("Export Plugin Settings", "smart-sidebars-slider"); ?></h3>
    <p style="min-height: 140px;">
        <?php _e("Plugin settings (one or more records stored in the WordPress options table), sidebars and custom styles will be exported as serialized string and saved into text file that can be imported on this or any other WordPress installation. Do not make any modifications to this file, or later import will fail!", "smart-sidebars-slider"); ?>
    </p>

    <div class="sct-export-import-settings" style="min-height: 100px;">
        <label for="export_styles"><input checked="checked" class="sct-checkbox" type="checkbox" id="export_styles" name="export_styles" /> <?php _e("Export Custom Styles", "smart-sidebars-slider"); ?></label>
        <br/>
        <label for="export_sidebars"><input checked="checked" class="sct-checkbox" type="checkbox" id="export_sidebars" name="export_sidebars" /> <?php _e("Export Sidebars Settings", "smart-sidebars-slider"); ?></label>
        <br/>
        <label for="export_settings"><input checked="checked" class="sct-checkbox" type="checkbox" id="export_settings" name="export_settings" /> <?php _e("Export Plugin Settings", "smart-sidebars-slider"); ?></label>
    </div>

    <input id="run-export" data-url="<?php echo SSS_URL; ?>core/export.php?_ajax_nonce=<?php echo wp_create_nonce('sss-settings-export'); ?>" type="button" class="button-primary" value="<?php _e("Export", "smart-sidebars-slider"); ?>" />
</div>
<div class="sct-cleanup-right sct-import-right">
    <form method="post" action="" enctype="multipart/form-data">
        <?php settings_fields('smart-sidebars-slider-import'); ?>

        <h3 style="margin-top: 0;"><?php _e("Import Plugin Settings", "smart-sidebars-slider"); ?></h3>
        <p style="min-height: 140px;">
            <?php _e("You need valid, unmodified export file (.sss extension), generated by the export tool on this page. Importing data will overwrite all exisiting data!", "smart-sidebars-slider"); ?>
        </p>

        <div class="sct-export-import-settings" style="min-height: 100px;">
            <label for="import_styles"><input checked="checked" class="sct-checkbox" type="checkbox" id="import_styles" name="import_styles" /> <?php _e("Import Custom Styles", "smart-sidebars-slider"); ?></label>
            <br/>
            <label for="import_sidebars"><input checked="checked" class="sct-checkbox" type="checkbox" id="import_sidebars" name="import_sidebars" /> <?php _e("Import Sidebars Settings", "smart-sidebars-slider"); ?></label>
            <br/>
            <label for="import_settings"><input checked="checked" class="sct-checkbox" type="checkbox" id="import_settings" name="import_settings" /> <?php _e("Import Plugin Settings", "smart-sidebars-slider"); ?></label>
            <br/>
            <input class="sct-import-file" type="file" name="import_file" />
        </div>
        <input type="submit" class="button-primary" value="<?php _e("Import", "smart-sidebars-slider"); ?>" />
    </form>
</div>

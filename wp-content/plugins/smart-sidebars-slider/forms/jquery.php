<?php

$id = $_GET['job'];

?>
<div class="sct-cleanup-left">
    <div id="scs-scroll-sidebar" class="scs-scroll-active">
        <p>
            <?php _e("If you need to control sidebars from JavaScript for extra interaction, you can use jQuery code to open or close the sidebar.", "smart-sidebars-slider"); ?>
        </p>
        <p style="font-weight: bold;">
            <?php _e("To use these examples it is required to have knowledge of JavaScript and jQuery!", "smart-sidebars-slider"); ?>
        </p>
    </div>
</div>
<div class="sct-cleanup-right sct-normal">
    <h3 style="margin-top: 0;"><?php _e("Open / Close Sidebar", "smart-sidebars-slider"); ?></h3>
    <table class="form-table" style="max-width: 700px; margin-top: 15px;">
        <tbody>
            <tr valign="top">
                <th style="width: 80px;" scope="row"><?php _e("Open", "smart-sidebars-slider"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e("Open", "smart-sidebars-slider"); ?></span></legend>

                        <div class="sss-htaccess-code"><pre>jQuery("#sss-sidebar-source-div-<?php echo $id; ?>").smartTabDrawer("open");</pre></div>

                        <em><?php _e("Opens the sidebar if it is closed.", "smart-sidebars-slider"); ?></em>
                    </fieldset>
                </td>
            </tr>
            <tr valign="top">
                <th style="width: 80px;" scope="row"><?php _e("Close", "smart-sidebars-slider"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e("Close", "smart-sidebars-slider"); ?></span></legend>

                        <div class="sss-htaccess-code"><pre>jQuery("#sss-sidebar-source-div-<?php echo $id; ?>").smartTabDrawer("close");</pre></div>

                        <em><?php _e("Closes the sidebar if it is open.", "smart-sidebars-slider"); ?></em>
                    </fieldset>
                </td>
            </tr>
            <tr valign="top">
                <th style="width: 80px;" scope="row"><?php _e("Toggle", "smart-sidebars-slider"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e("Toggle", "smart-sidebars-slider"); ?></span></legend>

                        <div class="sss-htaccess-code"><pre>jQuery("#sss-sidebar-source-div-<?php echo $id; ?>").smartTabDrawer("toggle");</pre></div>

                        <em><?php _e("Opens the sidebar if it is closed or closes sidebar if it is open.", "smart-sidebars-slider"); ?></em>
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table>
    
    <h3><?php _e("Show / Hide Sidebar", "smart-sidebars-slider"); ?></h3>
    <table class="form-table" style="max-width: 700px; margin-top: 15px;">
        <tbody>
            <tr valign="top">
                <th style="width: 80px;" scope="row"><?php _e("Show", "smart-sidebars-slider"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e("Show", "smart-sidebars-slider"); ?></span></legend>

                        <div class="sss-htaccess-code"><pre>jQuery("#sss-sidebar-source-div-<?php echo $id; ?>").smartTabDrawer("show");</pre></div>

                        <em><?php _e("Show sidebar if it is hidden. Do not abuse this operation and attempt to show sidebars hidden when another sidebar is open.", "smart-sidebars-slider"); ?></em>
                    </fieldset>
                </td>
            </tr>
            <tr valign="top">
                <th style="width: 80px;" scope="row"><?php _e("Hide", "smart-sidebars-slider"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e("Hide", "smart-sidebars-slider"); ?></span></legend>

                        <div class="sss-htaccess-code"><pre>jQuery("#sss-sidebar-source-div-<?php echo $id; ?>").smartTabDrawer("hide");</pre></div>

                        <em><?php _e("Hide sidebar if it is visible.", "smart-sidebars-slider"); ?></em>
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table>
</div>
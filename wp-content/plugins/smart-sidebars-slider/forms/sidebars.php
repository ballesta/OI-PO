<?php

$url = $this->admin_page_url.'?page=smart-sidebars-slider&tab=sidebars&sss-task=';

$all_jobs = smart_sss_core()->get_ordered_sidebars();

?>
<div class="sct-cleanup-left">
    <div id="scs-scroll-sidebar">
        <p>
            <?php _e("You can add sidebars, or edit exitings sidebars from the list on the right. For each sidebar, you can set rules to display them on in different website areas.", "smart-sidebars-slider"); ?><br/>
        </p>
        <input onclick="window.location='<?php echo $this->admin_page_url; ?>?page=smart-sidebars-slider&tab=sidebars&sss-task=new&job=0';" class="button-primary" type="button" value="<?php _e("New Sidebar", "smart-sidebars-slider"); ?>" />
        <p class="sct-left-info sct-top-notice">
            <?php _e("To reorder sidebars, move sidebars up and down by draging the sidebar ID column.", "smart-sidebars-slider"); ?>
        </p>
    </div>
</div>
<div class="sct-cleanup-right">
    <?php if (empty($all_jobs)) { ?>
        <h2 class="sct-cleanup-stats-title"><?php _e("There are sidebars created yet.", "smart-sidebars-slider") ?></h2>
    <?php } else { ?>
        <table class="widefat sct-table-grid" id="sss-sidebars-grid" style="max-width: 1280px;">
            <thead>
                <tr>
                    <th style="width: 30px"><?php _e("ID", "smart-sidebars-slider"); ?></th>
                    <th style="width: 20%"><?php _e("Sidebar Name", "smart-sidebars-slider"); ?></th>
                    <th><?php _e("Rules", "smart-sidebars-slider"); ?></th>
                    <th style="width: 14%"><?php _e("Tab Label", "smart-sidebars-slider"); ?></th>
                    <th style="width: 9%"><?php _e("Location", "smart-sidebars-slider"); ?></th>
                    <th style="text-align: right; width: 12%"><?php _e("Options", "smart-sidebars-slider"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php

                    foreach ($all_jobs as $job) {
                        $sidebar = new sss_sidebar_core($job);

                        echo '<tr data-sidebar="'.$sidebar->_id.'">';
                            echo '<td class="sss-sort-handler" style="vertical-align: top;">'.$sidebar->_id.'</td>';
                            echo '<td style="vertical-align: top;"><h4><a title="'.__("Edit this sidebar.", "smart-sidebars-slider").'" class="srt-opt-edit" href="'.$url.'edit&job='.$sidebar->_id.'">'.$sidebar->_name.'</a></h4>'.$sidebar->_description.'</td>';
                            echo '<td style="vertical-align: top;">'.$sidebar->display_rules();
                            echo '<br/><a href="'.$url.'rules&job='.$sidebar->_id.'">'.__("edit rules", "smart-sidebars-slider").'</a>';
                            echo '</td>';
                            echo '<td style="vertical-align: top;">'.$sidebar->tabContent.'</td>';
                            echo '<td style="vertical-align: top;">'.ucfirst($sidebar->location).'</td>';
                            echo '<td class="srt-job-options" style="text-align: right; vertical-align: top;">';
                                echo '<a title="'.__("Get jQuery code for sidebar control from JavaScript.", "smart-sidebars-slider").'" href="'.$url.'jquery&job='.$sidebar->_id.'">'.__("jquery", "smart-sidebars-slider").'</a> | ';
                                echo '<a title="'.__("Copy this sidebar to create new one.", "smart-sidebars-slider").'" href="'.$url.'copy&job='.$sidebar->_id.'">'.__("copy", "smart-sidebars-slider").'</a> | ';
                                echo '<a title="'.__("Delete this sidebar.", "smart-sidebars-slider").'" class="srt-opt-delete" onclick="return sss_admin.confirm()" href="'.$url.'delete&job='.$sidebar->_id.'">'.__("delete", "smart-sidebars-slider").'</a>';
                            echo '</td>';
                        echo '</tr>';
                    }

                ?>
            </tbody>
        </table>
    <?php } ?>
</div>

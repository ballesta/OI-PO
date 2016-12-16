<?php

$url = $this->admin_page_url.'?page=smart-sidebars-slider&tab=styler&sss-task=';

$all_jobs = $styler['styles'];

?>
<div class="sct-cleanup-left">
    <div id="scs-scroll-sidebar">
        <p>
            <?php _e("You can create new color styles, or edit exitings custom styles from the list on the right.", "smart-sidebars-slider"); ?><br/>
        </p>
        <input onclick="window.location='<?php echo $this->admin_page_url; ?>?page=smart-sidebars-slider&tab=styler&sss-task=new&job=0';" class="button-primary" type="button" value="<?php _e("New Style", "smart-sidebars-slider"); ?>" />
    </div>
</div>
<div class="sct-cleanup-right">
    <?php if (empty($all_jobs)) { ?>
        <h2 class="sct-cleanup-stats-title"><?php _e("There are no custom color styles created yet.", "smart-sidebars-slider") ?></h2>
    <?php } else { ?>
    <table class="widefat sct-table-grid" style="max-width: 1280px;">
        <thead>
            <tr>
                <th style="width: 30px"><?php _e("ID", "smart-sidebars-slider"); ?></th>
                <th style="width: 15%"><?php _e("Style Name", "smart-sidebars-slider"); ?></th>
                <th style="width: 20%"><?php _e("CSS Class", "smart-sidebars-slider"); ?></th>
                <th><?php _e("Colors Used", "smart-sidebars-slider"); ?></th>
                <th style="text-align: right;width: 10%"><?php _e("Options", "smart-sidebars-slider"); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php

            $core = array('_id', '_name', '_code', 'fonts');
            $tr_class = '';

            foreach ($all_jobs as $job) {
                $style = new sss_style_core($job);
                $colors = array();

                foreach ($job as $key => $val) {
                    if (!in_array($key, $core)) {
                        $parts = explode(' ', $val);

                        foreach ($parts as $p) {
                            if (substr($p, 0, 1) == '#' && !in_array($p, $colors)) {
                                $colors[] = $p;
                            }
                        }
                    }
                }

                echo '<tr class="'.$tr_class.'">';
                    echo '<td style="vertical-align: top;">'.$style->_id.'</td>';
                    echo '<td style="vertical-align: middle;"><h4><a title="'.__("Edit this color style.", "smart-sidebars-slider").'" class="srt-opt-edit" href="'.$url.'edit&job='.$style->_id.'">'.$style->_name.'</a></h4></td>';
                    echo '<td style="vertical-align: middle;"><a title="'.__("Get the CSS for this style for manual edit.", "smart-sidebars-slider").'" class="srt-opt-css" href="'.$url.'css&job='.$style->_id.'">std-style-'.$style->_code.'</a></td>';
                    echo '<td style="vertical-align: middle;">';
                        foreach ($colors as $color) {
                            echo '<span class="stw-color" style="background: '.$color.'; color:'.sss_styler_get_contrast_yiq($color).';">'.$color.'</span> ';
                        }

                        // echo '<br/>'.$style->to_array_string();
                    echo '</td>';
                    echo '<td class="srt-job-options" style="text-align: right; vertical-align: middle;">';
                        echo '<a title="'.__("Copy this style to create new one.", "smart-sidebars-slider").'" href="'.$url.'copy&job='.$style->_id.'">'.__("copy", "smart-sidebars-slider").'</a> | ';
                        echo '<a title="'.__("Delete this color style.", "smart-sidebars-slider").'" class="srt-opt-delete" onclick="return sss_admin.confirm()" href="'.$url.'delete&job='.$style->_id.'">'.__("delete", "smart-sidebars-slider").'</a>';
                    echo '</td>';
                echo '</tr>';

                $tr_class = $tr_class == '' ? 'alternate ' : $tr_class = '';
            }

        ?>
        </tbody>
    </table>
    <?php } ?>
</div>

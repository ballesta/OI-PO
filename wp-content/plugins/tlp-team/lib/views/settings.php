<?php
    global $TLPteam;
    $settings = get_option($TLPteam->options['settings']);
?>
<div class="wrap">

    <div id="upf-icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>
    <h2><?php _e('TLP Team Settings', TPL_TEAM_SLUG);?></h2>
    <form id="tlp-settings" onsubmit="tlpTeamSettings(this); return false;">

        <h3><?php _e('General settings',TPL_TEAM_SLUG);?></h3>

        <table class="form-table">

            <tr>
                <th scope="row"><label for="imgWidth"><?php _e('Image Size',TPL_TEAM_SLUG);?></label></th>
                <td><input name="genaral[img][width]" type="text" value="<?php echo ($settings['genaral']['img']['width'] ? @$settings['genaral']['img']['width'] : 250); ?>" size="4" class=""> * <input name="genaral[img][height]" type="text" value="<?php echo ($settings['genaral']['img']['height'] ? @$settings['genaral']['img']['height'] : 250); ?>" size="4" class=""> <?php _e('(Width * Height)',TPL_TEAM_SLUG); ?></td>
            </tr>

            <tr>
                <th scope="row"><label for="primary-color"><?php _e('Primary Color',TPL_TEAM_SLUG);?></label></th>
                <td class="">
                    <input name="general[primary][color]" type="text" value="<?php echo (@$settings['general']['primary']['color'] ? @$settings['general']['primary']['color'] : '#0367bf'); ?>" class="tlp-color">
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="link_detail_page"><?php _e('Link To Detail Page',TPL_TEAM_SLUG);?></label></th>
                <td class="">
                    <fieldset>
                        <legend class="screen-reader-text"><span>Link To Detail Page</span></legend>
                        <?php
                        $opt = array('yes'=>"Yes", 'no'=>"No");
                        $i = 0;
                        $pds = (@isset($settings['general']['link_detail_page']) ? @$settings['general']['link_detail_page'] : 'yes');
                        foreach ($opt as $key => $value) {
                            $select = (($pds == $key) ? 'checked="checked"' : null);
                            echo "<label title='$value'><input type='radio' $select name='general[link_detail_page]' value='$key' > $value</label>";
                            if($i == 0) echo "<br>";
                            $i++;
                        }
                        ?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="css"><?php _e('Custom Css ',TPL_TEAM_SLUG);?></label></th>
                <td>
                    <textarea name="genaral[css]" cols="40" rows="6"><?php echo (@$settings['genaral']['css'] ? @$settings['genaral']['css'] : null); ?></textarea>
                </td>
            </tr>

        </table>
        <p class="submit"><input type="submit" name="submit" id="tlpSaveButton" class="button button-primary" value="<?php _e('Save Changes', TPL_TEAM_SLUG); ?>"></p>

        <?php wp_nonce_field( $TLPteam->nonceText(), 'tlp_nonce' ); ?>
    </form>
        <div id="response" class="updated"></div>
    <span><?php _e('Short Code', TPL_TEAM_SLUG );?> : [tlpteam col='2' member="4" orderby="title" order="ASC" layout="1"]</span>
    <p><?php _e('col = The number of column you want to create (1,2,3,4)', TPL_TEAM_SLUG );?></p>
    <p><?php _e('member = The number of the member, you want to display', TPL_TEAM_SLUG );?></p>
    <p><?php _e('orderby = Orderby (title , date, menu_order)', TPL_TEAM_SLUG );?></p>
    <p><?php _e('ordr = ASC, DESC', TPL_TEAM_SLUG );?></p>
    <p><a href="http://demo.techlabpro.com/wp/tlpteam/" target="_blank"><?php _e('More Help', TPL_TEAM_SLUG );?></a></p>


</div>

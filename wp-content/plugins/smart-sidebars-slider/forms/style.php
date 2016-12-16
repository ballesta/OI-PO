<?php

$s = new sss_style_core($style);

$code = 'sss-styler';

function sss_draw_font_size($name, $id, $value, $unit, $label = '') {
    $stw_sizes = array(
        'px' => 'px',
        'pt' => 'pt',
        'pc' => 'pc',
        'em' => 'em',
        'ex' => 'ex',
        'in' => 'in',
        'mm' => 'mm',
        'cm' => 'cm',
        'csh' => 'ch',
        'rem' => 'rem',
        '%' => '%'
    );

    $label = $label == '' ? __("Font size.", "smart-sidebars-slider") : $label;

    echo '<input title="'.$label.'" name="'.$name.'['.$id.']" type="text" value="'.$value.'" class="stw-numeric-input stw-font-value" />';
    sss_render_select($stw_sizes, array('selected' => $unit, 'name' => $name.'['.($id + 1).']', 'class' => 'stw-font-unit'));
}

function sss_styler_draw_width_unit($name, $id, $value, $label = '') {
    $label = $label == '' ? __("Width, in pixels.", "smart-sidebars-slider") : $label;

    echo '<input title="'.$label.'" name="'.$name.'['.$id.']" type="text" value="'.$value.'" class="stw-numeric-input stw-width-value" />';
    echo '<input name="'.$name.'['.($id + 1).']" type="hidden" value="px" class="stw-width-unit" />';
}

$font_stacks = array(
    'defaults' => array('title' => __("Defaults", "smart-sidebars-slider"), 'values' => array(
        'none' => __("None", "smart-sidebars-slider"),
        'inherit' => __("Inherit", "smart-sidebars-slider")
    )),
    'sans-serif' => array('title' => __("Sans Serif", "smart-sidebars-slider"), 'values' => array(
        'arial' => 'Arial, "Helvetica Neue", Helvetica, sans-serif',
        'arial-black' => '"Arial Black", "Arial Bold", Gadget, sans-serif',
        'century-gothic' => '"Century Gothic", CenturyGothic, AppleGothic, sans-serif',
        'helvetica' => '"Helvetica Neue", Helvetica, Arial, sans-serif',
        'tahoma' => 'Tahoma, Verdana, Segoe, sans-serif',
        'trebuchet-ms' => '"Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif',
        'verdana' => 'Verdana, Geneva, sans-serif'
    )),
    'serif' => array('title' => __("Serif", "smart-sidebars-slider"), 'values' => array(
        'garmond' => 'Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif',
        'georgia' => 'Georgia, Times, "Times New Roman", serif',
        'palatino' => 'Palatino, "Palatino Linotype", "Palatino LT STD", "Book Antiqua", Georgia, serif',
        'times-new-roman' => 'TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif',
    )),
    'monospace' => array('title' => __("Monospace", "smart-sidebars-slider"), 'values' => array(
        'courier-new' => '"Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace',
        'lucida-sans-typewriter' => '"Lucida Sans Typewriter", "Lucida Console", Monaco, "Bitstream Vera Sans Mono", monospace;',
    )),
    'fantasy' => array('title' => __("Fantasy", "smart-sidebars-slider"), 'values' => array(
        'copperplate' => 'Copperplate, "Copperplate Gothic Light", fantasy',
        'papyrus' => 'Papyrus, fantasy'
    )),
    'cursive' => array('title' => __("Cursive", "smart-sidebars-slider"), 'values' => array(
        'brush-script-mt' => '"Brush Script MT", cursive'
    ))
);


$font_weight = array(
    'inherit' => 'inherit',
    '100' => '100',
    '200' => '200',
    '300' => '300',
    '400' => '400 - normal',
    '500' => '500',
    '600' => '600',
    '700' => '700 - bold',
    '800' => '800',
    '900' => '900',
    'bolder' => 'bolder',
    'lighter' => 'lighter'
);

$font_style = array(
    'inherit' => 'inherit',
    'normal' => 'normal',
    'italic' => 'italic',
    'oblique' => 'oblique'
);

$border_styles = array(
    'none' => 'none',
    'dotted' => 'dotted',
    'dashed' => 'dashed',
    'solid' => 'solid',
    'double' => 'double',
    'groove' => 'groove',
    'ridge' => 'ridge',
    'inset' => 'inset',
    'outset' => 'outset'
);

$blocks = array(
    array('label' => __("Main", "smart-sidebars-slider"), 'notice' => __("Settings here are applied to the whole sidebar slider.", "smart-sidebars-slider"), 'elements' => array('background', 'border')),
    array('label' => __("Drawer", "smart-sidebars-slider"), 'notice' => __("Settings applied to the drawer control.", "smart-sidebars-slider"), 'elements' => array('color', 'link_color', 'drawerRound')),
    array('label' => __("Tab", "smart-sidebars-slider"), 'notice' => __("Settings applied to the text displayed on the slider tab.", "smart-sidebars-slider"), 'elements' => array('tab_color', 'tab_font_size', 'tab_font_weight', 'tab_font_style', 'tab_font_family', 'tabRound')),
    array('label' => __("Scroller", "smart-sidebars-slider"), 'notice' => __("Settings applied nanoScroller control.", "smart-sidebars-slider"), 'elements' => array('nano_pane_background', 'nano_slider_background'))
);

$elements = array(
    'background' => array('label' => __("Background", "smart-sidebars-slider"), 'attribute' => 'background', 'type' => 'background', 'default' => '#fefefe 1', 'selector' => '#std-preview .std-drawer, #std-preview .std-tab', 'extra' => '', 'notice' => __("If you want to use background with opacity, you should set border to zero to get best effect.", "smart-sidebars-slider")),
    'color' => array('label' => __("Text Color", "smart-sidebars-slider"), 'attribute' => 'color', 'type' => 'color', 'default' => '#333333 1', 'selector' => '#std-preview .std-drawer', 'extra' => ''),
    'link_color' => array('label' => __("Link Color", "smart-sidebars-slider"), 'attribute' => 'color', 'type' => 'color', 'default' => '#990000 1', 'selector' => '#std-preview .std-drawer a', 'extra' => ''),
    'border' => array('label' => __("Border", "smart-sidebars-slider"), 'attribute' => 'border', 'type' => 'border', 'default' => '1 px solid #111111 1', 'selector' => '#std-preview .std-drawer, #std-preview .std-tab', 'extra' => ''),
    'drawerRound' => array('label' => __("Border Radius", "smart-sidebars-slider"), 'attribute' => 'border-radius', 'type' => 'borderradius', 'default' => 5, 'selector' => '#std-preview .std-drawer', 'extra' => ''),
    'tab_color' => array('label' => __("Color", "smart-sidebars-slider"), 'attribute' => 'color', 'type' => 'color', 'default' => '#990000 1', 'selector' => '#std-preview .std-tab', 'extra' => ''),
    'tab_font_family' => array('label' => __("Font Family", "smart-sidebars-slider"), 'attribute' => 'font-family', 'type' => 'fontfamily', 'default' => 'inherit', 'selector' => '#std-preview .std-tab span', 'extra' => ''),
    'tab_font_size' => array('label' => __("Font Size", "smart-sidebars-slider"), 'attribute' => 'font-size', 'type' => 'fontsize', 'default' => '1 em', 'selector' => '#std-preview .std-tab span', 'extra' => ''),
    'tab_font_weight' => array('label' => __("Font Weight", "smart-sidebars-slider"), 'attribute' => 'font-weight', 'type' => 'fontweight', 'default' => '700', 'selector' => '#std-preview .std-tab span', 'extra' => ''),
    'tab_font_style' => array('label' => __("Font Style", "smart-sidebars-slider"), 'attribute' => 'font-style', 'type' => 'fontstyle', 'default' => 'normal', 'selector' => '#std-preview .std-tab span', 'extra' => ''),
    'tabRound' => array('label' => __("Border Radius", "smart-sidebars-slider"), 'attribute' => 'border-radius', 'type' => 'borderradius', 'default' => 4, 'selector' => '#std-preview .std-tab', 'extra' => ''),
    'nano_pane_background' => array('label' => __("Background", "smart-sidebars-slider"), 'attribute' => 'background', 'type' => 'background', 'default' => '#555555 .3', 'selector' => '#std-preview .nano .nano-pane', 'extra' => ''),
    'nano_slider_background' => array('label' => __("Scrollbar", "smart-sidebars-slider"), 'attribute' => 'background', 'type' => 'background', 'default' => '#111111 .9', 'selector' => '#std-preview .nano .nano-slider', 'extra' => '')
);

?>
<form method="post" action="">
    <?php settings_fields('smart-sidebars-slider-styler-builder'); ?>
    <input type="hidden" name="sss-styler[_id]" value="<?php echo $s->_id; ?>" />

    <div class="sct-cleanup-left">
        <input class="button-primary" type="submit" value="<?php _e("Save Style", "smart-sidebars-slider"); ?>" />
        <p class="sct-top">
            <?php _e("Preview all your style settings on example bellow. Preview does not behave as real slider, or look exactly as it should.", "smart-sidebars-slider"); ?><br/>
        </p>

        <div id="std-preview" class="smart-tab-drawer">
            <div class="std-drawer nano" style="width: 200px; z-index: 100004; margin-left: 0; height: 280px;">
                <div class="std-drawer-inner nano-content">
                    This is normal text. And this <a href="#">here is link</a>.<br/><br/>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras adipiscing ut orci id aliquam. Nullam non commodo nulla. Integer cursus pellentesque ultrices. In pretium lacinia nisl non posuere. Nunc tempus, nisl quis porta volutpat, arcu mi tincidunt lorem, sed placerat odio risus et mauris. Sed vel nisi a libero faucibus pharetra. In hendrerit tempor nunc, nec lacinia purus malesuada in. Nullam sollicitudin ornare luctus. Fusce id felis id sapien congue vulputate. Aenean non rutrum dui.
                </div>
            </div>
            <div class="std-tab" style="height: 40px; line-height: 40px; width: 128px; z-index: 100005; margin-top: 80px; margin-left: 154px;">
                <span>Preview</span>
            </div>
        </div>
    </div>
    <div class="sct-cleanup-right sct-normal">
        <h3 style="margin-top: 0;"><?php _e("Basic Information", "smart-sidebars-slider"); ?></h3>
        <table class="form-table" style="max-width: 850px; margin-top: 15px;">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e("Name", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Name", "smart-sidebars-slider"); ?></span></legend>
                            <input type="text" class="widefat" name="sss-styler[_name]" value="<?php echo $s->_name; ?>" />
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Code", "smart-sidebars-slider"); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e("Code", "smart-sidebars-slider"); ?></span></legend>
                            <input type="text" class="widefat stw-slug-input" name="sss-styler[_code]" value="<?php echo $s->_code; ?>" />

                            <br/><em>
                                <?php _e("This must be unique value to be used for style name, with only<br/>lowercase alphanumeric characters and dashes!", "smart-sidebars-slider"); ?><br/>
                                <?php _e("It will be prefixed with:", "smart-sidebars-slider"); ?> <strong>std-style-</strong>
                            </em>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="stw-style-builder">
            <ul class="stw-header">
                <?php

                $i = 1;
                foreach ($blocks as $blk) {
                    echo '<li class="stw-tab"><a class="stw-title" href="#tab-'.$i.'">'.$blk['label'].'</a></li>';
                    $i++;
                }

                ?>
            </ul>
            <div class="stw-container">
                <?php

                $i = 1;
                foreach ($blocks as $blk) {
                    echo '<div id="tab-'.$i.'">'; ?>
                
                    <table class="form-table" style="margin-top: -5px;">
                        <thead>
                            <tr valign="top">
                                <th class="stw-block-header" colspan="2"><?php echo $blk['notice']; ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                        foreach ($blk['elements'] as $el) {
                            if (isset($elements[$el])) {
                                $element = $elements[$el];
                                $value = explode(' ', $s->$el);

                        ?>

                            <tr valign="top">
                                <th scope="row"><?php echo $element['label']; ?>:</th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php echo $element['label']; ?></span></legend>

                                    <?php

                                        echo '<div data-attribute="'.$element['attribute'].'" data-extra="'.$element['extra'].'" data-selector="'.$element['selector'].'" class="stw-block-element stw-block-'.$element['type'].'">';

                                        switch ($element['type']) {
                                            case 'color':
                                            case 'background':
                                                echo '<input title="'.__("Color, HEX value.", "smart-sidebars-slider").'" name="'.$code.'['.$el.'][0]" class="stw-color-hex" type="text" value="'.$value[0].'" data-opacity="'.$value[1].'" />';
                                                echo '<input title="'.__("Color opacity", "smart-sidebars-slider").'" name="'.$code.'['.$el.'][1]" class="stw-color-opacity" type="text" value="'.$value[1].'" />';
                                                break;
                                            case 'cssclass':
                                                echo '<input name="'.$code.'['.$el.'][0]" type="text" value="'.$value[0].'" class="stw-cssclass-value" />';
                                                break;
                                            case 'borderradius':
                                                echo '<input title="'.__("Radius, in pixels.", "smart-sidebars-slider").'" name="'.$code.'['.$el.'][0]" type="text" value="'.$value[0].'" class="stw-numeric-input stw-font-value" />';
                                                break;
                                            case 'border':
                                                sss_styler_draw_width_unit($code.'['.$el.']', 0, $value[0], '');
                                                sss_render_select($border_styles, array('selected' => $value[2], 'name' => $code.'['.$el.'][2]', 'class' => 'stw-width-border'));

                                                echo '<input title="'.__("Color, HEX value.", "smart-sidebars-slider").'" name="'.$code.'['.$el.'][3]" class="stw-color-hex" type="text" value="'.$value[3].'" data-opacity="'.$value[4].'" />';
                                                echo '<input title="'.__("Color opacity", "smart-sidebars-slider").'" name="'.$code.'['.$el.'][4]" class="stw-color-opacity" type="text" value="'.$value[4].'" />';
                                                break;
                                            case 'fontfamily':
                                                sss_render_select_grouped($font_stacks, array('selected' => $value[0], 'name' => $code.'['.$el.'][0]', 'class' => 'stw-width-border', 'style' => 'width: 400px !important'));
                                                break;
                                            case 'fontsize':
                                                sss_draw_font_size($code.'['.$el.']', 0, $value[0], $value[1]);
                                                break;
                                            case 'fontweight':
                                                sss_render_select($font_weight, array('selected' => $value[0], 'name' => $code.'['.$el.']', 'class' => 'stw-width-border'));
                                                break;
                                            case 'fontstyle':
                                                sss_render_select($font_style, array('selected' => $value[0], 'name' => $code.'['.$el.']', 'class' => 'stw-width-border'));
                                                break;
                                        }

                                        if (isset($element['notice'])) {
                                            echo '<em>'.$element['notice'].'</em>';
                                        }
                                        
                                        echo '</div>';

                                    ?>
                                    </fieldset>
                                </td>
                            </tr>

                        <?php } } ?>
                        </tbody>
                    </table>

                    <?php echo '</div>';
                    $i++;
                }

                ?>
            </div>
        </div>                            
    </div>
</form>
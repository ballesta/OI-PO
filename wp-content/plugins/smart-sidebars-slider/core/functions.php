<?php

if (!defined('ABSPATH')) exit;

function sss_str_left($s1, $s2) {
    $values = substr($s1, 0, strpos($s1, $s2));
    return $values;
}

function sss_current_url() {
    $s = empty($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';
    $protocol = sss_str_left(strtolower($_SERVER['SERVER_PROTOCOL']), '/').$s;
    $port = ($_SERVER['SERVER_PORT'] == '80') ? '' : (':'.$_SERVER['SERVER_PORT']);
    return $protocol.'://'.$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}

function sss_html_id_from_name($name, $id = '') {
    if ($id == '') {
        $id = str_replace(']', '', $name);
        $id = str_replace('[', '_', $id);
    } else if ($id == '_') {
        $id = '';
    }

    return $id;
}

function sss_render_select_grouped($values, $args = array()) {
    $defaults = array(
        'selected' => '', 'name' => '', 'id' => '', 'class' => 'widefat', 
        'style' => '', 'multi' => false, 'echo' => true);
    $args = wp_parse_args($args, $defaults);
    extract($args);

    $render = '';
    $selected = (array)$selected;
    $id = sss_html_id_from_name($name, $id);

    if ($class != '') {
        $class = ' class="'.$class.'"';
    }

    if ($style != '') {
        $style = ' style="'.$style.'"';
    }

    $multi = $multi ? ' multiple' : '';
    $name = $multi ? $name."[]" : $name;

    $render.= '<select name="'.$name.'" id="'.$id.'"'.$class.$style.$multi.'>';
    foreach ($values as $group) {
        $render.= '<optgroup label="'.$group['title'].'">';
        foreach ($group['values'] as $value => $display) {
            $sel = in_array($value, $selected) ? ' selected="selected"' : '';
            $render.= '<option value="'.esc_attr($value).'"'.$sel.'>'.$display.'</option>';
        }
        $render.= '</optgroup>';
    }
    $render.= '</select>';

    if ($echo) {
        echo $render;
    } else {
        return $render;
    }
}

function sss_render_select($values, $args = array()) {
    $defaults = array(
        'selected' => '', 'name' => '', 'id' => '', 'class' => 'widefat', 
        'style' => '', 'multi' => false, 'echo' => true);
    $args = wp_parse_args($args, $defaults);
    extract($args);

    $render = '';
    $selected = (array)$selected;
    $id = sss_html_id_from_name($name, $id);

    if ($class != '') {
        $class = ' class="'.$class.'"';
    }

    if ($style != '') {
        $style = ' style="'.$style.'"';
    }

    $multi = $multi ? ' multiple' : '';
    $name = $multi ? $name.'[]' : $name;

    $render.= '<select name="'.$name.'" id="'.$id.'"'.$class.$style.$multi.'>';
    foreach ($values as $value => $display) {
        $sel = in_array($value, $selected) ? ' selected="selected"' : '';
        $render.= '<option value="'.$value.'"'.$sel.'>'.$display.'</option>';
    }
    $render.= '</select>';

    if ($echo) {
        echo $render;
    } else {
        return $render;
    }
}

/*
 * http://24ways.org/2010/calculating-color-contrast/
 */
function sss_styler_get_contrast_yiq($hexcolor){
    $r = hexdec(substr($hexcolor, 0, 2));
    $g = hexdec(substr($hexcolor, 2, 2));
    $b = hexdec(substr($hexcolor, 4, 2));

    $yiq = (($r * 333) + ($g * 333) + ($b * 334)) / 1000;

    return ($yiq >= 124) ? 'black' : 'white';
}
?>
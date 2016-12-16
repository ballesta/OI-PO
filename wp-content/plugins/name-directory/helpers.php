<?php
/**
 * This file is part of the NameDirectory plugin for WordPress
 */



/**
 * Return the first character of a word,
 * or hashtag, may the word begin with a number
 * @param $name
 * @return string
 */
function name_directory_get_first_char($name)
{
    $first_char = strtoupper(substr($name, 0, 1));
    if(is_numeric($first_char))
    {
        $first_char = '#';
    }

    return $first_char;
}


/**
 * Prepare an associative array to be used for the csv importer
 * @param array $row (csv-row)
 * @param int $published (optional)
 * @return array|bool
 */
function name_directory_prepared_import_row($row, $published=1)
{
    // Don't continue when there is no name to add (first column in csv-row)
    if(empty($row[0]))
    {
        return false;
    }

    $row_props = array('name', 'description', 'submitted_by');
    $prepared_row = array('published' => $published);
    foreach($row_props as $index=>$prop)
    {
        if(! empty($row[$index]))
        {
            $prepared_row[$prop] = $row[$index];
        }
    }

    return $prepared_row;
}


/**
 * Return localized yes or no based on a variable
 * @param $var
 * @return string|void
 */
function name_directory_yesno($var)
{
    if(! empty($var))
    {
        return __('Yes', 'name-directory');
    }

    return __('No', 'name-directory');
}


/**
 * Switches the published state of a name and returns the human readable value
 * @param (numeric) $name_id
 * @return string|void
 */
function name_directory_switch_name_published_status($name_id)
{
    global $wpdb;
    global $table_directory_name;

    $wpdb->query($wpdb->prepare("UPDATE `$table_directory_name` SET `published`=1 XOR `published` WHERE id=%d",
        intval($name_id)));
    sleep(0.1);

    return name_directory_yesno($wpdb->get_var(sprintf("SELECT `published` FROM `%s` WHERE id=%d",
        $table_directory_name, intval($name_id))));
}


/**
 * Check if a given name already exists in a Name Directory
 * @param $name
 * @param $directory
 * @return bool
 */
function name_directory_name_exists_in_directory($name, $directory)
{
    global $wpdb;
    global $table_directory_name;

    $wpdb->get_results(sprintf("SELECT 1 FROM `%s` WHERE `name` = '%s' AND `directory` = %d",
        $table_directory_name, esc_sql($name), intval($directory)));

    return (bool)$wpdb->num_rows;
}


/**
 * Construct a plugin URL
 * @param string $index
 * @param null $exclude
 * @return string
 */
function name_directory_make_plugin_url($index = 'name_directory_startswith', $exclude = null)
{
    $parsed = parse_url($_SERVER['REQUEST_URI']);
    parse_str($parsed['query'], $url);

    if(! empty($exclude))
    {
        unset($url[$exclude]);
    }

    unset($url[$index]);
    unset($url['page_id']);
    $paste_char = '?';
    if(strpos(get_permalink(), '?') !== false)
    {
        $paste_char = '&';
    }
    $url[$index] = '';

    return get_permalink() . $paste_char . http_build_query($url);
}


/**
 * Get the names of given directory, maybe only with the char?
 * @param $directory
 * @param array $name_filter
 * @return mixed
 */
function name_directory_get_directory_names($directory, $name_filter = array())
{
    global $wpdb;
    global $table_directory_name;
    $sql_filter = "";
    $limit = "";
    $order_by = "ORDER BY `letter`, `name` ASC";

    if(! empty($name_filter['character']))
    {
        $sql_filter .= " AND `letter`='" . $name_filter['character'] . "' ";
    }

    if(! empty($directory['show_description']) && ! empty($name_filter['containing']))
    {
        $sql_filter .= " AND (`name` LIKE '%" . $name_filter['containing'] . "%' OR `description` LIKE '%" . $name_filter['containing'] . "%') ";
    }
    elseif(! empty($name_filter['containing']))
    {
        $sql_filter .= " AND `name` LIKE '%" . $name_filter['containing'] . "%' ";
    }

    if(! empty($name_filter['character']) && $name_filter['character'] == 'latest')
    {
        $sql_filter = "";
        $order_by = "ORDER BY `id` DESC";
        $limit = " LIMIT " . $directory['nr_most_recent'];
    }


    $names = $wpdb->get_results(sprintf("
		SELECT *
		FROM %s
		WHERE `directory` = %d AND `published` = 1
		%s
		%s %s",
        esc_sql($table_directory_name),
        esc_sql($directory['id']),
        $sql_filter,
        $order_by,
        $limit),
        ARRAY_A
    );

    return $names;
}


/**
 * Get the directory with the supplied ID
 * @param $id
 * @return mixed
 */
function name_directory_get_directory_properties($id)
{
    global $wpdb;
    global $table_directory;

    $directory = $wpdb->get_row(sprintf("SELECT * FROM %s WHERE `id` = %d",
        esc_sql($table_directory),
        esc_sql($id)), ARRAY_A);

    return $directory;
}


/**
 * Get names in a specified directory (specified by ID)
 * @param $id
 * @return mixed
 */
function name_directory_get_directory_start_characters($id)
{
    global $wpdb;
    global $table_directory_name;

    $characters = $wpdb->get_col(sprintf("SELECT DISTINCT `letter` FROM %s WHERE `directory` = %d",
        esc_sql($table_directory_name),
        esc_sql($id)));

    return array_values($characters);
}


/**
 * Send an email to the WordPress admin e-mailaddress
 * Notify the admin that a new name has been submitted to the directory and
 * that this name has to be reviewed first before publishing
 */
function name_directory_notify_admin_of_new_submission($directory, $input)
{
    $admin_email = get_option('admin_email');
    wp_mail($admin_email,
        __('New submission for Name Directory', 'name-directory'),
        __('Howdy,', 'name-directory') . "\n\n" .
        sprintf(__('There was a new submission to the Name Directory on %s at %s', 'name-directory'), get_option('blogname'), get_option('home')) . "\n\n" .
        sprintf("%s: %s", __('Name', 'name-directory'), $input['name_directory_name']) . "\n" .
        sprintf("%s: %s", __('Description', 'name-directory'), $input['name_directory_description']) . "\n" .
        sprintf("%s: %s", __('Submitted by', 'name-directory'), $input['name_directory_submitter']) . "\n\n" .
        __('This new submission does not have the published status.', 'name-directory') . ' ' .
        __('Please login to your WordPress admin to review and accept the submission.', 'name-directory') . "\n\n" .
        sprintf("Link: %s/wp-admin/options-general.php?page=name-directory&sub=manage-directory&dir=%d&status=unpublished", get_option('home'), $directory) . "\n\n" .
        sprintf("Your %s WordPress site", get_option('blogname')));
}
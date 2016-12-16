<?php
/**
 * @package TLP_Team
 * @version 1.2
 */

/**
* Plugin Name: TLP Team
* Plugin URI: http://demo.techlabpro.com/wp/tlpteam/
* Description: TLP Team is a fully responsive and mobile friendly team member profile display plugin.
* Author: Techlabpro.com
* Version: 1.2
* Author URI: www.techlabpro.com
* Text Domain: tlp-team
* License: MIT License
* License URI: http://opensource.org/licenses/MIT
*/

define( 'TPL_TEAM_VERSION', '1.2' );
define( 'TPL_TEAM_TITLE', 'TPL TEAM');
define( 'TPL_TEAM_SLUG', 'tlp-team');
define( 'TPL_TEAM_PLUGIN_PATH', dirname( __FILE__ ));
define( 'TPL_TEAM_PLUGIN_URL', plugins_url( '' , __FILE__ ));
define( 'TPL_TEAM_LANGUAGE_PATH', dirname( plugin_basename( __FILE__ ) ) . '/languages');

require('lib/init.php');
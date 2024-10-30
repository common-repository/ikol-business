<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @wordpress-plugin
 * Plugin Name:       IKOL Business
 * Plugin URI:        https://ikol.com
 * Description:       WordPress plugin that allows embedding IKOL Business functionality into WordPress pages.
 * Version:           1.0.2
 * Author:            IKOL
 * Author URI:        https://ikol.com/company
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ikolbwp
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'IKOLBWP_PLUGIN_VERSION', '1.0.2' );
define( 'IKOLBWP_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );
define( 'IKOLBWP_PLUGIN_ROOT_FOLDER_NAME', basename( plugin_dir_path( __FILE__ ), '/' ) );
define( 'IKOLBWP_PLUGIN_CHAT_SCRIPT_URL', 'https://cdn.ikol.com/embed/chat/load.js' );
define( 'IKOLBWP_PLUGIN_CONTACT_SCRIPT_URL', 'https://cdn.ikol.com/embed/contact/load.js' );
define( 'IKOLBWP_PLUGIN_SERVICES_SCRIPT_URL', 'https://cdn.ikol.com/embed/services/load.js' );


function ikolbwp_activate_plugin() {
	require_once IKOLBWP_PLUGIN_ROOT . 'includes/classes/class-ikolbwp-activator.php';
	Ikolbwp_Activator::activate();
}

function ikolbwp_deactivate_plugin() {
	require_once IKOLBWP_PLUGIN_ROOT . 'includes/classes/class-ikolbwp-deactivator.php';
	Ikolbwp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'ikolbwp_activate_plugin' );
register_deactivation_hook( __FILE__, 'ikolbwp_deactivate_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

function ikolbwp_run_plugin() {
	require_once IKOLBWP_PLUGIN_ROOT . 'includes/classes/class-ikolbwp.php';

	$plugin = new Ikolbwp();
	$plugin->run();
}

ikolbwp_run_plugin();

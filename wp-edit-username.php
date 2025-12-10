<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package           WP_Edit_Username
 * @author            Sajjad Hossain Sagor <sagorh672@gmail.com>
 *
 * Plugin Name:       WP Edit Username
 * Plugin URI:        https://wordpress.org/plugins/wp-edit-username/
 * Description:       Change WordPress User's Username From Edit User Admin Panel.
 * Version:           2.0.5
 * Requires at least: 5.6
 * Requires PHP:      8.0
 * Author:            Sajjad Hossain Sagor
 * Author URI:        https://sajjadhsagor.com/
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-edit-username
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'WP_EDIT_USERNAME_VERSION', '2.0.5' );

/**
 * Define Plugin Folders Path
 */
define( 'WP_EDIT_USERNAME_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'WP_EDIT_USERNAME_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

define( 'WP_EDIT_USERNAME_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-edit-username-activator.php
 *
 * @since    2.0.0
 */
function on_activate_wp_edit_username() {
	require_once WP_EDIT_USERNAME_PLUGIN_PATH . 'includes/class-wp-edit-username-activator.php';

	WP_Edit_Username_Activator::on_activate();
}

register_activation_hook( __FILE__, 'on_activate_wp_edit_username' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-edit-username-deactivator.php
 *
 * @since    2.0.0
 */
function on_deactivate_wp_edit_username() {
	require_once WP_EDIT_USERNAME_PLUGIN_PATH . 'includes/class-wp-edit-username-deactivator.php';

	WP_Edit_Username_Deactivator::on_deactivate();
}

register_deactivation_hook( __FILE__, 'on_deactivate_wp_edit_username' );

/**
 * The core plugin class that is used to define admin-specific and public-facing hooks.
 *
 * @since    2.0.0
 */
require WP_EDIT_USERNAME_PLUGIN_PATH . 'includes/class-wp-edit-username.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_wp_edit_username() {
	$plugin = new WP_Edit_Username();

	$plugin->run();
}

run_wp_edit_username();

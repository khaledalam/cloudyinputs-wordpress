<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://KhaledAlam.net
 * @since             1.0.0
 * @package           Cloudyinputs
 *
 * @wordpress-plugin
 * Plugin Name:       CloudyInputs
 * Plugin URI:        https://speaktextonline.com/cloudyinputs
 * Description:       Auto words and sentences prediction using AI and Drafting users' inputs instantly on cloud
 * Version:           1.0.0
 * Author:            Khaled Alam
 * Author URI:        https://KhaledAlam.net/
 * License:           GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cloudyinputs
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CLOUDYINPUTS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cloudyinputs-activator.php
 */
function activate_cloudyinputs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cloudyinputs-activator.php';
	Cloudyinputs_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cloudyinputs-deactivator.php
 */
function deactivate_cloudyinputs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cloudyinputs-deactivator.php';
	Cloudyinputs_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cloudyinputs' );
register_deactivation_hook( __FILE__, 'deactivate_cloudyinputs' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cloudyinputs.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cloudyinputs() {

	$plugin = new Cloudyinputs();
	$plugin->run();

}
run_cloudyinputs();

<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://factor1studios.com/
 * @since             1.0.0
 * @package           Factor1_Directory
 *
 * @wordpress-plugin
 * Plugin Name:       Docent Directory Plugin
 * Plugin URI:        http://factor1studios.com/
 * Description:       Display Docent Directory within WordPress.
 * Version:           1.0.0
 * Author:            Factor1 Studios
 * Author URI:        http://factor1studios.com/
 * License:           Proprietary
 * License URI:       http://factor1studios.com/
 * Text Domain:       factor1-directory
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Load Composer libraries and packages.
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_docent_directory() {
	$plugin = new \Factor1\Directory();
}

run_docent_directory();
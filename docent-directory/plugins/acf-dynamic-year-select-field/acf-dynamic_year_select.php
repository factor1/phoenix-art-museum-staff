<?php

/*
Plugin Name: ACF: Dynamic Year Select Field
Plugin URI:  http://ambrdetroit.com
Description: This plugin adds a dynamic year select for Advanced Custom Fields.
Version:     0.1.0
Author:      AMBR Detroit
Author URI:  http://ambrdetroit.com
License:     GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: acf-dynamic_year_select
*/
load_plugin_textdomain( 'acf-dynamic_year_select', false, dirname( plugin_basename(__FILE__) ) . '/lang/' ); 

// For Advanced Custom Fields 5.x
add_action('acf/include_field_types', 'include_field_types_dynamic_year_select');
function include_field_types_dynamic_year_select( $version ) {
	include_once('acf-dynamic_year_select-v5.php');
}

// For Advanced Custom Fields 4.x
add_action('acf/register_fields', 'register_fields_dynamic_year_select');
function register_fields_dynamic_year_select() {
	include_once('acf-dynamic_year_select-v4.php');
}

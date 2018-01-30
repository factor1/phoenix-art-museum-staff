<?php

/**
 * Define configuration options, such as DB connection strings
 * to be used by the Docent Directory plugin. Preface with 'Factor1_'.
 *
 * @since    1.0.0
 */

if(!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

define('Factor1_DEBUG', false);

define('Factor1_PLUGIN_PATH', plugin_dir_path(dirname(__FILE__)) . 'plugins');

define('Factor1_ACF_PATH', plugin_dir_path(dirname(__FILE__)) . 'plugins' . DS . 'advanced-custom-fields');
define('Factor1_ACF_URI', plugin_dir_url(dirname(__FILE__)) . 'plugins' . DS . 'advanced-custom-fields' . DS);

define('Factor1_CACHE_ENABLED', false);
define('Factor1_CACHE_LIFETIME', 3600);
define('Factor1_CACHE_PATH', plugin_dir_path(dirname(__FILE__)) . 'cache');

define('Factor1_ASSET_PATH', plugin_dir_path(dirname(__FILE__)) . 'assets');
define('Factor1_ASSET_URL', plugin_dir_url(dirname(__FILE__)) . 'assets');

define('Factor1_TEMPLATE_PATH', plugin_dir_path(dirname(__FILE__)) . 'templates');
define('Factor1_THEME_TEMPLATE_DIR', 'docent-directory');

define('Factor1_SHORTCODE_PATH', plugin_dir_path(dirname(__FILE__)) . 'src' . DS . 'shortcodes');
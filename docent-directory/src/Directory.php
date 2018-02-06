<?php

namespace Factor1;

use FileCache;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Factor1_Directory
 * @subpackage Factor1_Directory/includes
 * @author     Factor1 Studios, Carlos Noguera <carlos.noguera@email.com>
 */

class Directory {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	protected $shortcodes = array();
	protected $cache;
	public static $query_vars = array(
		'docent-letter',
		'docent-name',
		'docent-year',
		'docent-designation',
		'docent-tour',
		'docent-display',
	);
	public static $rewrite_endpoints = array(
		'docent-letter',
	);

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		require_once __DIR__ . '/config.php';

		$this->plugin_name = 'docent-directory';
		$this->version = '1.0.0';

		$this->_configure_query_vars();
		$this->_configure_acf();
		$this->_configure_cache();
		$this->_register_shortcodes();
		$this->_configure_rewrite_endpoints();

		add_action('wp_enqueue_scripts', array($this, '_enqueue_assets'));
		// add_action('admin_menu', array($this, '_register_admin'));
	}

	public function _register_admin() {
		$main_pages = array(
			'main' => array(
				"Docent Directory",
				"Docent Directory",
				'manage_options',
				'factor1/docent-directory.php',
				array($this, '_render_admin'),
				'dashicons-id-alt',
				30
			)
		);

		$sub_pages = array();

		foreach($main_pages as $pages) {
			add_menu_page(
				$menu_page[0],
				$menu_page[1],
				$menu_page[2],
				$menu_page[3],
				$menu_page[4],
				$menu_page[5],
				$menu_page[6]
			);
		}
	}

	public function _render_admin() {
		return null;
	}

	protected function _register_shortcodes() {
		$schortcode_list = preg_grep('/^([^.])/', scandir(Factor1_SHORTCODE_PATH));

		foreach($schortcode_list as $shortcode_file) {
			$shortcode_class = pathinfo($shortcode_file, PATHINFO_FILENAME);
			$shortcode_namespaced_class = '\\Factor1\\shortcodes\\' . $shortcode_class;
			$this->shortcodes[$shortcode_class] = new $shortcode_namespaced_class($this->cache);
		}
	}

	public function _enqueue_assets()
	{
		// CSS
		wp_enqueue_style('docent-directory', Factor1_ASSET_URL . '/css/docent-directory.css', array(), '1.0');
		wp_enqueue_style('docent-directory-staff', Factor1_ASSET_URL . '/css/staff.css', array(), '1.0');

		// JS
		wp_enqueue_script('docent-directory', Factor1_ASSET_URL . '/js/docent-directory.js', array('jquery'), '1.0');
		wp_enqueue_script('docent-directory-staff', Factor1_ASSET_URL . '/js/staff.js', array(), '1.0');
	}

	protected function _configure_cache() {

		// Reference: https://github.com/inouet/file-cache
		$options = array();

		if(defined(Factor1_CACHE_PATH)) {
			$options['cache_dir'] = Factor1_CACHE_PATH;
		}

		if(Factor1_CACHE_ENABLED) {
			if(!empty($options['cache_dir']) && !is_writable(Factor1_CACHE_PATH)) {
				chmod(Factor1_CACHE_PATH, 0770);
			}

			$this->cache = new \FileCache($options);
		}

	}

	protected function _configure_acf($hide_group_menu = true) {
		// References:
		// https://www.advancedcustomfields.com/resources/including-acf-in-a-plugin-theme/

		if(!class_exists('acf'))
		{
			// 1. customize ACF path
			add_filter('acf/settings/path', function() {
				return Factor1_ACF_PATH;
			});

			// 2. customize ACF dir
			add_filter('acf/settings/dir', function() {
				return Factor1_ACF_URI;
			});

			// 3. Hide ACF field group menu item
			add_filter('acf/settings/show_admin', function() {
				return true; //!$hide_group_menu;
			});

			// 4. Include ACF
			include_once(Factor1_ACF_PATH . '/acf.php');
		}
		else
		{
			// Check for ACF version

		}

		// 5. Include local field groups
		include_once(Factor1_PLUGIN_PATH . '/acf-local-field-groups.php');

		// 6. Include additional ACF plugins
		include_once(Factor1_PLUGIN_PATH . '/acf-dynamic-year-select-field/acf-dynamic_year_select.php');
		include_once(Factor1_PLUGIN_PATH . '/acf-phone-number/acf-phone-number.php');
		include_once(Factor1_PLUGIN_PATH . '/acf-field-address/acf-address.php');
	}

	protected function _configure_query_vars()
	{
		add_filter('query_vars', function($vars) {
			return array_merge($vars, self::$query_vars);
		});
	}

	protected function _configure_rewrite_endpoints()
	{
		add_action('init', function() {
			foreach(self::$rewrite_endpoints as $rewrite_endpoint)
			{
				add_rewrite_endpoint($rewrite_endpoint, EP_PERMALINK | EP_PAGES);
			}
		});
	}
}
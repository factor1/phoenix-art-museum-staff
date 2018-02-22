<?php

namespace Factor1;

use \League\Plates\Engine;
use \Factor1\Directory;

class Shortcode {

	protected $tag;
	protected $defaults;
	protected $attribute_hash;
	protected $cache_enabled;
	protected $cache;
	protected $cache_id;
	protected $data;

	public $query_array = array();

	public function __construct($cache = null) {
		if(!empty($cache)) {
			$this->cache = $cache;
			$this->cache_enabled = true;
		}

		$current_uri_array = parse_url($_SERVER['REQUEST_URI']);
		if(!empty($current_uri_array['query'])) {
			parse_str($current_uri_array['query'], $this->query_array);
		}

		add_shortcode($this->tag, array($this, '_shortcode_merge'));

		// Pre-page-render action
		add_filter('wp', function() {
			$this->_pre_render();
		});
	}

	public function shortcode($attributes = array(), $query_vars = array()) {
		return array_merge($attributes, $query_vars);
	}

	public function render($template, $values = array(), $cache = true) {
		// Use cached template if available and not stale
		if($cache && $this->cache_enabled && $this->cache->get($this->cache_id)) {
			(Factor1_DEBUG) ? error_log(print_r('CACHE HIT', true)) : null;

			return $this->cache->get($this->cache_id);
		}

		$template_dir = Factor1_TEMPLATE_PATH;
		if(file_exists(get_stylesheet_directory() . DS . Factor1_THEME_TEMPLATE_DIR . DS . $template . '.php')) {
			$template_dir = get_stylesheet_directory() . DS . Factor1_THEME_TEMPLATE_DIR;
		}
		$templates = new Engine($template_dir);
		$results = $templates->render($template, $values);

		if($cache && $this->cache_enabled) {
			(Factor1_DEBUG) ? error_log(print_r('CACHE SAVE', true)) : null;

			$this->cache->save(
				$this->cache_id,
				$results,
				Factor1_CACHE_LIFETIME
			);
		}

		return $results;
	}

	public function _shortcode_merge($attributes) {
		if(empty($attributes)) {
			$attributes = array();
		}

		$merged_attributes = array_merge($this->defaults, $attributes);
		foreach(\Factor1\Directory::$query_vars as $query_var)
		{
			$query_vars[$query_var] = get_query_var($query_var, null);
		}

		if($this->cache_enabled) {
			$this->attribute_hash = md5(json_encode($merged_attributes));
			$this->cache_id = $this->tag . '_' . $this->attribute_hash;
		}

		return $this->shortcode($merged_attributes, $query_vars);
	}

	public function _query_merge(array $vars = array()) {
		if(!empty($vars)) {
			return '?' . http_build_query(array_merge($this->query_array, $vars));
		}

		return null;
	}

	public function _pre_render() {}

}
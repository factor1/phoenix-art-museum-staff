<?php

namespace Factor1\Shortcodes;

use \Factor1\Directory;

class DirectoryList extends \Factor1\Shortcode {

	protected $tag = 'docent-directory';
	protected $defaults = array(
		'show_alphabet_index' => true,
		'separate_alphabet_pages' => true,
		'show_letter_headers' => true,
		'limit' => -1,
	);

	public function shortcode($attributes = array(), $query_vars = array()) {
		$template = 'directory/list';
		$data = array(
			'show_alphabet_index' => $attributes['show_alphabet_index'],
			'separate_alphabet_pages' => $attributes['separate_alphabet_pages'],
			'show_letter_headers' => $attributes['show_letter_headers'],
			'show_photo_card' => true, //!empty($query_vars['docent-photo']),
			'is_admin' => is_admin(),
			'docents' => [],
		);

		// TO DO: Move this into Docent Model / WPModel
		$args = [
	    	'role__in' => ['docent'],
		    'order' => 'ASC',
		    'orderby' => 'meta_value',
		    'meta_key' => 'last_name',
		    'number' => $attributes['limit'],
		];

		// Add search terms
		if(!empty($_REQUEST['search']))
		{
			$args['search'] = '*' . esc_attr($_REQUEST['search']) . '*';
		}

		if(array_key_exists('docent-letter', $query_vars))
		{
			$args['meta_query'] = array(
				'relation' => 'OR',
				array(
					'key' => 'last_name',
					'value' => '^' . $query_vars['docent-letter'] . '.*',
					'compare' => 'REGEXP',
				)
			);
		}

		$docent_query = new \WP_User_Query($args);
		if(!empty($docent_query->results))
		{
			if($attributes['show_letter_headers'])
			{
				foreach($docent_query->results as $docent)
				{
					$data['docents'][substr($docent->last_name, 0 , 1)][] = $docent;
				}
			}
			else
			{
				$data['docents'] = $docent_query->results;
			}

		}

		return $this->render($template, $data);
	}

}
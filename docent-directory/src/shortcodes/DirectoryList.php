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
	protected $designations = array(
		'Docent' => 'D',
		'Senior Docent' => 'SD' ,
		'Master Docent' => 'M' ,
		'Master Emeritus' => 'ME',
		'Apprentice' => 'A',
		'Sustaining' => 'S',
		'Honorary' => 'H',
		'Inactive' => 'I',
		'Staff' => 'ST',
	);

	public function shortcode($attributes = array(), $query_vars = array()) {
		$template = 'directory/list';
		$data = array(
			'show_alphabet_index' => $attributes['show_alphabet_index'],
			'separate_alphabet_pages' => $attributes['separate_alphabet_pages'],
			'show_letter_headers' => $attributes['show_letter_headers'],
			'show_photo_card' => (empty($query_vars['docent-display']) || ($query_vars['docent-display'] == 'grid')),
			'is_admin' => is_admin(),
			'links' => array(),
			'docents' => array(),
		);

		// URI and Links
		$data['links']['grid'] = $this->_query_merge(array('docent-display' => 'grid'));
		$data['links']['list'] = $this->_query_merge(array('docent-display' => 'list'));
		$data['links']['jump'] = $this->_query_merge(array('docent-letter' => ''));

		// TO DO: Move this into Docent Model / WPModel
		$args = [
	    	'role__in' => ['administrator', 'docent'],
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
			foreach($docent_query->results as $docent)
			{
				$docent->docent_designation_abbreviation = $this->designations[$docent->docent_designation];

				if($attributes['show_letter_headers'])
				{
					$data['docents'][substr($docent->last_name, 0 , 1)][$docent->ID] = $docent;
				}
				else
				{
					$data['docents'][$docent->ID] = $docent;
				}
			}
		}

		return $this->render($template, $data);
	}

}
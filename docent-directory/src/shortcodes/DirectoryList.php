<?php

namespace Factor1\Shortcodes;

use \Factor1\Directory;

class DirectoryList extends \Factor1\Shortcode {

	protected $tag = 'docent-directory';
	protected $defaults = array(
		'show_alphabet_index' => true,
		'separate_alphabet_pages' => true,
		'show_letter_headers' => true,
		'photo_size' => 'thumbnail',
		'limit' => -1,
	);
	public $designations = array(
		'Docent' => 'D',
		'Senior Docent' => 'SD' ,
		'Master Docent' => 'M' ,
		'Master Emeritus' => 'ME',
		'Apprentice' => 'A',
		'Sustaining' => 'S',
		'Honorary' => 'H',
		'Inactive' => 'I',
		'Trainee' => 'T',
		'Staff' => 'ST',
	);

	public function shortcode($attributes = array(), $query_vars = array()) {
		$template = 'directory/list';
		$data = array(
			'show_alphabet_index' => $attributes['show_alphabet_index'],
			'separate_alphabet_pages' => $attributes['separate_alphabet_pages'],
			'show_letter_headers' => $attributes['show_letter_headers'],
			'show_photo_card' => (empty($query_vars['docent-display']) || ($query_vars['docent-display'] == 'grid')),
			'photo_size' => $attributes['photo_size'],
			'is_admin' => is_admin(),
			'query' => array_filter($query_vars),
			'links' => array(),
			'designations' => $this->designations,
			'docents' => array(),
		);

		// Actions
		add_action('pre_user_query', array($this, 'user_meta_OR_search'));

		// URI and Links
		$data['links']['grid'] = $this->_query_merge(array('docent-display' => 'grid'));
		$data['links']['list'] = $this->_query_merge(array('docent-display' => 'list'));
		$data['links']['jump'] = $this->_query_merge(array('docent-letter' => ''));

		// TO DO: Move this into Docent Model / WPModel
		$args = [
	    	'role__in' => ['administrator', 'docent'],
	    	'search_columns' => array('user_email'),
		    'order' => 'ASC',
		    'orderby' => 'meta_value',
		    'meta_key' => 'last_name',
		    'meta_query' => array(
				'relation' => 'OR',
		    ),
		    'number' => $attributes['limit'],
		];

		// Add search terms
		if(!empty($_REQUEST['search']))
		{
			$args['_meta_or_search'] = '*' . esc_attr($_REQUEST['search']) . '*';
			$args['meta_query'][] = array(
				'key' => 'first_name',
				'value' => esc_attr($_REQUEST['search']),
				'compare' => 'LIKE',
			);
			$args['meta_query'][] = array(
				'key' => 'last_name',
				'value' => esc_attr($_REQUEST['search']),
				'compare' => 'LIKE',
			);
			$args['meta_query'][] = array(
				'key' => 'class_year',
				'value' => esc_attr($_REQUEST['search']),
				'compare' => '=',
			);
		}

		if(!empty($query_vars['docent-letter']))
		{
			$args['meta_query'][] = array(
				'key' => 'last_name',
				'value' => '^' . $query_vars['docent-letter'] . '.*',
				'compare' => 'REGEXP',
			);
		}

		if(!empty($query_vars['docent-designation']))
		{
			if($query_vars['docent-designation'] != 'ST')
			{
				$full_designations = array_flip($this->designations);
				$args['meta_query'][] = array(
					'key' => 'docent_designation',
					'value' => $full_designations[$query_vars['docent-designation']],
					'compare' => '=',
				);
			}
		}

		$docent_query = new \WP_User_Query($args);
		if(!empty($docent_query->results))
		{
			foreach($docent_query->results as $docent)
			{
				if(empty($docent->docent_designation))
				{
					$docent->docent_designation = 'Staff';
				}

				$docent->docent_designation_abbreviation = $this->designations[$docent->docent_designation];

				// Skip to next user (without adding it) if we're searching for staff and they are not staff
				if(!empty($query_vars['docent-designation']) &&
					$query_vars['docent-designation'] == 'ST' && $docent->docent_designation != 'Staff')
				{
					continue;
				}

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

	public function user_meta_OR_search($q)
	{
		// Adapted from: https://wordpress.stackexchange.com/a/248674
		/*
    	if($search = $q->get('_meta_or_search'))
    	{
        	add_filter('get_meta_sql', function($sql) use ($search)
        	{
            	global $wpdb;

				// Only run once:
	            static $nr = 0;
				if(0 != $nr++)
				{
					return $sql;
				}

				error_log(print_r($search, true));

				// Modify WHERE part:
				$where = sprintf(
                	" AND ( %s OR %s OR %s ) ",
					$wpdb->prepare("{$wpdb->users}.user_nicename like '%%%s%%'", $search),
					$wpdb->prepare("{$wpdb->users}.user_email like '%%%s%%'", $search),
					mb_substr($sql['where'], 5, mb_strlen($sql['where']))
				);

				$sql['where'] = $where;

				error_log(print_r($sql, true));

				return $sql;
        	});
        }
        */
    }

}
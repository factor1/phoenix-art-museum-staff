<?php

namespace Factor1\Shortcodes;

use \Factor1\Directory;

class DirectoryList extends \Factor1\Shortcode {

	protected $tag = 'docent-directory';
	protected $defaults = array(
		'show_alphabet_index' => true,
		'filter_alphabet_index' => false,
		'separate_alphabet_pages' => true,
		'show_letter_headers' => true,
		'photo_size' => 'thumbnail',
		'limit' => -1,
	);
	protected $query_args;
	public $designations = array(
		'Docent' => 'D',
		'Senior Docent' => 'SD' ,
		'Master Docent' => 'M' ,
		'Master Emeritus' => 'ME',
		'Apprentice' => 'A',
		'Trainee' => 'T',
		'Sustaining' => 'S',
		'Honorary' => 'H',
		'Inactive' => 'I',
		'Staff' => 'ST',
	);
	public $staff_designations = array(
		'Director\'s Office',
		'Advancement',
		'Administration',
		'Security',
		'Education & Library Staff',
		'Curatorial',
	);

	public function shortcode($attributes = array(), $query_vars = array()) {
		$current_user = wp_get_current_user();
		$template = 'directory/list';
		$this->data = array(
			'show_alphabet_index' => $attributes['show_alphabet_index'],
			'filter_alphabet_index' => $attributes['filter_alphabet_index'],
			'separate_alphabet_pages' => $attributes['separate_alphabet_pages'],
			'show_letter_headers' => $attributes['show_letter_headers'],
			'show_photo_card' => (empty($query_vars['docent-display']) || ($query_vars['docent-display'] == 'grid')),
			'photo_size' => $attributes['photo_size'],
			'is_admin' => current_user_can('administrator') || current_user_can('web_admin'),
			'query' => array_filter($query_vars),
			'links' => array(),
			'designations' => $this->designations,
			'docents' => array(),
		);

		// Actions
		// add_action('pre_user_query', array($this, 'user_meta_OR_search'));

		// Add search to query data if it exists
		if(!empty($_REQUEST['search']))
		{
			$this->data['query'] = array_merge($this->data['query'], array('search' => $_REQUEST['search']));
		}

		// URI and Links
		$this->data['links']['grid'] = $this->_query_merge(array('docent-display' => 'grid'));
		$this->data['links']['list'] = $this->_query_merge(array('docent-display' => 'list'));
		$this->data['links']['jump'] = $this->_query_merge(array('docent-letter' => ''));
		$this->data['links']['export'] = $this->_query_merge(array('docent-export' => ''));

		// TO DO: Move this into Docent Model / WPModel
		$this->query_args = [
	    	'role__in' => ['administrator', 'editor', 'docent'],
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
			// $this->query_args['_meta_or_search'] = '*' . esc_attr($_REQUEST['search']) . '*';
			$this->query_args['meta_query'][] = array(
				'key' => 'first_name',
				'value' => esc_attr($_REQUEST['search']),
				'compare' => 'LIKE',
			);
			$this->query_args['meta_query'][] = array(
				'key' => 'last_name',
				'value' => esc_attr($_REQUEST['search']),
				'compare' => 'LIKE',
			);
			$this->query_args['meta_query'][] = array(
				'key' => 'class_year',
				'value' => esc_attr($_REQUEST['search']),
				'compare' => '=',
			);
		}

		if(!empty($query_vars['docent-letter']) && empty($_REQUEST['search']))
		{
			$this->query_args['meta_query'][] = array(
				'key' => 'last_name',
				'value' => '^' . $query_vars['docent-letter'] . '.*',
				'compare' => 'REGEXP',
			);
		}

		if(!empty($query_vars['docent-designation']) && empty($_REQUEST['search']))
		{
			if($query_vars['docent-designation'] != 'ST')
			{
				$full_designations = array_flip($this->designations);
				$this->query_args['meta_query'][] = array(
					'key' => 'docent_designation',
					'value' => $full_designations[$query_vars['docent-designation']],
					'compare' => '=',
				);
			}
		}

		if($query_vars['docent-export'])
		{
			return null;
		}

		$docent_query = new \WP_User_Query($this->query_args);
		if(!empty($docent_query->results))
		{
			foreach($docent_query->results as $docent)
			{
				$first_letter_last_name = strtoupper(substr($docent->last_name, 0 , 1));

				if(empty($docent->docent_designation))
				{
					$docent->docent_designation = 'Staff';
					$docent->is_staff = true;
				}

				if(in_array($docent->docent_designation, $this->staff_designations))
				{
					$docent->docent_designation_abbreviation = 'ST';
					$docent->is_staff = true;
				}
				else
				{
					$docent->docent_designation_abbreviation = $this->designations[$docent->docent_designation];
				}

				// Skip to next user (without adding it) if we're searching for staff and they are not staff
				if(!empty($query_vars['docent-designation']) &&
					$query_vars['docent-designation'] == 'ST' && $docent->docent_designation != 'Staff')
				{
					continue;
				}

				// Remove users that don't start with docent letter if we're searching AND we have
				// the $query_vars['docent-letter'] filter
				if(!empty($_REQUEST['search']) && !empty($query_vars['docent-letter']))
				{
					if($query_vars['docent-letter'] != $first_letter_last_name)
					{
						continue;
					}
				}

				// Remove users that don't have the cirrect docent designation if we're searching
				// AND we have the $query_vars['docent-designation'] filter
				if(!empty($_REQUEST['search']) && !empty($query_vars['docent-designation']))
				{
					if($query_vars['docent-designation'] != $docent->docent_designation_abbreviation)
					{
						continue;
					}
				}

				if($attributes['show_letter_headers'])
				{
					$this->data['docents'][$first_letter_last_name][$docent->ID] = $docent;
				}
				else
				{
					$this->data['docents'][$docent->ID] = $docent;
				}
			}
		}

		return $this->render($template, $this->data);
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

    public function _pre_render() {
		global $wp_query;

		if((current_user_can('administrator') || current_user_can('web_admin'))&&
	    	!empty($wp_query->query_vars) &&
	    	array_key_exists('docent-export', $wp_query->query_vars)
	    ) {
		    $this->_shortcode_merge(array());
		    $docent_query = new \WP_User_Query($this->query_args);

		    if(!empty($docent_query->results))
			{
				$headings = array(
					'Name',
					'Email',
					'Spouse/Partner',
					'Address',
					'Primary Phone',
					'Alternate Phone 1',
					'Alternate Phone 2',
					'Docent Designation',
					'Class Year',
					'Past President (Years of Service)',
				);
				$fh = fopen('php://output', 'w');
				ob_start();
				fputcsv($fh, $headings);
				foreach($docent_query->results as $docent)
				{
					$docent_president_years = null;
					if($docent->past_president)
					{
						$docent_president_years = $docent->years_of_office_years_of_office_start;
						if(!empty($docent->years_of_office_years_of_office_end))
						{
							$docent_president_years .= ' - ' . $docent->years_of_office_years_of_office_end;
						}
					}

					fputcsv($fh, array(
						$docent->first_name . ' ' . $docent->last_name,
						$docent->user_email,
						$docent->spouse_partner,
						!empty($docent->address) ? implode(' ', $docent->address) : null,
						$docent->primary_phone_group_primary_phone,
						$docent->alternate1_phone_group_alternate1_phone,
						$docent->alternate2_phone_group_alternate2_phone,
						$docent->docent_designation,
						$docent->class_year,
						$docent_president_years,
					));
				}
				$string = ob_get_clean();
				$filename = 'docent_export_' . date('m.d.Y');

				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: private",false);
				header("Content-Type: text/csv");
				header("Content-Disposition: attachment; filename=\"$filename.csv\";");
				header("Content-Transfer-Encoding: binary");

				exit($string);
			}
	    }
    }

}
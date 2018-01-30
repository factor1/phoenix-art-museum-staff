<?php

namespace Factor1\Models;

use \Jenssegers\Model\Model;

/**
 * Adapted from:
 *
 * https://github.com/jenssegers/model
 * https://github.com/friedolinfoerder/wp-activerecord
 *
 */

class WPModel extends Model {

	protected $where = [];

	protected $type = 'post';
	protected $args;
    protected $roles = [];

    public function __construct(array $attributes = [])
    {
        if($this->type == 'user')
        {
	        $this->args = [
		    	'role__in' => $this->roles,
			    /*
			    'order' => 'ASC',
			    'orderby' => 'display_name',
			    'search' => '*' . esc_attr($search_term) . '*',

			    'meta_query' => array(
			        'relation' => 'OR',
			        array(
			            'key'     => 'first_name',
			            'value'   => $search_term,
			            'compare' => 'LIKE'
			        ),
			        array(
			            'key'     => 'last_name',
			            'value'   => $search_term,
			            'compare' => 'LIKE'
			        ),
			        array(
			            'key' => 'description',
			            'value' => $search_term ,
			            'compare' => 'LIKE'
			        )
			    )
			    */
			];
        }
        else
        {
			$this->args = [];
        }

        parent::__construct($attributes);
    }

	public function _query($limit = null)
	{
		/*
			'ID' - Search by user id.
			'user_login' - Search by user login.
			'user_nicename' - Search by user nicename.
			'user_email' - Search by user email.
			'user_url' - Search by user url.
		*/

		$this->query = ($this->type == 'user') ? new \WP_User_Query($this->args) : new \WP_Query($this->args);
	}

	public function where($column, $type_or_value = null, $value = null)
	{
		return $this->where_condition('where', func_num_args(), $column, $type_or_value, $value);
    }

    public function andWhere($key, $type_or_value = null, $value = null)
    {
        return call_user_func_array([$this, 'where'], func_get_args());
    }

	public function orWhere($key, $type_or_value = null, $value = null)
	{
        $this->where[] = [];

        return call_user_func_array([$this, 'where'], func_get_args());
    }

    protected function where_condition($array, $num_args, $column, $type_or_value, $value)
    {
		$type = $type_or_value;
        $obj = null;

	    switch($num_args)
	    {
		    case 2:
		    	$value = $type_or_value;
				$type = is_null($value) ? 'IS' : '=';
		    	break;
		    case 1:
		    	if(is_string($column))
		    	{
                	$obj = [$column];
                }
                elseif(!is_array($column))
                {
	                throw new Exception('Only one argument provided for function where, but this is not an string or array.');
	            }
	            elseif(array_key_exists(0, $column))
	            {
	                $obj = $column;
            	}
            	else
            	{
                	foreach($column as $k => $v)
                	{
                    	if(is_array($v) && count($v) === 2)
                    	{
                        	$this->{$array}($k, $v[0], $v[1]);
                    	}
                    	else
                    	{
                        	$this->{$array}($k, $v);
                    	}
                	}

					return $this;
            	}
		    	break;
	    }

	    if(is_null($value))
	    {
            $value = ['NULL'];
        }

	    if(!$obj)
	    {
            $obj = new \stdClass();
            $obj->column = $column;
            $obj->type = strtoupper($type);
            $obj->value = $value;
        }

        if(!$this->{$array})
        {
            $this->{$array}[] = [];
        }

        $this->{$array}[count($this->{$array})-1][] = $obj;

        return $this;
	}

	public function get()
	{

	}

	public function all()
	{
		return array();
	}

}
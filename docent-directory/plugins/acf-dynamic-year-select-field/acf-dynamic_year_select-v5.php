<?php
if( ! class_exists('acf_field_dynamic_year_select') ) :

class acf_field_dynamic_year_select extends acf_field {
	
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	14/02/2016
	*  @since	1.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	function __construct() {
		
		$this->name = 'dynamic_year_select';
		$this->label = __('Dynamic Year', 'acf-dynamic_year_select');
		$this->category = 'choice';
		$this->defaults = array(
			'year_step'				=> 1,
			'order_by' => 'chronological',
			'current_year' => array(
				'allow' => false,
				'label' => 'Current'
			),
			'oldest_year'			=> array(
				'method'	 	=> 'relative',
				'exact_year' 	=> date('Y'),
				'relative_year' => 20,
				'relative_year_direction' => 'before'
			),
			'newest_year'			=> array(
				'method'	 	=> 'exact',
				'exact_year' 	=> date('Y'),
				'relative_year' => 20,
				'relative_year_direction' => 'after'
			)
		);
		
		// do not delete!
    	parent::__construct();
	}
	
	/*
	 *  render_field_settings()
	 *
	 *  Create extra settings for your field. These are visible when editing a field
	 *
	 *  @type	action
	 *  @since	1.0
	 *  @date	14/02/16
	 *
	 *  @param	$field (array) the $field being edited
	 *  @return	n/a
	 */
	function render_field_settings( $field ) {
		
		acf_render_field_wrap(array(
				'label'			=> __('Oldest Year','acf-dynamic_year_select'),
				'instructions'	=> __('This is the earliest year for the user to choose from. For relative, 0 represents current year.','acf-dynamic_year_select'),
				'type'			=> 'select',
				'name'			=> 'method',
				'class'			=> 'oldest_year-method',
				'prefix'		=> $field['prefix'] . '[oldest_year]',
				'value'			=> $field['oldest_year']['method'],
				'choices'		=> array(
					'exact' => __('Exact','acf-dynamic_year_select'), 
					'relative' => __('Relative','acf-dynamic_year_select')
				),
				'wrapper'		=> array(
					'data-name' => 'oldest_year'
				)
		), 'tr');
		
		acf_render_field_wrap(array(
				'label'			=> '',
				'instructions'	=> '',
				'type'			=> 'number',
				'name'			=> 'exact_year',
				'class'			=> 'oldest_year-exact_year',
				'prefix'		=> $field['prefix'] . '[oldest_year]',
				'value'			=> $field['oldest_year']['exact_year'],
				'prepend'		=> __('From','acf-dynamic_year_select'),
				'wrapper'		=> array(
					'data-append' => 'oldest_year'
				)
		), 'tr');
		
		acf_render_field_wrap(array(
				'label'			=> '',
				'instructions'	=> '',
				'type'			=> 'number',
				'name'			=> 'relative_year',
				'class'			=> 'oldest_year-relative_year',
				'prefix'		=> $field['prefix'] . '[oldest_year]',
				'value'			=> $field['oldest_year']['relative_year'],
				'append'		=> __('years', 'acf-dynamic_year_select'),
				'min'			=> 0,
				'wrapper'		=> array(
					'data-append' => 'oldest_year'
				)
		), 'tr');
		
		acf_render_field_wrap(array(
				'label'			=> '',
				'instructions'	=> '',
				'type'			=> 'select',
				'name'			=> 'relative_year_direction',
				'class'			=> 'oldest_year-relative_year_direction',
				'prefix'		=> $field['prefix'] . '[oldest_year]',
				'value'			=> $field['oldest_year']['relative_year_direction'],
				'choices'	=> array(
						'before' => __('before current year (' . date('Y') . ')','acf-dynamic_year_select'),
						'after' => __('after current year (' . date('Y') . ')','acf-dynamic_year_select')
				),
				'wrapper'		=> array(
					'data-append' => 'oldest_year'
				)
		), 'tr');
		
		acf_render_field_wrap(array(
				'label'			=> __('Newest Year','acf-dynamic_year_select'),
				'instructions'	=> __('This is the latest year for the user to choose from. For relative, 0 represents current year.','acf-dynamic_year_select'),
				'type'			=> 'select',
				'name'			=> 'method',
				'class'			=> 'newest_year-method',
				'prefix'		=> $field['prefix'] . '[newest_year]',
				'value'			=> $field['newest_year']['method'],
				'choices'		=> array(
						'exact' => __('Exact','acf-dynamic_year_select'),
						'relative' => __('Relative','acf-dynamic_year_select')
				),
				'wrapper'		=> array(
					'data-name' => 'newest_year'
				)
		), 'tr');
		
		acf_render_field_wrap(array(
				'label'			=> '',
				'instructions'	=> '',
				'type'			=> 'number',
				'name'			=> 'exact_year',
				'class'			=> 'newest_year-exact_year',
				'prefix'		=> $field['prefix'] . '[newest_year]',
				'value'			=> $field['newest_year']['exact_year'],
				'prepend'		=> __('To','acf-dynamic_year_select'),
				'wrapper'		=> array(
					'data-append' => 'newest_year'
				)
		), 'tr');
		
		acf_render_field_wrap(array(
				'label'			=> '',
				'instructions'	=> '',
				'type'			=> 'number',
				'name'			=> 'relative_year',
				'class'			=> 'newest_year-relative_year',
				'prefix'		=> $field['prefix'] . '[newest_year]',
				'value'			=> $field['newest_year']['relative_year'],
				'append'		=> __('years', 'acf-dynamic_year_select'),
				'min'			=> 0,
				'wrapper'		=> array(
					'data-append' => 'newest_year'
				)
		), 'tr');
		
		acf_render_field_wrap(array(
				'label'			=> '',
				'instructions'	=> '',
				'type'			=> 'select',
				'name'			=> 'relative_year_direction',
				'class'			=> 'newest_year-relative_year_direction',
				'prefix'		=> $field['prefix'] . '[newest_year]',
				'value'			=> $field['newest_year']['relative_year_direction'],
				'choices'	=> array(
					'before' => __('before current year (' . date('Y') . ')','acf-dynamic_year_select'),
					'after' => __('after current year (' . date('Y') . ')','acf-dynamic_year_select')
				),
				'wrapper'		=> array(
					'data-append' => 'newest_year'
				)
		), 'tr');
		
		acf_render_field_wrap(array(
				'label'			=> __('Allow Current Year','acf-dynamic_year_select'),
				'instructions'	=> __('Allows the user to choose the year as current.  This will output "Current" when returned.','acf-dynamic_year_select'),
				'type'			=> 'true_false',
				'name'			=> 'allow',
				'class'			=> 'current_year-allow',
				'prefix'		=> $field['prefix'] . '[current_year]',
				'value'			=> $field['current_year']['allow'],
				'message'		=> __('Allow user to set year as ', 'acf-dynamic_year_select'),
				'wrapper'		=> array(
					'data-name' => 'current_year'
				)
		), 'tr');

		acf_render_field_wrap(array(
				'label'			=> '',
				'instructions'	=> '',
				'type'			=> 'text',
				'name'			=> 'label',
				'class'			=> 'current_year-label',
				'prefix'		=> $field['prefix'] . '[current_year]',
				'value'			=> $field['current_year']['label'],
				'wrapper'		=> array(
						'data-append' => 'current_year'
				)
		), 'tr');
		
		acf_render_field_setting( $field, array(
				'label'			=> __('Step','acf-dynamic_year_select'),
				'instructions'	=> __('Choose the step for year option (i.e. 1 is every year, 5 is every five years).','acf-dynamic_year_select'),
				'type'			=> 'number',
				'name'			=> 'year_step',
				'min'			=> 1
		));
		
		acf_render_field_setting( $field, array(
				'label'			=> __('Order By','acf-dynamic_year_select'),
				'instructions'	=> __('Choose the order to show the year options, chronological (oldest to newest) or reverse chronological (newest to oldest).','acf-dynamic_year_select'),
				'type'			=> 'select',
				'name'			=> 'order_by',
				'choices'	=> array(
						'chronological' => __('Chronological','acf-dynamic_year_select'),
						'rchronological' => __('Reverse Chronological','acf-dynamic_year_select')
				),
		));
		
	}
	
	
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field( $field ) {
		
		/*
		*  Create a simple text input using the 'font_size' setting.
		*/
		// vars
		$atts = array(
			'id'				=> $field['id'],
			'class'				=> $field['class'],
			'name'				=> $field['name'],
		);
		
		echo '<select ' . acf_esc_attr($atts) . '>';
		
		//create choices
		$from_year = $field['oldest_year']['method']=='exact' ? $field['oldest_year']['exact_year'] : ($field['oldest_year']['relative_year_direction']=='before' ? date('Y')-$field['oldest_year']['relative_year'] : date('Y')+$field['oldest_year']['relative_year']); 
		$to_year = $field['newest_year']['method']=='exact' ? $field['newest_year']['exact_year'] : ($field['newest_year']['relative_year_direction']=='before' ? date('Y')-$field['newest_year']['relative_year'] : date('Y')+$field['newest_year']['relative_year']);
		
		
		$field['choices'] = [];
		
		//if allow current at to top of list
		if($field['current_year']['allow']) {
			$field['choices']['current'] = $field['current_year']['label'];
		}
		
		// create all other years based on order
		if($field['order_by'] == 'rchronological') {
			for($i=$to_year; $i>=$from_year; $i-=$field['year_step']) {
				$field['choices'][$i] = $i;
			}
		} else {
			for($i=$from_year; $i<=$to_year; $i+=$field['year_step']) {
				$field['choices'][$i] = $i;
			}
		}
		
		// walk
		$this->walk( $field['choices'], $field['value'] );
		
		// close
		echo '</select>';
	}
	
	/*
	 *  walk
	 *
	 *  Walk through each choice and create HTML for options
	 *
	 *  @type	function
	 *  @date	14/02/2016
	 *  @since	1.0.0
	 *
	 *  @param	$post_id (int)
	 *  @return	$post_id (int)
	 */
	function walk( $choices, $value ) {
	
		// bail early if no choices
		if( empty($choices) ) return;
	
		// loop
		foreach( $choices as $k => $v ) {
				
			$atts = array( 'value' => $k );
			
			// set selected value
			if( $value == $v ) {
				$atts['selected'] = 'selected';
			}
				
			// option
			echo '<option ' . acf_esc_attr($atts) . '>' . $v . '</option>';
		}
	}
	
		
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/
	function input_admin_enqueue_scripts() {
		
		$dir = plugin_dir_url( __FILE__ );
		
		// register & include JS
		//wp_register_script( 'acf-input-dynamic_year_select', "{$dir}js/input.js" );
		//wp_enqueue_script('acf-input-dynamic_year_select');
		
		// register & include CSS
		//wp_register_style( 'acf-input-dynamic_year_select', "{$dir}css/input.css" ); 
		//wp_enqueue_style('acf-input-dynamic_year_select');
		
		
	}
	
	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_head)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
		
	function input_admin_head() {
	
		
		
	}
	
	*/
	
	
	/*
   	*  input_form_data()
   	*
   	*  This function is called once on the 'input' page between the head and footer
   	*  There are 2 situations where ACF did not load during the 'acf/input_admin_enqueue_scripts' and 
   	*  'acf/input_admin_head' actions because ACF did not know it was going to be used. These situations are
   	*  seen on comments / user edit forms on the front end. This function will always be called, and includes
   	*  $args that related to the current screen such as $args['post_id']
   	*
   	*  @type	function
   	*  @date	6/03/2014
   	*  @since	5.0.0
   	*
   	*  @param	$args (array)
   	*  @return	n/a
   	*/
   	
   	/*
   	
   	function input_form_data( $args ) {
	   	
		
	
   	}
   	
   	*/
	
	
	/*
	*  input_admin_footer()
	*
	*  This action is called in the admin_footer action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_footer)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
		
	function input_admin_footer() {
	
		
		
	}
	
	*/
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add CSS + JavaScript to assist your render_field_options() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function field_group_admin_enqueue_scripts() {
		$dir = plugin_dir_url( __FILE__ );
		
		// register & include JS
		wp_register_script( 'acf-input-dynamic_year_select', "{$dir}js/admin.js" );
		wp_enqueue_script('acf-input-dynamic_year_select');
	}
		
	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add CSS and JavaScript to assist your render_field_options() action.
	*
	*  @type	action (admin_head)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
	
	function field_group_admin_head() {
	
	}
	
	*/


	/*
	*  load_value()
	*
	*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	
	/*
	
	function load_value( $value, $post_id, $field ) {
		
		return $value;
		
	}
	
	*/
	
	
	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is saved in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	
	/*
	
	function update_value( $value, $post_id, $field ) {
		
		return $value;
		
	}
	
	*/
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value which was loaded from the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*
	*  @return	$value (mixed) the modified value
	*/
	
	function format_value( $value, $post_id, $field ) {
		
		// show current label if value is current
		if( $value == 'current' ) { 
			$value = $field['current_year']['label'];
		}
		
		// return
		return $value;
	}
	
	
	
	/*
	*  validate_value()
	*
	*  This filter is used to perform validation on the value prior to saving.
	*  All values are validated regardless of the field's required setting. This allows you to validate and return
	*  messages to the user if the value is not correct
	*
	*  @type	filter
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$valid (boolean) validation status based on the value and the field's required setting
	*  @param	$value (mixed) the $_POST value
	*  @param	$field (array) the field array holding all the field options
	*  @param	$input (string) the corresponding input name for $_POST value
	*  @return	$valid
	*/
	
	/*
	
	function validate_value( $valid, $value, $field, $input ){
		
		// Basic usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = false;
		}
		
		
		// Advanced usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = __('The value is too little!','acf-FIELD_NAME'),
		}
		
		
		// return
		return $valid;
		
	}
	
	*/
	
	
	/*
	*  delete_value()
	*
	*  This action is fired after a value has been deleted from the db.
	*  Please note that saving a blank value is treated as an update, not a delete
	*
	*  @type	action
	*  @date	6/03/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (mixed) the $post_id from which the value was deleted
	*  @param	$key (string) the $meta_key which the value was deleted
	*  @return	n/a
	*/
	
	/*
	
	function delete_value( $post_id, $key ) {
		
		
		
	}
	
	*/
	
	
	/*
	*  load_field()
	*
	*  This filter is applied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @date	23/01/2013
	*  @since	3.6.0	
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	$field
	*/
	
	/*
	
	function load_field( $field ) {
		
		return $field;
		
	}	
	
	*/
	
	
	/*
	*  update_field()
	*
	*  This filter is applied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @date	23/01/2013
	*  @since	3.6.0
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	$field
	*/
	
	/*
	
	function update_field( $field ) {
		
		return $field;
		
	}	
	
	*/
	
	
	/*
	*  delete_field()
	*
	*  This action is fired after a field is deleted from the database
	*
	*  @type	action
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	n/a
	*/
	
	/*
	
	function delete_field( $field ) {
		
		
		
	}	
	
	*/
	
	
}


// create field
new acf_field_dynamic_year_select();

endif;
?>

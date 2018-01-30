<?php
if( ! class_exists('acf_field_dynamic_year_select') ) :

class acf_field_dynamic_year_select extends acf_field {
	
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options
		
		
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct()
	{
		// vars
		$this->name = 'dynamic_year_select';
		$this->label = __('Dynamic Year', 'acf-dynamic_year_select');
		$this->category = __('Choice', 'acf-dynamic_year_select');
		$this->defaults = array(
			'oldest_year_method' => 'relative',
			'oldest_year_exact_year' => date('Y'),
			'oldest_year_relative_year' => 20,
			'oldest_year_relative_year_direction' => 'before',
			'newest_year_method' => 'exact',
			'newest_year_exact_year' => date('Y'),
			'newest_year_relative_year' => 20,
			'newest_year_relative_year_direction' => 'after',
			'year_step' => 1,
			'order_by' => 'chronological',
			'current_year_allow' => false,
			'current_year_label' => 'Current'
		);
		
		// do not delete!
    	parent::__construct();
    	
    	
    	// settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.0.0'
		);

	}
	
	
	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like below) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	function create_options( $field )
	{
		// defaults?
		$field = array_merge($this->defaults, $field);
		
		// key is needed in the field names to correctly save the data
		$key = $field['name'];
		
		
		// Create Field Options HTML
		?>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e('Oldest Year','acf-dynamic_year_select'); ?></label>
		<p class="description"><?php _e("This is the earliest year for the user to choose from. For relative, 0 represents current year.",'acf-dynamic_year_select'); ?></p>
	</td>
	<td>
		<ul class="acf-hl" data-cols="3">
			<li>
				<?php
				do_action('acf/create_field', array(
					'type'		=>	'select',
					'name'		=>	'fields['.$key.'][oldest_year_method]',
					'value'		=>	$field['oldest_year_method'],
					'class'		=> 'oldest_year-method',
					'choices'	=> array(
						'exact' => __('Exact','acf-dynamic_year_select'), 
						'relative' => __('Relative','acf-dynamic_year_select')
					),
				));
				?>
			</li>
			<li class="hide-if-js">
				<?php
				do_action('acf/create_field', array(
					'type'		=>	'number',
					'name'		=>	'fields['.$key.'][oldest_year_exact_year]',
					'value'		=>	$field['oldest_year_exact_year'],
					'class'		=> 'oldest_year-exact_year',
					'prepend'	=> __('From','acf-dynamic_year_select'),
				));
				?>
			</li>
			<li>
				<?php
				do_action('acf/create_field', array(
					'type'		=>	'number',
					'name'		=>	'fields['.$key.'][oldest_year_relative_year]',
					'class'		=> 'oldest_year-relative_year',
					'value'		=>	$field['oldest_year_relative_year'],
					'append'	=> __('years', 'acf-dynamic_year_select'),
					//'min'		=> 0,
				));
				?>
			</li>
			<li class="hide-if-js">
				<?php
				do_action('acf/create_field', array(
					'type'		=>	'select',
					'name'		=>	'fields['.$key.'][oldest_year_relative_year_direction]',
					'class'		=> 'oldest_year-relative_year_direction',
					'value'		=>	$field['oldest_year_relative_year_direction'],
					'choices'	=> array(
						'before' => __('before current year (' . date('Y') . ')','acf-dynamic_year_select'),
						'after' => __('after current year (' . date('Y') . ')','acf-dynamic_year_select')
					),
				));
				?>
			</li>
		</ul>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e('Newest Year','acf-dynamic_year_select'); ?></label>
		<p class="description"><?php _e("This is the latest year for the user to choose from. For relative, 0 represents current year.",'acf-dynamic_year_select'); ?></p>
	</td>
	<td>
		<ul class="acf-hl" data-cols="3">
			<li>
				<?php
				do_action('acf/create_field', array(
					'type'		=>	'select',
					'name'		=>	'fields['.$key.'][newest_year_method]',
					'value'		=>	$field['newest_year_method'],
					'class'		=> 'newest_year-method',
					'choices'	=> array(
						'exact' => __('Exact','acf-dynamic_year_select'), 
						'relative' => __('Relative','acf-dynamic_year_select')
					),
				));
				?>
			</li>
			<li>
				<?php
				do_action('acf/create_field', array(
					'type'		=>	'number',
					'name'		=>	'fields['.$key.'][newest_year_exact_year]',
					'value'		=>	$field['newest_year_exact_year'],
					'class'		=> 'newest_year-exact_year',
					'prepend'	=> __('To','acf-dynamic_year_select'),
				));
				?>
			</li>
			<li class="hide-if-js">
				<?php
				do_action('acf/create_field', array(
					'type'		=>	'number',
					'name'		=>	'fields['.$key.'][newest_year_relative_year]',
					'class'		=> 'newest_year-relative_year',
					'value'		=>	$field['newest_year_relative_year'],
					'append'	=> __('years', 'acf-dynamic_year_select'),
					'min'		=> 0,
				));
				?>
			</li>
			<li class="hide-if-js">
				<?php
				do_action('acf/create_field', array(
					'type'		=>	'select',
					'name'		=>	'fields['.$key.'][newest_year_relative_year_direction]',
					'class'		=> 'newest_year-relative_year_direction',
					'value'		=>	$field['newest_year_relative_year_direction'],
					'choices'	=> array(
						'before' => __('before current year (' . date('Y') . ')','acf-dynamic_year_select'),
						'after' => __('after current year (' . date('Y') . ')','acf-dynamic_year_select')
					),
				));
				?>
			</li>
		</ul>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e('Step','acf-dynamic_year_select'); ?></label>
		<p class="description"><?php _e('Choose the step for year option (i.e. 1 is every year, 5 is every five years).','acf-dynamic_year_select'); ?></p>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
			'type'		=>	'number',
			'name'		=>	'fields['.$key.'][year_step]',
			'class'		=> 'year_step',
			'value'		=>	$field['year_step'],
			'min'		=> 1,
		));
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e('Order By','acf-dynamic_year_select'); ?></label>
		<p class="description"><?php _e('Choose the order to show the year options, chronological (oldest to newest) or reverse chronological (newest to oldest).','acf-dynamic_year_select'); ?></p>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
			'type'		=>	'select',
			'name'		=>	'fields['.$key.'][order_by]',
			'class'		=> 'order_by',
			'value'		=>	$field['order_by'],
			'choices'	=> array(
				'chronological' => __('Chronological','acf-dynamic_year_select'),
				'rchronological' => __('Reverse Chronological','acf-dynamic_year_select')
			),
		));
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e('Allow Current Year','acf-dynamic_year_select'); ?></label>
		<p class="description"><?php _e("Allows the user to choose the year as current.  This will output \"Current\" when returned.",'acf-dynamic_year_select'); ?></p>
	</td>
	<td>
		<ul class="acf-hl" data-cols="2">
			<li>
				<?php
				do_action('acf/create_field', array(
					'type'		=>	'true_false',
					'name'		=>	'fields['.$key.'][current_year_allow]',
					'value'		=>	$field['current_year_allow'],
					'class'		=> 'current_year-allow',
					'message'		=> __('Allow user to set year as ', 'acf-dynamic_year_select'),
				));
				?>
			</li>
			<li>
				<?php
				do_action('acf/create_field', array(
					'type'		=>	'text',
					'name'		=>	'fields['.$key.'][current_year_label]',
					'value'		=>	$field['current_year_label'],
					'class'		=> 'current_year-label',
				));
				?>
			</li>
		</ul>
	</td>
</tr>
		<?php
		
	}
	
	
	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function create_field( $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// perhaps use $field['preview_size'] to alter the markup?
		
		
		// create Field HTML
		/*
		 *  Create a simple text input using the 'font_size' setting.
		 */
		// vars
		$atts = array(
				'id'				=> $field['id'],
				'class'				=> $field['class'],
				'name'				=> $field['name'],
		);
		
		echo '<select ' . $this->acf_esc_attr($atts) . '>';
		
		//create choices
		$from_year = $field['oldest_year_method']=='exact' ? $field['oldest_year_exact_year'] : ($field['oldest_year_relative_year_direction']=='before' ? date('Y')-$field['oldest_year_relative_year'] : date('Y')+$field['oldest_year_relative_year']);
		$to_year = $field['newest_year_method']=='exact' ? $field['newest_year_exact_year'] : ($field['newest_year_relative_year_direction']=='before' ? date('Y')-$field['newest_year_relative_year'] : date('Y')+$field['newest_year_relative_year']);
		
		$field['choices'] = [];
		
		//if allow current at to top of list
		if($field['current_year_allow']) {
			$field['choices']['current'] = $field['current_year_label'];
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
			echo '<option ' . $this->acf_esc_attr($atts) . '>' . $v . '</option>';
		}
	}
	
	/*
	 *  acf_esc_attr
	 *
	 *  This function will return a render of an array of attributes to be used in markup
	 *
	 *  @type	function
	 *  @date	1/10/13
	 *  @since	5.0.0
	 *
	 *  @param	$atts (array)
	 *  @return	n/a
	 */
	function acf_esc_attr( $atts ) {
	
		// is string?
		if( is_string($atts) ) {
	
			$atts = trim( $atts );
			return esc_attr( $atts );
	
		}
	
	
		// validate
		if( empty($atts) ) {
	
			return '';
	
		}
	
	
		// vars
		$e = array();
	
	
		// loop through and render
		foreach( $atts as $k => $v ) {
	
			// object
			if( is_array($v) || is_object($v) ) {
					
				$v = json_encode($v);
	
				// boolean
			} elseif( is_bool($v) ) {
					
				$v = $v ? 1 : 0;
	
				// string
			} elseif( is_string($v) ) {
					
				$v = trim($v);
					
			}
	
	
			// append
			$e[] = $k . '="' . esc_attr( $v ) . '"';
		}
	
	
		// echo
		return implode(' ', $e);
	
	}
	
	
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts() {
		
	}
	
	
	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your create_field() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_head()
	{
		// Note: This function can be removed if not used
	}
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add CSS + JavaScript to assist your create_field_options() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_enqueue_scripts()
	{
		wp_register_script( 'acf-input-dynamic_year_select_admin', $this->settings['dir'] . 'js/admin.js', array(), $this->settings['version'] );
		wp_register_style( 'acf-input-dynamic_year_select_admin', $this->settings['dir'] . 'css/admin.css', array(), $this->settings['version'] );
		
		// scripts
		wp_enqueue_script(array('acf-input-dynamic_year_select_admin'));
		
		// styles
		wp_enqueue_style(array('acf-input-dynamic_year_select_admin'));
		
	}

	
	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add CSS and JavaScript to assist your create_field_options() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_head()
	{
		// Note: This function can be removed if not used
	}


	/*
	*  load_value()
	*
		*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value found in the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the value to be saved in the database
	*/
	
	function load_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/
	
	function update_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  format_value()
	*
	*  This filter is applied to the $value after it is loaded from the db and before it is passed to the create_field action
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value( $value, $post_id, $field )
	{
		// show current label if value is current
		if( $value == 'current' ) { 
			$value = $field['current_year_label'];
		}
		return $value;
	}
	
	
	/*
	*  format_value_for_api()
	*
	*  This filter is applied to the $value after it is loaded from the db and before it is passed back to the API functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value_for_api( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// perhaps use $field['preview_size'] to alter the $value?
		
		
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  load_field()
	*
	*  This filter is applied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$field - the field array holding all the field options
	*/
	
	function load_field( $field )
	{
		// Note: This function can be removed if not used
		return $field;
	}
	
	
	/*
	*  update_field()
	*
	*  This filter is applied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

	function update_field( $field, $post_id )
	{
		// Note: This function can be removed if not used
		return $field;
	}

	
}


// create field
new acf_field_dynamic_year_select();

endif;

?>

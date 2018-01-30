<?php

class acf_field_phonenumber extends acf_field {


	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function __construct() {

		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/

		$this->name = 'phonenumber';


		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/

		$this->label = __('Phone number', 'acf-phonenumber');


		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/

		$this->category = __('Basic', 'acf');


		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/

		$this->default_values = array(
			'default_value'  =>  '',
			'separator' => '',
			'country-prefix' => '+',
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
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/

	function render_field_settings( $field ) {

		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/

		acf_render_field_setting( $field, array(
			'label'			=> __('Country prefix', 'acf-phonenumber'),
			'instructions'	=> __('Character before country code', 'acf-phonenumber'),
			'type'			=> 'text',
			'name'			=> 'country-prefix',
			'prepend'		=> '',
			'default_value'			=> $this->default_values['country-prefix']
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Number separator', 'acf-phonenumber'),
			'instructions'	=> __('separator between each block', 'acf-phonenumber'),
			'type'			=> 'text',
			'name'			=> 'separator',
			'prepend'		=> '',
			'default_value'			=> $this->default_values['separator']
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

		// default value
		if( !is_array($field['value']) )
		{
			$field['value'] = array();
		}

		$field['value'] = wp_parse_args($field['value'], array(
			'country_prefix' 	=> '',
			'area_code' 		=> '',
			'phone_number'		=> '',
			'direct_dialing'	=> ''
		));

		// defaults?
		//$field = array_merge($this->default_values, $field);
		?>
        	<table border="0" class="form-table">
                <tr class="acf-tab-wrap">
                    <td class="prefix-input">
                    	<div class="acf-input-prepend icon"><?php echo $field['country-prefix']; ?></div>
                    	<div class="acf-input-wrap">
                    		<input type="number" id="<?php echo $field['key']; ?>_country_prefix" class="<?php echo $field['class']; ?>" name="<?php echo esc_attr($field['name']); ?>[country_prefix]" value="<?php echo $field['value']['country_prefix']; ?>" placeholder="<?php _e('Country code', 'acf-phonenumber'); ?>" />
                    	</div>
                    </td>
                    <td class="separator acf-ac">
                    	<?php echo $field['separator']; ?>
                    </td>
                    <td class="area-input">
                    	<div class="acf-input-wrap">
                    		<input type="number" id="<?php echo $field['key']; ?>_area_code" class="<?php echo $field['class']; ?>" name="<?php echo esc_attr($field['name']); ?>[area_code]" value="<?php echo $field['value']['area_code']; ?>" placeholder="<?php _e('Area code', 'acf-phonenumber'); ?>" />
                    	</div>
                    </td>
                    <td class="separator acf-ac">
                    	<?php echo $field['separator']; ?>
                    </td>
                    <td class="number-input">
                    	<div class="acf-input-wrap">
                    		<input type="number" id="<?php echo $field['key']; ?>_phone_number" class="<?php echo $field['class']; ?>" name="<?php echo esc_attr($field['name']); ?>[phone_number]" value="<?php echo $field['value']['phone_number']; ?>" placeholder="<?php _e('Number', 'acf-phonenumber'); ?>" />
                    	</div>
                    </td>
                    <td class="separator acf-ac">
                    	<?php echo $field['separator']; ?>
                    </td>
                    <td class="dialing-input">
                    	<div class="acf-input-wrap">
                    		<input type="number" id="<?php echo $field['key']; ?>_direct_dialing" class="<?php echo $field['class']; ?> acf-is-prepended" name="<?php echo esc_attr($field['name']); ?>[direct_dialing]" value="<?php echo $field['value']['direct_dialing']; ?>" placeholder="<?php _e('Direct dialing', 'acf-phonenumber'); ?>" />
                    	</div>
                    </td>
                    <td class="final-input">
                    	<div class="acf-input-wrap">
                    		<input type="text" class="<?php echo $field['class']; ?> acf-ar" style="border:none; -webkit-box-shadow: none; box-shadow: none;" onClick="this.setSelectionRange(0, this.value.length)" value="<?php

								if ( $field['separator'] === '' )
									$field['separator'] = ' ';

                    			if ( $field['value']['country_prefix'] === '' )
                    				$field['country-prefix'] = '';

                    			if ( $field['value']['area_code'] !== '' )
                    				$field['value']['area_code'] = '(' . $field['value']['area_code'] . ')';
                    			else
                    				$field['value']['phone_number'] = preg_replace("~^\+?(\d\d\d)?[ /]?(\d\d\d) ?(\d\d\d) ?(\d\d\d)$~", "\\1 \\2 \\3 \\4", $field['value']['phone_number']);

                				printf( '%s%s', $field['country-prefix'], implode($field['separator'], array_filter($field['value']) ) );

                    		?>" />
                    	</div>
                    </td>
                </tr>
            </table>
		<?php
	}

	function load_value( $value, $post_id, $field ) {
		return $value;
	}

	function update_value( $value, $post_id, $field ) {
		$value = maybe_serialize( array_map('trim', $value) );
		return $value;
	}

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

		// bail early if no value
		if( empty($value) ) {

			return $value;

		}

		if(strlen(trim($value['phone_number'])) > 0 && strlen(trim($value['area_code'])) > 0){
			$separator = $field['country-prefix'].$value['country_prefix'].$field['separator'].$value['area_code'].$field['separator'].$value['phone_number'];
			if ($value['direct_dialing']) {
				$separator .= $field['separator'].$value['direct_dialing'];
			}
			$no_separator = $field['country-prefix'].$value['country_prefix'].$value['area_code'].$value['phone_number'];
			if ($value['direct_dialing']) {
				$no_separator .= $value['direct_dialing'];
			}
			$return = array('with_separator' => $separator, 'without_separator' => $no_separator);
			return $return;
		}

	}


}


// create field
new acf_field_phonenumber();

?>

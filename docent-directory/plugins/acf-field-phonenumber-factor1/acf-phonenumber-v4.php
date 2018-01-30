<?php

class acf_field_phonenumber extends acf_field {

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
		$this->name = 'phonenumber';
		$this->label = __('Phone number');
		$this->category = __("Basic",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
			// add default here to merge into your field.
			// This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
			'default_value'  =>  '',
			'separator' => '-',
			'country-prefix' => '+',
		);


		// do not delete!
    	parent::__construct();


    	// settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.0.1'
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
		//$field = array_merge($this->defaults, $field);

		// key is needed in the field names to correctly save the data
		$key = $field['name'];


		// Create Field Options HTML
		?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Country prefix",'acf'); ?></label>
				<p class="description"><?php _e("Character before country code",'acf'); ?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'		=>	'text',
					'name'		=>	'fields['.$key.'][country-prefix]',
					'value'		=>	$field['country-prefix'],
					'layout'	=>	'horizontal'
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Number separator",'acf'); ?></label>
				<p class="description"><?php _e("separator between each block",'acf'); ?></p>
			</td>
			<td>
				<?php

				do_action('acf/create_field', array(
					'type'		=>	'text',
					'name'		=>	'fields['.$key.'][separator]',
					'value'		=>	$field['separator'],
					'layout'	=>	'horizontal'
				));

				?>
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
		global $post;

		// defaults?
		$field = array_merge($this->defaults, $field);
		?>

        	<table border="0">
                <tr>
                    <td class="prefix"><div class="acf-input-prepend icon"><?php echo $field['country-prefix']; ?></div></td>
                    <td class="prefix-input"><div class="acf-input-wrap"><input type="text" id="<?php echo $field['key']; ?>" class="<?php echo $field['class']; ?> acf-is-prepended" name="<?php echo $field['name'].'[country_prefix]'; ?>" value="<?php echo $field['value']['country_prefix']; ?>" placeholder="<?php _e('Country code', 'acf-phonenumber'); ?>" /></div></td>
                    <td class="separator"><?php echo $field['separator'] ?></td>
                    <td class="area-input"><div class="acf-input-wrap"><input type="text" id="<?php echo $field['key']; ?>" class="<?php echo $field['class']; ?>" name="<?php echo $field['name'].'[area_code]'; ?>" value="<?php echo $field['value']['area_code']; ?>" placeholder="<?php _e('Area code', 'acf-phonenumber'); ?>" /></div></td>
                    <td class="separator"><?php echo $field['separator'] ?></td>
                    <td class="number-input"><div class="acf-input-wrap"><input type="text" id="<?php echo $field['key']; ?>" class="<?php echo $field['class']; ?>" name="<?php echo $field['name'].'[phone_number]'; ?>" value="<?php echo $field['value']['phone_number']; ?>" placeholder="<?php _e('Number', 'acf-phonenumber'); ?>" /></div></td>
                    <td class="separator"><?php echo $field['separator'] ?></td>
                    <td class="dialing-input"><div class="acf-input-wrap"><input type="text" id="<?php echo $field['key']; ?>" class="<?php echo $field['class']; ?>" name="<?php echo $field['name'].'[direct_dialing]'; ?>" value="<?php echo $field['value']['direct_dialing']; ?>" placeholder="<?php _e('Direct dialing', 'acf-phonenumber'); ?>" /></div></td>
                </tr>
            </table>

        <?php
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

	/*function format_value( $value, $post_id, $field )
	{
		return strtoupper(trim($value));
	}*/


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


	/*
	*  input_admin_enqueue_scripts()
	*
	*/
	function input_admin_enqueue_scripts()
	{

		// register scripts
		wp_register_script( 'acf-input-phonenumber', $this->settings['dir'] . 'js/input.js', array('acf-input', ''), $this->settings['version'] );

		// enqueu scripts
		wp_enqueue_script(array(
			'acf-input-phonenumber',
		));

	}
}


// create field
new acf_field_phonenumber();

?>

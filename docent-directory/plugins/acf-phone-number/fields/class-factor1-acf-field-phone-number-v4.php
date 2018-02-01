<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('Factor1_acf_field_phone_number') ) :


class Factor1_acf_field_phone_number extends acf_field {

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

	function __construct( $settings )
	{
		die('ACF v4 Unsupported!');
	}

// initialize
new Factor1_acf_field_phone_number( $this->settings );


// class_exists check
endif;

?>
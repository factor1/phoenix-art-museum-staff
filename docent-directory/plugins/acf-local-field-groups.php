<?php

// Created by ACF > Tools > Export Field Groups - Generate PHP

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5a728948add38',
	'title' => '--Directory Information--',
	'fields' => array(
		array(
			'key' => 'field_5a72896b2b18e',
			'label' => '<h3>Directory Information</h3>',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'new_lines' => '',
			'esc_html' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'current_user_role',
				'operator' => '==',
				'value' => 'administrator',
			),
			array(
				'param' => 'user_form',
				'operator' => '==',
				'value' => 'edit',
			),
		),
		array(
			array(
				'param' => 'current_user_role',
				'operator' => '==',
				'value' => 'docent',
			),
			array(
				'param' => 'user_form',
				'operator' => '==',
				'value' => 'edit',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5a18c8e3b4dd1',
	'title' => 'Admin',
	'fields' => array(
		array(
			'key' => 'field_5a18c8f03b4a1',
			'label' => 'Class Year',
			'name' => 'class_year',
			'type' => 'dynamic_year_select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'oldest_year' => array(
				'method' => 'exact',
				'exact_year' => '1958',
				'relative_year' => '20',
				'relative_year_direction' => 'before',
			),
			'newest_year' => array(
				'method' => 'relative',
				'exact_year' => '2017',
				'relative_year' => '0',
				'relative_year_direction' => 'after',
			),
			'current_year' => array(
				'allow' => '0',
				'label' => 'Current',
			),
			'year_step' => 1,
			'order_by' => 'chronological',
		),
		array(
			'key' => 'field_5a18c90a3b4a2',
			'label' => 'Docent Designation',
			'name' => 'docent_designation',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'Docent' => 'Docent',
				'Senior Docent' => 'Senior Docent',
				'Master Docent' => 'Master Docent',
				'Master Emeritus' => 'Master Emeritus',
				'Apprentice' => 'Apprentice',
				'Sustaining' => 'Sustaining',
				'Honorary' => 'Honorary',
				'Inactive' => 'Inactive',
				'null' => '== Staff ==',
				'Director\'s Office' => 'Director\'s Office',
				'Advancement' => 'Advancement',
				'Administration' => 'Administration',
				'Security' => 'Security',
				'Education & Library Staff' => 'Education & Library Staff',
				'Curatorial' => 'Curatorial',
			),
			'default_value' => array(
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
			'placeholder' => '',
		),
		array(
			'key' => 'field_5a3c241337688',
			'label' => 'Past President',
			'name' => 'past_president',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5a4472a8c6a6a',
			'label' => 'Year(s) of Office',
			'name' => 'years_of_office',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5a3c241337688',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5a3c243d37689',
					'label' => 'Start',
					'name' => 'years_of_office_start',
					'type' => 'dynamic_year_select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_5a3c241337688',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'oldest_year' => array(
						'method' => 'exact',
						'exact_year' => '1959',
						'relative_year' => '20',
						'relative_year_direction' => 'before',
					),
					'newest_year' => array(
						'method' => 'relative',
						'exact_year' => '2017',
						'relative_year' => '0',
						'relative_year_direction' => 'after',
					),
					'current_year' => array(
						'allow' => '0',
						'label' => 'Current',
					),
					'year_step' => 1,
					'order_by' => 'chronological',
				),
				array(
					'key' => 'field_5a4472d1c6a6b',
					'label' => 'End',
					'name' => 'years_of_office_end',
					'type' => 'dynamic_year_select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_5a3c241337688',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'oldest_year' => array(
						'method' => 'exact',
						'exact_year' => '1960',
						'relative_year' => '20',
						'relative_year_direction' => 'before',
					),
					'newest_year' => array(
						'method' => 'relative',
						'exact_year' => '2017',
						'relative_year' => '0',
						'relative_year_direction' => 'after',
					),
					'current_year' => array(
						'allow' => '0',
						'label' => 'Current',
					),
					'year_step' => 1,
					'order_by' => 'chronological',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'current_user_role',
				'operator' => '==',
				'value' => 'administrator',
			),
			array(
				'param' => 'user_form',
				'operator' => '==',
				'value' => 'edit',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5a18c77563147',
	'title' => 'Docents',
	'fields' => array(
		array(
			'key' => 'field_5a18c8501b741',
			'label' => 'Photo',
			'name' => 'photo',
			'type' => 'image',
			'instructions' => '<strong>Profile Photo Tips</strong>: Adding a photograph to your profile is a great way for us to connect with and recognize each other! For consistency, it\'s best if you choose a good quality, portrait-like photo that shows your head and shoulders. If you don\'t have a portrait, you may upload any photograph of yourself &ndash; just keep in mind that the website will automatically center, size and crop it to a vertical rectangular shape. If you do not add a photo of yourself, a generic image will be shown instead. To change your photo, click on Add Photo. Or, you can hover over the top right corner of your photo and choose the Edit icon (pencil) or Delete icon (X).',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5a18c8041b73e',
			'label' => 'Spouse/Partner Name',
			'name' => 'spouse_partner',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5a3a0d7e5ab69',
			'label' => 'Address',
			'name' => 'address',
			'type' => 'address',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'output_type' => 'html',
			'address_layout' => '[[{"id":"street1","label":"Street 1"}],[{"id":"street2","label":"Street 2"}],[{"id":"city","label":"City"},{"id":"state","label":"State"},{"id":"zip","label":"Postal Code"}],[],[]]',
			'address_options' => '{"street1":{"id":"street1","label":"Street 1","defaultValue":"","enabled":true,"cssClass":"street1","separator":""},"street2":{"id":"street2","label":"Street 2","defaultValue":"","enabled":true,"cssClass":"street2","separator":""},"street3":{"id":"street3","label":"Street 3","defaultValue":"","enabled":false,"cssClass":"street3","separator":""},"city":{"id":"city","label":"City","defaultValue":"","enabled":true,"cssClass":"city","separator":","},"state":{"id":"state","label":"State","defaultValue":"","enabled":true,"cssClass":"state","separator":""},"zip":{"id":"zip","label":"Postal Code","defaultValue":"","enabled":true,"cssClass":"zip","separator":""},"country":{"id":"country","label":"Country","defaultValue":"","enabled":false,"cssClass":"country","separator":""}}',
		),
		array(
			'key' => 'field_5a7259d083b43',
			'label' => 'Primary Phone',
			'name' => 'primary_phone_group',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'row',
			'sub_fields' => array(
				array(
					'key' => 'field_5a726094d7c3e',
					'label' => 'Primary Phone',
					'name' => 'primary_phone',
					'type' => 'phone_number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
				),
				array(
					'key' => 'field_5a7260a4d7c3f',
					'label' => 'Type',
					'name' => 'primary_phone_type',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'cell' => 'Cell',
						'home' => 'Home',
						'work' => 'Work',
					),
					'default_value' => array(
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
			),
		),
		array(
			'key' => 'field_5a726abfc1f5c',
			'label' => 'Alternate Phone',
			'name' => 'alternate1_phone_group',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'row',
			'sub_fields' => array(
				array(
					'key' => 'field_5a726abfc1f5d',
					'label' => 'Alternate Phone 1',
					'name' => 'alternate1_phone',
					'type' => 'phone_number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
				),
				array(
					'key' => 'field_5a726abfc1f5e',
					'label' => 'Type',
					'name' => 'alternate1_phone_type',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'cell' => 'Cell',
						'home' => 'Home',
						'work' => 'Work',
					),
					'default_value' => array(
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
			),
		),
		array(
			'key' => 'field_5a726b2177e28',
			'label' => 'Alternate Phone',
			'name' => 'alternate2_phone_group',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'row',
			'sub_fields' => array(
				array(
					'key' => 'field_5a726b2177e29',
					'label' => 'Alternate Phone 2',
					'name' => 'alternate2_phone',
					'type' => 'phone_number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
				),
				array(
					'key' => 'field_5a726b2177e2a',
					'label' => 'Type',
					'name' => 'alternate2_phone_type',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'cell' => 'Cell',
						'home' => 'Home',
						'work' => 'Work',
					),
					'default_value' => array(
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
			),
		),
		array(
			'key' => 'field_5a18c86c1b742',
			'label' => 'Tour Types',
			'name' => 'tour_types',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'Public Tours' => 'Public Tours',
				'Object of the Month' => 'Object of the Month',
				'Ask Me Docent' => 'Ask Me Docent',
				'DT Free Family Weekends' => 'DT Free Family Weekends',
				'Arts Engagement (AEP)' => 'Arts Engagement (AEP)',
				'On-Site School Tours / K-12' => 'On-Site School Tours / K-12',
				'On-Site School Tours / College' => 'On-Site School Tours / College',
				'Art All Around Us (AAAU)' => 'Art All Around Us (AAAU)',
				'Art Smart' => 'Art Smart',
				'Off-Site Outreach / Schools' => 'Off-Site Outreach / Schools',
				'Off-Site Outreach / Adults' => 'Off-Site Outreach / Adults',
				'Meet Your Museum (MYM)' => 'Meet Your Museum (MYM)',
			),
			'allow_custom' => 1,
			'save_custom' => 0,
			'default_value' => array(
			),
			'layout' => 'vertical',
			'toggle' => 0,
			'return_format' => 'value',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'current_user_role',
				'operator' => '==',
				'value' => 'docent',
			),
			array(
				'param' => 'user_form',
				'operator' => '==',
				'value' => 'edit',
			),
		),
		array(
			array(
				'param' => 'current_user_role',
				'operator' => '==',
				'value' => 'administrator',
			),
			array(
				'param' => 'user_form',
				'operator' => '==',
				'value' => 'edit',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'field',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;
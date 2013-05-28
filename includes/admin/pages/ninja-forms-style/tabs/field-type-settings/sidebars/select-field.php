<?php

add_action( 'admin_init', 'ninja_forms_register_style_sidebar_select_field' );
function ninja_forms_register_style_sidebar_select_field(){
	global $ninja_forms_fields;
	$args = array(
		'name' => 'Select A Field Type',
		'page' => 'ninja-forms-style',
		'tab' => 'field_type_settings',
		'display_function' => 'ninja_forms_style_sidebar_select_field_display',
		'save_function' => '',
	);

	if( function_exists( 'ninja_forms_register_sidebar' ) ){
		ninja_forms_register_sidebar('select_subs', $args);
	}
	
}

function ninja_forms_style_sidebar_select_field_display(){
	$args = array();
	if( isset( $_REQUEST['field_type'] ) ){
		$args['selected'] = $_REQUEST['field_type'];
	}
	ninja_forms_field_type_dropdown( $args );
}
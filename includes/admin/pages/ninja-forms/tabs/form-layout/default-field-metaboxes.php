<?php

add_action( 'init', 'ninja_forms_style_default_metaboxes' );
function ninja_forms_style_default_metaboxes(){
	$args = array(
		'page' => 'field',
		'tab' => 'form_layout',
		'slug' => 'wrap',
		'title' => __( 'Wrap Styles', 'ninja-forms-style' ),
		'state' => 'closed',
		'display_function' => 'ninja_forms_style_field_metabox_output',
		'save_page' => 'field',
		'css_selector' => '#ninja_forms_field_[field_id]_div_wrap',
		'css_exclude' => array( 'float', 'padding', 'margin' ),
	);
	ninja_forms_register_style_metabox( 'wrap', $args );

	$args = array(
		'page' => 'field',
		'tab' => 'form_layout',
		'slug' => 'label',
		'title' => __( 'Label Styles', 'ninja-forms-style' ),
		'state' => 'closed',
		'display_function' => 'ninja_forms_style_field_metabox_output',
		'save_page' => 'field',
		'css_selector' => '#ninja_forms_field_[field_id]_label',
		'css_exclude' => array( 'float', 'padding', 'margin' ),
	);
	ninja_forms_register_style_metabox( 'label', $args );

	$args = array(
		'page' => 'field',
		'tab' => 'form_layout',
		'slug' => 'field',
		'title' => __( 'Element Styles', 'ninja-forms-style' ),
		'state' => 'closed',
		'display_function' => 'ninja_forms_style_field_metabox_output',
		'save_page' => 'field',
		'css_selector' => '#ninja_forms_field_[field_id]',
		'css_exclude' => array( 'float', 'padding', 'margin' ),
	);
	ninja_forms_register_style_metabox( 'field', $args );		

}
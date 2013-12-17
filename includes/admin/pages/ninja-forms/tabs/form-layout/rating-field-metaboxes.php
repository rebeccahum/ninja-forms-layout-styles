<?php

add_action( 'init', 'ninja_forms_style_rating_metaboxes' );
function ninja_forms_style_rating_metaboxes(){
	add_action( 'ninja_forms_style_field_metaboxes', 'ninja_forms_style_modify_rating_metaboxes' );
	if( is_admin() ){
		ninja_forms_style_add_rating_metaboxes();
	}
}

function ninja_forms_style_modify_rating_metaboxes( $field_id ){

	$field_row = ninja_forms_get_field_by_id( $field_id );
	$field_type = $field_row['type'];
	$field_data = $field_row['data'];
	if( $field_type == '_rating' ){
		$args = array( 'field_type' => '_rating' );
		ninja_forms_unregister_style_metabox( 'field', $args );
		ninja_forms_style_add_rating_metaboxes();
	}

}

function ninja_forms_style_add_rating_metaboxes(){
	$args = array(
		'page' => 'field',
		'tab' => 'form_layout',
		'slug' => 'rating_item_row_field',
		'field_type' => '_rating',
		'title' => __( 'rating Item Row', 'ninja-forms-style' ),
		'state' => 'closed',
		'display_function' => 'ninja_forms_style_field_metabox_output',
		'save_page' => 'field',
		'css_selector' => '#ninja_forms_field_[field_id]_div_wrap ul li',
		//'css_exclude' => array( 'float', 'padding', 'margin' ),
	);

	ninja_forms_register_style_metabox( 'rating_item_row_field', $args );		

	$args = array(
		'page' => 'field',
		'tab' => 'form_layout',
		'slug' => 'rating_item_label_field',
		'field_type' => '_rating',
		'title' => __( 'rating Item Label', 'ninja-forms-style' ),
		'state' => 'closed',
		'display_function' => 'ninja_forms_style_field_metabox_output',
		'save_page' => 'field',
		'css_selector' => '#ninja_forms_field_[field_id]_div_wrap ul li label',
		//'css_exclude' => array( 'float', 'padding', 'margin' ),
	);

	ninja_forms_register_style_metabox( 'rating_item_label_field', $args );

	$args = array(
		'page' => 'field',
		'tab' => 'form_layout',
		'slug' => 'rating_item_element_field',
		'field_type' => '_rating',
		'title' => __( 'rating Item Element', 'ninja-forms-style' ),
		'state' => 'closed',
		'display_function' => 'ninja_forms_style_field_metabox_output',
		'save_page' => 'field',
		'css_selector' => '#ninja_forms_field_[field_id]_div_wrap ul li input',
		//'css_exclude' => array( 'float', 'padding', 'margin' ),
	);

	ninja_forms_register_style_metabox( 'rating_item_element_field', $args );
}
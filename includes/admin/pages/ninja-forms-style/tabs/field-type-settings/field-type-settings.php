<?php

add_action( 'init', 'ninja_forms_register_tab_style_field_type_settings' );
function ninja_forms_register_tab_style_field_type_settings(){
	$args = array(
		'name' => __( 'Field Type Styles', 'ninja-forms-style' ),
		'page' => 'ninja-forms-style',
		'display_function' => 'ninja_forms_style_advanced_checkbox_display',
		'save_function' => 'ninja_forms_save_style_field_type_settings',
		'show_save' => true,
	);
	if( !isset( $_REQUEST['field_type'] ) OR $_REQUEST['field_type'] == '' ){
		$args['show_save'] = false;
		unset( $args['display_function'] );
	}
	if( function_exists( 'ninja_forms_register_tab' ) ){
		ninja_forms_register_tab( 'field_type_settings', $args );
	}
}

add_action( 'init', 'ninja_forms_register_style_field_type_metaboxes', 1001 );
function ninja_forms_register_style_field_type_metaboxes(){

	if( is_admin() ){
		if( isset( $_REQUEST['field_type'] ) AND $_REQUEST['field_type'] != '' ) {
			if( $_REQUEST['field_type'] != '_hr' ) {
				$args = array(
					'page' => 'ninja-forms-style',
					'tab' => 'field_type_settings',
					'slug' => 'wrap',
					'title' => __( 'Wrap Styles', 'ninja-forms-style' ),
					'state' => 'closed',
					'display_function' => 'ninja_forms_style_field_type_wrap_display',
					'save_page' => 'field_type',
					'css_selector' => 'div.[type_slug]-wrap',
				);

				if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
					ninja_forms_register_tab_metabox($args);
				}

				$args = array(
					'page' => 'ninja-forms-style',
					'tab' => 'field_type_settings',
					'slug' => 'label',
					'title' => __( 'Label Styles', 'ninja-forms-style' ),
					'state' => 'closed',
					'display_function' => 'ninja_forms_style_field_type_label_display',
					'save_page' => 'field_type',
					'css_selector' => 'div.[type_slug]-wrap label',
				);

				if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
					ninja_forms_register_tab_metabox($args);
				}

				$args = array(
					'page' => 'ninja-forms-style',
					'tab' => 'field_type_settings',
					'slug' => 'field',
					'title' => __( 'Element Styles', 'ninja-forms-style'),
					'state' => 'closed',
					'display_function' => 'ninja_forms_style_field_type_field_display',
					'save_page' => 'field_type',
					'css_selector' => 'div.[type_slug]-wrap .ninja-forms-field',
				);
			}

			if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
				ninja_forms_register_tab_metabox($args);
			}

			if( $_REQUEST['field_type'] == '_hr' ){
				$args = array(
					'page' => 'ninja-forms-style',
					'tab' => 'field_type_settings',
					'slug' => 'hr-element',
					'title' => __( 'HR Element', 'ninja-forms-style'),
					'state' => 'closed',
					'display_function' => 'ninja_forms_style_field_type_field_display',
					'save_page' => 'field_type',
					'css_selector' => 'hr.ninja-forms-field',
				);
				if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
					ninja_forms_register_tab_metabox($args);
				}
			}

			if( $_REQUEST['field_type'] == '_list-radio' || $_REQUEST['field_type'] == '_list-checkbox' ){
				$args = array(
					'page' => 'ninja-forms-style',
					'tab' => 'field_type_settings',
					'slug' => 'list-item-row',
					'title' => __( 'List Item Row', 'ninja-forms-style'),
					'state' => 'closed',
					'display_function' => 'ninja_forms_style_field_type_field_display',
					'save_page' => 'field_type',
					'css_selector' => 'div.[type_slug]-wrap ul li',
				);
				if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
					ninja_forms_register_tab_metabox($args);
				}

				$args = array(
					'page' => 'ninja-forms-style',
					'tab' => 'field_type_settings',
					'slug' => 'list-item-label',
					'title' => __( 'List Item Label', 'ninja-forms-style'),
					'state' => 'closed',
					'display_function' => 'ninja_forms_style_field_type_field_display',
					'save_page' => 'field_type',
					'css_selector' => 'div.[type_slug]-wrap ul li label',
				);
				if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
					ninja_forms_register_tab_metabox($args);
				}

				$args = array(
					'page' => 'ninja-forms-style',
					'tab' => 'field_type_settings',
					'slug' => 'list-item-element',
					'title' => __( 'List Item Element', 'ninja-forms-style'),
					'state' => 'closed',
					'display_function' => 'ninja_forms_style_field_type_field_display',
					'save_page' => 'field_type',
					'css_selector' => 'div.[type_slug]-wrap ul li input',
				);
				if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
					ninja_forms_register_tab_metabox($args);
				}
			}

			if( $_REQUEST['field_type'] == '_submit' ){
				$args = array(
					'page' => 'ninja-forms-style',
					'tab' => 'field_type_settings',
					'slug' => 'submit-hover',
					'title' => __( 'Element Hover Styles', 'ninja-forms-style'),
					'state' => 'closed',
					'display_function' => 'ninja_forms_style_field_type_field_display',
					'save_page' => 'field_type',
					'css_selector' => 'submit_hover',
				);
				if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
					ninja_forms_register_tab_metabox($args);
				}
			}
		}
	}else{
		$args = array(
			'page' => 'ninja-forms-style',
			'tab' => 'field_type_settings',
			'slug' => 'wrap',
			'title' => __( 'Wrap Styles', 'ninja-forms-style' ),
			'state' => 'closed',
			'display_function' => 'ninja_forms_style_field_type_wrap_display',
			'save_page' => 'field_type',
			'css_selector' => 'div.[type_slug]-wrap',
		);

		if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
			ninja_forms_register_tab_metabox($args);
		}

		$args = array(
			'page' => 'ninja-forms-style',
			'tab' => 'field_type_settings',
			'slug' => 'label',
			'title' => __( 'Label Styles', 'ninja-forms-style' ),
			'state' => 'closed',
			'display_function' => 'ninja_forms_style_field_type_label_display',
			'save_page' => 'field_type',
			'css_selector' => 'div.[type_slug]-wrap label',
		);

		if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
			ninja_forms_register_tab_metabox($args);
		}

		$args = array(
			'page' => 'ninja-forms-style',
			'tab' => 'field_type_settings',
			'slug' => 'field',
			'title' => __( 'Element Styles', 'ninja-forms-style'),
			'state' => 'closed',
			'display_function' => 'ninja_forms_style_field_type_field_display',
			'save_page' => 'field_type',
			'css_selector' => 'div.[type_slug]-wrap .ninja-forms-field',
		);

		if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
			ninja_forms_register_tab_metabox($args);
		}

		$args = array(
			'page' => 'ninja-forms-style',
			'tab' => 'field_type_settings',
			'slug' => 'list-item-row',
			'title' => __( 'List Item Row', 'ninja-forms-style'),
			'state' => 'closed',
			'display_function' => 'ninja_forms_style_field_type_field_display',
			'save_page' => 'field_type',
			'css_selector' => 'div.[type_slug]-wrap ul li',
		);
		if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
			ninja_forms_register_tab_metabox($args);
		}

		$args = array(
			'page' => 'ninja-forms-style',
			'tab' => 'field_type_settings',
			'slug' => 'list-item-label',
			'title' => __( 'List Item Label', 'ninja-forms-style'),
			'state' => 'closed',
			'display_function' => 'ninja_forms_style_field_type_field_display',
			'save_page' => 'field_type',
			'css_selector' => 'div.[type_slug]-wrap ul li label',
		);
		if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
			ninja_forms_register_tab_metabox($args);
		}

		$args = array(
			'page' => 'ninja-forms-style',
			'tab' => 'field_type_settings',
			'slug' => 'list-item-element',
			'title' => __( 'List Item Element', 'ninja-forms-style'),
			'state' => 'closed',
			'display_function' => 'ninja_forms_style_field_type_field_display',
			'save_page' => 'field_type',
			'css_selector' => 'div.[type_slug]-wrap ul li input',
		);
		if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
			ninja_forms_register_tab_metabox($args);
		}

		$args = array(
			'page' => 'ninja-forms-style',
			'tab' => 'field_type_settings',
			'slug' => 'submit-hover',
			'title' => __( 'Element Hover Styles', 'ninja-forms-style'),
			'state' => 'closed',
			'display_function' => 'ninja_forms_style_field_type_field_display',
			'save_page' => 'field_type',
			'css_selector' => 'submit_hover',
		);
		if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
			ninja_forms_register_tab_metabox($args);
		}

		$args = array(
			'page' => 'ninja-forms-style',
			'tab' => 'field_type_settings',
			'slug' => 'hr-element',
			'title' => __( 'HR Element', 'ninja-forms-style'),
			'state' => 'closed',
			'display_function' => 'ninja_forms_style_field_type_field_display',
			'save_page' => 'field_type',
			'css_selector' => 'hr.ninja-forms-field',
		);
		if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
			ninja_forms_register_tab_metabox($args);
		}
	}
}

function ninja_forms_style_field_type_wrap_display( $metabox ){
	if( isset( $_REQUEST['field_type'] ) AND $_REQUEST['field_type'] != '' ){
		$field_type = $_REQUEST['field_type'];
		$metabox['field_type'] = $field_type;
		ninja_forms_style_metabox_output( $metabox );
	}else{
		$field_type = '';
	}
}

function ninja_forms_style_field_type_label_display( $metabox ){
	if( isset( $_REQUEST['field_type'] ) AND $_REQUEST['field_type'] != '' ){
		$field_type = $_REQUEST['field_type'];
		$metabox['field_type'] = $field_type;
		ninja_forms_style_metabox_output( $metabox );
	}else{
		$field_type = '';
	}
}

function ninja_forms_style_field_type_field_display( $metabox ){
	if( isset( $_REQUEST['field_type'] ) AND $_REQUEST['field_type'] != '' ){
		$field_type = $_REQUEST['field_type'];
		$metabox['field_type'] = $field_type;
		ninja_forms_style_metabox_output( $metabox );
	}else{
		$field_type = '';
	}
}

function ninja_forms_save_style_field_type_settings( $data ){
	$plugin_settings = get_option( 'ninja_forms_settings' );
	$tmp_array = array();
	$field_type = $data['field_type'];
	unset( $data['field_type'] );

	$plugin_settings['style']['field_type'][$field_type] = $data;

	update_option( 'ninja_forms_settings', $plugin_settings);
}
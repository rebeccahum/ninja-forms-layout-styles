<?php

function ninja_forms_register_css_option( $slug, $args ){
	global $ninja_forms_css_options;

	if( is_array( $args ) AND !empty( $args ) ){
		foreach( $args as $key => $val ){
			$ninja_forms_css_options[$slug][$key] = $val;
		}
	}
}

function ninja_forms_register_style_metabox( $slug, $args ){
	global $ninja_forms_style_metaboxes;

	if( isset( $args['field_type'] ) AND $args['field_type'] != '' ){
		$field_type = $args['field_type'];
		$ninja_forms_style_metaboxes['field'][$field_type][$slug] = $args;
	}else{
		$page = $args['page'];
		$ninja_forms_style_metaboxes['page'][$page][$slug] = $args;
	}
}

function ninja_forms_unregister_style_metabox( $slug, $args ){
	global $ninja_forms_style_metaboxes;

	if( isset( $args['field_type'] ) AND $args['field_type'] != '' ){
		$field_type = $args['field_type'];
		unset( $ninja_forms_style_metaboxes['field'][$field_type][$slug] );
	}else{
		$page = $args['page'];
		unset( $ninja_forms_style_metaboxes['page'][$page][$slug] );
	}
}

function ninja_forms_register_css_options( $args ){
	global $ninja_forms_css_options;

	if( is_array( $args ) AND !empty( $args ) ){

		if( !isset( $args['css_property'] ) ){
			$args['css_property'] = '';
		}

		if( !isset( $args['group'] ) OR $args['group'] == '' ){
			$args['group'] = 'basic';
		}

		foreach( $args as $arg ){
			if( is_array( $arg ) ){
				foreach( $arg as $key => $val ){
					if( $key == 'name' ){
						$name = $val;
					}else{
						$ninja_forms_css_options[$name][$key] = $val;
					}
				}
			}
		}
	}
}

add_action( 'init', 'ninja_forms_css_options', 9 );
function ninja_forms_css_options(){
	$args = array(
		array(
			'name' => 'background-color',
			'type' => 'text',
			'label' => __( 'Background Color', 'ninja-forms' ),
			'desc' => '',
			'class' => 'color-picker',
			'group' => 'basic',
			'css_property' => 'background',
		),
		array(
			'name' => 'border',
			'type' => 'text',
			'label' => __( 'Border Width', 'ninja-forms' ),
			'group' => 'basic',
			'css_property' => 'border-width',
		),
		array(
			'name' => 'border-style',
			'type' => 'select',
			'options' => array(
				array( 'name' => '- None', 'value' => '' ),
				array( 'name' => 'Solid', 'value' => 'solid' ),
				array( 'name' => 'Dashed', 'value' => 'dashed' ),
				array( 'name' => 'Dotted', 'value' => 'dotted' ),
			),
			'label' => __( 'Border Style', 'ninja-forms' ),
			'desc' => '',
			'group' => 'basic',
			'css_property' => 'border-style',
		),
		array(
			'name' => 'border-color',
			'type' => 'text',
			'label' => __( 'Border Color', 'ninja-forms' ),
			'desc' => '',
			'class' => 'color-picker',
			'group' => 'basic',
			'css_property' => 'border-color',
		),
		array(
			'name' => 'color',
			'type' => 'text',
			'label' => __( 'Text Color', 'ninja-forms' ),
			'class' => 'color-picker',
			'group' => 'basic',
			'css_property' => 'color',
		),
		array(
			'name' => 'height',
			'type' => 'text',
			'label' => __( 'Height', 'ninja-forms' ),
			'group' => 'basic',
			'css_property' => 'height',
		),
		array(
			'name' => 'width',
			'type' => 'text',
			'label' => __( 'Width', 'ninja-forms' ),
			'group' => 'basic',
			'css_property' => 'width',
		),
		array(
			'name' => 'float',
			'type' => 'text',
			'label' => __( 'Float', 'ninja-forms' ),
			'group' => 'advanced',
			'css_property' => 'float',
		),
		array(
			'name' => 'font-size',
			'type' => 'text',
			'label' => __( 'Font Size', 'ninja-forms-style' ),
			'group' => 'advanced',
			'css_property' => 'font-size',
		),
		array(
			'name' => 'margin',
			'type' => 'text',
			'label' => __( 'Margin', 'ninja-forms' ),
			'group' => 'advanced',
			'css_property' => 'margin',
		),
		array(
			'name' => 'padding',
			'type' => 'text',
			'label' => __( 'Padding', 'ninja-forms' ),
			'group' => 'advanced',
			'css_property' => 'padding',
		),
		array(
			'name' => 'advanced',
			'type' => 'textarea',
			'label' => 'Advanced CSS',
			'group' => 'advanced',
			'class' => 'ninja-custom-css',
			'css_property' => '',
		),
	);
	ninja_forms_register_css_options( $args );
}
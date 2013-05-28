<?php

add_action( 'admin_init', 'ninja_forms_style_admin_js' );
function ninja_forms_style_admin_js(){
	global $wp_version;
	if( isset( $_REQUEST['page'] ) AND ( $_REQUEST['page'] == 'ninja-forms-style' OR ( $_REQUEST['page'] == 'ninja-forms' AND ( isset( $_REQUEST['tab'] ) AND $_REQUEST['tab'] == 'form_layout' ) ) ) ){
		if( version_compare( $wp_version, '3.5', '<' ) ){

			wp_enqueue_script( 'iris',
				NINJA_FORMS_STYLE_URL .'/js/min/iris.min.js', array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ) );

			wp_enqueue_script( 'wp-color-picker',
				NINJA_FORMS_STYLE_URL .'/js/min/color-picker.min.js' );

			wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', array(
				'clear' => __( 'Clear' ),
				'defaultString' => __( 'Default' ),
				'pick' => __( 'Select Color' ),
				'current' => __( 'Current Color' ),
				) );
		}else{
			wp_enqueue_script( 'wp-color-picker' );
		}
		wp_enqueue_script( 'ninja-forms-style-admin',
			NINJA_FORMS_STYLE_URL .'/js/min/ninja-forms-style-admin.min.js',
			array( 'jquery', 'jquery-ui-dialog', 'jquery-ui-sortable' ) );
	}
}

add_action( 'admin_init', 'ninja_forms_style_admin_css' );
function ninja_forms_style_admin_css(){
	global $wp_version;

	if( isset( $_REQUEST['page'] ) AND ( $_REQUEST['page'] == 'ninja-forms' OR $_REQUEST['page'] == 'ninja-forms-style' ) ){
		if( version_compare( $wp_version, '3.5', '<' ) ){
			wp_enqueue_style( 'wp-color-picker',
				NINJA_FORMS_STYLE_URL.'/css/color-picker.min.css' );
		}else{
			wp_enqueue_style( 'wp-color-picker' );
		}
		
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_style( 'ninja-forms-style-admin',
			NINJA_FORMS_STYLE_URL.'/css/ninja-forms-style-admin.css' );
	}
}
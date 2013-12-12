<?php

add_action( 'admin_init', 'ninja_forms_style_admin_js' );
function ninja_forms_style_admin_js(){
	global $wp_version;

	if ( defined( 'NINJA_FORMS_JS_DEBUG' ) && NINJA_FORMS_JS_DEBUG ) {
		$suffix = '';
		$src = 'dev';
	} else {
		$suffix = '.min';
		$src = 'min';
	}

	if( isset( $_REQUEST['page'] ) AND ( $_REQUEST['page'] == 'ninja-forms-style' OR ( $_REQUEST['page'] == 'ninja-forms' AND ( isset( $_REQUEST['tab'] ) AND $_REQUEST['tab'] == 'form_layout' ) ) ) ){
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'ninja-forms-style-admin',
			NINJA_FORMS_STYLE_URL .'/js/' . $src .'/ninja-forms-style-admin' . $suffix . '.js',
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
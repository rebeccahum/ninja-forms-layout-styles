<?php
/*
Plugin Name: Ninja Forms - Layout & Styles
Plugin URI: http://ninjaforms.com/downloads/layout-styles/
Description: Form layout and styling add-on for Ninja Forms.
Version: 1.0.5
Author: The WP Ninjas
Author URI: http://ninjaforms.com
*/
global $wpdb;

define("NINJA_FORMS_STYLE_DIR", WP_PLUGIN_DIR."/".basename( dirname( __FILE__ ) ) );
define("NINJA_FORMS_STYLE_URL", plugins_url()."/".basename( dirname( __FILE__ ) ) );
define("NINJA_FORMS_STYLE_VERSION", "1.0.5");


// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
define( 'NINJA_FORMS_STYLE_EDD_SL_STORE_URL', 'http://ninjaforms.com' ); // IMPORTANT: change the name of this constant to something unique to prevent conflicts with other plugins using this system

// the name of your product. This is the title of your product in EDD and should match the download title in EDD exactly
define( 'NINJA_FORMS_STYLE_EDD_SL_ITEM_NAME', 'Layout and Styles' ); // IMPORTANT: change the name of this constant to something unique to prevent conflicts with other plugins using this system

//Require EDD autoupdate file
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	// load our custom updater if it doesn't already exist
	require_once( NINJA_FORMS_STYLE_DIR.'/includes/EDD_SL_Plugin_Updater.php' );
}

$plugin_settings = get_option( 'ninja_forms_settings' );

// retrieve our license key from the DB
if( isset( $plugin_settings['style_license'] ) ){
	$style_license = $plugin_settings['style_license'];
}else{
	$style_license = '';
}

// setup the updater
$edd_updater = new EDD_SL_Plugin_Updater( NINJA_FORMS_STYLE_EDD_SL_STORE_URL, __FILE__, array(
		'version' 	=> NINJA_FORMS_STYLE_VERSION, 		// current version number
		'license' 	=> $style_license, 	// license key (used get_option above to retrieve from DB)
		'item_name'     => NINJA_FORMS_STYLE_EDD_SL_ITEM_NAME, 	// name of this plugin
		'author' 	=> 'WP Ninjas'  // author of this plugin
	)
);

require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/admin.php");

require_once(NINJA_FORMS_STYLE_DIR."/includes/license-option.php");
require_once(NINJA_FORMS_STYLE_DIR."/includes/functions.php");

require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms-style/tabs/form-settings/form-settings.php");

require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms-style/tabs/field-settings/field-settings.php");

require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms-style/tabs/field-type-settings/field-type-settings.php");
require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms-style/tabs/field-type-settings/sidebars/select-field.php");

require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms-style/tabs/error-settings/error-settings.php");

require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms-style/tabs/datepicker-settings/datepicker-settings.php");

require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms-style/tabs/multipart-settings/multipart-settings.php");

require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms/tabs/form-layout/form-layout.php");
require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms/tabs/form-layout/form-layout-div.php");
require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms/tabs/form-layout/form-layout-mp-div.php");
require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms/tabs/form-layout/form-layout-output-ul.php");
require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms/tabs/form-layout/default-field-metaboxes.php");
require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms/tabs/form-layout/list-field-metaboxes.php");

require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/pages/ninja-forms-impexp/tabs/style/impexp-style.php");

require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/ajax.php");
require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/register.php");
require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/scripts.php");
require_once(NINJA_FORMS_STYLE_DIR."/includes/admin/style-metabox-output.php");

require_once(NINJA_FORMS_STYLE_DIR."/includes/display/div-output.php");
require_once(NINJA_FORMS_STYLE_DIR."/includes/display/scripts.php");

/*
register_activation_hook( __FILE__, 'ninja_forms_style_activation' );
*/
<?php if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * Plugin Name: Ninja Forms - Layout & Styles
 * Plugin URI: https://ninjaforms.com/extensions/layout-styles/
 * Description: Form layout and styling add-on for Ninja Forms.
 * Version: 3.0.0
 * Author: The WP Ninjas
 * Author URI: http://ninjaforms.com
 * Text Domain: ninja-forms-layout-styles
 *
 * Copyright 2016 The WP Ninjas.
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 */

define("NINJA_FORMS_STYLE_VERSION", "3.0.0");

if( version_compare( get_option( 'ninja_forms_version', '0.0.0' ), '3.0', '>' ) || get_option( 'ninja_forms_load_deprecated', FALSE ) ) {

    define("NINJA_FORMS_STYLE_DIR", plugin_dir_path( __FILE__ ) . '/deprecated' );
    define("NINJA_FORMS_STYLE_URL", plugin_dir_url( __FILE__ ) . '/deprecated' );

    include 'deprecated/ninja-forms-style.php';

} else {

    include 'layouts/ninja-forms-layouts.php';
    include 'styles/ninja-forms-styles.php';

    add_action( 'admin_init', 'ninja_forms_layout_styles_setup_license' );
    function ninja_forms_layout_styles_setup_license()
    {
        if ( ! class_exists( 'NF_Extension_Updater' ) ) return;

        new NF_Extension_Updater( 'Layout and Styles', NINJA_FORMS_STYLE_VERSION, 'WP Ninjas', __FILE__, 'style' );
    }
}

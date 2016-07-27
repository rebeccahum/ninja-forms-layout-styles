<?php if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * Plugin Name: Ninja Forms - Layout & Styles
 * Plugin URI: https://ninjaforms.com/extensions/layout-styles/
 * Description: Form layout and styling add-on for Ninja Forms.
 * Version: 3.0.1
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

define("NINJA_FORMS_STYLE_VERSION", "3.0.1");

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

add_filter( 'ninja_forms_after_upgrade_settings', 'ninja_forms_layouts_upgrade_form_settings' );
function ninja_forms_layouts_upgrade_form_settings( $data ){
    /*
     * If we're importing an old form that doesn't have any styling information, create a new row for each field.
     */
    if( ! isset( $data[ 'settings' ][ 'style' ] ) && ! isset( $data[ 'settings' ][ 'style' ][ 'cols' ] ) ) {
        $rows = array();
        foreach( $data[ 'fields' ] as $field ) {

            if( ! isset( $field[ 'key' ] ) ){
                $field[ 'key' ] = ltrim( $field[ 'type' ], '_' ) . '_' . $field[ 'id' ];
            }

            if( '_text' == $field[ 'type' ] && isset( $field['data'][ 'datepicker' ] ) && $field['data'][ 'datepicker' ] ){
                $field[ 'key' ] = 'date_' . $field[ 'id' ];
            }

            $rows[] = array(
                'order' => absint( $field[ 'order' ] ),
                'cells' => array(
                    array(
                        'order' => 0,
                        'fields'    => array(
                            $field[ 'key' ]
                        ),
                        'width'     => '100'
                    )
                )
            );
        }
    } else { // We are importing something that already had styling information, so we convert it to 3.0.
        /*
         * Get our number of columns.
         */
        $cols = $data[ 'settings' ][ 'style' ][ 'cols' ];
        /*
         * Try to catch any bad layout errors.
         */
        $rows = array();
        $roworder = 0;
        $coltrack = 0;
        $cells = array();
        $cellorder = 0;

        for ( $i = 0; $i < count( $data[ 'fields' ] ); $i++ ) {
            /*
             * If we don't have a colspan set, it should be equal to our cols.
             */
            if ( ! isset( $data[ 'fields' ][ $i ][ 'data' ][ 'style' ][ 'colspan' ] ) ) {
                $data[ 'fields' ][ $i ][ 'data' ][ 'style' ][ 'colspan' ] = 1;
            }

            /*
             * If our colspan + coltrack is less than or equal to cols, we add this to our cells.
             */
            if ( $data[ 'fields' ][ $i ][ 'data' ][ 'style' ][ 'colspan' ] + $coltrack <= $cols ) {
                
                if( ! isset( $field[ 'key' ] ) ){
                    $data[ 'fields' ][ $i ][ 'key' ] = ltrim( $data[ 'fields' ][ $i ][ 'type' ], '_' ) . '_' . $data[ 'fields' ][ $i ][ 'id' ];
                }

                if( '_text' == $data[ 'fields' ][ $i ][ 'type' ] && isset( $data[ 'fields' ][ $i ]['data'][ 'datepicker' ] ) && $data[ 'fields' ][ $i ]['data'][ 'datepicker' ] ){
                    $data[ 'fields' ][ $i ][ 'key' ] = 'date_' . $data[ 'fields' ][ $i ][ 'id' ];
                }


                $cells[] = array(
                    'order'     => $cellorder,
                    'fields'    => array(
                        $data[ 'fields' ][ $i ][ 'key' ]
                    ),
                    'width'     => $data[ 'fields' ][ $i ][ 'data' ][ 'style' ][ 'colspan' ],
                );
             
                $coltrack += $data[ 'fields' ][ $i ][ 'data' ][ 'style' ][ 'colspan' ];
                $cellorder++;
            } else {

                /*
                 * We're on a new row. We now need to add the previous row, represented by the $cells variable, to our rows array.
                 *
                 * 1) Add any blank cells necessary.
                 * 1) Add the cells to a new row.
                 * 2) Move our $i pointer back one field.
                 * 
                 * We need to add an extra blank cell to make up the difference.
                 */
                $diff = 0;
                foreach( $cells as $cell ) {
                    $diff += $cell[ 'width' ];
                }
                $diff = $cols - $diff;

                if ( 0 != $diff ) {
                    $cells[] = array(
                        'order'     => $cellorder,
                        'fields'    => array(),
                        'width'     => $diff,
                    );
                }

                foreach( $cells as $index => $cell ) {
                    /*
                     * width will be set to the colspan of our initial cell.
                     */
                    switch ( $cols ) {
                        case 2:
                            /*
                             * If we have a colspan of 2, either it's 100%, which is handled above, or 50%.
                             */
                            $cells[ $index ][ 'width' ] = 50;
                            break;
                        
                        case 3:
                            /*
                             * If we have a cols value of 3, either all cells are 33% or one is 75% and the other is 25%.
                             */
                            if ( 1 == $cells[ $index ][ 'width' ] && 2 == count( $cells ) ) {
                                $cells[ $index ][ 'width' ] = 25;
                            } else if ( 2 == $cells[ $index ][ 'width' ] ) {
                                $cells[ $index ][ 'width' ] = 75;
                            } else {
                                $cells[ $index ][ 'width' ] = 33;
                            }

                            break;
                        
                        case 4:
                            /*
                             * If we have a cols value of 4, we can get our percentages with simple math.
                             */
                            $cells[ $index ][ 'width' ] = $cells[ $index ][ 'width' ] / 4 * 100;
                            break;
                    }
                }

                $rows[] = array(
                    'order' => $roworder,
                    'cells' => $cells,
                );
                
                $roworder++;
                $coltrack = 0;
                $cellorder = 0;
                $cells = array();
                $i -= 1;
            }

            if ( $i == count( $data[ 'fields' ] ) - 1 ) {
                /*
                 * We're on a new row. We now need to add the previous row, represented by the $cells variable, to our rows array.
                 *
                 * 1) Add any blank cells necessary.
                 * 1) Add the cells to a new row.
                 * 2) Move our $i pointer back one field.
                 * 
                 * We need to add an extra blank cell to make up the difference.
                 */
                $diff = 0;
                foreach( $cells as $cell ) {
                    $diff += $cell[ 'width' ];
                }
                $diff = $cols - $diff;

                if ( 0 != $diff ) {
                    $cells[] = array(
                        'order'     => $cellorder,
                        'fields'    => array(),
                        'width'     => $diff,
                    );
                }

                foreach( $cells as $index => $cell ) {
                    /*
                     * width will be set to the colspan of our initial cell.
                     */
                    switch ( $cols ) {
                        case 2:
                            /*
                             * If we have a colspan of 2, either it's 100%, which is handled above, or 50%.
                             */
                            $cells[ $index ][ 'width' ] = 50;
                            break;
                        
                        case 3:
                            /*
                             * If we have a cols value of 3, either all cells are 33% or one is 75% and the other is 25%.
                             */
                            if ( 1 == $cells[ $index ][ 'width' ] && 2 == count( $cells ) ) {
                                $cells[ $index ][ 'width' ] = 25;
                            } else if ( 2 == $cells[ $index ][ 'width' ] ) {
                                $cells[ $index ][ 'width' ] = 75;
                            } else {
                                $cells[ $index ][ 'width' ] = 33;
                            }

                            break;
                        
                        case 4:
                            /*
                             * If we have a cols value of 4, we can get our percentages with simple math.
                             */
                            $cells[ $index ][ 'width' ] = $cells[ $index ][ 'width' ] / 4 * 100;
                            break;
                    }
                }

                $rows[] = array(
                    'order' => $roworder,
                    'cells' => $cells,
                );

            }

        } // for field loop
    }

    $data[ 'settings' ][ 'fieldContentsData' ] = $rows;

    return $data;
}

add_filter( 'ninja_forms_upgrade_settings', 'ninja_forms_styles_upgrade_form_settings' );
function ninja_forms_styles_upgrade_form_settings( $data ){

    if( ! isset( $data[ 'settings' ][ 'style' ][ 'groups' ] ) ) return $data;

    foreach( $data[ 'settings' ][ 'style' ][ 'groups' ] as $group => $settings ){

        if( 'field' == $group ) $group = 'element';

        foreach( $settings as $setting => $value ){
            $setting = $group . '_styles_' . $setting;
            $data[ 'settings' ][ $setting ] = $value;
        }
    }

    return $data;
}

add_filter( 'ninja_forms_upgrade_settings', 'ninja_forms_styles_upgrade_plugin_settings' );
function ninja_forms_styles_upgrade_plugin_settings( $data ){
    return $data;
}

add_filter( 'ninja_forms_upgrade_field', 'ninja_forms_styles_upgrade_field_settings' );
function ninja_forms_styles_upgrade_field_settings( $data ){

    if( ! isset( $data[ 'style' ][ 'groups' ] ) ) return $data;

    foreach( $data[ 'style' ][ 'groups' ] as $group => $settings ){

        if( 'field' == $group ) $group = 'element';

        foreach( $settings as $setting => $value ){
            $setting = $group . '_styles_' . $setting;
            $data[ $setting ] = $value;
        }
    }

    unset( $data[ 'style' ] );

    return $data;
}

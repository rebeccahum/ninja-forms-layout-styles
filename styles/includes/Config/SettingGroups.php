<?php

return apply_filters( 'ninja_forms_styles_setting_groups', array(

    /*
    |--------------------------------------------------------------------------
    | Form Styles
    |--------------------------------------------------------------------------
    */

    'form' => array(
        'name' => 'form',
        'label' => __( 'Form Styles', 'ninja-forms-styles' ),
        'sections' => array(
            'container' => array(
                'name' => 'container',
                'label' => __( 'Container Styles', 'ninja-forms-styles' )
            ),
            'title' => array(
                'name' => 'title',
                'label' => __( 'Title Styles', 'ninja-forms-styles' )
            ),
            'required' => array(
                'name' => 'required_message',
                'label' => __( 'Required Message Styles', 'ninja-forms-styles' )
            ),
            'row' => array(
                'name' => 'row',
                'label' => __( 'Row Styles', 'ninja-forms-styles' )
            ),
            'odd_row' => array(
                'name' => 'odd_row',
                'label' => __( 'Odd Row Styles', 'ninja-forms-styles' )
            ),
            'success' => array(
                'name' => 'success',
                'label' => __( 'Success Response Message Styles', 'ninja-forms-styles' )
            ),
        )
    ),

    /*
    |--------------------------------------------------------------------------
    | Field Styles
    |--------------------------------------------------------------------------
    */

    'field' => array(
        'name' => 'field',
        'label' => __( 'Default Field Styles', 'ninja-forms-styles' ),
        'sections' => array(
            'wrap' => array(
                'name' => 'wrap',
                'label' => __( 'Wrap Styles', 'ninja-forms-styles' )
            ),
            'label' => array(
                'name' => 'label',
                'label' => __( 'Label Styles', 'ninja-forms-styles' )
            ),
            'element' => array(
                'name' => 'element',
                'label' => __( 'Element Styles', 'ninja-forms-styles' )
            ),
        )
    ),

    /*
    |--------------------------------------------------------------------------
    | Field Type Styles
    |--------------------------------------------------------------------------
    */

    'field_type' => array(
        'name' => 'field_type',
        'label' => __( 'Field Type Styles', 'ninja-forms-styles' )
    ),

    /*
    |--------------------------------------------------------------------------
    | Error Styles
    |--------------------------------------------------------------------------
    */

    'error' => array(
        'name' => 'error',
        'label' => __( 'Error Styles', 'ninja-forms-styles' ),
        'sections' => array(
            'error_message_wrap' => array(
                'name' => 'error_message_wrap',
                'label' => __( 'Error Message Main Wrap Styles', 'ninja-forms-styles' )
            ),
            'error_field_wrap' => array(
                'name' => 'error_field_wrap',
                'label' => __( 'Error Field Wrap Styles', 'ninja-forms-styles' )
            ),
            'error_label' => array(
                'name' => 'error_label',
                'label' => __( 'Error Label Styles', 'ninja-forms-styles' )
            ),
            'error_element' => array(
                'name' => 'error_element',
                'label' => __( 'Error Element Styles', 'ninja-forms-styles' )
            ),
            'error_message' => array(
                'name' => 'error_message',
                'label' => __( 'Error Message Styles', 'ninja-forms-styles' )
            ),
        )
    ),

    /*
    |--------------------------------------------------------------------------
    | DatePicker Styles
    |--------------------------------------------------------------------------
    */

    'datepicker' => array(
        'name' => 'datepicker',
        'label' => __( 'DatePicker Styles', 'ninja-forms-styles' ),
        'sections' => array(
            'datepicker_container' => array(
                'name' => 'datepicker_container',
                'label' => __( 'DatePicker Container', 'ninja-forms-styles' )
            ),
            'datepicker_header' => array(
                'name' => 'datepicker_header',
                'label' => __( 'DatePicker Header', 'ninja-forms-styles' )
            ),
            'datepicker_week_days' => array(
                'name' => 'datepicker_week_days',
                'label' => __( 'DatePicker Week Days', 'ninja-forms-styles' )
            ),
            'datepicker_days' => array(
                'name' => 'datepicker_days',
                'label' => __( 'DatePicker Days', 'ninja-forms-styles' )
            ),
            'datepicker_prev_link' => array(
                'name' => 'datepicker_prev_link',
                'label' => __( 'DatePicker Previous Link', 'ninja-forms-styles' )
            ),
            'datepicker_next_link' => array(
                'name' => 'datepicker_next_link',
                'label' => __( 'DatePicker Next Link', 'ninja-forms-styles' )
            ),
        )
    ),

));
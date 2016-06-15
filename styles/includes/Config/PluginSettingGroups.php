<?php

return apply_filters( 'ninja_forms_styles_setting_groups', array(

    /*
    |--------------------------------------------------------------------------
    | Form Styles
    |--------------------------------------------------------------------------
    */

    'form_settings' => array(
        'name' => 'form_settings',
        'label' => __( 'Form Styles', 'ninja-forms-layout-styles' ),
        'sections' => array(
            'container' => array(
                'name' => 'container',
                'label' => __( 'Container Styles', 'ninja-forms-layout-styles' ),
                'selector' => '.nf-form-cont'
            ),
            'title' => array(
                'name' => 'title',
                'label' => __( 'Title Styles', 'ninja-forms-layout-styles' ),
                'selector' => '.nf-form-title h3'
            ),
            'required-message' => array(
                'name' => 'required-message',
                'label' => __( 'Required Message Styles', 'ninja-forms-layout-styles' ),
            ),
            'row' => array(
                'name' => 'row',
                'label' => __( 'Row Styles', 'ninja-forms-layout-styles' ),
                'selector' => '.nf-row'
            ),
            'row-odd' => array(
                'name' => 'row-odd',
                'label' => __( 'Odd Row Styles', 'ninja-forms-layout-styles' ),
                'selector' => '.nf-row:nth-child(odd)'
            ),
            'success-msg' => array(
                'name' => 'success-msg',
                'label' => __( 'Success Response Message Styles', 'ninja-forms-layout-styles' ),
                'selector' => '.nf-response-msg'
            ),
        )
    ),

    /*
    |--------------------------------------------------------------------------
    | Field Styles
    |--------------------------------------------------------------------------
    */

    'field_settings' => array(
        'name' => 'field_settings',
        'label' => __( 'Default Field Styles', 'ninja-forms-layout-styles' ),
        'sections' => array(
            'wrap' => array(
                'name' => 'wrap',
                'label' => __( 'Wrap Styles', 'ninja-forms-layout-styles' ),
                'selector' => '.nf-fields .nf-field-container .field-wrap'
            ),
            'label' => array(
                'name' => 'label',
                'label' => __( 'Label Styles', 'ninja-forms-layout-styles' ),
                'selector' => '.nf-fields .nf-field-label label'
            ),
            'element' => array(
                'name' => 'element',
                'label' => __( 'Element Styles', 'ninja-forms-layout-styles' ),
                'selector' => '.nf-fields .nf-field-element .ninja-forms-field'
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
        'label' => __( 'Field Type Styles', 'ninja-forms-layout-styles' ),
        'sections' => array(),
        'selector' => '.nf-fields .nf-field-container.{field-type}-container'
    ),

    /*
    |--------------------------------------------------------------------------
    | Error Styles
    |--------------------------------------------------------------------------
    */

    'error' => array(
        'name' => 'error',
        'label' => __( 'Error Styles', 'ninja-forms-layout-styles' ),
        'sections' => array(
            'error_message_wrap' => array(
                'name' => 'error_message_wrap',
                'label' => __( 'Error Message Main Wrap Styles', 'ninja-forms-layout-styles' ),
                'selector' => '.nf-after-fields .nf-form-errors .nf-error-msg'
            ),
            'error_field_wrap' => array(
                'name' => 'error_field_wrap',
                'label' => __( 'Error Field Wrap Styles', 'ninja-forms-layout-styles' )
            ),
            'error_label' => array(
                'name' => 'error_label',
                'label' => __( 'Error Label Styles', 'ninja-forms-layout-styles' )
            ),
            'error_element' => array(
                'name' => 'error_element',
                'label' => __( 'Error Element Styles', 'ninja-forms-layout-styles' )
            ),
            'error_message' => array(
                'name' => 'error_message',
                'label' => __( 'Error Message Styles', 'ninja-forms-layout-styles' )
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
        'label' => __( 'DatePicker Styles', 'ninja-forms-layout-styles' ),
        'sections' => array(
            'datepicker_container' => array(
                'name' => 'datepicker_container',
                'label' => __( 'DatePicker Container', 'ninja-forms-layout-styles' ),
                'selector' => 'html body .pika-single'
            ),
            'datepicker_header' => array(
                'name' => 'datepicker_header',
                'label' => __( 'DatePicker Header', 'ninja-forms-layout-styles' ),
                'selector' => 'html body .pika-title'
            ),
            'datepicker_week_days' => array(
                'name' => 'datepicker_week_days',
                'label' => __( 'DatePicker Week Days', 'ninja-forms-layout-styles' ),
                'selector' => 'html body .pika-single th'
            ),
            'datepicker_days' => array(
                'name' => 'datepicker_days',
                'label' => __( 'DatePicker Days', 'ninja-forms-layout-styles' ),
                'selector' => 'html body .pika-button'
            ),
            'datepicker_days_hover' => array(
                'name' => 'datepicker_days_hover',
                'label' => __( 'DatePicker Day Hover', 'ninja-forms-layout-styles' ),
                'selector' => 'html body .pika-single .pika-button:hover'
            ),
            'datepicker_today' => array(
                'name' => 'datepicker_today',
                'label' => __( 'DatePicker Today', 'ninja-forms-layout-styles' ),
                'selector' => 'html body .is-today .pika-button'
            ),
            'datepicker_selected' => array(
                'name' => 'datepicker_selected',
                'label' => __( 'DatePicker Selected', 'ninja-forms-layout-styles' ),
                'selector' => 'html body .is-selected .pika-button'
            ),
            'datepicker_prev_link' => array(
                'name' => 'datepicker_prev_link',
                'label' => __( 'DatePicker Previous Link', 'ninja-forms-layout-styles' ),
                'selector' => 'html body .pika-prev'
            ),
            'datepicker_next_link' => array(
                'name' => 'datepicker_next_link',
                'label' => __( 'DatePicker Next Link', 'ninja-forms-layout-styles' ),
                'selector' => 'html body .pika-next'
            ),
        )
    ),

));

<?php

return apply_filters( 'ninja_forms_styles_common_settings', array(

    /*
    |--------------------------------------------------------------------------
    | Background Color
    |--------------------------------------------------------------------------
    */

    'background-color' => array(
        'name' => 'background-color',
        'type' => 'color',
        'label' => __( 'Background Color', 'ninja-forms-styles' ),
        'width' => 'full',
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Border Width
    |--------------------------------------------------------------------------
    */

    'border' => array(
        'name' => 'border',
        'type' => 'textbox',
        'label' => __( 'Border Width', 'ninja-forms-styles' ),
        'width' => 'one-half',
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Border Style
    |--------------------------------------------------------------------------
    */

    'border-style' => array(
        'name' => 'border-style',
        'type' => 'select',
        'label' => __( 'Border Style', 'ninja-forms-styles' ),
        'width' => 'one-half',
        'value' => '',
        'options' => array(
            array(
                'label' => '- ' . __( 'None', 'ninja-forms-styles' ),
                'value' => ''
            ),
            array(
                'label' =>  __( 'Solid', 'ninja-forms-styles' ),
                'value' => 'solid'
            ),
            array(
                'label' =>  __( 'Dashed', 'ninja-forms-styles' ),
                'value' => 'dashed'
            ),
            array(
                'label' =>  __( 'Dotted', 'ninja-forms-styles' ),
                'value' => 'dotted'
            ),
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Border Color
    |--------------------------------------------------------------------------
    */

    'border-color' => array(
        'name' => 'border-color',
        'type' => 'color',
        'label' => __( 'Border Color', 'ninja-forms-styles' ),
        'width' => 'one-half',
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Text Color
    |--------------------------------------------------------------------------
    */

    'color' => array(
        'name' => 'color',
        'type' => 'color',
        'label' => __( 'Text Color', 'ninja-forms-styles' ),
        'width' => 'one-half',
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Height
    |--------------------------------------------------------------------------
    */

    'height' => array(
        'name' => 'height',
        'type' => 'textbox',
        'label' => __( 'Height', 'ninja-forms-styles' ),
        'width' => 'one-half',
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Width
    |--------------------------------------------------------------------------
    */

    'width' => array(
        'name' => 'width',
        'type' => 'textbox',
        'label' => __( 'Width', 'ninja-forms-styles' ),
        'width' => 'one-half',
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Font Size
    |--------------------------------------------------------------------------
    */

    'font-size' => array(
        'name' => 'font-size',
        'type' => 'textbox',
        'label' => __( 'Font Size', 'ninja-forms-styles' ),
        'width' => 'one-half',
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Margin
    |--------------------------------------------------------------------------
    */

    'margin' => array(
        'name' => 'margin',
        'type' => 'textbox',
        'label' => __( 'Margin', 'ninja-forms-styles' ),
        'width' => 'one-half',
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Padding
    |--------------------------------------------------------------------------
    */

    'padding' => array(
        'name' => 'padding',
        'type' => 'textbox',
        'label' => __( 'Padding', 'ninja-forms-styles' ),
        'width' => 'one-half',
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Display
    |--------------------------------------------------------------------------
    */

    'display' => array(
        'name' => 'display',
        'type' => 'select',
        'label' => __( 'Display', 'ninja-forms-styles' ),
        'width' => 'one-half',
        'value' => '',
        'options' => array(
            array(
                'label' => '- ' . __( 'Default', 'ninja-forms-styles' ),
                'value' => ''
            ),
            array(
                'label' =>  __( 'Block', 'ninja-forms-styles' ),
                'value' => 'block'
            ),
            array(
                'label' =>  __( 'Inline', 'ninja-forms-styles' ),
                'value' => 'inline'
            ),
            array(
                'label' =>  __( 'Inline Block', 'ninja-forms-styles' ),
                'value' => 'inline-block'
            ),
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Float
    |--------------------------------------------------------------------------
    */

    'float' => array(
        'name' => 'float',
        'type' => 'textbox',
        'label' => __( 'Float', 'ninja-forms-styles' ),
        'width' => 'one-half',
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Advanced
    |--------------------------------------------------------------------------
    */

    'show_advanced_css' => array(
        'name' => 'show_advanced_css',
        'type' => 'toggle',
        'label' => __( 'Show Advanced CSS Properties', 'ninja-forms-styles' ),
        'width' => 'full',
        'value' => 0
    ),

    'advanced' => array(
        'name' => 'advanced',
        'type' => 'textarea',
        'label' => __( 'Advanced CSS', 'ninja-forms-styles' ),
        'value' => '',
        'width' => 'full',
        'deps' => array(
            'show_advanced_css' => 1
        )
    ),

));
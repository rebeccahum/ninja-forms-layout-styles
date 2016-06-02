<?php

return apply_filters( 'ninja_forms_styles_common_settings', array(

    /*
    |--------------------------------------------------------------------------
    | Background Color
    |--------------------------------------------------------------------------
    */

    'background_color' => array(
        'name' => 'background_color',
        'type' => 'color',
        'label' => __( 'Background Color', 'ninja-forms-styles' ),
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Border Width
    |--------------------------------------------------------------------------
    */

    'border_width' => array(
        'name' => 'border_width',
        'type' => 'textbox',
        'label' => __( 'Border Width', 'ninja-forms-styles' ),
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Border Style
    |--------------------------------------------------------------------------
    */

    'border_style' => array(
        'name' => 'border_style',
        'type' => 'select',
        'label' => __( 'Border Style', 'ninja-forms-styles' ),
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

    'border_color' => array(
        'name' => 'border_color',
        'type' => 'color',
        'label' => __( 'Border Color', 'ninja-forms-styles' ),
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Text Color
    |--------------------------------------------------------------------------
    */

    'text_color' => array(
        'name' => 'text_color',
        'type' => 'color',
        'label' => __( 'Text Color', 'ninja-forms-styles' ),
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
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Font Size
    |--------------------------------------------------------------------------
    */

    'font_size' => array(
        'name' => 'font_size',
        'type' => 'textbox',
        'label' => __( 'Font Size', 'ninja-forms-styles' ),
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
        'value' => '',
    ),

    /*
    |--------------------------------------------------------------------------
    | Advanced
    |--------------------------------------------------------------------------
    */

    'advanced' => array(
        'name' => 'advanced',
        'type' => 'textarea',
        'label' => __( 'Advanced CSS', 'ninja-forms-styles' ),
        'value' => '',
    ),

));
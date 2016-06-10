<?php

return array(

    'container_styles' => array(
        'name' => 'container_styles',
        'type' => 'fieldset',
        'label' => __( 'Container Styles', 'ninja-forms-layout-styles' ),
        'width' => 'full',
        'selector' => '#nf-form-{ID}-cont'
    ),

    'title_styles' => array(
        'name' => 'title_styles',
        'type' => 'fieldset',
        'label' => __( 'Title Styles', 'ninja-forms-layout-styles' ),
        'width' => 'full',
        'selector' => '#nf-form-{ID}-cont .nf-form-title h3'
    ),

    'row_styles' => array(
        'name' => 'row_styles',
        'type' => 'fieldset',
        'label' => __( 'Row Styles', 'ninja-forms-layout-styles' ),
        'width' => 'full',
        'selector' => '#nf-form-{ID}-cont .nf-row'
    ),

    'odd_row_styles' => array(
        'name' => 'odd_row_styles',
        'type' => 'fieldset',
        'label' => __( 'Odd Row Styles', 'ninja-forms-layout-styles' ),
        'width' => 'full',
        'selector' => '#nf-form-{ID}-cont .nf-row:nth-child(odd)'
    ),

    'success_styles' => array(
        'name' => 'success_styles',
        'type' => 'fieldset',
        'label' => __( 'Success Response Message Styles', 'ninja-forms-layout-styles' ),
        'width' => 'full',
        'selector' => '#nf-form-{ID}-cont .nf-response-msg'
    ),

    'error_styles' => array(
        'name' => 'error_styles',
        'type' => 'fieldset',
        'label' => __( 'Error Response Message Styles', 'ninja-forms-layout-styles' ),
        'width' => 'full',
        'selector' => '#nf-form-{ID}-cont .nf-error-field-errors'
    ),

);
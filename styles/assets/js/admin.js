jQuery( document ).ready( function( $ ){

    /*
     * Initialize Color Picker Options
     */
    $( '.js-ninja-forms-styles-color-field' ).wpColorPicker();

    /*
     * Initialize CodeMirror
     */
    jQuery( 'textarea.advanced' ).each( function( index, textarea ){
        CodeMirror.fromTextArea( textarea, {
            lineNumbers: true,
        } );
    });

    /*
     * Initialize Field Type Selector
     */
    var fieldTypeSettings = $( '.ninja_forms_styles_settings_field_type' );
    $( '#ninja-forms-styles-field-type-selector' ).change( function() {
        fieldTypeSettings.hide();
        $( '#ninja_forms_styles_settings_field_type_' + $( this ).val() ).show();
    });

    /*
     * Toggle Advanced CSS
     */
    $( '#advanced_css' ).change( function() {

        var isChecked = $( this).prop( 'checked' );
        var advancedCSS = $( '.row-ninja-forms--advanced' );

        if( isChecked ){
            advancedCSS.show();
        } else {
            advancedCSS.hide();
        }

    });

});
jQuery( document ).ready( function( $ ){

    /*
     * Initialize Color Picker Options
     */
    $( '.js-ninja-forms-styles-color-field' ).wpColorPicker();

    /*
     * Initialize CodeMirror
     */
    $( 'textarea.advanced' ).each( function( index, textarea ){
        ninjaFormsStyles.initCodeMirror( textarea );
    });

    /*
     * Initialize Field Type Selector
     */
    var fieldTypeSettings = $( '.ninja_forms_styles_settings_field_type' );
    $( '#ninja-forms-styles-field-type-selector' ).change( function() {
        fieldTypeSettings.hide();
        var postbox = $( '#ninja_forms_styles_settings_field_type_' + $( this ).val() );
        postbox.show();
        postbox.find( 'textarea.advanced' ).each( function( index, textarea ) {
            ninjaFormsStyles.initCodeMirror( textarea );
        });
    });

    /*
     * Toggle Advanced CSS
     */
    $( '#advanced_css' ).change( function(){
        var isChecked = $( this ).prop( 'checked' );
        var advancedCSS = $( '.row-ninja-forms--advanced' );
        return ( isChecked ) ? advancedCSS.show() : advancedCSS.hide();
    });

});

var ninjaFormsStyles = {

    initCodeMirror: function( textarea ) {
        CodeMirror.fromTextArea( textarea, {
            lineNumbers: true,
        } );
    },

};

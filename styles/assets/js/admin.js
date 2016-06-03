jQuery( document ).ready( function( $ ){

    /*
     * Initialize Color Picker Options
     */
    $( '.js-ninja-forms-styles-color-field' ).wpColorPicker();

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


    /* ---- */

    jQuery( 'textarea.advanced' ).each( function( index, textarea ){
        CodeMirror.fromTextArea( textarea, {
            lineNumbers: true,
        } );
    });

});
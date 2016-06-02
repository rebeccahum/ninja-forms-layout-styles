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
});
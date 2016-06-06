jQuery( document ).ready( function( $ ){

    /*
     * Initialize Color Picker Options
     */
    $( '.js-ninja-forms-styles-color-field' ).wpColorPicker();

    /*
     * Initialize CodeMirror
     */
    $( 'textarea.setting-advanced' ).each( function( index, textarea ){
        ninjaFormsStyles.initCodeMirror( textarea );
    });

    /*
     * Field Type Selector
     */
    $( '#ninja-forms-styles-field-type-selector' ).change( function(){
        window.location.href = window.location.href + '&field_type=' + $( this ).val();
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

var nfRadio = Backbone.Radio;
require( ['controllers/loadControllers'], function( LoadControllers ) {

	var NFLayouts = Marionette.Application.extend( {

		initialize: function( options ) {
			this.listenTo( nfRadio.channel( 'app' ), 'after:loadControllers', this.loadControllers );
		},

		onStart: function() {
			// new LoadContent();
			console.log( 'start layout app' );
		},

		loadControllers: function( app ) {
			new LoadControllers();
		}
	} );

	var nfLayouts = new NFLayouts();
	nfLayouts.start();
} );
define( [ 'views/rowCollection', 'models/rowCollection'], function( RowCollectionView, RowCollection ) {
	var controller = Marionette.Object.extend( {
		initialize: function() {
			nfRadio.channel( 'formContent' ).request( 'add:viewFilter', this.getFormContentView, 4 );
			nfRadio.channel( 'formContent' ).request( 'add:loadFilter', this.formContentLoad, 4 );
			
			/*
			 * In the RC for Ninja Forms, the 'formContent' channel was called 'fieldContents'.
			 * This was changed in version 3.0. These radio messages are here to make sure nothing breaks.
			 *
			 * TODO: Remove this backwards compatibility radio calls.
			 */
			nfRadio.channel( 'fieldContents' ).request( 'add:viewFilter', this.getFormContentView, 4 );
			nfRadio.channel( 'fieldContents' ).request( 'add:loadFilter', this.formContentLoad, 4 );
		},

		getFormContentView: function( collection ) {
			return RowCollectionView;
		},

		/**
		 * When we load our builder view, we filter the formContentData.
		 * This turns the saved object into a Backbone Collection.
		 *
		 * If we aren't passed any data, then this form hasn't been modified with layouts yet,
		 * so we default to the nfLayouts.rows global variable that is localised for us.
		 * 
		 * @since  3.0
		 * @param  array rowArray current value of our formContentData.
		 * @return Backbone.Collection
		 */
		formContentLoad: function( rowArray, formModel ) {
			if ( false === rowArray instanceof RowCollection ) {
				return new RowCollection( rowArray, { formModel: formModel } );				
			} else {
				return rowArray;
			}

		}
	});

	return controller;
} );
define( [ 'views/rowCollection', 'models/rowCollection'], function( RowCollectionView, RowCollection ) {
	var controller = Marionette.Object.extend( {
		initialize: function() {
			nfRadio.channel( 'fieldContents' ).request( 'add:viewFilter', this.getFieldContentsView, 4 );
			nfRadio.channel( 'fieldContents' ).request( 'add:loadFilter', this.fieldContentsLoad, 4 );
		},

		getFieldContentsView: function( collection ) {
			return RowCollectionView;
		},

		/**
		 * When we load our builder view, we filter the fieldContentsData.
		 * This turns the saved object into a Backbone Collection.
		 *
		 * If we aren't passed any data, then this form hasn't been modified with layouts yet,
		 * so we default to the nfLayouts.rows global variable that is localised for us.
		 * 
		 * @since  3.0
		 * @param  array rowArray current value of our fieldContentsData.
		 * @return Backbone.Collection
		 */
		fieldContentsLoad: function( rowArray, formModel ) {
			if ( false === rowArray instanceof Backbone.Collection ) {
				return new RowCollection( rowArray, { formModel: formModel } );				
			} else {
				return rowArray;
			}

		}
	});

	return controller;
} );
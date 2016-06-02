define( ['views/rowCollection', 'controllers/LoadControllers', 'models/rowCollection'], function( RowCollectionView, LoadControllers, RowCollection ) {
	var controller = Marionette.Object.extend( {
		initialize: function() {
			this.listenTo( nfRadio.channel( 'app' ), 'after:loadControllers', this.loadControllers );
		},

		loadControllers: function() {
			new LoadControllers();

			nfRadio.channel( 'fieldContents' ).request( 'add:viewFilter', this.getFieldContentsView, 4 );
			nfRadio.channel( 'fieldContents' ).request( 'add:saveFilter', this.fieldContentsSave, 4 );
			nfRadio.channel( 'fieldContents' ).request( 'add:loadFilter', this.fieldContentsLoad, 4 );
		},

		getFieldContentsView: function( collection ) {
			return RowCollectionView;
		},

		/**
		 * When we update our database, set the form setting value of 'fieldContentsData' to our row collection.
		 * To do this, we have to break our row collection down into an object, then remove all the extra field settings
		 * so that we're left with just the field IDs.
		 * 
		 * @since  3.0
		 * @return array 
		 */
		fieldContentsSave: function( rowCollection ) {
			var rows = JSON.parse( JSON.stringify( rowCollection ) );	
			_.each( rows, function( row, rowIndex ) {
				_.each( row.cells, function( cell, cellIndex ) {
					_.each( cell.fields, function( field, fieldIndex ) {
						if ( field.key ) {
							rows[ rowIndex ].cells[ cellIndex].fields[ fieldIndex ] = field.key;
						}
					} );
				} );
			} );
			return rows;
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
		fieldContentsLoad: function( rowArray ) {
			if ( false === rowArray instanceof Backbone.Collection ) {
				if ( 'undefined' == typeof rowArray || 0 == rowArray.length || 'undefined' == typeof rowArray[0]['cells'] ) {
					if ( 'undefined' != typeof nfLayouts ) {
						rowArray = nfLayouts.rows;
					} else {
						rowArray = [];
					}
				}

				return new RowCollection( rowArray );				
			} else {
				return rowArray;
			}

		}
	});

	return controller;
} );
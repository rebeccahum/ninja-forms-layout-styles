define( [ 'models/rowCollection' ], function( RowCollection ) {
	var controller = Marionette.Object.extend( {
		overSortable: false,
		outFired: false,
		overCell: false,
		overRows: false,

		initialize: function() {
			// Respond to requests to add a row to our collection.
			nfRadio.channel( 'layouts' ).reply( 'add:row', this.addRow, this );

			/*
			 * After we init our form in the builder, we need to check for items in the field collection that don't appear in the formContentData.
			 * NOTE: We only need to do this if Multi-Part isn't enabled.
			 */
			this.listenTo( nfRadio.channel( 'main' ), 'render:main', this.checkBadData );
		},

		addRow: function( rowCollection, data ) {

			if ( ! rowCollection ) {
				/*
				 * In the RC for Ninja Forms, 'formContentData' was 'fieldContentsData'.
				 * In 3.0, we changed it to 'formContentData', so this line checks for that old setting name if the new one doesn't exist.
				 * This is for backwards compatibility and can be removed in the future.
				 *
				 * TODO: Remove the || portion of this ternary.
				 */
				rowCollection = nfRadio.channel( 'settings' ).request( 'get:setting', 'formContentData' ) || nfRadio.channel( 'settings' ).request( 'get:setting', 'fieldContentsData' );
				if ( false === rowCollection instanceof RowCollection ) return false;
			}

			if ( 'undefined' == typeof data.order || null == data.order ) {
				/*
				 * Get the order of the last item in our row collection.
				 */
				rowOrder = rowCollection.pluck( 'order' );
				data.order = ( 0 < rowOrder.length ) ? _.max( rowOrder ) + 1 : 1;
			}

			var rowModel = rowCollection.add( {
				order: data.order,
				cells: [
					{
						order: 0,
						fields: [ data.field ],
						width: '100'
					}
				]
			} );

			return rowModel;
		},

		updateOverSortable: function( val ) {
			this.overSortable = val;
		},

		getOverSortable: function() {
			return this.overSortable;
		},

		updateOutFired: function( val ) {
			this.outFired = val;
		},

		getOutFired: function() {
			return this.outFired;
		},

		updateOverCell: function( val ) {
			this.overCell = val;
		},

		getOverCell: function() {
			return this.overCell;
		},

		/**
		 * Loop through our fields and make sure that they are in our formContentData.
		 * If they aren't, delete them and update the database.
		 *
		 * NOTE: If Multi-Part is enabled, we don't need to run this.
		 * 
		 * @since  3.0.8
		 * @return void
		 */
		checkBadData: function( app ) {
			/*
			 * TODO: Bandaid fix for making sure that we interpret fields correclty when Multi-Part is active.
			 * Basically, if MP is active, we don't want to ever use the nfLayouts.rows.
			 */
			var formContentLoadFilters = nfRadio.channel( 'formContent' ).request( 'get:loadFilters' );
			var mpEnabled = ( 'undefined' != typeof formContentLoadFilters[1] ) ? true : false;
			if ( mpEnabled ) {
				return false;
			}

			var formContentData = nfRadio.channel( 'settings' ).request( 'get:setting', 'formContentData' );
			var formContentDataString = JSON.stringify( formContentData );
			var fieldCollection = nfRadio.channel( 'fields' ).request( 'get:collection' );
			var needToUpdate = false;

			fieldCollection.each( function( fieldModel ) {
				if ( 'undefined' == typeof fieldModel ) {
					return false;
				}

				if ( -1 == formContentDataString.indexOf( '"key":"' + fieldModel.get( 'key' ) + '"' ) ) {
					fieldCollection.remove( fieldModel );
					needToUpdate = true;
				}
			} );

			if ( needToUpdate ) {
				nfRadio.channel( 'app' ).request( 'update:setting', 'clean', false );
				nfRadio.channel( 'app' ).request( 'update:db', 'publish' );				
			}
		}
	});

	return controller;
} );
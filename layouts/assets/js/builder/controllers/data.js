define( [], function() {
	var controller = Marionette.Object.extend( {
		overSortable: false,
		outFired: false,
		overCell: false,
		overRows: false,

		initialize: function() {
			// Respond to requests to add a row to our collection.
			nfRadio.channel( 'layouts' ).reply( 'add:row', this.addRow, this );
		},

		addRow: function( rowCollection, data ) {

			var rowCollection = rowCollection || nfRadio.channel( 'settings' ).request( 'get:setting', 'fieldContentsData' );

			if ( 'undefined' == typeof data.order ) {
				data.order = 999;
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
		}
	});

	return controller;
} );
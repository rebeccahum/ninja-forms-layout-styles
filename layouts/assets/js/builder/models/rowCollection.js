/**
 * Holds all of our row models.
 * 
 * @package Ninja Forms Layouts
 * @subpackage Fields
 * @copyright (c) 2016 WP Ninjas
 * @since 3.0
 */
define( ['models/rowModel'], function( rowModel ) {
	var collection = Backbone.Collection.extend( {
		model: rowModel,
		comparator: 'order',

		initialize: function( models ) {
			this.updateMaxCols( models );
			this.on( 'add:cell', this.updateMaxCols, this );
			this.on( 'destroy:cell', this.updateMaxCols, this );
			this.on( 'remove:cell', this.updateMaxCols, this );
			this.on( 'destroy', this.updateMaxCols, this );
		},

		updateMaxCols: function( models ) {
			var maxCols = 1;
			if ( true === models instanceof Backbone.Model ) {
				models = this.models
			}
			_.each( models, function( row ) {
				if ( 'undefined' != typeof row.cells ) {
					if ( maxCols < row.cells.length ) {
						maxCols = row.cells.length;
					}					
				} else if ( true === row instanceof Backbone.Model ) {
					if ( maxCols < row.get( 'cells' ).length ) {
						maxCols = row.get( 'cells' ).length;
					}
				}
					
			} );

			nfRadio.channel( 'layouts' ).request( 'update:colClass', maxCols );
		}
	} );
	return collection;
} );
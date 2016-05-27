/**
 * Holds all of our cell field models.
 * 
 * @package Ninja Forms Layouts
 * @subpackage Fields
 * @copyright (c) 2016 WP Ninjas
 * @since 3.0
 */
define( [], function( ) {
	var collection = Backbone.Collection.extend( {
		comparator: 'order',

		initialize: function( models, options ) {
			// We've been passed the cellModel to which this collection belongs.
			this.cellModel = options.cellModel;
			var that = this;
			_.each( models, function( model ) {
				model.set( 'cellcid', that.cellModel.cid, { silent: true } );
			} );
		}
	} );
	return collection;
} );
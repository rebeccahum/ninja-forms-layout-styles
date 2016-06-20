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

		initialize: function( models, options ) {
			this.formModel = options.formModel;
		}
	} );
	return collection;
} );
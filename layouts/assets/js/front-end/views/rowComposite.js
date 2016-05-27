define( ['views/cellComposite'], function( cellComposite ) {
	var view = Marionette.CompositeView.extend( {
		template: '#nf-tmpl-row',
		childView: cellComposite,
		className: 'nf-row',

		initialize: function() {
			this.collection = this.model.get( 'cells' );
			// Get our fieldItem view.
			// this.childView = nfRadio.channel( '')
		},

		attachHtml: function( collectionView, childView ) {
			jQuery( collectionView.el ).find( 'nf-cells' ).append( childView.el );
		}
	} );

	return view;
} );
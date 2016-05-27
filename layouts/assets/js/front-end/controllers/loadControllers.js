define( 
	[
		'controllers/fieldContentsFilters',
	], 
	function
	(
		FieldContentsFilters
	)
	{
	var controller = Marionette.Object.extend( {
		initialize: function() {
			new FieldContentsFilters();
		}

	});

	return controller;
} );
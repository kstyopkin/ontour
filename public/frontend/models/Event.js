define(['underscore', 
		'backbone'
], function(_, Backbone) {
	'use strict';

	return Backbone.Model.extend({

		defaults: {
			id: 'id',
			title: 'title',
			artists: 'artists',
			date: 'date',
			venue: 'venue',
			image: null,
			icon: null,
			marker: null,
			popup: null,
			path: null,
			map: {},
			param: null,
			selected: false
		}

	});

});
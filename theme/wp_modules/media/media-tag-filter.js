(function(){
	/**
	 * Create a new MediaLibraryTagTaxonomyFilter we later will instantiate
	 */
	var MediaLibraryTagTaxonomyFilter = wp.media.view.AttachmentFilters.extend({
		id: 'media-attachment-tag-taxonomy-filter',

		createFilters: function() {
			var filters = {};
			// Formats the 'terms' we've included via wp_localize_script()
			_.each( MediaLibraryTagTaxonomyFilterData.terms || {}, function( value, index ) {
				filters[ index ] = {
					text: value.name,
					props: {
						// Change this: key needs to be the WP_Query var for the taxonomy
						mediatag: value.slug,
					}
				};
			});
			filters.all = {
				// Change this: use whatever default label you'd like
				text:  'All tags',
				props: {
					// Change this: key needs to be the WP_Query var for the taxonomy
					mediatag: ''
				},
				priority: 10
			};
			this.filters = filters;
		}
	});
	/**
	 * Extend and override wp.media.view.AttachmentsBrowser to include our new filter
	 */
	var AttachmentsBrowser = wp.media.view.AttachmentsBrowser;
	wp.media.view.AttachmentsBrowser = wp.media.view.AttachmentsBrowser.extend({
		createToolbar: function() {
			// Make sure to load the original toolbar
			AttachmentsBrowser.prototype.createToolbar.call( this );
			this.toolbar.set( 'MediaLibraryTagTaxonomyFilter', new MediaLibraryTagTaxonomyFilter({
				controller: this.controller,
				model:      this.collection.props,
				priority: -75
			}).render() );
		}
	});
})();

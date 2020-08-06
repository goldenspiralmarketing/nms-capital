require.config( {
	baseUrl: gs_custom_js.stylesheet_directory_uri + '/js', // NOTE: gs_custom_js defined in theme/wp_modules/markup.php
	paths: {
		'jquery':	'jquery/jquery',
		'Barba':	'barba.' + 'js/barba',
		'validation':	'jquery-validation/jquery.' + 'validate',
		'magnific':	'magnific-popup/jquery.' + 'magnific-popup',
		'sticky':	'sticky-kit/jquery.' + 'sticky-kit',
		'slick':	'slick-carousel/slick',
		'jscookie':	'js-cookie/js.' + 'cookie',
		'imagesLoaded': 'imagesloaded/imagesloaded.' + 'pkgd',
		'bind':		'bind.' + 'js/bind'
	},
	shim: {
		'sticky': {
			deps: ['jquery']
		},
	}
} );

define( 'add-bind-js-in-global-scope', ['bind'], function( bind ) {
    window.Bind = bind;
});

require( ['main'], function(){ } );

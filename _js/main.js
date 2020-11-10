// check to see if jQuery is already loaded
if ( typeof jQuery === 'function' ) {
	define( 'jquery', function () { return jQuery; } );
}

define( 'main', // module name
	[ // dependencies
		'jquery',
		'global',
		'loading',
		'svg',
		'home',
		'resources'
		/*
		NOTE: add other page modules here
		*/
	],
	function( $, global, loading, svg  ) { // callback

		var scroll_animation_throttle = global.throttle( global.scroll_animation, 500 );

		function window_on_load() {
			// svg.pre_calculate();
			// global.svg_draw();
			global.scroll_trigger();
			loading.load_on_page_load();
			loading.load_on_scroll();
			// global.animate_load_in();
			global.show_scrolled_header();
			loading.optimize_loading();
			global.sticky_kit();
			global.magnific();
			global.slick();
			global.setup_header_nav();
			global.prepare_dropdowns_for_styling();
			global.prepare_expandable_content();
			global.prepare_content_toggle();
			global.prepare_tab_sections();
			global.custom_stickiness();
			global.url_params();
			// global.follow_me();
			// global.hamburger();
			global.smooth_scroll();
		}

		function window_on_resize( evt ) {
			var st = global.get_current_scroll_top(),
				wd = global.get_current_window_dimensions();

			// sticky
			global.sticky_kit();

			// slick
			if ( global.get_last_window_dimensions().width !== wd.width ) {
				global.resize_slick_items();
			}

			// global.follow_me();
			global.close_mobile();

			global.set_last_window_dimensions( wd );
			global.set_last_scroll_top( st );
		}

		function window_on_scroll( evt ) {
			var lst = global.get_last_scroll_top(),
				st = global.get_current_scroll_top();

			if ( st > lst && st > 0 ) {
				$( 'body' ).addClass( 'scrolled' );
				// $('header.site-header .header-full').removeClass('open');
			} else {
				$( 'body' ).removeClass( 'scrolled' );
			}


			// global.follow();
			scroll_animation_throttle();
			global.show_scrolled_header();

			global.set_last_scroll_top( st );
		}


		document.documentElement.setAttribute( 'data-ie', global.ie() ); // for stylesheet useage and ie version targeting

		window.addEventListener( 'resize', window_on_resize );
		window.addEventListener( 'scroll', window_on_scroll );

		//window_on_load(); // move this to check for window load state first
		if (document.readyState === 'complete') {
			// console.log('document ready state complete');
			window_on_load();
		} else {
			window.addEventListener('load', function(){
				// console.log('window load fired');
				window_on_load();
			});
		}

		// sneaking this into the wrong place
		// TODO put this in clean function
		// var checkExternalHeaderExists = setInterval(function() {
		// 	console.log('searching for header .nav-drop-down');
		// 	if ($('header .nav-drop-down').length) {
		// 		console.log('found header .nav-drop-down');
		// 		clearInterval(checkExternalHeaderExists);
		// 		global.setup_header_nav();
		// 	}
		// }, 200);

	}
);

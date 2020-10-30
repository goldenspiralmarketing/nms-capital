define( 'global', // module name
	[ // dependencies
		'jquery',
		'loading',
		'magnific',
		'slick',
		'sticky',
		'imagesLoaded'

	],
	function( $, loading ) { // callback

		var _lastScrollTop = window.pageYOffset || document.documentElement.scrollTop,
			_lastWindowDimensions = {
				width: window.innerWidth,
				height: window.innerHeight
			},
			_tabletWidth = 991,
			_mobileWidth = 767,
			_topOffset = 100,
			_followIds = [],
			_pageIsReady = true,
			_isFF = !!navigator.userAgent.match(/firefox/i);

		function _check_mobile_os() {
			if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
				return {
					ios: /iPhone|iPad|iPod/i.test( navigator.userAgent ),
					iphone: /iPhone/i.test( navigator.userAgent ),
					ipod: /iPod/i.test( navigator.userAgent ),
					ipad: /iPad/i.test( navigator.userAgent ),
					android: /Android/i.test( navigator.userAgent ),
					webos: /webOS/i.test( navigator.userAgent ),
					blackberry: /BlackBerry/i.test( navigator.userAgent ),
					iemobile: /IEMobile/i.test( navigator.userAgent ),
					operamini: /Opera Mini/i.test( navigator.userAgent )
				};
			} else {
				return false;
			}
		}

		function _sticky_check() {
			var wd = {
				width: window.innerWidth,
				height: window.innerHeight
			};
			if ( wd.width >= _mobileWidth && ! _isFF ) {
				$( '.sticky' ).stick_in_parent( {
					parent: 'main',
					offset_top: $('header').outerHeight()
				} )
				.on( 'sticky_kit:bottom', function( evt ) {
					$( evt.target ).parent().css( 'position', 'static' );
				} )
				.on( 'sticky_kit:unbottom', function( evt ) {
					$( evt.target ).parent().css( 'position', '' );
				} );
			} else {
				$( '.sticky' ).trigger( 'sticky_kit:detach' );
			}
		}

		function create_stickyness( sticky_element, parent_element, offset_top_amount ) {
			var wd = {
				width: window.innerWidth,
				height: window.innerHeight
			};

			if ( wd.width >= _mobileWidth && ! _isFF ) {
				$( sticky_element ).stick_in_parent( {
					parent: parent_element,
					offset_top: offset_top_amount
				} )
				.on( 'sticky_kit:bottom', function( evt ) {
					$( evt.target ).parent().css( 'position', 'static' );
				} )
				.on( 'sticky_kit:unbottom', function( evt ) {
					$( evt.target ).parent().css( 'position', '' );
				} );
			} else {
				$( '.sticky' ).trigger( 'sticky_kit:detach' );
			}
		}

		// function _follow_check() {
		// 	if ( ! $( '#follow-line' ).length ) {
		// 		var follow_line = $( '<div id="follow-line"></div>' );
		// 		$( '.follow-me' ).append( follow_line );
		// 		$( '.follow-me > ul > li > a:not(.open-window)' ).each( function( ix, obj ) {
		// 			var id = $( obj ).attr( 'href' );
		// 			_followIds.push( id );
		// 		} );
		// 	}
		// }

		function close_mobile_menu( evt ) {
			$( '.hamburger-icon-container' ).removeClass( 'open' );
			$( 'html' ).removeClass( 'mobile-menu-open' );
		}

		// function _hamburger_check( css_hamburger_selector ) {
		// 	$( css_hamburger_selector ).on( 'click', function( evt ) {
		// 		evt.stopPropagation();
		// 		evt.preventDefault();
		//
		// 		// $( this ).toggleClass( 'open' );
		//
		// 		if ( ! $( this ).hasClass( 'open' ) ) {
		// 			$( this ).addClass( 'open' );
		// 			$( 'html' ).addClass( 'mobile-menu-open' );
		// 			$( '.nav-mobile ul > li > a' ).on( 'click', close_mobile_menu );
		// 		} else {
		// 			$( this ).removeClass( 'open' );
		// 			$( 'html' ).removeClass( 'mobile-menu-open' );
		// 			$( '.nav-mobile ul > li > a' ).off( 'click', close_mobile_menu );
		// 		}
		// 	} );
		// }



		function scrollTrigger() {
			$( '[class*="on-scroll"]' ).each( function ( i, elm ) {
				var screenBottom = $( window ).scrollTop() + $( window ).height();
				var buffer = 0;
				var target = $( elm ).offset().top + buffer;
				var animated = $( elm ).hasClass( 'active' );

				if ( screenBottom >= target ) {
					if ( ! animated ) {
						$( elm ).addClass( 'active' );
					}
				}
			});
		}

		function svgDraw() {
			$( '.svg-draw' ).each( function ( i, elm ) {
				var screenBottom = $( window ).scrollTop() + $( window ).height();
				var buffer = 0;
				var target = $( elm ).offset().top + buffer;
				var lineLength = $( elm ).attr('stroke-length');

				if ( screenBottom >= target ) {
					// this relies on the pre-calculating done in svg.js
					$( elm ).css( 'stroke-dashoffset', ( lineLength * 2 ) );
					$( elm ).addClass( 'animate-ready' );
				}
			});
		}

		function showScrolledHeader(){
			var navHeight = $('header .header-full').height();
			var navArea = navHeight * 2;
			var windowTop = $( window ).scrollTop();
			if ( windowTop >= navArea ){
				$('header').removeClass('topped');
			} else if (windowTop === 0) {
				$('header').addClass('topped');
			}
		}

		function throttle( fn, wait ) {
			var time = Date.now();
			return function() {
				if ( ( time + wait - Date.now() ) < 0 ) {
					fn();
					time = Date.now();
				}
			};
		}

		function urlParams() {
			if (_pageIsReady) {
				if (window.location.search.indexOf('n=') > -1) {
					var urlParams = new URLSearchParams(window.location.search);
					var param = urlParams.get('n');
					var portfolio_listing = $('.portfolio-listing-module');
					var team_listing = $('.team-listing-module');
					if (param.length) {
						if (portfolio_listing.length || team_listing.length) {
							var id = '#' + param;
							$.magnificPopup.open({
								items: {
									src: $(id),
									type: 'inline'
								}
							}, 0);
						}
					}
				}
			}
		}

		function scrollAnimation() {
			if ( _pageIsReady ) {
				svgDraw();
				scrollTrigger();
				loading.load_on_scroll();
				// animateLoadIn();
			}
		}


		function createSVGNodes() {
			var d = $.Deferred();

			if ( $( '.node-line-header' ).length ) {
				var ajax = new XMLHttpRequest();
					ajax.open( 'GET', gs_custom_js.stylesheet_directory_uri + '/img/svg/gs_node-line-sideways.svg', true );
					ajax.send();
					ajax.onload = function ( e ) {
						var div = document.createElement( 'div' );
							div.setAttribute( 'class', 'gs-svg node-lg svg-draw' );
							div.innerHTML = ajax.responseText;
						// document.body.insertBefore( div, document.body.childNodes[0] );
						$( '.node-line-header' ).each( function ( ix, elem ) {
							var clone = div.cloneNode(true);
							$(elem)[0].appendChild( clone );
						} );

						d.resolve();
					};
			} else {
				d.resolve();
			}

			return d.promise();
		}

		function attach_nav_hover_submenu_events( class_identifier ) {
			var hover_element = $( '.' + class_identifier ),
				dropdown_element = $( '[data-menu-item="' + class_identifier + '"]' );

			hover_element.on( 'mouseenter', function () {
				clearTimeout( $( this ).data( 'timeout-id' ) );
				$( 'html' ).addClass( 'menu-open' );
				dropdown_element.addClass( 'active' );
			} ).on( 'mouseleave', function () {
				var timeout_id = setTimeout( function () {
					dropdown_element.removeClass( 'active' );
					$( 'html' ).removeClass( 'menu-open' );
				}, 50 );
				//set the timeout_id, allowing us to clear this trigger if the mouse comes back over this element, or other element of interest
				$( this ).data( 'timeout-id', timeout_id );
			} );

			dropdown_element.on( 'mouseenter', function () {
				clearTimeout( hover_element.data( 'timeout-id' ) );
			}).on( 'mouseleave', function () {
				var someElement = hover_element,
				timeout_id = setTimeout( function () {
					dropdown_element.removeClass( 'active' );
					$( 'html' ).removeClass( 'menu-open' );
				}, 50 );
				//set the timeout_id, allowing us to clear this trigger if the mouse comes back over
				someElement.data( 'timeout-id', timeout_id );
			});
		}

		function prepare_dropdowns_for_styling() {
			var select_parents = $( 'select' ).parent( '.input' );
				select_parents.addClass( 'select' );
		}

		function prepare_expandable_content() {
			$( '.expandable-content-trigger' ).on( 'click', function ( evt ) {
				$( this ).closest( '.expandable-content' ).toggleClass( 'open' );
			} );
		}

		function prepare_content_toggle() {
			$( '.dropdown-list-trigger' ).on( 'click', function ( evt ) {
				$( '.dropdown-list.open' ).removeClass( 'open' );
				$( this ).parent( '.dropdown-list' ).toggleClass( 'open' );
			} );
			$(document).click(function(event) {
		    if(!$(event.target).parent('.dropdown-list').length) {
		      $( '.dropdown-list' ).removeClass( 'open' );
		    }
			});

		}



		function prepare_tab_sections() {
			$( '[data-toggle="tab"]' ).on( 'click', function ( evt ) {
				evt.preventDefault();
				evt.stopPropagation();

				var tabs = $( this ).closest( '.tabs' );
				$( tabs ).find( '.tab-control > li' ).removeClass( 'active' );
				$( tabs ).find( '.tab-panel' ).removeClass( 'active' );

				$( this ).closest( 'li' ).addClass( 'active' );
				var id = $( this ).data( 'anchor' );
				$( tabs ).find( '#' + id + '.tab-panel' ).addClass( 'active' );
			} );
		}

		function is_hsforms_loaded( url ) {
			var scripts = document.getElementsByTagName( 'script' );
			for ( var i = scripts.length; i--; ) {
				if ( scripts[i].src === url ) {
					return true;
				}
			}
			return false;
		}

		function load_hsforms( cb ) {
			if ( ! is_hsforms_loaded( '//js.hsforms.net/forms/v2.js' ) ) {
				$.getScript( '//js.hsforms.net/forms/v2.js' ).done( function ( script, textStatus ) {
					cb();
				} );
			} else {
				cb();
			}
		}

		function load_hsform( portal_id, form_id, target ) {
			hbspt.forms.create({
				portalId: portal_id,
				formId: form_id,
				css: "",
				target: target
			});
		}

		if ( $( '.embedded-form' ).length ) {
			var portal_id = $( '.embedded-form' ).data( 'portal-id' ),
				form_id = $( '.embedded-form' ).data( 'form-id' ),
				target = '.embedded-form';

			load_hsforms( function () {
				hbspt.forms.create({
					portalId: portal_id,
					formId: form_id,
					css: "",
					target: target
				});
			} );
		}

		return {
			get_element_index: function( node ) {
				var index = 0;
				while ( (node = node.previousElementSibling) ) {
					index += 1;
				}
				return index;
			},
			/*
			SCROLL TOP
			*/
			get_current_scroll_top: function() {
				return window.pageYOffset || document.documentElement.scrollTop;
			},

			get_last_scroll_top: function() {
				return _lastScrollTop;
			},

			set_last_scroll_top: function( val ) {
				if ( val !== undefined ) {
					_lastScrollTop = val;
				}
			},

			/*
			WINDOW DIMENSIONS
			*/
			get_current_window_dimensions: function() {
				return {
					width: window.innerWidth,
					height: window.innerHeight
				};
			},

			get_last_window_dimensions: function() {
				return _lastWindowDimensions;
			},

			set_last_window_dimensions: function( val ) {
				if ( val !== undefined ) {
					_lastWindowDimensions = val;
				}
			},

			smooth_scroll: function() {
				/*
				SMOOTH SCROLLING FOR HASH ANCHORS
				*/
				// Select all links with hashes
				$( 'a[href*="#"]' )
				// Remove links that don't actually link to anything
				.not( '[href="#"]' )
				.not( '[href="#0"]' )
				.not( '.magnific' )
				.not( '.magnific-project' )
				.not( '[data-toggle="tab"]')
				.click( function( event ) {
					// On-page links
					if (
						location.pathname.replace( /^\//, '' ) == this.pathname.replace( /^\//, '' ) && location.hostname == this.hostname
					) {
						// Figure out element to scroll to
						var target = $( this.hash );
						target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );
						// Does a scroll target exist?
						if ( target.length ) {
							// Only prevent default if animation is actually gonna happen
							event.preventDefault();
							var scroll_container = $( this ).data( 'scroll-container' ) ? $( this ).data( 'scroll-container' ) : 'html, body';
							$( scroll_container ).animate( {
								scrollTop: target.offset().top - _topOffset
							}, 1000, function() {
								// Callback after animation
								// Must change focus!
								var $target = $( target );
								// $target.focus();
								if ( $target.is( ":focus" ) ) { // Checking if the target was focused
									return false;
								} else {
									$target.attr( 'tabindex', '-1' ); // Adding tabindex for elements not focusable
									// $target.focus(); // Set focus again
								}
							} );
						}
					}
				});
			},

			magnific: function() {
				if ( $( '.magnific' ).length ) $( '.magnific' ).magnificPopup();

				console.log('magnificClose');
				$('.mfp-close').on('click', function(){
					$.magnificPopup.close();
					console.log('magnific clicked');
				});
			},


			slick: function() {
				if ( $( '.slick' ).length ) {
					$( '.slick' ).slick( { lazyLoad: 'ondemand' } );
					// $( '.slick' ).slick( 'refresh' );
				}
			},

			resize_slick_items: function() {
				if ( $( '.slick.squared' ).length ) {
					$( '.slick.squared .slick-slide' ).each( function( ix, obj ) {
						var width = $( obj ).outerWidth();
						$( obj ).css( 'height', width + 'px' );
					} );
				}
			},

			sticky_kit: function() {
				// if ( $( '.sticky' ).length ) _sticky_check();
				if ( $( '.sticky' ).length ) create_stickyness( '.sticky', 'main', $( 'header').outerHeight() );
			},

			stick: function( sticky_el, parent_el, offset_top_amt ) {
				create_stickyness( sticky_el, parent_el, offset_top_amt );
			},

			custom_stickiness: function () {
				$( '[data-sticky="true"]' ).each( function ( ix, obj ) {
					var sticky_class = $( this ).data( 'sticky-class' );
					var parent = $( this ).data( 'sticky-parent-class' );
					var offset = $( this ).data( 'sticky-offset-pixels' );
					var min_width = $( this ).data( 'sticky-min-width-pixels' );

					var wd = {
						width: window.innerWidth,
						height: window.innerHeight
					};

					if ( wd.width >= min_width ) {
						create_stickyness( '.' + sticky_class, '.' + parent, ( offset * 1 ) + 80 );
					}
				} );
			},

			ie: function() {
				var ua = window.navigator.userAgent;

				var msie = ua.indexOf('MSIE ');
				if (msie > 0) {
					// IE 10 or older => return version number
					return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
				}

				var trident = ua.indexOf('Trident/');
				if (trident > 0) {
					// IE 11 => return version number
					var rv = ua.indexOf('rv:');
					return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
				}

				var edge = ua.indexOf('Edge/');
				if (edge > 0) {
					// IE 12 => return version number
					return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
				}

				// other browser
				return false;
			},

			setup_header_nav: function () {

				var checkExternalHeaderExists = setInterval(function() {

					if ($('header.site-header').length) { // header has loaded

						clearInterval(checkExternalHeaderExists);

						$( '.nav-search-container' ).appendTo( '#menu-header' );

						$( '.menu-item-search' ).on( 'click', function ( evt ) {
							$( 'header' ).addClass( 'search-container-active' );
							$( 'input[name="s"]' ).focus();
						} );

						$( 'input[name="s"]' ).on( 'blur', function ( evt ) {
							$( 'header' ).removeClass( 'search-container-active' );
						} );


						$( '.mobile-menu-button-container' ).on( 'click', function ( evt ) {
							$( 'html' ).toggleClass( 'mobile-menu-open' );
						} );

						var scrollHeader = $('header.site-header .header-full').clone();
						$(scrollHeader).addClass('header-scroll');
						$(scrollHeader).appendTo('header.site-header');

						$('.header-controls .menu-trigger').on('click', function(){
							$('header.site-header .header-full').addClass('open');
						});
						$('.header-full .menu-trigger').on('click', function(){
							$('header.site-header .header-full').removeClass('open');
						});
						$('.header-scroll .menu-trigger').on('click', function(){
							$('.header-scroll').css('transform', 'translateY(-100%)');
						});
					}
				}, 200);




			},

			// follow_me: function() {
			// 	if ( $( '.follow-me' ).length ) _follow_check();
			// },
			// follow: function() {
			// 	var $follow_line = $( '#follow-line' );
			// 	if ( $follow_line.length && _followIds.length ) {
			// 		_followIds.map( function( currentValue, index, arr ) {
			// 			if ( _lastScrollTop + _topOffset + ( $( window ).height() / 3 ) >= $( currentValue ).offset().top ) {
			// 				$item = $( '.follow-me' ).find( 'a[href="' + currentValue + '"]' ).closest( 'li' );
			// 				$follow_line
			// 					.width( $item.width() )
			// 					.css( 'left', $item.position().left );
			// 			}
			// 		} );
			// 	}
			// },

			// hamburger: function() {
			// 	if ( $( '.hamburger-icon-container' ).length ) _hamburger_check( '.hamburger-icon-container' );
			// },

			close_mobile: close_mobile_menu,

			// optimize_loading: function() {
			// 	// lazy_bg();
			// 	$( 'html' ).removeClass( 'preload' );
			//
			// 	if ( $( 'body.home' ).length ) {
			// 		$( 'html' ).addClass( 'animation-running' );
			// 		setTimeout( function () {
			// 			$( 'html' ).removeClass( 'animation-running' );
			// 		}, 1800 ); // this delay time coordinates with the total animation time in home.scss
			// 	}
			// },
			load_hsforms: function( cb ) {
				load_hsforms( cb );
			},
			url_params: urlParams,
			svg_draw: svgDraw,
			scroll_trigger: scrollTrigger,
			// animate_load_in: animateLoadIn,
			// load_on_scroll: loadOnScroll,
			// load_on_page_load: loadOnPageLoad,
			show_scrolled_header: showScrolledHeader,
			throttle: throttle,
			scroll_animation: scrollAnimation,
			page_is_ready: _pageIsReady,
			create_svg_nodes: createSVGNodes,
			prepare_dropdowns_for_styling: prepare_dropdowns_for_styling,
			prepare_expandable_content: prepare_expandable_content,
			prepare_content_toggle: prepare_content_toggle,
			prepare_tab_sections: prepare_tab_sections,
			mobile_os: _check_mobile_os
		};
	}
);

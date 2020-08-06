define( 'transition', // module name
	[ // dependencies
		'global',
		'jquery',
		'Barba'
	],
	function( global, $, Barba ) { // callback

		if ( $( '#barba-wrapper[data-pagetransitions="true"]' ).length ) {

			var GSPageTransition = Barba.BaseTransition.extend( {
				start: function () {
					// $(window).off('load');
					// $(window).off('scroll');
					// $(window).off('resize');
					global.page_is_ready = false;

					/**
					* This function is automatically called as soon the Transition starts
					* this.newContainerLoading is a Promise for the loading of the new container
					* (Barba.js also comes with an handy Promise polyfill!)
					*/

					// As soon the loading is finished and the old page is faded out, let's fade the new page
					Promise
						.all( [this.newContainerLoading, this.fadeOut(), this.fadeIn()] )
						.then( this.finish.bind( this ) );
				},
				fadeOut: function () {
					/**
					* this.oldContainer is the HTMLElement of the old Container
					*/
					$( '#barba-wrapper' ).addClass( 'is-exiting' );
					$( '.menu-bars' ).removeClass( 'open' );

					return $( this.oldContainer ).animate( { opacity: 0 } ).promise();
				},
				fadeIn: function () {
					/**
					* this.newContainer is the HTMLElement of the new Container
					* At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
					* Please note, newContainer is available just after newContainerLoading is resolved!
					*/
					$( this.oldContainer ).hide();

					$( 'body' ).css( 'overflow', 'hidden' );
					$( '#barba-wrapper' ).removeClass( 'is-exiting' ).addClass( 'is-entering' );
				},
				finish: function () {
					$( 'body' ).css( 'overflow', 'auto' );
					$( 'html, body' ).scrollTop( 0 );

					global.page_is_ready = true;

					this.done();
				}
			} );


			Barba.Pjax.start();

			Barba.Pjax.getTransition = function () {
				return GSPageTransition;
			};

			Barba.Dispatcher.on( 'newPageReady', function ( current_status, previous_status, html_element_container, new_page_raw_html ) {
				var regx = new RegExp( '<body.*class="([^"]*)">?', 'g' );
				var body_classes = regx.exec( new_page_raw_html );

				if ( body_classes.length ) {
					$( 'body' ).attr( 'class', body_classes[1] );
				}
			} );

			Barba.Dispatcher.on( 'transitionCompleted', function () {
				jQuery( function ( $ ) {
					$( '#barba-wrapper' ).removeClass( 'is-entering' );
				} );
			} );
		}

	}
);

define( 'loading', // module name
	[ // dependencies
		'jquery',
		// 'magnific',
		// 'slick',
		// 'sticky',
		'imagesLoaded'
	],
	function( $ ) { // callback



		function lazy_bg(elm){
			var to_load = $(elm).find('*[data-style]');
			if ( to_load.length ) {
				to_load.each( function() {

					// pull styles from data attribute
					var thisStyle = $( this ).attr( 'data-style' );

					// push styles into style attribute, add preload class
					// $( this ).attr( 'style', thisStyle )
					// .addClass( 'bg-image-preload' );
					$( this ).addClass( 'bg-image-preload' ).attr( 'style', thisStyle );

					// run bg preload function to catch newly classed elements
					image_preload(this);
				} );
			}
		}

		function lazy_img(elm){
			var to_load = $(elm).find('img[data-src]');
			if(to_load.length){
				$(to_load).each(function(){

					// pull styles from data attribute
					var thisSrc = $(this).attr('data-src');
					var thisSrcSet = $(this).attr('data-srcset');

					// push styles into style attribute, add preload class
					$(this).addClass('image-preload')
					.attr('src', thisSrc)
					.attr('srcset', thisSrcSet);

					// run bg preload function to catch newly classed elements
					image_preload(this);
				});
			}
		}


		function image_preload(elm){
			if($(elm).hasClass('image-preload')){
        $(elm).imagesLoaded( { }, function() {
        }).progress( function( instance, image ) {

        	$(image.img).addClass('loaded');

        });
	    }

	    if($(elm).hasClass('bg-image-preload')){
        $('.bg-image-preload').imagesLoaded( { background: true }, function() {
        }).progress( function( instance, image ) {

					setTimeout(function(){
						$(image.element).addClass('loaded');
					}, 2000);
	        // $(image.element).addClass('loaded');

        });
	    }
		}

		function loadOnPageLoad(){
			// only run this on page load. catches all non-lazy-loaded images

			$('.bg-image-preload').each( function(elm){
				image_preload(this);
				// console.log('loadonpageload bg: '+ elm);
				// console.log('loadonpageload bg: '+ this);
			});
			$('.image-preload').each( function(elm){
				image_preload(this);
				// console.log('loadonpageload img: '+ elm);
				// console.log('loadonpageload img: '+ this);
			});
		}

		function loadOnScroll() {
			$( '.scroll-lazy-load' ).each( function ( i, elm ) {
				var screenBottom = $( window ).scrollTop() + $( window ).height();
				var buffer = 800;
				var below_the_fold = $( elm ).offset().top - buffer;
				var animated = $( elm ).hasClass( 'active' );

				if ( screenBottom >= below_the_fold ) {
					if ( ! animated ) {
						$( elm ).addClass( 'active' );
						lazy_img(elm);
						lazy_bg(elm);
					}
				} else {

				}
			});
		}



		return {
			load_on_scroll: loadOnScroll,
			load_on_page_load: loadOnPageLoad,
			optimize_loading: function() {

				$( 'html' ).removeClass( 'preload' );

			}
		};
	}
);

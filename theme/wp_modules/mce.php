<?php
add_action( 'admin_init', 'my_theme_add_editor_styles' ); // add custom styles to WYSIWYG styles dropdown
// add_action( 'after_setup_theme', 'my_theme_add_editor_fonts' ); // add fonts to WYSIWYG editor
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' ); // insert 'styleselect' into the $buttons array
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); // define styles in the 'styleselect' dropdown
add_filter( 'tiny_mce_before_init', 'my_mce_prevent_class_on_paste' ); // prevent TinyMCE from inserting p1 class on pasted text
// add_filter( 'tiny_mce_before_init', 'add_custom_palette' );
add_filter( 'mce_external_plugins', 'my_theme_mce_external_plugins' ); // include TypeKit fonts in TinyMCE - NOTE: requires TypeKit kitId in file: /tinymce/typekit.tinymce.js



function add_custom_palette( $init ) {
	// NOTE: Set these up per client branding, then uncomment filter at top of file
	$custom_colours = '
		"000000", "grayscale black",
		"3C3C3C", "grayscale gray 1",
		"DCDCDC", "grayscale gray 2",
		"FFFFFF", "grayscale white",
		"FFFFFF", "",
		"FFFFFF", "",
		"FFFFFF", "",
		"FFFFFF", "",
		"7D0F6E", "primary",
		"3F0837", "primary dark",
		"EABBE3", "primary light",
		"CA18B1", "primary accent",
		"28B905", "secondary",
		"7ED569", "secondary dark",
		"D4F1CD", "secondary light",
		"59DB96", "secondary accent"
	';

	// build colour grid default+custom colors
	$init['textcolor_map'] = '['.$custom_colours.']';

	// change the number of rows in the grid if the number of colors changes
	// 8 swatches per row
	$init['textcolor_rows'] = 2;

	return $init;
}

function my_theme_add_editor_styles() {
	add_editor_style( 'style_wysiwyg.css' );
}

function my_theme_add_editor_fonts() {
	$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Rajdhani:400,600' );
	add_editor_style( $font_url );
}

function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

function my_mce_before_init_insert_formats( $init_array ) {
	$style_formats = array(
		// array(
		// 	'title' => 'Buttons',
        //     'items' => array(
        //         array(
        //             'title' => 'Green',
        //             'selector' => 'a',
        //             'classes' => 'btn--green'
        //         ),
        //         array(
        //             'title' => 'Blue Button',
        //             'selector' => 'a',
        //             'classes' => 'btn--blue'
        //         )
        //     )
		// )

		array(
			'title' => 'Headings',
			'items' => array(
				array(
					'title' => 'Heading 1',
					'block' => 'div',
					// 'selector' => 'div, h1, h2, h3, h4, h5, span',
					'classes' => 'h1',
					'wrapper' => false
				),
				array(
					'title' => 'Heading 2',
					'block' => 'div',
					// 'selector' => 'div, h1, h2, h3, h4, h5, span',
					'classes' => 'h2',
					'wrapper' => false
				),
				array(
					'title' => 'Heading 3',
					'block' => 'div',
					// 'selector' => 'div, h1, h2, h3, h4, h5, span',
					'classes' => 'h3',
					'wrapper' => false
				),
				array(
					'title' => 'Heading 4',
					'block' => 'div',
					// 'selector' => 'div, h1, h2, h3, h4, h5, span',
					'classes' => 'h4',
					'wrapper' => false
				),
				array(
					'title' => 'Heading 5',
					'block' => 'div',
					// 'selector' => 'div, h1, h2, h3, h4, h5, span',
					'classes' => 'h5',
					'wrapper' => false
				),
				array(
					'title' => 'Heading 6',
					'block' => 'div',
					// 'selector' => 'div, h1, h2, h3, h4, h5, span',
					'classes' => 'h6',
					'wrapper' => false
				),
				array(
					'title' => 'Subheading 1',
					'block' => 'div',
					// 'selector' => 'div, h1, h2, h3, h4, h5, span',
					'classes' => 's1',
					'wrapper' => false
				),
				array(
					'title' => 'Subheading 2',
					'block' => 'div',
					// 'selector' => 'div, h1, h2, h3, h4, h5, span',
					'classes' => 's2',
					'wrapper' => false
				),
				array(
					'title' => 'Subheading 3',
					'block' => 'div',
					// 'selector' => 'div, h1, h2, h3, h4, h5, span',
					'classes' => 's3',
					'wrapper' => false
				),
				array(
					'title' => 'Subheading 4',
					'block' => 'div',
					// 'selector' => 'div, h1, h2, h3, h4, h5, span',
					'classes' => 's4',
					'wrapper' => false
				),
				array(
					'title' => 'Subheading 5',
					'block' => 'div',
					// 'selector' => 'div, h1, h2, h3, h4, h5, span',
					'classes' => 's5',
					'wrapper' => false
				)
			)
		),
		array(
			'title' => 'Text Styles',
			'items' => array(
				array(
					'title' => 'Emphasis',
					'block' => 'p',
					'selector' => 'p, div, span, ul, ol',
					'classes' => 'emphasis',
					'wrapper' => false
				),
				array(
					'title' => 'Body (small)',
					'block' => 'p',
					'selector' => 'p, div, span, ul, ol',
					'classes' => 'small',
					'wrapper' => false
				),
				array(
					'title' => 'Body (large)',
					'block' => 'p',
					'selector' => 'p, div, span, ul, ol',
					'classes' => 'large',
					'wrapper' => false
				)
			)
		),
		array(
			'title' => 'Buttons/Links',
			'items' => array(
				array(
					'title' => 'Button (primary)',
					'selector' => 'a',
					// 'block' => 'a',
					'classes' => 'button primary',
					'wrapper' => false
				),
				array(
					'title' => 'Button (secondary)',
					'selector' => 'a',
					// 'block' => 'a',
					'classes' => 'button secondary',
					'wrapper' => false
				)
				// array(
				// 	'title' => 'Button (tertiary)',
				// 	'selector' => 'a',
				// 	// 'block' => 'a',
				// 	'classes' => 'button tertiary',
				// 	'wrapper' => false
				// ),
				// array(
				// 	'title' => 'Button (quaternary)',
				// 	'selector' => 'a',
				// 	// 'block' => 'a',
				// 	'classes' => 'button quaternary',
				// 	'wrapper' => false
				// ),
				// array(
				// 	'title' => 'Button (tag)',
				// 	'selector' => 'a',
				// 	'classes' => 'tag',
				// 	'wrapper' => false
				// ),
				// array(
				// 	'title' => 'Video',
				// 	'selector' => 'a',
				// 	'classes' => 'magnific mfp-iframe video-link',
				// 	'wrapper' => false
				// )
			)
		),
		array(
			'title' => 'Margin',
			'items' => array(
				array(
					'title' => 'Top',
					'items' => array(
						array(
							'title' => 'None',
							'selector' => 'div, ul, ol, p, hr, a',
							'classes' => 'mt-0'
						),
						array(
							'title' => 'Small',
							'selector' => 'div, ul, ol, p, hr, a',
							'classes' => 'mt-6'
						),
						array(
							'title' => 'Medium',
							'selector' => 'div, ul, ol, p, hr, a',
							'classes' => 'mt-8'
						),
						array(
							'title' => 'Large',
							'selector' => 'div, ul, ol, p, hr, a',
							'classes' => 'mt-10'
						)
					)
				),
				array(
					'title' => 'Bottom',
					'items' => array(
						array(
							'title' => 'None',
							'selector' => 'div, ul, ol, p, hr, a',
							'classes' => 'mb-0'
						),
						array(
							'title' => 'Small',
							'selector' => 'div, ul, ol, p, hr, a',
							'classes' => 'mb-6'
						),
						array(
							'title' => 'Medium',
							'selector' => 'div, ul, ol, p, hr, a',
							'classes' => 'mb-8'
						),
						array(
							'title' => 'Large',
							'selector' => 'div, ul, ol, p, hr, a',
							'classes' => 'mb-10'
						)
					)
				)
			)
		)//,
		// array(
		// 	'title' => 'Misc.',
		// 	'items' => array(
		// 		array(
		// 			'title' => 'Menu (inline)',
		// 			'selector' => 'ul',
		// 			'classes' => 'inline-menu',
		// 			'wrapper' => false
		// 		),
		// 		array(
		// 			'title' => 'Menu (columns)',
		// 			'selector' => 'ul',
		// 			'classes' => 'column-menu',
		// 			'wrapper' => false
		// 		),
		// 		array(
		// 			'title' => 'Node Line Header',
		// 			'selector' => 'div, h1, h2, h3, h4, h5',
		// 			'classes' => 'node-line-header scroll-trigger',
		// 			'wrapper' => false
		// 		)
		// 	)
		// )
	);

	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;
}

function my_mce_prevent_class_on_paste($in) {
	$in['paste_preprocess'] = "function(pl,o){ o.content = o.content.replace(/p class=\"p[0-9]+\"/g,'p'); o.content = o.content.replace(/span class=\"s[0-9]+\"/g,'span'); }";
	return $in;
}

function my_theme_mce_external_plugins( $plugin_array ) {
	$plugin_array['typekit'] = get_stylesheet_directory_uri() . '/wp_modules/tinymce/typekit.tinymce.js';
	return $plugin_array;
}
?>

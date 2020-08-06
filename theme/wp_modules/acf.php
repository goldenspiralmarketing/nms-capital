<?php
// add_filter('acf/load_field/name=field_name', 'load_acf_options'); // dynamically populate advanced custom field select options
add_action( 'acf/load_field/name=primary_font', 'load_google_web_fonts' );
add_action( 'acf/load_field/name=secondary_font', 'load_google_web_fonts' );
add_filter('acf/load_field/name=hubspot_form', 'load_hubspot_forms'); // dynamically populate advanced custom field select options
add_action( 'acf/load_field/name=tertiary_font', 'load_google_web_fonts' );
add_action( 'acf/input/admin_footer', 'set_acf_color_picker_palette' ); // customize the ACF color picker palette
if ( function_exists('acf_add_options_page') ) { add_acf_options_page(); } // add custom wp admin menu pages/subpages
add_action( 'acf/input/admin_head', 'set_acf_scripts' );


function add_acf_options_page() {
	acf_add_options_page( array(
		'page_title' 	=> 'Site Options',
		'menu_title'	=> 'Site Options',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'manage_options',
		'redirect'		=> true,
		'icon_url'		=> get_stylesheet_directory_uri() . '/img/favicon/favicon-16x16.png'
	) );


	acf_add_options_sub_page( array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'General',
		'menu_slug'		=> 'theme-general-settings',
		'parent_slug'	=> 'theme-settings',
		'capability'	=> 'manage_options',
		'redirect'		=> false
	) );


	// acf_add_options_sub_page( array(
	// 	'page_title' 	=> 'Social Media Settings',
	// 	'menu_title'	=> 'Social Media',
	// 	'menu_slug'		=> 'theme-social-media-settings',
	// 	'parent_slug'	=> 'theme-settings',
	// 	'capability'	=> 'manage_options',
	// 	'redirect'		=> false
	// ) );


	acf_add_options_sub_page( array(
		'page_title' 	=> 'Developer Settings',
		'menu_title'	=> 'Developer Settings',
		'menu_slug'		=> 'theme-developer-settings',
		'parent_slug'	=> 'theme-settings',
		'capability'	=> 'manage_options',
		'redirect'		=> false
	) );

	// acf_add_options_sub_page( array(
	// 	'page_title' 	=> 'Integrations Settings',
	// 	'menu_title'	=> 'Integrations',
	// 	'menu_slug'		=> 'theme-integrations-settings',
	// 	'parent_slug'	=> 'theme-settings',
	// 	'capability'	=> 'manage_options',
	// 	'redirect'		=> false
	// ) );

	acf_add_options_sub_page( array(
		'page_title' 	=> 'Resources Settings',
		'menu_title'	=> 'Resources Settings',
		'menu_slug'		=> 'gs_resource-settings',
		'parent'		=> 'edit.php?post_type=gs_resource',
		'capability'	=> 'manage_options',
		'redirect'		=> false
	) );
}

function load_acf_options( $field ) {
	// Reset choices
	// $field['choices'] = array();

	// Populate a blank option
	// $field['choices'][''] = '';

	// $request = ""
	// $response = do_curl_get($request);
	//
	// if ( $response['http_code'] == 200 ) {
	//     $data = json_decode($response['data'], true);
	//
	//     foreach( $data as $datum )
	//     {
	//         $field['choices'][ $datum['value'] ] = $datum['text'];
	//     }
	//
	// }

	// Important: return the field
	return $field;
}

function load_hubspot_forms( $field ) {
	// Reset choices
    $field['choices'] = array();

    // Populate a blank option
    $field['choices'][''] = 'please enter integration credentials to show forms';

	if(get_option('hubspot-api-key') && get_option('hubspot-forms-api-endpoint')){
		$field['choices'][''] = '';

		$response = do_curl( array(
			'endpoint' => get_option('hubspot-forms-api-endpoint') . '?hapikey=' . get_option('hubspot-api-key'),
			'action' => 'GET'
		) );

		if ( $response['httpcode'] == 200 ) {
			$data = $response['result'];

			$new_data = array();

			foreach( $data as $datum ) {
				$new_data[] = array(
					'guid' => $datum['guid'],
					'name' => $datum['name']
				);
			}

			$name = array_column( $new_data, 'name' );
			array_multisort( $name, SORT_ASC, $new_data );

			foreach ( $new_data as $datum ) {
				$field['choices'][ $datum['guid'] ] = $datum['name'];
			}
		}
	}


	// Important: return the field
	return $field;
}

function load_google_web_fonts( $field ) {
	// AIzaSyBJuS6YtnlBKhcpgxtg9FH9R8XABUo-EAk
	// Reset choices
	$field['choices'] = array();

	// Populate a blank option
	$field['choices'][''] = '';

	$response = do_curl( array(
		'endpoint' => 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBJuS6YtnlBKhcpgxtg9FH9R8XABUo-EAk&sort=alpha',
		'action' => 'GET'
	) );

// echo "<pre>";
// print_r( $response['result']['items'] );
// echo "</pre>";

	if ( $response['httpcode'] == 200 ) {
	    // $data = json_decode($response['result'], true);

	    foreach( $response['result']['items'] as $datum ) {
	        $field['choices'][ $datum['family'] ] = $datum['family'];
	    }

	}

	// Important: return the field
	return $field;
}

function set_acf_color_picker_palette() {
	$color_palette_options = array();
	$counter = 0;
	if ( have_rows('color_palette', 'option') ) {
		while ( have_rows('color_palette', 'option') ) : the_row();
			$color_palette_options[] = "'" . get_sub_field('color') . "'";
			$counter++;
		endwhile;
	}

	if ( count($color_palette_options) ) :
		?>
		<script type="text/javascript">
		(function($) {
			acf.add_filter('color_picker_args', function ( args, $field ) {
				args.palettes = [<?=implode(',', $color_palette_options)?>];
				return args;
			});
		})(jQuery);
		</script>
		<?php
	endif;
}


add_filter( 'post_type_selector_post_types', function( $post_types, $field ) {
	// $post_types['foo'] = get_post_type_object( 'foo' ); // NOTE: add non-public post type to ACF post type selector
	unset( $post_types['post'] ); // NOTE: remove post type from ACF post type selector
	unset( $post_types['page'] );
	return $post_types;
}, 10, 2 );


function set_acf_scripts() {
	global $post;

	$field = get_field_object( 'solution_gradient', get_the_ID( $post ) );
	$field_key = $field['key'];
?>
	 <script type="text/javascript">
		jQuery( function ( $ ) {
			var field_name = '[name="acf[<?php echo $field_key; ?>]"]';
			$( field_name ).on( 'change', function () {
				$( '.solution-gradient' ).removeClass( function (index, className) {
					return ( className.match( /(^|\s)gradient-\S+/g ) || [] ).join( ' ' );
				} );
				$( '.solution-gradient' ).addClass( 'gradient-' + $( this ).val() );
			} );
			if ( $( field_name ).length > 1 ) {
				$( '.solution-gradient' ).addClass( 'gradient-' + $( $( field_name )[1] ).val() );
			}
		} );
	</script>
<?php
}


add_action('acf/render_field_settings/', 'add_readonly_and_disabled_to_acf_fields');
function add_readonly_and_disabled_to_acf_fields($field) {
	acf_render_field_setting( $field, array(
		'label'      => __('Read Only?','acf'),
		'instructions'  => '',
		'type'      => 'radio',
		'name'      => 'readonly',
		'choices'    => array(
			0        => __("No",'acf'),
			1        => __("Yes",'acf'),
		),
		'layout'  =>  'horizontal',
	));
	acf_render_field_setting( $field, array(
		'label'      => __('Disabled?','acf'),
		'instructions'  => '',
		'type'      => 'radio',
		'name'      => 'disabled',
		'choices'    => array(
			0        => __("No",'acf'),
			1        => __("Yes",'acf'),
		),
		'layout'  =>  'horizontal',
	));
}

/*************************************************************/
/*   Friendly Block Titles                                  */
/***********************************************************/
// function developer_options_module_title( $title, $field, $layout, $i ) {
// 	// if ( $value = get_sub_field( 'test_name' ) ) {
// 	// 	return $value;
// 	// } else {
// 	// 	foreach ( $layout['sub_fields'] as $sub ) {
// 	// 		if( $sub['name'] == 'test_name' ) {
// 	// 			$key = $sub['key'];
// 	// 			if ( array_key_exists( $i, $field['value'] ) && $value = $field['value'][$i][$key] ) {
// 	// 				return $value;
// 	// 			}
// 	// 		}
// 	// 	}
// 	// }
// 	// if ( $value = get_sub_field( 'test_name' ) ) {
// 	// 	$title = '<strong>' . $value . '</strong> - (' . $title . ')';
// 	// }
// 	// return $title;
//
// 	ob_start();
//
// 	echo '<pre style="display:none;">';
// 	print_r( $field );
// 	echo '</pre>';
//
// 	$ret = ob_get_contents();
// 	ob_end_clean();
//
// 	return $title;
// }
// add_filter( 'acf/fields/flexible_content/layout_title/name=developer_options_module_title', 'developer_options_module_title', 10, 4 );

function my_acf_flexible_content_layout_title( $title, $field, $layout, $i ) {

	$module_name = get_sub_field( 'module_name' );

	if ( $module_name ) {
		// $title .= ' - "' . $module_name . '"';
		$title = '<strong>' . $module_name . '</strong> (' . $title . ')';
	}
	if ( get_sub_field( 'disable_module' ) ) {
		$title = '<span style="color:#ccc;">' . $title . '</span> <strong style="color:red;">DISABLED</strong>';
	}
	// return
	return $title;

}

// name
add_filter('acf/fields/flexible_content/layout_title/name=page_modules', 'my_acf_flexible_content_layout_title', 10, 4);




function my_acf_format_value( $value, $post_id, $field ) {

	// search for the word "IoT" and make sure the "o" is lowercase
	if ( strpos( $value, 'IoT' ) !== false ) {
		$value = str_replace( 'IoT', 'I<span class="force-lowercase">o</span>T', $value );
	}

	// serach for the word "eCommerce" and make sure the "e" is lowercase
	if ( strpos( $value, 'eCommerce' ) !== false ) {
		$value = str_replace( 'eCommerce', '<span class="force-lowercase">e</span>Commerce', $value );
	}


	// return
	return $value;
}


// dynamically load color repeater values for type color options
// via https://www.advancedcustomfields.com/resources/dynamically-populate-a-select-fields-choices/
// function acf_load_color_field_choices( $field ) {
//     // reset choices
//     $field['choices'] = array();
//
//     if( have_rows('brand_colors', 'option') ) {
//         while( have_rows('brand_colors', 'option') ) {
//
//             // instantiate row
//             the_row();
//
//             // vars
//             $value = get_sub_field('color_value');
//             $label = get_sub_field('color_label');
//
//             // append to choices
//             $field['choices'][ $value ] = $label;
//         }
//     }
//     // return the field
//     return $field;
// }
//
// // load values to populate the 'color_select' dropdown
// add_filter('acf/load_field/name=color_select', 'acf_load_color_field_choices');
// add_filter('acf/load_field/name=background_color_select', 'acf_load_color_field_choices');

add_filter('acf/format_value/type=text', 'my_acf_format_value', 10, 3);
add_filter('acf/format_value/type=textarea', 'my_acf_format_value', 10, 3);
add_filter('acf/format_value/type=wysiwyg', 'my_acf_format_value', 10, 3);
?>

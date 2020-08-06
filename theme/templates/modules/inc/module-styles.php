<?php

	// Zero-padding options
	if ( get_sub_field( 'modulestyle_remove_padding' ) ) {
		$unpads = get_sub_field( 'modulestyle_remove_padding' );
		if ( in_array( 'top', $unpads ) ) {
			$classes[] = 'pt-0';
		}

		if ( in_array( 'bottom', $unpads ) ) {
			$classes[] = 'pb-0';
		}
	}

	// Text colors
	if ( get_sub_field( 'modulestyle_text_color' ) ) {
		$classes[] = 'text-' . get_sub_field( 'modulestyle_text_color' );
	}

	// background colors
	if ( get_sub_field( 'modulestyle_background_color' ) ) {
		$classes[] = 'bg-' . get_sub_field( 'modulestyle_background_color' );
	}

?>

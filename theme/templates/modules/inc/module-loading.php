<?php

	$lazy_active = get_field('lazy_loading', 'options');

	$count = get_query_var( 'flex_counter' );
	$trigger = get_query_var( 'lazy_load_trigger' );
	$flex_id = get_row_layout() . '_' . $count;

	if ($lazy_active && $count >= $trigger) {
		$lazy_load = true;
		$classes[] = 'scroll-lazy-load';
	}

?>

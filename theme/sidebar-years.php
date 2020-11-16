<!-- sidebar-years.php -->
<?php
	$args_year = array(
			'type'            => 'yearly',
			'limit'           => '',
			// 'before'          => '<li>',
			// 'after'           => '</li>',
			'show_post_count' => false,
			'echo'            => 1,
			'order'           => 'DESC',
		    'post_type'     => 'post'
		    );

?>

	<aside class="taxonomy-sidebar sticky">
		<h5>Year</h5>
		<ul class="taxonomy-list">
			<li>
				<a href="/news/">All</a>
			</li>
			<?php wp_get_archives( $args_year ); ?>
		</ul>
	</aside>

<?php
global $post;

if ( $post->post_parent > 0 ) :

	$page_id = $post->ID;

	if ( is_home() ) { // if on the posts home page
		$page_id = get_option('page_for_posts');
	}

	$is_blog_index_listing = false;

	if( have_rows('more_reading', $page_id) ):
		?>
		<aside class="sidebar-posts">
		<?php
			while ( have_rows('more_reading', $page_id) ) : the_row($page_id);
				// override $post
				$post = get_sub_field('reading_item');
				setup_postdata( $post );

				$blog_item_size = '-sm';

				include 'templates/modules/blog-item.php';

				wp_reset_postdata();

			endwhile;
		?>
		</aside>
		<?php
	endif;
endif;
?>

<!-- featured.php -->
<?php
$args = array(
	'posts_per_page'	=> 1,
	'post_type'			=> 'post',
	'post__in'			=> get_option( 'sticky_posts' ),
	'orderby'			=> array(
		'post_date' => 'desc'
	)
);
$featured_query = new WP_Query($args);
?>

<?php
if ( $featured_query->have_posts() ):
	while( $featured_query->have_posts() ) : $featured_query->the_post();

		$background = '';
		if ( has_post_thumbnail() ) {
			$image_url = get_the_post_thumbnail_url();
			$background = "background-image: url('" . $image_url . "')";
		}
		?>
		<article class="featured-post" style="<?=$background?>">
			<div class="header flex-middle flex-between">
				<div class="photo-caption">Featured Article</div>
				<div class="photo-caption">Events // <?php echo get_the_date(); ?></div>
			</div>
			<div class="content">
				<a class="h1" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<a class="cta slashes-left" href="<?php the_permalink(); ?>">Read More</a>
			</div>
		</article>
	<?php
	endwhile;
endif;

wp_reset_query();
?>

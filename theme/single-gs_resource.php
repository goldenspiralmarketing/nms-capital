<!-- Single Resource -->

<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<?php
	$post_type_object = get_post_type_object( get_post_type() );
	?>

	<main role="main">

		<div class="single-outer pt-8 pb-8">

			<div class="single-inner">

				<div class="single-content-container">

					<div class="single-hero">
						<div class="s3"><?php echo $post_type_object->labels->singular_name; ?></div>
						<div class="h1"><?php the_title(); ?></div>
					</div>

					<div class="single-content">

						<div class="wysiwyg">
							<?php the_field( 'resources_content' ); ?>
						</div>

						<hr>

						<div class="single-content-cta">
							<div><a href="/<?php echo $post_type_object->rewrite['slug']; ?>/" class="button tertiary">Back to <?php echo $post_type_object->labels->name; ?></a></div>
						</div>

					</div>
				</div>

				<?php if ( get_the_post_thumbnail() ) : ?>
					<div class="single-sidebar-container">

						<div class="single-sidebar" data-sticky="true" data-sticky-class="single-sidebar" data-sticky-parent-class="single-outer" data-sticky-offset-pixels="20">
							<div class="single-sidebar-image">
								<?php the_post_thumbnail( 'thumbnail-square' ); ?>
							</div>
						</div>

					</div>
				<?php endif; ?>

			</div>

		</div>

	</main>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

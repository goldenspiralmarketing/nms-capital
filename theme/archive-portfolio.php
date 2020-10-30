<!-- index.php -->
<?php $page_for_posts_id = get_option( 'page_for_posts' ); ?>
<?php $page_for_posts_obj = get_post( $page_for_posts_id ); ?>

<?php get_header(); ?>

	<main role="main">
		<?php if ( have_rows('page_modules', $page_for_posts_id) ) : ?>
			<?php set_query_var( 'flex_counter', 0 ); ?>
			<?php set_query_var( 'lazy_load_trigger', 3 ); ?>
						<?php while ( have_rows('page_modules', $page_for_posts_id) ) : the_row(); ?>
							<?php get_template_part( 'modules' ); ?>
						<?php set_query_var( 'flex_counter', get_query_var( 'flex_counter' ) + 1 ); ?>
						<?php endwhile; ?>
					<?php endif; ?>

		<section class="listing-section">
			<div class="gs-container">
				<div class="sidebar-content">
					<?php get_sidebar(); ?>
				</div>
				<div class="main-content">

					<?php get_template_part( 'loop' ); ?>

					<?php if ( function_exists( 'pagination' ) ) { pagination(); } ?>

				</div>
			</div>
		</section>

	</main>

<?php get_footer(); ?>

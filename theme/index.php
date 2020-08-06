<!-- index.php -->
<?php $page_for_posts_id = get_option( 'page_for_posts' ); ?>
<?php $page_for_posts_obj = get_post( $page_for_posts_id ); ?>

<?php get_header(); ?>

	<main role="main">

		<?php set_query_var( 'hero_alt_title', apply_filters( 'the_title', $page_for_posts_obj->post_title ) ); ?>
		<?php set_query_var( 'hero_description', apply_filters( 'the_content', $page_for_posts_obj->post_content ) ); ?>
		<?php get_template_part( 'templates/partials/hero', 'cpt' ); ?>

		<section class="listing-section">
			<div class="gs-container">
				<div class="main-content">

					<?php get_template_part( 'loop' ); ?>

					<?php if ( function_exists( 'pagination' ) ) { pagination(); } ?>

				</div>
				<div class="sidebar-content">

					<?php get_sidebar(); ?>

				</div>
			</div>
		</section>

	</main>

<?php get_footer(); ?>

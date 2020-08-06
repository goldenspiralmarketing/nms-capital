<!-- archive.php -->
<?php $queried_object = get_queried_object(); ?>
<?php $hero_title = ! empty( $queried_object->labels ) ? $queried_object->labels->name : $queried_object->name; ?>

<?php get_header(); ?>

	<main role="main">

		<?php set_query_var( 'hero_alt_title', $hero_title ); ?>
		<?php set_query_var( 'hero_description', $queried_object->description ); ?>
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

<!-- Archive Page - Resources Type -->
<?php $queried_object = get_queried_object(); ?>

<?php get_header(); ?>

	<main role="main">

		<?php set_query_var( 'hero_alt_title', 'Resources / ' . $queried_object->name ); ?>
		<?php set_query_var( 'hero_description', $queried_object->description ); ?>
		<?php get_template_part( 'templates/partials/hero', 'cpt' ); ?>

		<section class="listing-section">
			<div class="gs-container">
				<div class="main-content">

					<?php get_template_part( 'loop' ); ?>

					<?php if ( function_exists( 'pagination' ) ) { pagination(); } ?>

				</div>
				<div class="sidebar-content">

					<?php get_sidebar( 'gs_resource_type' ); ?>

				</div>
			</div>

		</section>

	</main>

<?php get_footer(); ?>

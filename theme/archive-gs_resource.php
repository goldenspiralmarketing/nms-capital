<!-- Archive Page - Resources -->

<?php
$queried_object = get_queried_object();
$plural_label = $queried_object->labels->name;
?>

<?php get_header(); ?>

	<main role="main">

		<?php $hero_title = ! empty( get_field( 'resources_page_title', 'option' ) ) ? get_field( 'resources_page_title', 'option' ) : $plural_label; ?>
		<?php set_query_var( 'hero_alt_title', $hero_title ); ?>
		<?php set_query_var( 'hero_description', get_field( 'resources_page_description', 'option' ) ); ?>
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

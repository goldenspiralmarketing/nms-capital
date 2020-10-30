
<?php $portfolio_listing_id = get_field( 'portfolio_listing', 'option' ); ?>
<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );  ?>


<!-- Portfolio Listing Module -->
<?php
// Define vars
$module_default_classes = array( 'gs-module', 'portfolio-listing-module' );
$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
$classes = array_merge( $module_default_classes, $module_custom_classes );
$flex_id = '';
$lazy_load = false;

// Dynamic includes
include( 'templates/inc/module-styles.php' );
include( 'templates/inc/module-loading.php');

// Module conditionals

?>

<?php get_header(); ?>

	<main role="main">
		<?php if ( have_rows('page_modules', $portfolio_listing_id) ) : ?>
			<?php set_query_var( 'flex_counter', 0 ); ?>
			<?php set_query_var( 'lazy_load_trigger', 3 ); ?>
						<?php while ( have_rows('page_modules', $portfolio_listing_id) ) : the_row(); ?>
							<?php get_template_part( 'templates/modules/hero' ); ?>
						<?php set_query_var( 'flex_counter', get_query_var( 'flex_counter' ) + 1 ); ?>
						<?php endwhile; ?>
					<?php endif; ?>

					<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

						<div class="gs-module-container"><!-- container -->

							<div class="gs-module-column"><!-- column -->
								<?php get_template_part( 'templates/navigation/portfolio-nav'); ?>
								<div class="current-taxonomy text-center">
									<?php $taxonomy_name = get_taxonomy($term->taxonomy); ?>
									<div class="s2 text-color-accent"><?php echo $taxonomy_name->labels->singular_name ; ?>: <?php echo $term->name ?></div>
								</div>
								<div class="portfolio-listing-container">

									<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
										<?php get_template_part( 'templates/partials/portfolio-single' ); ?>
								<?php endwhile; else: ?> <p>Sorry, there are no posts to display</p> <?php endif; ?>
								<?php wp_reset_query(); ?>
								</div>
							</div><!-- column -->

						</div><!-- container -->

					</section>

	</main>

<?php get_footer(); ?>

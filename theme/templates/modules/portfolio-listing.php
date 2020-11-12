<?php if ( get_row_layout() == 'portfolio_listing_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Team Listing Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'portfolio-listing-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = '';
		$lazy_load = false;

		// Dynamic includes
		include( 'inc/module-styles.php' );
		include( 'inc/module-loading.php');

		// Module conditionals

		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->
					<?php get_template_part( 'templates/navigation/portfolio-nav'); ?>
					<div class="portfolio-listing-container filterable-container">
						<?php

						 $args = array(
						 'post_type' => 'portfolio',
						 'posts_per_page'	=> -1,
							'orderby'			=> 'title',
							'order'				=> 'ASC'
						 );
						 $the_query = new WP_Query( $args );

						?>

						<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php get_template_part( 'templates/partials/portfolio-single' ); ?>
					<?php endwhile; else: ?> <p>Sorry, there are no posts to display</p> <?php endif; ?>
					<?php wp_reset_query(); ?>
					</div>
					<div class="filterable-error pt-5 pb-5">
						<div class="s2 text-center">
							No Results Found
						</div>
						<div class="large text-center">
							Try different keyworks or remove search filters
						</div>
					</div>
				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

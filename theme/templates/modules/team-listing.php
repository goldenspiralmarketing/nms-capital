<?php if ( get_row_layout() == 'team_listing_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Team Listing Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'team-listing-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = '';
		$lazy_load = false;
		$full_bleed = false;

		// Dynamic includes
		include( 'inc/module-styles.php' );
		include( 'inc/module-loading.php');

		// Module conditionals
		if ( get_sub_field( 'team_listing_full_bleed' ) ) {
			$full_bleed = true;
			$position = get_sub_field('team_listing_full_bleed_image_position');
			$bg_size = get_sub_field('team_listing_full_bleed_image_size');
			$ratio = get_sub_field('team_listing_full_bleed_image_ratio');

			$classes[] = 'full-bleed';
		}

		if ( get_sub_field( 'team_listing_reverse_layout' ) ) {
			$classes[] = 'reverse';
		}

		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->
					<?php get_template_part( 'templates/navigation/team-nav'); ?>
					<?php

					$args = array(
						'post_type' => 'team',
						'posts_per_page'	=> -1,
						'meta_key'			=> 'team_member_last_name',
						'orderby'			=> 'meta_value',
						'order'				=> 'ASC',
						'tax_query'      => array(
							array(
								'taxonomy' => 'role',
								'terms' => 'operating-executive-council',
								'field' => 'slug',
								'operator' => 'NOT IN'
							)
						)
					);
					$the_query = new WP_Query( $args );

					?>

					<?php if ( $the_query->have_posts() ) : ?>
						<div class="team-listing-container active">
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<?php get_template_part( 'templates/partials/team-member-single' ); ?>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
					<?php wp_reset_query(); ?>

					<?php

					$args = array(
						'post_type' => 'team',
						'posts_per_page'	=> -1,
						'meta_key'			=> 'team_member_last_name',
						'orderby'			=> 'meta_value',
						'order'				=> 'ASC',
						'tax_query'      => array(
							array(
								'taxonomy' => 'role',
								'terms' => 'operating-executive-council',
								'field' => 'slug',
								'operator' => 'IN'
							)
						)
					);
					$additional_query = new WP_Query( $args );

					?>
					<?php if ( $additional_query->have_posts() ) : ?>
						<div class="team-listing-container team-listing-container--executive active">
							<?php if(get_sub_field('team_divider_heading')): ?>
								<div id="divider" class="executive-council-header wyswiyg">
									<?php echo get_sub_field('team_divider_heading'); ?>
								</div>
							<?php endif; ?>
							<?php while ( $additional_query->have_posts() ) : $additional_query->the_post(); ?>
								<?php get_template_part( 'templates/partials/team-member-single' ); ?>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
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

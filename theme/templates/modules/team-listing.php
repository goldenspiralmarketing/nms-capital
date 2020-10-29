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
					<div class="team-listing-container">
						<?php

						 $args = array(
						 'post_type' => 'team',
						 'posts_per_page'	=> -1,
							'meta_key'			=> 'team_member_last_name',
							'orderby'			=> 'meta_value',
							'order'				=> 'ASC'
						 );
						 $the_query = new WP_Query( $args );

						?>

						<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php get_template_part( 'templates/partials/team-member-single' ); ?>
					<?php endwhile; else: ?> <p>Sorry, there are no posts to display</p> <?php endif; ?>
					<?php wp_reset_query(); ?>
					</div>
				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

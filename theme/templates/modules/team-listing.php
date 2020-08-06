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
					<?php if( have_rows('member_listing') ): ?>
					<div class="team-listing-container">
						<?php while( have_rows('member_listing') ): the_row(); ?>
							<div class="team-listing__single">
								<?php

								$post_object = get_sub_field('team_member_single');

								if( $post_object ):
									$post = $post_object;
									setup_postdata( $post );
									?>
									<div class="team-listing-content">
										<div class="wysiwyg"><?php the_content(); ?></div>
									</div>
									<div class="team-listing-image-container">
										<?php if ( get_the_post_thumbnail() ) : ?>
											<?php $img = get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>
											<?php if ( $full_bleed ) : ?>
												<?php
													$data_attr = $lazy_load ? 'data-' : '';
													// add preload class if NOT lazy-loaded
													$bg_class = $lazy_load ? '' : 'bg-image-preload';
												?>
												<div class="team-listing-image absolute-fill <?=$bg_class?>" <?php echo $data_attr; ?>style="background-image:url('<?php echo $img; ?>'); background-position: <?=$position?>; background-size: <?=$bg_size?>; padding-top: <?=$ratio?>%;"></div>
											<?php else : ?>
												<?php $img =  get_post_thumbnail_id();?>
												<?php $attrs = ! $lazy_load ? array( 'class' => 'image-preload on-scroll-fade-up') : array( 'class' => 'lazy on-scroll-fade-up' ); ?>
												<?php echo wp_get_attachment_image( $img, 'full', false, $attrs ); ?>
											<?php endif; ?>
										<?php endif; ?>
									</div>
							    <?php wp_reset_postdata(); ?>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
					<?php endif; ?>
				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

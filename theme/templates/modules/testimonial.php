<?php if ( get_row_layout() == 'testimonial_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Testimonial Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'testimonial-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$slides_classes = get_sub_field( 'testimonial_testimonials_classes' );
		$flex_id = '';
		$lazy_load = false;

		// Dynamic includes
		include( 'inc/module-styles.php' );
		include( 'inc/module-loading.php');

		// Module conditionals
		if ( get_sub_field( 'testimonial_bleed_testimonials_to_edge' ) ) {
			$classes[] = 'full-bleed';
		}

		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">
			<div class="gs-module-container"><!-- container -->
				<div class="gs-module-column"><!-- column -->

					<?php if(get_sub_field('testimonial_left')): ?>
						<div class="testimonial-left">
							<div class="wysiwyg">
								<?php echo get_sub_field('testimonial_left'); ?>
							</div>
						</div>
					<?php endif; ?>

					<?php $slick_settings = '{"autoplay": true, "slidesToShow": 1, "slidesToScroll": 1, "dots": true, "arrows": false, "autoplaySpeed": 5000, "speed": 1500}'; ?>
					<div class="slide-container slick <?php echo $slides_classes; ?>" data-slick='<?php echo $slick_settings; ?>'>

						<?php if ( have_rows( 'testimonial_testimonials' ) ) : ?>
							<?php while ( have_rows( 'testimonial_testimonials' ) ) : the_row(); ?>

								<?php $content = get_sub_field( 'testimonials_testimonial_content' ); ?>
								<?php $attribution_image = get_sub_field( 'testimonials_testimonial_attribution_image' ); ?>

								<div class="testimonial-slide">
									<div class="inner-slide">
										<span class="quote-mark">&ldquo;</span>

										<div class="slide-content-container">
											<div class="slide-content"><?php echo $content; ?></div>
											<div class="slide-attribution-container">

												<?php if ( $attribution_image ) : ?>
													<?php // $data_attr = $lazy_load ? 'data-' : ''; ?>
													<img class="slide-content attribution-image" src="<?php echo $attribution_image['sizes']['large']; ?>">
												<?php endif; ?>

												<?php if ( get_sub_field( 'testimonials_testimonial_attribution_name' ) || get_sub_field( 'testimonials_testimonial_attribution_title' ) ) : ?>
													<div class="slide-attribution">
														<?php if ( get_sub_field( 'testimonials_testimonial_attribution_title' ) ) : ?>
															<div class="s5 slide-attribution__title"><?php the_sub_field( 'testimonials_testimonial_attribution_title' ); ?></div>
														<?php endif; ?>
														<?php if ( get_sub_field( 'testimonials_testimonial_attribution_name' ) ) : ?>
															<div class="text-left slide-attribution__signature"><?php the_sub_field( 'testimonials_testimonial_attribution_name' ); ?></div>
														<?php endif; ?>
													</div>
												<?php endif; ?>

											</div>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>

					</div><!-- /.flex-grid -->
				</div><!-- column -->
			</div><!-- container -->
		</section>

	<?php endif; ?>

<?php endif; ?>

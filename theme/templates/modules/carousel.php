<?php if ( get_row_layout() == 'carousel_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Carousel Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'carousel-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$slides_classes = get_sub_field( 'carousel_slides_classes' );
		$flex_id = '';
		$lazy_load = false;

		// Dynamic includes
		include( 'inc/module-styles.php' );
		include( 'inc/module-loading.php');

		// Module conditionals
		if ( get_sub_field( 'carousel_slide_bleed_carousel_to_edge' ) ) {
			$classes[] = 'full-bleed';
		}

		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->

					<?php $slick_settings = '{"autoplay": false, "slidesToShow": 1, "slidesToScroll": 1, "dots": true, "arrows": false, "autoplaySpeed": 5000, "speed": 1500}'; ?>
					<div class="slide-container slick <?php echo $slides_classes; ?>" data-slick='<?php echo $slick_settings; ?>'>

						<?php if ( have_rows( 'carousel_slides' ) ) : ?>
							<?php while ( have_rows( 'carousel_slides' ) ) : the_row(); ?>

								<?php
									$background_image = get_sub_field( 'carousel_slide_background_image' );
									$content = get_sub_field( 'carousel_slide_content' );
									$featured_image = get_sub_field( 'carousel_slide_featured_image' );
									$data_attr = $lazy_load ? 'data-' : '';
									// add preload class if NOT lazy-loaded
									$bg_class = $lazy_load ? '' : 'bg-image-preload';
								?>

								<div class="carousel-slide <?php echo $background_image ? 'has-background-image' : ''; ?> <?php echo $background_image && ! $content && ! $featured_image ? 'background-image-only' : ''; ?>">

									<?php if($background_image): ?>
										<div class="bg-image absolute-fill <?=$bg_class?>" <?php echo $data_attr; ?>style="background-image: url('<?php echo $background_image['url']; ?>');"></div>
									<?php endif; ?>

									<div class="inner-slide">

										<div class="slide-content-container <?php echo $featured_image ? 'has-featured-image' : ''; ?>">
											<div class="slide-content wysiwyg"><?php echo $content; ?></div>
											<?php if ( $featured_image ) : ?>
												<?php $attrs = ! $lazy_load ? array( 'class' => 'image-preload on-scroll-fade-up' ) : array( 'class' => 'lazy on-scroll-fade-up' ); ?>
												<div class="slide-content featured-image">
													<?php echo wp_get_attachment_image( $featured_image['ID'], 'full', false, $attrs ); ?>
												</div>
											<?php endif; ?>
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

<?php if ( get_row_layout() == 'banner_image_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Banner Image Module -->
		<?php //$flex_id = get_row_layout() . '_' . get_query_var( 'flex_counter' ); ?>

		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'banner-image-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = '';
		$lazy_load = false;

		// Dynamic includes
		include( 'inc/module-styles.php' );
		include( 'inc/module-loading.php');

		// Module conditionals
		if ( get_sub_field( 'banner_image_full_bleed' ) ) {
			$classes[] = 'full-bleed';
		}
	 	?>
		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->

					<div class="banner-image">
						<?php
						$image = get_sub_field( 'banner_image_image' );
						$attrs = ! $lazy_load ? array( 'class' => 'image-preload') : array( 'class' => 'lazy' );
						?>
						<?php echo wp_get_attachment_image( $image['ID'], 'full', false, $attrs ); ?>
					</div>

				</div><!-- column -->

			</div><!-- container -->

		</section>


	<?php endif; ?>

<?php endif; ?>

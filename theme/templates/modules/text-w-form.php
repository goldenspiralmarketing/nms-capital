<?php if ( get_row_layout() == 'text_wform_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Text w/Form Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'text-w-form-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = get_row_layout() . '_' . get_query_var( 'flex_counter' );

		// Dynamic includes
		include( 'inc/module-styles.php' );
		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->

					<div class="text-w-form-container">

						<div class="text-w-form-content-container">

							<div class="text-w-form-content">
								<?php if ( get_sub_field( 'text_wform_content' ) ) : ?>
									<div class="wysiwyg"><?php the_sub_field( 'text_wform_content' ); ?></div>
								<?php endif; ?>
							</div>

							<div class="text-w-form-form">
								<?php if ( get_sub_field( 'hubspot_form' ) ) : ?>
									<div class="embedded-form" data-portal-id="<?php echo get_option('hubspot-client-id'); ?>" data-form-id="<?php the_sub_field( 'hubspot_form' ); ?>"></div>
								<?php endif; ?>
							</div>

						</div>

					</div>

				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

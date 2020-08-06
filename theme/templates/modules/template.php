<?php if ( get_row_layout() == 'template_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Template Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'template-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = get_row_layout() . '_' . get_query_var( 'flex_counter' );

		// Dynamic includes
		include( 'inc/module-styles.php' );
		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container template-outer"><!-- container -->

				<div class="template-container">

					<?php get_template_part( get_sub_field( 'template_name' ) ); ?>

				</div>

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

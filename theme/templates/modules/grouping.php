<?php if ( get_row_layout() == 'grouping_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Grouping Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'grouping-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );

		// Dynamic includes
		include( 'inc/module-styles.php' );
		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>">

			<div class="gs-module-container grouping-module-outer"><!-- container -->

				<div class="grouping-container">

					<?php if ( have_rows('grouping_modules_page_modules') ) : ?>
						<?php while ( have_rows('grouping_modules_page_modules') ) : the_row(); ?>

							<?php get_template_part( 'modules' ); ?>

							<?php //$flex_counter += 1; ?>
							<?php set_query_var( 'flex_counter', get_query_var( 'flex_counter' ) + 1 ); ?>
						<?php endwhile; ?>
					<?php endif; ?>

				</div>

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

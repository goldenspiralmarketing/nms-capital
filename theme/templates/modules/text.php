<?php if ( get_row_layout() == 'text_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Text Module -->
		<?php

		// Define all vars
		$module_default_classes = array( 'gs-module', 'text-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$module_text_size = get_sub_field('text_block_size');
		$text_size = ' text-size-' . $module_text_size;

		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = get_row_layout() . '_' . get_query_var( 'flex_counter' );

		// Dynamic includes
		include( 'inc/module-styles.php' );

		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?><?php echo $text_size; ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->

					<?php $columns = count( get_sub_field( 'text_columns' ) ); ?>
					<?php $first_column_size = get_sub_field( 'text_first_column_size' ); ?>
					<?php $single_column_size = get_sub_field( 'text_single_column_size' ); ?>
					<div class="text-columns-container <?php echo ! empty( $single_column_size ) ? 'single-column-' . $single_column_size['value'] : ''; ?>" data-columns="<?php echo $columns ?>" data-first-column-size="<?php echo $first_column_size; ?>">

						<?php if ( have_rows( 'text_columns' ) ) : ?>
							<?php while ( have_rows( 'text_columns' ) ) : the_row(); ?>

								<div class="text-column">
									<?php $the_content = get_sub_field( 'text_columns_column' ); ?>
									<div class="wysiwyg"><?php readmore($the_content); ?></div>
								</div>

							<?php endwhile; ?>
						<?php endif; ?>

					</div>

				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

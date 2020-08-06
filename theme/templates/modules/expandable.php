<?php if ( get_row_layout() == 'expandable_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Expandable Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'expandable-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = get_row_layout() . '_' . get_query_var( 'flex_counter' );

		// Dynamic includes
		include( 'inc/module-styles.php' );
		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">
			<div class="gs-module-container"><!-- container -->
				<div class="gs-module-column"><!-- column -->
					<div class="expandable-content <?php echo get_sub_field( 'expandable_default_state' ) ? 'open' : ''; ?>">

						<div class="wysiwyg expandable-content-trigger"><?php the_sub_field( 'expandable_header' ); ?></div>

						<div class="expandable-content-container">

						<?php $columns = get_sub_field( 'expandable_columns' ); ?>
						<?php for ( $x = 0; $x < $columns; $x++ ) : ?>
							<?php if ( get_sub_field( 'expandable_content_column_' . ( $x + 1 ) ) ) : ?>

								<div class="expandable-content-column">
									<div class="wysiwyg"><?php the_sub_field( 'expandable_content_column_' . ( $x + 1 ) ); ?></div>
								</div>

							<?php endif; ?>

						<?php endfor; ?>

						</div>

					</div>
				</div><!-- column -->
			</div><!-- container -->
		</section>

	<?php endif; ?>

<?php endif; ?>

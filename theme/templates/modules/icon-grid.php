<?php if ( get_row_layout() == 'icon_grid_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Icon Grid Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'icon-grid-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = get_row_layout() . '_' . get_query_var( 'flex_counter' );

		// Dynamic includes
		include( 'inc/module-styles.php' );

		// Module conditionals
		$classes[] = get_sub_field('icon_grid_layout');

		if ( get_sub_field( 'icon_column_count' ) ) {
			$classes[] = 'icon-column-count-'. get_sub_field('icon_column_count');
		}
		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->

					<div class="icon-grid-content mr-lg-4">
						<?php if ( get_sub_field( 'icon_grid_content' ) ) : ?>
							<div class="wysiwyg"><?php the_sub_field( 'icon_grid_content' ); ?></div>
						<?php endif; ?>
					</div>

					<?php $grid_alignment = get_sub_field( 'icon_grid_alignment' ); ?>

					<div class="icon-grid" data-align="<?php echo ! empty( $grid_alignment ) ? $grid_alignment['value'] : ''; ?>">
						<?php if ( have_rows( 'icon_grid_items' ) ) : while ( have_rows( 'icon_grid_items' ) ) : the_row(); ?>
							<div class="icon-grid-item">
								<div class="icon-grid-item-image">
									<?php $img = get_sub_field( 'icon_grid_item_image' ); ?>
									<?php
									$img_url = $img['url'];
									$img_title = $img['title'];
									$img_alt = $img['alt'];
									$img_caption = $img['caption'];
									?>
									<?php if ( $img ) : ?>
										<img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" title="<?php echo $img_title; ?>">
									<?php endif; ?>
								</div>
								<?php if ( get_sub_field( 'icon_grid_item_title' ) ) : ?>
									<div class="s6 icon-grid-item-title"><?php the_sub_field( 'icon_grid_item_title' ); ?></div>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
					</div>

				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

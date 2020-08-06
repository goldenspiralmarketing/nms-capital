<?php if ( get_row_layout() == 'featured_list_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Featured List Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'featured-list-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = get_row_layout() . '_' . get_query_var( 'flex_counter' );

		// Dynamic includes
		include( 'inc/module-styles.php' );
		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->

					<div class="featured-list">

						<div class="featured-list-content">
							<div class="wysiwyg"><?php the_sub_field( 'featured_list_content' ); ?></div>
						</div>

						<?php if ( have_rows( 'featured_list_lists' ) ) : ?>
							<div class="featured-list-lists">
								<?php while ( have_rows( 'featured_list_lists' ) ) : the_row(); ?>
									<div class="featured-list-list">
										<div class="s3 featured-list-list-title"><?php the_sub_field( 'featured_list_list_title' ); ?></div>
										<?php if ( have_rows( 'featured_list_list_items' ) ) : ?>
											<ul class="featured-list-list-items">
												<?php while ( have_rows( 'featured_list_list_items' ) ) : the_row(); ?>
													<li class="featured-list-list-item"><?php the_sub_field( 'featured_list_list_item' ); ?></li>
												<?php endwhile; ?>
											</ul>
										<?php endif; ?>
									</div>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>

					</div>

				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

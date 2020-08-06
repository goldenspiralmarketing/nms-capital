<?php if ( get_row_layout() == 'card_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Card Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'card-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = '';
		$lazy_load = false;

		// Dynamic includes
		include( 'inc/module-styles.php' );
		include( 'inc/module-loading.php');
		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->

					<?php $columns = get_sub_field( 'card_number_of_columns' ); ?>
					<?php $alignement = get_sub_field( 'card_alignment' ); ?>
					<?php if ( have_rows( 'card_cards' ) ) : ?>

						<div class="cards" data-columns="<?php echo $columns; ?>" data-alignment="<?php echo $alignement; ?>">
							<?php while ( have_rows( 'card_cards' ) ) : the_row(); ?>
								<?php $image = get_sub_field( 'card_image' ); ?>

								<div class="card-container">

									<div class="card <?php echo $image ? 'has-image' : ''; ?>">
										<?php if ( $image ) : ?>
											<div class="card-image">
												<?php
													// turn style into data-style if lazy loading = true
													$data_attr = $lazy_load ? 'data-' : '';
													// add preload class if NOT lazy-loaded
													$bg_class = $lazy_load ? '' : 'bg-image-preload';
												?>
												<div class="absolute-fill <?=$bg_class?>" <?php echo $data_attr; ?>style="background-image:url('<?php echo $image['url']; ?>');"></div>
											</div>
										<?php endif; ?>
										<div class="card-content">
											<div class="wysiwyg"><?php the_sub_field( 'card_content' ); ?></div>
											<?php if ( get_sub_field( 'card_button_url' ) != '' ) : ?>
												<?php $button_text = get_sub_field( 'card_button_text' ) != '' ? get_sub_field( 'card_button_text' ) : 'View'; ?>
												<div class="card-button-container">
													<a href="<?php echo get_sub_field( 'card_button_url' ); ?>" class="button primary"><?php echo $button_text; ?></a>
												</div>
											<?php endif; ?>
										</div>
									</div>

								</div>

							<?php endwhile; ?>
						</div>

					<?php endif; ?>

				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

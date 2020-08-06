<?php if ( get_row_layout() == 'tab_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Tab Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'tab-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = get_row_layout() . '_' . get_query_var( 'flex_counter' );

		// Dynamic includes
		include( 'inc/module-styles.php' );
		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->

					<div class="tabs">

						<?php if ( have_rows( 'tab_tabs' ) ) : ?>
							<div class="tab-control-container">
								<ul class="tab-control" role="tablist">
								<?php $counter = 0; ?>
								<?php while ( have_rows( 'tab_tabs' ) ) : the_row(); ?>
									<?php $title = sanitize_title( get_sub_field( 'tab_section_title' ) ); ?>
									<li role="presentation" class="<?php echo $counter === 0 ? 'active' : ''; ?>">
										<a class="s5" href="#<?php echo $title; ?>" aria-controls="<?php echo $title; ?>" role="tab" data-anchor="<?php echo $title; ?>" data-toggle="tab"><?php the_sub_field( 'tab_section_title' ); ?></a>
									</li>
									<?php $counter += 1; ?>
								<?php endwhile; ?>
								</ul>
							</div>
						<?php endif; ?>

						<?php if ( have_rows( 'tab_tabs' ) ) : ?>
							<div class="tab-content">
							<?php $counter = 0; ?>
							<?php while ( have_rows( 'tab_tabs' ) ) : the_row(); ?>
								<?php $title = sanitize_title( get_sub_field( 'tab_section_title' ) ); ?>
								<div role="tabpanel" class="tab-panel wysiwyg <?php echo $counter === 0 ? 'active' : ''; ?>" id="<?php echo $title; ?>"><?php the_sub_field( 'tab_section_content' ); ?></div>
								<?php $counter += 1; ?>
							<?php endwhile; ?>
							</div>
						<?php endif; ?>

					</div><!-- /.tabs -->

				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

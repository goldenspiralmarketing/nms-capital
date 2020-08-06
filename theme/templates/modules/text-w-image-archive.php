<?php if ( get_row_layout() == 'text_w_image_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Text w/Image Module -->
		<?php $flex_id = get_row_layout() . '_' . get_query_var( 'flex_counter' ); ?>

		<?php
		$module_default_classes = array( 'gs-module', 'text-w-image-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );

		$classes = array_merge( $module_default_classes, $module_custom_classes );

		include( 'inc/module-styles.php' );

		$ratio = 0;

		if ( get_sub_field( 'text_w_image_full_bleed' ) ) {
			$position = get_sub_field('text_w_image_full_bleed_image_position');
			$bg_size = get_sub_field('text_w_image_full_bleed_image_size');
			$ratio = get_sub_field('text_w_image_full_bleed_image_ratio');

			$classes[] = 'full-bleed';
		}

		if ( get_sub_field( 'text_w_image_reverse_layout' ) ) {
			$classes[] = 'reverse';
		}

		$lazy_load = false;
		$lazy_active = get_field('lazy_loading', 'options');

		$count = get_query_var( 'flex_counter' );
		$trigger = get_query_var( 'lazy_load_trigger' );

		if ($lazy_active && $count >= $trigger) {
			$lazy_load = true;
			$classes[] = 'scroll-lazy-load';
		}
		?>
		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->

					<div class="text-w-image-content">
						<?php if ( get_sub_field( 'text_w_image_content' ) ) : ?>
							<?php
								$the_content = get_sub_field( 'text_w_image_content' );
								?>
								<div class="wysiwyg"><?php readmore($the_content); ?></div>
						<?php endif; ?>
					</div>
					<div class="text-w-image-image-container">
						<?php if ( get_sub_field( 'text_w_image_image' ) ) : ?>
							<?php $img = get_sub_field( 'text_w_image_image' ); ?>
							<?php if ( get_sub_field( 'text_w_image_full_bleed' ) ) : ?>
								<?php $data_attr = $lazy_load ? 'data-' : ''; ?>
								<div class="text-w-image-image absolute-fill" <?php echo $data_attr; ?>style="background-image:url('<?php echo $img['url']; ?>'); background-position: <?=$position?>; background-size: <?=$bg_size?>; padding-top: <?=$ratio?>%;"></div>
							<?php else : ?>
								<?php $attrs = ! $lazy_load ? array() : array( 'class' => 'lazy' ); ?>
								<?php echo wp_get_attachment_image( $img['ID'], 'full', false, $attrs ); ?>
							<?php endif; ?>
						<?php endif; ?>
					</div>

				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

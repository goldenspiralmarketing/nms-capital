<?php if ( get_row_layout() == 'text_w_image_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Text w/Image Module -->
		<?php
			// Define all vars
			$module_default_classes = array( 'gs-module', 'text-w-image-module' );
			$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
			$classes = array_merge( $module_default_classes, $module_custom_classes );
			$ratio = '';
			$flex_id = '';
			$lazy_load = false;

			// Dynamic includes
			include( 'inc/module-styles.php' );
			include( 'inc/module-loading.php');

			// Module conditionals
			if ( get_sub_field( 'text_w_image_full_bleed' ) ) {
				$position = get_sub_field('text_w_image_full_bleed_image_position');
				$bg_size = get_sub_field('text_w_image_full_bleed_image_size');

				if(get_sub_field('text_w_image_full_bleed_image_ratio') !== '0'){
					$ratio = 'padding-top:' . get_sub_field('text_w_image_full_bleed_image_ratio') . '%;';
					$ratio_lazy = '';
					if($lazy_load){
						// kinda-hack to set padding-top on bg pre-lazy-load, otherwise it's hidden in data-style attr
						$ratio_lazy = 'style="padding-top:' . get_sub_field('text_w_image_full_bleed_image_ratio') . '%;"';
					}
				}
				$classes[] = 'full-bleed';
			}

			if ( get_sub_field( 'text_w_image_reverse_layout' ) ) {
				$classes[] = 'reverse';
			}
		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->

					<?php $badge_class = ''; ?>
					<?php if ( get_sub_field( 'text_w_image_badge' ) ) {$badge_class = " has-badge";} ?>
					<div class="text-w-image-content<?=$badge_class?>">
						<?php if ( get_sub_field( 'text_w_image_badge' ) ) : ?>
							<?php
								$the_badge = get_sub_field( 'text_w_image_badge' );
								?>
								<div class="badge">
									<img src="<?=$the_badge[url]?>" alt="<?=$the_badge[alt]?>">
								</div>
						<?php endif; ?>
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
								<?php
									// turn style into data-style if lazy loading = true
									$data_attr = $lazy_load ? 'data-' : '';
									// add preload class if NOT lazy-loaded
									$bg_class = $lazy_load ? '' : 'bg-image-preload';
								?>
								<div class="text-w-image-image absolute-fill <?=$bg_class?>" <?php echo $data_attr; ?>style="background-image:url('<?php echo $img['sizes']['extra-large']; ?>'); background-position: <?=$position?>; background-size: <?=$bg_size?>; <?=$ratio?>" <?=$ratio_lazy?>></div>
							<?php else : ?>
								<?php $attrs = ! $lazy_load ? array( 'class' => 'image-preload on-scroll-fade-up') : array( 'class' => 'lazy on-scroll-fade-up' ); ?>
								<?php echo wp_get_attachment_image( $img['ID'], 'full', false, $attrs ); ?>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<?php if ( get_sub_field( 'text_w_image_add_floating_image' ) || get_sub_field( 'text_w_image_add_floating_text' ) ) : ?>
						<div class="text-w-image-floating-container">
							<?php if ( get_sub_field( 'text_w_image_floating_image' )):
								$floating_image = get_sub_field( 'text_w_image_floating_image' )[url]; ?>
								<div class="text-w-image-floating-image" style="background-image: url('<?=$floating_image?>');">
									<?php if(get_sub_field( 'text_w_image_add_floating_text' )):
										$text_left = get_field('text_w_image_floating_text_left');
										$text_right = get_field('text_w_image_floating_text_right');
										$text_button = get_field('text_w_image_floating_button_text');
										$text_button_url = get_field('text_w_image_floating_button_url');
										 ?>
										 <div class="floating-text floating-text--left">
										 	<?=$text_left?>
										 </div>
										 <div class="floating-text floating-text--right">
										 	<?=$text_right?>
										 </div>
										 <a href="<?=$text_button_url?>" class="floating-text floating-text--button">
										 		<?=$text_button?>
										 </a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>

				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

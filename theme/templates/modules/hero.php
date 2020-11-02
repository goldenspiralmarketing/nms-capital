<?php if ( get_row_layout() == 'hero_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Hero Module -->
		<?php
			// Define all vars
			$module_default_classes = array( 'gs-module', 'hero-module' );
			$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
			$classes = array_merge( $module_default_classes, $module_custom_classes );
			$style = get_sub_field( 'hero_style' );
			$featured_image = get_sub_field( 'hero_featured_image' );
			$flex_id = '';
			$lazy_load = false;

			// Dynamic includes
			include( 'inc/module-styles.php' );
			include( 'inc/module-loading.php');

			// Module conditionals
			if($style){
				$classes[] = $style;
			}
			// if ( $style == 'simple' && $featured_image ) {
			if ( $featured_image ) {
				$classes[] = 'has-featured-image bg-primary';
			}
		?>
		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<?php //if($style === 'simple' && $featured_image): ?>
			<?php if($featured_image): ?>
				<?php if( ! $lazy_load ): ?>
					<div class="bg-image absolute-fill bg-image-preload" style="background: url(<?php echo $featured_image['sizes']['extra-large']; ?>) no-repeat center/cover;"></div>
				<?php else: ?>
					<div class="bg-image absolute-fill" data-style="background: url(<?php echo $featured_image['sizes']['extra-large']; ?>) no-repeat center/cover;"></div>
				<?php endif; ?>
			<?php endif; ?>

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->

					<div class="hero-content">
						<div class="left-content">
							<?php  if ( $style === 'centered' && get_sub_field('hero_title') ) : ?>
								<div class="hero-title wysiwyg">
									<?php the_sub_field('hero_title'); ?>
								</div>
							<?php endif; ?>
							<div class="wysiwyg"><?php the_sub_field( 'hero_content_1' ); ?></div>
							<?php /* if ( $style === 'centered' && $featured_image ) : ?>
								<div class="featured-image">
									<?php $attrs = ! $lazy_load ? array() : array( 'class' => 'lazy' ); ?>
									<?php echo wp_get_attachment_image( $featured_image['ID'], 'full', false, $attrs ); ?>
								</div>
							<?php endif; */ ?>
						</div>
						<div class="right-content">

							<?php if ( $style === 'two-column' ) : ?>
								<div class="wysiwyg"><?php the_sub_field( 'hero_content_2' ); ?></div>
							<?php endif; ?>

						</div>
					</div>

				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

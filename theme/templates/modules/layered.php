<?php if ( get_row_layout() == 'layered_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>
		<!-- Layered Module -->
		<?php
			// Define all vars
			$module_default_classes = array( 'gs-module', 'layered-module' );
			$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
			$classes = array_merge( $module_default_classes, $module_custom_classes );
			$lazy_load = false;

			// Dynamic includes
			include( 'inc/module-styles.php' );
			include( 'inc/module-loading.php');

		?>
		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">
			<div class="gs-module-container"><!-- container -->
				<div class="gs-module-column"><!-- column -->
					<div class="layered-content">
						<div class="wysiwyg">
							<?php echo get_sub_field('layered_text'); ?>
						</div>
					</div>
					<?php if( have_rows('layered_images') ): ?>
    			<?php while( have_rows('layered_images') ): the_row(); ?>
					<div class="layered-image">
						<div class="layered-image__wrap">
							<?php
							$bg = '';
							$foreground = '';
							if (get_sub_field('background')){
								$bg = get_sub_field('background')[sizes]['extra-large'];
							}
							if (get_sub_field('foreground')){
								$foreground = get_sub_field('foreground');
							}
							 ?>
							<div class="layered-image__background" style="background-image: url('<?=$bg?>');"></div>
							<img src="<?=$foreground[sizes]['team']?>" alt="<?=$foreground[alt]?>" class="layered-image__foreground">
							<div class="floating-text floating-text--left">
								<?php echo get_sub_field('text_left'); ?>
							</div>
							<div class="floating-text floating-text--right">
								<?php echo get_sub_field('text_right'); ?>
							</div>
							<a class="floating-text floating-text--cta" href="<?php echo get_sub_field('text_cta_url'); ?>">
								<?php echo get_sub_field('text_cta'); ?>
							</a>
						</div>
					</div>
				<?php endwhile; endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
<?php endif; ?>

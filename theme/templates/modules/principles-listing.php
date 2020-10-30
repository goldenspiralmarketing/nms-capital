<?php if ( get_row_layout() == 'principle_listing_module' ) : ?>

	<?php if ( ! get_sub_field( 'disable_module' ) ) : ?>

		<!-- Team Listing Module -->
		<?php
		// Define vars
		$module_default_classes = array( 'gs-module', 'principle-listing-module' );
		$module_custom_classes = explode( ' ', get_sub_field( 'css_class' ) );
		$classes = array_merge( $module_default_classes, $module_custom_classes );
		$flex_id = '';
		$lazy_load = false;

		// Dynamic includes
		include( 'inc/module-styles.php' );
		include( 'inc/module-loading.php');

		// Module conditionals

		?>

		<section id="<?php the_sub_field( 'container_id' ); ?>" class="<?php echo implode( ' ', $classes ); ?>" data-flexid="<?php echo $flex_id; ?>">

			<div class="gs-module-container"><!-- container -->

				<div class="gs-module-column"><!-- column -->
					<div class="principles-listing-container">
						<?php

						$args = array(
						'post_type' => 'principles',
						'posts_per_page'	=> -1,
						 'meta_key'			=> 'principle_number',
						 'orderby'			=> 'meta_value',
						 'order'				=> 'ASC'
						);
						 $the_query = new WP_Query( $args );

						?>

						<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php
							$icon = get_field('principles_icon');
							 ?>
							<div class="principle-single">
								<div class="principle-single__container">
									<div class="principle-single__image">
										<img src="<?=$icon[url]?>" alt="<?=$icon[alt]?>">
									</div>
									<div class="principle-single__content">
										<?php the_content(); ?>
									</div>
								</div>
							</div>
					<?php endwhile; else: ?> <p>Sorry, there are no posts to display</p> <?php endif; ?>
					<?php wp_reset_query(); ?>
					</div>
				</div><!-- column -->

			</div><!-- container -->

		</section>

	<?php endif; ?>

<?php endif; ?>

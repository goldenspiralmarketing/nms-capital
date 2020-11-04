<?php

$background = get_field('subfooter_background', 'option');
$invert = false;
$invert_class = '';


?>
<?php if(is_home()): ?>
	<?php
	$page_for_posts_id = get_option( 'page_for_posts' );
	?>
	<?php if( have_rows('sub_footer_cta', $page_for_posts_id) ): ?>
		<?php while( have_rows('sub_footer_cta', $page_for_posts_id) ): the_row(); ?>
			<?php
			if (get_field('invert_background')) {
				$background = get_field('subfooter_background_inverted', 'option');
				$invert = true;
				$invert_class = ' inverted';
			}
			?>
			<section class="subfooter<?=$invert_class?>">
				<div class="subfooter-background" style="background-image: url('<?=$background['sizes']['extra-large']?>');">
					<?php if(! $invert): ?>
						<div class="subfooter-background__fade"></div>
					<?php endif; ?>
				</div>
				<div class="subfooter-container">
					<?php if( have_rows('sub_footer_card') ): ?>
						<?php while( have_rows('sub_footer_card') ): the_row(); ?>
							<div class="subfooter-card">
								<div class="subfooter-card__title h5">
									<?php echo get_sub_field('card_title') ?>
								</div>
								<div class="subfooter-card__content wysiwyg">
									<?php echo get_sub_field('card_content') ?>
								</div>
								<a href="<?php echo get_sub_field('button_link'); ?>" class="button subfooter-card__button">
									<?php echo get_sub_field('button_text'); ?>
								</a>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</section>
		<?php endwhile; ?>
	<?php endif; ?>

<?php else: ?>

	<?php if( have_rows('sub_footer_cta') ): ?>
		<?php while( have_rows('sub_footer_cta') ): the_row(); ?>
			<?php
			if (get_field('invert_background')) {
				$background = get_field('subfooter_background_inverted', 'option');
				$invert = true;
				$invert_class = ' inverted';
			}
			?>
			<section class="subfooter<?=$invert_class?>">
				<div class="subfooter-background" style="background-image: url('<?=$background['sizes']['extra-large']?>');">
					<?php if(! $invert): ?>
						<div class="subfooter-background__fade"></div>
					<?php endif; ?>
				</div>
				<div class="subfooter-container">
					<?php if( have_rows('sub_footer_card') ): ?>
						<?php while( have_rows('sub_footer_card') ): the_row(); ?>
							<div class="subfooter-card">
								<div class="subfooter-card__title h5">
									<?php echo get_sub_field('card_title') ?>
								</div>
								<div class="subfooter-card__content wysiwyg">
									<?php echo get_sub_field('card_content') ?>
								</div>
								<a href="<?php echo get_sub_field('button_link'); ?>" class="button subfooter-card__button">
									<?php echo get_sub_field('button_text'); ?>
								</a>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</section>
		<?php endwhile; ?>
	<?php endif; ?>
<?php endif; ?>

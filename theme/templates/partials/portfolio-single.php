<?php
$details_background = '';
if(get_field('team_member_profile_background_image', 'options')){
	$details_background = get_field('team_member_profile_background_image', 'options')[url];
}
$title = get_the_title();
$slug = $post->post_name;
?>

<div class="portfolio">
	<div class="portfolio__container">
		<div class="portfolio__image">
			<?php
			$gray_image = get_field('portfolio_alternate_logo');
			$original_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID), '' );
			?>
			<div class="portfolio__image__gray absolute-fill" style="background-image: url('<?=$gray_image['sizes'][large]?>');"></div>
			<div class="portfolio__image__hover absolute-fill bg-image bg-image-preload" style="background-image: url('<?=$original_image?>');"></div>
		</div>
		<div class="portfolio__title">
			<div class="portfolio-location">
				<?php the_field('portfolio_location'); ?>
			</div>
			<div class="portfolio-name"><?php the_title(); ?></div>
			<div class="learn-more text-right">
				Learn More »
			</div>
		</div>
		<a href="#<?=$slug?>" class="magnific absolute-fill"></a>
	</div>
</div>
<div id="<?=$slug?>" class="mfp-hide portfolio-popup">
	<div class="mfp-close">
		<span>Close</span> <span class="symbol text-color-tertiary">-</span>
	</div>
	<div class="portfolio-popup__banner">
		<div class="portfolio-popup__banner__image absolute-fill bg-image bg-image-preload" style="background-image: url('<?=$original_image?>');"></div>
	</div>
	<div class="portfolio-popup__container bg-color-primary text-grayscale-white">
		<div class="portfolio-popup__profile portfolio-popup__half">
			<div class="profile-container">
				<div class="profile-title h5 text-grayscale-white">
					<?php the_title(); ?>
				</div>
				<div class="profile-content">
					<?php the_content(); ?>
				</div>
				<div class="profile-overview text-color-tertiary">
					<div class="location">
						<?php the_field('portfolio_location'); ?>
					</div>
					<div class="website">
						<a href="<?php the_field('portfolio_website'); ?>">
							<?php the_field('portfolio_website'); ?>
						</a>
					</div>
					<div class="attribution">
						<?php the_field('portfolio_attribution'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="portfolio-popup__details portfolio-popup__half">
			<div class="details-background">
				<div class="details-background__image absolute-fill" style="background-image: url('<?=$details_background?>')"></div>
				<div class="details-background__fade"></div>
			</div>
			<div class="portfolio-popup__details__container">
				<div class="details-single">
					<div class="">
						Industry:
					</div>
					<div class="">
						<?php
						$terms = get_the_terms( $post->ID , 'industry' );
						$i = 1;
						foreach ( $terms as $term ) {
							echo $term->name;
							echo ($i < count($terms))? ", " : "";
							$i ++;
						}
						?>
					</div>
				</div>
				<div class="details-single">
					<div class="">
						Investment Year:
					</div>
					<div class="">
						<?php
						$terms = get_the_terms( $post->ID , 'investment_year' );
						$i = 1;
						foreach ( $terms as $term ) {
							echo $term->name;
							echo ($i < count($terms))? ", " : "";
							$i ++;
						}
						?>
					</div>
				</div>
				<div class="details-single">
					<div class="">
						Fund:
					</div>
					<div class="">
						<?php
						$terms = get_the_terms( $post->ID , 'fund' );
						$i = 1;
						foreach ( $terms as $term ) {
							echo $term->name;
							echo ($i < count($terms))? ", " : "";
							$i ++;
						}
						?>
					</div>
				</div>
				<div class="details-single">
					<div class="">
						Status:
					</div>
					<div class="">
						<?php
						$terms = get_the_terms( $post->ID , 'portfolio_status' );
						$i = 1;
						foreach ( $terms as $term ) {
							echo $term->name;
							echo ($i < count($terms))? ", " : "";
							$i ++;
						}
						?>
					</div>
				</div>
				<div class="details-single">
					<div class="">
						NMS Deal Contact:
					</div>
					<div class="">
						<?php if(have_rows('portfolio_contact')):
							while (have_rows('portfolio_contact')): the_row();
							?>
							<?php
							$contact = get_sub_field('contact');
							if( $contact ): ?>
							<?php
							$contact_title = get_the_title($contact->ID);
							$contact_slug = $contact->post_name; ?>
							<a href="/team?n=<?=$contact_slug?>"><?=$contact_title?></a>
						<?php endif; ?>
					<?php endwhile; endif; ?>
				</div>
			</div>
			<div class="details-single">
				<div class="">
					In The News:
				</div>
				<div class="">

				</div>
			</div>
		</div>
	</div>
</div>
</div>

<?php
$details_background = '';
if(get_field('team_member_profile_background_image', 'options')){
	$details_background = get_field('team_member_profile_background_image', 'options')[url];
}
?>

<div class="team-member">
	<div class="team-member__container">
		<div class="team-member__image bg-color-primary">
			<?php
			$treated_image = get_field('team_member_treated_image');
			$original_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID), '' );
			?>
			<div class="team-member__image__treated absolute-fill" style="background-image: url('<?=$treated_image['sizes'][large]?>');"></div>
			<div class="team-member__image__hover absolute-fill bg-image bg-image-preload" style="background-image: url('<?=$original_image?>');"></div>
		</div>
		<div class="team-member__title">
			<div class="member-name"><?php the_title(); ?></div>
			<div class="member-title">
				<?php
				$terms = get_the_terms( $post->ID , 'title' );
				$i = 1;
				foreach ( $terms as $term ) {
					echo $term->name;
					echo ($i < count($terms))? ", " : "";
					$i ++;
				}
				?>
			</div>
		</div>
		<?php
			$title = get_the_title();
			$slug = $post->post_name;
		 ?>
		<a href="#<?=$slug?>" class="magnific absolute-fill"></a>
	</div>
</div>
<div id="<?=$slug?>" class="mfp-hide team-member-popup">
	<div class="team-member-popup__container bg-color-primary">
		<div class="mfp-close">
			<span>Close</span> <span class="symbol text-color-tertiary">-</span>
		</div>
		<div class="team-member-popup__profile team-member-popup__half">
			<div class="profile-background">
				<img class="profile-background__treated image-preload" src="<?=$treated_image['url']?>">
				<div class="profile-background__hover absolute-fill bg-image bg-image-preload" style="background-image: url('<?=$original_image?>');"></div>
				<div class="profile-background__fade"></div>
			</div>
			<div class="profile-container">
				<div class="profile-title h5 text-grayscale-white">
					<?php the_title(); ?>
				</div>
				<div class="profile-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		<div class="team-member-popup__details team-member-popup__half">
			<div class="details-background">
				<div class="details-background__image absolute-fill" style="background-image: url('<?=$details_background?>')"></div>
				<div class="details-background__fade"></div>
			</div>
			<div class="details__container">
				<table>
					<tbody>
						<tr>
							<td>Location:</td>
							<td>
								<?php
								$terms = get_the_terms( $post->ID , 'location' );
								$i = 1;
								foreach ( $terms as $term ) {
									echo $term->name;
									echo ($i < count($terms))? ", " : "";
									$i ++;
								}
								?>
							</td>
						</tr>
						<tr>
							<td>Role:</td>
							<td>
								<?php
								$terms = get_the_terms( $post->ID , 'role' );
								$i = 1;
								foreach ( $terms as $term ) {
									echo $term->name;
									echo ($i < count($terms))? ", " : "";
									$i ++;
								}
								?>
							</td>
						</tr>
						<tr>
							<td>Title:</td>
							<td>
								<?php
								$terms = get_the_terms( $post->ID , 'title' );
								$i = 1;
								foreach ( $terms as $term ) {
									echo $term->name;
									echo ($i < count($terms))? ", " : "";
									$i ++;
								}
								?>
							</td>
						</tr>
						<tr>
							<td>Phone:</td>
							<td>
								<a href="tel:<?php the_field('team_member_phone') ?>">
									<?php the_field('team_member_phone') ?>
								</a>
							</td>
						</tr>
						<tr>
							<td>Email:</td>
							<td>
								<a href="mailto:<?php the_field('team_member_email') ?>">
									<?php the_field('team_member_email') ?>
								</a>
							</td>
						</tr>
						<tr>
							<?php
							$portfolio = get_field('team_member_portfolio');
							if( $portfolio ): ?>
							<td>Current Portfolio:</td>
							<td>
									<?php if(have_rows('team_member_portfolio')): ?>
										<ul>
										<?php while (have_rows('team_member_portfolio')): the_row();
										?>
										<?php
										$portfolio = get_sub_field('portfolio');
										if( $portfolio ): ?>
										<?php
										$portfolio_title = get_the_title($portfolio->ID);
										$portfolio_slug = $portfolio->post_name; ?>
										<li><a href="/portfolio?n=<?=$portfolio_slug?>"><?=$portfolio_title?></a></li>
									<?php endif; ?>

								<?php endwhile; ?>
									</ul>
								<?php endif; ?>
								<?php
								// Reset the global post object so that the rest of the page works correctly.
								wp_reset_postdata(); ?>
						</td>
					<?php endif; ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>

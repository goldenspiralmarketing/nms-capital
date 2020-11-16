<?php
$details_background = '';
if(get_field('team_member_profile_background_image', 'options')){
	$details_background = get_field('team_member_profile_background_image', 'options');
}

$get_locations = get_the_terms( $post->ID , 'location' );
$get_roles = get_the_terms( $post->ID , 'role' );
$get_titles = get_the_terms( $post->ID , 'member_title' );

$location_array = array();
foreach ( $get_locations as $get_location) {
	$location_array[] = $get_location->slug;
}
$locations = implode(' ', $location_array);


$role_array = array();
foreach ( $get_roles as $get_role) {
	$role_array[] = $get_role->slug;
}
$roles = implode(' ', $role_array);


$title_array = array();
foreach ( $get_titles as $get_title) {
	$title_array[] = $get_title->slug;
}
$titles = implode(' ', $title_array);
?>

<div class="team-member filterable" data-filters="<?php echo $locations; ?> <?php echo $roles; ?> <?php echo $titles; ?>">
	<div class="team-member__container">
		<div class="team-member__image bg-color-primary">
			<?php
			$treated_image = get_field('team_member_treated_image');
			// $original_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
			$original_image = get_the_post_thumbnail_url($post->ID,'team');
			$original_image_small = get_the_post_thumbnail_url($post->ID,'large');
			?>
			<div class="team-member__image__treated absolute-fill" style="background-image: url('<?=$treated_image['sizes']['large']?>');"></div>
			<div class="team-member__image__hover absolute-fill bg-image bg-image-preload" style="background-image: url('<?=$original_image_small?>');"></div>
		</div>
		<div class="team-member__title">
			<div class="member-name"><?php the_title(); ?></div>
			<div class="member-title">
				<?php
				$terms = get_the_terms( $post->ID , 'member_title' );
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
				<img class="profile-background__treated image-preload" src="<?=$treated_image['sizes']['team']?>">
				<div class="profile-background__hover absolute-fill" style="background-image: url('<?=$original_image?>');"></div>
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
				<div class="details-background__image absolute-fill" style="background-image: url('<?=$details_background['sizes']['large']?>')"></div>
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
								$terms = get_the_terms( $post->ID , 'member_title' );
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
							<td class="pt-3">Current Portfolio:</td>
							<td class="pt-3">
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
						</td>
					<?php endif; ?>
					</tr>
						<tr>
							<?php
							$portfolio_prior = get_field('team_member_portfolio_prior');
							if( $portfolio_prior ): ?>
							<td class="pt-3">Prior Portfolio:</td>
							<td class="pt-3">
									<?php if(have_rows('team_member_portfolio_prior')): ?>
										<ul>
										<?php while (have_rows('team_member_portfolio_prior')): the_row();
										?>
										<?php
										$portfolio_prior = get_sub_field('portfolio');
										if( $portfolio_prior ): ?>
										<?php
										$portfolio_prior_title = get_the_title($portfolio_prior->ID);
										$portfolio_prior_slug = $portfolio_prior->post_name; ?>
										<li><a href="/portfolio?n=<?=$portfolio_prior_slug?>"><?=$portfolio_prior_title?></a></li>
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

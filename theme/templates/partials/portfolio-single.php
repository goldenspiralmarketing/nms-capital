<?php
$details_background = '';
if(get_field('team_member_profile_background_image', 'options')){
	$details_background = get_field('team_member_profile_background_image', 'options')[url];
}
$title = get_the_title();
$slug = $post->post_name;
?>
<?php
$get_industries = get_the_terms( $post->ID , 'industry' );
$get_years = get_the_terms( $post->ID , 'investment_year' );
$get_statuses = get_the_terms( $post->ID , 'portfolio_status' );

$industry_array = array();
foreach ( $get_industries as $get_industry) {
	$industry_array[] = $get_industry->slug;
}
$industries = implode(' ', $industry_array);


$status_array = array();
foreach ( $get_statuses as $get_status) {
	$status_array[] = $get_status->slug;
}
$statuses = implode(' ', $status_array);


 ?>
<div class="portfolio filterable active" data-filters="<?php echo $industries; ?> <?php echo $statuses; ?>">
	<div class="portfolio__container">
		<div class="portfolio__image">
			<?php
			$gray_image = get_field('portfolio_alternate_logo');
			$original_image = get_the_post_thumbnail_url($post->ID,'portfolio');
			?>
			<div class="portfolio__image__gray absolute-fill" style="background-image: url('<?=$gray_image['sizes']['portfolio']?>');"></div>
			<div class="portfolio__image__hover absolute-fill" style="background-image: url('<?=$original_image?>');"></div>
		</div>
		<div class="portfolio__title">
			<div class="portfolio-name"><?php the_title(); ?></div>
			<div class="portfolio-location">
				<?php the_field('portfolio_location'); ?>
			</div>
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
		<div class="portfolio-popup__banner__image absolute-fill bg-image" style="background-image: url('<?=$original_image?>');"></div>
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
				<div class="profile-overview text-grayscale-white">
					<div class="attribution">
						<?php the_field('portfolio_attribution'); ?>
					</div>
					<div class="location">
						<?php the_field('portfolio_location'); ?>
					</div>
					<div class="website">
						<?php
						$url = get_field('portfolio_website');
						$to_remove = array('https://', "http://");
						$website = str_replace($to_remove, "", $url);
						$website = rtrim($website, '/');
						 ?>

						<a href="<?php echo $url; ?>" target="_blank">
							<?php echo $website; ?>
						</a>
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
				<table>
					<tbody>
						<tr class="details-single">
							<td class="">
								Industry:
							</td>
							<td class="">
								<?php
								$terms = get_the_terms( $post->ID , 'industry' );
								$i = 1;
								foreach ( $terms as $term ) {
									echo $term->name;
									echo ($i < count($terms))? ", " : "";
									$i ++;
								}
								?>
							</td>
						</tr>
						<tr class="details-single">
							<td class="">
								Investment Year:
							</td>
							<td class="">
								<?php
								$terms = get_the_terms( $post->ID , 'investment_year' );
								$i = 1;
								foreach ( $terms as $term ) {
									echo $term->name;
									echo ($i < count($terms))? ", " : "";
									$i ++;
								}
								?>
							</td>
						</tr>
						<tr class="details-single">
							<td class="">
								Fund:
							</td>
							<td class="">
								<?php
								$terms = get_the_terms( $post->ID , 'fund' );
								$i = 1;
								foreach ( $terms as $term ) {
									echo $term->name;
									echo ($i < count($terms))? ", " : "";
									$i ++;
								}
								?>
							</td>
						</tr>
						<tr class="details-single">
							<td class="">
								Status:
							</td>
							<td class="">
								<?php
								$terms = get_the_terms( $post->ID , 'portfolio_status' );
								$i = 1;
								foreach ( $terms as $term ) {
									echo $term->name;
									echo ($i < count($terms))? ", " : "";
									$i ++;
								}
								?>
							</td>
						</tr>
						<tr class="details-single">
							<td class="">
								NMS Deal Contact:
							</td>
							<td class="">
								<ul class="">
									<?php if(have_rows('portfolio_contact')):
										while (have_rows('portfolio_contact')): the_row();
										?>
										<?php
										$contact = get_sub_field('contact');
										if( $contact ): ?>
										<?php
										$contact_title = get_the_title($contact->ID);
										$contact_slug = $contact->post_name; ?>
										<li><a href="/team?n=<?=$contact_slug?>"><?=$contact_title?></a></li>
									<?php endif; ?>
								<?php endwhile; endif; ?>
							</ul>
						</td>
					</tr>
					<?php if(get_field('portfolio_in_the_news')): ?>
						<?php
							$news_ids = get_field('portfolio_in_the_news');
							$array = array();
							foreach ($news_ids as $news_id) {
								$array[] =  $news_id->slug;
							}
							$args = array(
							// 'post_type' => 'any',
							'posts_per_page'	=> 3,
							 'orderby'			=> 'date',
							 'order'				=> 'DESC',
							 // 'tag__in'			=> 'array(\'' . $single . '\')'
							 'tag' => $array
							);
							$the_query = new WP_Query( $args );
							// print_r($the_query);

						 ?>
						 <?php if ( $the_query->have_posts() ): ?>
					<tr class="details-single">
						<td class="">
							In The News:
						</td>
						<td class="">
							<ul class="news-links">
								<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
									<li class="news-links__single">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</li>
								<?php endwhile; else: ?> <p>Sorry, there are no posts to display</p> <?php endif; ?>
									<?php wp_reset_query(); ?>
									<li class="news-links__single mt-3">
										<a href="/tag/<?=$array[0]?>">More News »</a>
									</li>
								</ul>
						</td>
					</tr>
					<?php endif; ?>
					<?php endif; ?>
					</tbody>
				</table>
		</div>
	</div>
</div>
</div>

<!-- single.php -->

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php  while ( have_posts() ) : the_post(); ?>

		<?php
		$post_type_object = get_post_type_object( get_post_type() );
		$listing_url = get_post_type_archive_link( get_post_type() );
		if ( $post_type_object->rewrite['slug'] ) {
			$listing_url = '/'. $post_type_object->rewrite['slug'] .'/';
		}
		?>

		<main role="main">
			<div class="gs-container" itemscope itemtype="https://schema.org/Blog">
				<article class="single-item" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
					<meta itemprop="mainEntityOfPage" content="<?php the_permalink(); ?>">
					<meta itemprop="datePublished" content="<?php echo get_the_date( 'c' ); ?>">
					<meta itemprop="dateModified" content="<?php echo get_the_modified_date( 'c' ); ?>">

					<div class="single-hero">
						<?php if ( $post_type_object->name !== 'post' ) : ?>
							<h1 class="s3"><?php echo $post_type_object->labels->singular_name; ?></h1>
						<?php endif; ?>
						<div class="h1" itemprop="name headline"><?php the_title(); ?></div>

						<?php if ( has_post_thumbnail() ) : ?>
							<div class="single-image">
								<figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
									<?php
									$ft_image_size = 'thumbnail-square';
									$ft_image_id = get_post_thumbnail_id();
									$attrs = array( 'itemprop' => 'url contentUrl' );
									?>
									<?php echo wp_get_attachment_image( $ft_image_id, $ft_image_size, false, $attrs ); ?>
									<?php if ( get_the_post_thumbnail_caption() ) : ?>
										<figcaption itemprop="caption"><?php echo get_the_post_thumbnail_caption(); ?></figcaption>
									<?php endif; ?>
								</figure>
							</div>
						<?php endif; ?>
					</div>

					<div class="single-content">
						<div class="wysiwyg" itemprop="articleBody">
							<?php the_content(); ?>
						</div>
					</div>

					<span itemprop="author" itemscope itemtype="https://schema.org/Person">
						<!-- <a rel="author" itemprop="url" href="#" title="View author biography">
							<span itemprop="name">Aaron A. Aardvark</span>
						</a> -->
						<meta itemprop="name" content="FirstName LastName">
						<!-- <meta itemprop="jobTitle" content="Director"> -->
						<!-- <meta itemprop="worksFor" content="ExampleCorp Ltd"> -->
					</span>

					<span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
						<meta itemprop="name" content="<?php the_field( 'client_contact_name', 'option' ); ?>">
						<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
							<?php
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$custom_logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
							?>
							<meta itemprop="url" content="<?php echo $custom_logo[0]; ?>">
						</span>
					</span>

					<hr>

					<div class="listing-cta">
						<div><a href="<?php echo $listing_url; ?>" class="">Back to <?php echo $post_type_object->labels->name; ?></a></div>
					</div>

				</article>
			</div>
		</main>

	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>

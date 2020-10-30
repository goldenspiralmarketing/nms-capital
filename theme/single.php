<!-- single.php -->
<?php $page_for_posts_id = get_option( 'page_for_posts' ); ?>
<?php get_header(); ?>
<?php if ( have_posts() ) : ?>

	<?php  while ( have_posts() ) : the_post(); ?>
		<?php
		$post_type_object = get_post_type_object( get_post_type() );
		$listing_url = get_post_type_archive_link( get_post_type() );
		if ( $post_type_object->rewrite['slug'] ) {
			$listing_url = '/'. $post_type_object->rewrite['slug'] .'/';
		}
		$title = get_the_title();
		$this_post_title = $title;
		?>

		<main role="main">
			<?php if ( have_rows('page_modules', $page_for_posts_id) ) : ?>
				<?php set_query_var( 'flex_counter', 0 ); ?>
				<?php set_query_var( 'lazy_load_trigger', 3 ); ?>
				<?php while ( have_rows('page_modules', $page_for_posts_id) ) : the_row(); ?>
					<?php include( 'templates/modules/inc/blog-hero.php' ); ?>
				<?php set_query_var( 'flex_counter', get_query_var( 'flex_counter' ) + 1 ); ?>
				<?php endwhile; ?>
			<?php endif; ?>
			<div class="gs-container" itemscope itemtype="https://schema.org/Blog">
				<article class="single-item" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
					<div class="vertical-text">
						<?php echo get_the_date(); ?>
					</div>
					<meta itemprop="mainEntityOfPage" content="<?php the_permalink(); ?>">
					<meta itemprop="datePublished" content="<?php echo get_the_date( 'c' ); ?>">
					<meta itemprop="dateModified" content="<?php echo get_the_modified_date( 'c' ); ?>">
					<meta itemprop="name headline" content="<?php the_title(); ?>">


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
					<div class="listing-cta text-center">
						<div><a href="<?php echo $listing_url; ?>" class="button">View All News</a></div>
					</div>

				</article>
			</div>
		</main>

	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>

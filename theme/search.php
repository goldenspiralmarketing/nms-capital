<?php get_header(); ?>

	<main>

		<?php $hero_title = 'Search'; ?>
		<?php $hero_description = have_posts() ? 'Search results for "' . $_REQUEST['s'] . '":' : 'Sorry. No results match the search term "' . $_REQUEST['s'] . '".'; ?>
		<?php set_query_var( 'hero_alt_title', $hero_title ); ?>
		<?php set_query_var( 'hero_description', $hero_description ); ?>
		<?php get_template_part( 'templates/hero', 'simple' ); ?>

		<section class="pt-8 pb-8">

			<div class="search-outer">

				<div class="search-container">

					<div class="mb-7">
						<a href="https://blog.keyfactor.com/hs-search-results?term=<?php echo $_REQUEST['s']; ?>" class="button tertiary">Search for "<?php echo $_REQUEST['s']; ?>" in Blogs and Articles</a>
					</div>

					<?php if ( have_posts() ) : ?>
						<div class="h1 mb-7"><?php echo $wp_query->post_count; ?> results</div>

						<div class="search-results">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php
								$post_type = get_post_type();
								$post_type_object = get_post_type_object( $post_type );
								$post_singular_name = strtolower( $post_type_object->labels->singular_name ) == 'post' ? 'Page' : $post_type_object->labels->singular_name;
								?>
								<div class="search-result mb-6">
									<div class="s5 mb-0"><?php echo $post_singular_name; ?></div>
									<div class="h4 search-result-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
									<div class="wysiwyg">
										<p class="small search-result-link"><?php the_permalink(); ?></p>
										<p class="search-result-excerpt"><?php the_excerpt(); ?></p>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					<?php else : ?>
						<div class="search-no-results">
							<div class="h2">0 results</div>
						</div>
					<?php endif; ?>

				</div>

			</div>

		</section>

	</main>

<?php get_footer(); ?>

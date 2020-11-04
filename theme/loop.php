<!-- loop.php -->
<div class="listing">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<article class="listing-item">

				<div class="listing-item-content-container">
					<div class="item-details"><span><?php echo get_the_date(Y); ?></span> <?php if(has_tag()): ?>| <span><?php the_tags('',', ',''); ?></span><?php endif; ?></div>
					<h2 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="item-excerpt wysiwyg">
						<?php $content = get_the_content(); ?>
						<?php the_excerpt(); ?>
					</div>
					<a class="item-link" href="<?php the_permalink(); ?>">Read More »</a>
					<a class="absolute-fill" href="<?php the_permalink(); ?>"></a>
				</div>

			</article>

		<?php endwhile; ?>

	<?php else : ?>

		<div>
			<div class="h2">No results.</div>
		</div>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
</div>

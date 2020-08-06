<!-- loop.php -->
<div class="listing">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<article class="listing-item">

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="listing-item-image-container">
						<div class="bg-image absolute-fill" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
					</div>
				<?php endif; ?>

				<div class="listing-item-content-container">
					<div><?php echo get_the_date(); ?></div>
					<h2 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="item-excerpt wysiwyg">
						<?php the_excerpt(); ?>
					</div>
					<a class="item-link" href="<?php the_permalink(); ?>">Read More</a>
				</div>

			</article>

		<?php endwhile; ?>

	<?php else : ?>

		<div>
			<div class="h2">No results.</div>
		</div>

	<?php endif; ?>

</div>

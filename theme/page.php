<!-- WYSIWYG Page -->

<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<main role="main">

			<?php if ( get_field( 'grid', 'option' ) ) : ?>
				<div class="gs-grid">
					<div class="gs-row">
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( have_rows('page_modules') ) : ?>
				<?php set_query_var( 'flex_counter', 0 ); ?>
				<?php set_query_var( 'lazy_load_trigger', 3 ); ?>
				<?php while ( have_rows('page_modules') ) : the_row(); ?>

					<?php get_template_part( 'modules' ); ?>

					<?php set_query_var( 'flex_counter', get_query_var( 'flex_counter' ) + 1 ); ?>
				<?php endwhile; ?>
			<?php endif; ?>

		</main>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>

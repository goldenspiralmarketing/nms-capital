<!-- 404 Page -->

<?php get_header(); ?>

<?php //if (have_posts()): while (have_posts()) : the_post(); ?>

	<main role="main">

		<div class="error404-outer pt-8 pb-8">

			<div class="error404-inner">

				<div class="error404-content-container">

					<div class="error404-hero">
						<div class="s1">404</div>
						<div class="h1">We're sorry… Something went wrong</div>
					</div>

					<div class="error404-content">

						<div class="wysiwyg">
							<p class="large">The page you requested might have been removed, had its name changed, or is temporarily unavailable.</p>

							<ul class="large">
								<li>Make sure that the Web site address displayed in the address bar of your browser is spelled and formatted correctly.</li>
								<li>If you reached this page by clicking a link, contact the Web site administrator to alert them that the link is incorrectly formatted.</li>
								<li>Click the <a href="/" onclick="window.history.go(-1); return false;">Back</a> button to try another link.</li>
							</ul>

							<p class="large">Or, return to <a href="/">Website Name</a></p>
						</div>

					</div>
				</div>

			</div>

		</div>

	</main>

<?php //endwhile; endif; ?>

<?php get_footer(); ?>

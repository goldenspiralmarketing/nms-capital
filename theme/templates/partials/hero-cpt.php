<?php $title = ! empty( get_query_var( 'hero_alt_title' ) ) ? get_query_var( 'hero_alt_title' ) : get_the_title(); ?>
<?php $description = ! empty( get_query_var( 'hero_description' ) ) ? get_query_var( 'hero_description' ) : ''; ?>

<div class="gs-module hero-simple-module">

	<div class="gs-module-container"><!-- container -->

		<div class="gs-module-column"><!-- column -->

			<div class="text-center">
				<?php if ( ! empty( $title ) ) : ?>
					<h1 class="h2"><?php echo $title; ?></h1>
				<?php endif; ?>
				<?php if ( ! empty( $description ) ) : ?>
					<p><?php echo $description; ?></p>
				<?php endif; ?>
			</div>

		</div>

	</div>

</div>

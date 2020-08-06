<?php $link = get_field( 'resources_host_on_wordpress' ) ? get_the_permalink() : get_field( 'resources_button_link' ); ?>

<div class="resource-container">

	<div class="resource-card">

		<div class="resource-content-container">
			<div class="resource-types">
				<?php $types = get_the_terms( get_the_ID(), 'resource_type' ); ?>
				<?php foreach ( $types as $type ) : ?>
					<a class="resource-type tag" href="/resources/type/<?php echo $type->slug; ?>"><?php echo $type->name; ?></a>
				<?php endforeach; ?>
			</div>
			<div class="resource-title h2"><?php the_title(); ?></div>
			<div class="resource-link">
				<a class="button tertiary" href="<?php echo $link; ?>"><?php the_field( 'resources_button_text' ); ?></a>
			</div>
		</div>

		<?php $img = get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>
		<?php if ( ! $img ) : ?>
			<?php $img = get_stylesheet_directory_uri() . '/img/mesh/KYF_Resource_Default_2.png'; ?>
		<?php endif; ?>
		<div class="resource-image">
			<div class="absolute-fill" style="background-image:url('<?php echo $img; ?>');"></div>
		</div>

		<a href="<?php echo $link; ?>" class="absolute-fill"></a>

	</div>

</div>

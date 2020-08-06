<aside class="taxonomy-sidebar">
	<h5>Types</h5>
	<ul class="taxonomy-list">

		<?php $types = get_terms( array( 'taxonomy' => 'gs_resource_type', 'hide_empty' => false ) ); ?>

		<?php foreach ( $types as $type ) : ?>
			<li>
				<a href="<?php echo get_term_link( $type->term_id ); ?>"><?php echo $type->name; ?></a>
			</li>
		<?php endforeach; ?>

	</ul>
</aside>

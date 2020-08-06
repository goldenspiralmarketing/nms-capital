<!-- sidebar-tags.php -->
<?php $tags = get_terms( array( 'taxonomy' => 'post_tag', 'hide_empty' => true ) ); ?>

<?php if ( count( $tags ) > 0 ) : ?>
	<aside class="taxonomy-sidebar">
		<h5>Tags</h5>
		<ul class="taxonomy-list inline">

			<?php foreach ( $tags as $tag ) : ?>
				<li>
					<a href="h4 <?php echo get_term_link( $tag->term_id ); ?>">#<?php echo $tag->name; ?></a>
				</li>
			<?php endforeach; ?>

		</ul>
	</aside>
<?php endif; ?>

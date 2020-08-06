<!-- sidebar-categories.php -->
<?php $categories = get_categories( array( 'hide_empty' => true ) ); ?>

<?php if ( count( $categories ) > 0 ) : ?>
	<aside class="taxonomy-sidebar">
		<h5>Categories</h5>
		<ul class="taxonomy-list">

			<?php foreach ( $categories as $category ) : ?>
				<li>
					<a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a>
				</li>
			<?php endforeach; ?>

		</ul>
	</aside>
<?php endif; ?>

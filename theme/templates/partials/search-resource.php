<?php $queried_object_search = get_queried_object(); ?>
<!-- resource search -->
<form name="form-search-resources" method="post" class="form-filter-taxonomy">
	<div class="resource-search mt-7 mb-7">
		<!-- <div class="resource-search-general">
			<div class="input-search-wrapper">
				<i class="fa fa-search"></i>
				<input type="search" value="<?php //echo $_REQUEST['rq']; ?>" placeholder="Search resources" name="rq">
			</div>
		</div> -->
		<div class="resource-search-taxonomy">
			<?php
			$categories = get_terms( array(
				'taxonomy' => 'resource_category',
				'hide_empty' => false
			) );
			?>

			<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
				<div class="resource-search-taxonomy-inner">
					<label>Filter by Need:</label>
					<div>
						<ul>
						<?php foreach ( $categories as $category ) : ?>
							<li class="<?php echo get_class( $queried_object_search ) === 'WP_Term' && $category->slug === $queried_object_search->slug ? 'active' : ''; ?>"><a class="s6" href="/resources/category/<?php echo $category->slug; ?>"><?php echo $category->name; ?></a></li>
						<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>

			<?php
			$types = get_terms( array(
				'taxonomy' => 'resource_type',
				'hide_empty' => true
			) );
			?>

			<?php if ( ! empty( $types ) && ! is_wp_error( $types ) ) : ?>
				<div class="resource-search-taxonomy-inner">
					<label>Filter by Type:</label>
					<div>
						<select name="resource-type" class="select-taxonomy">
							<option value="">Select Resource Type</option>
						<?php foreach ( $types as $type ) : ?>
							<option value="/resources/type/<?php echo $type->slug; ?>" <?php echo get_class( $queried_object_search ) === 'WP_Term' && $type->slug === $queried_object_search->slug ? 'selected' : ''; ?>><?php echo $type->name; ?></option>
						<?php endforeach; ?>
						</select>
					</div>
				</div>
			<?php endif; ?>

			<div class="resource-search-taxonomy-inner">
				<label>&nbsp;</label>
				<div>
					<a class="s6" href="/resources/">View All</a>
				</div>
			</div>
		</div>
	</div>
</form>

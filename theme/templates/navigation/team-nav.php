<div class="portfolio-nav categories-nav">
	<div class="categories-nav__title">
		Filter
	</div>
	<div class="portfolio-nav__industry categories-nav__single">
		<div class="category-title">
			Location:
		</div>
		<select class="location-dropdown" name="location" onchange="">
			<option value="all">All</option>
			<?php $locations = get_terms('location'); ?>
			<?php foreach($locations as $location): ?>
				<option value="<?=$location->slug?>"><?=$location->name?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="portfolio-nav__fund categories-nav__single">
		<div class="category-title">
			Role:
		</div>
		<select class="role-dropdown" name="role" onchange="">
			<option value="all">All</option>
			<?php $roles = get_terms('role'); ?>
			<?php foreach($roles as $role): ?>
				<option value="<?=$role->slug?>"><?=$role->name?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="portfolio-nav__status categories-nav__single">
		<div class="category-title">
			Title:
		</div>
		<select class="title-dropdown" name="title" onchange="">
			<option value="all">All</option>
			<?php $titles = get_terms('member_title'); ?>
			<?php foreach($titles as $title): ?>
				<option value="<?=$title->slug?>"><?=$title->name?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>

<div class="portfolio-nav categories-nav">
	<div class="categories-nav__title">
		Filter
	</div>
	<div class="portfolio-nav__industry categories-nav__single">
		<div class="category-title">
			Location:
		</div>
		<select class="industry-dropdown" name="industry-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
			<option value="/team/">All</option>
			<?php $locations = get_terms('location'); ?>
			<?php foreach($locations as $location): ?>
				<option value="/location/<?=$location->slug?>"><?=$location->name?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="portfolio-nav__fund categories-nav__single">
		<div class="category-title">
			Role:
		</div>
		<select class="fund-dropdown" name="fund-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
			<option value="/fund/">All</option>
			<?php $roles = get_terms('role'); ?>
			<?php foreach($roles as $role): ?>
				<option value="/role/<?=$role->slug?>"><?=$role->name?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="portfolio-nav__status categories-nav__single">
		<div class="category-title">
			Title:
		</div>
		<select class="status-dropdown" name="status-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
			<option value="/title/">All</option>
			<?php $titles = get_terms('title'); ?>
			<?php foreach($titles as $title): ?>
				<option value="/title/<?=$title->slug?>"><?=$title->name?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>

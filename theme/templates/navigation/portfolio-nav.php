<div class="portfolio-nav categories-nav">
	<div class="categories-nav__title">
		Filter
	</div>
	<div class="portfolio-nav__industry categories-nav__single">
		<div class="category-title">
			Industry:
		</div>
		<select class="industry-dropdown" name="industry-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
			<option>Select</option>
			<option value="/portfolio/">All</option>
			<?php $industries = get_terms('industry'); ?>
			<?php foreach($industries as $industry): ?>
				<option value="/industry/<?=$industry->slug?>"><?=$industry->name?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="portfolio-nav__fund categories-nav__single">
		<div class="category-title">
			Fund:
		</div>
		<select class="fund-dropdown" name="fund-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
			<option>Select</option>
			<option value="/portfolio/">All</option>
			<?php $funds = get_terms('fund'); ?>
			<?php foreach($funds as $fund): ?>
				<option value="/fund/<?=$fund->slug?>"><?=$fund->name?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="portfolio-nav__status categories-nav__single">
		<div class="category-title">
			Status:
		</div>
		<select class="status-dropdown" name="status-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
			<option>Select</option>
			<option value="/portfolio/">All</option>
			<?php $statuses = get_terms('portfolio_status'); ?>
			<?php foreach($statuses as $status): ?>
				<option value="/portfolio_status/<?=$status->slug?>"><?=$status->name?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>

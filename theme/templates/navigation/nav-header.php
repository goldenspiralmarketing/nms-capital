<header class="site-header topped">
	<div class="header-controls">
		<div class="nav-logo">
			<?php
			$logoSrcWhite = get_stylesheet_directory_uri() .'/img/nms-logo-white.svg';
			?>
			<a href="/"><img src="<?php echo $logoSrcWhite; ?>" alt="site logo"></a>
		</div>
		<?php if (get_field('top_corner_tagline', 'options')): ?>
		<div class="vertical-text">
			<?php the_field('top_corner_tagline', 'options'); ?>
		</div>
		<?php endif; ?>
		<div class="nav-upper">
			<div class="menu-trigger">
				<span class="text-grayscale-white">Menu</span> <span class="text-color-accent">+</span>
			</div>
		</div>
	</div>
	<div class="header-full">
		<div class="header-full__container">
			<div class="nav-logo">
				<?php
				$logoSrc = get_stylesheet_directory_uri() .'/img/nms-logo-primary.svg';
				if(get_field('activate_manual_styles', 'options') && get_field('header_logo', 'options')){
					$logoSrc = get_field('header_logo', 'options')[url];
				}
				?>
				<a href="/"><img src="<?php echo $logoSrc; ?>" alt="site logo"></a>
			</div>

			<nav class="nav-header">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'header-menu',
						'menu_class'      => 'header-nav',
						'menu_id'         => '',
						'echo'            => true,
						'depth'           => 3
					)
				);
				?>
			</nav><!-- /.nav-header -->
			<div class="nav-upper">
				<div class="partner-link">
					<?php
					if(get_field('partner_login_url', 'options')):
						$url = get_field('partner_login_url', 'options');
					 ?>
					<a href="<?=$url?>" target="_blank" class="text-color-accent">Partner Login</a>
					<?php endif; ?>
				</div>
				<div class="menu-trigger">
					Menu <span class="text-color-accent">-</span>
				</div>
			</div>

			<?php /*<div class="nav-search-container">
			<form class="form-search" action="<?php echo get_home_url(); ?>">
			<div class="input-search-wrapper">
			<i class="fa fa-search"></i>
			<input type="search" name="s" value="<?php echo $_REQUEST['s']; ?>" placeholder="Type your search terms here...">
			</div>
			</form>
			</div> */?>

			<div class="mobile-menu-button-container">
				<div class="mobile-menu-button">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		</div>

	</div><!-- /.header-full -->

	<?php get_template_part( 'templates/navigation/nav-mobile' ); ?>
</header>

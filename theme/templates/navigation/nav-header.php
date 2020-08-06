<header class="site-header topped">
	<div class="header-full">

		<div class="header-full__container gs-container">
			<div class="nav-logo">
				<?php
				$logoSrc = get_stylesheet_directory_uri() .'/img/generic-logo.svg';
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

<?php
$mobile_bg ='';
if (get_field('mobile_menu_background', 'options')){
	$mobile_bg = get_field('mobile_menu_background', 'options')['sizes']['team'];
}
 ?>
<div class="mobile-menu bg-color-primary" style="background-image: url('<?=$mobile_bg?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">

		<nav class="nav-mobile">
			<?php
			wp_nav_menu(
				array(
					'theme_location'            => 'mobile-menu',
					'menu_class'      => 'nav',
					'echo'            => true,
					'depth'           => 3
				)
			);
			?>
		</nav>

	<?php if(get_field( 'social_media_linkedin', 'option' ) ||
					get_field( 'social_media_twitter', 'option' ) ||
					get_field( 'social_media_facebook', 'option' ) ||
					get_field( 'social_media_youtube', 'option' )):
	?>
		<div class="social-mobile">
			<hr class="background-divider">
			<ul>
				<?php if ( get_field( 'social_media_linkedin', 'option' ) ) : ?>
					<li>
						<a target="_blank" href="<?php echo get_field( 'social_media_linkedin', 'option' ); ?>"><i class="fa fa-linkedin"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( get_field( 'social_media_twitter', 'option' ) ) : ?>
					<li>
						<a target="_blank" href="<?php echo get_field( 'social_media_twitter', 'option' ); ?>"><i class="fa fa-twitter"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( get_field( 'social_media_facebook', 'option' ) ) : ?>
					<li>
						<a target="_blank" href="<?php echo get_field( 'social_media_facebook', 'option' ); ?>"><i class="fa fa-facebook-square"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( get_field( 'social_media_youtube', 'option' ) ) : ?>
					<li>
						<a target="_blank" href="<?php echo get_field( 'social_media_youtube', 'option' ); ?>"><i class="fa fa-youtube"></i></a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	<?php endif; ?>

</div>

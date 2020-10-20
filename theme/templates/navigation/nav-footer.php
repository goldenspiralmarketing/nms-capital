<?php
$footer_img = '';
if(get_field('footer_background_image', 'options')){
	$footer_img = get_field('footer_background_image', 'options')[url];
}
?>
<footer style="background-image: url('<?=$footer_img?>');">
	<nav class="nav-footer">
		<?php
		wp_nav_menu(
			array(
				'theme_location'			=> 'footer-menu',
				'menu_class'	=> 'nav',
				'echo'			=> true,
				'depth'			=> 3,
			)
		);
		?>
	</nav>

	<div class="footer-middle">
		<div class="footer-middle__section footer-middle__section__left">
			<div id="footer-investment-principles">
				<div class="vertical-text">
					Investment Principle No.01
				</div>
				<div class="principle-single">
					<div class="emphasis text-grayscale-primary">
						The most important asset at every company we invest in is its people. We spend considerable resources to ensure our portfolio companies are great places to work.
					</div>
					<div class="text-right mt-3">
						<a href="#" class="button flat small">All Investment Principles</a>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-middle__section footer-middle__section__right">
			<div class="footer-logo">
				<?php
				$footer_logo = get_stylesheet_directory_uri() .'/img/nms-logo-white.svg';
				?>
				<a href="/"><img src="<?php echo $footer_logo; ?>" alt="site logo"></a>
			</div>
			<?php if(have_rows('locations', 'options')): ?>
				<div class="locations">
					<?php while( have_rows('locations', 'options') ): the_row(); ?>
						<div class="locations__single">
							<div class="h6 text-grayscale-white mb-2">
								<?php the_sub_field('city'); ?>
							</div>
							<div class="wysiwyg mb-1">
								<?php the_sub_field('address'); ?>
								<?php the_sub_field('phone_number'); ?>
							</div>
							<div class="email">
								<a href="mailto:<?php the_sub_field('email'); ?>" class="text-color-accent"><?php the_sub_field('email'); ?></a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="sub-footer">
		<div class="sub-footer__container">
			<div class="sub-footer__copyright">
				<span>Copyright &copy; <?php echo date( 'Y' ); ?> NMS Capital, LLC. All rights reserved.</span>
			</div>
			<div class="sub-footer__links">
				<a href="/privacy-policy/">Privacy Policy</a> •
				<a href="/terms-of-service/">Terms of Use</a> •
				<?php
				if(get_field('partner_login_url', 'options')):
					$url = get_field('partner_login_url', 'options');
					?>
					<a href="<?=$url?>" target="_blank" class="text-color-accent">Partner Login</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>

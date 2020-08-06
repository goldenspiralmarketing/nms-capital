<footer>
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

	<div class="social-footer">
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

	<div class="sub-footer">
		<ul>
			<?php $terms_of_service_object = get_field( 'tos_page', 'option' ); ?>
			<?php if ( ! empty( $terms_of_service_object ) ) : ?>
				<li>
					<a href="<?php echo get_the_permalink( $terms_of_service_object ); ?>">Terms of Service</a>
				</li>
			<?php endif; ?>
			<?php $privacy_policy_url = get_privacy_policy_url(); ?>
			<?php if ( $privacy_policy_url != '' ) : ?>
				<li>
					<a href="<?php echo $privacy_policy_url; ?>">Privacy Policy</a>
				</li>
			<?php endif; ?>
			<li>
				<span>&copy;<?php echo date( 'Y' ); ?> Website Name. All rights reserved.</span>
			</li>
		</ul>
	</div>
</footer>

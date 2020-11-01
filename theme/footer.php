
			</div><!-- /.wrapper -->
		</div><!-- /#barba-wrapper -->
		<?php if(get_field('show_subfooter_ctas')): ?>
			<?php include('templates/modules/sub-footer-ctas.php') ?>
		<?php endif; ?>
		<?php get_template_part( 'templates/navigation/nav', 'footer' ); ?>

		<?php wp_footer(); ?>

		<!-- Typekit -->
		<script src="https://use.typekit.net/ank0brn.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>


		<?php if ( get_home_url() == '' ) : // enter live domain here to prevent crawling of staging site ?>

			<!-- Google Analytics -->

			<!-- Start of HubSpot Embed Code -->
			<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
			<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/408597.js"></script>
			<!-- End of HubSpot Embed Code -->

			<!-- LinkedIn -->




		<?php endif; ?>

		<!-- RequireJS -->
		<?php $requirejs_path = get_stylesheet_directory() . '/js/require.js'; ?>
		<?php if ( file_exists( $requirejs_path ) ) : ?>
			<script data-main="<?php echo get_stylesheet_directory_uri(); ?>/js/app" src="<?php echo get_stylesheet_directory_uri(); ?>/js/require.js?v=<?php echo filemtime( $requirejs_path ); ?>"></script>
		<?php endif; ?>

	</body>
</html>

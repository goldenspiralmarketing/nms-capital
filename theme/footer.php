
			</div><!-- /.wrapper -->
		</div><!-- /#barba-wrapper -->
		<?php /*
		global $wp_query;
			$query =  $wp_query; // by default, set to current query
			$query_reset = false; //toggle to use later
			if(is_home()){ // this returns true when on the main posts page
				$page_for_posts_id = get_option( 'page_for_posts' );
				$page_slug = get_post_field( 'post_name', $page_for_posts_id );
				$query = new WP_Query( array('pagename' => $page_slug ));
				$query_reset = true;
			}
			echo '<script>';
			echo 'console.log(\''.  $query_reset  .'\');';
			echo 'console.log(\''.  $page_for_posts_id .'\');';
			echo 'console.log(\''.  $page_slug .'\');';
			echo '</script>';
			while ( $query->have_posts() ) : $query->the_post();
			echo '<script>console.log(\'in the loop \');</script>';
			if(get_field('show_subfooter_ctas')):
				echo '<script>console.log(\'in the subfooter \');</script>';
		*/ ?>
			<?php include('templates/modules/sub-footer-ctas.php') ?>
		<?php /*
			endif;
			endwhile;
			if($query_reset){
				wp_reset_postdata();
			}
	*/	?>
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

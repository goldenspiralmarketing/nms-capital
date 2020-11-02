<!doctype html>
<html <?php language_attributes(); ?> class="no-js preload">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title><?php wp_title( '' ); ?></title>
		<link href="//fonts.googleapis.com" rel="dns-prefetch">


		<link href="//js.hsforms.net/" rel="preconnect">
		<link href="//js.hs-scripts.com/" rel="preconnect">
		<link href="//cdn2.hubspot.net" rel="preconnect">
		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="//www.google.com" rel="dns-prefetch">
		<link href="//googleads.g.doubleclick.net" rel="dns-prefetch">

		<?php /* if using typekit
		<link href="//use.typekit.net" rel="dns-prefetch">
		*/ ?>

		<?php
		/* NOTE: uncomment this when going live (unless using new GS Integrations plugin)

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-PLR9NNL');</script>
		<!-- End Google Tag Manager -->
		*/
		?>

		<link href="//www.google-analytics.com" rel="dns-prefetch">

		<script>document.documentElement.className += ' wf-loading';</script>

		<?php if ( is_dir( get_stylesheet_directory() . '/img/favicon' ) ) : ?>
			<!-- Favicons package via http://www.favicomatic.com/ -->
			<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-57x57.png" />
			<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-114x114.png" />
			<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-72x72.png" />
			<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-144x144.png" />
			<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-60x60.png" />
			<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-120x120.png" />
			<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-76x76.png" />
			<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon-152x152.png" />
			<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-196x196.png" sizes="196x196" />
			<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-96x96.png" sizes="96x96" />
			<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-32x32.png" sizes="32x32" />
			<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-16x16.png" sizes="16x16" />
			<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-128.png" sizes="128x128" />
			<meta name="application-name" content="<?php echo get_bloginfo( 'name' ); ?>"/>
			<meta name="msapplication-TileColor" content="#ffffff" />
			<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/mstile-144x144.png" />
			<meta name="msapplication-square70x70logo" content="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/mstile-70x70.png" />
			<meta name="msapplication-square150x150logo" content="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/mstile-150x150.png" />
			<meta name="msapplication-wide310x150logo" content="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/mstile-310x150.png" />
			<meta name="msapplication-square310x310logo" content="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/mstile-310x310.png" />
		<?php endif; ?>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<!-- Chrome, Firefox OS and Opera -->
		<meta name="theme-color" content="#ffffff">
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#ffffff">
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-status-bar-style" content="#ffffff">

		<!--[if lte IE 8]>
		<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
		<![endif]-->

		<!-- polyfills for old browsers  -->
		<script src="//cdn.polyfill.io/v2/polyfill.min.js?features=Intl.~locale.en"></script>

		<!-- Google Site Verification -->
		<!-- <meta name="google-site-verification" content="" /> -->

		<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@500&family=Fira+Sans:ital@0;1&family=Inknut+Antiqua:wght@800&family=Montserrat:ital,wght@0,500;1,500&display=swap" rel="stylesheet">


		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Organization",
			"address": {
				"@type": "PostalAddress",
				"streetAddress": "<?php the_field( 'client_contact_address_1', 'option' ); ?>",
				"addressLocality": "<?php the_field( 'client_contact_city', 'option' ); ?>",
				"addressRegion": "<?php the_field( 'client_contact_state', 'option' ); ?>",
				"postalCode": "<?php the_field( 'client_contact_zip_code', 'option' ); ?>",
				"addressCountry": "USA"
			},
			"email": "<?php the_field( 'client_contact_email', 'option' ); ?>",
			"faxNumber": "<?php the_field( 'client_contact_fax', 'option' ); ?>",
			"name": "<?php the_field( 'client_contact_name', 'option' ); ?>",
			"telephone": "<?php the_field( 'client_contact_phone', 'option' ); ?>"
		}
	</script>


		<?php wp_head(); ?>


	</head>

	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>

		<!-- all svgs -->
		<?php $svg_path = get_stylesheet_directory() . '/img/icons.svg'; ?>
		<?php if ( file_exists( $svg_path ) ) : ?>
			<div style="display:none;"><?php echo file_get_contents( $svg_path ); ?></div>
		<?php endif; ?>

		<?php get_template_part( 'templates/navigation/nav', 'header' ); ?>

		<div class="overlay"></div>

		<!-- main site wrapper -->
		<?php
			$transitions = 'true';
			if (get_field('page_transitions', 'options')){
				$transitions = 'true';
			} ?>
		<div id="barba-wrapper" data-pagetransitions="<?=$transitions?>">
			<div class="wrapper barba-container" style="visibility: visible;">

<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]--> 
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]--> 
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]--> 
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]--> 
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->
	<head>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<!-- Prefetch the DNS for externally hosted files - http://goo.gl/TOCXgm -->
    	<link rel="dns-prefetch" href="//fonts.googleapis.com" />
    	<link rel="dns-prefetch" href="//www.google-analytics.com" />
	  	
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    	<!-- Mobile viewport optimization -->
    	<meta name="HandheldFriendly" content="True">
    	<meta name="MobileOptimized" content="320">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

    	<!-- Specify home screen label iOS6 (override title) -->
    	<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon.ico"/>
		<?php wp_head(); ?>
    	
	</head>
	<body <?php body_class(); ?>>


<header>
	<div class="container">
		<h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php bloginfo( 'description' ); ?>
	</div>

<?php Starkers_Utilities::get_template_parts( array( '/includes/navmenu' ) ); ?>
	
</header>

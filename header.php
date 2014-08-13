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
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    	<!--[if lt IE 9]>
	  	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<script>window.jQuery || document.write('<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/html5shiv.js"><\/script>')</script> 
      	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/min.respond.min.js"></script>
    	<![endif]-->
		<!--[if lt IE 8]><p class=chromeframe>Your browser is out of date and insecure. <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site as intended.</p><![endif]-->
	</head>
	<body <?php body_class(); ?>>


<header>
	<div class="container">
		<h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php bloginfo( 'description' ); ?>
	</div>

<nav class="nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
<div class="wrapper">
    <?php wp_nav_menu( array( 
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'nav-inner',
        'depth' => 2
    ) ); ?>
</div>
</nav>
	
</header>

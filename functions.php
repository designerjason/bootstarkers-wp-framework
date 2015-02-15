<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'assets/includes/starkers-utilities.php' );
	//require_once( 'assets/includes/Mobile_Detect.php' );
	//require_once( 'assets/includes/custom-post-type.php' );

	/*======================================================================================================================== */



























function startertheme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on startertheme, use a find and replace
	 * to change 'startertheme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'startertheme', get_template_directory() . '/languages' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
	  		'primary' => 'Primary Nav'
		)
	); 

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	//add_theme_support( 'post-formats', array(
	//	'aside', 'image', 'video', 'quote', 'link',
	//) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'startertheme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}










/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function startertheme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'startertheme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'startertheme_widgets_init' );
















	// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
	function remove_thumbnail_dimensions( $html ){

	    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	    return $html;
	}

	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
	add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to post images
	

	/** footer pagination for archive pages **/
	function le_pagination(){

		global $wp_query;

		$big = 999999999; // need an unlikely integer

			echo paginate_links( array(

				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'type' => 'list',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages

			) );
	
	}


	// Hide email from Spam Bots using a shortcode.
	function wpcodex_hide_email_shortcode( $atts , $content = null ) {
		if ( ! is_email( $content ) ) {
			return;
		}

		return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
	}
	
	add_shortcode( 'email', 'wpcodex_hide_email_shortcode' );



	// Google analytics code
	function add_ga_code() { ?>

		<script type="text/javascript">
	    	var _gaq = _gaq || [];
	    	_gaq.push( ['_setAccount', 'UA-XXXXX-X'] ); //Update 'UA-XXXXX-X' with valid account id
	    	_gaq.push( ['_trackPageview'] );

		    (function() {
	    	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	       	 ga.src = ( 'https:' == document.location.protocol ? 'https://ssl' : 'http://www' ) + '.google-analytics.com/ga.js';
	       	 var s = document.getElementsByTagName( 'script' )[0]; s.parentNode.insertBefore( ga, s );
	    	})();
		</script>

	 <?php }

	add_action( 'wp_footer', 'add_ga_code' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	// add_image_size( "thumb-mobile", width, height, True );


	function new_excerpt_length( $length ) {
		return 20;
	}
	
	add_filter( 'excerpt_length', 'new_excerpt_length' );



	// minified merged jquery file and sass compiled css
	 function starkers_script_enqueuer() {

	 	// Reload jquery so there are no conflicts
		if( !is_admin() ){
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', ( "http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ), false, null, true );
			wp_enqueue_script( 'jquery' );
		}
		
		wp_register_script( 'site', get_template_directory_uri().'/assets/js/min/script.min.js', false, null, true );
		wp_enqueue_script( 'site' );

		wp_register_style( 'bootstrap', get_stylesheet_directory_uri().'/assets/css/style.css', '', null, 'all' );
        wp_enqueue_style( 'bootstrap' );	
		
	}	

	// load jquery which is only required on some pages here
	function conditional_scripts(){

    	if ( is_page( 'pagenamehere' ) ) {
        	wp_register_script( 'scriptname', get_template_directory_uri() . '/js/scriptname.js', array( 'jquery' ), '1.0.0' ); // Conditional script(s)
        	wp_enqueue_script( 'scriptname' ); // Enqueue it!
    	}
	}
	
	//add_action( 'wp_print_scripts', 'conditional_scripts' ); // Add Conditional Page Scripts
	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );


	function IE_conditionals(){ ?>
					<!--[if lt IE 8]>
					<p class=chromeframe>Your browser is out of date and insecure. 
						<a href="http://browsehappy.com/">Upgrade to a different browser</a> 
						or <a href="http://www.google.com/chromeframe/?redirect=true">
						install Google Chrome Frame</a> to experience this site as intended.
					</p>
					<![endif]-->

					<!--[if lt IE 9]>
	  	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/min/respond.min.js"></script>
    	<![endif]-->
	<?php }

	add_filter( 'wp_head', 'IE_conditionals' );


	
	add_filter( 'excerpt_more', 'no_more_jumping' );
	add_filter( 'the_content_more_link', 'remove_more_jump_link' );


	// Remove junk from head
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/assets/includes/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/assets/includes/template-tags.php';

	?>
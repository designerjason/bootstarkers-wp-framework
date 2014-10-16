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
	require_once( 'assets/includes/admin.php' );
	//require_once( 'assets/includes/Mobile_Detect.php' );
	//require_once( 'assets/includes/custom-post-type.php' );

	/*======================================================================================================================== */


	add_theme_support('post-thumbnails');
	

	/** NAVIGATION **/
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
		  	'primary' => 'Primary Nav'
			)
		); 
	} 


	// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
	function remove_thumbnail_dimensions( $html ){
	    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	    return $html;
	}

	add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
	add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
	

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


	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	// Google analytics code

	function add_ga_code() { ?>

	<script type="text/javascript">
    	var _gaq = _gaq || [];
    	_gaq.push(['_setAccount', 'UA-XXXXX-X']); //Update 'UA-XXXXX-X' with valid account id
    	_gaq.push(['_trackPageview']);

	    (function() {
    	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       	 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       	 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    	})();
	</script>

	<?php } 

	add_action('wp_footer', 'add_ga_code');

	// Optimise jpeg images a bit more...deprecated...
	add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	// add_image_size( "thumb-mobile", width, height, True );


	if(false === get_option("medium_crop")) {
	    add_option("medium_crop", "1");
		
	} else {
    	update_option("medium_crop", "1");
			}


	function new_excerpt_length($length) {
		return 20;
	}
	
	add_filter('excerpt_length', 'new_excerpt_length');



	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head() and footer
	 *
	 * @return void
	 * @author Keir Whitaker
	 */


	// minified merged jquery file and sass compiled css
	 function starkers_script_enqueuer() {

	 	// Reload jquery so there are no conflicts
		if( !is_admin()){
			wp_deregister_script('jquery');
			wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"), false, null, true);
			wp_enqueue_script('jquery');
		}
		
		wp_register_script( 'site', get_template_directory_uri().'/assets/js/min/script.min.js', false, null, true );
		wp_enqueue_script( 'site' );

		wp_register_style( 'bootstrap', get_stylesheet_directory_uri().'/assets/css/style.css', '', null, 'all' );
        wp_enqueue_style( 'bootstrap' );	
		
	}	

	// load jquery which is only required on some pages here
	function conditional_scripts(){

    	if (is_page('pagenamehere')) {
        	wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        	wp_enqueue_script('scriptname'); // Enqueue it!
    	}
	}
	
	//add_action('wp_print_scripts', 'conditional_scripts'); // Add Conditional Page Scripts
	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );


	function pre_ie8_notice(){ ?>
					<!--[if lt IE 8]>
					<p class=chromeframe>Your browser is out of date and insecure. 
						<a href="http://browsehappy.com/">Upgrade to a different browser</a> 
						or <a href="http://www.google.com/chromeframe/?redirect=true">
						install Google Chrome Frame</a> to experience this site as intended.
					</p>
					<![endif]-->
	<?php }

	add_filter('wp_head', 'pre_ie8_notice');

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}

	// Remove wordpress version in head
	function wpbeginner_remove_version() { 
		return '';
	}
	add_filter('the_generator', 'wpbeginner_remove_version');


	// No more jumping for read more link
	function no_more_jumping($post) {
		return '<a href="'.get_permalink($post->ID).'" class="read-more">'.'Continue Reading'.'</a>';
	}
	add_filter('excerpt_more', 'no_more_jumping');
	add_filter('the_content_more_link', 'remove_more_jump_link');


	// Remove junk from head
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
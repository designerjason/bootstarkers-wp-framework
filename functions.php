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

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	//register_nav_menus(array('primary' => 'Primary Navigation'));

	//optimise jpeg images a bit more...deprecated...
	add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );
	

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	//add_image_size( "thumb-mobile", width, height, True );


	if(false === get_option("medium_crop")) {
	    
	    add_option("medium_crop", "1");
		
			} else {
    	
    			update_option("medium_crop", "1");
	}

		
	/**NAVIGATION**/
	/* if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
		  	'primary' => 'Primary Nav'
			)
		); 
	} */


	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head() and footer
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images


	if( !is_admin()){
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"), false, null, true);
		wp_enqueue_script('jquery');
	}


	 function starkers_script_enqueuer() {
		
		wp_register_script( 'site', get_template_directory_uri().'/assets/js/min/script.min.js', false, null, true );
		wp_enqueue_script( 'site' );

		wp_register_style( 'bootstrap', get_stylesheet_directory_uri().'/assets/css/bootstrap.css', '', null, 'all' );
        wp_enqueue_style( 'bootstrap' );	
		
	}	

	function conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}
	
add_action('wp_print_scripts', 'conditional_scripts'); // Add Conditional Page Scripts

	
	//google analytics code

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


// Remove Admin bar
function remove_admin_bar()
{
    return false;
}
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar


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
	
	
/*REMOVE ADMIN MENUS IF NOT ADMIN*/
	function remove_menus () {
get_currentuserinfo();
global $current_user, $menu;
if( ! in_array( 'administrator', $current_user->roles ) ){
	$restricted = array( __('Posts'), __('Links'), __('Tools'), __('Comments'), __('Feedbacks'), __('Settings'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}

}

add_action('admin_menu', 'remove_menus');



/* change the admins default welcome page */
function loginRedirect( $redirect_to, $request, $user ){
    if( is_array( $user->roles ) ) { // check if user has a role
        return home_url("/wp-admin/edit.php?post_type=ENTERHERE");

    }
}


add_filter("login_redirect", "loginRedirect", 10, 3);	

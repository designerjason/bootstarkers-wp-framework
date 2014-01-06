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
	require_once( 'assets/includes/Mobile_Detect.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	//register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	//add_image_size( "thumb-mobile", width, height, True );
	
	/**NAVIGATION**/
	/****** if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'primary' => 'Primary Nav'
		)
	); 
} **********/


	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head() and footer
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	if( !is_admin()){
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"), false, '1.9.1', true);
		wp_enqueue_script('jquery');
	}


	 function starkers_script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/assets/js/bootstrap.min.js', false, '', true );
		wp_enqueue_script( 'site' );
		
		wp_register_script( 'site', get_template_directory_uri().'/assets/js/site.js', false, '', true );
		wp_enqueue_script( 'site' );

		wp_register_style( 'bootstrap', get_stylesheet_directory_uri().'/assets/css/bootstrap.css', '', '', 'all' );
        wp_enqueue_style( 'bootstrap' );

		//wp_register_style( 'responsive', get_stylesheet_directory_uri().'/assets/css/bootstrap-responsive.css', '', '', 'screen' );
        //wp_enqueue_style( 'responsive' );		
		
		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
	}	
	
	
	function add_ga_code() 
{
?>
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
<?php
}
add_action('wp_footer', 'add_ga_code');


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
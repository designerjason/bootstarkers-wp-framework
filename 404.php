<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Please see /assets/includes/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'assets/includes/header' ) ); ?>

<div class="container">
	<h1>Page not found</h1>
	<h2>Well this is somewhat embarrassing, isn't it?</h2>

	<p>Sorry, but the page you were trying to view does not exist.</p>

	<p>It looks like this was the result of either:</p>
		
		<ul>
    		<li>a mistyped address</li>
    		<li>an out-of-date link</li>
		</ul>

	<p>If you think there should be a page here, please get in touch , thanks!</p>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'assets/includes/footer' ) ); ?>
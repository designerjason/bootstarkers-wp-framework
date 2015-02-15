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

get_header(); ?>

	<div class="container">
		<h1><?php _e( 'Oops! That page can&rsquo;t be found.', 'startertheme' ); ?></h1>

		<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'startertheme' ); ?></p>

	</div>

<?php get_footer(); ?>
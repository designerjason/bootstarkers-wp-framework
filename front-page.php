<?php
/**
 * Template file for when a static page is used for the home page
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>

<?php Starkers_Utilities::get_template_parts( array( 'header' ) ); ?>

<div class="container">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>

	<?php endwhile; ?>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'footer' ) ); ?>
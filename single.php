<?php
/**
 * The Template for displaying all single posts
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
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<article>

		<h1><?php the_title(); ?></h1>

		<?php the_content(); ?>			

	</article>

	<?php endwhile; ?>
</div>
<?php Starkers_Utilities::get_template_parts( array( 'assets/includes/footer' ) ); ?>
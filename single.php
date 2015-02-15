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

get_header(); ?>

<div class="container" role="main">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<article>

		<h1><?php the_title(); ?></h1>

		<?php the_content(); ?>			

	</article>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

	<?php endwhile; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
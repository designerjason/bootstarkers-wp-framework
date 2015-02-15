<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file 
 *
 * Please see /assets/includes/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */

get_header(); ?>

<div class="container" role="main">
<?php if ( have_posts() ): ?>
	<h1>Latest Posts</h1>	

	<ul>
	<?php while ( have_posts() ) : the_post(); ?>
		<li>
			<article>
			<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<?php the_content(); ?>
			</article>
		</li>
	<?php endwhile; ?>
	</ul>

	<?php else: ?>
	<h2>No posts to display</h2>
<?php endif; ?>
</div>

?php get_sidebar(); ?>
<?php get_footer(); ?>
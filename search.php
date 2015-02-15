<?php
/**
 * Search results page
 * 
 * Please see /assets/includes/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */

get_header(); ?>

<div class="container">
<?php if ( have_posts() ): ?>
	<h1>Search Results for '<?php echo get_search_query(); ?>'</h1>	

	<ol>
	<?php while ( have_posts() ) : the_post(); ?>
		<li>
			<article>
				<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

				<?php the_content(); ?>
			</article>
		</li>
	<?php endwhile; ?>
	</ol>

<?php le_pagination(); ?>
 
<?php else: ?>
	<h2>No results found for '<?php echo get_search_query(); ?>'</h2>
<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
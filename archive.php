<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts() 
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'assets/includes/html-header', 'assets/includes/header' ) ); ?>

<div class="container">
<?php if ( have_posts() ): ?>

<?php if ( is_day() ) : ?>
<h1>Archive: <?php echo  get_the_date( 'D M Y' ); ?></h1>							
<?php elseif ( is_month() ) : ?>
<h1>Archive: <?php echo  get_the_date( 'M Y' ); ?></h1>	
<?php elseif ( is_year() ) : ?>
<h1>Archive: <?php echo  get_the_date( 'Y' ); ?></h1>								
<?php else : ?>
<h1>Archive</h1>	
<?php endif; ?>

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

<?php Starkers_Utilities::get_template_parts( array( 'assets/includes/footer','assets/includes/html-footer' ) ); ?>
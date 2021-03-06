<?php
/**
 * Template file for when a static page is used for blog archive
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'header' ) ); ?>

<div class="container">
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

<?php Starkers_Utilities::get_template_parts( array( 'footer') ); ?>
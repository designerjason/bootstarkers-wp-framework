<?php
/**
 * The template used to display Tag Archive pages
 *
 * Please see /assets/includes/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'header' ) ); ?>
<div class="container">
	<?php if ( have_posts() ): ?>
	<h1>Tag Archive: <?php echo single_tag_title( '', false ); ?></h1>

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

	<?php else: ?>
		<h2>No posts to display in <?php echo single_tag_title( '', false ); ?></h2>
	<?php endif; ?>

<?php le_pagination(); ?>

</div>
<?php Starkers_Utilities::get_template_parts( array( 'footer' ) ); ?>
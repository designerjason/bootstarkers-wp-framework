<?php
/**
 * The template for displaying Author Archive pages
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
	<?php if ( have_posts() ): the_post(); ?>

	<h1>Author Archives: <?php echo get_the_author() ; ?></h1>

	<?php if ( get_the_author_meta( 'description' ) ) : ?>
	<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>

	<h3>About <?php echo get_the_author() ; ?></h3>
	<?php the_author_meta( 'description' ); ?>
	
	<?php endif; ?>

	<ul>
	<?php rewind_posts(); while ( have_posts() ) : the_post(); ?>
		<li>
			<article>
				<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

				<?php the_content(); ?>
			</article>
		</li>
	
	<?php endwhile; ?>
	</ul>

	<?php else: ?>
	<h2>No posts to display for <?php echo get_the_author() ; ?></h2>	
	<?php endif; ?>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'assets/includes/footer' ) ); ?>
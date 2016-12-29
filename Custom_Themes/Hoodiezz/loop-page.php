<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage Test Hoodiezz
 * @since Test Hoodiezz 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<h1 class="entry-title"><?php the_title(); ?></h1>
					
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'test_hoodiezz' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>
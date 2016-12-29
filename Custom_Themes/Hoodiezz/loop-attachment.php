<?php
/**
 * The loop that displays an attachment
 *
 * The loop displays the posts and the post content. See
 * https://codex.wordpress.org/The_Loop to understand it and
 * https://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-attachment.php.
 *
 * @package WordPress
 * @subpackage Test Hoodiezz
 * @since Test Hoodiezz 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post();

	wp_redirect(get_site_url());

endwhile; // end of the loop. ?>

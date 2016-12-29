<?php       
session_start();
/**
 * Template Name: Buy Hoodies
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Test Hoodiezz
 * @since Test Hoodiezz 1.0
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<h1 class="entry-title"><?php the_title(); ?></h1>
					
					<div class="entry-content" id="buyHoodies">
						<?php the_content(); ?>
						<h3>Shop by Category:</h3>
						<strong>Women's:</strong>
						<ul>
							<li><a href="/women/Pullover-Hoodies/"><img src="/wp-content/uploads/2015/10/Womens-Pullover-Hoodies.jpg" width="200" height="200" alt="Pullover Hoodies" /><br>Pullover Hoodies</a></li>
							<li><a href="/women/Workout-Sweatshirts/"><img src="/wp-content/uploads/2015/10/Womens-Workout-Hoodies.jpg" width="200" height="200" alt="Workout Sweatshirts" /><br>Workout Sweatshirts</a></li>
						</ul>
						<div>
							<strong class="clear">Men's:</strong>
						</div>
						<ul>
							<li><a href="/men/Pullover-Hoodies/"><img src="/wp-content/uploads/2015/10/Mens-Pullover-Hoodies.jpg" width="200" height="200" alt="Pullover Hoodies" /><br>Pullover Hoodies</a></li>
							<li><a href="/men/Workout-Sweatshirts/"><img src="/wp-content/uploads/2015/10/Mens-Workout-Hoodies.jpg" width="200" height="200" alt="Workout Sweatshirts" /><br>Workout Sweatshirts</a></li>
						</ul>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
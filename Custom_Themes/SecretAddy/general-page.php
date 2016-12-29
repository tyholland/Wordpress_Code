<?php   
session_start();  

/**
 * Template Name: General
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage SecretAddy
 * @since SecretAddy
 */

get_header(); 

$youtube = $_GET['video'];
?>

		<div id="container2" class="one-column">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>

					<div class="entry-content">
						<?php 
						if ( !empty($youtube) )
						{
							echo '<center><iframe width="425" height="349" src="http://www.youtube.com/embed/'.$youtube.'?hl=en&fs=1" frameborder="0" allowfullscreen></iframe></center>
							<p>
							<a href="/tutorials/">Back</a>
							</p>';
						}
						else
						{
						the_content();
						}?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
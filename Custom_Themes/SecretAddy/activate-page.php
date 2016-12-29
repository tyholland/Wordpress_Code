<?php   
session_start();
/**
 * Template Name: Activate
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
 if ( !isset($_SESSION['secretID']) )                                                                                                                         
{ 
get_header(); 
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
						<?php the_content(); ?>   
						<form method="post" action="/wp-content/themes/secretAddy/route.php">
              Type in your Activation Code to activate your site.<br /> 
  						<input type="text" name="activate" />
  						<input type="submit" name="submit_activate" value="Activate" />
						</form>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer();                                                                                                                                        
}                                                                                                                                                             
else                                                                                                                                                          
{                                                                                                                                                             
	wp_redirect('/profile');                                                                                                              
}                                                                                                                                                             
 ?>
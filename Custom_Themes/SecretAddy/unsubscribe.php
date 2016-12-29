<?php
session_start();
/**
 * Template Name: Unsubscribe
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

$num = $_GET['num'];
$notify = $_GET['notify'];	
$element = $_GET['element'];
$lone = $_GET['lone'];																											

?>

		<div id="container2" class="one-column">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-content">
					<?php
          if ( isset($lone) )
          {
            echo '<form action="/wp-content/themes/secretAddy/route.php" method="post">                                                                    
      						<input type="hidden" name="email" value="'.$lone.'" />                       
      						Do you wish to Unsubscribe this email?<br>
      						'.$lone.'<br>
      						<input type="submit" value="Unsubscribe" name="emailRemove" />     
      						</form>';
          }
          else
          {
          ?>
						<form action="/wp-content/themes/secretAddy/route.php" method="post">                                                                    
						<input type="hidden" name="id" value="<?php echo $num; ?>" />                                                                  
						<input type="hidden" name="element" value="<?php echo $element; ?>" />                                                                  
						<input type="hidden" name="decide" value="1" />                                                                  
						<input type="hidden" name="notify" value="<?php echo $notify; ?>" />   
						Do you wish to Unsubscribe from recieving these emails?<br>
						<input type="submit" value="Unsubscribe" name="unsubscribe" />     
						</form>
					<?php
          }
          ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
<?php
session_start();                                                                                                                                                               

/**
 * Template Name: Forgot Password
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
																			
$part = $_GET['part'];																			
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
						  <table>	  
							<?php
							if ( $part == '2' )
							{ 
                $id = $_GET['member'];
                $security = $wpdb->get_row( $wpdb->prepare("SELECT 		question
																			FROM				security
																			WHERE			ID = ".$id) );

                $me = $wpdb->get_row( $wpdb->prepare("SELECT 		email
                																			FROM				account
                																			WHERE			ID = ".$id) );
              ?>
							<form action="/wp-content/themes/secretAddy/route.php" method="post"> 
							<input type="hidden" name="email" value="<?php echo $me->email; ?>" /> 
							<input type="hidden" name="member" value="<?php echo $id; ?>" /> 
							<tr>                                                                                                                                                      
							 <td><b><?php echo $security->question; ?></b> <input type="text" name="secure" />                            
							 </td>                                                                                                                                                     
							</tr>
							<tr>                                                                                                                                                         
							 <td>                                                                                                                                      
							<input type="submit" value="Submit" name="submit_forgot" id="forgotButton" />                                                       
							 </td>                                                                                                                                                        
							</tr> 
							</form>
							<?php }
							else
							{?> 
							<form action="/wp-content/themes/secretAddy/route.php" method="post"> 
							<tr>                                                                                                                                                      
							 <td>Your SecretAddy Name: <input type="text" name="name" /></td>                                                                                                                                                     
							</tr>
							<tr>                                                                                                                                                         
							 <td>                                                                                                                                      
							<input type="submit" value="Submit" name="submit_email" id="forgotButton" />                                                       
							 </td>                                                                                                                                                        
							</tr> 
							</form>
							<?php } ?>
							</table>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
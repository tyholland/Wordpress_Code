<?php      
session_start();

/**
 * Template Name: Tell a Friend
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

$me = $wpdb->get_row( $wpdb->prepare("SELECT email FROM account WHERE ID = ".$_SESSION['secretID']) );                                                   
if ( isset($_SESSION['secretID']) )                         
{  
?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>

					<div class="entry-content">
						<div id="search">
						
							<form method="post" name="friendEmail" onsubmit="return friendCheck(this);" action="/wp-content/themes/secretAddy/route.php"> 
  											<input type="hidden" name="me" value="<?php echo $me->email; ?>" />
                        <b>Friend's Email 1:</b> <input type="text" name="friend1" size="30" /><br /><br />  
                        <b>Friend's Email 2:</b> <input type="text" name="friend2" size="30" /><br /><br />
                        <b>Friend's Email 3:</b> <input type="text" name="friend3" size="30" /><br /><br />
                        <b>Friend's Email 4:</b> <input type="text" name="friend4" size="30" /><br /><br />
                        <b>Friend's Email 5:</b> <input type="text" name="friend5" size="30" /><br /><br />
  											<input type="submit" name="send_friends" value="Tell Your Friends" /> 							
											                               											     										
							</form>
						</div>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar('profile'); ?>
<?php get_footer();
}
else
{    	
?>
  <div id="container2" class="one-column">
			<div id="content" role="main">
			
				<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-content">
            <div style="padding: 20px 0;" align="center">
            Please Sign In to view this page.<br /><br />                                                                                                                        
    				<form method="post" action="/wp-content/themes/secretAddy/route.php">
				      <input type="hidden" name="website" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />                                                                       
    					<p>                                                                                                                                   
    				SA Name: <input type="text" name="user" />                                                                                                    
    					</p>                                                                                                                                                
    					<p>                                                                                                                                   
    					Password: <input type="password" name="passwd" />                                                                                                   
    					</p>                                                                                                                                                
    					<p>                                                                                                                                     
    					<input type="submit" class="login" name="user_login" value="Login" />                                                                               
    					<span style="font-size: 12px;"><a href="<?php echo '/forgot-password'; ?>" title="Forgot your Password?" style="text-decoration: none;">Forgot your Password?</a></span>                                                         
    					</p>                                                                                                                                                
    				</form>
    				</div>
    				
					</div><!-- .entry-content -->

			</div><!-- #content -->
		</div><!-- #container -->
<?php
get_footer(); 
} 
?>
<?php      
session_start();          

/**
 * Template Name: By Activities
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

if ( isset($_SESSION['secretID']) )                         
{  
?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title">Connect by Activities</h1>

					<div class="entry-content">
						<div id="search">
						
							<form method="get" action="/wp-content/themes/secretAddy/connect-results.php">
				        <input type="hidden" name="radio" value="2" />                                     
				        <input type="hidden" name="id" value="<?php echo $_SESSION['secretID']; ?>" />  
				        <input type="hidden" name="website" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />     						
  							<p>
								Hobby 1: <input type="text" name="hobby1" />
                <a href="#" onclick="alert('Enter a Hobby that your Admirer might be into.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>
								Hobby 2: <input type="text" name="hobby2" />
                <a href="#" onclick="alert('Enter a Hobby that your Admirer might be into.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>
								Hobby 3: <input type="text" name="hobby3" />
                <a href="#" onclick="alert('Enter a Hobby that your Admirer might be into.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>
								Hobby 4: <input type="text" name="hobby4" />
                <a href="#" onclick="alert('Enter a Hobby that your Admirer might be into.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>
								Hobby 5: <input type="text" name="hobby5" />
                <a href="#" onclick="alert('Enter a Hobby that your Admirer might be into.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>                 
								<input type="image" alt="Connect" src="/wp-content/themes/secretAddy/images/connect.jpg"  style=" margin: -24px 0 -24px 0;" title="Connect" />      
								</p>			                               											     										
							</form>
						</div>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container --> 

<?php get_sidebar('connect'); ?>
<?php get_footer();  
}
else
{   	
?>
  <div id="container2" class="one-column">
			<div id="content" role="main">
			
				<h1 class="entry-title">Connect By Activities</h1>

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
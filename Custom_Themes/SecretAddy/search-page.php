<?php      
session_start();               

/**
 * Template Name: Search
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

$addy = $_GET['addy'];

$me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );
$rosePath = '/wp-content/themes/secretAddy/images/';        
                                                   
if ( isset($_SESSION['secretID']) )                         
{  
?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>   
              <img src="<?php echo $rosePath; ?>connect_image.jpg" alt="Connect by Email" title="Connect by Email" height="150px" width="400px" />
						<img src="<?php echo $rosePath; ?>connect_email.jpg" alt="Connect by Email" title="Connect by Email" height="100px" width="600px" />  

					<div class="entry-content">
						<div id="search">
						  <p>
							<form method="post" action="/wp-content/themes/secretAddy/route.php">
                        <b>Admirer's Email:</b> <input type="text" name="addyEmail" size="30" />
                        <a href="#" onclick="alert('Enter Admirer\'s Personal Email.');" title="Help"><img src="<?php echo $rosePath; ?>help.jpg" id="help" /></a>
                        <br /><br />
                        <input type="hidden" name="website" value="connect" />
  											<input type="hidden" name="me" value="<?php echo $me->secretAddy; ?>" />
  											
                        <p class="choice">
  												What do you want to tell your admirer?
                          <a href="#" onclick="alert('Write a Note to your Admirer.');" title="Help"><img src="<?php echo $rosePath; ?>help.jpg" id="help" /></a>
  											</p>
  											<textarea name="love" cols="50" rows="7"></textarea><br /><br />    
  						
                        <p class="choice">
  												What do you want your admirer to know about you?
                          <a href="#" onclick="alert('Choose any or all your Characteristics, \nthat you want your Admirer to know \nabout you.');" title="Help"><img src="<?php echo $rosePath; ?>help.jpg" id="help" /></a>
  											</p>
  											
  											<input type="checkbox" name="gender" value="1" /> Gender<br />
  											<input type="checkbox" name="body" value="1" /> Body Type<br /> 
  											<input type="checkbox" name="height" value="1" /> Height<br />
  											<input type="checkbox" name="hair" value="1" /> Hair Color<br />
  											<input type="checkbox" name="race" value="1" /> Ethnicity<br />
  											<input type="checkbox" name="desire" value="1" /> Desired Admirer<br />
  											<input type="checkbox" name="age" value="1" /> Age<br />
  											<input type="checkbox" name="locate" value="1" /> Location<br /><br />
  						
  						          <p class="choice">
  												Would you like to send your admirer a rose?
                          <a href="#" onclick="alert('Choose if you want to send your Admirer a Rose or not.');" title="Help"><img src="<?php echo $rosePath; ?>help.jpg" id="help" /></a>
  											</p>
  											
  											<img src="<?php echo $rosePath; ?>rose.jpg" style="height: 150px; width:150px;" alt="Roses" title="Roses" />  <br />
  											<input type="radio" name="rose" value="0" /> Yes
  											<input type="radio" name="rose" value="1" /> No   <br /><br />
  											<input type="submit" name="send_admirer" value="Connect with Admirer" /> 							
											                               											     										
							</form>
							</p>
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
			
				<h1 class="entry-title">Connect By Email</h1>

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
<?php 
session_start();             
                                                                                                                                       
/**                                                                                                                                                            
 * Template Name: Upload                                                                                                                                       
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
$me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );                                                                                                                                                       
if ( isset($_SESSION['secretID']) )                                                                                                                            
{                                                    
?>                                                                                                                                                             
                                                                                                                                                               
		<div id="container">                                                                                                                                       
			<div id="content" role="main">                                                                                                                           
                                                                                                                                                               
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>                                                                                              
                                                                                                                                                               
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                                                                                              
                                                                                                                                                               
					<div class="entry-content"> 
					  <form method="post" action="/wp-content/themes/secretAddy/route.php" enctype="multipart/form-data">                                     
					  <input type="hidden" name="myself" value="<?php echo $me->secretAddy; ?>">                                     
					  <input type="hidden" name="photoType" value="public">                                                                    
					  Upload a Private Image:                                                                                                                                       
					  <p class="priv">                                                                                                                                   
						<input type="file" name="image" /><br />                                                                                
						<input type="submit" name="upload_photo" value="Upload" />                                                                                     
						</p>                                                                                                                                               
						</form>     
					</div><!-- .entry-content -->                                                                                                                        
				</div><!-- #post-## -->                                                                                                                                
                                                                                                                                                               
<?php endwhile; ?>                                                                                                                                             
                                                                                                                                                               
			</div><!-- #content -->                                                                                                                                  
		</div><!-- #container -->                                                                                                                                  
                                                                                                                                                               
<?php get_sidebar('photos'); ?>                                                                                                                                
<?php get_footer();
}
else
{    	
?>
  <div id="container2" class="one-column">
			<div id="content" role="main">
			
				<h1 class="entry-title">Upload Photos</h1>

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
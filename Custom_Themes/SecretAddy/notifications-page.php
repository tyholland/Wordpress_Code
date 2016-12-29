<?php
session_start();           
                                                                                                                                           
/**                                                                                                                                                           
 * Template Name: Notifications                                                                                                                                     
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
                                                                                                                                                              
$secret = $wpdb->get_row( $wpdb->prepare("SELECT 		*                                                                                                      
																		FROM				notification                                                                                                       
																		WHERE			ID = '".$_SESSION['secretID']."' ") );                                                                          
                                                                                                                                  
if ( isset($_SESSION['secretID']) )                                                                                                                           
{     																			                                                                                                                        
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
						                                                                                                                                                  
						<div id="privacy">                                                                                                                                   
  						<form method="post" action="/wp-content/themes/secretAddy/route.php">  						                                                  
						<input type="hidden" name="id" value="<?php echo $_SESSION['secretID']; ?>" />                                                                    
    						<table>                                                                                                                                       
      						<tr>                                                                                                                                        
        						<th width="400">                                                                                                                          
        						  Email Notifications                                                                                                                        
        						</th>                                                                                                                                     
        						<th width="100">                                                                                                                          
        						  Enable                                                                                                                                     
        						</th>                                                                                                                                     
        						<th width="100">                                                                                                                          
        						  Disable                                                                                                                                      
        						</th>                                                                                                                                     
      						</tr>                                                                                                                                        
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  Admirer Request Recieved:                                                                                                                              
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="receive" value="0" <?php checked( '0', $secret->receive ) ?> />                                                  
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="receive" value="1" <?php checked( '1', $secret->receive ) ?> />                                                  
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                        
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  Admirer Request Accepted:                                                                                                                              
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="addy" value="0" <?php checked( '0', $secret->addy ) ?> />                                                  
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="addy" value="1" <?php checked( '1', $secret->addy ) ?> />                                                  
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                     
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  New Inbox Message:                                                                                                                              
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="message" value="0" <?php checked( '0', $secret->message ) ?> />                                                  
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="message" value="1" <?php checked( '1', $secret->message ) ?> />                                                  
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                      
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  New Addy Wall Post:                                                                                                                              
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="post" value="0" <?php checked( '0', $secret->post ) ?> />                                                  
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="post" value="1" <?php checked( '1', $secret->post ) ?> />                                                  
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                 
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  New Rose Received:                                                                                                                                 
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="rose" value="0" <?php checked( '0', $secret->rose ); ?> />                                                 
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="rose" value="1" <?php checked( '1', $secret->rose ); ?> />                                                 
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                      
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  Bouquet of Roses Received:                                                                                                                              
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="bouquet" value="0" <?php checked( '0', $secret->bouquet ) ?> />                                                  
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="bouquet" value="1" <?php checked( '1', $secret->bouquet ) ?> />                                                  
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                     
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  Pass A Note Received:                                                                                                                              
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="love" value="0" <?php checked( '0', $secret->love ) ?> />                                                  
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="love" value="1" <?php checked( '1', $secret->love ) ?> />                                                  
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                        
    						</table>                                                                                                                                      
    						<p class="priv">                                                                                                                              
    						<input type="submit" name="save_notification" value="Save Changes" />                                                                              
    						</p>                                                                                                                                          
  						</form> 
            </div>                                                                                                                                            
					</div><!-- .entry-content -->                                                                                                                       
				</div><!-- #post-## -->                                                                                                                               
                                                                                                                                                              
<?php endwhile; ?>                                                                                                                                            
                                                                                                                                                              
			</div><!-- #content -->                                                                                                                                 
		</div><!-- #container -->                                                                                                                                 
                                                                                                                                                              
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
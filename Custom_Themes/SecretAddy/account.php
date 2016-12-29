<?php
session_start();                                                                                                                                                   
/**                                                                                                                                                           
 * Template Name: Account                                                                                                                                     
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

$me = $wpdb->get_row( $wpdb->prepare("SELECT 		secretAddy                                                                                                      
																		FROM				account                                                                                                       
																		WHERE			ID = '".$_SESSION['secretID']."' ") ); 
                                                                                                                                                                                                  
$credit = $wpdb->get_row( $wpdb->prepare("SELECT 		amount                                                                                                      
																		FROM				credits                                                                                                       
																		WHERE			secretAddy = '".$me->secretAddy."' ") );                                                                          
                                                                                                                                  
if ( isset($_SESSION['secretID']) )                                                                                                                           
{     																			                                                                                                                        
?>                                                                                                                                                            
                                                                                                                                                              
		<div id="container2" class="one-column">                                                                                                                  
			<div id="content" role="main">                                                                                                                          
                                                                                                                                                              
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>                                                                                             
                                                                                                                                                              
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                                                                                                                 
						<h1 class="entry-title"><?php the_title(); ?></h1>                                                                                                                                         
                                                                                                                                                              
					<div class="entry-content">                                                                                                                         
						<?php the_content(); ?>                                                                                                                           
						                                                                                                                                                  
						<div id="credits">              
						<p>
            <h2><img src="/wp-content/themes/secretAddy/images/addy_credits_text.jpg" width="200" height="50" alt="Addy Credits" title="Addy Credits" /> <div style="margin: -39px 0 40px 235px;"><?php echo $credit->amount; ?></div></h2>
            </p>
						
						<p>
						<h3><a href="http://www.1shoppingcart.com/SecureCart/SecureCart.aspx?mid=AF3EE08F-D6A6-4679-8CB2-462EBC86938E" title="View Cart">View Cart</a></h3>
            </p>
						
						<p>
						<h3>Add More Addy Credits:</h3><br>
						<b>10 Credits</b> <span style="padding: 0 0 0 60px;">Price: $1</span><br> <a href="http://www.1shoppingcart.com/SecureCart/SecureCart.aspx?mid=AF3EE08F-D6A6-4679-8CB2-462EBC86938E&pid=a8cf5bd1837c479ab4a59601ce497d2a" style="padding: 0 0 0 135px;"><img src="http://www.mcssl.com/netcart/images/cart_buttons/cart_button_5.gif" border="0" /></a><br><br>
						
						<p>
						<b>25 Credits</b> <span style="padding: 0 0 0 60px;">Price: $2</span><br> <a href="http://www.1shoppingcart.com/SecureCart/SecureCart.aspx?mid=AF3EE08F-D6A6-4679-8CB2-462EBC86938E&pid=a8c2ee9936214431bee120db6b352f11" style="padding: 0 0 0 135px;"><img src="http://www.mcssl.com/netcart/images/cart_buttons/cart_button_5.gif" border="0" /></a><br>
						</p>
						
						<p>
						<b>50 Credits</b> <span style="padding: 0 0 0 60px;">Price: $5</span><br> <a href="http://www.1shoppingcart.com/SecureCart/SecureCart.aspx?mid=AF3EE08F-D6A6-4679-8CB2-462EBC86938E&pid=7a0a2149338c481aa1d3cdc48d86c329" style="padding: 0 0 0 135px;"><img src="http://www.mcssl.com/netcart/images/cart_buttons/cart_button_5.gif" border="0" /></a><br>
						</p>
            </p>
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
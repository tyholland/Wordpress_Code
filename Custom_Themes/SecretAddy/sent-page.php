<?php                                                                                                                                                
session_start();    
                                                                                                                                                                                                                                                                                                             
/**                                                                                                                                                            
 * Template Name: Sent                                                                                                                                         
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
                                                                                                                                                               
$secret = mysql_query("SELECT		  	*                                                                                                                          
										FROM				inbox                                                                                                                          
										WHERE			sentFrom = '".$me->secretAddy."' ORDER BY date DESC , ID DESC ");                                                                                             
                                                                                                                   
if ( isset($_SESSION['secretID']) )                                                                                                                            
{                                                                                                                                                                
?>                                                                                                                                                             
                                                                                                                                                               
		<div id="container">                                                                                                                                       
			<div id="content" role="main">                                                                                                                           
                                                                                                                                                               
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>                                                                                              
                                                                                                                                                               
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                                                                                              
                                                                                                                                                               
					<div class="entry-content">   
					<form method="post" action="/wp-content/themes/secretAddy/route.php">                                                                     
						<table>                                                                                                                                            
  						<tr>                                                                                                                                             
    						<th width="50" class="message">                                                                                                                
    						</th>                                                                                                                                          
    						<th width="250" class="message">                                                                                                               
    						  To:                                                                                                                                          
    						</th>                                                                                                                                          
    						<th width="250" class="message">                                                                                                               
    						  Subject:                                                                                                                                     
    						</th>                                                                                                                                          
    						<th width="100" class="message">                                                                                                               
    						  Date:                                                                                                                                        
    						</th>                                                                                                                                          
  						</tr>                                                                                                                                            
  						<?php               
  							$i = 0;
  							
							while ( $admirer = mysql_fetch_assoc($secret) )                                                                                                  
							{                                                                                                                                                
								if ( $admirer['delete2'] != 'Y' )                                                                                                              
								{   
								
  							  $addyName = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM account WHERE secretAddy = '".$admirer['sentTo']."' ") );
  							  $addy = $wpdb->get_row( $wpdb->prepare("SELECT reference FROM randomID WHERE ID = ".$addyName->ID) );
                                                                                                                                                             
  								echo '                                                                                                                                       
  								<tr>                                                                                                                                         
  									<td>                                                                                                                                       
  									  <input type="checkbox" name="checker['.$i.']" value="'.$admirer['ID'].'" />                                                  
  									</td>                                                                                                                                      
  									<td>                                                                                                                                       
  									  <a href="/admirer/?ref='.$addy->reference.'" title="'.$admirer['sentTo'].'">'.$admirer['sentTo'].'</a>                                                                                                                   
  									</td>                                                                                                                                      
  									<td>                                                                                                                                       
  									  <a href="/wp-content/themes/secretAddy/inbox-results.php?sent='.$admirer['ID'].'" title="'.$admirer['subject'].'">'.$admirer['subject'].'</a>                   
  									</td>                                                                                                                                      
  									<td>                                                                                                                                       
  									  '.$admirer['date'].'                                                                                                                     
  									</td>                                                                                                                                      
  								</tr>';                                                                                                                                      
  								}
  								$i++;
							}    
							echo '<input type="hidden" name="count" value="'.$i.'" />';                                                                                                                                            
  						?>                                                                                                                                               
						</table>                                                                                                                                           
						<p class="priv">                                                                                                                                   
           					<input type="submit" name="del_sentMes" value="Delete Message" />					                                                                 
           				</p>                                                                                                                                         
					</form>     
					</div><!-- .entry-content -->                                                                                                                        
				</div><!-- #post-## -->                                                                                                                                
                                                                                                                                                               
<?php endwhile; ?>                                                                                                                                             
                                                                                                                                                               
			</div><!-- #content -->                                                                                                                                  
		</div><!-- #container -->                                                                                                                                  
                                                                                                                                                               
<?php get_sidebar('inbox'); ?>                                                                                                                                 
<?php get_footer();   
}
else
{    	
?>
  <div id="container2" class="one-column">
			<div id="content" role="main">
			
				<h1 class="entry-title">Sent Messages</h1>

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
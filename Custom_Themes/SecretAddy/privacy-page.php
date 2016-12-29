<?php
session_start();               
                                                                                                                                            
/**                                                                                                                                                           
 * Template Name: Privacy                                                                                                                                     
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
                                                                                                                                                              
$secret = $wpdb->get_row( $wpdb->prepare("SELECT 		bodyType,                                                                                                     
																								hair,                                                                                                         
																								ethnicity,                                                                                                    
																								admirers,                                                                                                     
																								bio,                                                                                                          
																								age,                                                                                                        
																								city,                                                                                                         
																								height,
																								job
																		FROM				privacy                                                                                                       
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
						<?php                        
						the_content(); ?>                                                                                                                           
						                                                                                                                                                  
						<div id="privacy">                                                                                                                                
  						<form method="post" action="/wp-content/themes/secretAddy/route.php">  						                                                  
						<input type="hidden" name="id" value="<?php echo $_SESSION['secretID']; ?>" />                                                                    
    						<table>                                                                                                                                       
      						<tr>                                                                                                                                        
        						<th width="300">                                                                                                                          
        						  Viewable Content                                                                                                                        
        						</th>                                                                                                                                     
        						<th width="100">                                                                                                                          
        						  Yes                                                                                                                                     
        						</th>                                                                                                                                     
        						<th width="100">                                                                                                                          
        						  No                                                                                                                                      
        						</th>                                                                                                                                     
      						</tr>                                                                                                                                              
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  Body Type:                                                                                                                              
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="bod" value="0" <?php checked( '0', $secret->bodyType ) ?> />                                                  
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="bod" value="1" <?php checked( '1', $secret->bodyType ) ?> />                                                  
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                       
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  Height:                                                                                                                                 
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="height" value="0" <?php checked( '0', $secret->height ) ?> />                                                 
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="height" value="1" <?php checked( '1', $secret->height ) ?> />                                                 
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                       
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  Hair Color:                                                                                                                             
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
        			  <input type="radio" name="hair" value="0" <?php checked( '0', $secret->hair ) ?> />                                                           
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="hair" value="1" <?php checked( '1', $secret->hair ) ?> />                                                     
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                       
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  Ethnicity:                                                                                                                              
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
        						  <input type="radio" name="race" value="0" <?php checked( '0', $secret->ethnicity ) ?> />                                                
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="race" value="1" <?php checked( '1', $secret->ethnicity ) ?> />                                                
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                       
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  Desired Admirer:                                                                                                                        
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
        						  <input type="radio" name="admir" value="0" <?php checked( '0', $secret->admirers ) ?> />                                                
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="admir" value="1" <?php checked( '1', $secret->admirers ) ?> />                                                
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                       
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                                                                                                                                                                                    
        						  Age:                                                                                                                                                                                                                                                                                        
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
        						  <input type="radio" name="age" value="0" <?php checked( '0', $secret->age ) ?> />                                                     
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="age" value="1" <?php checked( '1', $secret->age ) ?> />                                                     
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                       
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						  Location:                                                                                                                               
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
        						  <input type="radio" name="locate" value="0" <?php checked( '0', $secret->city ) ?> />                                                   
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="locate" value="1" <?php checked( '1', $secret->city ) ?> />                                                   
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                       
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						Bio Description:                                                                                                                          
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
        						  <input type="radio" name="bio" value="0" <?php checked( '0', $secret->bio ) ?> />                                                       
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="bio" value="1" <?php checked( '1', $secret->bio ) ?> />                                                       
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                
      						<tr>                                                                                                                                        
        						<td>                                                                                                                                      
        						Occupation/Profession:                                                                                                                          
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
        						  <input type="radio" name="job" value="0" <?php checked( '0', $secret->job ) ?> />                                                       
        						</td>                                                                                                                                     
        						<td>                                                                                                                                      
                      <input type="radio" name="job" value="1" <?php checked( '1', $secret->job ) ?> />                                                       
        						</td>                                                                                                                                     
      						</tr>                                                                                                                                    
    						</table>                                                                                                                                      
    						<p class="priv">                                                                                                                              
    						<input type="submit" name="save_privacy" value="Save Changes" />                                                                              
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
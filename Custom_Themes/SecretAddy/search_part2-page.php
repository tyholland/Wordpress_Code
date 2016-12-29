<?php      
session_start();            

/**
 * Template Name: By Characteristics
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

$secret1 = mysql_query("SELECT DISTINCT city FROM account WHERE city != '' ");
$secret2 = mysql_query("SELECT DISTINCT state FROM account WHERE state != '' ");
$secret3 = mysql_query("SELECT DISTINCT zip FROM account WHERE zip != '' ");
$secret4 = mysql_query("SELECT DISTINCT gender FROM account WHERE gender != '' ");
$secret5 = mysql_query("SELECT DISTINCT bodyType FROM account WHERE bodyType != '' ");
$secret6 = mysql_query("SELECT DISTINCT hair FROM account WHERE hair != '' ");
$secret7 = mysql_query("SELECT DISTINCT ethnicity FROM account WHERE ethnicity != '' ");
$secret8 = mysql_query("SELECT DISTINCT height FROM account WHERE height != '' ");     
                                                    
if ( isset($_SESSION['secretID']) )                         
{  
?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title">Connect by Traits</h1>

					<div class="entry-content">
						<div id="search">
						
							<form method="get" action="/wp-content/themes/secretAddy/connect-results.php">   
				        <input type="hidden" name="radio" value="1" />                                     
				        <input type="hidden" name="id" value="<?php echo $_SESSION['secretID']; ?>" />     
				        <input type="hidden" name="website" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />   
                <p>
								City: <select name="city">     
								<option value="None">None</option>                                                                                
								<?php while ( $addy = mysql_fetch_assoc($secret1) )                                                                          
								{                                                                                                                             
									echo '<option value="'.$addy['city'].'">'.$addy['city'].'</option>';                                                          
								}?>                                                                                                                           
								</select>  
    						<a href="#" onclick="alert('Choose the City that your Admirer is from.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>
								State: <select name="state">
								<option value="None">None</option>
								<?php while ( $addy2 = mysql_fetch_assoc($secret2) )                                                                          
								{                                                                                                                             
									echo '<option value="'.$addy2['state'].'">'.$addy2['state'].'</option>';                                                          
								}?>                                                                                                                           
								</select>  
								<a href="#" onclick="alert('Choose the State that \nyour Admirer is from.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a> 
                </p>
                <p>
								Zip: <select name="zip">          
								<option value="None">None</option>                                                                   
								<?php while ( $addy3 = mysql_fetch_assoc($secret3) )                                                                          
								{                                                                                                                             
									echo '<option value="'.$addy3['zip'].'">'.$addy3['zip'].'</option>';                                                          
								}?>                                                                                                                           
								</select>  
								<a href="#" onclick="alert('Choose the Zip Code that \nyour Admirer is from.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>
								Gender: <select name="gender">    
								<option value="None">None</option>                                                                         
								<?php while ( $addy4 = mysql_fetch_assoc($secret4) )                                                                          
								{                                                                                                                             
									echo '<option value="'.$addy4['gender'].'">'.$addy4['gender'].'</option>';                                                          
								}?>                                                                                                                           
								</select>  
								<a href="#" onclick="alert('Choose the Gender of your Admirer.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>
								Age: <select name="age">      
								<option value="None">None</option>
                <option value="18">18 - 28</option>
                <option value="28">28 - 38</option>
                <option value="38">38 - 48</option>
                <option value="48">48 - 58</option>
                <option value="58">58 - 68</option>
                <option value="68">69 - 78</option>                                                                                                                                  
								</select>  
								<a href="#" onclick="alert('Choose the Age of your Admirer.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>
								Body Type: <select name="body">    
								<option value="None">None</option>                                                                         
								<?php while ( $addy5 = mysql_fetch_assoc($secret5) )                                                                          
								{                                                                                                                             
									echo '<option value="'.$addy5['bodyType'].'">'.$addy5['bodyType'].'</option>';                                                          
								}?>                                                                                                                           
								</select>  
								<a href="#" onclick="alert('Choose the Body Type of your Admirer.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>
								Hair Color: <select name="hair">      
								<option value="None">None</option>                                                                       
								<?php while ( $addy6 = mysql_fetch_assoc($secret6) )                                                                          
								{                                                                                                                             
									echo '<option value="'.$addy6['hair'].'">'.$addy6['hair'].'</option>';                                                          
								}?>                                                                                                                           
								</select>  
								<a href="#" onclick="alert('Choose the Hair Color of your Admirer.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>
								Ethnicity: <select name="race">    
								<option value="None">None</option>                                                                         
								<?php while ( $addy7 = mysql_fetch_assoc($secret7) )                                                                          
								{                                                                                                                             
									echo '<option value="'.$addy7['ethnicity'].'">'.$addy7['ethnicity'].'</option>';                                                          
								}?>                                                                                                                           
								</select>  
								<a href="#" onclick="alert('Choose the Ethnicity of your Admirer.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
                </p>
                <p>
								Height: <select name="height">      
								<option value="None">None</option>                                                                       
								<?php while ( $addy8 = mysql_fetch_assoc($secret8) )                                                                          
								{                                                                                                                             
									echo '<option value="'.$addy8['height'].'">'.$addy8['height'].'</option>';                                                          
								}?>                                                                                                                           
								</select>  
								<a href="#" onclick="alert('Choose the Height of your Admirer.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
    						</p>	
                <p> 
				Occupation/Profession: <input type="text" name="job" />
               <a href="#" onclick="alert('Enter the Occupation/Profession that \nyour Admirer works at.');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" id="help" /></a>
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
			
				<h1 class="entry-title">Connect By Traits</h1>

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
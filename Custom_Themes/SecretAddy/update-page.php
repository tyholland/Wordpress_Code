<?php
session_start();          

/**
 * Template Name: Update Profile
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
 
$secret = $wpdb->get_row( $wpdb->prepare("SELECT 			secretAddy,
																									skypeID, 
																									email,
																									gender,
																									bodyType,
																									hair,
																									ethnicity,
																									admirers,
																									bio,
																									age,
																									city,
																									state,
																									zip,
																									height
																			FROM				account
																			WHERE			ID = '".$_SESSION['secretID']."' ") );
																			

  $interest = $wpdb->get_row( $wpdb->prepare("SELECT 			job
    																			FROM				interests
    																			WHERE			  ID = '".$_SESSION['secretID']."' ") );																				

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
						
						<div id="account">
  						<form method="post" action="/wp-content/themes/secretAddy/route.php">
  							<input type="hidden" name="id" value="<?php echo $_SESSION['secretID']; ?>" />
    						SecretAddy Name: <input type="text" name="secret" value="<?php echo $secret->secretAddy; ?>" readonly /><br />
    						City: <input type="text" name="city" value="<?php echo $secret->city; ?>" /><br /> 
    						State: <input type="text" name="state" value="<?php echo $secret->state; ?>" maxlength="2" /><br /> 
    						Zip: <input type="text" name="zip" value="<?php echo $secret->zip; ?>" maxlength="5" /><br /> 
    						Occupation/Profession: <input type="text" name="job" value="<?php echo stripslashes($interest->job); ?>" /><br /> 
    						Skype ID: <input type="text" name="skype" value="<?php echo $secret->skypeID; ?>" /><br />  
    						Email: <input type="text" name="email" value="<?php echo $secret->email; ?>" /><br /> 
    						Gender: <select name="gender"> 
    						<option<?php if ( $secret->gender == "Male" ) { echo ' selected="selected"'; } ?> value="Male">Male</option>
    						<option<?php if ( $secret->gender == "Female" ) { echo ' selected="selected"'; } ?>  value="Female">Female</option>
    						</select><br />
    						Age: <select id="date" name="age">
    						<?php
    							echo '<option value="">Age</option>';
								 foreach ( range(18, 70) as $array3 )
								{ 
									if ( $array3 == $secret->age ) 
									{
										$selectY = 'selected="selected" ';
									}
									else
									{
										$selectY = "";
									}
										echo '<option '.$selectY.'value="'.$array3.'">'.$array3.'</option>';										
								}
							?>
    						</select><br />
    						Body Type: <select name="body">      
    						<option<?php if ( $secret->bodyType == "Skinny" ) { echo ' selected="selected"'; } ?> value="Skinny">Skinny</option>
    						<option<?php if ( $secret->bodyType == "Fit" ) { echo ' selected="selected"'; } ?> value="Fit">Fit</option>          
    						<option<?php if ( $secret->bodyType == "Athletic" ) { echo ' selected="selected"'; } ?> value="Athletic">Athletic</option> 
    						<option<?php if ( $secret->bodyType == "Muscle Build" ) { echo ' selected="selected"'; } ?> value="Muscle Build">Muscle Build</option>   
    						<option<?php if ( $secret->bodyType == "Thick" ) { echo ' selected="selected"'; } ?> value="Thick">Thick</option>
    						<option<?php if ( $secret->bodyType == "Full Sized" ) { echo ' selected="selected"'; } ?> value="Full Sized">Full Sized</option> 
    						<option<?php if ( $secret->bodyType == "Curvy" ) { echo ' selected="selected"'; } ?> value="Curvy Figure">Curvy Figure</option>
    						</select><br />    	
    						Hair Color: <select name="hair">
    						<option<?php if ( $secret->hair == "Brunette" ) { echo ' selected="selected"'; } ?> value="Brunette">Brunette</option>
    						<option<?php if ( $secret->hair == "Black" ) { echo ' selected="selected"'; } ?> value="Black">Black</option>
    						<option<?php if ( $secret->hair == "Blonde" ) { echo ' selected="selected"'; } ?> value="Blonde">Blonde</option>
    						<option<?php if ( $secret->hair == "Red" ) { echo ' selected="selected"'; } ?> value="Red">Red</option>
    						<option<?php if ( $secret->hair == "Other" ) { echo ' selected="selected"'; } ?> value="Other">Other</option>
    						</select><br />
    						Ethnicity: <select name="race">
    						<option<?php if ( $secret->ethnicity == "African American" ) { echo ' selected="selected"'; } ?> value="African American">African American</option>
    						<option<?php if ( $secret->ethnicity == "Caucasian" ) { echo ' selected="selected"'; } ?> value="Caucasian">Caucasian</option>
    						<option<?php if ( $secret->ethnicity == "Asian" ) { echo ' selected="selected"'; } ?> value="Asian">Asian</option>
    						<option<?php if ( $secret->ethnicity == "Hispanic" ) { echo ' selected="selected"'; } ?> value="Hispanic">Hispanic</option> 
    						<option<?php if ( $secret->ethnicity == "East Indian" ) { echo ' selected="selected"'; } ?> value="East Indian">East Indian</option>
    						<option<?php if ( $secret->ethnicity == "Other" ) { echo ' selected="selected"'; } ?> value="Other">Other</option>
    						</select><br />
    						Desired Admirer: <select name="admirer">
    						<option<?php if ( $secret->admirers == "Male" ) { echo ' selected="selected"'; } ?> value="Male">Male</option>
    						<option<?php if ( $secret->admirers == "Female" ) { echo ' selected="selected"'; } ?> value="Female">Female</option>
    						</select><br />					
    						Height: <select id="height" name="height">
    						<option<?php if ( $secret->height == "Tall" ) { echo ' selected="selected"'; } ?> value="Tall">Tall (6' and above)</option>
    						<option<?php if ( $secret->height == "Average" ) { echo ' selected="selected"'; } ?> value="Average">Average (5'1" - 5'11")</option>
    						<option<?php if ( $secret->height == "Short" ) { echo ' selected="selected"'; } ?> value="Short">Short (5' and below)</option>
    						</select><br />
    						<p align="center">
    						<br />
    						Bio Description: <br /><textarea name="bio" cols="50" rows="7"><?php echo stripslashes($secret->bio); ?></textarea>
    						</p>
  						</div>
    						<p class="saveAcc">
    						<input type="submit" name="save_account" value="Save Changes" />
    						</p>
    					</form>
    					<p class="delAcc">
                <a href="/delete-account/">Delete Account</a>
              </p>
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
}?>
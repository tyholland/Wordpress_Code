<?php 
session_start();  

/**
 * Template Name: Profile
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
													
$interest = $wpdb->get_row( $wpdb->prepare("SELECT 			book,
    																									food, 
    																									color,
    																									sport,
    																									movie,
    																									tv,
    																									song,
    																									singer,
    																									skool,
    																									college,
    																									job,
    																									hobby1,
    																									hobby2,
    																									hobby3,
    																									hobby4,
    																									hobby5
    																			FROM				interests
    																			WHERE			  ID = '".$_SESSION['secretID']."' ") );													
																			
$private = $wpdb->get_row( $wpdb->prepare("SELECT 		bodyType,
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
												
$security = $wpdb->get_row( $wpdb->prepare("SELECT 		question,
																									answer
																			FROM				security
																			WHERE			ID = '".$_SESSION['secretID']."' ") );											
												
$status = $wpdb->get_row( $wpdb->prepare("SELECT 		status
												FROM				statuses
												WHERE			secretAddy = '".$secret->secretAddy."' ") );	
												
$credit = $wpdb->get_row( $wpdb->prepare("SELECT 		amount                                                                                                      
																		FROM				credits                                                                                                       
																		WHERE			secretAddy = '".$secret->secretAddy."' ") ); 												

if ( isset($_SESSION['secretID']) )
{
?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title"><?php echo $secret->secretAddy; ?></h1>
						<?php
						echo '<h3><p id="move2">Addy Credits: '.$credit->amount.'</p></h3>';
						?>
            
            <?php
            
            if ( $secret->gender == "" || $security->answer == "" )
            { ?>
              <div id="bouquetAlert">
				  <p id="errorMsg">Profile is not complete.<br />
				  Please fill out the Following:</p>
				  <?php if ( $secret->gender == "") { ?>**<a href="/profile-page/update">Gender</a><br /><?php } ?>
				  <?php if ( $security->answer == "") { ?>**<a href="/privacy/security">Security Question</a><br /><?php } ?>
              </div>
            <?php
            } ?>

					<div class="entry-content">
						<p>
						<h2><?php echo stripslashes($status->status); ?></h2>
						</p>
						<p>
						<form method="get" action="/wp-content/themes/secretAddy/route.php">
						<input type="hidden" name="id" value="<?php echo $secret->secretAddy; ?>" />
						Edit Status: <input type="text" name="status" size="50" style="height: 30px; font-size: 18px;" /><br />
						<input type="hidden" name="edit_status" value="Update Status" />
						<input type="image" src="/wp-content/themes/secretAddy/images/update_status.jpg" alt="Update Status" title="Update Status" class="button" style="margin: 0 -5px -20px 0" /> 
						<a href="/online-admirers" title="Secret Chat">
					<img src="/wp-content/themes/secretAddy/images/secret_chat.jpg" alt="Secret Chat" title="Secret Chat" class="button" height="49px" width="130px" />
					</a>
				  <a href="/admirer-results" title="Admirers">
					<img src="/wp-content/themes/secretAddy/images/admirers.jpg" alt="Admirers" title="Admirers" class="button3" height="62px" width="130px" />
					</a>
					<a href="/account" title="Addy Credits" />
					<img src="/wp-content/themes/secretAddy/images/addy_credits.jpg" alt="Addy Credits" title="Addy Credits" class="button" height="49px" width="130px" />
					</a>
						</form>
						</p>
						
						<br />
						<?php if ( !empty($secret->gender) ) { ?>
						<p><b>Gender:</b> <?php echo $secret->gender; ?><span style="padding: 0 0 0 20px;"></span>
						<?php } ?>
						<?php if ( !empty($secret->age) && $private->age == '0' ) { ?>
						<b>Age:</b> <?php echo $secret->age; ?><span style="padding: 0 0 0 20px;"></span>
						<?php } ?> 
						<?php if ( !empty($secret->ethnicity) && $private->ethnicity == '0' ) { ?>
						<b>Ethnicity:</b> <?php echo $secret->ethnicity; ?></p>
						<?php } ?>
						<?php if ( !empty($secret->height) && $private->height == '0' ) { ?>				
						<p><b>Height:</b> <?php echo $secret->height; ?><span style="padding: 0 0 0 15px;"></span>
						<?php } ?> 
						<?php if ( !empty($secret->bodyType) && $private->bodyType == '0' ) { ?>
						<b>Body Type:</b> <?php echo $secret->bodyType; ?><span style="padding: 0 0 0 15px;"></span>		
						<?php } ?>
						<?php if ( !empty($secret->hair) && $private->hair == '0' ) { ?>
						<b>Hair Color:</b> <?php echo $secret->hair; ?></p>
						<?php } ?>
						<?php if ( !empty($interest->job) && $private->job == '0' ) { ?>
						<p><b>Occupation/Profession</b>: <?php echo stripslashes($interest->job); ?><span style="padding: 0 0 0 15px;"></span>
						<?php } ?>
						<?php if ( !empty($secret->admirers) && $private->admirers == '0' ) { ?>
						<b>Desired Admirer:</b> <?php echo $secret->admirers; ?></p>
						<?php } ?>
						<?php if ( !empty($secret->city) && !empty($secret->state) && !empty($secret->zip) && $private->city == '0' ) { ?>
						<p><b>Location:</b> <?php echo $secret->city.', '.$secret->state.' '.$secret->zip; ?></p>
						<?php } ?>
						<?php if ( !empty($secret->bio) && $private->bio == '0' ) { ?>
						<p><b>Bio Description:</b><br /> <?php echo stripslashes($secret->bio); ?></p>
						<?php } ?>
						<div style="float: left;">
						<p>
						<h2 align="left">Activities: <font size="3"><a href="/profile-page/interests/" title="Edit">Edit</a></font></h2>
						<b>Hobby 1</b>: <?php echo stripslashes($interest->hobby1); ?><br />
						<b>Hobby 2</b>: <?php echo stripslashes($interest->hobby2); ?><br />
						<b>Hobby 3</b>: <?php echo stripslashes($interest->hobby3); ?><br />
						<b>Hobby 4</b>: <?php echo stripslashes($interest->hobby4); ?><br />
						<b>Hobby 5</b>: <?php echo stripslashes($interest->hobby5); ?><br />
						</p>
						
						<p>
						<h2 align="left">Favorites: <font size="3"><a href="/profile-page/interests/" title="Edit">Edit</a></font></h2>
						<b>Favorite Book</b>: <?php echo stripslashes($interest->book); ?><br /> 
						<b>Favorite Food</b>: <?php echo stripslashes($interest->food); ?><br />   
						<b>Favorite Color</b>: <?php echo stripslashes($interest->color); ?><br /> 
						<b>Favorite Sport</b>: <?php echo stripslashes($interest->sport); ?><br /> 
						<b>Favorite Movie</b>: <?php echo stripslashes($interest->movie); ?><br />
						<b>Favorite TV Show</b>: <?php echo stripslashes($interest->tv); ?><br /> 
						<b>Favorite Song</b>: <?php echo stripslashes($interest->song); ?><br />  
						<b>Favorite Singer</b>: <?php echo stripslashes($interest->singer); ?><br /> 
						</p>
						
						<p>
						<h2 align="left">Education: <font size="3"><a href="/profile-page/interests/" title="Edit">Edit</a></font></h2>
						<b>High School</b>: <?php echo stripslashes($interest->skool); ?><br /> 
						<b>College</b>: <?php echo stripslashes($interest->college); ?><br />
						</p>
						</div>
						<div style="float: right; width: 240px; margin: 18px 0 30px 0;">
						  <img src="/wp-content/themes/secretAddy/images/connect_image.jpg" alt="Connect by Email" title="Connect by Email" height="80px" width="240px" />
						  <br />
						  <form method="post" action="/wp-content/themes/secretAddy/route.php">
                <b>Admirer's Email:</b><br /><input type="text" name="addyEmail" size="30" />
                <br /><br />
                <input type="hidden" name="website" value="connect" />
  							<input type="hidden" name="me" value="<?php echo $secret->secretAddy; ?>" />
  							
                <span class="choice">
  								What do you want to tell your admirer?
  							</span>
  							<textarea name="love" cols="40" rows="7"></textarea><br /><br />    
  		
                <span class="choice">
  								What do you want your admirer to know about you?
  							</span>
  							<br />
  							<table>
  							<tr>
  							<td width="100"><input type="checkbox" name="gender" value="1" /> Gender</td>
  							<td><input type="checkbox" name="body" value="1" /> Body Type</td>
  							</tr>
  							<tr>
  							<td width="100"><input type="checkbox" name="height" value="1" /> Height</td>
  							<td><input type="checkbox" name="hair" value="1" /> Hair Color</td>
  							</tr>
  							<tr>
  							<td width="100"><input type="checkbox" name="race" value="1" /> Ethnicity</td>
  							<td><input type="checkbox" name="desire" value="1" /> Desired Admirer</td>
  							</tr>
  							<tr>
  							<td width="100"><input type="checkbox" name="age" value="1" /> Age</td>
  							<td><input type="checkbox" name="locate" value="1" /> Location</td>
  							</tr>
  							</table>
  							<br />
  		          <span class="choice">
  								Would you like to send your admirer a rose?
  							</span>
  							<br />
  							<img src="/wp-content/themes/secretAddy/images/rose.jpg" style="height: 80px; width:80px;" alt="Roses" title="Roses" />  <br />
  							<input type="radio" name="rose" value="0" /> Yes
  							<input type="radio" name="rose" value="1" /> No   <br /><br />
  							<input type="submit" name="send_admirer" value="Connect with Admirer" /> 		
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
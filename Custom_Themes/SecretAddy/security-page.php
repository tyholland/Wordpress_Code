<?php
session_start();        

/**
 * Template Name: Security
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
 
$secret = $wpdb->get_row( $wpdb->prepare("SELECT 			pwd
																			FROM				account
																			WHERE			ID = '".$_SESSION['secretID']."' ") );
																			
$security = $wpdb->get_row( $wpdb->prepare("SELECT 		question,
																									answer
																			FROM				security
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
						
						<div>
  						<form method="post" action="/wp-content/themes/secretAddy/route.php">
  							<input type="hidden" name="id" value="<?php echo $_SESSION['secretID']; ?>" />
    						Security Question: 
    						<select name="question" style="width: auto;">
    						<option<?php if ( $security->question == "What is your mothers madien name?" ) { echo ' selected="selected"'; } ?> value="What is your mothers madien name?">What is your mother's madien name?</option>
    						<option<?php if ( $security->question == "What is the name of the high school you attended?" ) { echo ' selected="selected"'; } ?> value="What is the name of the high school you attended?">What is the name of the high school you attended?</option>
    						<option<?php if ( $security->question == "Who is your childhood best friend?" ) { echo ' selected="selected"'; } ?> value="Who is your childhood best friend?">Who is your childhood best friend?</option>
    						<option<?php if ( $security->question == "What is your favorite food?" ) { echo ' selected="selected"'; } ?> value="What is your favorite food?">What is your favorite food?</option>
    						</select><br /> 
    						Answer: <input type="text" name="secure" value="<?php echo $security->answer; ?>" /><br /><br />
    						
							<h1 class="entry-title">Password</h1>
    						<input type="button" onclick="Open('pwords')" name="" value="Change Password" />
    						<div class="pwords">            
                  			<input type="hidden" name="orig" value="<?php echo $secret->pwd; ?>" />
    						  Old Password: <input type="password" name="old" /><br />
    						  New Password: <input type="password" name="new" /><br />
    						  Confirm Password: <input type="password" name="confirmNew" />
    						</div>
    						<p class="priv">
    						<input type="submit" name="save_secure" value="Save Changes" />
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
}?>
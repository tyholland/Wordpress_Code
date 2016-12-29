<?php
session_start();            

/**
 * Template Name: Photos
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

$public = mysql_query("SELECT ID, image FROM publicPhoto WHERE secretAddy = '".$me->secretAddy."' ");

$path = '/wp-content/themes/secretAddy/profilePhotos/'.$me->secretAddy.'/public/';

$num_rows = mysql_num_rows($public);      

if ( isset($_SESSION['secretID']) )
{
?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
					
						<ul class="top">
						<?php 
						if ($num_rows > 0)
						{
							while ( $photos = mysql_fetch_assoc( $public ) )
							{
								echo '
										<li class="sub">
										<div id="photoImage">
											<img src="'.$path.$photos['image'].'" id="photoSize" alt="'.$photos['image'].'" title="'.$photos['image'].'" />
										</div>
											<center>
                      <form method="post" action="/wp-content/themes/secretAddy/route.php">   
                        <input type="hidden" name="id" value="'.$photos['ID'].'" />  
                        <input type="hidden" name="me" value="'.$me->secretAddy.'" /> 
                        <input type="hidden" name="photoType" value="photos" />  
                        <input type="hidden" name="photo" value="'.$photos['image'].'" />  
                          <input type="hidden" name="website" value="'.$_SERVER['REQUEST_URI'].'" />
                        <input type="submit" name="del_confirm" value="Delete Image" />
                      </form> 
                      </center>
										</li>';
							}
						}
						else
						{
              echo 'You don\'t have any Private Photos.<br />
                    Go to your <a href="/photos/upload/" title="Upload Image Page">Upload Image Page</a> and upload a Private Image';
            }
							?>
						</ul>
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
			
				<h1 class="entry-title">Privtate Photos</h1>

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
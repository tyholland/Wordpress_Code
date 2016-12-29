<?php
session_start();                                                                                                                                                          

/**
 * Template Name: Interests
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
 
$secret = $wpdb->get_row( $wpdb->prepare("SELECT 			book,
    																									food, 
    																									color,
    																									sport,
    																									movie,
    																									tv,
    																									song,
    																									singer,
    																									skool,
    																									college,
    																									hobby1,
    																									hobby2,
    																									hobby3,
    																									hobby4,
    																									hobby5
    																			FROM				interests
    																			WHERE			  ID = '".$_SESSION['secretID']."' ") );

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
						
						<div id="account">  
  						<form method="post" action="/wp-content/themes/secretAddy/route.php">
  							<input type="hidden" name="id" value="<?php echo $_SESSION['secretID']; ?>" />
  							<p>
  							<h2 align="left">Activities:</h2>
								Hobby 1: <input type="text" name="hobby1" value="<?php echo stripslashes($secret->hobby1); ?>" /><br />
								Hobby 2: <input type="text" name="hobby2" value="<?php echo stripslashes($secret->hobby2); ?>" /><br />
								Hobby 3: <input type="text" name="hobby3" value="<?php echo stripslashes($secret->hobby3); ?>" /><br />
								Hobby 4: <input type="text" name="hobby4" value="<?php echo stripslashes($secret->hobby4); ?>" /><br />
								Hobby 5: <input type="text" name="hobby5" value="<?php echo stripslashes($secret->hobby5); ?>" /><br />
    						</p>
    						
    						<p>
    						<h2 align="left">Favorites:</h2>
								Favorite Book: <input type="text" name="book" value="<?php echo stripslashes($secret->book); ?>" /><br /> 
								Favorite Food: <input type="text" name="food" value="<?php echo stripslashes($secret->food); ?>" /><br />   
								Favorite Color: <input type="text" name="color" value="<?php echo stripslashes($secret->color); ?>" /><br /> 
								Favorite Sport: <input type="text" name="sport" value="<?php echo stripslashes($secret->sport); ?>" /><br /> 
								Favorite Movie: <input type="text" name="movie" value="<?php echo stripslashes($secret->movie); ?>" /><br />
								Favorite TV Show: <input type="text" name="tv" value="<?php echo stripslashes($secret->tv); ?>" /><br /> 
								Favorite Song: <input type="text" name="song" value="<?php echo stripslashes($secret->song); ?>" /><br />  
								Favorite Singer: <input type="text" name="singer" value="<?php echo stripslashes($secret->singer); ?>" /><br /> 
    						</p>
    						
    						<p>
								<h2 align="left">Education:</h2>
								High School: <input type="text" name="highSkool" value="<?php echo stripslashes($secret->skool); ?>" /><br /> 
								College: <input type="text" name="college" value="<?php echo stripslashes($secret->college); ?>" /><br />
    						</p>
  						</div>
    						<p class="saveAcc">
    						<input type="submit" name="save_interests" value="Save Changes" />
    						</p>
    					</form>
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
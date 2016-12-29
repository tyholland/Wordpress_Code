<?php
session_start();                                                                                                                                                         

/**
 * Template Name: Drinks
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

$start = $_GET['num'];
	
$initial = $start - 9;

if ( empty($start) )
{   
  $start = 0;
}
 
$cat = $_GET['cate'];

$listImg = mysql_query("SELECT ID, image FROM gifts WHERE category = '".$cat."' ");
  
$public = mysql_query("SELECT ID, image FROM gifts WHERE category = '".$cat."' ORDER BY ID DESC LIMIT ".$start.",9 ");

$path = '/wp-content/themes/secretAddy/images/store/';

$num_rows = mysql_num_rows($listImg);      

if ( isset($_SESSION['secretID']) )
{
?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
					
						<ul class="roseTop">
						<?php 
						if ($num_rows > 0)
						{
							while ( $photos = mysql_fetch_assoc( $public ) )
							{
								echo '
										<li class="roseSub">
										  <center>
										<div id="photoImage">
                      <img src="'.$path.$photos['image'].'" id="photoSize" alt="'.$photos['image'].'" title="'.$photos['image'].'" /></div><br>
                        <input type="button" onclick="showPopup(\''.get_option('siteurl').'/wp-content/themes/secretAddy/send-gift.php?name='.$photos['image'].'\')" value="Send Gift" />
                      </center>
										</li>';
                          $start++; 
  								  }  
                    echo '</ul>
                          <div id="pages2">';
										
                    if ( $start < 9 || 9 == $num_rows )
										{
                      echo '';
                    }
                    elseif ( $start >= $num_rows )
										{
                      echo '
                      <p>
                      <a href="/drinks?cate='.$cat.'&num='.$initial.'" title="Previous">Previous</a>
                      </p>';
                    }
                    elseif ( $start == 9 && 9 < $num_rows )
                    {
                      echo '
                      <p>
                      <a href="/drinks?cate='.$cat.'&num='.$start.'" title="Next">Next</a>
                      </p>';
                    } 
                    else
                    { 
                      echo '
                      <p>
                      <a href="/drinks?cate='.$cat.'&num='.$initial.'" title="Previous">Previous</a>  
                      <a href="/drinks?cate='.$cat.'&num='.$start.'" id="nextButton" title="Next">Next</a>
                      </p>';
                    }        
                    echo '</div>';
                  }
							?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar('gift'); ?>
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
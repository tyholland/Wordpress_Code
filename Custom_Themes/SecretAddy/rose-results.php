<?php		
session_start();       

/**
 * Template Name: Rose Results
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
	
	$initial = $start - 6;
	
	if ( empty($start) )
	{   
    $start = 0;
  } 
										
	$me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );
	
	$theRose = mysql_query("SELECT sentTo, sentFrom FROM roses WHERE sentTo = '".$me->secretAddy."' AND type = 'rose' ");
  
  $roses = mysql_query("SELECT ID, sentTo, sentFrom FROM roses WHERE sentTo = '".$me->secretAddy."' AND type = 'rose' ORDER BY ID DESC LIMIT ".$start.",6 ");
	
	$rosePath = '/wp-content/themes/secretAddy/images/';
	
	$num_rows = mysql_num_rows($theRose);     
if ( isset($_SESSION['secretID']) )
{
	?>
	
		<div id="container">
			<div id="content" role="main">
			
				<h1 class="entry-title"><img src="/wp-content/themes/secretAddy/images/your_roses.jpg" width="300" height="100" alt="Your Roses" title="Your Roses" /></h1>

					<div class="entry-content">
							<div id="results">
								<?php
									if ( $num_rows > 0 )
									{
										echo '<ul class="roseTop">';
                    while ( $addys = mysql_fetch_assoc( $roses ) )
                    {                          
  											$secret = $wpdb->get_row( $wpdb->prepare( "SELECT ID, secretAddy FROM account WHERE secretAddy = '".$addys['sentFrom']."' ") );
  											
  											$secretAdmir = $wpdb->get_row( $wpdb->prepare( "SELECT reference FROM randomID WHERE ID = ".$secret->ID) );
  											
  											 $status = $wpdb->get_row( $wpdb->prepare("SELECT status FROM statuses WHERE secretAddy = '".$secret->secretAddy."' ") );
  											 
  											  $friend = $wpdb->get_row( $wpdb->prepare("SELECT   	secretAddy, 
  																								admirer, 
  																								friend 
  																			FROM    		admirer 
  																			WHERE   	(secretAddy = '".$me->secretAddy."' 
  																								AND admirer = '".$addys['sentFrom']."') 
  																			OR      			(secretAddy = '".$addys['sentFrom']."' 
  																								AND admirer = '".$me->secretAddy."') ") );
  											echo '<li class="roseSub">	
  															<img src="'.$rosePath.'rose.jpg" id="photoSize2" alt="Roses" title="Roses" />
  														<br />
  															Rose sent from <a href="/admirer/?ref='.$secretAdmir->reference.'" title="'.$secret->secretAddy.'">'.$secret->secretAddy.'</a><br>'; 
  														echo ' <div id="delRose">
																		<form method="post" action="/wp-content/themes/secretAddy/route.php">
																			<input type="hidden" name="id" value="'.$addys['ID'].'" /> 
																			<input type="hidden" name="page" value="'.$_SERVER['REQUEST_URI'].'" /> 
																			<input type="hidden" name="type" value="Rose" /> 
																			<input type="submit" name="remove_rose" value="Delete Rose" class="button" />
																		</form> 
																	</div>'; 
  															if ( !empty($friend->friend) && $friend->friend == 'Y' )
  															  {
  																	echo '';
  															  }
  															  else
  															  {
  																	echo '<div id="addRose">
  																			<form method="get" action="/wp-content/themes/secretAddy/route.php">
  																				<input type="hidden" name="me" value="'.$me->secretAddy.'" />
  																				<input type="hidden" name="desire" value="'.$addys['sentFrom'].'" />  
                                          <input type="hidden" name="ref" value="'.$secretAdmir->reference.'" />  
  																				<input type="hidden" name="destination" value="'.$_SERVER['REQUEST_URI'].'" />
  																				<input type="submit" name="add_desire" value="Add Admirer" class="button" />
  																			</form> 
  																			</div>';
  															  }
  												echo '</li>';
                          $start++; 
  								  }  
                    echo '</ul>
                          <div id="pages">';
										
                    if ( $start < 6 || 6 == $num_rows )
										{
                      echo '';
                    }
                    elseif ( $start >= $num_rows )
										{
                      echo '
                      <p>
                      <a href="/rose-results?num='.$initial.'" title="Previous">Previous</a>
                      </p>';
                    }
                    elseif ( $start == 6 && 6 < $num_rows )
                    {
                      echo '
                      <p>
                      <a href="/rose-results?num='.$start.'" title="Next">Next</a>
                      </p>';
                    } 
                    else
                    { 
                      echo '
                      <p>
                      <a href="/rose-results?num='.$initial.'" title="Previous">Previous</a>  
                      <a href="/rose-results?num='.$start.'" id="nextButton" title="Next">Next</a>
                      </p>';
                    }        
                    echo '</div>';
									}  
									else
									{
										echo 'You do not have any Roses at this time.<br />
                          Send a Rose to one of your <a href="/admirer-results" title="Admirers">Admirers</a>';
									}
							?>
							</div>
					</div><!-- .entry-content -->

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

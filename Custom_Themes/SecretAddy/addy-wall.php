<?php	
session_start();        

/**
 * Template Name: Addy Wall Post
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
	
	$initial = $start - 10;
	
	if ( empty($start) )
	{   
    $start = 0;
  } 
  
  $me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );
	
$theWall = mysql_query("SELECT ID FROM addyPosts WHERE sentTo = '".$me->secretAddy."' ");
  
  $wall = mysql_query("SELECT ID, sentTo, sentFrom, post FROM addyPosts WHERE sentTo = '".$me->secretAddy."' ORDER BY ID DESC LIMIT ".$start.",10 ");
	
	$num_rows = mysql_num_rows($theWall); 

if ( isset($_SESSION['secretID']) )
{
	?>
	
		<div id="container">
			<div id="content" role="main">
			
				<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-content">
							<div id="results">
								<?php
									if ( $num_rows > 0 )
									{						
								    $i = 1;				
                    while ( $post = mysql_fetch_assoc( $wall ) )
                    {                          
  											$secret = $wpdb->get_row( $wpdb->prepare( "SELECT ID, secretAddy FROM account WHERE secretAddy = '".$post['sentFrom']."' ") );
  											
  											$secretAdmir = $wpdb->get_row( $wpdb->prepare( "SELECT reference FROM randomID WHERE ID = ".$secret->ID) );
  											
  											$status = $wpdb->get_row( $wpdb->prepare("SELECT status FROM statuses WHERE secretAddy = '".$secret->secretAddy."' ") );
  											 
  											$location = '<a href="#" onmouseover="Open(\'details'.$i.'\')" title="'.$secret->secretAddy.'">';
  											 
  										  $friend = $wpdb->get_row( $wpdb->prepare("SELECT   	secretAddy, 
  																								admirer, 
  																								friend 
  																			FROM    		admirer 
  																			WHERE   	(secretAddy = '".$me->secretAddy."' 
  																								AND admirer = '".$post['sentFrom']."') 
  																			OR      			(secretAddy = '".$post['sentFrom']."' 
  																								AND admirer = '".$me->secretAddy."') ") );
     
  											echo $location.$secret->secretAddy.'</a> says:
                    						<div class="details'.$i.'" style="display: none;">            
                                <a href="/admirer/?ref='.$secretAdmir->reference.'" style="text-decoration: none;" title="View Profile">View Profile</a>
                    						<a href="/wall-results?ref='.$secretAdmir->reference.'" id="wallSpace" title="Reply">Reply</a>
                    						<a href="'.$_SERVER['REQUEST_URI'].'?remove=yes&id='.$post['ID'].'" id="wallSpace" title="Delete Message">Delete Message</a> 
                    						</div>
											<p>'.stripslashes($post['post']).'</p>';
                        $start++;
                        $i++;
  								  }   
										
                    if ( $start < 10 )
										{
                      echo '';
                    }
                    elseif ( $start >= $num_rows )
										{
                      $start = $start - $num_rows;
                      echo '<a href="/addy-wall?num='.$initial.'" title="Previous">Previous</a>';
                    }
                    elseif ( $start == 10 && 10 < $num_rows )
                    {     
                      echo '<a href="/addy-wall?num='.$start.'" title="Next">Next</a>';
                    }
                    else
                    {
                      echo '<a href="/addy-wall?num='.$initial.'" title="Previous">Previous</a>  
                            <a href="/addy-wall?num='.$start.'" id="nextButton" title="Next">Next</a>';
                    }
									}
									else
									{
										echo 'You don\'t not have any Addy Posts at this time.<br />
                    Go post on an <a href="/admirer-results" title="Admirers">Admirers</a> Wall to get a Response back';
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

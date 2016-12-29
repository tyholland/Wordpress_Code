<?php	
session_start();                

/**
 * Template Name: Wall Results
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
	
	$ref = $_GET['ref'];
	
	if ( empty($start) )
	{   
    $start = 0;
  } 
	
	$addy = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM randomID WHERE reference = '".$ref."' ") );
  
  $theAddy = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy, online FROM account WHERE ID = ".$addy->ID) );
  
  $me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );
	
	$theWall = mysql_query("SELECT ID FROM addyPosts WHERE sentTo = '".$theAddy->secretAddy."' ");
  
  $wall = mysql_query("SELECT sentTo, sentFrom, post FROM addyPosts WHERE sentTo = '".$theAddy->secretAddy."' ORDER BY ID DESC LIMIT ".$start.",10 ");
    											 
  $friend = $wpdb->get_row( $wpdb->prepare("SELECT   	secretAddy, 
														admirer, 
														friend 
									FROM    		admirer 
									WHERE   	(secretAddy = '".$theAddy->secretAddy."' 
									AND        admirer = '".$me->secretAddy."') 
									OR      	(secretAddy = '".$me->secretAddy."' 
									AND        admirer = '".$theAddy->secretAddy."') ") );
	
	$num_rows = mysql_num_rows($theWall);
  
  $chat = $wpdb->get_row( $wpdb->prepare("SELECT   	chatBegin,
																											chatID
																							FROM    	chatBuddies 
																							WHERE   	(user1 = '".$theAddy->secretAddy."' 
																												AND user2 = '".$me->secretAddy."') 
																							OR      			(user1 = '".$me->secretAddy."' 
																												AND user2 = '".$theAddy->secretAddy."') ") );
																												
  $checkCredit = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$me->secretAddy."' ") ); 
  
  $theId = rand(1, 30000);	
  
  if ( $checkCredit->amount == 0 || $checkCredit->amount < 10)
  {
    $newChat = '<a href="#" onclick="alert(\'You do not have enough credits to Chat\');" title="Click here to Chat" class="button">';
    $startChat = '<a href="#" onclick="alert(\'You do not have enough credits to Chat\');" title="Click here to Chat" class="button">';
  }
  else
  {  
    $newChat = '<a href="#" onclick="showChat(\''.get_option('siteurl').'/wp-content/themes/secretAddy/chat.php?id='.$chat->chatID.'&show=1\', \''.$chat->chatID.'\')" title="Click here to Chat" class="button">';
    $startChat = '<a href="#" onclick="showChat(\''.get_option('siteurl').'/wp-content/themes/secretAddy/chat.php?ref='.$ref.'&id='.$theId.'\', \''.$theId.'\')" title="Click here to Chat" class="button">'; 
  } 
      
if ( isset($_SESSION['secretID']) )
{
	?>
	
		<div id="container">
			<div id="content" role="main">
			
				<h1 class="entry-title"><?php echo $theAddy->secretAddy.'\'s '; the_title();
            if ( $theAddy->online == 'Y' )
            {
      				if ( $chat->chatBegin == 'Y' )
      				{
              echo '<p id="move">'.$newChat.'<img src="/wp-content/themes/secretAddy/images/online.jpg" alt="Click here to Chat" title="Click here to Chat" height="50px" width="100px" /></a></p>'; 
              }
      				else
      				{ 
              echo '<p id="move">'.$startChat.'<img src="/wp-content/themes/secretAddy/images/online.jpg" alt="Click here to Chat" title="Click here to Chat" height="50px" width="100px" /></a></p>';
      				}
            }
            else
            {
              echo '<p id="move"><img src="/wp-content/themes/secretAddy/images/offline.jpg" alt="Offline" title="Offline" height="50px" width="100px" /></p>';
            }?>
            </h1>

					<div class="entry-content">
							<div id="results">
						<p>
						<form method="post" action="/wp-content/themes/secretAddy/route.php">
						<input type="hidden" name="from" value="<?php echo $me->secretAddy; ?>" />  
						<input type="hidden" name="to" value="<?php echo $theAddy->secretAddy; ?>" />  
						<input type="hidden" name="address" value="<?php echo $ref; ?>" />
						<textarea name="wall" rows="5" cols="60"></textarea><br />
						<input type="submit" name="edit_wall" value="Add Addy Post" />
						</form>
						</p>
								<?php
									if ( $num_rows > 0 )
									{						
								    $location = '';				
                    while ( $post = mysql_fetch_assoc( $wall ) )
                    {                          
  											$secret = $wpdb->get_row( $wpdb->prepare( "SELECT ID, secretAddy FROM account WHERE secretAddy = '".$post['sentFrom']."' ") );
  											
  											$secretAdmir = $wpdb->get_row( $wpdb->prepare( "SELECT reference FROM randomID WHERE ID = ".$secret->ID) );
  											
  											$status = $wpdb->get_row( $wpdb->prepare("SELECT status FROM statuses WHERE secretAddy = '".$secret->secretAddy."' ") );
  											 
  											if ( $post['sentFrom'] == $me->secretAddy )
    										{
    											$location = '<a href="/profile/">';
    										}
    										else
    										{
    											$location = '<a href="/admirer/?ref='.$secretAdmir->reference.'" title="'.$secret->secretAddy.'">';
    										} 
												
                        if ( $friend->friend == 'Y' )
												  {       
      											echo $location.$secret->secretAddy.'</a> says:
														<p> '.stripslashes($post['post']).'</p>';
												  }
												  else
												  {          
														echo '';
												  }
                        $start++;
  								  }
  								  
                    if ( $friend->friend != 'Y' )
									  {       
											echo 'You and '.$theAddy->secretAddy.' aren\'t friends. Become friends to view '.$theAddy->secretAddy.'\'s Addy Wall.<br /> 
                            <form method="get" action="/wp-content/themes/secretAddy/route.php">
          									<input type="hidden" name="me" value="'.$me->secretAddy.'" />
          									<input type="hidden" name="desire" value="'.$theAddy->secretAddy.'" />
                            <input type="hidden" name="ref" value="'.$secretAdmir->reference.'" /> 
          									<input type="hidden" name="destination" value="'.$_SERVER['REQUEST_URI'].'" />
                            <input type="submit" name="add_desire" value="Add Admirer" class="button" />
                            </form>';
									  }
										
                    if ( $start < 10 )
										{
                      echo '';
                    }
                    elseif ( $start >= $num_rows )
										{
                      $start = $start - $num_rows;
                      echo '<a href="/wall-results?num='.$initial.'" title="Previous">Previous</a>';
                    }
                    elseif ( $start == 10 && 10 < $num_rows )
                    {     
                      echo '<a href="/wall-results?ref='.$ref.'&num='.$start.'" title="Next">Next</a>';
                    }
                    else
                    {
                      echo '<a href="/wall-results?ref='.$ref.'&num='.$initial.'" title="Previous">Previous</a>  
                            <a href="/wall-results?ref='.$ref.'&num='.$start.'" id="nextButton" title="Next">Next</a>';
                    }
									}
									else
									{
										echo $theAddy->secretAddy.' doesn\'t not have any Addy Posts at this time.<br />
                          Be the first to post on '.$theAddy->secretAddy.'\'s wall.';
									}
								?>
							</div>
					</div><!-- .entry-content -->

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar('admirer'); ?>
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

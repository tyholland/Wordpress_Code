<?php	

$path = '/home/saddy/public_html/wp-load.php';

require_once($path); 

/*--------------------------------------------------------------
This searches the database for SecretAddy's Photos
------------------------------------------------------------------*/

session_start();

if ( isset($_GET['photo_show']) )
{
	$type = $_GET['type'];
	$admirer = $_GET['admirer'];
	
    	$start = $_GET['num'];
    	
    	$initial = $start - 12;
	
    	if ( empty($start) )
    	{   
        $start = 0;
      } 
	
	$ref = $_GET['ref'];
	
	$reference = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM randomID WHERE reference = '".$ref."' ") );
	
	$secret = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy, online FROM account WHERE ID = '".$reference->ID."' ") );

	$addy = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );	
	
	$friend = $wpdb->get_row( $wpdb->prepare("SELECT   	secretAddy, 
																								admirer, 
																								friend,
																								fullProfile,
																								sentTo,
																								halfProfile
																			FROM    		admirer 
																			WHERE   	(secretAddy = '".$secret->secretAddy."' 
																								AND admirer = '".$addy->secretAddy."') 
																			OR      			(secretAddy = '".$addy->secretAddy."' 
																								AND admirer = '".$secret->secretAddy."') ") );		


	$thePhotos = mysql_query("SELECT image FROM ".$type."Photo WHERE secretAddy = '".$admirer."' ");
	
	$photo = mysql_query("SELECT image FROM ".$type."Photo WHERE secretAddy = '".$admirer."' LIMIT ".$start.",12 ");
	
	$photoPath = '/wp-content/themes/secretAddy/profilePhotos/'.$admirer.'/'.$type.'/';
	
	$num_rows = mysql_num_rows($thePhotos);
	
	$theId = rand(1, 30000);		
	
	$chat = $wpdb->get_row( $wpdb->prepare("SELECT   	chatBegin,
																									chatID
																					FROM    	chatBuddies 
																					WHERE   	(user1 = '".$admirer."' 
																										AND user2 = '".$addy->secretAddy."') 
																					OR      			(user1 = '".$addy->secretAddy."' 
																										AND user2 = '".$admirer."') ") );
																																					
	$checkCredit = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$addy->secretAddy."' ") ); 
  
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

		if ( (isset($_SESSION['secretID']) && !empty($friend->friend) && $friend->halfProfile == 'Y' && $friend->sentTo == $secret->secretAddy && $profile->image != '') || (isset($_SESSION['secretID']) && $friend->fullProfile == 'Y') || ($friend->halfProfile == 'Y' && $friend->sentTo == $addy->secretAddy) )
		{
			get_header();     
      
			?>
			
				<div id="container">
					<div id="content" role="main">
					
						<h1 class="entry-title"><?php echo $admirer.'\'s Photos';
            if ( $secret->online == 'Y' )
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
										<?php
											if ( $num_rows > 0 )
											{
												echo '<ul class="top">';
												
													while ( $photos = mysql_fetch_assoc( $photo ) )
													{
														echo '
																<li class="sub">
																	<img src="'.$photoPath.$photos['image'].'" id="photoSize" alt="'.$photos['image'].'" title="'.$photos['image'].'" /> 
																</li>';
                            $start++; 
													}
												
												if ( $start < 12 || 12 == $num_rows )
    										{
                          echo '';
                        }
                        elseif ( $start >= $num_rows )
    										{
                          echo '
                          <p>
                          <a href="/wp-content/themes/secretAddy/photo-results.php?num='.$initial.'" title="Previous">Previous</a>
                          </p>';
                        }
                        elseif ( $start == 12 && 12 < $num_rows )
                        {
                          echo '
                          <p>
                          <a href="/wp-content/themes/secretAddy/photo-results.php?num='.$start.'" title="Next">Next</a>
                          </p>';
                        } 
                        else
                        { 
                          echo '
                          <p>
                          <a href="/wp-content/themes/secretAddy/photo-results.php?num='.$initial.'" title="Previous">Previous</a>  
                          <a href="/wp-content/themes/secretAddy/photo-results.php?num='.$start.'" id="nextButton" title="Next">Next</a>
                          </p>';
                        }
													
												echo '</ul>';
											}
											else
											{
												echo $admirer.' has no photos at this time.<br />
														<a href="/admirer/?ref='.$ref.'" title="Click here">Click here</a> to return to '.$admirer.' profile page';
											}
										?>
							</div><!-- .entry-content -->
		
					</div><!-- #content -->
				</div><!-- #container -->
		
		<?php get_sidebar('admirer'); ?>
		<?php get_footer(); 
		}
		else
		{
			get_header();
			?>
			  <div id="container">
						<div id="content" role="main">
						
							<h1 class="entry-title"><?php echo $admirer.'\'s Photos';
            if ( $secret->online == 'Y' )
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
						You do not have Access to <?php echo $admirer.'\'s Full Profile'; ?><br>
						Gain Full Access by sending <?php echo $admirer; ?> a Bouquet of Roses.
								
								</div><!-- .entry-content -->
			
						</div><!-- #content -->
					</div><!-- #container -->
			<?php
			get_sidebar('admirer');
			get_footer(); 
			} 
}
else
{
	wp_redirect('/');
}
?>

<?php	
session_start();                   

/**
 * Template Name: Online
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
  
  $admirer = mysql_query("SELECT secretAddy, 
														admirer
										FROM 	admirer
										WHERE 	secretAddy = '".$me->secretAddy."' 
										OR	 		admirer = '".$me->secretAddy."' ");	

$theId = rand(1, 30000);		

if ( isset($_SESSION['secretID']) )
{     
	?>
	
		<div id="container">
			<div id="content" role="main">
			
				<h1 class="entry-title">Admirers Online:</h1>

					<div class="entry-content">                                                                                                                                       
<?php  
           echo 'To start a Chat Session, simply click on an Admirer\'s name!';
           echo '<ul>';    
			
			$friend = mysql_query("SELECT user1, user2, chatID, delete1, delete2 FROM chatBuddies WHERE user1 = '".$me->secretAddy."' OR user2 = '".$me->secretAddy."' ");
			
			while ( $addy = mysql_fetch_assoc($friend) )                                                                                                     
			{
				  if ( $addy['delete1'] == 'Y' && $addy['delete2'] == 'Y' )                                                                                                     
				  {                                                                                                                                                            
						$wpdb->query( 'DELETE FROM chatBuddies WHERE chatID = '.$addy['chatID']);   									
						
						$removeChat = mysql_query( "SELECT chatID FROM chatMessage WHERE chatID = ".$addy['chatID']);
						
						while ( $bye = mysql_fetch_assoc($removeChat) )
						{
						  $wpdb->query( 'DELETE FROM chatMessage WHERE chatID = '.$bye['chatID']);
						}                                                                                                           
				   }
				  
				  if ( $addy['user1'] == $me->secretAddy && $addy['delete2'] == 'N' )
				  {           
						$secret = $wpdb->get_row( $wpdb->prepare( "SELECT online FROM account WHERE secretAddy = '".$addy['user2']."' ") );
						
						$await = $wpdb->get_row( $wpdb->prepare("SELECT username, awaiting FROM chatMessage WHERE chatID = ".$addy['chatID']." ORDER BY ID DESC LIMIT 1") );
					  
					  
						if ($await->awaiting == $addy['user1'] )
						{
					  		$pending = ' (Message Pending)';
						}
						
						if ( $secret->online == 'Y' )
						{
						  	echo '<li><a href="#" onclick="showChat(\''.get_option('siteurl').'/wp-content/themes/secretAddy/chat.php?id='.$addy['chatID'].'&show=1\', \''.$addy['chatID'].'\')">'.$addy['user2'].'</a>'.$pending.'</li>';	
							$rows = "Y";
						}
						
				  }
				  elseif ( $addy['user2'] == $me->secretAddy && $addy['delete1'] == 'N' )
				  {         											       
						$secret = $wpdb->get_row( $wpdb->prepare( "SELECT online FROM account WHERE secretAddy = '".$addy['user1']."' ") );
						
						$await = $wpdb->get_row( $wpdb->prepare("SELECT username, awaiting FROM chatMessage WHERE chatID = ".$addy['chatID']." ORDER BY ID DESC LIMIT 1") );
					  
					  
						if ($await->awaiting == $addy['user2'] )
						{
					  		$pending = ' (Message Pending)';
						}
						
						if ( $secret->online == 'Y' )
						{
						  echo '<li><a href="#" onclick="showChat(\''.get_option('siteurl').'/wp-content/themes/secretAddy/chat.php?id='.$addy['chatID'].'&show=1\', \''.$addy['chatID'].'\')">'.$addy['user1'].'</a>'.$pending.'</li>';
						$rows = "Y";
						}
				  }
			} 
			
			while ( $theChat = mysql_fetch_assoc($admirer) )
			{
				  $name = $wpdb->get_row( $wpdb->prepare( "SELECT ID, secretAddy, online FROM account WHERE secretAddy != '".$me->secretAddy."' AND (secretAddy = '".$theChat['secretAddy']."' OR secretAddy = '".$theChat['admirer']."') ") ); 
				  
				  $ref = $wpdb->get_row( $wpdb->prepare("SELECT reference FROM randomID WHERE ID = ".$name->ID ) );
				  
				  $people = $wpdb->get_row( $wpdb->prepare("SELECT user1, user2 FROM chatBuddies WHERE user1 = '".$name->secretAddy."' OR user2 = '".$name->secretAddy."' ") );
				  
				  if ( ($name->secretAddy == $people->user1 && $me->secretAddy == $people->user2) || ($name->secretAddy == $people->user2 && $me->secretAddy == $people->user1) )
				  {
					echo '';	
				  }
				  elseif ( $name->online == 'Y' )
				  {
				  
    				  $checkCredit = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$me->secretAddy."' ") ); 
            
              if ( $checkCredit->amount == 0 || $checkCredit->amount < 10)
              {
                $newChat = '<a href="#" onclick="alert(\'You do not have enough credits to start a new Chat\');" title="'.$name->secretAddy.'">';
              }
              else
              {  
                $newChat = '<a href="#" onclick="showChat(\''.get_option('siteurl').'/wp-content/themes/secretAddy/chat.php?ref='.$ref->reference.'&id='.$theId.'\', \''.$theId.'\')" title="'.$name->secretAddy.'">';
              }
            
    					echo '<li>'.$newChat.$name->secretAddy.'</a></li>';	
    					$rows = "Y";
				  }
			}	
			
			echo '</ul>'; 
			
			if ( $rows != "Y" )
			{
				echo 'You don\'t have any Admirers Online';
			}
?>		
          <br /> 
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
			
				<h1 class="entry-title">Admirers Online:</h1>

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

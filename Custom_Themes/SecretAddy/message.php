<?php
session_start();

$path = '/home/saddy/public_html/wp-load.php';
require_once($path);

$_SESSION['secretID'];

date_default_timezone_set('America/New_York');

if ( empty($theArray) )
{
  $theArray = array();
}	  

$id = $_GET['id'];
			                                   
$buddy = $wpdb->get_row($wpdb->prepare("SELECT ID, chatID, user1, user2, delete1, delete2 FROM chatBuddies WHERE chatID = '".$id."' ") ); 

if (isset($_GET['user1']) && isset($_GET['message'])) 
{    
	  if(trim($_GET['user1']) != "" && trim($_GET['message']) != "") 
	  {
			$message = strip_tags(mysql_real_escape_string(trim($_GET['message'])));  
			$user1 = strip_tags(mysql_real_escape_string(trim($_GET['user1']))); 
			$user2 = strip_tags(mysql_real_escape_string(trim($_GET['user2'])));
			$_SESSION['username'] = $user1;
			
      if ( $message == 'qwaszx' )
			{
				  array_push( $theArray, $id );
          $_SESSION['chat'] = $theArray;
		  	}
		  	else
		  	{  
				  if( $buddy->chatID == '' )
				  {      
						$wpdb->insert( 'chatBuddies', array( 'user1' => $user1, 'user2' => $user2, 'chatID' => $id, 'chatBegin' => 'Y', 'delete1' => 'N', 'delete2' => 'N' ) ); 
  
					    $reduce = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$user1."' ") );
					  
					    $newPrice = $reduce->amount - 10;
					  
					    $wpdb->update( 'credits', array( 'amount' => $newPrice ), array( 'secretAddy' => $user1 ));
						
						$wpdb->insert( 'chatMessage', array( 'username' => $user1, 'message' => stripslashes($message), 'chatID' => $id, 'awaiting' => $user2 ) );
						
						$buddy = $wpdb->get_row($wpdb->prepare("SELECT ID, chatID, delete1, delete2 FROM chatBuddies WHERE chatID = '".$id."' ") );
						
					 	array_push( $theArray, $buddy->chatID );
            $_SESSION['chat'] = $theArray;
					}
					else
					{
					 	array_push( $theArray, $buddy->chatID );
            $_SESSION['chat'] = $theArray;
            			if ( $user1 == $buddy->user1 )
            			{
							$wpdb->insert( 'chatMessage', array( 'username' => $user1, 'message' => stripslashes($message), 'chatID' => $buddy->chatID, 'awaiting' => $buddy->user2 ) );
						}
						else
						{
							$wpdb->insert( 'chatMessage', array( 'username' => $user1, 'message' => stripslashes($message), 'chatID' => $buddy->chatID, 'awaiting' => $buddy->user1 ) );
						}
				  }
			}
	  }
}

$key = array_search( $id, $theArray );

if( $_SESSION['chat'][$key] == $buddy->chatID )
{
	 $s = "SELECT username, message FROM chatMessage WHERE chatID = '".$_SESSION['chat'][$key]."' ORDER BY ID DESC";
	 $q = mysql_query($s) or die(mysql_error());  
	
	while($r = mysql_fetch_array($q)) 
	{ 
		if($r['username'] == $_SESSION['username'])
		{
			$user_bg = '#2C50A2'; 
		}
		else 
		{
			$user_bg = '#FF3333'; 
		}
	?>
		<div style="color:<?php echo $user_bg; ?>">
		<?php echo "<strong>" . $r['username'] . " says:</strong> "; ?>
		</div>
		<div style="padding-left:5px; padding-bottom:15px;">
		<?php echo stripslashes($r['message']); ?>
		</div>
	<?php 
	}
}
else
{

}?>
<?php
session_start();

$me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );

$secret = mysql_query("SELECT ID FROM inbox WHERE sentTo = '".$me->secretAddy."' AND readMessage = 'N' ");

$buddy = mysql_query("SELECT username, awaiting FROM chatMessage WHERE username = '".$me->secretAddy."' OR awaiting = '".$me->secretAddy."' ORDER BY ID DESC LIMIT 1");

$chat_rows = mysql_num_rows($buddy);

$num_rows = mysql_num_rows($secret);

if ( $num_rows > 0 )
{
  $reading = ' ('.$num_rows.')';
}	
else
{
  $reading = '';
}	

if ( $chat_rows > 0 )
{
	while ( $chatGo = mysql_fetch_assoc($buddy) )
	{
		if ( $chatGo['awaiting'] == $me->secretAddy )
		{
			$status = $wpdb->get_row($wpdb->prepare("SELECT online FROM account WHERE secretAddy = '".$chatGo['awaiting']."' ") );
		}
		
		if ( $status->online == 'Y' )
		{
		  $chatting = '&nbsp;&nbsp;&nbsp;<a href="/online-admirers/" title="You have a Chat" id="indicator"><img src="/wp-content/themes/secretAddy/images/chat_indicator.jpg" alt="Secret Addy Chat" title="You have a Chat" id="img1" /></a>
		  <a href="/online-admirers/" title="You have a Chat" id="indicator"><img src="/wp-content/themes/secretAddy/images/chat_indicator.jpg" alt="Secret Addy Chat" title="You have a Chat" id="img2" /></a>';
		}
	}
}	
else
{
  $chatting = '';
}	
								
echo '

<div class="menu-header">
	<ul>
		<li>
			<a href="/account/" title="Account">Account</a>
				<ul class=\'children count\'>
					<li>
						<a href="/privacy/" title="Privacy Settings">Privacy Settings</a>
					</li>
					<li>
						<a href="/privacy/security/" title="Secrutiy Settings">Security Settings</a>
					</li>
					<li>
						<a href="/privacy/notifications/" title="Notifications">Notifications</a>
					</li> 
					<li>
						<a href="/profile-page/help/" title="Help">Help</a>
					</li>
					<li>
						<a href="/wp-content/themes/secretAddy/logout.php" title="Log Out">Log Out</a>
					</li>
				</ul>
		</li>  
		<li>
			<a href="/animals/?cate=animals" title="Addy Store">Addy Store</a>
		</li>
		<li>
			<a href="/connect" title="Connect">Connect</a> 
				<ul class=\'children\'>
					<li>
						<a href="/connect/" title="By Email">By Email</a>
					</li>
					<li>
						<a href="/connect/character/" title="By Traits">By Traits</a>
					</li>  
					<li>
						<a href="/connect/activity/" title="By Activities">By Activities</a>
					</li>
					<li>
						<a href="/connect/favorite/" title="By Favorites">By Favorites</a>
					</li>   
					<li>
						<a href="/connect/education/" title="By Education">By Education</a>
					</li>
				</ul>
		</li>
		<li>
			<a href="/messages/" title="Addy Mail">Addy Mail<b>'.$reading.'</b></a> 
				<ul class=\'children\'>
					<li>
						<a href="/messages/" title="Inbox">Inbox</a>
					</li>
					<li>
						<a href="/messages/sent/" title="Sent">Sent</a>
					</li>
					<li>
						<a href="/messages/send/" title="Send">Send</a>
					</li>
				</ul>
		</li>
		<li>
			<a href="/photos/" title="Photos">Photos</a> 
				<ul class=\'children\'>
					<li>
						<a href="/photos/" title="Profile">Profile</a>
					</li>
					<li>
						<a href="/photos/private/" title="Private">Private</a>
					</li> 
					<li>
						<a href="/photos/upload/" title="Upload">Upload</a>
					</li>
				</ul>
		</li>
		<li>
			<a href="/profile-page/" title="Profile" id="pro">Profile</a> '.$chatting.'
				<ul class=\'children\'>
					<li>
						<a href="/profile-page/update/" title="Update">Update</a>
					</li>
					<li>
						<a href="/profile-page/interests/" title="Interests">Interests</a>
					</li>
					<li>
						<a href="/admirer-results/" title="Admirers">Admirers</a>
					</li>
				</ul>
		</li> 
	</ul>
</div>';
?>
<div class="searchbar">
<script type="text/javascript">
var numImages = 2;
var currentImage = 1;
imageInterval = window.setInterval("changeImage();", 3000);
</script>
</div>
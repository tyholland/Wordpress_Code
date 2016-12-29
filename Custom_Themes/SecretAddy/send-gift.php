<?php	

$path = '/home/saddy/public_html/wp-load.php';

require_once($path); 
	
session_start();    

if ( !empty($_SESSION['secretID']) )
{            

  $me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );                                                    
                                                                                                                                                               
$friend = mysql_query("SELECT     	secretAddy,                                                                                                                
															admirer                                                                                                     
									  FROM      		admirer                                                                                                  
									  WHERE     	friend = 'Y'
									  AND				(secretAddy = '".$me->secretAddy."'                                                                         
									  OR        			admirer = '".$me->secretAddy."') ");                                                                    
	                                                                                                                                                             
$num_rows = mysql_num_rows($friend); 
$name = $_GET['name'];
	?>
	
		<div id="container2" class="one-column">
			<div id="content" role="main">
			
				<h1 class="entry-title">Send A Gift</h1>

					<div class="entry-content">                                                                                                                          
					<form method="get" action="/wp-content/themes/secretAddy/route.php">        
  					<input type="hidden" name="sentFrom" value="<?php echo $me->secretAddy; ?>" />                                               
						<input type="hidden" name="type" value="gift" />           
					  <input type="hidden" name="send_rose" value="Send Gift" />       
					  <input type="hidden" name="name" value="<?php echo $name; ?>" />
				    <input type="hidden" name="website" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />                                                                    
						<b>Admirer:</b>                                                                                                                                    
						<?php                                                                                                                                              
						if ( $num_rows > 0 )                                                                                                                               
						{                                                                                                                                                  
						                                                                                                                                                   
						  echo '<select name="sentTo">';                                                                                                                                                                                      
						  while ( $addy = mysql_fetch_assoc($friend) )                                                                                                     
						  {                                                                                                                                                
						  		                                                                                                                                             
								$secret = $wpdb->get_row( $wpdb->prepare( "SELECT secretAddy FROM account WHERE secretaddy != '".$me->secretAddy."' AND (secretAddy = '".$addy['secretAddy']."' OR secretAddy = '".$addy['admirer']."') ") );                                                                                                  
							                                                                                                                                                 
								echo '<option value="'.$secret->secretAddy.'">'.$secret->secretAddy.'</option>';                                                               
						  }                                                                                                                                                
						  		echo '</select>'; 
						}                                                                                                                                                  
						else                                                                                                                                               
						{                                                                                                                                                  
						  		echo 'You have no Admirers';                                                                                                                 
						}  
						echo '<br>
						<p><hr></p><b>OR click the checkbox to type Secret Addy Name: <input type="checkbox" name="users" onclick="Open(\'handle\')" /></b>
						<div class="handle" style="display: none;">
						<input type="text" name="addy" />
						</div>';                                                                                                                                                
						?>        	
						<div style="padding: 50px 0 0;">
						<img src="/wp-content/themes/secretAddy/images/store/<?php echo $name; ?>" height="150px" width="150px" />
						</div>                                                                                         
						<br>
            <hr>
            <input type="button" value="Add A Message" onclick="Open('message')" /><a href="#" onclick="alert('ADD A MESSAGE...\nIt\'s only 5 CREDITS!');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.png" style="margin: 0 0 -6px 0;" /></a>
            <div class="message" style="display: none;">
            <textarea name="msg" cols="80" rows="10" style="resize: none;"></textarea>
            </div> 	
						<p class="priv"> 
							<br /><br />
							<input type="submit" name="send_rose" value="Send Gift" />                                                                                         
            </p>		                                                                                                                                           
					</form>
          <br /> 
					</div><!-- .entry-content -->

			</div><!-- #content -->
		</div><!-- #container -->
		<script type="text/javascript" src="/wp-content/themes/secretAddy/function.js"></script>  
		<script type="text/javascript">
		function Open(name)
		{
			var el = $('.' + name).css("display");
			
			if ( el == 'none' )
			{
				$('.' + name).css("display", "block"); 
			}
			else
			{
				$('.' + name).css("display", "none"); 
			} 
		}
		</script>
		
<?php
}
else
{
	wp_redirect('/');
}
?>

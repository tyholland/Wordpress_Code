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
									  AND				fullProfile = 'N'
									  AND				(secretAddy = '".$me->secretAddy."'                                                                         
									  OR        			admirer = '".$me->secretAddy."') ");                                                                    
	                                                                                                                                                             
$num_rows = mysql_num_rows($friend); 
	?>
	
		<div id="container2" class="one-column">
			<div id="content" role="main">
			
				<h1 class="entry-title">Send Bouquet of Roses</h1>

					<div class="entry-content">                                                                                                                          
					<form method="post" action="/wp-content/themes/secretAddy/route.php">                                                                     
					  <input type="hidden" name="sentFrom" value="<?php echo $me->secretAddy; ?>" />                                                                     
						<b>Admirer:</b>                                                                                                                                    
						<?php                                                                                                                                              
						if ( $num_rows > 0 )                                                                                                                               
						{                                                                                                                                                  
						                                                                                                                                                   
						  echo '<select name="admir">';                                                                                                                    
						                                                                                                                                                   
						  while ( $addy = mysql_fetch_assoc($friend) )                                                                                                     
						  {                                                                                                                                                
						  		                                                                                                                                             
								$secret = $wpdb->get_row( $wpdb->prepare( "SELECT secretAddy FROM account WHERE secretaddy != '".$me->secretAddy."' AND (secretAddy = '".$addy['secretAddy']."' OR secretAddy = '".$addy['admirer']."') ") );                                                                                                  
							                                                                                                                                                 
								echo '<option value="'.$secret->secretAddy.'">'.$secret->secretAddy.'</option>';                                                               
						  }                                                                                                                                                
						  		echo '</select>';                                                                                                                            
						}                                                                                                                                                  
						else                                                                                                                                               
						{                                                                                                                                                  
						  		echo 'All of your Admirers already have access to your Full Profile and therefore you can\'t send them a Bouquet';                                                                                                                 
						}                                                                                                                                                  
						?>						                                                                                                                                   
						<p class="priv"> 
							Send this Bouquet of Roses to any Admirer that you feel you have connected well with. The point of these Bouquet of Roses is to grant someone access to view your Photos and Interests page. This goes both ways. If this is accepted by your Admirer, you and your Admirer will be able to view each other's Full Profile.<br /><br />
							<input type="submit" name="submit_bouquet" value="Send Bouquet" />                                                                                         
            </p>		                                                                                                                                           
					</form>
          <br /> 
					</div><!-- .entry-content -->

			</div><!-- #content -->
		</div><!-- #container -->
		
<?php
}
else
{
	wp_redirect('/');
}
?>

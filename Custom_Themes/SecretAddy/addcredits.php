<?php	

$path = '/home/saddy/public_html/wp-load.php';

require_once($path);

if ( isset($_POST['submit']) )
{
  $user = $_REQUEST['user'];
  $credit = $_REQUEST['credit'];
  
  $addition = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$user."' ") );
  
  $amount = $addition->amount + $credit;
  
  $wpdb->update('credits', array( 'amount' => $amount ), array( 'secretAddy' => $user ) );
} 
?>
<html>
<body>	
		<div id="container2" class="one-column">
			<div id="content" role="main">
			
				<h1 class="entry-title">Add Addy Credits</h1>

					<div class="entry-content">                                                                                                                          
					<form method="post" action="">                                                                     
					  User Name: <input type="text" name="user" /><br><br>                                                             
					  Amount of Addy Credits: <input type="text" name="credit" />             						                                                                                                                                   
						<p class="priv"> 
							<input type="submit" name="submit" value="Submit" />                                                                                         
            </p>		                                                                                                                                           
					</form>
          <br /> 
					</div><!-- .entry-content -->

			</div><!-- #content -->
		</div><!-- #container -->
</body>
</html>
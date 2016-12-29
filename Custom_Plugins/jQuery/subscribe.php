<?php
/*---------------------------------------------------------
	Subscription Form
---------------------------------------------------------*/
 
add_action('admin_menu', 'subscription_dashboard', 1);

add_shortcode('subscription_show', 'subscription_show');

function subscription_dashboard() {

	add_menu_page(__('Subscription Form', 'wpscripts'), __('Subscription Form', 'wpscripts'), 'administrator', 'subscription', 'subscription_schedule');
}

/*--------------------------------------------------------------------------------------
Purpose:   Page that explains how to implement the short code [subscription_show]
----------------------------------------------------------------------------------------*/
function subscription_schedule(){ 
?>
	<h2><?php _e('Add Subscription Form', 'wpscripts'); ?></h2>
	
	<p>
	*Make sure to enter this code on the page that you wish it to be displayed on:<br />
	<h3>[subscription_show]</h3>
	
	Also make sure it is entered in the HTML tab in the Page, not the VISUAL tab.<br />
	Otherwise your Subscription Form won't show.
	</p>
	</form>
<?php
}

/*------------------------------------------------------------------------
Purpose:   Displays the output of the short code [subscription_show]
--------------------------------------------------------------------------*/
function subscription_show() {

	if ( isset($_POST['submit_products']) ) {
		$email = $_REQUEST['email'];
		
		$theMsg = '
			Email Address: '.$email.'<br><br>
		';

		$mail_to = "some@place.com";
		$mail_subject = "Subscription Entry";
		$mail_body = "<html><body>".stripslashes($theMsg)."</body></html>";
		$mail_header = "From: Subscription Entry <noreply@place.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";

		if ( mail($mail_to, $mail_subject, $mail_body, $mail_header) ) {
			echo '<script type="text/javascript">                                                                                                                      
			alert("Your subscription has been sent.");  
			window.location.href="/home/";                                                                                 
			</script>';
		} 
		else {
			echo '<script type="text/javascript">                                                                                                                      
			alert("Subscription not sent.");         
			window.location.href="/subscribe/";                                                                                                          
			</script>';
		}     
	}
	
	$output = ' 
		<script type="text/javascript">
			function subCheck(formobj) {                                                                                                                               
				var email = $("#email").val(),
					msg = "",
					pos = email.indexOf("@",0);                                                                                                                              
				if (pos == -1) {                                    
					msg += "Please enter a valid email address \n\n";    
				}                                     
				else {                                     
					var pos2 = email.indexOf("@", pos + 1),                                        
						pos3 = email.indexOf(".", pos + 1),   
						diff = pos3 - pos;

					if (pos2 != -1 || diff <= 3) {                                        
						msg += "Please enter a valid email address.\n\n";           
					} 
				}                            

				if (msg == "") {                                     
					return true;                             
				}                                     
				else {                                    
					alert(msg);                             
					return false;                           
				}                                     
			}
		</script>

		<form action="" name="contactform" method="post" onsubmit="return subCheck(this);">
			<div class="contactSpace">
				<input type="text" name="email" id="email" placeholder="Enter your Email Address" />
			</div>
			<div class="contactSpace">
				<input type="submit" value="Subscribe" name="submit_subscribe" class="submit_contact" />
			</div>
		</form>
	';
	
	return $output;

}
?>
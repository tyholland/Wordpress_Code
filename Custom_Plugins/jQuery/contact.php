<?php
/*---------------------------------------------------------
	Contact Form Plugin
---------------------------------------------------------*/
 
add_action('admin_menu', 'contact_dashboard', 1);

add_shortcode('contact_show', 'contact_show');

function contact_dashboard() {

	add_menu_page(__('Contact Form', 'wpscripts'), __('Contact', 'wpscripts'), 'administrator', 'contact', 'contact_schedule');
}

/*--------------------------------------------------------------------------------------
	Purpose: Page that explains how to implement the short code [contact_show]
----------------------------------------------------------------------------------------*/
function contact_schedule(){ 
?>
	<h2><?php _e('Add Contact Form', 'wpscripts'); ?></h2>
	
	<p>
	*Make sure to enter this code on the page that you wish it to be displayed on:<br />
	<h3>[contact_show]</h3>
	
	Also make sure it is entered in the HTML tab in the Page, not the VISUAL tab.<br />
	Otherwise your Contact Form won't show.
	</p>
	</form>
<?php
}

/*------------------------------------------------------------------------
	Purpose: Displays the output of the short code [contact_show]
--------------------------------------------------------------------------*/
function contact_show() {

	if ( isset($_POST['submit_products']) ) {    
		$fname = $_REQUEST['fname']; 
		$email = $_REQUEST['email'];
		
		$theMsg = '
			First Name: '.$fname.'<br><br>
			Email Address: '.$email.'<br><br>
		';

		$mail_to = "some@place.com";
		$mail_subject = "Customer Inquiry";
		$mail_body = "<html><body>".stripslashes($theMsg)."</body></html>";
		$mail_header = "From: Hoodiezz Customer Inquiry <noreply@place.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";

		if ( mail($mail_to, $mail_subject, $mail_body, $mail_header) ) {
			echo '<script type="text/javascript"> 
				alert("Your message has been sent.\nWe will respond back shortly.");  
				window.location.href="/home/";                                                                                 
				</script>';
		} 
		else {
			echo '<script type="text/javascript"> 
				alert("Email not sent.");         
				window.location.href="/contact-us/";                                                                          
				</script>';
		}     
	}
	
	$output = ' 
		<script type="text/javascript">
			function contactCheck(formobj) {                                                                                                                               
				var email = $("#email").val(),          
					fname = $("#fname").val(),
					msg = "";

				if (fname == "") {
					msg += "Please Enter your Name.\n\n";
				}

				pos = email.indexOf("@",0);                                                                                                                              
				if (pos == -1) {                                   
					msg += "Please enter a valid email address.\n\n";   
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

		<form action="" name="contactform" method="post" onsubmit="return contactCheck(this);">
			<div class="contactSpace">
				<input type="text" name="fname" id="fname" class="contactInput" placeholder="Enter your Name" />
			</div>
			<div class="contactSpace">
				<input type="text" name="email" id="email" class="contactInput" placeholder="Enter your Email Address" />
			</div>
			<div class="contactSpace">
				<textarea name="message" id="message" class="contactInput" placeholder="Enter your Message"></textarea>
			</div>
			<div class="contactSpace">
				<input type="submit" value="Submit" name="submit_contact" class="submit_contact" />
			</div>
		</form>
	';
	
	return $output;

}
?>
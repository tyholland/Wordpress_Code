<?php

session_start();                                                                                                                                            
/**                                                                                                                                                         
* @package WordPress                                                                                                                                        
* @subpackage SecretAddy                                                                                                                                    
*/                                                                                                                                                          
                                                                                                                                                            
/*-----------------------------------------------------------------                                                                                         
Call to the wp-load.php file that allows for the wordpress                                                                                                  
functions to be used.                                                                                                                                       
------------------------------------------------------------------*/                                                                                        
$path = '/home/saddy/public_html/wp-load.php';                                                                                                        
                                                                                                                                                            
require_once($path); 

function encrypt($pwd)
{
  $salt = md5($pwd."!@#%!927126*&^~");
  
  $pwd = md5("$salt$string$salt");
  
  return $pwd;
}                                                                                                                                       
                                                                                                                                                            
/*-----------------------------------------------------------------                                                                                         
Updates/Adds to the query for your account changes.                                                                                                         
------------------------------------------------------------------*/                                                                                        
if ( isset($_POST['save_account']) )                                                                                                                        
{                                                                                                                                                           
	$id = $_REQUEST['id'];                                                                                                                                    
	$secretAddy = $_REQUEST['secret'];                                                                                                                        
	$city = $_REQUEST['city'];                                                                                                                                
	$state = $_REQUEST['state'];                                                                                                                              
	$zip = $_REQUEST['zip'];                                                                                                                                  
	$skype = $_REQUEST['skype'];                                                                                                                              
	$email = $_REQUEST['email'];                                                                                                                              
	$gender = $_REQUEST['gender'];                                                                                                                            
	$body = $_REQUEST['body'];                                                                                                                                
	$hair = $_REQUEST['hair'];                                                                                                                                
	$race = $_REQUEST['race'];                                                                                                                                
	$admirer = $_REQUEST['admirer'];                                                                                                                          
	$height = $_REQUEST['height'];                                                                                                                                  
	$age = $_REQUEST['age'];                                                                                                                                
	$bio = $_REQUEST['bio'];                                                                                                                              
	$job = $_REQUEST['job'];                                                                                                                                    
	                                                                                                                                                          
	$wpdb->update( 'account', array( 'secretAddy' => $secretAddy, 'city' => $city, 'state' => $state, 'zip' => $zip, 'skypeID' => $skype, 'email' => $email, 'gender' => $gender, 'bodyType' => $body, 'hair' => $hair, 'ethnicity' => $race, 'admirers' => $admirer, 'height' => $height, 'age' => $age, 'bio' => stripslashes($bio) ), array( 'ID' => $id ) );           
	
	$wpdb->update( 'interests', array( 'job' => stripslashes($job) ), array( 'ID' => $id ) ); 
	                                                                                                                                                          
    echo '	<script type="text/javascript">                                                                                                                    
							alert("Your Profile has been updated.");                                       
							window.location = "'.get_option('siteurl').'/account/";                                                                                                                               
							</script>';                                                                                                                                   
}                                                                                                                                                           
                                                                                                                                                            
/*-----------------------------------------------------------------                                                                                         
Updates/Adds to the query for your security changes.                                                                                                         
------------------------------------------------------------------*/                                                                                        
if ( isset($_POST['save_secure']) )                                                                                                                         
{                                                                                                                                                           
	$id = $_REQUEST['id'];                                                                                                                                    
	$orig = $_REQUEST['orig'];                                                                                                                                
	$security = $_REQUEST['secure'];                                                                                                                       
	$question = $_REQUEST['question'];                                                                                                                          
	$oldPwd = $_REQUEST['old'];                                                                                                                               
	$newPwd = $_REQUEST['new'];                                                                                                                                  
	$confirmPwd = $_REQUEST['confirmNew'];                                                                                                                       
	                                                                                                                                                             
	if ( empty($oldPwd) && empty($newPwd) )                                                                                                                      
	{                                                                                                                                    
		$wpdb->update( 'security', array( 'question' => $question, 'answer' => stripslashes($security) ), array( 'ID' => $id ) );                         
      echo '	<script type="text/javascript">                                                                                                                    
							alert("Your Security Settings have been saved.");                                                                                                                   
							</script>';                                                                    
  	}                                                                                                                                                          
  	elseif ( $orig != encrypt($oldPwd) )                                                                                                                                
  	{                                                                                                                                                          
		echo '	<script type="text/javascript">                                                                                                                    
						alert("Your old password is incorrect.");                                                                                                                  
						</script>';                                                                                                                                        
 	}                                                                                                                                                            
  	elseif ( $newPwd != $confirmPwd )                                                                                                                          
  	{                                                                                                                                                          
		echo '	<script type="text/javascript">                                                                                                                    
						alert("Your new passwords don\'t match.");                                                                                                                 
						</script>';                                                                                                                                        
  	}                                                                                                                                                          
  	else                                                                                                                                                       
  	{                                                                                                                                                          
		  $wpdb->update( 'account', array( 'pwd' => encrypt($newPwd) ), array( 'ID' => $id ) );
		  $wpdb->update( 'security', array( 'question' => $question, 'answer' => stripslashes($security)), array( 'ID' => $id ) );
      echo '	<script type="text/javascript">                                                                                                                    
							alert("Your Security Settings have been saved.");                                       
							window.location = "'.get_option('siteurl').'/privacy/security/";                                                                                                                   
							</script>';                                                                                                                                      
  	}                                                                                                                                                          
	                                                                                                                                                             
}                                                                                                                                                               
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This finds your forgotten password and gives you a new generated one.                                                                                          
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['submit_forgot']) )                                                                                                                          
{                                                                                                                                                                                      
	$secure = $_REQUEST['secure']; 
	$id = $_REQUEST['member']; 
	$email = $_REQUEST['email'];
	$random = rand(10000, 30000);                                                                                                                                
	                                                                                                                                                             
  $confirm = $wpdb->prepare("SELECT answer FROM security WHERE ID = ".$id);                    
                                                                                                                                                               
	$result = $wpdb->get_row( $confirm );                                                                                                                         
	                                                                                                                                                             
	if ( isset($confirm) )                                                                                                                                       
	{                                                                                                                                                            
	   if ( $secure != $result->answer )                                                                                               
	   {               
		   echo '	<script type="text/javascript">                                                                                                                    
							alert("Your Security Question is incorrect.");                                                      
							window.location = "'.get_option('siteurl').'/forgot-password/";                                                                                                      
							</script>';                                                                                                                                          		
		}                                                                                                                                                          
		else                                                                                                                                                           
		{                                                                                                                                    
			$wpdb->update( 'account', array( 'pwd' => encrypt($random) ), array( 'ID' => $id ) );
			
      $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr> 
<td style="padding: 0; margin: 0;">	  
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">
		<div style="width: 670px;">
			<p>Your new password is: '.$random.'</p>
              <p>After you log back in, go <a href="'.get_option('siteurl').'/privacy/security">here</a> to change your password.
              </p>
		</div>
	</div>
</td>         
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />   
	<p style="text-align: center;">
	<font size="1">Please do not reply back to this email.</font>
  </p>	
</td>
</tr>
</table>
</center>';
			
      $mail_to = "$email";
    	$mail_subject = "New Password"; 
    	$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
    	$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
    	
    	mail($mail_to, $mail_subject, $mail_body, $mail_header);   
      
      echo '	<script type="text/javascript">                                                                                                                    
							alert("Your New Password has been sent to your Email Address.");                                                      
							window.location = "'.get_option('siteurl').'"                                                                                                      
							</script>';                                                                                                                                       
		}                                                                                                                                                          
  }                                                                                                                                                            
}                                                                                                                                                      
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This finds your forgotten password and gives you a new generated one.                                                                                          
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['submit_email']) )                                                                                                                          
{                                                                                                                                                              
  $name = strtolower($_REQUEST['name']);                                                                                                                                   
	                                                                                                                                                             
  $confirm = $wpdb->prepare("SELECT ID, secretAddy FROM account WHERE secretAddy = '".$name."' ");                    
                                                                                                                                                               
	$result = $wpdb->get_row( $confirm );                                                                                                                         
	                                                                                                                                                             
	if ( isset($confirm) )                                                                                                                                       
	{                                                                                                                                                            
	   if ( empty($name) || $name != $result->secretAddy )                                                                                               
	   {               
		   echo '	<script type="text/javascript">                                                                                                                    
							alert("Your Email is not registered with SecretAddy.");                                                      
							window.location = "'.get_option('siteurl').'/forgot-password/";                                                                                                      
							</script>';                                                                                                                                          		
		}                                                                                                                                                          
		else                                                                                                                                                           
		{                                                                          
      
      			wp_redirect(get_option('siteurl').'/forgot-password?part=2&member='.$result->ID);                                                                                                                                     
		}                                                                                                                                                          
  }                                                                                                                                                            
}                                                                                                                                                           
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
Updates/Adds to the query for your privacy changes.                                                                                                            
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['save_privacy']) )                                                                                                                           
{                                                                                                                                                              
	$id = $_REQUEST['id'];                                                                                                                                       
	$locate = $_REQUEST['locate'];                                                                                                                                   
	$body = $_REQUEST['bod'];                                                                                                                                    
	$hair = $_REQUEST['hair'];                                                                                                                                   
	$race = $_REQUEST['race'];                                                                                                                                   
	$admirer = $_REQUEST['admir'];                                                                                                                               
	$height = $_REQUEST['height'];                                                                                                                               
	$age = $_REQUEST['age'];                                                                                                                                     
	$bio = $_REQUEST['bio'];                                                                                                                                   
	$job = $_REQUEST['job'];                                                                                                                                       
                                                                                                                                                               
    $wpdb->update( 'privacy', array( 'city' => $locate, 'state' => $locate, 'zip' => $locate, 'bodyType' => $body, 'hair' => $hair, 'ethnicity' => $race, 'admirers' => $admirer, 'height' => $height, 'age' => $age, 'bio' => $bio, 'job' => $job ), array( 'ID' => $id ) );       
    
    echo '	<script type="text/javascript">                                                                                                                    
							alert("Your Privacy Settings have been saved.");                                                      
							window.location = "'.get_option('siteurl').'/privacy/";                                                                                                     
							</script>';                                                                                                                                      
}                                                                                                                                                               
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
Updates/Adds to the query for your interests changes.                                                                                                            
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['save_interests']) )                                                                                                                           
{                                                                                                                                                              
	$id = $_REQUEST['id'];                                                                                                                                       
	$book = $_REQUEST['book'];
	$food = $_REQUEST['food'];
	$color = $_REQUEST['color'];
	$sport = $_REQUEST['sport'];
	$movie = $_REQUEST['movie'];
	$tv = $_REQUEST['tv'];
	$song = $_REQUEST['song'];
	$singer = $_REQUEST['singer'];
	$skool = $_REQUEST['highSkool'];
	$college = $_REQUEST['college'];
	$hobby1 = $_REQUEST['hobby1'];
	$hobby2 = $_REQUEST['hobby2'];
	$hobby3 = $_REQUEST['hobby3'];
	$hobby4 = $_REQUEST['hobby4'];
	$hobby5 = $_REQUEST['hobby5'];                                                                                                                                     
                                                                                                                                                               
    $wpdb->update( 'interests', array( 'book' => stripslashes($book), 'food' => stripslashes($food), 'color' => stripslashes($color), 'sport' => stripslashes($sport), 'movie' => stripslashes($movie), 'tv' => stripslashes($tv), 'song' => stripslashes($song), 'singer' => stripslashes($singer), 'skool' => stripslashes($skool), 'college' => stripslashes($college), 'hobby1' => stripslashes($hobby1), 'hobby2' => stripslashes($hobby2), 'hobby3' => stripslashes($hobby3), 'hobby4' => stripslashes($hobby4), 'hobby5' => stripslashes($hobby5) ), array( 'ID' => $id ) );       
    
    echo '	<script type="text/javascript">                                                                                                                    
							alert("Your Interests have been saved.");                                                      
							window.location = "'.get_option('siteurl').'/profile-page/interests/";                                                                                                      
							</script>';                                                                                                                                      
}                                                                                                                                                         
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
Updates what you want displayed in your status.                                                                                                                
------------------------------------------------------------------*/                                                                                           
if ( isset($_GET['edit_status']) )                                                                                                                            
{                                                                                                                                                              
	$id = $_GET['id'];                                                                                                                                       
	$status = $_GET['status'];	                                                                                                                             
  date_default_timezone_set('America/New_York');                                                                                                               	
                                                                                                                                                               
	$wpdb->update( 'statuses', array( 'secretAddy' => $id, 'status' => stripslashes($status) ), array( 'secretAddy' => $id ) );
  
  wp_redirect(get_option('siteurl').'/profile-page/');                                                                                                                 
}                                                                                                                                                                                                                                             
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This logs the user in. And checks to see if the username and                                                                                                   
password are correct.                                                                                                                                          
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['user_login']) )                                                                                                                             
{                                                                                                                                                              
	$user = strtolower($_REQUEST['user']);                                                                                                                                   
	$pwd = $_REQUEST['passwd'];                                                                                                                                  
	$website = $_REQUEST['website'];                                                                                                                                  
	                                                                                                                                                             
	$confirm = $wpdb->prepare("SELECT secretAddy, pwd, ID FROM account WHERE secretAddy = '".$user."' ");                                                            
	$result = $wpdb->get_row( $confirm );    
  
  $member = $wpdb->get_row( $wpdb->prepare("SELECT confirm FROM randomID WHERE ID = '".$result->ID."' ") );                                                                                                                    
	                                                                                                                                                             
	if ( isset($confirm) )                                                                                                                                       
	{                                                                                                                                                            
		if ( $user != $result->secretAddy || encrypt($pwd) != $result->pwd || $member->confirm != 'Y' )                                                                                                
		{						                                                                                                                                               
			echo '	<script type="text/javascript">                                                                                                                  
						alert("Your SecretAddy Name and/or Password are incorrect.");                                                                                      
						window.location = "'.get_option('siteurl').'";                                                                                                      
						</script>';                                                                                                                                                                                                                                                                                                      
		}                                                                                                                                                                                                                                                                                                                         
		elseif ( $user == $result->secretAddy && encrypt($pwd) == $result->pwd )                                                                                            
		{						                                                                                                                                               
			$ID = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM account WHERE secretAddy = '".$user."' ") );
      
      $wpdb->update( 'account', array( 'online' => 'Y' ), array( 'ID' => $ID->ID ) );                                                        
  			  			                                                                                                                                               
			$_SESSION['secretID'] = $ID->ID;                                                                                                                         
			                                                                                                                                                         
  			wp_redirect(get_option('siteurl').$website);                                                                                                         
		}                                                                                                                                                          
	}                                                                                                                                                            
	                                                                                                                                                             
} 
 
 /*-----------------------------------------------------------------                                                                                            
This sends the Secret Note and the characteristics to a                                                                                                        
Secret Admirer of yours that isn't on SecretAddy.                                                                                                              
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['send_admirer']) )                                                                                                                           
{                                                                                                                                                         
	$rose = $_REQUEST['rose'];                                                                                                                                       
	$locate = $_REQUEST['locate'];                                                                                                                               
	$gender = $_REQUEST['gender'];                                                                                                                                 
	$body = $_REQUEST['body'];                                                                                                                                    
	$hair = $_REQUEST['hair'];                                                                                                                                   
	$race = $_REQUEST['race'];                                                                                                                                   
	$desire = $_REQUEST['desire'];                                                                                                                               
	$height = $_REQUEST['height'];                                                                                                                               
	$age = $_REQUEST['age'];                                                                                                                                     
	$letter = $_REQUEST['love'];                                                                                                                                   
	$email = $_REQUEST['addyEmail'];                                                                                                                                
	$me = $_REQUEST['me'];
	
	$rosePath = get_option('siteurl').'/wp-content/themes/secretAddy/images/';
	
	$secret = $wpdb->get_row( $wpdb->prepare("SELECT 	ID,
                                                    gender,
																										bodyType,
																										hair,
																										ethnicity,
																										admirers,
																										age,
																										city,
																										state,
																										zip,
																										height
																				FROM				account
																				WHERE			secretAddy = '".$me."' ") );																				
																				
	$ref = $wpdb->get_row( $wpdb->prepare("SELECT reference FROM randomID WHERE ID = '".$secret->ID."' ") );
  
  $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr> 
<td style="padding: 0; margin: 0;"> 
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">
		<div style="width: 670px;">
	<p>
			'.$me.' from <a href="'.get_option('siteurl').'">SecretAddy.com</a>';
			
          if ($rose == 0)
          {
          $msg .= ' presents you this rose:<br><br>
                  <img src="'.$rosePath.'rose.jpg" style="height: 150px; width:150px;"/>
                  </p>
                  and';
          }
          
			$msg .= ' requests that you join the <a href="'.get_option('siteurl').'">SecretAddy.com</a> network and connect.<br><br>
			</p>
			<p>
			'.$me.' has a personal message for you:<br><br>
			</p>
			<p>
			"<i>'.$letter.'</i>"<br><br>
			</p>
			
			<p>
			'.$me.':';
			if ($gender == 1)
          {
          $msg .= ' is a '.$secret->gender.'.';
          } 
          if ($age == 1)
          {
          $msg .= ' is '.$secret->age.' years old.';
          }
          if ($locate == 1)
          {
          $msg .= ' is from '.$secret->city.', '.$secret->state.' '.$secret->zip.'.';
          }
          if ($body == 1)
          {
          $msg .= ' has a '.$secret->bodyType.' build.';
          }
          if ($race == 1)
          {
          $msg .= ' is '.$secret->ethnicity.'.';
          }
          if ($hair == 1)
          {
          $msg .= ' has '.$secret->hair.' colored hair.';
          }
          if ($desire == 1)
          {
          $msg .= ' desires to connect with a '.$secret->admirers.'.';
          }
          if ($height == 1)
          {
          $msg .= ' is '.$secret->height.' in height.';
          } 
          $msg .= '<br><br></p>
			
			<p>
			<a href="'.get_option('siteurl').'">Sign up</a> now for FREE to connect with '.$me.' OR Go to '.$me.' page to view this person\'s <a href="'.get_option('siteurl').'/admirer/?ref='.$ref->reference.'">profile</a>.<br><br>
			</p>
			
			<p>
			<b>How to Connect with '.$me.'</b>:<br>
			1.) Create and Activate your account on <a href="'.get_option('siteurl').'">SecretAddy.com</a><br>
			2.) Update your <a href="'.get_option('siteurl').'/profile-page/update/">Profile</a> (which will make it easier for others to connect with you).<br>
			3.) Update your <a href="'.get_option('siteurl').'/privacy/">Privacy Settings</a> <br>
			4.) Enter your <a href="'.get_option('siteurl').'/privacy/security/">Security Question</a> (helpful if you ever forget your password).<br>
			5.) Go to Connect and type in '.$me.'\'s name in the Connect bar on every page.
			</p>
		</div>
	</div>
</td>         
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />
	<p style="text-align: center;">
	<font size="1">Please do not reply back to this email.<br>
  If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?lone='.$email.'">Unsubscribe</a>.</font>	
	</p>
</td>
</tr>
</table>
</center>';

  $removal = $wpdb->get_row( $wpdb->prepare("SELECT email FROM unsubscribe WHERE email = '".$email."' ") );
  
  if ( $removal->email != $email )
  { 		
    $mail_to = "$email";
  	$mail_subject = "Secret Admirer Invitation"; 
  	$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
  	$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
  	
  	mail($mail_to, $mail_subject, $mail_body, $mail_header);
  } 
  
  echo '	<script type="text/javascript">                                                                                                                    
							alert("Your Anonymous Email has been sent.");                                                                                                       
						window.location = "'.get_option('siteurl').'";                                                                                                                  
							</script>';                                                                                                                                        
}                                                                                                                                                               
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This submits all the infomortion in the registration form                                                                                                      
to create your new user profile.                                                                                                                               
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['submit_registrar']) )                                                                                                                       
{                                                                                                                                                              
	$secretAddy = strtolower($_REQUEST['secret']);                                                                                                                           
	$pwd = $_REQUEST['pwd'];                                                                                                                                     
	$email = $_REQUEST['email'];                                                                                                                                
	$maxAge = $_REQUEST['maxAge'];                                                                                                                             
	$special = strtolower($_REQUEST['special']);                                                                                                                                       
	                                                                                                                                                             
	$confirm2 = $wpdb->prepare("SELECT secretAddy, pwd, email, terms, maxAge FROM account WHERE secretAddy = '".$secretAddy."' ");                                       
	$result2 = $wpdb->get_row( $confirm2 );                                                                                                                      
	                                                                                                                                                             
	if ( isset($confirm2) )                                                                                                                                      
	{                                                                                                                                                            
		if ( $secretAddy != $result2->secretAddy && $pwd != $result2->pwd && $email != $result2->email && $maxAge != $result2->maxAge )                              
		{                                                                                                                                                          
			$wpdb->insert( 'account', array( 'secretAddy' => $secretAddy, 'pwd' => encrypt($pwd), 'email' => $email, 'terms' => $maxAge, 'maxAge' => $maxAge ) );                                   
			$wpdb->insert( 'privacy', array( 'secretAddy' => $secretAddy, 'city' => '0', 'state' => '0', 'zip' => '0', 'bodyType' => '0', 'hair' => '0', 'ethnicity' => '0', 'admirers' => '0', 'height' => '0', 'age' => '0', 'bio' => '0', 'job' => '0' ) );
      $wpdb->insert( 'interests', array( 'book' => '', 'food' => '', 'color' => '', 'sport' => '', 'movie' => '', 'tv' => '', 'song' => '', 'singer' => '', 'skool' => '', 'college' => '', 'job' => '', 'hobby1' => '', 'hobby2' => '', 'hobby3' => '', 'hobby4' => '', 'hobby5' => '' ) );                                     
			$wpdb->insert( 'statuses', array( 'secretAddy' => $secretAddy ) ); 
			$wpdb->insert( 'notification', array( 'rose' => '0', 'addy' => '0', 'message' => '0', 'receive' => '0', 'post' => '0', 'bouquet' => '0', 'love' => '0' ) );
			$wpdb->insert( 'security', array( 'question' => 'What is your mothers madien name?', 'answer' => '' ) ); 
			
      if( $special == 'lauren' || $special == 'etienne' || $special == 'stefani' || $special == 'carlton' )
      {    
        $wpdb->insert( 'credits', array( 'secretAddy' => $secretAddy, 'amount' => '200' ) );
        $addUser = $wpdb->get_row( $wpdb->prepare("SELECT users FROM tracking WHERE name = '".$special."' ") );
        $userCount = $addUser->users + 1;
        $wpdb->insert( 'tracking', array( 'name' => $special, 'users' => $userCount ) );
      }
      else
      {
        $wpdb->insert( 'credits', array( 'secretAddy' => $secretAddy, 'amount' => '100' ) );
      }
			                                                                                                                                                         
			$ID = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM account WHERE secretAddy = '".$secretAddy."' ") );
      
      $ref = $wpdb->get_row( $wpdb->prepare("SELECT reference FROM randomID WHERE ID = '".$ID->ID."' ") );
      
      $wpdb->update( 'randomID', array('confirm' => 'N' ), array('reference' => $ref->reference) );     
      
      $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">	
		<div style="width: 670px;">
			<p>Thank You for registering with Secret Addy, where we\'ve changed the dating game!</p>
              <p>You must activate your account before being able to log in.</p>
              <p>Activation Code: '.$ref->reference.'</p>
              <p><a href="'.get_option('siteurl').'/activate-account/">Click here</a> to proceed with activating your account.</p>
		</div>
</td>  
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />
  <p style="text-align: center;">
	<font size="1">Please do not reply back to this email.</font>
  </p>	 
</td>
</tr>
</table>
</center>';
    			
      $mail_to = "$email";
    	$mail_subject = "Secret Addy Registration"; 
    	$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
    	$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
    	
    	mail($mail_to, $mail_subject, $mail_body, $mail_header);                                                                      
			                                                                                                                                                                                                    
			mkdir("/home/saddy/public_html/wp-content/themes/secretAddy/profilePhotos/".$secretAddy, 0777, true);                                                                                                                                                         
			mkdir("/home/saddy/public_html/wp-content/themes/secretAddy/profilePhotos/".$secretAddy."/public", 0777, true);                                                          
			mkdir("/home/saddy/public_html/wp-content/themes/secretAddy/profilePhotos/".$secretAddy."/profile", 0777, true);                                                         
      chmod("/home/saddy/public_html/wp-content/themes/secretAddy/profilePhotos/".$secretAddy, 0777);    
      chmod("/home/saddy/public_html/wp-content/themes/secretAddy/profilePhotos/".$secretAddy."/public", 0777);  
      chmod("/home/saddy/public_html/wp-content/themes/secretAddy/profilePhotos/".$secretAddy."/profile", 0777);               
                                                                                                                                                               
  		echo '	<script type="text/javascript">                                                                                                                
						alert("Thank you for registering with Secret Addy.\nCheck your Email for your Activiation code.");                                                                                                      
						window.location = "'.get_option('siteurl').'"                                                                                                      
						</script>';                                                                                                           
		}                                                                                                                                                          
		elseif ( $secretAddy == $result2->secretAddy )                                                                                                             
		{                                                                                                                                                          
  			echo '	<script type="text/javascript">                                                                                                                
						alert("This SecretAddy name already exists");                                                                                                      
						window.location = "'.get_option('siteurl').'";                                                                                                      
						</script>';                                                                                                                                        
		}                                                                                                                                                          
	}                                                                                                                                                            
                                                                                                                                                               
}                                                                                                                                                              
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This deletes a message that you have in your inbox.                                                                                                            
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['del_message']) )                                                                                                                            
{                                                                                                                                                              
	$check = $_REQUEST['check'];
	$count = $_REQUEST['count'];
  
  $i = 0;
  while ( $i < $count )
  {
  	  $id = $check[$i];
	  $wpdb->update( 'inbox', array( 'delete1' => 'Y'), array( 'ID' => $id) );                                                                                  
																																								   
	  $remove = $wpdb->get_row($wpdb->prepare( "SELECT delete1, delete2 FROM inbox WHERE ID = ".$id) );                                                         
																																								   
	  if ( $remove->delete1 == 'Y' && $remove->delete2 == 'Y')                                                                                                     
	  {                                                                                                                                                            
		$wpdb->query( 'DELETE FROM inbox WHERE ID = '.$id );                                                                                                    
	  }
	  $i++;
  }                                                                                                             
  wp_redirect(get_option('siteurl').'/messages/');                                                                                                           
}                                                                                                                                                              
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This deletes a message that you have in your sent folder.                                                                                                      
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['del_sentMes']) )                                                                                                                            
{                                                                                                                                                              
	$check = $_REQUEST['checker'];  
	$count = $_REQUEST['count'];
	
  $i = 0;
  while ( $i < $count )
  {
  	  $id = $check[$i];                                                                                                                             
	                                                                                                                                                             
	  $wpdb->update( 'inbox', array( 'delete2' => 'Y'), array( 'ID' => $id) );                                                                                  
																																								   
	  $remove = $wpdb->get_row($wpdb->prepare( "SELECT delete1, delete2 FROM inbox WHERE ID = ".$id) );                                                         
																																								   
	  if ( $remove->delete1 == 'Y' && $remove->delete2 == 'Y')                                                                                                     
	  {                                                                                                                                                            
		$wpdb->query( 'DELETE FROM inbox WHERE ID = '.$id );                                                                                                    
	  }
	  $i++;
  }                                                             
  wp_redirect(get_option('siteurl').'/messages/sent/');                                                                                                                 
}                                                                                                                                                              
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This sends a message to an admirer of yours.                                                                                                                   
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['send_message']) )                                                                                                                           
{                                                                                                                                                              
	$admirer = $_REQUEST['admir'];                                                                                                                               
	$subject = $_REQUEST['subject'];                                                                                                                             
	$msg = $_REQUEST['msg'];                                                                                                                                     
	$sender = $_REQUEST['sentFrom'];
  $website = $_REQUEST['website'];                                                                                                                               
	$toy = $_REQUEST['toy'];                                                                                                                             
  date_default_timezone_set('America/New_York');
  
  $checkCredit = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$sender."' ") ); 
  
  if ( $checkCredit->amount == 0 || $checkCredit->amount < 5)
  {                                                                                                                                      
	   echo '	<script type="text/javascript">                                                                                                                    
						alert("You do not have enough credits to Send a Message");                                                                                                
						window.location = "'.$website.'";                                                                                             
						</script>';  
  }
  else
  {
  
      $addy = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM account WHERE secretAddy = '".$sender."' ") );
      $ref = $wpdb->get_row( $wpdb->prepare("SELECT reference FROM randomID WHERE ID = ".$addy->ID) );
      
      $reply = '<br />
      					<script type="text/javascript"> 
    						function showPopup(url) 
    						{
    						  newwindow = window.open(url,\'name\',\'height=400px,width=700px,left=300px,resizable,scrollbars=yes\');
    						  if (window.focus)
    						  {
    							newwindow.focus();
    						  }
    						}
    						</script>
           		 		<a href="" onclick="showPopup(\''.get_option('siteurl').'/wp-content/themes/secretAddy/love_letter.php?ref='.$ref->reference.'&sub=RE: '.$subject.'\')">Reply</a>';
      
      if ( empty($subject) )
      {
        $subject = 'No Subject';
      }
                                                                                                                                                                   
    	if( empty($admirer) )                                                                                                                                        
    	{                                                                                                                                                            
    	   echo '	<script type="text/javascript">                                                                                                                    
    						alert("You have no Admirers to send a message to");                                                                                                
    						window.location = "'.$website.'";                                                                                             
    						</script>';                                                                                                                                        
      }                                                                                                                                                            
      elseif( empty($msg) )                                                                                                                     
    	{                                                                                                                                                            
    	   echo '	<script type="text/javascript">                                                                                                                    
    						alert("You have to fill in a message");                                                                                            
    						window.location = "'.$website.'";                                                                                             
    						</script>';                                                                                                                                        
      }                                                                                                                                                          
      else                                                                                                                                                         
      {   
        if ( !empty($toy) )
        {
          $msg .= '<br><br>
                   <p>
                   <img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/store/'.$toy.'" alt="'.$toy.'" title="'.$toy.'" />
                   </p>';
      
          $subtract = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$sender."' ") ); 
      	  
      	  $renew = $subtract->amount - 2;
      	  
      	  $wpdb->update( 'credits', array( 'amount' => $renew ), array( 'secretAddy' => $sender ));
        }                                                                                                                                                          
        
        $wpdb->insert( 'inbox', array( 'sentTo' => $admirer, 'sentFrom' => $sender, 'message' => stripslashes($msg).$reply, 'subject' => stripslashes($subject), 'readMessage' => 'N', 'date' => date('m/d/Y'), 'delete1' => 'N', 'delete2' => 'N' ) );                                                                                                         
          
        $receiver = $wpdb->get_row( $wpdb->prepare("SELECT ID, email FROM account WHERE secretAddy = '".$admirer."' ") );
      
        $reduce = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$sender."' ") ); 
    	  
    	  $newPrice = $reduce->amount - 5;
    	  
    	  $wpdb->update( 'credits', array( 'amount' => $newPrice ), array( 'secretAddy' => $sender ));
          
          $notify = $wpdb->get_row($wpdb->prepare("SELECT message FROM notification WHERE ID = '".$receiver->ID."' ") ); 
    		  
    		  if ( $notify->message == '0')
    		  {
    		  $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr> 
<td style="padding: 0; margin: 0;">
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">	
		<div style="width: 670px;">
    			<p>
    			Hello '.$admirer.',<br><br><br>
          One of our Members has sent you some Addy Mail! Your Admirer\'s Username is "'.$sender.'".
    			</p>
    			<p>
    			<a href="'.get_option('siteurl').'/messages/">Click here</a> to check out further details of this member and view your Addy Mail.
          </p>
		</div>
	</div>
</td>  
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />   	
	<p style="text-align: center;">
	<font size="1">Please do not reply back to this email.<br>
  If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?num='.$receiver->ID.'&notify=Inbox Message&element=message">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>';
    					
    		  $mail_to = "$receiver->email";
    			$mail_subject = "Secret Addy Inbox Message"; 
    			$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
    			$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
    			
    			mail($mail_to, $mail_subject, $mail_body, $mail_header);
    		  } 
    		  
          echo '	<script type="text/javascript">                                                                                                                
    						alert("Your message has been sent.");                                                                                                      
    						window.location = "'.get_option('siteurl').'/messages/sent/";                                                                                                       
    						</script>';                                                                                                                                        
      }
  }                                                                                                                                                            
	                                                                                                                                                             
}                                                                                                                                                              
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This sends an Add Admirer request to desired match's inbox.                                                                                                    
------------------------------------------------------------------*/                                                                                           
if ( isset($_GET['add_desire']) )                                                                                                                             
{                                                                                                                                                              
	$me = $_REQUEST['me'];                                                                                                                                       
	$desire = $_REQUEST['desire'];                                                                                                                               
	$action = $_REQUEST['destination'];                                                                                                                          
  date_default_timezone_set('America/New_York');
  
  $addy = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM account WHERE secretAddy = '".$me."' ") );
  $ref = $wpdb->get_row( $wpdb->prepare("SELECT reference FROM randomID WHERE ID = ".$addy->ID) );                                                                                                                
	                                                                                                                                                             
	$message = 'Hello,                                                                                                                                           
						<p>                                                                                                                                                
						My name is '.$me.' and I would like to chat wth you.                                                                                               
						</p>                                                                                                                                               
						<form method="post" action="/wp-content/themes/secretAddy/route.php">                                                                                                          
						<input type="hidden" name="secret" value="'.$me.'" />                                                                                              
						<input type="hidden" name="admirer" value="'.$desire.'" />                                                                                         
            <input type="submit" name="addy_added" value="Add Me" />                                                                                           
            </form>';
  
  $reply = '<br />
  					<script type="text/javascript"> 
						function showPopup(url) 
						{
						  newwindow = window.open(url,\'name\',\'height=400px,width=700px,left=300px,resizable,scrollbars=yes\');
						  if (window.focus)
						  {
							newwindow.focus();
						  }
						}
						</script>
       		 		<a href="" onclick="showPopup(\''.get_option('siteurl').'/wp-content/themes/secretAddy/love_letter.php?ref='.$ref->reference.'\')">Reply</a>';                                                                                                                                          	

	$wpdb->insert( 'inbox', array( 'sentTo' => $desire, 'sentFrom' => $me, 'message' => stripslashes($message).$reply, 'subject' => 'Add Me Request', 'readMessage' => 'N', 'date' => date('m/d/Y'), 'delete1' => 'N', 'delete2' => 'Y' ) );                                                                                                         
    
    $receiver = $wpdb->get_row( $wpdb->prepare("SELECT ID, email FROM account WHERE secretAddy = '".$desire."' ") );
      
    $notify = $wpdb->get_row($wpdb->prepare("SELECT receive FROM notification WHERE ID = '".$receiver->ID."' ") ); 
	  
	  if ( $notify->receive == '0')
	  {
	  $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr> 
<td style="padding: 0; margin: 0;">
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">	
		<div style="width: 670px;">
			<p>
			Hello '.$desire.',<br><br><br>
      One of our Members has sent you a NEW Admirer Request in your Addy Mail! Your Admirer\'s Username is "'.$me.'".
			</p>
			<p>
			<a href="'.get_option('siteurl').'/messages/">Click here</a> to check out further details of this member and view your Addy Mail.
      </p>
		</div>
	</div>
</td> 
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />
	<p style="text-align: center;">
	<font size="1">Please do not reply back to this email.<br>
  If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?num='.$receiver->ID.'&notify=Admirer Request&element=message">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>';
				
	  $mail_to = "$receiver->email";
		$mail_subject = "Secret Addy Admirer Request"; 
		$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
		$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
		
		mail($mail_to, $mail_subject, $mail_body, $mail_header);
	  } 
                                                                                                                                                              
  	echo '	<script type="text/javascript">                                                                                                                    
						alert("Your request has been sent to '.$desire.'.");                                                                                
    					window.location = "'.$action.'";                                                                                                                         
						</script>';                                                                                                                                        
}                                                                                                                                                              
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This links you and your admirer. You can now chat, skype, and do                                                                                               
various other options with this admirer                                                                                                                        
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['addy_added']) )                                                                                                                             
{                                                                                                                                                              
	$secret = $_REQUEST['secret'];                                                                                                                               
	$admirer = $_REQUEST['admirer'];                                                                                                                             
  date_default_timezone_set('America/New_York');  
  
  $friend = $wpdb->get_row( $wpdb->prepare("SELECT   	friend 
																			FROM    		admirer 
																			WHERE   	(secretAddy = '".$secret."' 
																								AND admirer = '".$admirer."') 
																			OR      			(secretAddy = '".$admirer."' 
																								AND admirer = '".$secret."') ") );
																								
	if ( $friend->friend == 'Y')
	{
			echo '	<script type="text/javascript">                                                                                                                      
								alert("You are already friends with '.$secret.'.");                                                                                                    
								window.location = "'.get_option('siteurl').'/profile-page/";                                                                                              
								</script>';  
	}
	else
	{
			$wpdb->insert( 'admirer', array('secretAddy' => $secret, 'admirer' => $admirer, 'friend' => 'Y', 'fullProfile' => 'N' ) );                                                 
																																										 
			$wpdb->query( 'DELETE FROM inbox WHERE sentTo = "'.$admirer.'" AND sentFrom = "'.$secret.'" AND subject = "Add Me Request" ' );
		  
		  $email = $wpdb->get_row($wpdb->prepare("SELECT email, ID FROM account WHERE secretAddy = '".$secret."' ") ); 
		  
		  $notify = $wpdb->get_row($wpdb->prepare("SELECT addy FROM notification WHERE ID = '".$email->ID."' ") ); 
		  
		  if ( $notify->addy == '0')
		  {
		  $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">	
		<div style="width: 670px;">
			<p>'.$admirer.' has accepted your request to connect with them.</p>
		</div>
	</div>
</td>
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />
	<p style="text-align: center;">
	<font size="1">Please do not reply back to this email.<br>
  If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?num='.$email->ID.'&notify=Admirer Accepted&element=message">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>';
					
		  $mail_to = "$email->email";
			$mail_subject = "A new Connection"; 
			$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
			$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
			
			mail($mail_to, $mail_subject, $mail_body, $mail_header);
		  }                              
																																										 
		  echo '	<script type="text/javascript">                                                                                                                      
								alert("You are now friends with '.$secret.'.");                                                                                                    
								window.location = "'.get_option('siteurl').'/profile-page/";                                                                                             
								</script>'; 
	}
}                                                                                                                                                              
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This removes a friendship between to sercetAddy members.                                                                                                       
------------------------------------------------------------------*/                                                                                           
if ( isset($_GET['remove_desire']) )                                                                                                                          
{                                                                                                                                                              
	$me = $_GET['me'];                                                                                                                                       
	$desire = $_GET['desire'];                                                                                                                               
	                                                                                                                                                             
	$wpdb->query( 'DELETE FROM admirer WHERE (secretAddy = "'.$me.'" AND admirer = "'.$desire.'") OR (secretAddy = "'.$desire.'" AND admirer = "'.$me.'") ' );   
                                                                                                                                                               
  	echo '	<script type="text/javascript">                                                                                                                    
						alert("'.$desire.' is no longer an Admirer.");                                                                                        
							window.location = "'.get_option('siteurl').'/profile-page/";                                                                                                       
						</script>';                                                                                                                                        
}                                                                                                                                                              
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This sends a rose to the person whom you are admirering.                                                                                                       
------------------------------------------------------------------*/                                                                                           
if ( isset($_GET['send_rose']) )                                                                                                                              
{                                                                                                                                                              
	$me = $_GET['sentFrom'];                                                                                                                                 
	$desire = $_GET['sentTo'];                                                                                                                                
	$type = $_GET['type']; 
  	$name = $_GET['name'];   
  	$addy = $_GET['addy'];  
  	$website = $_GET['website'];
    $descript = $_GET['msg'];                                                                                                                            
    date_default_timezone_set('America/New_York');
  
  $checkCredit = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$me."' ") ); 
  
  if ( $checkCredit->amount == 0 || $checkCredit->amount < 2)
  {                                                                                                                                      
	   echo '	<script type="text/javascript">                                                                                                                    
						alert("You do not have enough credits to Send a '.strtoupper($type).'");                                                                                                
						window.location = "'.$website.'";                                                                                             
						</script>';  
  }                                                                                                          
  else
  {  
      $receiver = '';
      
      if ( $addy == '' )
      {
      		$receiver = $desire;
      }
      else
      {      
          $receiver = $addy;
      }
                   
      $member = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE secretAddy = '".$receiver."' ") );
      if ($member->secretAddy != $receiver)
      {
        echo '	<script type="text/javascript">                                                                                                                    
    				alert("The Secret Addy name you entered is incorrect.\nPlease try again.");                                                                                          
    				window.location = "'.$website.'";                                                                                                    
    				</script>';  
      }
      else
      {    
        if ( !empty($descript) )
        {
          $descript .= '<br><br>
                       <p>
                       <img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/store/'.$name.'" alt="'.$name.'" title="'.$name.'" />
                       </p>';
      
          $subtract = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$me."' ") ); 
      	  
      	  $renew = $subtract->amount - 5;
      	  
      	  $wpdb->update( 'credits', array( 'amount' => $renew ), array( 'secretAddy' => $me )); 
      	  
      	  $admirer = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM account WHERE secretAddy = '".$me."' ") );
          $num = $wpdb->get_row( $wpdb->prepare("SELECT reference FROM randomID WHERE ID = ".$admirer->ID) );
          
          $reply = '<br />
          					<script type="text/javascript"> 
        						function showPopup(url) 
        						{
        						  newwindow = window.open(url,\'name\',\'height=400px,width=700px,left=300px,resizable,scrollbars=yes\');
        						  if (window.focus)
        						  {
        							newwindow.focus();
        						  }
        						}
        						</script>
               		 		<a href="" onclick="showPopup(\''.get_option('siteurl').'/wp-content/themes/secretAddy/love_letter.php?ref='.$num->reference.'&sub=RE: You Have A Gift\')">Reply</a>';
           		 		
          $wpdb->insert( 'inbox', array( 'sentTo' => $receiver, 'sentFrom' => $me, 'message' => stripslashes($descript).$reply, 'subject' => 'You Have A Gift', 'readMessage' => 'N', 'date' => date('m/d/Y'), 'delete1' => 'N', 'delete2' => 'N' ) );
        }
        else
        {                                               
          $wpdb->insert( 'roses', array('sentTo' => $receiver, 'sentFrom' => $me, 'type' => $type, 'name' => $name ) );
          
          $sentRoses = 'You have sent a '.strtoupper($type).' to '.$receiver;
          
          $wpdb->insert( 'inbox', array( 'sentTo' => $receiver, 'sentFrom' => $me, 'message' => stripslashes($sentRoses), 'subject' => strtoupper($type).' Sent', 'readMessage' => 'Y', 'date' => date('m/d/Y'), 'delete1' => 'Y', 'delete2' => 'N' ) );
        }
          
          
          $reduce = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$me."' ") ); 
          
          $newPrice = $reduce->amount - 2;
          
          $wpdb->update( 'credits', array( 'amount' => $newPrice ), array( 'secretAddy' => $me ));
          
          $email = $wpdb->get_row($wpdb->prepare("SELECT email, ID FROM account WHERE secretAddy = '".$receiver."' ") );
          
          $notify = $wpdb->get_row($wpdb->prepare("SELECT rose FROM notification WHERE ID = '".$email->ID."' ") ); 
          
          $newGuy = $wpdb->get_row($wpdb->prepare("SELECT ID FROM account WHERE secretAddy = '".$me."' ") );
          
          $ref = $wpdb->get_row($wpdb->prepare("SELECT reference FROM randomID WHERE ID = '".$newGuy->ID."' ") ); 
          
          if ( $notify->rose == '0')
          { 
          $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr>  
<td style="padding: 0; margin: 0;">
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">	
		<div style="width: 670px;">
        			<p>
        			'.$me.' from <a href="'.get_option('siteurl').'">Secret Addy.com</a> wants to present you this <a href="'.get_option('siteurl').'/'.$type.'-results/">'.strtoupper($type).'</a>.
        			</p>
        			<p>
        			<a href="'.get_option('siteurl').'/admirer/?ref='.$ref->reference.'">Click here</a> to learn more about SecretAddy and '.$me.'!
        			</p>
		</div>
	</div>
</td>  
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />
	<p style="text-align: center;">
	<font size="1">Please do not reply back to this email.<br>
  If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?num='.$email->ID.'&notify=Roses&element=rose">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>';
        			
          $mail_to = "$email->email";
        	$mail_subject = "You have a new ".strtoupper($type); 
        	$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
        	$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
        	
        	mail($mail_to, $mail_subject, $mail_body, $mail_header);
          }                             
        	                                                                                                                                                             
        	if ( $type == 'rose' )
        	{
        	echo '	<script type="text/javascript">                                                                                                                      
        						alert("Your '.$type.' has been sent to '.$receiver.'.");  
                    window.location = "'.$website.'";                                                                                                                 
        						</script>';  
        	}
        	else
        	{
        	echo '	<script type="text/javascript">                                                                                                                      
        						alert("Your '.$type.' has been sent to '.$receiver.'.");                                                                                                  
        						window.close();
        						</script>';  
        	}
    	}
	}
}                                                                                                                                                                  
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This adds a photo to the users photo area.                                                                                                                     
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['upload_photo']) )                                                                                                                           
{                                                                                                                                                              
	$type = $_REQUEST['photoType'];                                                                                                                              
	$me = $_REQUEST['myself'];                                                                                                                                   
  date_default_timezone_set('America/New_York');                                                                                                               
	                                                                                                                                                             
	$file = $_FILES['image'] ['name'];                                                                                                                           
		                                                                                                                                                           
	if ( $file == NULL )                                                                                                                                         
	{                                                                                                                                                            
		echo '	<script type="text/javascript">                                                                                                                    
					alert("You have not choosen an image yet.\nPlease do so before proceeding.");                                                                        
					window.location = "'.get_option('siteurl').'/photos/upload/";                                                                                                 
					</script>';                                                                                                                                          
	}                                                                                                                                                            
  else                                                                                                                                                         
  {                                                                                                                                                            
      move_uploaded_file ($_FILES['image'] ['tmp_name'],                                                                                                       
			 ABSPATH."wp-content/themes/secretAddy/profilePhotos/".$me."/".$type."/{$_FILES['image'] ['name']}");                                                    
	                                                                                                                                                             
     $wpdb->insert( $type.'Photo', array('secretAddy' => $me, 'image' => $_FILES['image'] ['name'] ) );                                                                      
	                                                                                                                                                             
	   echo '	<script type="text/javascript">                                                                                                                    
					alert("Your photo has been uploaded.");                                                                                                              
					window.location = "'.get_option('siteurl').'/photos/private/";                                                                                                 
					</script>';                                                                                                                                          
  }                                                                                                                                                            
	                                                                                                                                                             
}                                                                                                                                                                
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This adds a photo to the users profile photo.                                                                                                                     
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['upload_pro']) )                                                                                                                           
{                                                                                                                                                              
	$me = $_REQUEST['myself'];                                                                                                                                   
  date_default_timezone_set('America/New_York'); 
  
  $public = mysql_query("SELECT ID FROM profilePhoto WHERE secretAddy = '".$me."' ");                                                                                                              
	                                                                                                                                                             
	$file = $_FILES['profile'] ['name'];                                                                                                                           
		                                                                                                                                                           
	if ( $file == NULL )                                                                                                                                         
	{                                                                                                                                                            
		echo '	<script type="text/javascript">                                                                                                                    
					alert("You have not choosen an image yet.\nPlease do so before proceeding.");                                                                                                    
					</script>';                                                                                                                                          
	}                                                                                                                                                            
  else                                                                                                                                                         
  {   
      while ( $photos = mysql_fetch_assoc( $public ) )
			{                                                                                                                                                         
          $wpdb->update( 'profilePhoto', array( 'profile' => 'N' ), array( 'secretAddy' => $me ));
      }
     
      move_uploaded_file ($_FILES['profile'] ['tmp_name'],                                                                                                       
			 ABSPATH."wp-content/themes/secretAddy/profilePhotos/".$me."/profile/{$_FILES['profile'] ['name']}");                                                    
	                                                                                                                                                             
     $wpdb->insert( 'profilePhoto', array( 'secretAddy' => $me, 'image' => $_FILES['profile'] ['name'], 'profile' => 'Y' ) );                                           
	                                                                                                                                                             
	   echo '	<script type="text/javascript">                                                                                                                    
					alert("Your Profile image has been uploaded.");                                                                                       
								window.location = "'.get_option('siteurl').'/profile-page/";                                                                                                          
					</script>';                                                                                                                                          
  }                                                                                                                                                            
	                                                                                                                                                             
}                                                                                                                                                              
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This activates your profile.                                                                                                      
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['submit_activate']) )                                                                                                                          
{                                                                                                                                                              
	$activate = $_REQUEST['activate'];                                                                                                           
  date_default_timezone_set('America/New_York');
  
  $theID = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM randomID WHERE reference = '".$activate."' ") );
  $user = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = '".$theID->ID."' ") );                                                                                                                           
	                                                                                                                                                             
	$wpdb->update( 'randomID', array('confirm' => 'Y' ), array('reference' => $activate) );                   
  
  $message = 'Hello '.$user->secretAddy.',
            <p>Welcome to Secret Addy, where we\'ve changed the dating game!</p><br />
            <p>Here are some things you can do to make yourself connectable with other members:</p>                                                                                                                                              
						<p>1.) Upload a Profile Image.</p>                                                                                                                                              
						<p>2.) Update your Profile.</p>
            <p>3.) Update your Privacy Settings.</p>
            <p>4.) Enter your Security Question.</p><br />
            <p>How to find an admirer:</p>                                                                                                                                              
						<p>1.) <a href="'.get_option('siteurl').'/connect/character">Click here</a> to connect with others.</p>                                                                                                                                              
						<p>2.) You can connect with someone you know who isn\'t a Secret Addy member, send them a message for them to become a secret Addy member.</p>
            <p>3.) You can connect with a Secret Addy member if you know their SecretAddy Name.</p><br>
            <p>We here at Secret Addy hope you enjoy your experience with us. </p>';                                                                                                                                          	

	$wpdb->insert( 'inbox', array( 'sentTo' => $user->secretAddy, 'sentFrom' => 'Secret Addy', 'message' => $message, 'subject' => 'Welcome', 'readMessage' => 'N', 'date' => date('m/d/Y'), 'delete1' => 'N', 'delete2' => 'Y' ) ); 
	
	$ID = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM account WHERE secretAddy = '".$user->secretAddy."' ") );
      
    $wpdb->update( 'account', array( 'online' => 'Y' ), array( 'ID' => $ID->ID ) );                                                        
  			  			                                                                                                                                               
	$_SESSION['secretID'] = $ID->ID;
                                                                                                                                                               
  	echo '	<script type="text/javascript">                                                                                                                    
						alert("You are now an active member of Secret Addy.");                                                                                       
								window.location = "'.get_option('siteurl').'/profile-page/";                                                                                            
						</script>';                                                                                                                                        
}                                                                                                                                                         
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
Updates Addy Wall Pos.                                                                                                                
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['edit_wall']) )                                                                                                                            
{                                                                                                                                                              
	$to = $_REQUEST['to'];                                                                                                                                         
	$from = $_REQUEST['from'];                                                                                                                                     
	$wall = $_REQUEST['wall'];                                                                                                                                    
	$address = $_REQUEST['address'];	                                                                                                                             
  date_default_timezone_set('America/New_York');                                                                                                               	
                                                                                                                                                               
	$wpdb->insert( 'addyPosts', array( 'sentTo' => $to, 'sentFrom' => $from, 'post' => stripslashes($wall) ) );                                                                	
  
  $receiver = $wpdb->get_row( $wpdb->prepare("SELECT ID, email FROM account WHERE secretAddy = '".$to."' ") );
      
  $notify = $wpdb->get_row($wpdb->prepare("SELECT post FROM notification WHERE ID = '".$receiver->ID."' ") ); 
  
  if ( $notify->post == '0')
  {
  $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">	
		<div style="width: 670px;">
			<p>
			Hello '.$to.',<br><br><br>
      One of our Members has sent you a NEW Addy Wall Post! Your Admirer\'s Username is "'.$from.'".
			</p>
			<p>
			<a href="'.get_option('siteurl').'/addy-wall/">Click here</a> to check out further details of this member and view your Addy Wall.
      </p>
		</div>
	</div>
</td> 
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />
	<p style="text-align: center;">
	<font size="1">Please do not reply back to this email.<br>
  If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?num='.$receiver->ID.'&notify=Addy Wall&element=post">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>';
			
  $mail_to = "$receiver->email";
	$mail_subject = "Secret Addy - Addy Wall Post"; 
	$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
	$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
	
	mail($mail_to, $mail_subject, $mail_body, $mail_header);
  }     
                                                                                                                                                           
  wp_redirect(get_option('siteurl').'/wall-results?ref='.$address);                                                                                                               
}                                                                                                                                                             
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This sends a message to your friends.                                                                                                                   
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['send_friends']) )                                                                                                                           
{                                                                                                                                                              
	$friend1 = $_REQUEST['friend1'];
  $friend2 = $_REQUEST['friend2'];
  $friend3 = $_REQUEST['friend3'];
  $friend4 = $_REQUEST['friend4'];
  $friend5 = $_REQUEST['friend5'];
  $email = $_REQUEST['me'];                                                                                                                            
                                                                                                                                                               
	$msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr>  
<td style="padding: 0; margin: 0;">
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">	
		<div style="width: 670px;">
			<p>
				Your friend with the email address: '.$email.' has an account on <a href="'.get_option('siteurl').'">Secret Addy.com</a>. They want you to Join <a href="'.get_option('siteurl').'">SecretAddy</a>.
			</p>
			<p>
				Everyone has a secret crush!!! Everyone wants to know who secretly wants, desires, and fanatizes about them!
			</p>
			<p>
				JOIN <a href="'.get_option('siteurl').'">SECRETADDY.COM</a> TODAY and receive 200 Addy Credits for FREE!
			</p>
		</div>
	</div>
</td> 
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />
  ';
	
	$end1 = '<p style="text-align: center;">
	<font size="1">If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?lone='.$friend1.'">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>';  
	
	$end2 = '<p style="text-align: center;">
	<font size="1">If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?lone='.$friend2.'">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>'; 
	
	$end3 = '<p style="text-align: center;">
	<font size="1">If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?lone='.$friend3.'">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>'; 
	
	$end4 = '<p style="text-align: center;">
	<font size="1">If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?lone='.$friend4.'">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>'; 
	
	$end5 = '<p style="text-align: center;">
	<font size="1">If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?lone='.$friend5.'">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>'; 

  $removal = $wpdb->get_row( $wpdb->prepare("SELECT email FROM unsubscribe WHERE email = '".$friend1."' ") );
  $removal2 = $wpdb->get_row( $wpdb->prepare("SELECT email FROM unsubscribe WHERE email = '".$friend2."' ") );
  $removal3 = $wpdb->get_row( $wpdb->prepare("SELECT email FROM unsubscribe WHERE email = '".$friend3."' ") );
  $removal4 = $wpdb->get_row( $wpdb->prepare("SELECT email FROM unsubscribe WHERE email = '".$friend4."' ") );
  $removal5 = $wpdb->get_row( $wpdb->prepare("SELECT email FROM unsubscribe WHERE email = '".$friend5."' ") );
  
  if ( $removal->email != $friend1 )
  { 	
    $mail_to = "$friend1";
  	$mail_subject = "Join Secret Addy"; 
  	$mail_body = "<html><body>".stripslashes($msg).$end1."</body></html>";
  	$mail_header = "From: $email\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
  	
  	mail($mail_to, $mail_subject, $mail_body, $mail_header);
  }
  
  if ( $removal2->email != $friend2 )
  { 	
    $mail_to = "$friend2";;
  	$mail_subject = "Join Secret Addy"; 
  	$mail_body = "<html><body>".stripslashes($msg).$end2."</body></html>";
  	$mail_header = "From: $email\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
  	
  	mail($mail_to, $mail_subject, $mail_body, $mail_header);
  }
  
  if ( $removal3->email != $friend3 )
  { 	
    $mail_to = "$friend3";
  	$mail_subject = "Join Secret Addy"; 
  	$mail_body = "<html><body>".stripslashes($msg).$end3."</body></html>";
  	$mail_header = "From: $email\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
  	
  	mail($mail_to, $mail_subject, $mail_body, $mail_header);
  }
  
  if ( $removal4->email != $friend4 )
  { 	
    $mail_to = "$friend4";
  	$mail_subject = "Join Secret Addy"; 
  	$mail_body = "<html><body>".stripslashes($msg).$end4."</body></html>";
  	$mail_header = "From: $email\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
  	
  	mail($mail_to, $mail_subject, $mail_body, $mail_header);
  }
  
  if ( $removal5->email != $friend5 )
  { 	
    $mail_to = "$friend5";
  	$mail_subject = "Join Secret Addy"; 
  	$mail_body = "<html><body>".stripslashes($msg).$end5."</body></html>";
  	$mail_header = "From: $email\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
  	
  	mail($mail_to, $mail_subject, $mail_body, $mail_header);
  }
  
  echo '	<script type="text/javascript">                                                                                                                      
								alert("Your email(s) have been sent to your friend(s).");                                                                                        
								window.location = "'.get_option('siteurl').'/tell-friends/";                                                                                              
								</script>';                                                                                                                                                       
	                                                                                                                                                             
}                                                                                                                                                              
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
User can choose which notifications to have sent to
their email
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['save_notification']) )                                                                                                                           
{                                                                                                                                                              
	$id = $_REQUEST['id'];                                                                                                                                       
	$rose = $_REQUEST['rose'];                                                                                                                               
	$addy = $_REQUEST['addy'];                                                                                                                               
	$message = $_REQUEST['message'];                                                                                                                               
	$receive = $_REQUEST['receive'];                                                                                                                               
	$post = $_REQUEST['post'];                                                                                                                               
	$bouquet = $_REQUEST['bouquet'];                                                                                                                        
	$love = $_REQUEST['love'];                                                                                                                                      
                                                                                                                                                               
    $wpdb->update( 'notification', array( 'rose' => $rose, 'addy' => $addy, 'message' => $message, 'receive' => $receive, 'post' => $post, 'bouquet' => $bouquet, 'love' => $love ), array( 'ID' => $id ) );       
    
    echo '	<script type="text/javascript">                                                                                                                    
							alert("Your Notification Settings have been saved.");                                                                                        
								window.location = "'.get_option('siteurl').'/privacy/notifications/";                                                                                                                   
							</script>';                                                                                                                                      
}                                                                                                                                                               
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
User can change their primary profile image                                                                                                            
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['submit_primary']) )                                                                                                                           
{                                                                                                                                                              
    $photo = $_REQUEST['photo'];                                                                                                                                       
    $id = $_REQUEST['id'];                                                                                                                                     
    $me = $_REQUEST['me'];                                                                                                                                          
    
    $public = mysql_query("SELECT ID FROM profilePhoto WHERE secretAddy = '".$me."' ");
    
    while ( $photos = mysql_fetch_assoc( $public ) )
    {                                                                                                                                                         
        $wpdb->update( 'profilePhoto', array( 'profile' => 'N' ), array( 'secretAddy' => $me ));
    }
                                                                                                                                                               
    $wpdb->update( 'profilePhoto', array( 'image' => $photo, 'profile' => 'Y' ), array( 'ID' => $id ) );       
    
    echo '	<script type="text/javascript">                                                                                                                    
    				alert("Your Profile Image has been changed.");                                                                                       
								window.location = "'.get_option('siteurl').'/photos/";                                                                                                            
    				</script>';                                                                                                                                      
}                                                                                                                                                              
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This sends an inbox message for a bouquet of roses                                                                                                                        
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['submit_bouquet']) )                                                                                                                             
{                                                                                                                                                              
	$secret = $_REQUEST['admir'];                                                                                                                               
	$me = $_REQUEST['sentFrom'];                                                                                                                             
  date_default_timezone_set('America/New_York'); 
  
  $checkCredit = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$me."' ") ); 
  
  if ( $checkCredit->amount == 0 || $checkCredit->amount < 5)
  {                                                                                                                                      
	   echo '	<script type="text/javascript">                                                                                                                    
						alert("You do not have enough credits to Send a Bouquet of Roses");                                                                                                
						window.close();                                                                                             
						</script>';  
  }
  else
  {                                                                                                
      $addy = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM account WHERE secretAddy = '".$me."' ") );
      $ref = $wpdb->get_row( $wpdb->prepare("SELECT reference FROM randomID WHERE ID = ".$addy->ID) );                             
    	
    	$friend = $wpdb->get_row( $wpdb->prepare("SELECT   	ID, fullProfile 
    																			FROM    		admirer 
    																			WHERE   	(secretAddy = '".$secret."' 
    																								AND admirer = '".$me."') 
    																			OR      			(secretAddy = '".$me."' 
    																								AND admirer = '".$secret."') ") );
    																								
    	$message = 'I\'m giving you this Bouquet of Roses as a sign that I would like to see your Photos. Click on my name, <a href="'.get_option('siteurl').'/admirer/?ref='.$ref->reference.'" title="'.$me.'">'.$me.'</a>, to view my Profile images. If you like what you see, accept my request.<br />
    	          <img src="'.get_bloginfo('template_directory').'/images/bouquet.jpg" />
    						<form method="post" action="/wp-content/themes/secretAddy/route.php">                                                                                                          
    						<input type="hidden" name="me" value="'.$me.'" />                                                                                              
    						<input type="hidden" name="admirer" value="'.$secret.'" />                                                                                         
    						Do You Wish To?<br />
                <input type="submit" name="get_profile" value="Accept" /><input type="submit" name="refuse_profile" value="Deny" />                                                                                           
    						</form>'; 
                
      $reply = '<br />
      					<script type="text/javascript"> 
    						function showPopup(url) 
    						{
    						  newwindow = window.open(url,\'name\',\'height=400px,width=700px,left=300px,resizable,scrollbars=yes\');
    						  if (window.focus)
    						  {
    							newwindow.focus();
    						  }
    						}
    						</script>
           		 		<a href="" onclick="showPopup(\''.get_option('siteurl').'/wp-content/themes/secretAddy/love_letter.php?ref='.$ref->reference.'\')">Reply</a>';                                                                                                                                         	
    	
    	$wpdb->insert( 'inbox', array( 'sentTo' => $secret, 'sentFrom' => $me, 'message' => stripslashes($message).$reply, 'subject' => 'Bouquet of Roses', 'readMessage' => 'N', 'date' => date('m/d/Y'), 'delete1' => 'N', 'delete2' => 'Y' ) );
      
      $wpdb->update( 'admirer', array('halfProfile' => 'Y', 'sentTo' => $secret ), array( 'ID' => $friend->ID) );  
    	
    	$receiver = $wpdb->get_row( $wpdb->prepare("SELECT ID, email FROM account WHERE secretAddy = '".$secret."' ") );
          
      $notify = $wpdb->get_row($wpdb->prepare("SELECT bouquet FROM notification WHERE ID = '".$receiver->ID."' ") ); 
      
      if ( $notify->bouquet == '0')
      {
      $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr> 
<td style="padding: 0; margin: 0;">
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">	
		<div style="width: 670px;">
    			<p>
    			'.$me.' from <a href="'.get_option('siteurl').'">Secret Addy.com</a> wants to present you this BOUQUET which grants you access to their <a href="'.get_option('siteurl').'/admirer?ref='.$ref->reference.'" title="Full Profile">Full Profile</a>. 
    			</p>
    			<p>
    			<img src="'.get_bloginfo('template_directory').'/images/bouquet.jpg" />
    			</p>
    			<p>
    			<a href="'.get_option('siteurl').'/messages/">Click here</a> to check it out!
    			</p>
		</div>
	</div>
</td>
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />
	<p style="text-align: center;">
	<font size="1">Please do not reply back to this email.<br>
  If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?num='.$receiver->ID.'&notify=Bouquet of Roses&element=bouquet">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>';
    			
      $mail_to = "$receiver->email";
    	$mail_subject = "Secret Addy Bouquet of Roses"; 
    	$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
    	$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
    	
    	mail($mail_to, $mail_subject, $mail_body, $mail_header);
      }
      
    	echo '	<script type="text/javascript">                                                                                                                      
    						alert("Your Bouquet has been sent to '.$secret.'.");                                                                                                    
    						window.close();                                                                                             
    						</script>';
  } 
}                                                                                                                                                               
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This accepts the bouquet of roses                                                                                                                        
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['get_profile']) )                                                                                                                             
{                                                                                                                                                              
	$secret = $_REQUEST['admirer'];                                                                                                                               
	$me = $_REQUEST['me'];                                                                                                                             
  date_default_timezone_set('America/New_York');                           
	
	$friend = $wpdb->get_row( $wpdb->prepare("SELECT   	ID, fullProfile 
																			FROM    		admirer 
																			WHERE   	(secretAddy = '".$secret."' 
																								AND admirer = '".$me."') 
																			OR      			(secretAddy = '".$me."' 
																								AND admirer = '".$secret."') ") );

	if ( $friend->fullProfile == 'Y')
	{
			echo '	<script type="text/javascript">                                                                                                                      
								alert("You and '.$me.' already have access to each others Full Profile.");                                                                                                    
								window.location = "'.get_option('siteurl').'/messages"                                                                                              
								</script>';  
	}
	else
	{
		$wpdb->update( 'admirer', array('fullProfile' => 'Y', 'halfProfile' => 'N' ), array( 'ID' => $friend->ID) );
	  
		$wpdb->query( 'DELETE FROM inbox WHERE sentTo = "'.$secret.'" AND sentFrom = "'.$me.'" AND subject = "Bouquet of Roses" ' ); 
		
		$email = $wpdb->get_row($wpdb->prepare("SELECT email, ID FROM account WHERE secretAddy = '".$me."' ") );
  
	  $reduce = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$me."' ") );
	  
	  $newPrice = $reduce->amount - 5;
	  
	  $wpdb->update( 'credits', array( 'amount' => $newPrice ), array( 'secretAddy' => $me ));
  
    $notify = $wpdb->get_row($wpdb->prepare("SELECT bouquet FROM notification WHERE ID = '".$email->ID."' ") ); 
    
    if ( $notify->bouquet == '0')
    {
    $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">	
		<div style="width: 670px;">
			<p>CONGRATULATIONS!<br><br><br>
      '.$secret.' has accepted your <b>Bouquet of Roses</b>. You both now have access to each other\'s Full Profile.</p>
      <p><a href="'.get_option('siteurl').'">Log in</a> to your account to continue connecting!</p>
		</div>
	</div>
</td>  
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />
	<p style="text-align: center;">
	<font size="1">Please do not reply back to this email.<br>
  If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?num='.$email->ID.'&notify=Bouquet of Roses&element=bouquet">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>';
  			
    $mail_to = "$email->email";
  	$mail_subject = "Bouquet of Roses Accepted"; 
  	$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
  	$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
  	
  	mail($mail_to, $mail_subject, $mail_body, $mail_header);
    } 
		
		echo '	<script type="text/javascript">                                                                                                                      
							alert("'.$me.' can now view your Full Profile.");                                            
						window.location = "'.get_option('siteurl').'/profile-page/";                                                                                     
							</script>';
	}
}                                                                                                                                                                 
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This denies the bouquet of roses                                                                                                                        
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['refuse_profile']) )                                                                                                                             
{                                                                                                                                                              
	$secret = $_REQUEST['admirer'];                                                                                                                               
	$me = $_REQUEST['me'];                                                                                                                             
  date_default_timezone_set('America/New_York');                             
	
	$friend = $wpdb->get_row( $wpdb->prepare("SELECT   	ID 
																			FROM    		admirer 
																			WHERE   	(secretAddy = '".$secret."' 
																								AND admirer = '".$me."') 
																			OR      			(secretAddy = '".$me."' 
																								AND admirer = '".$secret."') ") );

	$wpdb->update( 'admirer', array('halfProfile' => 'N' ), array( 'ID' => $friend->ID) );
  
	$wpdb->query( 'DELETE FROM inbox WHERE sentTo = "'.$secret.'" AND sentFrom = "'.$me.'" AND subject = "Bouquet of Roses" ' ); 
	
	echo '	<script type="text/javascript">                                                                                                                      
						alert("You have refused '.$me.'\'s Bouquet of Roses Request.");                                            
					window.location = "'.get_option('siteurl').'/profile-page/";                                                                                     
						</script>';
}                                                                                                                                                          
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This deletes your chat session with a person.                                                                                                            
------------------------------------------------------------------*/                                                                                           
if ( isset($_GET['logoff']) )                                                                                                                            
{                              
  $check = $_GET['chatID'];  
  $user = $_GET['user'];
  
  $wpdb->insert( 'chatMessage', array( 'username' => $user, 'message' => $user.' has left the chat', 'chatID' => $check ) );                                                                                                                                                                               
                                                                                                                                                               
  $remove = $wpdb->get_row($wpdb->prepare( "SELECT ID, user1, user2, delete1, delete2 FROM chatBuddies WHERE chatID = '".$check."' ") );
   
  if ( $remove->user1 == $user)                                                                                                     
  {                                                                                                                                                            
    $wpdb->update( 'chatBuddies', array( 'delete1' => 'Y'), array( 'chatID' => $check) );                
    $wpdb->update( 'chatBuddies', array( 'delete2' => 'Y'), array( 'chatID' => $check) );
  } 
  else                                                                                                      
  {                                                                                                                                                            
    $wpdb->update( 'chatBuddies', array( 'delete2' => 'Y'), array( 'chatID' => $check) );                
    $wpdb->update( 'chatBuddies', array( 'delete1' => 'Y'), array( 'chatID' => $check) );
  }
                                                                                                                                                               
  echo '	<script type="text/javascript">                                                                                                                      
							alert("You have left the chat.");                                            
						window.close();                                                                                     
							</script>';                                                                                                              
}                                                                                                                                                         
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This deletes your rose.                                                                                                            
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['remove_rose']) )                                                                                                                            
{                              
  $id = $_REQUEST['id'];    
  $type = $_REQUEST['type'];
  
  $wpdb->query( 'DELETE FROM roses WHERE ID = '.$id );                                                                                                                                                            
                                                                                                                                                               
  echo '	<script type="text/javascript">                                                                                                                      
							alert("Your '.$type.' has been deleted.");                                                                                       
								window.location = "'.get_option('siteurl').'/wp-acontent/themes/secretAddy/rose-results.php";                                                                                     
							</script>';                                                                                                              
}                                                                                                                                                          
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This deletes your account.                                                                                                            
------------------------------------------------------------------*/                                                                                           
function rmdir_rec($dir)
{
  $dir .= (substr($dir,0,-1) == '/') ? '' : '/';
  $skipFiles=array('.','..');
  
  foreach (scandir($dir) as $file)
  {
    if(in_array($file,$skipFiles) === false)
    {
      if(is_dir($dir.$file)) rmdir_rec($dir.$file);
      (is_dir($dir.$file)) ? rmdir($dir.$file) : unlink($dir.$file);
    }
  }
}

if ( isset($_POST['del_account']) )                                                                                                                            
{                              
  $id = $_REQUEST['id'];       
  $me = $_REQUEST['me'];  
  
  $wpdb->query( 'DELETE FROM account WHERE ID = '.$id );
  $wpdb->query( 'DELETE FROM privacy WHERE ID = '.$id );
  $wpdb->query( 'DELETE FROM interests WHERE ID = '.$id );
  $wpdb->query( 'DELETE FROM statuses WHERE ID = '.$id );
  $wpdb->query( 'DELETE FROM notification WHERE ID = '.$id );
  $wpdb->query( 'DELETE FROM security WHERE ID = '.$id );    
  $wpdb->query( 'DELETE FROM credits WHERE ID = '.$id );   
  $wpdb->query( 'DELETE FROM addyPosts WHERE sentTo = "'.$me.'" ' );  
  $wpdb->query( 'DELETE FROM addyPosts WHERE sentFrom = "'.$me.'" ' );
  $wpdb->query( 'DELETE FROM roses WHERE sentTo = "'.$me.'" ' );  
  $wpdb->query( 'DELETE FROM roses WHERE sentFrom = "'.$me.'" ' );     
  $wpdb->query( 'DELETE FROM profilePhoto WHERE secretAddy = "'.$me.'" ' ); 
  $wpdb->query( 'DELETE FROM publicPhoto WHERE secretAddy = "'.$me.'" ' );
  $wpdb->query( 'DELETE FROM admirer WHERE secretAddy = "'.$me.'" ' );  
  $wpdb->query( 'DELETE FROM admirer WHERE admirer = "'.$me.'" ' ); 
  $wpdb->query( 'DELETE FROM inbox WHERE sentTo = "'.$me.'" ' );  
  $wpdb->query( 'DELETE FROM inbox WHERE sentFrom = "'.$me.'" ' );  
  $wpdb->update( 'randomID', array('confirm' => 'N' ), array( 'ID' => $id) );
  
  rmdir_rec(ABSPATH."wp-content/themes/secretAddy/profilePhotos/".$me);
  rmdir(ABSPATH."wp-content/themes/secretAddy/profilePhotos/".$me);
  session_destroy();                                                                                                                                                            
                                                                                                                                                               
  echo '	<script type="text/javascript">                                                                                                                      
						alert("Your Account has been deleted.");                                                                                       
								window.location = "'.get_option('siteurl').'/";                                                                                          
					</script>';                                                                                                              
}                                                                                                                                                          
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This deletes your profile photos.                                                                                                            
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['del_confirm']) )                                                                                                                            
{    
  $id = $_REQUEST['id'];         
  $me = $_REQUEST['me']; 
  $photo = $_REQUEST['photo'];       
  $type = $_REQUEST['photoType'];    
  $website = $_REQUEST['website'];
                            
  echo '	<script type="text/javascript">          
            var answer = confirm("Do you want to delete this image?");
            if (answer)
            {
            	var url="'.$website.'?type='.$type.'&id='.$id.'&me='.$me.'&photo='.$photo.'&website='.$website.'";
            	window.open(url, "_self");
            }
            else
            {                                 
						  window.location = "'.$website.'";
            }                                                                                                                                               
					</script>';                                                                                                              
}                                                                                                                                                        
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This deletes your profile photos.                                                                                                            
------------------------------------------------------------------*/                                                                                           
if ( isset($_GET['type']) )                                                                                                                            
{        
  $id = $_GET['id'];         
  $me = $_GET['me']; 
  $photo = $_GET['photo'];       
  $website = $_GET['website'];                      
  
  if( $_GET['type'] == 'profile' )
  {     
      $wpdb->query( 'DELETE FROM profilePhoto WHERE ID = '.$id );
      
      unlink(ABSPATH."wp-content/themes/secretAddy/profilePhotos/".$me."/profile/".$photo);         

  	  wp_redirect($website);
  }
  elseif( $_GET['type'] == 'photos' )
  {
    $wpdb->query( 'DELETE FROM publicPhoto WHERE ID = '.$id );
    
    unlink(ABSPATH."wp-content/themes/secretAddy/profilePhotos/".$me."/public/".$photo);         
    
  	wp_redirect($website);
  }
                                                                                                               
}                                                                                                                                                                
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This sends a message to an admirer of yours.                                                                                                                   
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['send_letter']) )                                                                                                                           
{                                                                                                                                                              
	$admirer = $_REQUEST['admir'];                                                                                                                               
	$subject = $_REQUEST['subject'];                                                                                                                             
	$msg = $_REQUEST['msg'];                                                                                                                                     
	$sender = $_REQUEST['sentFrom'];
  $website = $_REQUEST['website'];                                                                                                                             
	$toy = $_REQUEST['toy'];                                                                                                                             
  date_default_timezone_set('America/New_York');
  
  $checkCredit = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$sender."' ") ); 
  
  if ( $checkCredit->amount == 0 || $checkCredit->amount < 5)
  {                                                                                                                                      
	   echo '	<script type="text/javascript">                                                                                                                    
						alert("You do not have enough credits to Pass A Note");                                                                                                
						window.location = "'.$website.'";                                                                                             
						</script>';  
  }
  else
  { 
      $addy = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM account WHERE secretAddy = '".$sender."' ") );
      $ref = $wpdb->get_row( $wpdb->prepare("SELECT reference FROM randomID WHERE ID = ".$addy->ID) );
      
      $reply = '<br />
      					<script type="text/javascript"> 
    						function showPopup(url) 
    						{
    						  newwindow = window.open(url,\'name\',\'height=400px,width=700px,left=300px,resizable,scrollbars=yes\');
    						  if (window.focus)
    						  {
    							newwindow.focus();
    						  }
    						}
    						</script>
           		 		<a href="" onclick="showPopup(\''.get_option('siteurl').'/wp-content/themes/secretAddy/love_letter.php?ref='.$ref->reference.'&sub=RE: '.$subject.'\')">Reply</a>';
      
      if ( empty($subject) )
      {
        $subject = 'No Subject';
      }
                                                                                                                                                                   
    	if( empty($admirer) )                                                                                                                                        
    	{                                                                                                                                                            
    	   echo '	<script type="text/javascript">                                                                                                                    
    						alert("You have no Admirers to send a message to");                                                                                                
    						window.location = "'.$website.'";                                                                                             
    						</script>';                                                                                                                                        
      }                                                                                                                                                            
      elseif( empty($msg) )                                                                                                                     
    	{                                                                                                                                                            
    	   echo '	<script type="text/javascript">                                                                                                                    
    						alert("You have to fill in a message");                                                                                            
    						window.location = "'.$website.'";                                                                                             
    						</script>';                                                                                                                                        
      }                                                                                                                                                            
      else                                                                                                                                                         
      {    
        if ( !empty($toy) )
        {
          $msg .= '<br><br>
                   <p>
                   <img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/store/'.$toy.'" alt="'.$toy.'" title="'.$toy.'" />
                   </p>';
      
      	  $subtract = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$sender."' ") );
      	  
      	  $renew = $subtract->amount - 2;
      	  
      	  $wpdb->update( 'credits', array( 'amount' => $renew ), array( 'secretAddy' => $sender ));
        } 
                                                                                                                                                                
        $wpdb->insert( 'inbox', array( 'sentTo' => $admirer, 'sentFrom' => $sender, 'message' => stripslashes($msg).$reply, 'subject' => stripslashes($subject), 'readMessage' => 'N', 'date' => date('m/d/Y'), 'delete1' => 'N', 'delete2' => 'N' ) );                                                                                                         
        
        $receiver = $wpdb->get_row( $wpdb->prepare("SELECT ID, email FROM account WHERE secretAddy = '".$admirer."' ") );
      
    	  $reduce = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$sender."' ") );
    	  
    	  $newPrice = $reduce->amount - 5;
    	  
    	  $wpdb->update( 'credits', array( 'amount' => $newPrice ), array( 'secretAddy' => $sender ));
          
          $notify = $wpdb->get_row($wpdb->prepare("SELECT love FROM notification WHERE ID = '".$receiver->ID."' ") ); 
          
          if ( $notify->love == '0')
          {
          $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr>            
<td style="padding: 0; margin: 0;">
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">	
		<div style="width: 670px;">
    			<p>
    			Hello '.$admirer.',<br><br><br>
          One of our Members has sent you some Addy Mail! Your Admirer\'s Username is "'.$sender.'".
    			</p>
    			<p>
    			<a href="'.get_option('siteurl').'/messages/">Click here</a> to check out further details of this member and view your Addy Mail.
          </p>
		</div>
	</div>
</td>     
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />
	<p style="text-align: center;">
	<font size="1">Please do not reply back to this email.<br>
  If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?num='.$receiver->ID.'&notify=Pass A Note&element=love">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>';
        			
          $mail_to = "$receiver->email";
        	$mail_subject = "Secret Addy Pass A Note"; 
        	$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
        	$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
        	
        	mail($mail_to, $mail_subject, $mail_body, $mail_header);
          }
      
          echo '	<script type="text/javascript">                                                                                                                
    						alert("Your message has been sent.");                                                                                                      
    						window.close();                                                                                                       
    						</script>';                                                                                                                                        
      }
  }                                                                                                                                                             
}   

/*-----------------------------------------------------------------                                                                                            
Tech Support Email System                                                                                                                   
------------------------------------------------------------------*/  	
if ( isset($_POST['submit_contact']) )
{
		$email = $_REQUEST['Email']; 
		$name = $_REQUEST['Name'];
		$msg = $_REQUEST['Message'];
		
		$theMsg = '';
		
    if ($name != '')
    {
      $theMsg .= 'Secret Addy Name: '.$name.'<br />';
    }
    
    if ($email != '')
    {
      $theMsg .= 'Email: '.$email.'<br />';
    }
    
    $theMsg .= $msg;

		$mail_to = "tyronehus@yahoo.com";
		$mail_subject = "Tech Support Question";
		$mail_body = "<html><body>".stripslashes($theMsg)."</body></html>";
		$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
		
		if ( mail($mail_to, $mail_subject, $mail_body, $mail_header) ) 
    {
       echo '	<script type="text/javascript">                                                                                                                      
  						alert("Your message has sent.\nWe will respond back shortly.");                                            
  						window.location = "'.get_option('siteurl').'/contact-us/";                                                                                     
  					</script>';
    } 
    else 
    {
       echo '<script type="text/javascript">                                                                                                                      
  						alert("Email not sent.");                                            
  						window.location = "'.get_option('siteurl').'/contact-us/";                                                                                     
  					</script>';
    }     
}                                                                                                                                                
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
This deletes your posts.                                                                                                            
------------------------------------------------------------------*/                                                                                           
if ( isset($_GET['remove']) )                                                                                                                            
{        
  $id = $_GET['id'];                              
  
  $wpdb->query( 'DELETE FROM addyPosts WHERE ID = '.$id );      
    
  	wp_redirect(get_option('siteurl').'/addy-wall/');                                 
}                                                                                                                                                            
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
User can choose which notifications to have sent to
their email
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['unsubscribe']) )                                                                                                                           
{                                                                                                                                                              
	$num = $_REQUEST['id'];                                                                                                                                       
	$element = $_REQUEST['element'];                                                                                                                           
	$decide = $_REQUEST['decide']; 
	$notify = $_REQUEST['notify']; 
                                                                                                                                                               
    $wpdb->update( 'notification', array( $element => $decide ), array( 'ID' => $num ) );       
    
    echo '	<script type="text/javascript">                                                                                                                    
							alert("You will no longer recieve notifications for '.$notify.'.");                                                                                        
								window.location = "'.get_option('siteurl').'/";                                                                                                                        
							</script>';                                                                                                                                      
}                                                                                                                                                           
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
User can choose which notifications to have sent to
their email
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['emailRemove']) )                                                                                                                           
{                                                                                                                                                              
	$email = $_REQUEST['email'];      
                                                                                                                                                               
    $wpdb->insert( 'unsubscribe', array( 'email' => $email ) );       
    
    echo '	<script type="text/javascript">                                                                                                                    
							alert("You will no longer recieve email notifications.");             
  						window.location = "'.get_option('siteurl').'";                                                                                                                       
							</script>';                                                                                                                                      
}                                                                                                                                                           
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
User click the I Dig You button to let you know that they are
feeling you.
------------------------------------------------------------------*/                                                                                           
if ( isset($_GET['dig']) )                                                                                                                           
{                                                                                                                                                              
	$name = $_GET['addySender'];                                                                                                                                
	$to = $_GET['addyTo'];                                                                                                                        
  date_default_timezone_set('America/New_York');
  
  $addy = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM account WHERE secretAddy = '".$name."' ") );
  $ref = $wpdb->get_row( $wpdb->prepare("SELECT reference FROM randomID WHERE ID = ".$addy->ID) );                                                                                                                
	                                                                                                                                                             
	$message = 'Hello,                                                                                                                                           
						<p>                                                                                                                                                
						User name '.$name.' DIGS YOU...                                                                                               
						</p>';
  
  $reply = '<br />
  					<script type="text/javascript"> 
						function showPopup(url) 
						{
						  newwindow = window.open(url,\'name\',\'height=400px,width=700px,left=300px,resizable,scrollbars=yes\');
						  if (window.focus)
						  {
							newwindow.focus();
						  }
						}
						</script>
       		 		<a href="" onclick="showPopup(\''.get_option('siteurl').'/wp-content/themes/secretAddy/love_letter.php?ref='.$ref->reference.'\')">Reply</a>';                                                                                                                                          	

	$wpdb->insert( 'inbox', array( 'sentTo' => $to, 'sentFrom' => $name, 'message' => stripslashes($message).$reply, 'subject' => 'I Dig You', 'readMessage' => 'N', 'date' => date('m/d/Y'), 'delete1' => 'N', 'delete2' => 'Y' ) );                                                                                                         
    
    $receiver = $wpdb->get_row( $wpdb->prepare("SELECT ID, email FROM account WHERE secretAddy = '".$to."' ") );
      
    $newGuy = $wpdb->get_row( $wpdb->prepare("SELECT ID, email FROM account WHERE secretAddy = '".$to."' ") );
    
    $page = $wpdb->get_row( $wpdb->prepare("SELECT reference FROM randomID WHERE ID = ".$newGuy->ID) );
      
    $notify = $wpdb->get_row($wpdb->prepare("SELECT receive FROM notification WHERE ID = '".$receiver->ID."' ") ); 
	  
	  if ( $notify->receive == '0')
	  {
	  $msg = '<center>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding: 0; margin: 0; line-height: 5px;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/email_template.jpg" />
</td>
</tr>
<tr> 
<td style="padding: 0; margin: 0;">
	<div style="background: url(\''.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/middle.jpg\') repeat-y; padding: 5px 0 5px 45px; margin: 0 4px;">	
		<div style="width: 670px;">
			<p>
			User name '.$name.' DIGS YOU... 
			</p>
			<p>
			<a href="'.get_option('siteurl').'/admirer/?ref='.$ref->reference.'">Click here</a> to connect with '.$name.' and find your Secret Admirer now!
      </p>
		</div>
	</div>
</td>     
</tr>
<tr>
<td style="padding: 0; margin: 0;">
	<img src="'.get_option('siteurl').'/wp-content/themes/secretAddy/images/template/end.jpg" style="margin: 0 4px;" />
	<p style="text-align: center;">
	<font size="1">Please do not reply back to this email.<br>
  If you no longer wish to receive our emails, click the following link to <a href="'.get_option('siteurl').'/unsubscribe/?num='.$receiver->ID.'&notify=Admirer Request&element=message">Unsubscribe</a>.</font>
	</p>
</td>
</tr>
</table>
</center>';
				
	  $mail_to = "$receiver->email";
		$mail_subject = "Secret Addy I Dig You"; 
		$mail_body = "<html><body>".stripslashes($msg)."</body></html>";
		$mail_header = "From: Secret Addy <noreply@secretaddy.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
		
		mail($mail_to, $mail_subject, $mail_body, $mail_header);
	  } 
                                                                                                                                                              
  	echo '	<script type="text/javascript">                                                                                                                    
						alert("I Dig You has been sent to '.$to.'.");
  					window.location = "'.get_option('siteurl').'/admirer/?ref='.$page->reference.'";                                                                                                                                      
						</script>';                                                                                                                                     
}                                                                                                                                       
                                                                                                                                                               
/*-----------------------------------------------------------------                                                                                            
Updates pick up lines.                                                                                                                
------------------------------------------------------------------*/                                                                                           
if ( isset($_POST['edit_lines']) )                                                                                                                            
{                                                                                                                                                              
	$lines = $_POST['lines'];                                                                                                                                
  date_default_timezone_set('America/New_York');                                                                                                               	
                                                                                                                                                               
	$wpdb->insert( 'pickUpLines', array( 'message' => stripslashes($lines), 'date' => date('m/d/Y') ) );
  
  wp_redirect(get_option('siteurl').'/pick-up-lines/');  
                                                                                                                                                                      
}    
                                                                                                                                                               
?>
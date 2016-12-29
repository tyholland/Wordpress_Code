<?php   
session_start();    
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage SecretAddy
 * @since SecretAddy
 */ 
 
$ref = $_GET['ref'];

$reference = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM randomID WHERE reference = '".$ref."' ") );

$secret = $wpdb->get_row( $wpdb->prepare("SELECT skypeID, online, secretAddy FROM account WHERE ID = '".$reference->ID."' ") );

$addy = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );

$profile = $wpdb->get_row( $wpdb->prepare("SELECT image FROM profilePhoto WHERE secretAddy = '".$secret->secretAddy."' AND profile = 'Y' "));

$private = $wpdb->get_row( $wpdb->prepare("SELECT 		bodyType,
																									hair,
																									ethnicity,
																									admirers,
																									bio,
																									month,
																									city,
																									height
																			FROM				privacy
																			WHERE			ID = '".$reference->ID."' ") );

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
																								
$path = '/wp-content/themes/secretAddy/profilePhotos/'.$secret->secretAddy.'/profile/';														
?>

		<div id="primary" class="widget-area" role="complementary">
			<ul class="xoxo">
				  <?php 
          if ( (!empty($friend->friend) && $friend->halfProfile == 'Y' && $friend->sentTo == $addy->secretAddy && $profile->image != '') || $friend->fullProfile == 'Y' )
          {
            echo '
				<a href="/admirer?ref='.$ref.'" title="'.$secret->secretAddy.'\'s Profile Image">
				<div id="proImage">
					<img src="'.$path.$profile->image.'" id="photoSize" alt="View '.$secret->secretAddy.'\'s Profile Page" title="View '.$secret->secretAddy.'\'s Profile Page" />
				</div>
				</a>';
          }
          else
          {
            echo '
				<div id="proImage">
					<a href="/admirer?ref='.$ref.'" title="No Photo"><img src="/wp-content/themes/secretAddy/images/no-photo.jpg" id="photoSize" alt="No Photo" title="No Photo" /></a>
				</div>';
          }
          ?>   

<?php 
if ( !empty($_SESSION['secretID']) )
{ 
				   
          if ( (!empty($friend->friend) && $friend->halfProfile == 'Y' && $friend->sentTo == $addy->secretAddy) || $friend->fullProfile == 'Y' )
          {
            echo '
				<li class="widget-container">
					<form method="get" action="/wp-content/themes/secretAddy/photo-results.php">
						<input type="hidden" name="admirer" value="'.$secret->secretAddy.'" /> 
						<input type="hidden" name="type" value="public" /> 
						<input type="hidden" name="ref" value="'.$ref.'" /> 
						<input type="hidden" name="photo_show" value="Admirer Photos" />
					<input type="image" src="/wp-content/themes/secretAddy/images/admirers_photos.jpg" alt="Admirer Photos" title="Admirer Photos" class="button" />
					</form>
				</li>';
          }
          ?>
				  <?php 
          if ( (!empty($friend->friend) && $friend->halfProfile == 'Y' && $friend->sentTo == $addy->secretAddy) || $friend->fullProfile == 'Y' )
          {
            echo '
				<li class="widget-container">
					<form method="get" action="/addy-interests/">
						<input type="hidden" name="interest_submit" value="Interests" />
						<input type="hidden" name="ref" value="'.$ref.'" />
					<input type="image" src="/wp-content/themes/secretAddy/images/interests.jpg" alt="Interests" title="Interests" class="button3" />
					</form>
				</li>';
          }
          ?>
				<li class="widget-container">
					<a href="<?php echo '/wall-results?ref='.$ref; ?>" title="Addy Wall">
					<img src="/wp-content/themes/secretAddy/images/addy_wall.jpg" alt="Addy Wall" title="Addy Wall" class="newAge" height="50px" width="142px" />
					</a>
				</li>   
          <?php 
        if ( !empty($secret->skypeID) && $friend->friend == 'Y' )
        {?>
				<li class="widget-container">
        	<a href="skype:<?php echo $secret->skypeID; ?>?call" title=Skype Call">
        	   <img src="/wp-content/themes/secretAddy/images/skype_call.jpg" alt="Skype Call" title="Skype Call"  class="button" />
        	</a>
				</li>  
        <?php } ?> 
				<li class="widget-container">
				  <?php 
          if ( !empty($friend->friend) && $friend->friend == 'Y' )
          {
            echo '<form method="get" action="/wp-content/themes/secretAddy/route.php">
						<input type="hidden" name="me" value="'.$addy->secretAddy.'" />
						<input type="hidden" name="desire" value="'.$secret->secretAddy.'" /> 
                  		<input type="hidden" name="remove_desire" value="Remove Admirer" />
						<input type="image" src="/wp-content/themes/secretAddy/images/remove_admirer.jpg" alt="Remove Admirer" title="Remove Admirer" class="button" />
                  	</form>';
          }
          else
          {
            echo '<form method="get" action="/wp-content/themes/secretAddy/route.php">
						<input type="hidden" name="me" value="'.$addy->secretAddy.'" />
						<input type="hidden" name="desire" value="'.$secret->secretAddy.'" /> 
						<input type="hidden" name="destination" value="'.$_SERVER['REQUEST_URI'].'" />
                  		<input type="hidden" name="add_desire" value="Add Admirer" />
						<input type="image" src="/wp-content/themes/secretAddy/images/add_admirer.jpg" alt="Add Admirer" title="Add Admirer" class="button" />
                  </form>';
          }
          ?>   					
				</li> 
				<li>
				  <p style="width: 150px; padding: 8px 15px;">Want to Learn some new Pick Up Lines? <a href="/pick-up-lines/">Click Here</a></p>
				</li>  
		<?php
		}
		?>
				<?php
				if ( ! dynamic_sidebar( 'primary-widget-area' ) ) :

				 endif; // end primary widget area ?>
			</ul>
		</div><!-- #secondary .widget-area -->

    <script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>  
<?php     
session_start();
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage SecretAddy
 * @since SecretAddy
 */
 
$secret = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = '".$_SESSION['secretID']."' ") );

$profile = $wpdb->get_row( $wpdb->prepare("SELECT image FROM profilePhoto WHERE secretAddy = '".$secret->secretAddy."' AND profile = 'Y' "));

$path = '/wp-content/themes/secretAddy/profilePhotos/'.$secret->secretAddy.'/profile/';
?>

		<div id="primary" class="widget-area" role="complementary">
			<ul class="xoxo">
			<?php
			if ( $profile->image == '')
			{
				echo '
				<div id="proImage">
					<img src="/wp-content/themes/secretAddy/images/no-photo.jpg" id="photoSize" alt="No Photo" title="No Photo" /> 
				</div>';
			}
			else
			{
				echo '
				<div id="proImage">
					<img src="'.$path.$profile->image.'" id="photoSize" alt="'.$secret->secretAddy.'\'s Profile Image" title="'.$secret->secretAddy.'\'s Profile Image" /> 
				</div>';
			}?>
					<form method="post" action="/wp-content/themes/secretAddy/route.php" enctype="multipart/form-data">
					<input type="hidden" name="myself" value="<?php echo $secret->secretAddy; ?>" />
					  <input type="file" name="profile" size="15" /><br />                                                                                                           
						<input type="submit" name="upload_pro" style="background: url('http://secretaddy.com/wp-content/themes/secretAddy/images/upload.jpg') no-repeat; height: 49px; width: 130px; border: none;" value="" class="button" />
					</form>   <br />
<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
?>
        <li class="widget-container">
				  <a href="/rose-results" title="Roses">
					<img src="/wp-content/themes/secretAddy/images/roses.jpg" alt="Roses" title="Roses" class="button" height="60px" width="160px" />
					</a>
				</li>   
				<li class="widget-container">
				  <a href="/gift-results" title="Addy Gifts">
					<img src="/wp-content/themes/secretAddy/images/addy_gifts.jpg" alt="Addy Gifts" title="Addy Gifts" class="button" height="60px" width="160px" />
					</a>
				</li>  
				<li class="widget-container">
					<a href="#" onclick="showPopup('<?php echo get_option('siteurl').'/wp-content/themes/secretAddy/bouquet.php'; ?>')" title="Send A Bouquet" />
					<img src="/wp-content/themes/secretAddy/images/send_bouquet.jpg" alt="Send A Bouquet" title="Send A Bouquet" class="button" height="60px" width="160px" />
					</a>
				</li>  
        <li class="widget-container">
				  <a href="/addy-wall" title="Addy Wall">
					<img src="/wp-content/themes/secretAddy/images/addy_wall.jpg" alt="Addy Wall" title="Addy Wall" class="newAge" height="50px" width="142px" />
					</a>
				</li>
				<li class="widget-container">
				  <a href="/tell-friends" title="Tell A Friend">
					<img src="/wp-content/themes/secretAddy/images/tell_friend.jpg" alt="Tell A Friend" title="Tell A Friend" class="button" height="60px" width="160px" />
					</a>
				</li> 
				<li class="widget-container">
				  <p style="width: 150px; padding: 8px 15px;">Want to Learn some new Pick Up Lines? <a href="/pick-up-lines/">Click Here</a></p>
				</li> 
				<?php
				if ( ! dynamic_sidebar( 'primary-widget-area' ) ) :

				 endif; // end primary widget area ?>
			</ul>
		</div><!-- #primary .widget-area -->
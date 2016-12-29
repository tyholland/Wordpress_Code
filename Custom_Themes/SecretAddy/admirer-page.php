<?php
session_start();                                                                                                                                                             

/**
 * Template Name: Admirer
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage SecretAddy
 * @since SecretAddy
 */

$ref = $_GET['ref'];

$reference = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM randomID WHERE reference = '".$ref."' ") );


	get_header(); 
	
	$secret = $wpdb->get_row( $wpdb->prepare("SELECT 			secretAddy,
																									gender,
																									bodyType,
																			            online,
																									hair,
																									ethnicity,
																									admirers,
																									bio,
																									age,
																									city,
																									state,
																									zip,
																									height
																			FROM				account
																			WHERE			ID = '".$reference->ID."' ") );
																			
	$private = $wpdb->get_row( $wpdb->prepare("SELECT 	bodyType,
																									hair,
																									ethnicity,
																									admirers,
																									bio,
																									age,
																									city,
																									height,
																									job
																			FROM				privacy
																			WHERE			  ID = '".$reference->ID."' ") );
																			
  $interest = $wpdb->get_row( $wpdb->prepare("SELECT 			job
    																			FROM				interests
    																			WHERE			  ID = '".$reference->ID."' ") );																				
																			
  $me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );																					
																						
  $friend = $wpdb->get_row( $wpdb->prepare("SELECT   	secretAddy, 
  																							admirer, 
  																							friend,
																								sentTo,
																								halfProfile 
																		FROM    		admirer 
																		WHERE  	(secretAddy = '".$me->secretAddy."' 
																							AND admirer = '".$secret->secretAddy."') 
																		OR      			(secretAddy = '".$secret->secretAddy."' 
																							AND admirer = '".$me->secretAddy."') ") );   
										
  $status = $wpdb->get_row( $wpdb->prepare("SELECT 		status
  												FROM				statuses
  												WHERE			secretAddy = '".$secret->secretAddy."' ") );
  												
  $chat = $wpdb->get_row( $wpdb->prepare("SELECT   	chatBegin,
																											chatID
																							FROM    	chatBuddies 
																							WHERE   	(user1 = '".$secret->secretAddy."' 
																												AND user2 = '".$me->secretAddy."') 
																							OR      			(user1 = '".$me->secretAddy."' 
																												AND user2 = '".$secret->secretAddy."') ") );
				          
  $checkCredit = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$me->secretAddy."' ") ); 
  
  $theId = rand(1, 30000);	
  
  if ( $checkCredit->amount == 0 || $checkCredit->amount < 10)
  {
    $newChat = '<a href="#" onclick="alert(\'You do not have enough credits to Chat\');" title="Click here to Chat" class="button">';
    $startChat = '<a href="#" onclick="alert(\'You do not have enough credits to Chat\');" title="Click here to Chat" class="button">';
  }
  else
  {  
    $newChat = '<a href="#" onclick="showChat(\''.get_option('siteurl').'/wp-content/themes/secretAddy/chat.php?id='.$chat->chatID.'&show=1\', \''.$chat->chatID.'\')" title="Click here to Chat" class="button">';
    $startChat = '<a href="#" onclick="showChat(\''.get_option('siteurl').'/wp-content/themes/secretAddy/chat.php?ref='.$ref.'&id='.$theId.'\', \''.$theId.'\')" title="Click here to Chat" class="button">'; 
  } 

if ( !empty($reference) )
{   
  ?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title"><?php echo $secret->secretAddy;
            if ( $secret->online == 'Y' )
            {
      				if ( $chat->chatBegin == 'Y' )
      				{
              echo '<p id="move">'.$newChat.'<img src="/wp-content/themes/secretAddy/images/online.jpg" alt="Click here to Chat" title="Click here to Chat" height="50px" width="100px" /></a></p>'; 
              }
      				else
      				{ 
              echo '<p id="move">'.$startChat.'<img src="/wp-content/themes/secretAddy/images/online.jpg" alt="Click here to Chat" title="Click here to Chat" height="50px" width="100px" /></a></p>';
      				}
            }
            else
            {
              echo '<p id="move"><img src="/wp-content/themes/secretAddy/images/offline.jpg" alt="Offline" title="Offline" height="50px" width="100px" /></p>';
            }?>
            </h1>
            <?php
            
            if ( $friend->halfProfile == 'Y' && $friend->sentTo == $me->secretAddy )
            {
              echo '
              <div id="bouquetAlert">
              <form method="post" action="/wp-content/themes/secretAddy/route.php">                                                                                                          
  						<input type="hidden" name="me" value="'.$secret->secretAddy.'" />                                                                                              
  						<input type="hidden" name="admirer" value="'.$me->secretAddy.'" />                                                                                         
  						Do You Wish Accept '.$secret->secretAddy.'\'s Bouquet of Roses?<br /><br />
              <input type="submit" name="get_profile" value="Yes" /><input type="submit" name="refuse_profile" value="No" />                                                                                           
  						</form>
              </div>';
            }
            
            ?>

					<div class="entry-content">
						<p>
						<h2><?php echo stripslashes($status->status); ?></h2>
						</p>
						
						<?php
						if ( isset($_SESSION['secretID']) )
						{?>
						<p>
						<table>
						<tr valign="top">
						<td>
  						<form method="get" action="/wp-content/themes/secretAddy/route.php">
  						<input type="hidden" name="addySender" value="<?php echo $me->secretAddy; ?>" /> 
  						<input type="hidden" name="addyTo" value="<?php echo $secret->secretAddy; ?>" />
  						<input type="hidden" name="dig" value="dig_you" />
  						<input type="image" src="/wp-content/themes/secretAddy/images/i_dig.jpg" alt="I Dig You" title="I Dig You" height="49px" width="130px" class="button2" />
  						</form>
  						</td>
  						<td>  						
          <a href="#" onclick="showPopup('<?php echo get_option('siteurl').'/wp-content/themes/secretAddy/love_letter.php?ref='.$ref.''; ?>')" title="Pass A Note" class="button" />
					<img src="/wp-content/themes/secretAddy/images/pass_note.jpg" alt="Pass A Note" title="Pass A Note" class="button" height="49px" width="130px" />
			</a>
			</td>
				  <?php 
          if ( !empty($friend->friend) && $friend->friend == 'Y' && $secret->online == 'Y' )
          {
				
				if ( $chat->chatBegin == 'Y' )
				{
						echo '<td>'.$newChat.'<img src="/wp-content/themes/secretAddy/images/secret_chat.jpg" alt="Secret Chat" title="Secret Chat" class="button" height="51px" width="130px" /></a></td>';
				}
				else
				{
				echo '
					<td>
					  '.$startChat.'
						<img src="/wp-content/themes/secretAddy/images/secret_chat.jpg" alt="Secret Chat" title="Secret Chat" class="button" height="51px" width="130px" />
						</a>
					</td>';
				}
          }
          ?>
			<td>
          <form method="get" action="/wp-content/themes/secretAddy/route.php">
  					<input type="hidden" name="sentFrom" value="<?php echo $me->secretAddy; ?>" />
  					<input type="hidden" name="sentTo" value="<?php echo $secret->secretAddy; ?>" />  
				    <input type="hidden" name="website" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />                                              
						<input type="hidden" name="type" value="rose" />            
					  <input type="hidden" name="send_rose" value="Send Rose" />
					<input type="image" src="/wp-content/themes/secretAddy/images/send_rose.jpg" alt="Send A Rose" title="Send A Rose" class="button" height="52px" width="130px" />
          </form>
          </td>
          <td>
          <a href="/animals/?cate=animals" title="Send A Gift">
  				<img src="/wp-content/themes/secretAddy/images/send_gifts.jpg" alt="Send A Gift" title="Send A Gift" class="button" height="52px" width="130px" />
          </a>
          </td>
          </tr>
          </table>
            </p>
            <?php } ?>
						
            <br>
						<?php if ( !empty($secret->gender) ) { ?>
						<p><b>Gender:</b> <?php echo $secret->gender; ?><span style="padding: 0 0 0 20px;"></span>
						<?php } ?>
						<?php if ( !empty($secret->age) && $private->age == '0' ) { ?>
						<b>Age:</b> <?php echo $secret->age; ?><span style="padding: 0 0 0 20px;"></span>
						<?php } ?>  
						<?php if ( !empty($secret->ethnicity) && $private->ethnicity == '0' ) { ?>
						<b>Ethnicity:</b> <?php echo $secret->ethnicity; ?></p>
						<?php } ?>
						<?php if ( !empty($secret->height) && $private->height == '0' ) { ?>				
						<p><b>Height:</b> <?php echo $secret->height; ?><span style="padding: 0 0 0 15px;"></span>	
						<?php } ?> 
						<?php if ( !empty($secret->bodyType) && $private->bodyType == '0' ) { ?>
						<b>Body Type:</b> <?php echo $secret->bodyType; ?><span style="padding: 0 0 0 15px;"></span>		
						<?php } ?>
						<?php if ( !empty($secret->hair) && $private->hair == '0' ) { ?>
						<b>Hair Color:</b> <?php echo $secret->hair; ?></p>
						<?php } ?>
						<?php if ( !empty($interest->job) && $private->job == '0' ) { ?>
						<p><b>Occupation/Profession:</b> <?php echo $interest->job; ?><span style="padding: 0 0 0 15px;"></span>
						<?php } ?>
						<?php if ( !empty($secret->admirers) && $private->admirers == '0' ) { ?>
						<b>Desired Admirer:</b> <?php echo $secret->admirers; ?></p>
						<?php } ?>
						<?php if ( !empty($secret->city) && !empty($secret->state) && !empty($secret->zip) && $private->city == '0' && $friend->friend == 'Y' ) { ?>
						<p><b>Location:</b> <?php echo $secret->city.', '.$secret->state.' '.$secret->zip; ?></p>
						<?php } ?>
						<?php if ( !empty($secret->bio) && $private->bio == '0' ) { ?>
						<p><b>Bio Description:</b><br /> <?php echo stripslashes($secret->bio); ?></p>
						<?php } ?>
						<?php if ( $friend->friend != 'Y' && !isset($_SESSION['secretID']) ) { 
						echo '<p>To Connect with '.$secret->secretAddy.'<br /><a href="/">REGISTER</a> WITH SECRET ADDY TODAY</p>';
						 } ?>
						
					</div><!-- .entry-content -->
				</div><!-- #post-## -->
          <?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar('admirer'); ?>
<?php get_footer();   
}
else
{  
?>
  <div id="container2" class="one-column">
			<div id="content" role="main"> 
			
				<h1 class="entry-title">Not Found</h1>

					<div class="entry-content">
                                                          
						<p><?php _e( 'Apologies, but the page you requested could not be found.', 'secretAddy' ); ?></p> 
    				
					</div><!-- .entry-content -->

			</div><!-- #content -->
		</div><!-- #container -->
<?php
get_footer(); 
} 
?>
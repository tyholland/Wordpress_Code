<?php
session_start();           

/**
 * Template Name: Addy Interests
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

get_header();

if ( isset($_GET['interest_submit']) )
{

		$ref = $_GET['ref'];
		
		$reference = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM randomID WHERE reference = '".$ref."' ") ); 
		
		$secret = $wpdb->get_row( $wpdb->prepare("SELECT 			book,
																												food, 
																												color,
																												sport,
																												movie,
																												tv,
																												song,
																												singer,
																												skool,
																												college,
																												hobby1,
																												hobby2,
																												hobby3,
																												hobby4,
																												hobby5
																						FROM				interests
																						WHERE			  ID = '".$reference->ID."' ") );
																				
		$me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );
		$addy = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy, online FROM account WHERE ID = ".$reference->ID) );																
																								
		$friend = $wpdb->get_row( $wpdb->prepare("SELECT   	secretAddy, 
																								admirer, 
																								friend,
																								fullProfile 
																			FROM    		admirer 
																			WHERE  	(secretAddy = '".$me->secretAddy."' 
																								AND admirer = '".$addy->secretAddy."') 
																			OR      			(secretAddy = '".$addy->secretAddy."' 
																								AND admirer = '".$me->secretAddy."') ") ); 
		
		
		  $chat = $wpdb->get_row( $wpdb->prepare("SELECT   	chatBegin,
																													chatID
																									FROM    	chatBuddies 
																									WHERE   	(user1 = '".$addy->secretAddy."' 
																														AND user2 = '".$me->secretAddy."') 
																									OR      			(user1 = '".$me->secretAddy."' 
																														AND user2 = '".$addy->secretAddy."') ") );
																														
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
		
		if ( (isset($_SESSION['secretID']) && !empty($friend->friend) && $friend->halfProfile == 'Y' && $friend->sentTo == $addy->secretAddy && $profile->image != '') || (isset($_SESSION['secretID']) && $friend->fullProfile == 'Y') )
		{
		  ?>
		
				<div id="container">
					<div id="content" role="main">
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<h1 class="entry-title"><?php echo $addy->secretAddy.'\'s Interests';
					if ( $addy->online == 'Y' )
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
						
		
							<div class="entry-content">
							<?php
				  if ( !empty($reference) && $friend->fullProfile == 'Y' )
				  {
				  ?>
					<p>
								<h2 align="left">Activities:</h2>
								<b>Hobby 1</b>: <?php echo stripslashes($secret->hobby1); ?><br />
								<b>Hobby 2</b>: <?php echo stripslashes($secret->hobby2); ?><br />
								<b>Hobby 3</b>: <?php echo stripslashes($secret->hobby3); ?><br />
								<b>Hobby 4</b>: <?php echo stripslashes($secret->hobby4); ?><br />
								<b>Hobby 5</b>: <?php echo stripslashes($secret->hobby5); ?><br />
								</p>
								
								<p>
								<h2 align="left">Favorites:</h2>
								<b>Favorite Book</b>: <?php echo stripslashes($secret->book); ?><br /> 
								<b>Favorite Food</b>: <?php echo stripslashes($secret->food); ?><br />   
								<b>Favorite Color</b>: <?php echo stripslashes($secret->color); ?><br /> 
								<b>Favorite Sport</b>: <?php echo stripslashes($secret->sport); ?><br /> 
								<b>Favorite Movie</b>: <?php echo stripslashes($secret->movie); ?><br />
								<b>Favorite TV Show</b>: <?php echo stripslashes($secret->tv); ?><br /> 
								<b>Favorite Song</b>: <?php echo stripslashes($secret->song); ?><br />  
								<b>Favorite Singer</b>: <?php echo stripslashes($secret->singer); ?><br /> 
								</p>
								
								<p>
								<h2 align="left">Education:</h2>
								<b>High School</b>: <?php echo stripslashes($secret->skool); ?><br /> 
								<b>College</b>: <?php echo stripslashes($secret->college); ?><br />
								</p>
							<?php
				  }
				  ?>
								
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
			  <div id="container">
						<div id="content" role="main">
						
							<h1 class="entry-title"><?php echo $addy->secretAddy.'\'s Interests';
            if ( $addy->online == 'Y' )
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
			
								<div class="entry-content">
						You do not have Access to <?php echo $addy->secretAddy.'\'s Full Profile'; ?><br>
						Gain Full Access by sending <?php echo $addy->secretAddy; ?> a Bouquet of Roses.
								
								</div><!-- .entry-content -->
			
						</div><!-- #content -->
					</div><!-- #container -->
			<?php
			get_sidebar('admirer');
			get_footer(); 
			} 
}
else
{    	  
?>
  <div id="container2" class="one-column">
			<div id="content" role="main">
			
				<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-content">
            <div style="padding: 20px 0;" align="center">
            Please Sign In to view this page.<br /><br />                                                                                                                        
    				<form method="post" action="/wp-content/themes/secretAddy/route.php">
				      <input type="hidden" name="website" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />                                                                       
    					<p>                                                                                                                                   
    				SA Name: <input type="text" name="user" />                                                                                                    
    					</p>                                                                                                                                                
    					<p>                                                                                                                                   
    					Password: <input type="password" name="passwd" />                                                                                                   
    					</p>                                                                                                                                                
    					<p>                                                                                                                                     
    					<input type="submit" class="login" name="user_login" value="Login" />                                                                               
    					<span style="font-size: 12px;"><a href="<?php echo '/forgot-password'; ?>" title="Forgot your Password?" style="text-decoration: none;">Forgot your Password?</a></span>                                                         
    					</p>                                                                                                                                                
    				</form>
    				</div>
    				
					</div><!-- .entry-content -->

			</div><!-- #content -->
		</div><!-- #container -->
<?php
get_footer(); 
} 
?>
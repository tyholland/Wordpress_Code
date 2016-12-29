<?php   
session_start();      
/**                                                                                                                                                           
 * The Header for our theme.                                                                                                                                  
 *                                                                                                                                                            
 * Displays all of the <head> section and everything up till <div id="main">                                                                                  
 *                                                                                                                                                            
 * @package WordPress                                                                                                                                         
 * @subpackage SecretAddy                                                                                                                                     
 * @since SecretAddy                                                                                                                                          
 */                       
?>  
<!DOCTYPE html>                                                                                                                                             
<html <?php language_attributes(); ?>>                                                                                                                        
<head>                                                                                                                                                        
<meta charset="<?php bloginfo( 'charset' ); ?>" />    
<meta name="google-site-verification" content="tObJsrvfeLMxzeoCYBobIDA6oLKSGXmCE1-bYuP7bfM" />
<META name="y_key" content="1f630af6b6e07dab" />
<meta name="msvalidate.01" content="FACA1892A5481981ABA8C25D9799BA9C" />
<title><?php                                                                                                                                                  
	/*                                                                                                                                                          
	 * Print the <title> tag based on what is being viewed.                                                                                                     
	 */                                                                                                                                                         
	global $page, $paged;                                                                                                                                       
                                                                                                                                                              
	wp_title( '|', true, 'right' );                                                                                                                             
                                                                                                                                                              
	// Add the blog name.                                                                                                                                       
	bloginfo( 'name' );                                                                                                                                       
                                                                                                                                                              
	?></title>                                                                                                                                                  
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />                                                                                           
<?php                                                                                                                                                         
	/* We add some JavaScript to pages with the comment form                                                                                                    
	 * to support sites with threaded comments (when in use).                                                                                                   
	 */                                                                                                                                                         
	if ( is_singular() && get_option( 'thread_comments' ) )                                                                                                     
		wp_enqueue_script( 'comment-reply' );                                                                                                                     
                                                                                                                                                              
	/* Always have wp_head() just before the closing </head>                                                                                                    
	 * tag of your theme, or you will break many plugins, which                                                                                                 
	 * generally use this hook to add elements to <head> such                                                                                                   
	 * as styles, scripts, and meta tags.                                                                                                                       
	 */                                                                                                                                                         
	wp_head();                                                                                                                                                  
?>                                                                                                                                                            
</head>                                                                                                                                                       
                                                                                                                                                              
<body <?php body_class(); ?> id="<?php the_title(); ?>">
<div id="newMain"> 
<div id="leftSide">
<img src="/wp-content/themes/secretAddy/images/left_side.jpg" height="940" width="69" alt="Left Secret Addy Side" />
</div>      
<div id="rightSide">
<img src="/wp-content/themes/secretAddy/images/right_side.jpg" height="940" width="78" alt="Right Secret Addy Side" />
</div>                                                                                             
<div id="wrapper" class="hfeed">                                                                                                                       
	<div id="header">                                                                                                                                           
		<div id="masthead">       
		<?php			                                                                                                                                                    
		if ( isset($_SESSION['secretID']) )                                                                                                                           
		{                                                                                                                                                             
		?> 
      			<div id="theHeader"><a href="/" title="Secret Addy Home">                                                                      
				<img src="/wp-content/themes/secretAddy/images/homepic.jpg" width="344px" height="200px" alt="Secret Addy Home" title="Secret Addy Home" /></a></div>
				
			<div id="connectbar">      
				  <form method="get" action="/wp-content/themes/secretAddy/connect-results.php">	                                      
						<input type="hidden" name="id" value="<?php echo $_SESSION['secretID']; ?>" />   
						<input type="hidden" name="radio" value="0" />	
						<input type="hidden" name="website" value="<?php echo get_option('siteurl'); ?>/connect/character/" />	
						<input type="text" name="admirSearch" id="admirSearch" />                                                                                                                         
						<input type="image" alt="Connect" src="/wp-content/themes/secretAddy/images/connect.jpg"  id="connectImg" title="Connect" />                                                                    
					</form>                                                                                                                                               
			</div>      
			<?php                                                                                                                                                         
			}      
			else
			{
			?>
      			<div id="theHeader2"><a href="/" title="Secret Addy Home">                                                                      
				<img src="/wp-content/themes/secretAddy/images/homepic.jpg" width="344px" height="200px" alt="Secret Addy Home" title="Secret Addy Home" /></a></div>
			<?php
			}
			?>
			<div id="branding" role="banner">                                                                                                                                               
						<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="Connect With Your Secret Admirer Anonymously" title="Connect With Your Secret Admirer Anonymously"  />
                                                                                                                                   
			</div><!-- #branding -->                                                                                                                                  
<?php			                                                                                                                                                    
if ( isset($_SESSION['secretID']) )                                                                                                                           
{                                                                                                                                                             
?>                                                                                                                                                            
			<div id="access" role="navigation">                                                                                                                     
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>                                      
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'secretAddy' ); ?>"><?php _e( 'Skip to content', 'secretAddy' ); ?></a></div>                                                                                                                                
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>                                                                                       
				<?php include('navMenu.php'); ?>                                                                                                                      
			</div><!-- #access -->                                                                                                                                  
<?php                                                                                                                                                         
}                                                                                                                                                             
else                                                                                                                                                          
{                                                                                                                                                             
echo '                                                                                                                                                        
<div id="access" role="navigation">                                                                                                                             
	<center><div id="blankSpace">CONNECT WITH YOUR CRUSH ON SECRETADDY!                                                                                                                                
	</div></center>                                                                                                                                          
</div>';                                                                                                                                                      
}                                                                                                                                                             
?>                                                                                                                                                            
		</div><!-- #masthead -->                                                                                                                                  
	</div><!-- #header -->                                                                                                                                      
                                                                                                                                                              
	<div id="main">                                                                                                                                             

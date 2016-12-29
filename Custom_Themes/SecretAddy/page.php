<?php          
session_start();                                                                                                                                                                                                                                                                                                    
/**                                                                                                                                                           
 * The template for displaying all pages.                                                                                                                     
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
 if ( !isset($_SESSION['secretID']) )                                                                                                                         
{                                                                                                                                                                                                      
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
                                                                                                                                                              
<body <?php body_class(); ?>> 
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
      <div id="theHeader3"><a href="/" title="Secret Addy Home">                                                                      
						<img src="/wp-content/themes/secretAddy/images/homepic.jpg" width="344px" height="200px" alt="Secret Addy Home" title="Secret Addy Home" /></a></div>                                                                                                                                
			<div id="login">                                                                                                                                        
				<form method="post" action="/wp-content/themes/secretAddy/route.php">   
				  <input type="hidden" name="website" value="/profile-page/" />                                                                    
					<p id="loginName">                                                                                                                                   
				SA Name: <input type="text" name="user" />                                                                                                    
					</p>                                                                                                                                                
					<p id="loginPwd">                                                                                                                                   
					Password: <input type="password" name="passwd" />                                                                                                   
					</p>                                                                                                                                                
					<p id="forgot">                                                                                                                                     
					<input type="submit" class="login" name="user_login" value="Login" />                                                                               
					<a href="<?php echo '/forgot-password'; ?>" title="Forgot your Password?" style="text-decoration: none;">Forgot your Password?</a>                                                         
					</p>                                                                                                                                                
				</form>                                                                                                                                               
			</div>                                                                                                                                         
			<div id="branding" role="banner">                                                                                                                                               
						<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="Connect With Your Secret Admirer Anonymously" title="Connect With Your Secret Admirer Anonymously" /> 
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
		<div id="container2" class="one-column2">                                                                                                                  
			<div id="content" role="main">                                                                                                                          
                                                                                                                                                              
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>                                                                                             
                                                                                                                                                              
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                                                                                             
                                                                                                                                                              
					<div class="entry-content">            
					<img src="/wp-content/themes/secretAddy/images/landing.jpg" height="624" width="771" alt="Secret Addy Registration" title="Secret Addy Registration" id="regLand" />
						<div id="regImg">
						<iframe width="425" height="319" src="http://www.youtube.com/embed/aNPZKG01xvo?autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe>
						</div>
					<div>
					<?php the_content(); ?>
					</div>
					</div><!-- .entry-content -->                                                                                                                       
				</div><!-- #post-## -->                                                                                                                               
                                                                                                                                                              
<?php endwhile; ?>                                                                                                                                            
                                                                                                                                                              
			</div><!-- #content -->                                                                                                                                 
		</div><!-- #container -->  
                                                                                                                                                              
<?php get_footer();                                                                                                                                           
}                                                                                                                                                             
else                                                                                                                                                          
{                                                                                                                                                             
	wp_redirect('/profile-page/');                                                                                                              
}                                                                                                                                                             
?>
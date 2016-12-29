<?php

/**                                                                                                                                                                                                                                                                                                                       
 * Profile functions and definitions                                                                                                                         
 *                                                                                                                                                           
 * Sets up the theme and provides some helper functions. Some helper functions                                                                               
 * are used in the theme as custom template tags. Others are attached to action and                                                                          
 * filter hooks in WordPress to change core functionality.                                                                                                   
 *                                                                                                                                                           
 * The first function, secretAddy_setup(), sets up the theme by registering support                                                                          
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.                                                               
 *                                                                                                                                                           
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and                                                                            
 * http://codex.wordpress.org/Child_Themes), you can override certain functions                                                                              
 * (those wrapped in a function_exists() call) by defining them first in your child theme's                                                                  
 * functions.php file. The child theme's functions.php file is included before the parent                                                                    
 * theme's file, so the child theme functions would be used.                                                                                                 
 *                                                                                                                                                           
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached                                                                  
 * to a filter or action hook. The hook can be removed by using remove_action() or                                                                           
 * remove_filter() and you can attach your own function to the hook.                                                                                         
 *                                                                                                                                                           
 * We can remove the parent theme's hook only after it is attached, which means we need to                                                                   
 * wait until setting up the child theme:                                                                                                                    
 *                                                                                                                                                           
 * <code>                                                                                                                                                    
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );                                                                                                
 * function my_child_theme_setup() {                                                                                                                         
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)                                                                 
 *     remove_filter( 'excerpt_length', 'secretAddy_excerpt_length' );                                                                                       
 *     ...                                                                                                                                                   
 * }                                                                                                                                                         
 * </code>                                                                                                                                                   
 *                                                                                                                                                           
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.                                                           
 *                                                                                                                                                           
 * @package WordPress                                                                                                                                        
 * @subpackage SecretAddy                                                                                                                                    
 * @since SecretAddy                                                                                                                                         
 */                                                                                                                                                          
                                                                                                                                                             
/**                                                                                                                                                          
 * Set the content width based on the theme's design and stylesheet.                                                                                         
 *                                                                                                                                                           
 * Used to set the width of images and content. Should be equal to the width the theme                                                                       
 * is designed for, generally via the style.css stylesheet.                                                                                                  
 */                                                                                                                                                          
if ( ! isset( $content_width ) )                                                                                                                             
	$content_width = 640;                                                                                                                                      
                                                                                                                                                             
/** Tell WordPress to run secretAddy_setup() when the 'after_setup_theme' hook is run. */                                                                    
add_action( 'after_setup_theme', 'secretAddy_setup' );                                                                                                       
                                                                                                                                                             
if ( ! function_exists( 'secretAddy_setup' ) ):                                                                                                              
/**                                                                                                                                                          
 * Sets up theme defaults and registers support for various WordPress features.                                                                              
 *                                                                                                                                                           
 * Note that this function is hooked into the after_setup_theme hook, which runs                                                                             
 * before the init hook. The init hook is too late for some features, such as indicating                                                                     
 * support post thumbnails.                                                                                                                                  
 *                                                                                                                                                           
 * To override secretAddy_setup() in a child theme, add your own secretAddy_setup to your child theme's                                                      
 * functions.php file.                                                                                                                                       
 *                                                                                                                                                           
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.                                                                    
 * @uses register_nav_menus() To add support for navigation menus.                                                                                           
 * @uses add_custom_background() To add support for a custom background.                                                                                     
 * @uses add_editor_style() To style the visual editor.                                                                                                      
 * @uses load_theme_textdomain() For translation/localization support.                                                                                       
 * @uses add_custom_image_header() To add support for a custom header.                                                                                       
 * @uses register_default_headers() To register the default custom header images provided with the theme.                                                    
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.                                                                                      
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 */                                                                                                                                                          
   function add_new_custom_image_header($header_callback, $admin_header_callback, $admin_image_div_callback = '') {                                          
	if ( ! empty($header_callback) )                                                                                                                           
		add_action('wp_head', $header_callback);                                                                                                                 
                                                                                                                                                             
	add_theme_support( 'new-header' );                                                                                                                         
                                                                                                                                                             
	if ( ! is_admin() )                                                                                                                                        
		return;                                                                                                                                                  
	require_once (ABSPATH . 'wp-content/new-header.php');                                                                                                      
	$GLOBALS['new_custom_image_header'] =& new New_Custom_Image_Header($admin_header_callback, $admin_image_div_callback);                                     
	add_action('admin_menu', array(&$GLOBALS['new_custom_image_header'], 'init'));                                                                             
}                                                                                                                                                            
                                                                                                                                                             
function secretAddy_setup() {                                                                                                                                
                                                                                                                                                             
	// This theme styles the visual editor with editor-style.css to match the theme style.                                                                     
	add_editor_style();                                                                                                                                        
                                                                                                                                                             
	// This theme uses post thumbnails                                                                                                                         
	add_theme_support( 'post-thumbnails' );                                                                                                                    
                                                                                                                                                             
	// Add default posts and comments RSS feed links to head                                                                                                   
	add_theme_support( 'automatic-feed-links' );                                                                                                               
                                                                                                                                                             
	// Make theme available for translation                                                                                                                    
	// Translations can be filed in the /languages/ directory                                                                                                  
	load_theme_textdomain( 'secretAddy', TEMPLATEPATH . '/languages' );                                                                                        
                                                                                                                                                             
	$locale = get_locale();                                                                                                                                    
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";                                                                                                    
	if ( is_readable( $locale_file ) )                                                                                                                         
		require_once( $locale_file );                                                                                                                            
                                                                                                                                                             
	// This theme uses wp_nav_menu() in one location.                                                                                                          
	register_nav_menus( array(                                                                                                                                 
		'primary' => __( 'Primary Navigation', 'secretAddy' ),                                                                                                   
	) );                                                                                                                                                       
                                                                                                                                                             
	// This theme allows users to set a custom background                                                                                                      
	add_custom_background();                                                                                                                                   
                                                                                                                                                             
	// Your changeable header business starts here                                                                                                             
	define( 'HEADER_TEXTCOLOR', '' );                                                                                                                          
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.                                                                    
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );                                                                                                    
                                                                                                                                                             
	// The height and width of your custom header. You can hook into the theme's own filters to change these values.                                           
	// Add a filter to secretAddy_header_image_width and secretAddy_header_image_height to change these values.                                                
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'secretAddy_header_image_width', 940 ) );                                                                     
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'secretAddy_header_image_height', 200 ) );                                                                   
                                                                                                                                                             
	// We'll be using post thumbnails for custom header images on posts and pages.                                                                             
	// We want them to be 940 pixels wide by 198 pixels tall.                                                                                                  
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.                                                                
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );                                                                                  
                                                                                                                                                             
	// Don't support text inside the header image.                                                                                                             
	define( 'NO_HEADER_TEXT', true );                                                                                                                          
                                                                                                                                                             
	// Add a way for the custom header to be styled in the admin panel that controls                                                                           
	// custom headers. See secretAddy_admin_header_style(), below.                                                                                             
	add_new_custom_image_header( '', 'secretAddy_admin_header_style' );                                                                                        
                                                                                                                                                             
	// ... and thus ends the changeable header business.                                                                                                       
                                                                                                                                                             
	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.                                               
	register_default_headers( array(                                                                                                                           
		'berries' => array(                                                                                                                                      
			'url' => '%s/images/headers/berries.jpg',                                                                                                              
			'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',                                                                                          
			/* translators: header image description */                                                                                                            
			'description' => __( 'Berries', 'secretAddy' )                                                                                                         
		),                                                                                                                                                       
		'cherryblossom' => array(                                                                                                                                
			'url' => '%s/images/headers/cherryblossoms.jpg',                                                                                                       
			'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',                                                                                   
			/* translators: header image description */                                                                                                            
			'description' => __( 'Cherry Blossoms', 'secretAddy' )                                                                                                 
		),                                                                                                                                                       
		'concave' => array(                                                                                                                                      
			'url' => '%s/images/headers/concave.jpg',                                                                                                              
			'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',                                                                                          
			/* translators: header image description */                                                                                                            
			'description' => __( 'Concave', 'secretAddy' )                                                                                                         
		),                                                                                                                                                       
		'fern' => array(                                                                                                                                         
			'url' => '%s/images/headers/fern.jpg',                                                                                                                 
			'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',                                                                                             
			/* translators: header image description */                                                                                                            
			'description' => __( 'Fern', 'secretAddy' )                                                                                                            
		),                                                                                                                                                       
		'forestfloor' => array(                                                                                                                                  
			'url' => '%s/images/headers/forestfloor.jpg',                                                                                                          
			'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',                                                                                      
			/* translators: header image description */                                                                                                            
			'description' => __( 'Forest Floor', 'secretAddy' )                                                                                                    
		),                                                                                                                                                       
		'inkwell' => array(                                                                                                                                      
			'url' => '%s/images/headers/inkwell.jpg',                                                                                                              
			'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',                                                                                          
			/* translators: header image description */                                                                                                            
			'description' => __( 'Inkwell', 'secretAddy' )                                                                                                         
		),                                                                                                                                                       
		'path' => array(                                                                                                                                         
			'url' => '%s/images/headers/path.jpg',                                                                                                                 
			'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',                                                                                             
			/* translators: header image description */                                                                                                            
			'description' => __( 'Path', 'secretAddy' )                                                                                                            
		),                                                                                                                                                       
		'sunset' => array(                                                                                                                                       
			'url' => '%s/images/headers/sunset.jpg',                                                                                                               
			'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',                                                                                           
			/* translators: header image description */                                                                                                            
			'description' => __( 'Sunset', 'secretAddy' )                                                                                                          
		)                                                                                                                                                        
	) );                                                                                                                                                       
}                                                                                                                                                            
endif;                                                                                                                                                       
                                                                                                                                                             
if ( ! function_exists( 'secretAddy_admin_header_style' ) ) :                                                                                                
/**                                                                                                                                                          
 * Styles the header image displayed on the Appearance > Header admin panel.                                                                                 
 *                                                                                                                                                           
 * Referenced via add_custom_image_header() in secretAddy_setup().                                                                                           
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 */                                                                                                                                                          
function secretAddy_admin_header_style() {                                                                                                                   
?>                                                                                                                                                           
<style type="text/css">                                                                                                                                      
/* Shows the same border as on front end */                                                                                                                  
#headimg {                                                                                                                                                   
	border-bottom: 1px solid #000;                                                                                                                             
	border-top: 4px solid #000;                                                                                                                                
}                                                                                                                                                            
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:                                                                                
	#headimg #name { }                                                                                                                                         
	#headimg #desc { }                                                                                                                                         
*/                                                                                                                                                           
</style>                                                                                                                                                     
<?php                                                                                                                                                        
}                                                                                                                                                            
endif;                                                                                                                                                       
                                                                                                                                                             
/**                                                                                                                                                          
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.                                                                                      
 *                                                                                                                                                           
 * To override this in a child theme, remove the filter and optionally add                                                                                   
 * your own function tied to the wp_page_menu_args filter hook.                                                                                              
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 */                                                                                                                                                          
function secretAddy_page_menu_args( $args ) {                                                                                                                
	$args['show_home'] = true;                                                                                                                                 
	return $args;                                                                                                                                              
}                                                                                                                                                            
add_filter( 'wp_page_menu_args', 'secretAddy_page_menu_args' );                                                                                              
                                                                                                                                                             
/**                                                                                                                                                          
 * Sets the post excerpt length to 40 characters.                                                                                                            
 *                                                                                                                                                           
 * To override this length in a child theme, remove the filter and add your own                                                                              
 * function tied to the excerpt_length filter hook.                                                                                                          
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 * @return int                                                                                                                                               
 */                                                                                                                                                          
function secretAddy_excerpt_length( $length ) {                                                                                                              
	return 40;                                                                                                                                                 
}                                                                                                                                                            
add_filter( 'excerpt_length', 'secretAddy_excerpt_length' );                                                                                                 
                                                                                                                                                             
/**                                                                                                                                                          
 * Returns a "Continue Reading" link for excerpts                                                                                                            
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 * @return string "Continue Reading" link                                                                                                                    
 */                                                                                                                                                          
function secretAddy_continue_reading_link() {                                                                                                                
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'secretAddy' ) . '</a>';                        
}                                                                                                                                                            
                                                                                                                                                             
/**                                                                                                                                                          
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and secretAddy_continue_reading_link().                                  
 *                                                                                                                                                           
 * To override this in a child theme, remove the filter and add your own                                                                                     
 * function tied to the excerpt_more filter hook.                                                                                                            
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 * @return string An ellipsis                                                                                                                                
 */                                                                                                                                                          
function secretAddy_auto_excerpt_more( $more ) {                                                                                                             
	return ' &hellip;' . secretAddy_continue_reading_link();                                                                                                   
}                                                                                                                                                            
add_filter( 'excerpt_more', 'secretAddy_auto_excerpt_more' );                                                                                                
                                                                                                                                                             
/**                                                                                                                                                          
 * Adds a pretty "Continue Reading" link to custom post excerpts.                                                                                            
 *                                                                                                                                                           
 * To override this link in a child theme, remove the filter and add your own                                                                                
 * function tied to the get_the_excerpt filter hook.                                                                                                         
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 * @return string Excerpt with a pretty "Continue Reading" link                                                                                              
 */                                                                                                                                                          
function secretAddy_custom_excerpt_more( $output ) {                                                                                                         
	if ( has_excerpt() && ! is_attachment() ) {                                                                                                                
		$output .= secretAddy_continue_reading_link();                                                                                                           
	}                                                                                                                                                          
	return $output;                                                                                                                                            
}                                                                                                                                                            
add_filter( 'get_the_excerpt', 'secretAddy_custom_excerpt_more' );                                                                                           
                                                                                                                                                             
/**                                                                                                                                                          
 * Remove inline styles printed when the gallery shortcode is used.                                                                                          
 *                                                                                                                                                           
 * Galleries are styled by the theme in Twenty Ten's style.css.                                                                                              
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 * @return string The gallery style filter, with the styles themselves removed.                                                                              
 */                                                                                                                                                          
function secretAddy_remove_gallery_css( $css ) {                                                                                                             
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );                                                                                
}                                                                                                                                                            
add_filter( 'gallery_style', 'secretAddy_remove_gallery_css' );                                                                                              
                                                                                                                                                             
if ( ! function_exists( 'secretAddy_comment' ) ) :                                                                                                           
/**                                                                                                                                                          
 * Template for comments and pingbacks.                                                                                                                      
 *                                                                                                                                                           
 * To override this walker in a child theme without modifying the comments template                                                                          
 * simply create your own secretAddy_comment(), and that function will be used instead.                                                                      
 *                                                                                                                                                           
 * Used as a callback by wp_list_comments() for displaying the comments.                                                                                     
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 */                                                                                                                                                          
function secretAddy_comment( $comment, $args, $depth ) {                                                                                                     
	$GLOBALS['comment'] = $comment;                                                                                                                            
	switch ( $comment->comment_type ) :                                                                                                                        
		case '' :                                                                                                                                                
	?>                                                                                                                                                         
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">                                                                                      
		<div id="comment-<?php comment_ID(); ?>">                                                                                                                
		<div class="comment-author vcard">                                                                                                                       
			<?php echo get_avatar( $comment, 40 ); ?>                                                                                                              
			<?php printf( __( '%s <span class="says">says:</span>', 'secretAddy' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>       
		</div><!-- .comment-author .vcard -->                                                                                                                    
		<?php if ( $comment->comment_approved == '0' ) : ?>                                                                                                      
			<em><?php _e( 'Your comment is awaiting moderation.', 'secretAddy' ); ?></em>                                                                          
			<br />                                                                                                                                                 
		<?php endif; ?>                                                                                                                                          
                                                                                                                                                             
		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">                                  
			<?php                                                                                                                                                  
				/* translators: 1: date, 2: time */                                                                                                                  
				printf( __( '%1$s at %2$s', 'secretAddy' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'secretAddy' ), ' ' );                                                                                                                                                            
                                                                                                                                                             
			?>                                                                                                                                                           

		</div><!-- .comment-meta .commentmetadata -->                                                                                                            
                                                                                                                                                             
		<div class="comment-body"><?php comment_text(); ?></div>                                                                                                 
                                                                                                                                                             
		<div class="reply">                                                                                                                                      
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>                                    
		</div><!-- .reply -->                                                                                                                                    
	</div><!-- #comment-##  -->                                                                                                                                
                                                                                                                                                             
	<?php                                                                                                                                                      
			break;                                                                                                                                                 
		case 'pingback'  :                                                                                                                                       
		case 'trackback' :                                                                                                                                       
	?>                                                                                                                                                         
	<li class="post pingback">                                                                                                                                 
		<p><?php _e( 'Pingback:', 'secretAddy' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'secretAddy'), ' ' ); ?></p>           
	<?php                                                                                                                                                      
			break;                                                                                                                                                 
	endswitch;                                                                                                                                                 
}                                                                                                                                                            
endif;                                                                                                                                                       
                                                                                                                                                             
/**                                                                                                                                                          
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.                                                            
 *                                                                                                                                                           
 * To override secretAddy_widgets_init() in a child theme, remove the action hook and add your own                                                           
 * function tied to the init hook.                                                                                                                           
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 * @uses register_sidebar                                                                                                                                    
 */                                                                                                                                                          
function secretAddy_widgets_init() {                                                                                                                         
	// Area 1, located at the top of the sidebar.                                                                                                              
	register_sidebar( array(                                                                                                                                   
		'name' => __( 'Primary Widget Area', 'secretAddy' ),                                                                                                     
		'id' => 'primary-widget-area',                                                                                                                           
		'description' => __( 'The primary widget area', 'secretAddy' ),                                                                                          
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',                                                                                       
		'after_widget' => '</li>',                                                                                                                               
		'before_title' => '<h3 class="widget-title">',                                                                                                           
		'after_title' => '</h3>',                                                                                                                                
	) );                                                                                                                                                       
                                                                                                                                                             
	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.                                                                         
	register_sidebar( array(                                                                                                                                   
		'name' => __( 'Secondary Widget Area', 'secretAddy' ),                                                                                                   
		'id' => 'secondary-widget-area',                                                                                                                         
		'description' => __( 'The secondary widget area', 'secretAddy' ),                                                                                        
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',                                                                                       
		'after_widget' => '</li>',                                                                                                                               
		'before_title' => '<h3 class="widget-title">',                                                                                                           
		'after_title' => '</h3>',                                                                                                                                
	) );                                                                                                                                                       
}                                                                                                                                                            
/** Register sidebars by running secretAddy_widgets_init() on the widgets_init hook. */                                                                      
add_action( 'widgets_init', 'secretAddy_widgets_init' );                                                                                                     
                                                                                                                                                             
/**                                                                                                                                                          
 * Removes the default styles that are packaged with the Recent Comments widget.                                                                             
 *                                                                                                                                                           
 * To override this in a child theme, remove the filter and optionally add your own                                                                          
 * function tied to the widgets_init action hook.                                                                                                            
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 */                                                                                                                                                          
function secretAddy_remove_recent_comments_style() {                                                                                                         
	global $wp_widget_factory;                                                                                                                                 
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );                                    
}                                                                                                                                                            
add_action( 'widgets_init', 'secretAddy_remove_recent_comments_style' );                                                                                     
                                                                                                                                                             
if ( ! function_exists( 'secretAddy_posted_on' ) ) :                                                                                                         
/**                                                                                                                                                          
 * Prints HTML with meta information for the current post—date/time and author.                                                                              
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 */                                                                                                                                                          
function secretAddy_posted_on() {                                                                                                                            
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'secretAddy' ),                                              
		'meta-prep meta-prep-author',                                                                                                                            
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',                                                          
			get_permalink(),                                                                                                                                       
			esc_attr( get_the_time() ),                                                                                                                            
			get_the_date()                                                                                                                                         
		),                                                                                                                                                       
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',                                                      
			get_author_posts_url( get_the_author_meta( 'ID' ) ),                                                                                                   
			sprintf( esc_attr__( 'View all posts by %s', 'secretAddy' ), get_the_author() ),                                                                       
			get_the_author()                                                                                                                                       
		)                                                                                                                                                        
	);                                                                                                                                                         
}                                                                                                                                                            
endif;                                                                                                                                                       
                                                                                                                                                             
if ( ! function_exists( 'secretAddy_posted_in' ) ) :                                                                                                         
/**                                                                                                                                                          
 * Prints HTML with meta information for the current post (category, tags and permalink).                                                                    
 *                                                                                                                                                           
 * @since Twenty Ten 1.0                                                                                                                                     
 */                                                                                                                                                          
function secretAddy_posted_in() {                                                                                                                            
	// Retrieves tag list of current post, separated by commas.                                                                                                
	$tag_list = get_the_tag_list( '', ', ' );                                                                                                                  
	if ( $tag_list ) {                                                                                                                                         
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'secretAddy' );                                                                                                                                               
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {                                                                                        
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'secretAddy' );   
	} else {                                                                                                                                                   
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'secretAddy' );                                  
	}                                                                                                                                                          
	// Prints the string, replacing the placeholders.                                                                                                          
	printf(                                                                                                                                                    
		$posted_in,                                                                                                                                              
		get_the_category_list( ', ' ),                                                                                                                           
		$tag_list,                                                                                                                                               
		get_permalink(),                                                                                                                                         
		the_title_attribute( 'echo=0' )                                                                                                                          
	);                                                                                                                                                         
}                                                                                                                                                            
endif;                                                                                                                                                       
                                                                                                                                                             
function remove_menus () {                                                                                                                                   
global $menu;                                                                                                                                                
	$restricted = array( __('Posts'), __('Comments'), __('Links'));                                                                                            
	end ($menu);                                                                                                                                               
	while (prev($menu)){                                                                                                                                       
		$value = explode(' ',$menu[key($menu)][0]);                                                                                                              
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}                                                                    
	}                                                                                                                                                          
}                                                                                                                                                            
//add_action('admin_menu', 'remove_menus');                                                                                                                  
                                                                                                                                                             
function remove_dashboard_widgets(){                                                                                                                         
  global $wp_meta_boxes;                                                                                                                                     
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);                                                                                 
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);                                                                         
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);                                                                                   
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);                                                                          
  //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);                                                                             
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);                                                                                 
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);                                                                               
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);                                                                             
}                                                                                                                                                            
                                                                                                                                                             
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');                                                                                                
                                                                                                                                                             
function customize_meta_boxes() {                                                                                                                            
  /* Removes meta boxes from pages */                                                                                                                        
  remove_meta_box('postcustom','page','normal');                                                                                                             
  remove_meta_box('trackbacksdiv','page','normal');                                                                                                          
  remove_meta_box('commentstatusdiv','page','normal');                                                                                                       
  remove_meta_box('commentsdiv','page','normal');                                                                                                            
  remove_meta_box('postimagediv','page','normal');                                                                                                           
  remove_meta_box('linkxfndiv','link','normal');                                                                                                             
  remove_meta_box('linkadvanceddiv','link','normal');                                                                                                        
}                                                                                                                                                            
                                                                                                                                                             
add_action('admin_init','customize_meta_boxes');                                                                                                             
                                                                                                                                                             
/** Disable standard widgets from Widgets page */                                                                                                            function remove_some_wp_widgets(){
                                                                                                                                                             	unregister_widget('WP_Widget_Calendar');                                                                                                                     
	unregister_widget('WP_Widget_Search');                                                                                                                     
	unregister_widget('WP_Widget_Recent_Comments');                                                                                                            
	unregister_widget('WP_Widget_Pages');                                                                                                                      
	//unregister_widget('WP_Widget_Archives');                                                                                                                   
	//unregister_widget('WP_Widget_Links');                                                                                                                    
	unregister_widget('WP_Widget_Meta');                                                                                                                       
	//unregister_widget('WP_Widget_Text');                                                                                                                     
	unregister_widget('WP_Widget_Categories');                                                                                                                 
	//unregister_widget('WP_Widget_Recent_Posts');                                                                                                             
	//unregister_widget('WP_Widget_RSS');                                                                                                                      
	unregister_widget('WP_Widget_Tag_Cloud');                                                                                                                  
	unregister_widget('WP_Nav_Menu_Widget');                                                                                                                   
}                                                                                                                                                            
                                                                                                                                                             
add_action('widgets_init', 'remove_some_wp_widgets', 1);                                                                                                     
                                                                                                                                                             
/** Disable standard Favorite Actions from upper right hand corner */                                                                                        
function custom_favorite_actions($actions) {                                                                                                                 
  //unset($actions['post-new.php']);                                                                                                                         
  //unset($actions['edit.php?post_status=draft']);                                                                                                           
  //unset($actions['post-new.php?post_type=page']);                                                                                                          
  //unset($actions['media-new.php']);                                                                                                                        
  //unset($actions['edit-comments.php']);                                                                                                                    
  return $actions;                                                                                                                                           
}                                                                                                                                                            
                                                                                                                                                             
add_filter('favorite_actions', 'custom_favorite_actions');                                                                                                   
                                                                                                                                                             
/** Disable submenus from Admin Panel */                                                                                                                     
function remove_submenus() {                                                                                                                                 
  global $submenu;                                                                                                                                                               
	                                                                                                                                                           
	//unset($submenu['index.php'][10]); // Removes 'Updates'.                                                                                                  
	//unset($submenu['options-general.php'][15]); // Writing                                                                                                   
	//unset($submenu['options-general.php'][25]); // Discussion                                                                                                
	//unset($submenu['options-general.php'][20]); // Reading                                                                                                   
	//unset($submenu['options-general.php'][40]); // Permalinks                                                                                                
	unset($submenu['themes.php'][10]); // Menus                                                                                                                
	//unset($submenu['themes.php'][5]); // Themes                                                                                                              
	//unset($submenu[ 'ms-admin.php' ][20]); // Network Themes                                                                                                 
                                                                                                                                                             
}                                                                                                                                                            
                                                                                                                                                             
add_action('admin_menu', 'remove_submenus');                                                                                                                 
                                                                                                                                                             
function custom_login() {                                                                                                                                    
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/custom-login/custom-login.css" />';                          
}                                                                                                                                                            
add_action('login_head', 'custom_login');  

//hook the administrative header output our custom logo
add_action( 'admin_head', 'az_custom_logo');

function az_custom_logo() {
	echo '
		<style type="text/css">
			#header-logo { background-image: url('.get_bloginfo('template_directory').'/custom-login/images/admin_logo.png ) }
			#wphead { 
				background: -moz-linear-gradient(center bottom , #000000, #000000) repeat scroll 0 0 transparent 
			}
			#wphead h1 a { color: #FFFFFF }
			#user_info, #user_info:hover { color: #FF1493; }
			#user_info a:link, #user_info a:visited, #user_info a:active { color: #000000; }
			#footer a:link, #footer a:visited, #footer a:active {
				color:#FFFFFF;
				text-decoration:none;
			}
			#footer {
				background:-moz-linear-gradient(center bottom , #000000, #000000) repeat scroll 0 0 transparent;
				border-color:#5650CE;
				color:#EFFFFF;
			}
		</style>';
}                                                                                                                  
                                                                                                                                                             
//Remove Wordpress update                                                                                                                                    
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );                                                                     
                                                                                                                                                                                                                      
require_once ( get_template_directory() . '/plugins/register.php' );  
require_once ( get_template_directory() . '/plugins/contactform.php' );          

?>
<?php

/**                                                                                                                                                        
 * The template for displaying 404 pages (Not Found).                                                                                                      
 *                                                                                                                                                         
 * @package WordPress                                                                                                                                      
 * @subpackage SecretAddy                                                                                                                                  
 * @since SecretAddy                                                                                                                                       
 */                                                                                                                                                          

get_header(); ?>                                                                                                                                           
                                                                                                                                                           
		<div id="container2" class="one-column">                                                                                                               
			<div id="content" role="main">                                                                                                                       

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                                                                                          
					<h1 class="entry-title"><?php _e( 'Not Found', 'secretAddy' ); ?></h1>                                                                           

					<div class="entry-content">                                                                                                                      
						<p><?php _e( 'Apologies, but the page you requested could not be found.', 'secretAddy' ); ?></p>                                               
					</div><!-- .entry-content -->                                                                                                                    
				</div><!-- #post-## -->                                                                                                                                           

			</div><!-- #content -->                                                                                                                              
		</div><!-- #container -->                                                                                                                              

<?php get_footer(); ?>
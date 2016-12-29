<?php	                                                                                                                                                                                                                                                                                                                      
session_start();           

/**
 * Template Name: Admirer Results
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
	
	$start = $_GET['num'];
	
	$initial = $start - 5;
	
	if ( empty($start) )
	{   
    $start = 0;
  }                                                                                                                                               
										                                                                                                                                          
	$me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );                                                 
	                                                                                                                                                            
	$friend = mysql_query("SELECT     	secretAddy,                                                                                                             
																									admirer                                                                                                      
																			  FROM      		admirer                                                                                                 
																			  WHERE     	secretAddy = '".$me->secretAddy."'                                                                        
																			  OR        			admirer = '".$me->secretAddy."'
																			  AND				friend = 'Y'
                                        LIMIT     ".$start.",5 ");                                                                   
	                                                                                                                                                            
	$num_rows = mysql_num_rows($friend);                                                                                                                                                                                                                                                                                                            
                                                                                                                                                              
if ( isset($_SESSION['secretID']) )                                                                                                                           
{                                                                                                                    
	?>                                                                                                                                                          
	                                                                                                                                                            
		<div id="container">                                                                                                                                      
			<div id="content" role="main">                                                                                                                          
			                                                                                                                                                        
				<h1 class="entry-title"><?php the_title(); ?></h1>                                                                                                                 
          <p id="move">
				  <a href="/connect" title="Connect by Email"><img src="/wp-content/themes/secretAddy/images/connect_image.jpg" alt="Connect by Email" title="Connect by Email" height="60px" width="160px" /></a>
          </p>                                                                                                                                                              
					<div class="entry-content">                                                                                                                         
							<div id="results">                                                                                                                              
								<?php                                                                                                                                               
									if ( $num_rows > 0 )                                                                                                                        
									{                                                                                                                                                    
										while ( $addys = mysql_fetch_assoc( $friend ) )                                                                                           
										{                                                                                                                                         
											$secret = $wpdb->get_row( $wpdb->prepare( "SELECT ID, secretAddy FROM account WHERE secretAddy != '".$me->secretAddy."' AND (secretAddy = '".$addys['secretAddy']."' OR secretAddy = '".$addys['admirer']."') ") );                                                                                     
											                                                                                                                                        
											$secretAdmir = $wpdb->get_row( $wpdb->prepare( "SELECT reference FROM randomID WHERE ID = ".$secret->ID) );                             
											                                                                                                                                        
											 $status = $wpdb->get_row( $wpdb->prepare("SELECT status FROM statuses WHERE secretAddy = '".$secret->secretAddy."' ") );               
											echo '                                                                                                                                  
														<p id="titlePlace">                                                                                                                      
																<a href="/admirer/?ref='.$secretAdmir->reference.'" title="'.$secret->secretAddy.'">'.$secret->secretAddy.'</a>: '.$status->status.'
															<div id="rosePlace">
															<form method="get" action="/wp-content/themes/secretAddy/route.php">                                                  
																	<input type="hidden" name="sentFrom" value="'.$me->secretAddy.'" />                                                           
																	<input type="hidden" name="sentTo" value="'.$secret->secretAddy.'" />                                                       
																	<input type="hidden" name="type" value="rose" />    
                                <input type="hidden" name="ref" value="'.$secretAdmir->reference.'" />              
				    												<input type="hidden" name="website" value="'.$_SERVER['REQUEST_URI'].'" />                                             
																	  <input type="submit" name="send_rose" value="Send Rose" class="button" />                                                   
														  </form>
														  </div>
														  <div id="removePlace">
														  <form method="get" action="/wp-content/themes/secretAddy/route.php">
																			<input type="hidden" name="me" value="'.$me->secretAddy.'" />
																			<input type="hidden" name="desire" value="'.$secret->secretAddy.'" /> 
															<input type="submit" name="remove_desire" value="Remove Admirer" class="button" />
														  </form>                                                                                                                                        
														  </div>
														</p>';
                            $start++;                                                                                                                          
										}
										
                    if ( $start < 5 || 5 == $num_rows )
										{
                      echo '';
                    }
                    elseif ( $start >= $num_rows )
										{
                      echo '
                      <p>
                      <a href="admirer-results?num='.$initial.'" title="Previous">Previous</a>
                      </p>';
                    }
                    elseif ( $start == 5 && 5 < $num_rows )
                    {
                      echo '
                      <p>
                      <a href="/admirer-results?num='.$start.'" title="Next">Next</a>
                      </p>';
                    } 
                    else
                    { 
                      echo '
                      <p>
                      <a href="/admirer-results?num='.$initial.'" title="Previous">Previous</a>  
                      <a href="/admirer-results?num='.$start.'" id="nextButton" title="Next">Next</a>
                      </p>';
                    }                                                                                                                                                                      
									}                                                                                                                                           
									else                                                                                                                                        
									{                                                                                                                                           
										echo 'You do not have any Admirers at this time.<br />
												To Connect with Admirers <a href="/connect/" title="Click Here">Click Here</a>';                                                                                        
									}                                                                                                                                             
								?>                                                                                                                                            
							</div>                                                                                                                                          
					</div><!-- .entry-content -->                                                                                                                       
                                                                                                                                                              
			</div><!-- #content -->                                                                                                                                 
		</div><!-- #container -->                                                                                                                                 
                                                                                                                                                              
<?php get_sidebar('profile'); ?>                                                                                                                              
<?php get_footer(); 
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
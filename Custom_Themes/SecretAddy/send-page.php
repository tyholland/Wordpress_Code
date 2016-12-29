<?php     
session_start();
                                                                                                                                            
/**                                                                                                                                                            
 * Template Name: Send                                                                                                                                         
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
										                                                                                                                                           
$me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );                                                    
                                                                                                                                                               
$friend = mysql_query("SELECT     	secretAddy,                                                                                                                
																									admirer                                                                                                   
																			  FROM      		admirer                                                                                                  
																			  WHERE     	secretAddy = '".$me->secretAddy."'                                                                         
																			  OR        			admirer = '".$me->secretAddy."' 
																			  AND				friend = 'Y' ");
                                        
$gifts = mysql_query("SELECT image FROM gifts WHERE category = 'animals' ORDER BY RAND() LIMIT 0,3");                                                                    
	                                                                                                                                                             
$num_rows = mysql_num_rows($friend);                                                                                                                                                       

if ( isset($_SESSION['secretID']) )                                                                                                                            
{                                                                                                                         
                                                                                                                                                               
?>                                                                                                                                                             
                                                                                                                                                               
		<div id="container">                                                                                                                                       
			<div id="content" role="main">                                                                                                                           
                                                                                                                                                               
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>                                                                                              
                                                                                                                                                               
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                                                                                              
                                                                                                                                                               
					<div class="entry-content"> 
					<form method="post" action="/wp-content/themes/secretAddy/route.php">                                                                     
					  <input type="hidden" name="sentFrom" value="<?php echo $me->secretAddy; ?>" />
				    <input type="hidden" name="website" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />                                                                      
						<b>Admirer:</b>                                                                                                                                    
						<?php                                                                                                                                              
						if ( $num_rows > 0 )                                                                                                                               
						{                                                                                                                                                  
						                                                                                                                                                   
						  echo '<select name="admir">';                                                                                                                    
						                                                                                                                                                   
						  while ( $addy = mysql_fetch_assoc($friend) )                                                                                                     
						  {                                                                                                                                                
						  		                                                                                                                                             
								$secret = $wpdb->get_row( $wpdb->prepare( "SELECT secretAddy FROM account WHERE secretAddy != '".$me->secretAddy."' AND (secretAddy = '".$addy['secretAddy']."' OR secretAddy = '".$addy['admirer']."') ") );                                                                                                  
							                                                                                                                                                 
								echo '<option value="'.$secret->secretAddy.'">'.$secret->secretAddy.'</option>';                                                               
						  }                                                                                                                                                
						  		echo '</select>';                                                                                                                            
						}                                                                                                                                                  
						else                                                                                                                                               
						{                                                                                                                                                  
						  		echo 'You have no Admirers';                                                                                                                 
						}                                                                                                                                                  
						?>							                                                                                                                                   
						<p class="priv">                                                                                                                                   
							<b>Subject:</b> <input type="text" name="subject" size="35" />                                                                                   
							<br /><br />                                                                                                                                     
							<b>Message:</b> <br />                                                                                                                           
							<textarea name="msg" cols="80" rows="10"></textarea>                                                                                             
							<br>
              <hr> 
              <?php
              
              $checkCredit = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$me->secretAddy."' ") ); 
              
              if ( $checkCredit->amount == 0 || $checkCredit->amount < 2)
              { 
                echo '';
              }
              else
              {  ?> 
                  <input type="button" name="add_gift" value="Add A Gift" onclick="Open('gifts')" /><a href="#" onclick="alert('Spice your message up, ADD AN ADDY GIFT...\nIt\'s only 2 CREDITS!');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.png" id="help" /></a>
                  <div class="gifts">
                  <ul id="rotate">
                  <?php
                    $gifts = mysql_query("SELECT ID, image FROM gifts WHERE category = 'animals' ORDER BY ID ASC LIMIT 0,10");
                    $i = 1;
                    while ($present = mysql_fetch_assoc($gifts))
                    { 
                      echo '<li class="article" id="c'.$i.'"><center><img src="/wp-content/themes/secretAddy/images/store/'.$present['image'].'" height="150px" width="150px" alt="'.$present['image'].'" title="'.$present['image'].'" /><br><input type="radio" name="toy" value="'.$present['image'].'" /></center></li>'; 
                      $i++;
                    }
                  
                  ?>
                  </ul>
                  <input type="button" id="change" value="More" />
                  </div> 
                  <br><br>                 
              <?php
              } 
              ?>                                                                                                                                                  
							<input type="submit" name="send_message" value="Send" />                                                                                         
            </p>		                                                                                                                                           
					</form> 
					</div><!-- .entry-content -->                                                                                                                        
				</div><!-- #post-## -->                                                                                                                                
                                                                                                                                                               
<?php endwhile; ?>                                                                                                                                             
                                                                                                                                                               
			</div><!-- #content -->                                                                                                                                  
		</div><!-- #container --> 
    
<script type='text/javascript'>
  //<![CDATA[ 
  $(window).load(function(){
   $('#c1').live('partyTime', function() {
          var articles = $('li');
          articles.each(function(i, el) {
              el.id = 'c' + (el.id.substring(1) - 1);
          });
          this.id = 'c10';
      });
  
      $('#change').click(function () {
        $('#c1').trigger('partyTime');
      });
  });
  //]]> 
</script>                                                                                                                                  
                                                                                                                                                               
<?php get_sidebar('inbox'); ?>                                                                                                                                 
<?php get_footer(); 
}
else
{    	
?>
  <div id="container2" class="one-column">
			<div id="content" role="main">
			
				<h1 class="entry-title">Send A Message</h1>

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
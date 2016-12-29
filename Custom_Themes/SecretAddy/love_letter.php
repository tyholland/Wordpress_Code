<?php	

$path = '/home/saddy/public_html/wp-load.php';

require_once($path); 
	
session_start(); 

?>
<style type='text/css'>
ul#rotate {
  position: relative;
  width: 460px;
  height: 180px;
  overflow: hidden;
	list-style: none;
}

li.article {
  position: absolute;
  width: 150px;
  height: 180px;
  overflow: hidden;
	list-style: none;
}

li#c1 {top: 0; left: 0; z-index: 1000;}
li#c2 {top: 0; left: 170px; z-index: 999;}
li#c3 {top: 0; left: 340px; z-index: 998;}
li#c4 {top: 0; left: 510px; z-index: 997;}
li#c5 {top: 0; left: 680px; z-index: 996;}
li#c6 {top: 0; left: 850px; z-index: 995;}
li#c7 {top: 0; left: 1020px; z-index: 994;}
li#c8 {top: 0; left: 1190px; z-index: 993;}
li#c9 {top: 0; left: 1360px; z-index: 992;}
li#c10 {top: 0; left: 1530px; z-index: 991;} 
</style>  

<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/jquery.js"></script> 
<script type="text/javascript">		
function Open(name)
{
	var el = $('.' + name).css("display");
	
	if ( el == 'none' )
	{
		$('.' + name).css("display", "block"); 
	}
	else
	{
		$('.' + name).css("display", "none"); 
	} 
}
</script>   
<?php
if ( !empty($_SESSION['secretID']) )
{            

  $ref = $_GET['ref'];
  
  $reference = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM randomID WHERE reference = '".$ref."' ") );
  
  $secret = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = '".$reference->ID."' ") );
                                        
  $gifts = mysql_query("SELECT ID, image FROM gifts WHERE category = 'animals' ORDER BY ID ASC LIMIT 0,10");
  
  $addy = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );
?>
		<div id="container2" class="one-column">
			<div id="content" role="main">
			
				<h1 class="entry-title">Pass A Note</h1>

					<div class="entry-content">                                                                                                                          
					<form method="post" action="/wp-content/themes/secretAddy/route.php">                                                                     
					  <input type="hidden" name="sentFrom" value="<?php echo $addy->secretAddy; ?>" />
				    <input type="hidden" name="website" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />                                                                      
						<b>Admirer:</b>                                                                                                                                    
						<?php                                                                                                                                              
						  echo '<input type="hidden" name="admir" value="'.$secret->secretAddy.'">
              '.$secret->secretAddy;                                                                                                                                                 
						?>							                                                                                                                                   
						<p class="priv">
						<?php
						if ( isset($_GET['sub']) )
						{
							echo '<b>Subject:</b> <input type="hidden" name="subject" value="'.$_GET['sub'].'" />'.$_GET['sub'];
						}
						else
						{
							echo '<b>Subject:</b> <input type="text" name="subject" size="35" />';
						}
						?>                                                                                   
							<br /><br />                                                                                                                                     
							<b>Message:</b> <br />                                                                                                                           
							<textarea name="msg" cols="80" rows="10" style="resize: none;"></textarea>                                                                                               
							<br>
              <hr>
              <?php
              
              $checkCredit = $wpdb->get_row( $wpdb->prepare("SELECT amount FROM credits WHERE secretAddy = '".$addy->secretAddy."' ") ); 
              
              if ( $checkCredit->amount == 0 || $checkCredit->amount < 2)
              { 
                echo '';
              }
              else
              { ?> 
                 <input type="button" name="add_gift" value="Add A Gift" onclick="Open('gifts')" /><a href="#" onclick="alert('Spice your message up, ADD AN ADDY GIFT...\nIt\'s only 2 CREDITS!');" title="Help"><img src="/wp-content/themes/secretAddy/images/help.jpg" style="margin: 0 0 -6px 0;" /></a>
                          <div class="gifts" style="height: 200px; display: none;">
                          <ul id="rotate">
                          <?php
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
							<input type="submit" name="send_letter" value="Send" />                                                                                         
            </p>		                                                                                                                                           
					</form>
          <br /> 
					</div><!-- .entry-content -->

			</div><!-- #content -->
		</div><!-- #container -->  
<script type="text/javascript">	
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

<?php
}
else
{
	wp_redirect(get_option('siteurl').'/');
}
?>
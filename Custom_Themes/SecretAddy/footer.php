<?php

/**                                                                                                                                                            
 * The template for displaying the footer.                                                                                                                     
 *                                                                                                                                                             
 * Contains the closing of the id=main div and all content                                                                                                     
 * after.  Calls sidebar-footer.php for bottom widgets.                                                                                                        
 *                                                                                                                                                             
 * @package WordPress                                                                                                                                          
 * @subpackage SecretAddy                                                                                                                                      
 * @since SecretAddy                                                                                                                                           
 */                                                                                                                                                            
?>                                                                                                                                                             
	</div><!-- #main -->                                                                                                                                         
                                                                                                                                                               
	<div id="footer" role="contentinfo">                                                                                                                         
		<div id="colophon">                                                                                                                                        
		                                                                                                                                                           
		<?php                                                                                                                                                      
			include('botMenu.php');                                                                                                                                  
		?>                                                                                                                                                         
                                                                                                                                                               
			<div id="site-generator">                                                                                                                                
				<?php do_action( 'secrectAddy_credits' ); ?>                                                                                                           
				                                                                                                                                                       
				                                                                                                                                                       
					<?php printf( __('copyright 2011 %s', 'secretAddy'), 'SecretAddy, Inc' ); ?><br>
					<ul style="display: block; width: 400px; list-style: none outside none; margin: 7px 0 0 0;">
          <li style="position: relative; float: left; width: 140px;"><a href="https://twitter.com/SecAddy" class="twitter-follow-button" data-show-count="false">Follow @SecAddy</a>
          <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script></li>
          <li style="position: relative; float: left; width: 100px;"><div id="fb-root"></div>
          <script>(function(d){
            var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
            js = d.createElement('script'); js.id = id; js.async = true;
            js.src = "//connect.facebook.net/en_US/all.js#appId=174178735989624&xfbml=1";
            d.getElementsByTagName('head')[0].appendChild(js);
          }(document));</script>
          <div class="fb-like" data-href="https://www.facebook.com/SecretAddy" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div></li>
          <li style="position: relative; float: left; width: 140px;"><a href="http://secretaddy.com/links-page.php" style="color:#E1E1E1;">SA GotLinks</a></li>
          <ul>                                                                                  
				                                                                                                                                                       
			</div><!-- #site-generator -->                                                                                                                           
                                                                                                                                                               
		</div><!-- #colophon -->                                                                                                                                   
	</div><!-- #footer --> 

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17231674-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>      
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>  
<script type="text/javascript" src="/wp-content/themes/secretAddy/functions.js"></script>                                                                                                                                       
                                                                                                                                                               
</div><!-- #wrapper -->   
</div> <!-- #newMain -->                                                                                                                                  
                                                                                                                                                               
<?php                                                                                                                                                          
	/* Always have wp_footer() just before the closing </body>                                                                                                   
	 * tag of your theme, or you will break many plugins, which                                                                                                  
	 * generally use this hook to reference JavaScript files.                                                                                                    
	 */                                                                                                                                                          
                                                                                                                                                               
	wp_footer();                                                                                                                                                 
?>                                                                                                                                                             
</body>                                                                                                                                                        
</html>       
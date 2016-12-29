<?php   
$path = '/home/saddy/public_html/wp-load.php';                                                                                                        
                                                                                                                                                            
require_once($path); 

session_start();

get_header(); 

?>

		<div id="container2" class="one-column">
			<div id="content" role="main">

				<div>
						<h1 class="entry-title">Links Page</h1>

					<div class="entry-content">
						<?php 
						// This option defines the number of columns used to display categories
            $GLCatCol = "2";
            
            // This option defines the number of links displayed per page
            $GLLPP = "25";
            
            // This option defines whether links are opened in a new web browser window
            // (1 = Yes, 0 = No)
            $GLNW = "1";
            
            // This option determines whether the search function is enabled
            // for your links page (1 = Yes, 0 = No)
            $GLAS = "1";
            
            $GLKey = "1XKQ-763R-ZJ4F";
            
            // ********************************************************************
            // *****Please DO NOT make any edits or changes to the code below******
            // ********************************************************************
            
            $PageName = $_SERVER["PHP_SELF"];
            
            $GLQS  = "script=php&UserKey=".urlencode($GLKey)."&ScriptName=".urlencode($PageName)."&CatCols=" .urlencode($GLCatCol)."&LinksPerPage=".urlencode($GLLPP)."&OpenInNewWindow=" .urlencode($GLNW)."&AllowSearch=".urlencode($GLAS);
            
            if(!is_array($_GET)) $_GET = $HTTP_GET_VARS;
            
            foreach ($_GET as $key => $value) {
                $GLQS .= "&$key=".urlencode(stripslashes($value));
            }
            
            if(intval(get_cfg_var('allow_url_fopen')) && function_exists('readfile')) {
                if(!@readfile("http://www.gotlinks.com/engine2.php?".$GLQS)) {
                    print "Error processing request";
                }
            }
            elseif(intval(get_cfg_var('allow_url_fopen')) && function_exists('file')) {
                if(!($content = @file("http://www.gotlinks.com/engine2.php?".$GLQS))) {
                    print "Error processing request";
                }
                else {
                    print @join('', $content);
                }
            }
            elseif(function_exists('curl_init')) {
                $ch = curl_init ("http://www.gotlinks.com/engine2.php?".$GLQS);
                curl_setopt ($ch, CURLOPT_HEADER, 0);
                curl_exec ($ch);
            
                if(curl_error($ch))
                    print "Error processing request";
            
                curl_close ($ch);
            }
            else {
                print "It seems that your web host has disabled all functions for handling remote pages and as a result the GotLinks software will not function on your web site. Please contact your web host and ask them to enable PHP curl or fopen.";
            }
						?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
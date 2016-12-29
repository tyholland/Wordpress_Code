<?php	
session_start();           

/**
 * Template Name: Pick Up
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
	
	$initial = $start - 15;
	
	if ( empty($start) )
	{   
    $start = 0;
  } 
  
  $pickUpTotal = mysql_query("SELECT message, date FROM pickUpLines ORDER BY ID DESC LIMIT ".$start.",15 ");
   
  $pickUp = mysql_query("SELECT message, date FROM pickUpLines ORDER BY ID DESC");
	
	$num_rows = mysql_num_rows($pickUp);
	?>
	
		<div id="container2" class="one-column">
			<div id="content" role="main">
			
				<h1 class="entry-title"><?php echo the_title(); ?></h1>

					<div class="entry-content">
							<div id="results">
						<p>
						Read and Learn from all the different Pick Up Lines. Or add a Pick Up Line of your own.
						</p>
						<p>
						<form method="post" action="/wp-content/themes/secretAddy/route.php">
						<textarea name="lines" rows="5" cols="60"></textarea><br />
						<input type="submit" name="edit_lines" value="Add Pick Up Line" />
						</form>
						</p>
								<?php
									if ( $num_rows > 0 )
									{								
										while ( $post = mysql_fetch_assoc( $pickUpTotal ) )
										{                          
											echo '<p> <b>'.$post['date'].'</b> - '.stripslashes($post['message']).'</p>';
											$start++; 
										}
															
										if ( $start < 15 || 15 == $num_rows )
										{
                      echo '';
                    }
                    elseif ( $start >= $num_rows )
										{
                      echo '
                      <p>
                      <a href="/pick-up-lines/?num='.$initial.'" title="Previous">Previous</a>
                      </p>';
                    }
                    elseif ( $start == 15 && 15 < $num_rows )
                    {
                      echo '
                      <p>
                      <a href="/pick-up-lines/?num='.$start.'" title="Next">Next</a>
                      </p>';
                    } 
                    else
                    { 
                      echo '
                      <p>
                      <a href="/pick-up-lines/?num='.$initial.'" title="Previous">Previous</a>  
                      <a href="/pick-up-lines/?num='.$start.'" id="nextButton" title="Next">Next</a>
                      </p>';
                    }
									}
									else
									{
										echo 'There are no Pick Up Lines posted at this time.<br />
                          						Be the first to post a Pick Up Line.';
									}
								?>
							</div>
					</div><!-- .entry-content -->

			</div><!-- #content -->
		</div><!-- #container -->
<?php get_footer();
?>

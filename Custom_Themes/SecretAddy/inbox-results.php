<?php

$path = '/home/saddy/public_html/wp-load.php';

require_once($path);

session_start();

if ( isset($_SESSION['secretID']) )
{
get_header();   

$id = $_GET['id'];
$sent = $_GET['sent'];

$recieve = $wpdb->get_row( $wpdb->prepare("SELECT * FROM inbox WHERE ID = ".$id ) );
$sender = $wpdb->get_row( $wpdb->prepare("SELECT * FROM inbox WHERE ID = ".$sent ) );

?>

		<div id="container">
			<div id="content" role="main">

					<div class="entry-content">
					<?php
					 if ( !empty($id) )
					 {    
              $wpdb->update( 'inbox', array( 'readMessage' => 'Y' ), array( 'ID' => $id ) );
  						echo '
  						<table>
    						<tr>  
      						<th align="left" class="message" width="600">
      							'.stripslashes($recieve->subject).'
      						</th>
    						</tr>
    						<tr>
    							<td>
    								<br />'.stripslashes($recieve->message).'
    							</td>
    						</tr>
  						</table>';
						}
						elseif ( !empty($sent) )
						{   
  						echo '
  						<table>
    						<tr>  
      						<th align="left" class="message" width="600">
      							'.stripslashes($sender->subject).'
      						</th>
    						</tr>
    						<tr>
    							<td>
    								<br />'.stripslashes($sender->message).'
    							</td>
    						</tr>
  						</table>';
            }
						?>
					</div><!-- .entry-content -->

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar('inbox'); ?>
<?php get_footer(); 
}
else
{
	wp_redirect('/');
}
?>
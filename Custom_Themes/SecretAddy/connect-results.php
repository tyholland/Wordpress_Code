<?php	 
	
session_start();

$path = '/home/saddy/public_html/wp-load.php';

require_once($path); 

/*--------------------------------------------------------------
This searches the database of all SecretAddy members depending
on the search criteria that you choose.
------------------------------------------------------------------*/

$id = $_GET['id'];
$theName = $_GET['admirSearch'];
$radio = $_GET['radio'];
$refine = $_GET['refine'];
$website = $_GET['website'];
$city = $_GET['city'];
$state = $_GET['state'];
$zip = $_GET['zip'];
$gender = $_GET['gender'];
$age = $_GET['age'];
$body = $_GET['body'];
$hair = $_GET['hair'];
$race = $_GET['race'];
$height = $_GET['height'];  
$book = $_GET['favBook'];
$food = $_GET['favFood'];
$color = $_GET['favColor'];
$sport = $_GET['favSport'];
$movie = $_GET['favMovie'];
$tv = $_GET['favTv'];
$song = $_GET['favSong'];
$singer = $_GET['favSing'];
$skool = $_GET['highSkool'];
$college = $_GET['college'];
$job = $_GET['job'];  
$hobby1 = $_GET['hobby1'];
$hobby2 = $_GET['hobby2'];
$hobby3 = $_GET['hobby3'];
$hobby4 = $_GET['hobby4'];
$hobby5 = $_GET['hobby5'];

$start = $_GET['num'];
    	
$initial = $start - 10;

if ( empty($start) )
{   
  $start = 0;
} 

if ( $radio == '0' )
{	
	if ( empty($theName) )
	{
		echo '	<script type="text/javascript">                                                                                                                    
						alert("The Connect Field is empty.\nPlease Try again");                                                                                                         
						window.location = "'.get_option('siteurl').'/connect/character/"                                                                                             
						</script>'; 
	}
	else
	{
			$statement = "SELECT		DISTINCT account.ID, secretAddy
									FROM				account, interests
									WHERE		  	interests.ID = account.ID 
									AND		  		(					secretAddy LIKE '%".$theName."%' 
															OR				hobby1 LIKE '%".$theName."%' 
															OR				hobby2 LIKE '%".$theName."%' 
															OR				hobby3 LIKE '%".$theName."%' 
															OR				hobby4 LIKE '%".$theName."%' 
															OR				hobby5 LIKE '%".$theName."%' 
															OR				book LIKE '%".$theName."%'
															OR		  		food LIKE '%".$theName."%'
															OR				movie LIKE '%".$theName."%'
															OR		  		color LIKE '%".$theName."%' 
															OR				sport LIKE '%".$theName."%' 
															OR		  		song LIKE '%".$theName."%' 
															OR          		singer LIKE '%".$theName."%' 
															OR		  		tv LIKE '%".$theName."%' 
															OR				skool LIKE '%".$theName."%'
															OR		  		college LIKE '%".$theName."%'
															OR				job LIKE '%".$theName."%' 
															OR				zip = '".$theName."' 
															OR				gender = '".$theName."' 
															OR				city = '".$theName."' 
															OR				state = '".$theName."' 
															OR				age = '".$theName."' 
															OR				bodyType = '".$theName."' 
															OR				hair = '".$theName."'
															OR				ethnicity = '".$theName."' 
															OR				height = '".$theName."') "; 
		
			  if ( $refine == 'yes' )
			  {
					if ( $zip != 'None' )
								{
								  $statement .= "AND          zip = '".$zip."' ";
				  }    
								if ( $city != 'None' )
								{
								  $statement .= "AND		  		city = '".$city."' "; 
				  }  
								if ( $state != 'None' )
								{
								  $statement .= "AND				  state = '".$state."' ";  
				  } 
								if ( $gender != 'None' )
								{
								  $statement .= "AND          gender = '".$gender."' ";
				  }  
			  }
					
$secret = mysql_query($statement);     
			  
$statement .= "LIMIT ".$start.",10 ";
$theSecret = mysql_query($statement);
	}
}
elseif ( $radio == '1' )
{
	$statement = "SELECT		DISTINCT account.ID, secretAddy
							FROM				account, interests
							WHERE		  	interests.ID = account.ID ";
							if ( $zip != 'None' )
							{
							  $statement .= "AND          zip = '".$zip."' ";
			  }    
							if ( $gender != 'None' )
							{
							  $statement .= "AND          gender = '".$gender."' ";
			  }  
							if ( $city != 'None' )
							{
							  $statement .= "AND		  		city = '".$city."' "; 
			  }  
							if ( $state != 'None' )
							{
							  $statement .= "AND				  state = '".$state."' ";  
			  }  
							if ( $age != 'None' )
							{
							  $endAge = $age + 10;
							  $statement .= "AND		  		age BETWEEN '".$age."' AND '".$endAge."' ";   
			  }  
							if ( $body != 'None' )
							{
							  $statement .= "AND				  bodyType = '".$body."' ";  
			  }  
							if ( $hair != 'None' )
							{
							  $statement .= "AND		  		hair = '".$hair."' ";  
			  }  
							if ( $race != 'None' )
							{
							  $statement .= "AND				  ethnicity = '".$race."' ";  
			  }  
							if ( $height != 'None' )
							{
							  $statement .= "AND		  		height = '".$height."' "; 
			  } 
							if ( !empty($job) )
							{
							  $statement .= "AND				  job LIKE '%".$job."%' ";   
			  }   
					
$secret = mysql_query($statement);     
			  
$statement .= "LIMIT ".$start.",10 ";
$theSecret = mysql_query($statement);
}	
elseif ( $radio == '2' )
{
	$statement = "SELECT		DISTINCT account.ID, secretAddy
							FROM				account, interests
							WHERE		  	interests.ID = account.ID ";
							if ( !empty($hobby1) )
							{
							  $statement .= "AND		  		(hobby1 LIKE '%".$hobby1."%' 
								OR hobby2 LIKE '%".$hobby1."%' 
								OR hobby3 LIKE '%".$hobby1."%' 
								OR hobby4 LIKE '%".$hobby1."%' 
								OR hobby5 LIKE '%".$hobby1."%') ";   
			  }  
							if ( !empty($hobby2) )
							{
							  $statement .= "AND		  		(hobby1 LIKE '%".$hobby2."%' 
								OR hobby2 LIKE '%".$hobby2."%' 
								OR hobby3 LIKE '%".$hobby2."%' 
								OR hobby4 LIKE '%".$hobby2."%' 
								OR hobby5 LIKE '%".$hobby2."%') "; 
			  }  
							if ( !empty($hobby3) )
							{
							  $statement .= "AND		  		(hobby1 LIKE '%".$hobby3."%' 
								OR hobby2 LIKE '%".$hobby3."%' 
								OR hobby3 LIKE '%".$hobby3."%' 
								OR hobby4 LIKE '%".$hobby3."%' 
								OR hobby5 LIKE '%".$hobby3."%') ";  
			  }  
							if ( !empty($hobby4) )
							{
							  $statement .= "AND		  		(hobby1 LIKE '%".$hobby4."%' 
								OR hobby2 LIKE '%".$hobby4."%' 
								OR hobby3 LIKE '%".$hobby4."%' 
								OR hobby4 LIKE '%".$hobby4."%' 
								OR hobby5 LIKE '%".$hobby4."%') ";  
			  }  
							if ( !empty($hobby5) )
							{
							  $statement .= "AND		  		(hobby1 LIKE '%".$hobby5."%' 
								OR hobby2 LIKE '%".$hobby5."%' 
								OR hobby3 LIKE '%".$hobby5."%' 
								OR hobby4 LIKE '%".$hobby5."%' 
								OR hobby5 LIKE '%".$hobby5."%') "; 
			  }
              if ( $refine == 'yes' )
              {
					if ( $zip != 'None' )
								{
								  $statement .= "AND          zip = '".$zip."' ";
				  }    
								if ( $city != 'None' )
								{
								  $statement .= "AND		  		city = '".$city."' "; 
				  }  
								if ( $state != 'None' )
								{
								  $statement .= "AND				  state = '".$state."' ";  
				  } 
								if ( $gender != 'None' )
								{
								  $statement .= "AND          gender = '".$gender."' ";
				  }  
              } 
					
$secret = mysql_query($statement);     
			  
$statement .= "LIMIT ".$start.",10 ";
$theSecret = mysql_query($statement);
}
elseif ( $radio == '3' )
{
	$statement = "SELECT		DISTINCT account.ID, secretAddy
							FROM				account, interests
							WHERE		  	interests.ID = account.ID ";
							if ( !empty($book) )
							{
							  $statement .= "AND				  book LIKE '%".$book."%' "; 
			  }  
							if ( !empty($food) )
							{
							  $statement .= "AND		  		food LIKE '%".$food."%' "; 
			  }  
							if ( !empty($movie) )
							{
							  $statement .= "AND				  movie LIKE '%".$movie."%' ";   
			  }  
							if ( !empty($color) )
							{
							  $statement .= "AND		  		color LIKE '%".$color."%' ";  
			  }  
							if ( !empty($sport) )
							{
							  $statement .= "AND				  sport LIKE '%".$sport."%' ";   
			  }  
							if ( !empty($song) )
							{
							  $statement .= "AND		  		song LIKE '%".$song."%' ";   
			  }  
							if ( !empty($singer) )
							{
							  $statement .= "AND          singer LIKE '%".$singer."%' ";   
			  }  
							if ( !empty($tv) )
							{
							  $statement .= "AND		  		tv LIKE '%".$tv."%' ";   
			  }          
              if ( $refine == 'yes' )
              {
					if ( $zip != 'None' )
								{
								  $statement .= "AND          zip = '".$zip."' ";
				  }    
								if ( $city != 'None' )
								{
								  $statement .= "AND		  		city = '".$city."' "; 
				  }  
								if ( $state != 'None' )
								{
								  $statement .= "AND				  state = '".$state."' ";  
				  } 
								if ( $gender != 'None' )
								{
								  $statement .= "AND          gender = '".$gender."' ";
				  }  
              }     
					
$secret = mysql_query($statement);     
			  
$statement .= "LIMIT ".$start.",10 ";
$theSecret = mysql_query($statement);
}
else
{
	$statement = "SELECT		DISTINCT account.ID, secretAddy
							FROM				account, interests
							WHERE		  	interests.ID = account.ID ";
							if ( !empty($skool) )
							{
							  $statement .= "AND				  skool LIKE '%".$skool."%' "; 
			  }  
							if ( !empty($college) )
							{
							  $statement .= "AND		  		college LIKE '%".$college."%' ";  
			  }           
              if ( $refine == 'yes' )
				  {
					if ( $zip != 'None' )
								{
								  $statement .= "AND          zip = '".$zip."' ";
				  }    
								if ( $city != 'None' )
								{
								  $statement .= "AND		  		city = '".$city."' "; 
				  }  
								if ( $state != 'None' )
								{
								  $statement .= "AND				  state = '".$state."' ";  
				  }  
								if ( $gender != 'None' )
								{
								  $statement .= "AND          gender = '".$gender."' ";
				  }  
              }   
					
$secret = mysql_query($statement);     
			  
$statement .= "LIMIT ".$start.",10 ";
$theSecret = mysql_query($statement);
}									
																					
if ( !empty($secret) )
{										
 $num_rows = mysql_num_rows($secret);
}
else
{										
 $num_rows = 0;
}

if ( isset($_SESSION['secretID']) )
{
	get_header(); 
										
	$me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = ".$_SESSION['secretID']) );
	?>
	
		<div id="container">
			<div id="content" role="main">
			
				<h1 class="entry-title">Possible Connections</h1>

					<div class="entry-content">
							<div id="results">
								<?php
									if ( $num_rows > 0 )
									{
									  $secret1 = mysql_query("SELECT DISTINCT city FROM account WHERE city != '' ");
                    $secret2 = mysql_query("SELECT DISTINCT state FROM account WHERE state != '' ");
                    $secret3 = mysql_query("SELECT DISTINCT zip FROM account WHERE zip != '' ");
                    $secret4 = mysql_query("SELECT DISTINCT gender FROM account WHERE gender != '' ");
										
                    echo '<p style="margin: 0 0 10px 0;">
                    <a href="#" title="Refined Connection" onclick="Open(\'refined\')" id="reconnect">Refined Connection:</a>
												<div class="refined">'; ?>
												
										<form method="get" action="<?php echo $_SERVER['REQUEST_URI']; ?>">	 
				            <input type="hidden" name="refine" value="yes" />
				            <input type="hidden" name="radio" value="<?php echo $radio; ?>" /> 
				            <input type="hidden" name="website" value="<?php echo $website; ?>" /> 
                    <?php
                      if ( $radio == 0 )
                      {
                        echo '<input type="hidden" name="admirSearch" value="'.$theName.'" />
                              <input type="hidden" name="id" value="'.$id.'" />';
                      }
                      elseif ( $radio == 1 )
                      {    
                        echo '<input type="hidden" name="age" value="'.$age.'" />
                              <input type="hidden" name="body" value="'.$body.'" />
                              <input type="hidden" name="hair" value="'.$hair.'" />
                              <input type="hidden" name="race" value="'.$race.'" />
                              <input type="hidden" name="height" value="'.$height.'" />';
                      }   
                      elseif ( $radio == 2 )
                      {
                        echo '<input type="hidden" name="hobby1" value="'.$hobby1.'" />
                              <input type="hidden" name="hobby2" value="'.$hobby2.'" />
                              <input type="hidden" name="hobby3" value="'.$hobby3.'" />
                              <input type="hidden" name="hobby4" value="'.$hobby4.'" />
                              <input type="hidden" name="hobby5" value="'.$hobby5.'" />';
                      } 
                      elseif ( $radio == 3 )
                      {
                        echo '<input type="hidden" name="favBook" value="'.$book.'" />
                              <input type="hidden" name="favFood" value="'.$food.'" />
                              <input type="hidden" name="favColor" value="'.$color.'" />
                              <input type="hidden" name="favSport" value="'.$sport.'" />
                              <input type="hidden" name="favMovie" value="'.$movie.'" />
                              <input type="hidden" name="favTv" value="'.$tv.'" />
                              <input type="hidden" name="favSong" value="'.$song.'" />
                              <input type="hidden" name="favSing" value="'.$singer.'" />';
                      }
                      elseif ( $radio == 4 )
                      {
                        echo '<input type="hidden" name="highSkool" value="'.$skool.'" />
                              <input type="hidden" name="college" value="'.$college.'" />
                              <input type="hidden" name="job" value="'.$job.'" />';
                      }
                    ?>  
                    Gender: <select name="gender">    
    								<option value="None">None</option>                                                                         
    								<?php while ( $addy4 = mysql_fetch_assoc($secret4) )                                                                          
    								{ ?>                                                                                                                            
    									<option<?php if ( $addy4['gender'] == $gender ) { echo ' selected="selected"'; } ?> value="<?php echo $addy4['gender']; ?>"><?php echo $addy4['gender']; ?></option>                                                         
    								<?php	
    								}?>                                                                                                                           
    								</select>   	
									<span style="margin: 0 0 0 20px;">City: <select name="city">     
    								<option value="None">None</option>                                                                                
    								<?php while ( $addy = mysql_fetch_assoc($secret1) )                                                                          
    								{  ?>                                                                                                                           
    									<option<?php if ( $addy['city'] == $city ) { echo ' selected="selected"'; } ?>  value="<?php echo $addy['city']; ?>"><?php echo $addy['city']; ?></option> 
    								<?php	
    								}?>                                                                                                                           
    								</select></span><br />
    								State: <select name="state">
    								<option value="None">None</option>
    								<?php while ( $addy2 = mysql_fetch_assoc($secret2) )                                                                          
    								{    ?>                                                                                                                           
    									<option<?php if ( $addy2['state'] == $state ) { echo ' selected="selected"'; } ?>  value="<?php echo $addy2['state']; ?>"><?php echo strtoupper($addy2['state']); ?></option> 
    								<?php	                                                     
    								}?>                                                                                                                           
    								</select>
    								<span style="margin: 0 0 0 34px;">Zip: <select name="zip">          
    								<option value="None">None</option>                                                                   
    								<?php while ( $addy3 = mysql_fetch_assoc($secret3) )                                                                          
    								{  
    									if ( is_numeric($addy3['zip']) )
    									{?>                                                                                                                           
    									<option<?php if ( $addy3['zip'] == $zip ) { echo ' selected="selected"'; } ?>  value="<?php echo $addy3['zip']; ?>"><?php echo $addy3['zip']; ?></option> 
    								<?php
    									}
    								}?>                                                                                                                           
    								</select></span><br />
    								<input type="submit" value="Filter" />
    								</form>
                     
    								<?php
										echo '</div>';
										echo '</p>';
										while ( $addys = mysql_fetch_assoc( $theSecret ) )
										{
											$secretAdmir = $wpdb->get_row( $wpdb->prepare( "SELECT reference FROM randomID WHERE ID = ".$addys['ID']) ); 
											$status = $wpdb->get_row( $wpdb->prepare("SELECT 		status
																													FROM				statuses
																													WHERE			secretAddy = '".$addys['secretAddy']."' ") );
											  $friend = $wpdb->get_row( $wpdb->prepare("SELECT   	secretAddy, 
																							admirer, 
																							friend 
																		FROM    		admirer 
																		WHERE   	(secretAddy = '".$me->secretAddy."' 
																							AND admirer = '".$addys['secretAddy']."') 
																		OR      			(secretAddy = '".$addys['secretAddy']."' 
																							AND admirer = '".$me->secretAddy."') ") );
												
                        											
												if ( $addys['secretAddy'] == $me->secretAddy )
    										{
    											$location = '<a href="'.get_option('siteurl').'/profile-page" title="'.$addys['secretAddy'].'">';
    											$rosePlace = '';
                          $addPlace = '';
    										}
    										else
    										{
    											$location = '<a href="/admirer/?ref='.$secretAdmir->reference.'" title="'.$addys['secretAddy'].'">';
    											$rosePlace = '<div id="rosePlace">		
														<form method="get" action="/wp-content/themes/secretAddy/route.php">
																<input type="hidden" name="sentFrom" value="'.$me->secretAddy.'" />
																<input type="hidden" name="sentTo" value="'.$addys['secretAddy'].'" />                                                  
																<input type="hidden" name="type" value="rose" />   
                                <input type="hidden" name="ref" value="'.$secretAdmir->reference.'" />         
				    											<input type="hidden" name="website" value="'.$_SERVER['REQUEST_URI'].'" />   
																<input type="submit" name="send_rose" value="Send Rose" class="button" />
													  </form>
														  </div>';
													$addPlace = '<div id="addPlace">
														  <form method="get" action="/wp-content/themes/secretAddy/route.php">
																<input type="hidden" name="me" value="'.$me->secretAddy.'" />
																<input type="hidden" name="desire" value="'.$addys['secretAddy'].'" />
                  												<input type="hidden" name="add_desire" value="Add Admirer" />
                                <input type="hidden" name="ref" value="'.$secretAdmir->reference.'" />  
																<input type="hidden" name="destination" value="'.$_SERVER['REQUEST_URI'].'" />
																<input type="submit" name="add_desire" value="Add Admirer" class="button" />
															</form>
															</div>';
    										}
											
                      echo '
														<p>
															'.$location.'<b>'.$addys['secretAddy'].':</b></a> '.$status->status; 
													echo $rosePlace;
															
														if ( !empty($friend->friend) && $friend->friend == 'Y' )
														  {
																echo '';
														  }
														  else
														  {
																echo $addPlace;
														  }
														echo '</p>';  
                      $start++; 
										}
                    if ( $start < 10 || 10 == $num_rows )
										{
                      echo '';
                    }
                    elseif ( $start >= $num_rows )
										{
                      echo '
                      <p>
                      <a href="'.$_SERVER['REQUEST_URI'].'&num='.$initial.'" title="Previous">Previous</a>
                      </p>';
                    }
                    elseif ( $start == 10 && 10 < $num_rows )
                    {
                      echo '
                      <p>
                      <a href="'.$_SERVER['REQUEST_URI'].'&num='.$start.'" title="Next">Next</a>
                      </p>';
                    } 
                    else
                    { 
                      echo '
                      <p>
                      <a href="'.$_SERVER['REQUEST_URI'].'&num='.$initial.'" title="Previous">Previous</a>  
                      <a href="'.$_SERVER['REQUEST_URI'].'&num='.$start.'" id="nextButton" title="Next">Next</a>
                      </p>';
                    }
									}
									else
									{
										echo 'No one matches your Search Criteria. <br />Please <a href="'.$website.'" title="try again">try again</a>.';
									}
								?>
							</div>
					</div><!-- .entry-content -->

			</div><!-- #content -->
		</div><!-- #container -->
		
<?php get_sidebar('connect'); ?>
<?php get_footer(); 
}
else
{
	wp_redirect(get_option('siteurl').'/');
}
?>
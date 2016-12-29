<?php
session_start();
/**
 * Template Name: Registration Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Gladiators
 * @since Gladiators 1.2
 */

if ( isset($_POST['submit_register']) ) {
	$fname = stripslashes($_REQUEST['fname']);
	$lname = stripslashes($_REQUEST['lname']);
	$gender = stripslashes($_REQUEST['gender']);
	$age = stripslashes($_REQUEST['age']);
	$feet = stripslashes($_REQUEST['feet']);
	$inch = stripslashes($_REQUEST['inch']);
	$weight = stripslashes($_REQUEST['weight']);
	$grade = stripslashes($_REQUEST['grade']);
	$returnPlayer = stripslashes($_REQUEST['returnPlayer']);
	$newPlayer = stripslashes($_REQUEST['newPlayer']);
	$shirt = stripslashes($_REQUEST['shirt']);
	$shorts = stripslashes($_REQUEST['shorts']);
	$street = stripslashes($_REQUEST['street']);
	$city = stripslashes($_REQUEST['city']);
	$state = stripslashes($_REQUEST['state']);
	$zip = stripslashes($_REQUEST['zip']);
	$momName = stripslashes($_REQUEST['momName']);
	$dadName = stripslashes($_REQUEST['dadName']);
	$email = stripslashes($_REQUEST['email']);
	$phone = stripslashes($_REQUEST['phone']);
	$health = stripslashes($_REQUEST['health']);
    $cr = "\n";
	
	$cvData = 'First Name'.','.'Last Name'.','.'Age'.','.'Gender'.','.'Player Height(ft)'.','.'Player Height(inches)'.','.'Player Weight(lbs)'.','.'Grade'.','.'Returning Player'.','.'New Player'.','.'Uniform Size'.','.'Street Address'.','.'City'.','.'State'.','.'Zip'.','.'Mother\'s Name'.','.'Father\'s Name'.','.'Parent\'s Email'.','.'Parent\'s Phone #'.','.'Health Issues'.$cr;
	$cvData .=	$fname.','.$lname.','.$age.','.$gender.','.$feet.','.$inch.','.$weight.','.$grade.','.$returnPlayer.','.$newPlayer.','.$shirt.','.$street.','.$city.','.$state.','.$zip.','.$momName.','.$dadName.','.$email.','.$phone.','.$health.$cr;

	$thisfile = 'PlayerRegistration.csv';

	$encoded = chunk_split(base64_encode($cvData));
	$random_hash = md5(uniqid(time()));

    $theMsg = "This is a multi-part message in MIME format.\r\n";
    $theMsg .= "--".$random_hash."\r\n";
    $theMsg .= "Content-type:text/html; charset=iso-8859-1\r\n";
    $theMsg .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $theMsg .= "New Player Registration Form\r\n\r\n";
    $theMsg .= "--".$random_hash."\r\n";
    $theMsg .= "Content-Type: text/csv; name=\"".$thisfile."\"\r\n";
    $theMsg .= "Content-Transfer-Encoding: base64\r\n";
    $theMsg .= "Content-Disposition: attachment; filename=\"".$thisfile."\"\r\n\r\n";
    $theMsg .= $encoded."\r\n\r\n";
    $theMsg .= "--".$random_hash."--";

	$mail_to = "ovil@msn.com";
	$mail_subject = "CGBC Online Registration Form";
	$mail_body = '<html><body>'.$theMsg.'</body></html>';
	$mail_header = "From: Commonwealth Gladiators <noreply@cgbasketballclub.com>\n" . "MIME-Version: 1.0\r\n" . "Content-Type: multipart/mixed; boundary=\"".$random_hash."\"\r\n\r\n";

	if ( mail($mail_to, $mail_subject, $mail_body, $mail_header) ) {
		echo '<script type="text/javascript">                                                                                                                      
		alert("Your message has been sent.\nWe will respond back shortly.");  
		window.location.href="/home/";                                                                                 
		</script>';
	} 
	else {
		echo '<script type="text/javascript">                                                                                                                      
		alert("Email not sent.");         
		window.location.href="/spring-tryouts/registration/";                                                                                                          
		</script>';
	}   
}

get_header(); ?>

		<script type="text/javascript">
			function registerCheck(formobj) {
				var email = $("#email").val(),
					fname = $("#fname").val(),
					lname = $("#lname").val(),
					age = $("#age").val(),
					gender = $("#gender").val(),
					grade = $("#grade").val(),
					shirt = $("#shirt").val(),
					street = $("#street").val(),
					city = $("#city").val(),
					state = $("#state").val(),
					zip = $("#zip").val(),
					phone = $("#phone").val(),
					feet = $("#feet").val(),
					inch = $("#inch").val(),
					weight = $("#weight").val(),
					momName = $("#momName").val(),
					dadName = $("#dadName").val(),
					returnPlayer = $("#returnPlayer").val(),
					newPlayer = $("#newPlayer").val(),
					msg = "";

				if (fname == "" || lname == "") {
					msg += "Please Enter your Player\'s Name.\n";
				}

				if (age == "") {
					msg += "Please Select your Player\'s Age.\n";
				}

				if (gender == "") {
					msg += "Please Select your Player\'s Gender.\n";
				}

				if (feet == "" || inch == "" || weight == "") {
					msg += "Please Select your Player\'s Info.\n";
				}

				if (grade == "") {
					msg += "Please Select your Player\'s Grade.\n";
				}

				if (returnPlayer == "") {
					msg += "Is your Player a Returning Player.\n";
				}

				if (newPlayer == "") {
					msg += "Is your Player a New Player.\n";
				}

				if (shirt == "") {
					msg += "Please Select your Player\'s Uniform Size.\n";
				}

				if (street == "" || city == "" || state == "" || zip == "") {
					msg += "Please Enter your Player\'s Address.\n";
				}

				if (momName == "" || dadName == "") {
					msg += "Please Enter your Parent\'s Names.\n";
				}

				var pos = email.indexOf("@",0);
				if (pos == -1) {
					msg += "Please Enter a valid Parent Email.\n";
				}
				else {
					var pos2 = email.indexOf("@", pos + 1),
						pos3 = email.indexOf(".", pos + 1),
						diff = pos3 - pos;

					if (pos2 != -1 || diff <= 3) {
						msg += "Please Enter a valid Parent Email.\n";
					}
				}

				if (phone == "") {
					msg += "Please Enter your Parent's Phone Number.\n";
				}                                                                                                                             

				if (msg == "") {
					return true;
				}
				else {
					alert(msg);
					return false;
				}
			}
		</script>

		<div id="container">
			<div id="content" role="main">

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php if ( is_front_page() ) { ?>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php } else { ?>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php } ?>

						<div class="entry-content">
							<?php the_content(); ?>

							<strong><a href="#" id="mail">Click to Register by Mail</a></strong>
							<div id="mailDiv" class="hide">
								<br>
								<p>
									<a href="/wp-content/uploads/2015/10/RegistrationForm.pdf" target="_blank">Click here</a> to download a PDF version of the Registration Form
								</p>
								<p>
									<em><u>Tryout Registration Fee:</u></em><br>
									$20 pre-register/$30 day of registration
								</p>
								<p>
									<em><u>Make Check payable to:</u></em><br>
									Commonwealth Gladiators
								</p>
								<p>
									<em><u>Mail Registration Form and Check to:</u></em><br>
									Oliver Vil<br>
									1414 Somerset Ave<br>
									Taunton, MA 02780<br>
								</p>
							</div>
							<br><br>
							<p>
								<strong><a href="#" id="online">Click to Register Online</a></strong>
								<div id="onlineDiv" class="hide">
									<form action="" class="registerForm" name="registerForm" method="post" onsubmit="return registerCheck(this);">
										<div class="contactSpace">
											<label>Player Name:</label>
											<ul>
												<li>
													<input type="text" name="fname" id="fname" class="contactInput" placeholder="First Name" />
												</li>
												<li>
													<input type="text" name="lname" id="lname" class="contactInput" placeholder="Last Name" />
												</li>
											</ul>
										</div>
										<div class="contactSpace">
											<label>Age:</label>
											<ul>
												<li>
													<input type="tel" name="age" id="age" class="contactInput" placeholder="Age of Player" maxlength="2">
												</li>
											</ul>
										</div>
										<div class="contactSpace">
											<label>Gender:</label>
											<ul>
												<li>
													<select name="gender" id="gender">
														<option value="">Select a Gender</option>
														<option value="male">male</option>
														<option value="female">female</option>
													</select>
												</li>
											</ul>
										</div>
										<div class="contactSpace">
											<label>Player Info:</label>
											<ul>
												<li>
													<select name="feet" id="feet">
														<option value="">Height in Feet</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
													</select>
												</li>
												<li>
													<select name="inch" id="inch">
														<option value="">Height in Inches</option>
														<option value="1">01</option>
														<option value="2">02</option>
														<option value="3">03</option>
														<option value="4">04</option>
														<option value="5">05</option>
														<option value="6">06</option>
														<option value="7">07</option>
														<option value="8">08</option>
														<option value="9">09</option>
														<option value="10">10</option>
														<option value="11">11</option>
													</select>
												</li>
												<li>
													<input type="tel" name="weight" id="weight" class="contactInput" placeholder="Weight in lbs" maxlength="3" />
												</li>
											</ul>
										</div>
										<div class="contactSpace">
											<label>Grade:</label>
											<ul>
												<li>
													<select name="grade" id="grade">
														<option value="">Select a Grade</option>
														<option value="03">3rd</option>
														<option value="04">4th</option>
														<option value="05">5th</option>
														<option value="06">6th</option>
														<option value="07">7th</option>
														<option value="08">8th</option>
														<option value="09">9th</option>
														<option value="10">10th</option>
														<option value="11">11th</option>
														<option value="12">12th</option>
													</select>
												</li>
											</ul>
										</div>
										<div class="contactSpace">
											<label>Returning Player:</label>
											<ul>
												<li>
													<input type="text" name="returnPlayer" id="returnPlayer" class="contactInput" placeholder="Returning Player? Yes or No" maxlength="3">
												</li>
											</ul>
										</div>
										<div class="contactSpace">
											<label>New Player:</label>
											<ul>
												<li>
													<input type="text" name="newPlayer" id="newPlayer" class="contactInput" placeholder="New Player? Yes or No" maxlength="3">
												</li>
											</ul>
										</div>
										<div class="contactSpace">
											<label>Uniform Size:</label>
											<ul>
												<li>
													<select name="shirt" id="shirt">
														<option value="">Select a Uniform Size</option>
														<option value="small">Small</option>
														<option value="medium">Medium</option>
														<option value="large">Large</option>
														<option value="xlarge">XLarge</option>
														<option value="xxlarge">XXLarge</option>
													</select>
												</li>
											</ul>
										</div>
										<div class="contactSpace">
											<label>Player's Address:</label>
											<ul>
												<li>
													<input type="text" name="street" id="street" class="contactInput" placeholder="Street Address" />
												</li>
												<li>
													<input type="text" name="city" id="city" class="contactInput" placeholder="City" />
												</li>
												<li>
													<input type="text" name="state" id="state" class="contactInput" placeholder="State" maxlength="2" />
												</li>
												<li>
													<input type="tel" name="zip" id="zip" class="contactInput" placeholder="Zip Code" maxlength="5" />
												</li>
											</ul>
										</div>
										<div class="contactSpace">
											<label>Parent Info:</label>
											<ul>
												<li>
													<input type="text" name="momName" id="momName" class="contactInput" placeholder="Mother's Name" />
												</li>
												<li>
													<input type="text" name="dadName" id="dadName" class="contactInput" placeholder="Father's Name" />
												</li>
												<li>
													<input type="email" name="email" id="email" class="contactInput" placeholder="Parent's Email" />
												</li>
												<li>
													<input type="tel" name="phone" id="phone" class="contactInput" placeholder="Parent's Phone #" maxlength="10" />
												</li>
											</ul>
										</div>
										<div class="contactSpace">
											<label>Any Health Issues, The Gladiators Should Be Aware Of:<br>If Yes, Please Explain:</label>
											<ul>
												<li>
													<textarea name="health" id="health" class="contactInput" placeholder="List any Health Issues"></textarea>
												</li>
											</ul>
											<p>
												Disclaimers and Releases:  Commonwealth Gladiators Basketball Club, the organizers, sponsors, volunteers and players assume no responsibility for injury to the child named above.  All right and claims are waived by the undersigned parent or guardian.  The undersigned parent or guardian gives approval for the participation of their child in all activities of Commonwealth Gladiators Basketball Club during the tryouts, practices and season and assumes all the risks and hazards incidental to the conduct of the activities and transportation to and from the activities.  Tryout and Program Fees are Non-Refundable.  The undersigned releases Commonwealth Gladiators AAU Basketball Program of any liability under this program.
											</p>
										</div>
										<div class="contactSpace">
											<p>
												<em><u>Tryout Registration Fee:</u></em><br>
												$20 pre-register/$30 day of registration
											</p>
											<p>
												<em><u>Make Check payable to:</u></em><br>
												Commonwealth Gladiators
											</p>
											<p>
												<em><u>Mail Check to:</u></em><br>
												Oliver Vil<br>
												1414 Somerset Ave<br>
												Taunton, MA 02780<br>
											</p>
										</div>
										<div class="contactSpace">
											<input type="submit" value="Submit" name="submit_register" class="submit_contact" />
										</div>
									</form>
								</div>
							</p>
							
							<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'gladiators' ), 'after' => '</div>' ) ); ?>
							<?php edit_post_link( __( 'Edit', 'gladiators' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-content -->
					</div><!-- #post-## -->

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #container -->

		<script type="text/javascript">
			$('#mail').on('click', function(e) {
				e.preventDefault();
				$('#mailDiv').toggle();
			});
			
			$('#online').on('click', function(e) {
				e.preventDefault();
				$('#onlineDiv').toggle();
			});
		</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
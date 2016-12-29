<?php
session_start();
/**
 * Template Name: Contact Page
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

if ( isset($_POST['submit_contact']) ) {    
	$fname = $_REQUEST['fname']; 
	$email = $_REQUEST['email'];
	$message = $_REQUEST['message'];
	
	$theMsg = '
		First Name: '.$fname.'<br><br>
		Email Address: '.$email.'<br><br>
		Message:<br>'.$message.'<br><br>
	';

	$mail_to = "ovil@msn.com";
	$mail_subject = "Contact Us Page Comment";
	$mail_body = "<html><body>".stripslashes($theMsg)."</body></html>";
	$mail_header = "From: Commonwealth Gladiators <noreply@cgbasketballclub.com>\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";

	if ( mail($mail_to, $mail_subject, $mail_body, $mail_header) ) {
		echo '<script type="text/javascript">                                                                                                                      
		alert("Your message has been sent.\nWe will respond back shortly.");  
		window.location.href="/home/";                                                                                 
		</script>';
	} 
	else {
		echo '<script type="text/javascript">                                                                                                                      
		alert("Email not sent.");         
		window.location.href="/contact-us/";                                                                                                          
		</script>';
	}     
}

get_header(); ?>

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

							<script type="text/javascript">
								function contactCheck(formobj) {
									var email = $("#email").val(),
										fname = $("#fname").val(),
										msg = "";

									if (fname == "") {
										msg += "Please Enter your Name.\n";
									}

									pos = email.indexOf("@",0);
									if (pos == -1) {
										msg += "Please Enter a valid Email.\n";
									}
									else {
										pos2 = email.indexOf("@", pos + 1);
										pos3 = email.indexOf(".", pos + 1);
										diff = pos3 - pos;

										if (pos2 != -1 || diff <= 3) {
											msg += "Please Enter a valid Email.\n";
										}
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

							<form action="" name="contactform" method="post" onsubmit="return contactCheck(this);">
								<div class="contactSpace">
									<input type="text" name="fname" id="fname" class="contactInput" placeholder="Enter your Name" />
								</div>
								<div class="contactSpace">
									<input type="text" name="email" id="email" class="contactInput" placeholder="Enter your Email Address" />
								</div>
								<div class="contactSpace">
									<textarea name="message" id="message" class="contactInput" placeholder="Enter your Message"></textarea>
								</div>
								<div class="contactSpace">
									<input type="submit" value="Submit" name="submit_contact" class="submit_contact" />
								</div>
							</form>
							<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'gladiators' ), 'after' => '</div>' ) ); ?>
							<?php edit_post_link( __( 'Edit', 'gladiators' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-content -->
					</div><!-- #post-## -->

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
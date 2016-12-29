<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Gladiators
 * @since Gladiators 1.0
 */
?>
	</div><!-- #main -->

	<div class="mobileMenu">
		<ul>
			<li>
				<a href="/about-us/">About Us</a>
			</li>
			<li>
				<a href="/teams/">Teams</a>
			</li>
			<li>
				<a href="/campsclinics/">Camps/Clinics</a>
			</li>
			<li>
				<a href="/media/">Media</a>
			</li>
			<li>
				<a href="/fall-tryouts/">Fall Tryouts</a>
			</li>
			<li>
				<a href="/testimonials/">Testimonials</a>
			</li>
			<li>
				<a href="/store/">Store</a>
			</li>
			<li>
				<a href="/news/social-media/">Social Media</a>
			</li>
			<li>
				<a href="/news/sponsors/">Sponsors</a>
			</li>
			<li>
				<a href="/contact-us/">Contact Us</a>
			</li>
		</ul>
	</div>

	<div id="footer" role="contentinfo">
		<div id="colophon">

<?php
	/*
	 * A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>

			<div id="site-info">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</div><!-- #site-info -->

			<div id="site-generator">
				<?php
				/**
				 * Fires before the Gladiators credits in the footer.
				 *
				 * @since Gladiators 1.0
				 */
				do_action( 'gladiators_credits' ); ?>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'gladiators' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'gladiators' ); ?>"><?php printf( __( 'Proudly powered by %s.', 'gladiators' ), 'WordPress' ); ?></a>
			</div><!-- #site-generator -->

		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/*
	 * Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

<script type="text/javascript">
	$('.p1').on('click', function(e) {
		e.preventDefault();
		$('.coach').toggle();
	});

	$('.p2').on('click', function(e) {
		e.preventDefault();
		$('.roster').toggle();
	});

	$('.p3').on('click', function(e) {
		e.preventDefault();
		$('.practice').toggle();
	});

	$('.p4').on('click', function(e) {
		e.preventDefault();
		$('.game').toggle();
	});

	$('.togLink').on('click', function(e) {
		e.preventDefault();
		var clickable = $(this).find('span').attr('class');
		$('.' + clickable + 'Go').toggle();
	});

	$('.menuTrigger').on('click', function() {
		var mobileNav = $('.mobileMenu').css('display');

		mobileNav !== 'none' ? menuClose() : menuOpen();
	});

	function menuOpen() {
		$('.mobileMenu').css('display', 'block');
		$('.menuTrigger').html('X');
		$('#main').hide();
	}

	function menuClose() {
		$('.mobileMenu').css('display', 'none');
		$('.menuTrigger').html('menu');
		$('#main').show();
	}
</script>

</body>
</html>

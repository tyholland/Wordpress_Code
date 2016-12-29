<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Test Hoodiezz
 * @since Test Hoodiezz 1.0
 */

get_header(); 
?>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

	<div id="container">
		<div id="content" role="main">

			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php 
				_e( 'Not Found', 'test_hoodiezz' ); 
				?></h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found.', 'test_hoodiezz' ); ?></p>
      				<div class="errorMsg">
						<div class="badSearch">
							We're sorry, we don't have that Hoodie yet. Tell us the Hoodie you want and we'll have it here for you in a few days.
						</div>
					</div>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #container -->

<?php 
get_footer(); 
?>
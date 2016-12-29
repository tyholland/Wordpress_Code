<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage SecretAddy
 * @since SecretAddy
 */
?>

		<div id="primary" class="widget-area" role="complementary">
			<ul class="connect">
		
				<li>
					<h3><a href="/connect" id="connect-admirer" title="Connect by Email">Connect by Email</a></h3>
				</li>
				<li>
					<h3><a href="/connect/character" id="character" title="Connect by Traits">Connect by Traits</a></h3>
				</li> 
				<li>
					<h3><a href="/connect/activity" id="activity" title="Connect by Activities">Connect by Activities</a></h3>
				</li>
				<li>
					<h3><a href="/connect/favorite" id="favorite" title="Connect by Favorites">Connect by Favorites</a></h3>
				</li>
				<li>
					<h3><a href="/connect/education" id="education" title="Connect by Education">Connect by Education</a></h3>
				</li>
				
			</ul>
			
		<ul class="xoxo">
				<li class="widget-container">
				  <p style="width: 150px; padding: 8px 15px;">Want to Learn some new Pick Up Lines? <a href="/pick-up-lines/">Click Here</a></p>
				</li> 
				<?php
				if ( ! dynamic_sidebar( 'primary-widget-area' ) ) :

				 endif; // end primary widget area ?>
		</ul>
		</div><!-- #primary .widget-area -->

<?php
session_start();

if ( isset($_SESSION['secretID']) )
{
echo '
<div class="menu-header">
	<ul>
		<li>
			<a href="/contact-us/" title="Contact Us">Contact Us</a>
		</li>
		<li>
			<a href="/secret-addy-links-page/" title="Links">Links</a>
		</li>
		<li>
			<a href="/terms-conditions/" title="Terms & Conditions">Terms & Conditions</a>
		</li>
		<li>
			<a href="/tutorials/" title="Tutorials">Tutorials</a>
		</li> 
		<li>
			<a href="/about-us/" title="About Us">About Us</a>
		</li> 
		<li>
			<a href="/blog/" title="Blog">Blog</a>
		</li>
	</ul>
</div>';
$inactive = 20; // Set timeout period in seconds
$inactive = $inactive * 60;
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        $wpdb->update( 'account', array( 'online' => 'N' ), array( 'ID' => $_SESSION['secretID'] ) ); 
		session_destroy();
		wp_redirect('/');
    }
}
$_SESSION['timeout'] = time();
}
else
{
echo '
<div class="menu-header">
	<ul>
		<li>
			<a href="/contact-us/" title="Contact Us">Contact Us</a>
		</li>
		<li>
			<a href="/secret-addy-links-page/" title="Links">Links</a>
		</li>
		<li>
			<a href="/terms-conditions/" title="Terms & Conditions">Terms & Conditions</a>
		</li>
		<li>
			<a href="/tutorials/" title="Tutorials">Tutorials</a>
		</li> 
		<li>
			<a href="/about-us/" title="About Us">About Us</a>
		</li> 
		<li>
			<a href="/blog/" title="Blog">Blog</a>
		</li>
		<li>
			<a href="/" title="Home">Home</a>
		</li>
	</ul>
</div>';
}
?>
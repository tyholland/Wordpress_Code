<?php
session_start();
/**
 * Template Name: Teaser Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Test Hoodiezz
 * @since Test Hoodiezz 1.0
 */

global $wpdb;

$products = $wpdb->get_results('SELECT * FROM productUpload ORDER BY ID DESC LIMIT 5');

foreach ( $products as $item) {
	$line .= '<li><div style="text-align: center;">';
	
	$line .= '<a href="'.stripslashes($item->prod_link).'" target="_blank"><img src="'.stripslashes($item->prod_img).'" width="187" height="187" /><br>';
	$line .= '<strong>'.stripslashes($item->prod_name).'</strong></a><br>';

	if (stripslashes($item->prod_sale) < stripslashes($item->prod_price) && stripslashes($item->prod_sale) != '') {
		$line .= '<strike>$'.stripslashes($item->prod_price).'</strike> $'.stripslashes($item->prod_sale).'<br>';
	} else {
		$line .= '$'.stripslashes($item->prod_price).'<br>';
	}
	$line .= '<strong>From:</strong><br>'.stripslashes($item->prod_store).'<br>';
	
	$line .= '</div></li>';
}

get_header();
?>
<div style="margin: 10px 0;">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Above the Fold Text -->
	<ins class="adsbygoogle"
	     style="display:block"
	     data-ad-client="ca-pub-6878956929412680"
	     data-ad-slot="4110390850"
	     data-ad-format="auto"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>

<div style="padding: 0 5%">
	<h1>A Free Online Marketplace for Clothing Lines</h1>
	<h3>Looking for a Place to Advertise Your Products For Free? You Found It</h3>

	<div class="fleft clear">
		<strong>Show Your Products on Hoodiezz.com and Receive...</strong>
		<ul>
			<li>
				FREE Advertising in our Shopping Mall. (We Don't Take Any Fees, or Commissions)
			</li>
			<li>
				EXTRA EXPOSURE!! Benefit from our daily traffic, &amp; get shout outs on our Social Media Pages
			</li>
			<li>
				LINK BUILDING!! All of your product links lead back to your site. Create Sales &amp; Build Your Online Presence
			</li>
		</ul>
	</div>
	<div class="fleft clear">
		<strong>Products From Retailers Already on Hoodiezz.com</strong>
		<ul class="retail fleft">
			<?php echo $line ?>
		</ul>
	</div>
	<div class="fleft clear">
		<strong>How It Works</strong>
		<ul>
			<li>
				Hoodiezz.com is a Marketplace that already has sponsors &amp; Paid Affiliations. But Every website needs more content.
			</li>
			<li>
				Potential Customers come to us everyday to see cool clothing.
			</li>
			<li>
				Your Clothing is Our Content.
			</li>
			<li>
				You Provide the Content, And We'll advertise your products for Free.
			</li>
			<li>
				All Links will lead directly back to your website. No Fees or Commissions from Us.
			</li>
		</ul>
	</div>
	<div class="fleft clear">
		<strong>Get a Jump on The Competition</strong>
		<ul>
			<li>
				Click The Button Below and Upload your First Product Now!!
			</li>
		</ul>
	</div>
	<div class="fleft clear">
		<a href="/product-upload/" class="btnRetail">Upload Your First Product Now</a>
	</div>
</div>

<?php get_footer(); ?>

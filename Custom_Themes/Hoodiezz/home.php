<?php       
session_start();
/**
 * Template Name: Home
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
$hpImage = $wpdb->get_row('SELECT * FROM imageUpload ORDER BY ID DESC LIMIT 1');

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
<div class="entry-content">
  
	<?php
	  if ( have_posts() ) while ( have_posts() ) : the_post();
	?>

	<?php 
    	the_content();
		endwhile;
	?>

	<div class="fleft" style="margin: 8% 0 3% 0;">
		<div class="handPicked">
			<h2 class="center">Add Your Products to Hoodiezz.com</h2>
			<a href="<?php echo $hpImage->link; ?>" target="_blank">
				<img class="relative" src="<?php echo $hpImage->image; ?>">
			</a>
		</div>
		<div class="homeCategory">
			<ul id="homeGrid">
				<li class="fleft">
					<a href="/find-cool-headgear-for-men/">
						<img class="relative" src="/wp-content/uploads/2016/06/MensHeadgearImage.png">
					</a>
				</li>
				<li class="fleft">
					<a href="/find-cool-clothes-for-men/">
						<img class="relative" src="/wp-content/uploads/2016/06/MensClothesImage.png">
					</a>
				</li>
				<li class="fleft">
					<a href="/find-cool-shoes-for-men/">
						<img class="relative" src="/wp-content/uploads/2016/06/MensShoesImage.png">
					</a>
				</li>
				<li class="fleft">
					<a href="/find-cool-headgear-for-women/">
						<img class="relative" src="/wp-content/uploads/2016/06/WomensHeadgearImage.png">
					</a>
				</li>
				<li class="fleft">
					<a href="/find-cool-clothes-for-women/">
						<img class="relative" src="/wp-content/uploads/2016/06/WomensClothesImage.png">
					</a>
				</li>
				<li class="fleft">
					<a href="/find-cool-shoes-for-women/">
						<img class="relative" src="/wp-content/uploads/2016/06/WomensShoesImage.png">
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="fleft clear">
		<h1 class="center">Just Uploaded</h1>
		<div class="center">(New Products From Retailers Online Right Now)</div>
		<ul class="retail fleft">
			<?php echo $line ?>
		</ul>
	</div>

	<center class="hideMobile">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Hoodie Designer Code -->
		<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-6878956929412680" data-ad-slot="4565886858"></ins>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</center>

</div>

<?php get_footer(); ?>
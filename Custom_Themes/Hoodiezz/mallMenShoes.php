<?php
session_start();
/**
 * Template Name: Men Shoes
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

$pg = $_REQUEST['pg'];

if (!$pg) {
	$pg = '1';
	$currentPg = 0;
} else {
	$currentPg = ((int)$pg - 1) * 20;
}

$products = $wpdb->get_results($wpdb->prepare('SELECT * FROM productUpload WHERE prod_category = "mShoes" ORDER BY ID DESC LIMIT %d, 20', $currentPg));

/*************************************************************************
* The Products and the Total Count
**************************************************************************/
foreach ( $products as $item) {
	$list .= '<li id="productSpace" class="fleft" itemscope itemtype="http://schema.org/Product">';
	
	$list .= '<a href="'.stripslashes($item->prod_link).'" target="_blank" class="fleft"><img itemprop="image" src="'.stripslashes($item->prod_img).'" alt="'.stripslashes($item->prod_name).'" class="mainImg" width="110" height="130"></a>';

	$list .= '<div class="fleft">';

	$list .= '<div class="prodDescript">'.stripslashes($item->prod_name).'</div>';

	$list .= '<div class="prodPrice" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">';
	if (stripslashes($item->prod_sale) < stripslashes($item->prod_price) && stripslashes($item->prod_sale) != '') {
		$list .= 'Price: <del>$'.stripslashes($item->prod_price).'</del><br>';
		$list .= 'Sale Price: <span class="money" itemprop="lowPrice">$'.stripslashes($item->prod_sale).'</span>';
		$list .= '<meta itemprop="price" content="$'.stripslashes($item->prod_price).'">';
	} else {
		$list .= 'Price: <span class="money" itemprop="price">$'.stripslashes($item->prod_price).'</span>';
		$list .= '<meta itemprop="lowPrice" content="$'.stripslashes($item->prod_price).'">';
	}
	$list .= '<meta itemprop="priceCurrency" content="USD" />';
	$list .= '</div>';


	$list .= '<div class="prodBuy"><a href="'.stripslashes($item->prod_link).'" target="_blank"><strong>Buy From</strong>: '.stripslashes($item->prod_store).'</a></div>';
	
	$list .= '</div></li>';
}

/*************************************************************************
* The Pagination
**************************************************************************/
$theCount = $wpdb->get_var('SELECT COUNT(*) FROM productUpload WHERE  prod_category = "mShoes"');
$total = ceil($theCount/20);

if ($pg === '1') {
	$hideL = ' backLink';
}

if ($pg === (string)$total || (string)$total === '0' ) {
	$hideR = ' backLink';
}

$pageNum .= '<a href="" class="firstPg'.$hideL.'" title="First Page">&lsaquo;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="leftPg'.$hideL.'" title="Previous">&laquo;</a>&nbsp;&nbsp;'.$pg.'&nbsp;&nbsp;<a href="" class="rightPg'.$hideR.'" title="Next">&raquo;</a>';

/******************************************************************************************************************************
 *
 * Content for Page Starts Now
 *  
 *****************************************************************************************************************************/

get_header();
?>
			<div id="theMall" class="entry-content">
				<div class="productAds">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- Mall and Exclusives Side Banner -->
					<ins class="adsbygoogle"
					     style="display:inline-block;width:160px;height:600px"
					     data-ad-client="ca-pub-6878956929412680"
					     data-ad-slot="6042620055"></ins>
					<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>

				<?php if ($list != '') { ?>
					<div id="productDiv">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<form action="" name="formName" id="pageForm">
							<input type="hidden" name="pg" value="<?php echo $pg; ?>" />
							<input type="hidden" name="price" value="<?php echo $price; ?>" />
						</form>
						<div class="center seeIt">
							<h2>See It Here, But It There!!</h2>
							Each Hoodie Below is From a Different Site. Buy <u>Directly</u> From Them
						</div>
						<div>
							<select id="menClothing">
								<option value="mOutfit">All Outfits</option>
								<option value="mClothes">Clothes</option>
								<option value="mHeadgear">Headgear</option>
								<option value="mShoes" selected>Shoes</option>
							</select>
							<div class="fright topPg">
								<?php echo $pageNum; ?>
							</div>
						</div>
						<ul id="high">
							<?php echo $list; ?>
						</ul>
						<div class="fright bottomPg">
							<?php echo $pageNum; ?>
						</div>
					</div>

				<?php } else { ?>

					<div class="errorMsg">
						<div class="badSearch">
							We're sorry, we don't have that Hoodie yet. Tell us the Hoodie you want and we'll have it here for you in a few days.
						</div>
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-comments" data-href="http://hoodiezz.com/mall" data-width="600" data-numposts="5" data-colorscheme="light"></div>
					</div>

					<?php } ?>

					<center class="hideMobile">
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- Mall And Exclusive Page Bottom Ads -->
						<ins class="adsbygoogle"
						     style="display:inline-block;width:728px;height:15px"
						     data-ad-client="ca-pub-6878956929412680"
						     data-ad-slot="7519353251"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
					</center>

					<div class="sellHood">
						Sell Hoodies? Show Them on Hoodiezz.com for Free. <a href="/retailers/" style="text-decoration: underline;">Click Here</a>
					</div>
			</div>

<?php get_footer(); ?>
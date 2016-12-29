<?php
session_start();
/**
 * Template Name: Search Page
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

if ( !isset($_SESSION['guestID']) ) {
	$_SESSION['guestID'] = rand(0, 9999999);
}

$search = $_GET['keyword'];
$page = $_GET['pg'];
$price = $_GET['price'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$ipAddress = $_SERVER['REMOTE_ADDR'];

if ( empty($price) ) {
	$range = '';
} else {
	$range = '&minPrice=0&maxPrice='.$price;
}

if ( empty($page) ) {
	$pg = '1';
}
else {
	$pg = $page;
}

$xml_url = 'http://api.ebaycommercenetwork.com/publisher/3.0/rest/GeneralSearch?apiKey=33d668ef-38e2-4b1e-a983-cb006cf7e3e3&trackingId=8096979&visitorUserAgent='.$userAgent.'&visitorIPAddress='.$ipAddress.'&keyword=hoodie&keyword='.$search.'&numItems=20&attributeValue=71827_sweaters_and_sweatshirts&categoryId=31515&showOnSaleOnly=true&showOffersOnly=true&pageNumber='.$pg.$range;

$xml = simplexml_load_file($xml_url);
$product = $xml->categories->category->items->offer;

/*************************************************************************
* The Products and the Total Count
**************************************************************************/
for ($i = 0; $i <= 19; $i++) {
	if (!$product[$i]->imageList->image[1]->sourceURL) {
		break;
	}
	$list .= '<li id="productSpace" class="fleft" itemscope itemtype="http://schema.org/Product">';
	$list .= '<a href="'.$product[$i]->offerURL.'" target="_blank" class="fleft"><img itemprop="image" src="'.$product[$i]->imageList->image[1]->sourceURL.'" alt="'.$product[$i]->name.'" class="mainImg" width="110" height="130"></a>';
	$list .= '<div class="fleft">';
	
	$list .= '<div class="prodPrice" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">';
	if ( (int)$product[$i]->basePrice < (int)$product[$i]->originalPrice ) {
		$list .= 'Price: <del>$'.$product[$i]->originalPrice.'</del><br>';
		$list .= 'Sale Price: <span class="money" itemprop="lowPrice">$'.$product[$i]->basePrice.'</span>';
		$list .= '<meta itemprop="price" content="$'.$product[$i]->originalPrice.'">';
	} else {
		$list .= 'Price: <span class="money" itemprop="price">$'.$product[$i]->originalPrice.'</span>';
		$list .= '<meta itemprop="lowPrice" content="$'.$product[$i]->originalPrice.'">';
	}
	$list .= '<meta itemprop="priceCurrency" content="USD" />';
	$list .= '</div>';

	$list .= '<div><button class="details" name="'.$product[$i]->name.'" count="'.$product[$i]->store->ratingInfo->reviewCount.'" code="'.$product[$i]->couponCode.'" rating="'.$product[$i]->store->ratingInfo->rating.'" descript="'.$product[$i]->description.'" store="'.$product[$i]->store->name.'" link="'.$product[$i]->offerURL.'">Details</button></div>';
	$list .= '<div class="prodBuy"><a href="'.$product[$i]->offerURL.'" target="_blank">Buy From</a>: <a href="'.$product[$i]->offerURL.'" target="_blank"><img src="'.$product[$i]->store->logo->sourceURL.'" class="logoImg" alt="'.$product[$i]->store->name.'" /></a></div>';

	$list .= '<meta itemprop="name" content="'.$product[$i]->name.'"><meta itemprop="brand" content="'.$product[$i]->store->name.'">';
	$list .= '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"><meta itemprop="ratingValue" content="'.$product[$i]->store->ratingInfo->rating.'"><meta itemprop="reviewCount" content="'.$product[$i]->store->ratingInfo->reviewCount.'"></div>';

	$list .= '</div></li>';
}

/*************************************************************************
* The Pagination
**************************************************************************/
$total = round($xml->categories->category->items['matchedItemCount']/20);

if ($pg === '1') {
	$hideL = ' backLink';
}

if ($pg === (string)$total || (string)$total === '0' ) {
	$hideR = ' backLink';
}

$pageNum .= '<a href="1" class="leftPg'.$hideL.'" title="First Page">&lsaquo;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.($pg - 1).'" class="leftPg'.$hideL.'" title="Previous">&laquo;</a>&nbsp;&nbsp;'.$pg.'&nbsp;&nbsp;<a href="'.($pg + 1).'" class="rightPg'.$hideR.'" title="Next">&raquo;</a>';

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
							<input type="hidden" name="keyword" value="<?php echo $search; ?>" />
						</form>
						<div class="sortSection">
							Sort by Price:
							<select id="prices">
								<option value="">Choose Price Range</option>
								<option value="20"<?php if ($price === '20') { echo ' selected="selected"'; } ?>>Under 20</option>
								<option value="40"<?php if ($price === '40') { echo ' selected="selected"'; } ?>>Under 40</option>
								<option value="80"<?php if ($price === '80') { echo ' selected="selected"'; } ?>>Under 80</option>
								<option value="100"<?php if ($price === '100') { echo ' selected="selected"'; } ?>>Under 100</option>
							</select>
							<?php echo $pageNum; ?>
						</div>
						<div class="center">
							<img src="/wp-content/uploads/2016/03/seeItBuyItSmall.jpg" alt="See it here, buy it there" width="95%" />
						</div>
						<ul id="high">
							<?php echo $list; ?>
						</ul>
						<diiv class="fright bottomPg">
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

					<center>
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
						Sell Hoodies? Show Them on Hoodiezz.com for Free. <a href="/product-upload/" style="text-decoration: underline;">Click Here</a>
					</div>

<?php get_footer(); ?>
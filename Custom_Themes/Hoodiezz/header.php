<?php
session_start();
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Test Hoodiezz
 * @since Test Hoodiezz 1.0
 */
?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/Place">
	<head>
		<title>
			<?php
				global $page, $paged;	  
				wp_title( '|', true, 'right' );
				bloginfo( 'name' );
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description && ( is_home() || is_front_page() ) ) {
					echo " | $site_description";
				}
			?>
		</title>
		<meta name="google-site-verification" content="KVhztCnxUGXCejGxPDKqpHuKMJPgurmzHYditP_3nFk" />
		<meta name="msvalidate.01" content="23E656D8E32B91F34C8A23DA3541B3A9" />
		<meta itemprop="name" content="Hoodiezz.com">
		<meta itemprop="image" content="http://hoodiezz.com/wp-content/uploads/2013/12/Hoodiezz-Logo.png">
		<meta itemprop="description" content="We have the best hoodies. Search our vast hoodie mall, or use our hoodie designer. Hoodiezz.com: The Best Place to Buy Hoodies Online.">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta charset="<?php bloginfo( 'charset' ); ?>" />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script async type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/mall.js"></script>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<?php
			wp_head();
		?>
	</head>

	<body>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

	<?php
		$pageName = explode("/", $_SERVER[REQUEST_URI]);
		$design = '/hoodie-designer/';
		$className = '';
		if ($pageName[1] == 'find-cool-outfits-for-women' || $pageName[1] == 'find-cool-clothes-for-women' || $pageName[1] == 'find-cool-headgear-for-women' || $pageName[1] == 'find-cool-shoes-for-women') { 
			$className1 = 'class="headerNav"';
		}
		if ($pageName[1] == 'find-cool-outfits-for-men' || $pageName[1] == 'find-cool-clothes-for-men' || $pageName[1] == 'find-cool-headgear-for-men' || $pageName[1] == 'find-cool-shoes-for-men') { 
			$className2 = 'class="headerNav"';
		}
	?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/style.css" />

	<div id="wrapper" class="hfeed">
		<div id="cover">
			<header>
				<div id="header">
					<div id="masthead">
						<div class="menuTrigger">
							menu
						</div>
						<div id="branding" role="banner">
							<a href="/"><span class="fleft hoodLogo hoodSprite"></span></a>
							<div id="headerRight">
								<div class="fleft headerText">
									<h2>
										We Let Online Retailers<br>
										Advertise For Free
									</h2>
								</div>
								<div class="socialHeader">
									<div><a href="/retailers/" class="btnRetail">Add Products to Hoodiezz</a></div>
									<div class="fb-like" data-href="https://www.facebook.com/MyHoodiezz/" data-layout="button_count" data-action="recommend" data-show-faces="false" data-share="false"></div>
								</div>
							</div>
						</div><!-- #branding -->
						<nav>
							<div id="access" role="navigation">
								<div class="menu-header">
									<ul id="menu-hoodiezz" class="menu">
										<li>
											<a title="Women" <?php echo $className1; ?> href="<?php echo 'find-cool-outfits-for-women'; ?>">Women</a>
										</li>
										<li>
											<a title="Men" <?php echo $className2; ?> href="<?php echo 'find-cool-outfits-for-men'; ?>">Men</a>
										</li>
										<li>
											<a title="Designer" <?php if ($pageName[1] == 'hoodie-designer') { echo 'class="headerNav"'; } ?> href="<?php echo $design; ?>">Designer</a>
										</li>
									</ul>
								</div>
							</div>
						</nav><!-- #access -->
					</div><!-- #masthead -->
				</div>
			</header>

			<div id="main" class="mainContent">
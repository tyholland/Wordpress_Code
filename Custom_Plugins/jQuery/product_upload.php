<?php
/*---------------------------------------------------------
	Product Upload Form
---------------------------------------------------------*/
 
add_action('admin_menu', 'xml_dashboard', 1);

add_shortcode('xml_show', 'xml_show');


function xml_dashboard() {

	add_menu_page(__('XML Products Form', 'wpscripts'), __('XML Products Form', 'wpscripts'), 'administrator', 'xml', 'xml_schedule');
}

/*--------------------------------------------------------------------------------------
Purpose:   Page that explains how to implement the short code [xml_schedule]
----------------------------------------------------------------------------------------*/
function xml_schedule(){ 
?>
	<h2><?php _e('Add XML Products Form', 'wpscripts'); ?></h2>
	
	<p>
		*Make sure to enter this code on the page that you wish it to be displayed on:<br />
		<h3>[xml_show]</h3>
	
		Also make sure it is entered in the HTML tab in the Page, not the VISUAL tab.<br />
		Otherwise your XML Products Form won't show.
	</p>
	<?php
}

/*------------------------------------------------------------------------
Purpose:   Displays the output of the short code [xml_show]
--------------------------------------------------------------------------*/
function xml_show() {
	global $wpdb;

	$wpdb->show_errors();
	
	if ( isset($_REQUEST['submit_products']) ) {
		$name = $_REQUEST['pName'];
		$descript = $_REQUEST['descript'];
		$img = $_REQUEST['img'];
		$link = $_REQUEST['link'];
		$price = $_REQUEST['price'];
		$sale = $_REQUEST['sale'];
		$logo = $_REQUEST['logo'];
		$store = $_REQUEST['store'];
		$special = $_REQUEST['special'];
		$category = $_REQUEST['category'];

		$wpdb->insert( 
			'productUpload', 
			array( 
				'prod_name' => addslashes($name),
				'prod_descript' => addslashes($descript),
				'prod_img' => addslashes($img),
				'prod_link' => addslashes($link),
				'prod_price' => addslashes($price),
				'prod_sale' => addslashes($sale),
				'prod_logo' => addslashes($logo),
				'prod_store' => addslashes($store),
				'prod_special' => addslashes($special),
				'prod_category' => addslashes($category),
				'prod_flag' => null
			)
		);

		echo '<script type="text/javascript">                                                                                                                      
			alert("Your products have been successfully uploaded.");  
			window.location.href="/product-upload/";                                                                                 
			</script>';
	}
	
	$output = '
		<style type="text/css">
			.prodUpload input {
				margin: 3px 0 16px 0;
			}
			.prodUpload {
				margin-top: 5%;
			}
		</style>
		<script type="text/javascript">			
			function IsNumeric(sText) {
				var ValidChars = "0123456789.()-",
					IsNumber = true,
					Char;                 

				for (var i = 0; i < sText.length && IsNumber == true; i++) 
				{ 
					Char = sText.charAt(i); 
					if (ValidChars.indexOf(Char) == -1) 
					{
						IsNumber = false;
					}
				}
				return IsNumber;    
			}  
			
			function advertiserProdCheck() {   
				var pName = $("#pName").val(),
					descript = $("#descript").val(),
					img = $("#img").val(),
					link = $("#link").val(),
					price = $("#price").val(),
					sale = $("#sale").val(),
					logo = $("#logo").val(),
					store = $("#store").val(),
					category = $("#category").val(),
					msg = "";

				if (pName.length === 0) {
					msg += "Please enter the Product Name.\n";
				}

				if (descript.length === 0) {
					msg += "Please enter the Product Description.\n";
				}

				if (img.length === 0) {
					msg += "Please enter the Product Image.\n";
				}

				if (link.length === 0) {
					msg += "Please enter the Product Link.\n";
				}

				if (price.length === 0 || !IsNumeric(price)) {
					msg += "Please enter the Product Price.\n";
				}

				if (sale.length > 0 && !IsNumeric(sale)) {
					msg += "Please enter the Product Sale Price.\n";
				}

				if (store.length === 0) {
					msg += "Please enter the Product Store Name.\n";
				}

				if (logo.length === 0) {
					msg += "Please enter the Product Store Logo.\n";
				}

				if (category === "none") {
					msg += "Please enter the Product Category.\n";
				}

				if (msg === "") {
					return true;
				}
				else {
					alert(msg);
					return false;
				}
			}
		</script>

		<form action="" class="prodUpload" method="post" onsubmit="return advertiserProdCheck();">
			<div class="pro">
				<div class="leftSide">
					<ul>
						<li class="fleft">
							Product Name:
						</li>
						<li class="fleft alternate">
							<input type="text" name="pName" id="pName" value="" />
						</li>
						<li class="fleft">
							Product Description:
						</li>
						<li class="fleft alternate">
							<input type="text" name="descript" id="descript" value="" />
						</li>
						<li class="fleft">
							Product Image:
						</li>
						<li class="fleft alternate">
							<input type="text" name="img" id="img" value="" /> <em>Ex: http://hoodiezz.com/images/hoodiezz-guy-logo</em>
						</li>
						<li class="fleft">
							Product Link:
						</li>
						<li class="fleft alternate">
							<input type="text" name="link" id="link" value="" /> <em>Ex: http://www.google.com</em>
						</li>
						<li class="fleft">
							Product Price:
						</li>
						<li class="fleft alternate">
							$<input type="text" name="price" id="price" value="" maxlength="6" /> <em>Ex: 9.99 or 10.00</em>
						</li>
						<li class="fleft">
							Product Sale Price (optional):
						</li>
						<li class="fleft alternate">
							$<input type="text" name="sale" id="sale" value="" maxlength="6" /> <em>Ex: 9.99 or 10.00</em>
						</li>
						<li class="fleft">
							Product Store Name:
						</li>
						<li class="fleft alternate">
							<input type="text" name="store" id="store" value="" />
						</li>
						<li class="fleft">
							Product Store Logo:
						</li>
						<li class="fleft alternate">
							<input type="text" name="logo" id="logo" value="" /> <em>Ex: http://hoodiezz.com/images/hoodiezz-guy-logo</em>
						</li>
						<li class="fleft">
							Product Special Text:
						</li>
						<li class="fleft alternate">
							<input type="text" name="special" id="special" value="" /> <em>Optional</em>
						</li>
						<li class="fleft">
							Product Category:
						</li>
						<li class="fleft alternate">
							<select name="category" id="category">
								<option value="none">Choose One:</option>
								<option value="mClothes">Mens Clothes</option>
								<option value="mHeadgear">Mens Headgear</option>
								<option value="mShoes">Mens Shoes</option>
								<option value="wClothes">Womens Clothes</option>
								<option value="wHeadgear">Womens Headgear</option>
								<option value="wShoes">Womens Shoes</option>
							</select>
						</li>
					</ul>
				</div>
			</div>
			<div>
				<input type="submit" name="submit_products" id="productSubmit" value="Submit & Upload Another Product?" />
			</div>
		</form>
	';
	
	return $output;

}
?>
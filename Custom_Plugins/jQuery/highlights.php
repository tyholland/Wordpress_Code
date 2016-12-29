<?php 
/*---------------------------------------------------------
	Creating a Plugin
---------------------------------------------------------*/
add_action('admin_menu', 'plpugin_dashboard', 1);

add_shortcode('plugins', 'plugins');

function plpugin_dashboard() {

	add_menu_page(__('wpPlugin', 'wpscripts'), __('wpPlugin', 'wpscripts'), 'administrator', 'plugins', 'plugin_shortcode');
	
}

/*----------------------------------------------------------------------------
Purpose:   Displays the output of the short code [plugins]
-------------------------------------------------------------------------------*/
function plugins() {
		
	$output = 'This is a wordpress plugin';

	return $output;
}

/*-------------------------------------------------------------------------------------------
Purpose:   Page that explains how to implement the short code [plugins]
--------------------------------------------------------------------------------------------*/
function plugin_shortcode() {
    
  ?>

	<h2><?php _e('Add wpPlugin', 'wpscripts'); ?></h2>
	
	<div style="width: 600px;">
		<p>
			Use the Macro code below to display the wpPlugin in your website.
		</p>
		<p>
			You must create a dedicated page for this feed. After you create the page, copy and paste the Macro Code into the page. You must use HTML view when you add the Macro Code.
		</p>
		<p>
			Macro Code:
			<br />
			<h3>[plugins]</h3>
		</p>
	</div>
	
	<?php		
	
  }

?>
<?php

//===================
// Matise theme Development essentials
//===================
function debug($object){
	echo '<pre style="position:relative; z-index:9999;text-align: left; background-color:white;">';
	print_r($object);
	echo '</pre>';
}

function remove_menu_links() {
	// remove_menu_page('upload.php'); //remove media

}

if (defined('DEVENV')) {
	if(DEVENV === 'local' || DEVENV === 'staging'){
		update_option( 'upload_path', 'content/uploads' );
		// update_option( 'upload_url_path', 'live content/uploads url to make images work' );

		// some plugins we don't want locally
		$plugins_to_deactivate = array();

		$plugin_name = '/mailgun/mailgun.php';
		if(file_exists(WP_PLUGIN_DIR . $plugin_name)){
			$plugins_to_deactivate[] = $plugin_name;
		}

		$plugin_name = '/w3-total-cache/w3-total-cache.php';
		if(file_exists(WP_PLUGIN_DIR . $plugin_name)){
			$plugins_to_deactivate[] = $plugin_name;
		}

		$plugin_name = '/wordfence/wordfence.php';
		if(file_exists(WP_PLUGIN_DIR . $plugin_name)){
			$plugins_to_deactivate[] = $plugin_name;
		}

		$plugin_name = '/backwpup/backwpup.php';
		if(file_exists(WP_PLUGIN_DIR . $plugin_name)){
			$plugins_to_deactivate[] = $plugin_name;
		}

		deactivate_plugins( 
			$plugins_to_deactivate
		);

		add_action( 'admin_menu', 'remove_menu_links' );
	}
}

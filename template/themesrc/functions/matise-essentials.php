<?php

//===================
// Matise theme Development essentials
//===================
function debug($object){
	echo '<pre style="position:relative; z-index:9999;text-align: left; background-color:white;">';
	print_r($object);
	echo '</pre>';
}

// stop here if DEVENV is not set
if (!defined('DEVENV')){
	return;
}

// disable plugins on local and staging.
// some plugins we don't want locally 
switch (DEVENV) {
	case 'local':
	case 'staging':
		update_option( 'upload_path', 'content/uploads' );
		// update_option( 'upload_url_path', 'live content/uploads url to make images work' );

		$plugins_to_deactivate = array();

		// if you want the mailgun settings below to have effect, this one should be disabled.
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

		function remove_menu_links() {
			// remove_menu_page('upload.php'); //remove media
		
		}
		add_action( 'admin_menu', 'remove_menu_links' );
		break;
}

// allow api access from anywhere for local and staging 
switch (DEVENV) {
	case 'local':
	case 'staging':
		header("Access-Control-Allow-Origin: *");
		break;
}

// mailgun temporary matise settings
switch (DEVENV) {
	case 'staging':
		update_option('mailgun', array(
			'region' => 'us',
			'useAPI' => 1,
			'domain' => 'mg.matise.nl',
			'apiKey' => 'key-caa5dc6f0a22f670cbebe427e6d20909',
			'secure' => 1,
			'sectype' => 'tls',
			'track-clicks' => 'htmlonly',
			'track-opens' => 1,
			'from-address' => 'temp@mg.matise.nl',
			'from-name' => 'Matise Staging Wordpress',
			'campaign-id' => '<%= name %>'
		));	

		function general_admin_notice(){
			global $pagenow;
			if ( $pagenow == 'options-general.php' && isset($_GET['page']) && $_GET['page'] == 'mailgun') {
				 echo '<div class="notice notice-warning is-dismissible">
					 <p>Mailgun settings are defined in code on local and staging.</p>
				 </div>';
			}
		}
		add_action('admin_notices', 'general_admin_notice');
		break;
}

<?php

//===================
// Matise theme Development essentials
//===================
function debug($object){
	echo '<pre style="position:relative; z-index:9999;text-align: left; background-color:white;">';
	print_r($object);
	echo '</pre>';
}

// Change home and rest url (for headless wordpress)
function change_home_url($url, $path) {
	if (!defined(API_DOMAIN) || !defined(FRONTEND_DOMAIN)) {
		return $url;
	}
	if (strpos($url,'https://' . API_DOMAIN . '/wp-json')) {
		return $url;
	} else {
		return str_replace('https://' . API_DOMAIN, 'https://'. FRONTEND_DOMAIN , $url);
	}
}

function change_rest_url($url, $path){
	if(!defined(API_DOMAIN) || !defined(FRONTEND_DOMAIN)){
		return $url;
	}
	$home = 'https://'.FRONTEND_DOMAIN.'/';
	$rest_home = 'https://'.API_DOMAIN.'/';
	if(strpos($url, $home.'wp-json/') > -1){
		return str_replace($home.'wp-json/', $rest_home.'wp-json/', $url);
	}
	return $url;
}

// Check if we are running on flywheel, if so, enable the home_url and rest_url filters
if (defined('FLYWHEEL_CONFIG_DIR') || MATISE_ENVIRONMENT === 'local'){
	foreach( [ 'post', 'page', 'post_type' ] as $type ) {
		add_filter( $type . '_link', 'change_home_url' , 9999, 2);
	}
	add_filter( 'home_url', 'change_home_url' , 9999, 2);
	add_filter('rest_url', 'change_rest_url', 9999, 4);
}


if(!headers_sent()){
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Access-Control-Max-Age: 1000');
	header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
}

$mailgun_key = '<%= mailgun %>';

define('MAILGUN_API_KEY', $mailgun_key);

// disable plugins on local and staging.
// some plugins we don't want locally 
if (defined('MATISE_ENVIRONMENT')){
	switch (MATISE_ENVIRONMENT) {
		case 'local':
		case 'staging':
			// update_option( 'upload_url_path', 'live content/uploads url to make images work' );

			function deactivate_default_plugins(){
				$plugins_to_deactivate = array();
			
				// if you want the mailgun settings below to have effect, this one should be disabled.
				if(defined('MAILGUN_API_KEY') && MAILGUN_API_KEY === 'key-undefined'){
					$plugin_name = '/mailgun/mailgun.php';
					if(file_exists(WP_PLUGIN_DIR . $plugin_name)){
						$plugins_to_deactivate[] = $plugin_name;
					}
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
			}
			add_action('admin_init', 'deactivate_default_plugins');

			function remove_menu_links() {
				// remove_menu_page('upload.php'); //remove media
			
			}
			add_action( 'admin_menu', 'remove_menu_links' );
			break;
	}
}

// mailgun temporary matise settings
if(defined('MAILGUN_API_KEY') && MAILGUN_API_KEY !== 'key-undefined'){
	switch (MATISE_ENVIRONMENT) {
		case 'local':
		case 'staging':
			update_option('mailgun', array(
				'region' => 'us',
				'useAPI' => 1,
				'domain' => 'mg.matise.nl',
				'apiKey' => MAILGUN_API_KEY,
				'secure' => 1,
				'sectype' => 'tls',
				'track-clicks' => 'htmlonly',
				'track-opens' => 1,
				'from-address' => 'temp@mg.matise.nl',
				'from-name' => 'Matise Staging Wordpress',
				'campaign-id' => 'matise-staging-<%= packageName %>'
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
}

//===================
// Show commit reference and environment in admin bar
//===================
if(!strpos(COMMIT, 'commit')){
	function my_custom_admin_head() {
		$matise_env = '';
		if(defined('MATISE_ENVIRONMENT')){
			$matise_env = MATISE_ENVIRONMENT;
		}
		echo "<script>
		window.addEventListener('load', function () {
			var ul = document.querySelector('ul#wp-admin-bar-top-secondary');
			var li = document.createElement('li');
			li.appendChild(document.createTextNode('". $matise_env . ' - ' . COMMIT ."'));
			ul.appendChild(li);
		}, false);
		</script>";
	}
	add_action( 'admin_head', 'my_custom_admin_head' );
}

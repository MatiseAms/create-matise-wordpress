<?php

namespace <%= name %>;
// use Matise\Register_Fields;
// use Matise\Utilities;

require_once('field-groups/acf.php');

// add_action( 'init', __NAMESPACE__ . '\\matise_start', 0);
// /**
//  * Starts the fissa by instantiating each of the classes (which is
//  * included via the autoloader).
//  */
// function matise_start() {
// 	// check for plugin using plugin name
// 	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
// 	if ( !is_plugin_active( 'matise-wp-core/matise-core.php' ) ) {
// 		function matise_admin_notice(){
// 			echo '<div class="notice notice-warning is-dismissible">
// 				<p>Matise WP Core plugin is required for this project, please install and/or activate the plugin.</p>
// 			</div>';
// 		}
// 		add_action('admin_notices', __NAMESPACE__ . '\\matise_admin_notice');
// 		return;
// 	}
	
// 	$basic_fields = new Register_Fields\Basics();
// 	$menus = new Utilities\Menus();


// 	// add extended fields variables to page endpoints
// 	$basic_fields->init_by_array(
// 		array(
// 			'uri',
// 			'fields',
// 			'title',
// 			'children',
// 			'content',
// 			'excerpt',
// 			'featured_image',
// 			'categories',
// 			'tags',
// 			'template',
// 			'guid'
// 		)
// 	);


// 	$menus->menus = array(
// 		'header_menu' => 'Header menu',
// 		'footer_menu' => 'Footer menu',
// 		'social_menu' => 'Social menu',
// 		'legal_menu' => 'Legal menu'
// 	);
// 	// register wp-json/menus/all
//	$menus->init();
// }

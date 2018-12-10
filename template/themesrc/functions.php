<?php
/**
 * Functions page
 *
 * @author       Matise (matise.nl)
 * @package      Wordpress
 * @subpackage   <%= name %>
 * @version      1.0
 * @since        1.0
 */

//===================
// Matise theme Development essentials
//===================
require_once('includes/matise-essentials.php');

//===================
// Includes folder includes
//===================
require_once('includes/includes.php');

//===================
// Theme specific functions functions
//===================

/**
 * Allow svg uploads
 */
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

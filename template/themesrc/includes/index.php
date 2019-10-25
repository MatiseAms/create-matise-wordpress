<?php

//===================
// Matise theme Development essentials
//===================
require_once('core/includes.php');
require_once('core/matise-essentials.php');

//===================
// Theme specific functions functions
//===================
require_once('image_settings.php');
require_once('string_translations.php');

//===================
// More settings
//===================

/**
 * Helper function to get the relative permalink based on post id
 */
function get_relative_permalink($id) {
	return apply_filters('matise_get_relative_url', get_the_permalink($id));
}
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

define('COMMIT', '<commit>');
define('BRANCH', '<branch_ref>');

if (BRANCH === 'refs/heads/master'){
	define('MATISE_ENVIRONMENT', 'production');
} else if (BRANCH === 'refs/heads/staging'){
	define('MATISE_ENVIRONMENT', 'staging');
}


if (!defined('MATISE_ENVIRONMENT')) {
	define('MATISE_ENVIRONMENT', 'local');
}

switch (MATISE_ENVIRONMENT) {
	case 'local':
		define('API_DOMAIN', '<%= packageName %>.test');
		define('FRONTEND_DOMAIN', 'localhost:3000');
	break;
	default:
		define('API_DOMAIN', '<%= packageName %>.flywheelsites.com');
		define('FRONTEND_DOMAIN', '<%= packageName %>.matise.org');
	break;
}

//===================
// Includes folder includes
//===================
require_once('includes/includes.php');
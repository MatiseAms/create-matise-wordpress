<?php
/**
 * Header
 *
 * @author       Matise (matise.nl)
 * @package      Wordpress
 * @subpackage   <%= name %>
 * @version      1.0
 * @since        1.0
 */
?><!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
	<main id="main">

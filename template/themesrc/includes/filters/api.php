<?php
namespace Matise\Filters;

/**
 * We add all fields to the api, we can filter them before returning. Try to use the ACF before using this!
 */

class Matise_API {
	public function __construct() {
		//filter for layout_blocks on the end of the function
		add_filter('custom_layout_content_block_filter', array( $this, 'your_own_function_name' ), 10, 1);

		//Filter on relative URL
		add_filter('matise_get_relative_url', array($this, 'get_relative_url'), 10, 1);
	}

	/** 
	 * Own function name
	 * $field - Formatted field by Matise wp Core
	 * $depth, how many times the function has been called already
	 */
	public function your_own_function_name($field, $depth) {
		return $field;
	}


	/** 
	 * Filter for relative url, used by Matise wp core
	 * $permalink - formatted url
	 */
	public function get_relative_url($permalink) {
		$permalink = str_replace('https://<%= packageName %>.test', '', $permalink);
		$permalink = str_replace('http://<%= packageName %>.test', '', $permalink);
		$permalink = str_replace('https://<%= packageName %>.matise.org', '', $permalink);
		$permalink = str_replace('https://localhost:3000', '', $permalink);
		return $permalink;
	}
}
<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters) {
		return Response::error('404');
	}

	public function __construct() {
		// javascript files
		Asset::add('scripts', 'js/scripts.js');

		// styles
		Asset::add('styles', 'css/styles.css');
		Asset::add('responsive', 'css/responsive.css');
		Asset::add('theme', 'css/theme.css');
	}

}
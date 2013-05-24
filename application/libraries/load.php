<?php

/**
* Loads php source files from specific directories into the project
*
* @package		SAAV
* @subpackage	Libraries
* @author		Mario Cuba <mario@mariocuba.net?
*/
class Load {

	/**
	* Load a library from application/libraries
	*
	* @param		string	- the path / name of the file
	* @return	bool	- true if included, false otherwise (from include_once)
	* @access	public
	*/
	public static function library($path) {
		return include_once(path('app') . 'libraries/' . $path . '.php');
	}

	/**
	* Loads Markdown into a controller
	*
	* @param		bool	— false if assets shouldn't be loaded
	* @access	public
	*/
	public static function markdown($assets = true) {
		self::library('markdown/markdown');

		if ($assets === true) {
			Asset::add('markdown-converter',	'js/markdown/Markdown.Converter.js',	'jquery');
			Asset::add('markdown-sanitizer',	'js/markdown/Markdown.Sanitizer.js',	array('jquery', 'markdown-converter'));
			Asset::add('markdown-editor',		'js/markdown/Markdown.Editor.js',		array('jquery', 'markdown-converter', 'markdown-sanitizer'));
		}
	}
}
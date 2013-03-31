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
	* @param	string	- the path / name of the file
	* @return	bool	- true if included, false otherwise (from include_once)
	* @access	public
	*/
	public static function library($path) {
		return include_once(path('app') . 'libraries/' . $path . '.php');
	}
}
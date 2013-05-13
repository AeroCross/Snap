<?php

/**
* Manages user roles inside the application
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Admin_Departments_Controller extends Base_Controller {

	public $restful = true;

	/**
	* Shows the roles management view
	*
	* @access	public
	* @return	View
	*/
	public function get_index() {
		$departments	= Department::all();
		$users			= User::all();

		return View::make('admin.departments.index')
			->with('title', 'Departamentos')
			->with('departments', $departments)
			->with('users', $users);
	}
}
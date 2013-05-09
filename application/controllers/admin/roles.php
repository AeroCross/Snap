<?php

/**
* Manages user roles inside the application
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Admin_Roles_Controller extends Base_Controller {

	public $restful = true;

	/**
	* Shows the roles management view
	*
	* @access	public
	* @return	View
	*/
	public function get_index() {
		$users = User::all();
		
		foreach ($users as $user) {
			$users_array[$user->id] = $user;
		}

		// for quick traversing
		$users = $users_array;

		// users from each role
		$admins		= Role_Assignment::where_role_id(1)->get();
		$supports	= Role_Assignment::where_role_id(2)->get();
		$regulars	= Role_Assignment::where_role_id(3)->get();
		
		return View::make('admin.roles.index')
			->with('title', 'Roles')
			->with('users', $users)
			->with('admins', $admins)
			->with('supports', $supports)
			->with('regulars', $regulars);
	}
}
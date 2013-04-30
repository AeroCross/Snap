<?php

/**
* Mmanages users and roles in the system
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Admin_Users_Controller extends Base_Controller {

	public $restful = true;

	public function get_index() {
		$users = User::order_by('id', 'desc')->get();
		return View::make('admin.users.index')
		->with('title', 'Usuarios')
		->with('users', $users);
	}
}
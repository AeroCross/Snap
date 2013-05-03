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
		$users = User::order_by('id', 'desc')->paginate(10);

		return View::make('admin.users.index')
		->with('title', 'Usuarios')
		->with('users', $users);
	}

	public function post_new() {
		$input = Input::all();
		$rules = array(
			'firstname' 	=> 'required',
			'lastname'		=> 'required',
			'email'  		=> 'required',
			'username'		=> 'required',
			'password'		=> 'required',
			'repassword'	=> 'required',
			'company'		=> 'required'
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return Redirect::to('admin/users')->with('notification', 'form_required');
		}
	}
}
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

	/**
	* Shows the users list and new user form
	*
	* @access	public
	* @return	View
	*/
	public function get_index() {
		$users = User::order_by('id', 'desc')->paginate(10);

		return View::make('admin.users.index')
		->with('title', 'Usuarios')
		->with('users', $users);
	}

	/**
	* Inserts a new user into the database
	*
	* @access public
	* @return Redirect
	*/
	public function post_new() {
		$input = Input::all();
		
		$validated = $this->validate($input);

		if ($validated !== true) {
			$redirect =& $validated; // redirect 
			return $redirect;
		}
	}

	/**
	* Checks if the new user form is valid to insert
	*
	* @param		array	- the data taken from Input:all()
	* @return	Redirect|bool
	* @access	public
	*/
	public function validate($input) {
		$rules = array(
			'firstname' 	=> 'required',
			'lastname'		=> 'required',
			'email'  		=> 'required|email',
			'username'		=> 'required',
			'password'		=> 'required',
			'repassword'	=> 'required|same:repassword',
			'company'		=> 'required'
		);

		$validation	= Validator::make($input, $rules);
		$redirect	= Redirect::to('admin/users');

		if ($validation->fails()) {
			// fill this array with all the required fields to check if there was
			// a field that wasn't filled. array_search will return false if 
			// everything is clear
			$required = array(
				$validation->errors->has('firstname'),
				$validation->errors->has('lastname'),
				$validation->errors->has('email'),
				$validation->errors->has('username'),
				$validation->errors->has('password'),
				$validation->errors->has('repassword'),
				$validation->errors->has('company'),
			);

			// all fields required
			if (array_search(true, $required) !== false) {
				return $redirect->with('notification', 'form_required');

			// email must be valid
			} elseif ($validation->errors->has('email')) {
				return $redirect->with('notification', 'form_email');

			// passwords must match
			} elseif ($validation->errors->has('repassword')) {
				return $redirect->with('notification', 'form_repassword');
			}
		}
		
		return true;
	}
}
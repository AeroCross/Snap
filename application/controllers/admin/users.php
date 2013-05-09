<?php

/**
* Mmnages users and roles in the system
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
		// get all the information and validate it
		$input = Input::all();
		$validated = $this->validate($input);

		// validation not passed, redirect
		if ($validated !== true) {
			$redirect =& $validated; // redirect 
			return $redirect->with_input('only', array('firstname', 'lastname', 'username', 'email'));
		}

		$user = User::create(array(
			'firstname'	=> $input['firstname'],
			'lastname'	=> $input['lastname'],
			'username'	=> $input['username'],
			'password'	=> Hash::make($input['password']),
			'email'		=> $input['email'],
		));

		$user->company()->insert(array('company_id' => $input['company']));

		if ($user != false) {
			return Redirect::to('admin/users')->with('notification', 'user_add_success');
		} else {
			return Redirect::to('admin/users')->with('notification', 'user_add_failure');
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
			'email'  		=> 'required',
			'username'		=> 'required',
			'password'		=> 'required',
			'repassword'	=> 'required',
			'company'		=> 'required'
		);

		// all fields required
		$validation	= Validator::make($input, $rules);
		$redirect	= Redirect::to('admin/users');

		if ($validation->fails()) {
			return $redirect->with('notification', 'form_required');
		}

		// email must be valid
		$rules		= array('email' => 'email');
		$validation	= Validator::make($input, $rules);

		if ($validation->fails()) {
			return $redirect->with('notification', 'form_email_invalid');
		}

		// email must be unique
		$rules		= array('email' => 'unique:users');
		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return $redirect->with('notification', 'form_email_exists');
		}

		// username must be unique
		$rules		= array('username' => 'unique:users');
		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return $redirect->with('notification', 'form_user_exists');
		}

		// passwords must matcj
		$rules		= array('repassword' => 'same:password');
		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return $redirect->with('notification', 'form_passwords_must_match');
		}

		return true;
	}
}
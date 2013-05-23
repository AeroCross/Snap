<?php

/**
* Handles the user profile
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Profile_Controller extends Base_Controller {

	public $restful = true;

	/**
	* Shows the user info and the proper modification buttons
	*
	* @access	public
	* @return	View
	*/
	public function get_index() {
		$user		= User::find(Session::get('id'));
		$company	= $user->company()->first();
		$company = Company::find($company->company_id);
		
		return View::make('profile.index')
			->with('title', 'Perfil de Usuario')
			->with('user', $user)
			->with('company', $company);
	}

	/**
	* Changes the user password
	* 
	* @access	public
	* @return	json
	*/
	public function post_update_password() {
		$old		= Input::get('old');
		$new		= Input::get('new');
		$repeat	= Input::get('repeat');
		$input	= Input::all();

		$rules	= array(
			'old'		=> 'required',
			'new'		=> 'required',
			'repeat'	=> 'required',
		);

		$validation = Validator::make($input, $rules);

		// all fields required
		if ($validation->fails()) {
			return Response::json(Notification::get('form_required'));
		}

		$rules = array(
			'repeat' => 'same:new'
		);

		$validation = Validator::make($input, $rules);

		// password mismatch
		if ($validation->fails()) {
			return Response::json(Notification::get('form_passwords_must_match'));
		}

		$user = User::find(Session::get('id'));
		
		// password does not match
		if (!Hash::check($old, $user->password)) {
			return Response::json(Notification::get('form_password_invalid'));
		}

		// all validation passed
		$user = User::find(Session::get('id'));
		$user->password = Hash::make($new);
		$user->save();

		return Response::json(Notification::get('profile_password_updated'));
	}

	/**
	* Changes the email address of the user
	*
	* @return	json
	* @access	public
	*/
	public function post_update_email() {
		$password	= Input::get('password');
		$new			= Input::get('new');
		$repeat		= Input::get('repeat');
		$all			= Input::all();

		// all fields required
		$rules = array(
			'password'	=> 'required',
			'new'			=> 'required',
			'repeat'		=> 'required'
		);

		$validation = Validator::make($all, $rules);

		if ($validation->fails()) {
			return Response::json(Notification::get('form_required'));
		}

		// emails must be valid
		$rules = array(
			'new'		=> 'email',
			'repeat'	=> 'email'
		);

		$validation = Validator::make($all, $rules);

		if ($validation->fails()) {
			return Response::json(Notification::get('form_email_invalid'));
		}

		// emails must match
		$rules = array(
			'repeat' => 'same:new'
		);

		$validation = Validator::make($all, $rules);

		if ($validation->fails()) {
			return Response::json(Notification::get('form_emails_must_match'));
		}

		// check if past password isn't good
		// @TODO: DRY up
		$user = User::find(Session::get('id'));
		if (!Hash::check($password, $user->password)) {
			return Response::json(Notification::get('form_password_invalid'));
		}

		// email exists
		// @TODO: this can be methodized
		$email = User::where_email($new)->first();

		if (!empty($email)) {
			return Response::json(Notification::get('form_email_exists'));
		}

		// change email
		$user = User::find(Session::get('id'));
		$user->email = $new;
		$user->save();

		return Response::json(Notification::get('profile_email_updated'));
	}

	/**
	* Changes the user information of an user
	*
	* @return	json
	* @access	public
	*/
	public function post_update_user() {
		$all			= Input::all();
		$password	= Input::get('password');
		$firstname	= Input::get('firstname');
		$lastname	= Input::get('lastname');
		$username	= Input::get('username');

		// all fields required
		$rules = array(
			'password' => 'required',
			'firstname' => 'required',
			'lastname' => 'required',
			'username' => 'required',
		);

		$validation = Validator::make($all, $rules);

		if ($validation->fails()) {
			return Response::json(Notification::get('form_required'));
		}

		// only alpha characters on names
		$rules = array(
			'firstname' => 'alpha',
			'lastname'	=> 'alpha'
		);

		$validation = Validator::make($all, $rules);

		if ($validation->fails()) {
			return Response::json(Notification::get('profile_names_alpha_only'));
		}

		// username must be alphanumeric with dashes
		$rules = array(
			'username' => 'alpha_dash',
		);

		$validation = Validator::make($all, $rules);

		if ($validation->fails()) {
			return Response::json(Notification::get('profile_user_invalid'));
		}

		// password mismatch
		$user = User::find(Session::get('id'));
		if (!Hash::check($password, $user->password)) {
			return Response::json(Notification::get('form_password_invalid'));
		}

		// user exists
		// @TODO: this can be methodized
		$user = User::where_username($username)->first();

		if (!empty($user)) {
			return Response::json(Notification::get('form_user_exists'));
		}

		// all good, update
		$user = User::find(Session::get('id'));
		$user->username	= $username;
		$user->firstname	= $firstname;
		$user->lastname	= $lastname;
		$user->save();

		return Response::json(Notification::get('profile_updated'));
	}
}
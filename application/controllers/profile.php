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
		$user		= $user->first();

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
			return Response::json(array('message' => 'Todos los campos son requeridos', 'type' => 'warning'));
		}

		$rules = array(
			'repeat' => 'same:new'
		);

		$validation = Validator::make($input, $rules);

		// password mismatch
		if ($validation->fails()) {
			return Response::json(array('message' => 'Las contraseñas no coinciden', 'type' => 'warning'));
		}

		$user = User::find(Session::get('id'))->first();
		
		// password does not match
		if (!Hash::check($old, $user->password)) {
			return Response::json(array('message' => 'Contraseña anterior no coincide', 'type' => 'warning'));
		}

		// all validation passed
		$user = User::find(Session::get('id'));
		$user->password = Hash::make($new);
		$user->save();

		return Response::json(array('message' => 'Contraseña actualizada', 'type' => 'success'));
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
			return Response::json(array('message' => 'Todos los campos son requeridos', 'type' => 'warning'));
		}

		// emails must be valid
		$rules = array(
			'new'		=> 'email',
			'repeat'	=> 'email'
		);

		$validation = Validator::make($all, $rules);

		if ($validation->fails()) {
			return Response::json(array('message' => 'Dirección de email inválida', 'type' => 'warning'));
		}

		// emails must match
		$rules = array(
			'repeat' => 'same:new'
		);

		$validation = Validator::make($all, $rules);

		if ($validation->fails()) {
			return Response::json(array('message' => 'La nueva dirección no coincide', 'type' => 'warning'));
		}

		// check if past password isn't good
		// @TODO: DRY up
		$user = User::find(Session::get('id'))->first();
		if (!Hash::check($password, $user->password)) {
			return Response::json(array('message' => 'Contraseña incorrecta', 'type' => 'warning'));
		}

		// email exists
		$email = User::where_email($new)->first();

		if (!empty($email)) {
			return Response::json(array('message' => 'La dirección de correo ya existe', 'type' => 'warning'));
		}

		$user = User::find(Session::get('id'));
		$user->email = $new;
		$user->save();

		return Response::json(array('message' => 'Dirección de correo electrónico actualizada', 'type' => 'success'));
	}
}
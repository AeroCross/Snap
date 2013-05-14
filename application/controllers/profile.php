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
	* @return	Response::json
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

		return Response::json(array('message' => 'Contraseña actualizada', 'type' => 'success'));
	}
}
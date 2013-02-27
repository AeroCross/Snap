<?php

/**
* Handles the initial session of the user
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Login_Controller extends Base_Controller {

	public $restful = true;

	public function __construct() {
		parent::__construct();

		// since this is the login form, add correct styles
		// @TODO: perhaps the right thing to do is to use a template
		Asset::add('login', 'css/login.css');
	}

	/**
	* Shows the login form
	*
	* @access	public
	*/
	public function get_index() {
		// create a notification, if there's any
		Notification::create($this->notification(Session::get('notification')));
		return View::make('login.index');
	}

	/**
	* Logs in an user
	*
	* @access	public
	*/
	public function post_index() {
		$credentials = array(
			'username'	=> Input::get('username'),
			'password'	=> Input::get('password')
		);

		if (empty($credentials['username']) or empty($credentials['password'])) {
			return Redirect::to('login')->with('notification', 'required');
		}

		if (Auth::attempt($credentials)) {
			return Redirect::to('dashboard');
		} else {
			return Redirect::to('login')->with('notification', 'failed');
		}
	}

	/**
	* Logs out an user
	*
	* @access	public
	*/
	public function get_logout() {
		Auth::logout();

		return Redirect::to('login')->with('notification', 'logout');
	}

	/**
	* Resolves what notification to use
	*
	* @access	public
	*/
	private function notification($type) {
		switch($type) {
			case 'logout':
				return array(
					'message'	=> 'Ha cerrado sesión',
					'type'		=> 'info'
				);
			break;

			case 'failed':
				return array(
					'message'	=> 'Nombre de usuario o contraseña incorrectos',
					'type'		=> 'warning',
				);
			break;

			case 'required':
				return array(
					'message'	=> 'Todos los campos son requeridos',
					'type'		=> 'warning',
				);
			break;

			default:
				return false;
			break;
		}
	}
}
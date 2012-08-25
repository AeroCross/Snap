<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Init class.
*
* Handles some initialization processes.
*
* @package		SAV
* @subpackage	Libraries
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Init {

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		$this->app =& get_instance();
	}

	/**
	* Generates an unique login key.
	*
	* This identifies an user as "logged in" into the system.
	*
	* @param	object	- an object with all the user data
	* @return 	string	- the login key
	* @access	public
	*/
	public function generateLoginKey($userdata) {

		// no userdata passed - nothing to generate
		if (empty($userdata)) {
			return NULL;
		}

		// convert to an object if data is an array
		if (is_array($userdata)) {
			$userdata = (object) $userdata;
		}

		return hash('sha1', $userdata->firstname . '+' . $userdata->lastname . '+' . $userdata->username . '+' . $userdata->email);
	}

	/**
	* Checks if the current session is logged in.
	*
	* @return 	bool	- TRUE if logged in, FALSE otherwise
	* @access	public
	*/
	public function hasSession() {
		$username = $this->app->session->userdata('username');

		// no session because it was never created or was destroyed
		if (empty($username)) {
			return FALSE;
		}

		// there's a session, so let's check if there's a tempered session
		$this->app->load->model('sav_user');

		// the login key must match the one in the database and in the cookie
		$userdata	= $this->app->sav_user->data('firstname, lastname, username, email')->username($username)->get();
		$key		= $this->generateLoginKey($userdata);

		// check the login key
		if ($key === $this->app->session->userdata('key')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	* Initializes email settings.
	*
	* @access	public
	*/
	public function email() {
		$this->app->load->library('email');
		$this->app->load->model('sav_setting');
		
		// settings to fetch
		$settings = array(
			'smtp_host',
			'smtp_port',
			'smtp_user',
			'smtp_pass',
			'smtp_crypto',
		);
		
		$settings = $this->app->sav_setting->getSettings($settings);
		
		$email = array(
			'smtp_host'		=> $settings->smtp_host,
			'smtp_port'		=> $settings->smtp_port,
			'smtp_user'		=> $settings->smtp_user,
			'smtp_pass'		=> $settings->smtp_pass,
			'smtp_crypto'	=> $settings->smtp_crypto,
			'protocol'		=> 'smtp',
			'mailtype'		=> 'html',
			'crlf'			=> '\r\n',
			'newline'		=> '\r\n',
		);

		$this->app->email->initialize($email);
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Handles the log in and out of the system.
*
* @package		SAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Login extends SAV_Controller {
	public function __construct() {
		parent::__construct();

		// load the notification presenter
		$this->load->presenter('notification');
	}
	
	/**
	* Shows the login form.
	*
	* If there's a session, the method will redirect to where
	* the user should be.
	*
	* @access	public
	*/
	public function index() {
		$this->layout = 'login';

		// flashdata passed? display notification
		if ($this->session->flashdata('logout') != FALSE) {
			// regenerate the notification data
			$notification = unserialize($this->session->flashdata('notification'));

			// create the notification
			$this->presenter->notification->create($notification);

			// destroy the session
			$this->session->sess_destroy();
		}

		// tried to login? display results (if any)
		if ($this->input->post() != FALSE) {
			$this->presenter->notification->create($this->_login());
		}
	}

	/**
	* Logs in an user.
	*
	* This method uses $_POST data. $username and $password must
	* be provided so the user can be logged in.
	*
	* @access	private
	* @return	array	- a notification, if failed. Redirects if the user logs in
	*/
	private function _login() {
		$this->load->library('form_validation');

		// all fields required
		$this->form_validation->set_rules('username', 'Nombre de Usuario', 'required');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');

		if (!$this->form_validation->run()) {
			return array(
				'status'	=> 'required',
				'title'		=> 'Todos los campos son requeridos.',
				'message'	=> 'Intente nuevamente.',
				'type'		=> 'warning'
			);
		}

		// try to log in the user
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');

		$this->load->model('sav_user');

		// if the user doesn't exists, exit
		if ($this->sav_user->login($username, $password) === FALSE) {
			return array(
				'status'	=> 'login_failed',
				'title'		=> 'Usuario o contraseña incorrecto.',
				'message'	=> 'Intente nuevamente.',
				'type'		=> 'warning'
			);
		}

		// user found and password correct — login
		$userdata	= $this->sav_user->data()->username($username)->get();
		$name		= $userdata->firstname . ' ' . $userdata->lastname;
		$email		= $userdata->email;
		$key		= hash('sha1', $userdata->firstname . '+' . $userdata->lastname . '+' . $userdata->username . '+' . $userdata->email);
		
		$this->session->set_userdata('logged', $key);
		$this->session->set_userdata('name', $name);
		$this->session->set_userdata('email', $email);

		// redirect
		return array(
			'status'	=> 'logged_in',
			'title'		=> 'Sesión iniciada',
			'message'	=> 'como ' . $this->session->userdata('name') . ' (' . safe_mailto($this->session->userdata('email')) . ')',
			'type'		=> 'success'
		);
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
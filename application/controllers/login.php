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
	
	public function index() {
		$this->layout = 'login';

		if ($this->input->post() != FALSE) {
			$this->presenter->notification->create($this->_login());
		}
	}

	public function _login() {
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

		if ($this->sav_user->login($username, $password) === FALSE) {
			return array(
				'status'	=> 'login_failed',
				'title'		=> 'Usuario o contraseña incorrecto.',
				'message'	=> 'Intente nuevamente.',
				'type'		=> 'warning'
			);

		// logged in
		} else {
			return array(
				'status'	=> 'logged_in',
				'message'	=> 'Sesión iniciada.',
				'type'		=> 'success'
			);
		}
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
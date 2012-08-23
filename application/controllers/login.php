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
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
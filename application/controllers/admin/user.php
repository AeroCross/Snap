<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Handles the administrative part of users.
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class User extends EXT_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {

	}

	public function add() {
		$this->load->presenter('form');
		$this->data->title = 'Agregar Usuario';
	}

	public function companies() {
		$this->data->title = 'Compañías';
	}
}

/* End of file user.php */
/* Location: ./application/controllers/admin/user.php */
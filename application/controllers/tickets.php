<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Tickets controller.
*
* Handles the CRUD of the Tickets.
*
* @package		SAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Tickets extends SAV_Controller {
	
	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->add();
	}
	
 	/**
 	* Description.
 	*
 	* @access	public
 	*/
	public function add() {
		$this->view = 'files/tickets/add';
	}
}

/* End of file controller.php */
/* Location: ./application/controllers/controller.php */
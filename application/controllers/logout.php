<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Logout controller.
*
* Logs out the user of the system and destroys the session.
*
* @package		SAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Logout extends SAV_Controller {
	
	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}
	
 	/**
 	* Logs out the user.
 	*
 	* @access	public
 	*/
	public function index() {
		$notification = serialize(array(
			'status'	=> 'logged_out',
			'message'	=> 'Ha cerrado sesión.',
			'type'		=> 'info'
		));

		$this->session->set_flashdata('notification', $notification);
		$this->session->set_flashdata('logout', TRUE);

		// redirect to the proper controller
		redirect('login');
	}
}

/* End of file controller.php */
/* Location: ./application/controllers/controller.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Error controller.
*
* Shows error messages in the application.
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Error extends EXT_Controller {
	
	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
		
		// set the page title
		$this->data->title = 'Error';
	}
	
 	/**
 	* Shows the error.
 	* @param	flash	- the error message
 	* @access	public
 	*/
	public function index() {
		$message = $this->session->flashdata('message');

		// there must be a message to display
		if ($message == false) {
			redirect('dashboard');
		}

		$this->data->message = $message;
	}
}

/* End of file error.php */
/* Location: ./application/controllers/error.php */
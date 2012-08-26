<?php

/**
* Shows the informational website for the app.
*
* @package		SAV
* @subpackage	Controllers
*/
class Site extends SAV_Controller {

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();

		// set the site layout
		$this->layout = 'site';

		// set the title
		$this->data->title = 'Bienvenido';
	}

	/**
	* Displays the main site and the login form.
	*
	* @access	public
	*/
	public function index() {
		
	}
}

/* End of file site.php */
/* Location: ./application/controllers/site.php */
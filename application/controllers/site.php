<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Shows the informational website for the app.
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Site extends EXT_Controller {

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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Settings controller.
*
* Handles system settings.
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Settings extends EXT_Controller {
	
	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
		
		// set the page title
		$this->data->title = 'Configuración';

		// load required code
		$this->load->presenter('notification');

	}
	
 	/**
 	* Shows the main settings page.
 	*
 	* @access	public
 	*/
	public function index() {
		$this->load->model('saav_setting');

		$settings = array(
			'smtp_host',
			'smtp_port',
			'smtp_user',
			'smtp_pass',
			'smtp_crypto'
		);

		$this->data->settings = $this->saav_setting->getSettings($settings);
	}
}

/* End of file settings.php */
/* Location: ./application/controllers/settings.php */
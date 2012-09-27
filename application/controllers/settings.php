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
		$this->load->model('saav_setting');

		// all settings to load
		$this->settings = array(
			'smtp_host',
			'smtp_port',
			'smtp_user',
			'smtp_pass',
			'smtp_name',
			'smtp_crypto',
			'smtp_enabled',
			'per_page'
		);
	}
	
 	/**
 	* Shows the main settings page.
 	*
 	* @access	public
 	*/
	public function index() {

		if ($this->input->post() != FALSE) {
			$this->presenter->notification->create($this->_update(), 'toast');
		}

		$this->load->model('saav_setting');
		$this->data->settings = $this->saav_setting->getSettings($this->settings);
	}

	/**
	* Updates settings.
	*
	* @access	public
	*/
	public function _update() {
		$this->load->library('form_validation');
		foreach ($this->settings as $setting) {
			$this->form_validation->set_rules($setting, '', 'required');
		}

		if (!$this->form_validation->run()) {
			return array(
				'status'	=> 'required',
				'message'	=> 'Todos los campos son requeridos',
				'type'		=> 'warning'
			);
		}

		$settings = array(
			'smtp_host'		=> $this->input->post('smtp_host'),
			'smtp_port'		=> $this->input->post('smtp_port'),
			'smtp_user'		=> $this->input->post('smtp_user'),
			'smtp_pass'		=> $this->input->post('smtp_pass'),
			'smtp_name'		=> $this->input->post('smtp_name'),
			'smtp_crypto'	=> $this->input->post('smtp_crypto'),
			'smtp_enabled'	=> $this->input->post('smtp_enabled'),
			'per_page'		=> $this->input->post('per_page'),
		);

		foreach ($settings as $name => $value) {
			if (!$this->saav_setting->updateSetting($name, $value)) {
				return array(
					'status'	=> 'error',
					'message'	=> 'Error en la base de datos',
					'type'		=> 'error'
				);
			}
		}

		return array(
			'status'	=> 'success',
			'message'	=> 'Configuración actualizada',
			'type'		=> 'success'
		);
	}
}

/* End of file settings.php */
/* Location: ./application/controllers/settings.php */
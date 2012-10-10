<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Upgrades the database and application.
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Upgrade extends EXT_Controller {

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();

		// set the title
		$this->data->title = 'Actualización de la Base de Datos';

		// load necessary code
		$this->load->model('saav_user');

		// verify that only admins enter this area
		if (!$this->saav_user->permission('admin')) {
			redirect('dashboard');
		}
	}

	/**
	* Upgrades the database.
	*
	* @access	public
	*/
	public function index() {
		// load necessary code
		$this->load->library('migration');
		$this->config->load('migration');

		// get data
		$current	= $this->config->item('migration_version');
		$status		= $this->migration->current();

		// current
		if ($status === true) {
			$this->data->message = 'La base de datos se encuentra en la versión <strong>' . $current . '</strong>.';

		// successful
		} elseif(is_numeric($status)) {
			$this->data->message = 'La base de datos ha sido actualizada la versión <strong>' . $current . '</strong>.';
		
		// error
		} else {
			$this->data->message = 'Error al actualizar la base de datos a la versión <strong>' . $current . '</strong>.';
		}
	}
}

/* End of file upgrade.php */
/* Location: ./application/controllers/upgrade.php */
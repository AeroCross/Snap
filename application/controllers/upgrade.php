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
	}

	/**
	* Upgrades the database.
	*
	* @access	public
	*/
	public function index() {
		$this->load->library('migration');

		$this->config->load('migration');
		$current = $this->config->item('migration_version');

		// already at latest version
		if ($this->migration->current() === TRUE) {
			$this->data->message = 'La base de datos está actualizada en su última versión &mdash; número de versión: <strong>' . $current . '</strong>';

		// updated database
		} elseif (is_numeric($this->migration->current())) {
			$this->data->message = 'La base de datos ha sido actualizada a la versión ' . $current . '.';

		// error updating
		} else {
			$this->data->message = 'Error al actualizar la base de datos a la versión ' . $current . '.';
		}
	}
}

/* End of file update.php */
/* Location: ./application/controllers/update.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Handles the companies.
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Companies extends EXT_Controller {

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
		$this->load->model('saav_company');

		// check if the user's an admin
		if (!$this->saav_user->permission('admin')) {
			redirect('dashboard');
		}
	}

	/**
	* Shows the companies interface.
	*
	* @access	public
	*/
	public function index() {
		if ($this->input->post() != false) {
			$this->presenter->notification->create($this->_new(), 'toast');
		}

		$this->data->title = 'Administración » Compañías';
		$this->load->library('table');

		// companies table
		$companies = $this->saav_company->getCompanies();
		$this->table->set_heading('ID de Compañía', 'Nombre de la Compañía', 'Usuarios', 'Acciones');

		foreach ($companies as $company) {
			$users = $this->saav_company->getTotalMembers($company->id);
			$this->table->add_row($company->id, anchor('admin/company/edit/' . $company->id, $company->name), $users, '');
		}

		$this->data->companies = $this->table->generate();
	}

	/**
	* Adds a new company.
	*
	* @return	array	- a notification array
	* @access	private
	*/
	private function _new() {
		$name = $this->input->post('name');

		// required
		if (empty($name)) {
			return array(
				'status'	=> 'required',
				'message'	=> 'Nombre de compañía requerido',
				'type'		=> 'warning'
			);
		}

		// already in database
		if ($this->saav_company->match($name, 'name')) {
			return array(
				'status'	=> 'exists',
				'message'	=> 'Compañía ya existe en el sistema',
				'type'		=> 'warning'
			);
		}

		// data to insert
		$company = array('name' => $name);

		// couldn't insert
		if (!$this->saav_company->insert($company)) {
			return array(
				'status'	=> 'error',
				'message'	=> 'Error al agregar compañía',
				'type'		=> 'error'
			);
		} 

		// all good
		return array(
			'status'	=> 'success',
			'message'	=> 'Compañía agregada',
			'type'		=> 'success'
		);
	}
}

/* End of file companies.php */
/* Location: ./application/controllers/admin/companies.php */
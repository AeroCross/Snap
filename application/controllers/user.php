<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* User controller.
*
* Handles user profile and other user-related actions.
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class User extends EXT_Controller {
	
	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();

		// set the page title
		$this->data->title = 'Usuario';

		// load necessary code
		$this->load->model('saav_company');
	}
	
 	/**
 	* Shows the user profile.
 	*
 	* @access	public
 	*/
	public function profile() {
		// get current user information
		$id					= $this->session->userdata('id');
		$user				= $this->saav_user->data()->id($id)->get();
		$company			= $this->saav_company->getCompany($id);

		// pass it to the view
		$this->data->user		= $user;
		$this->data->company	= $company;

		// set the page title
		$this->data->title = 'Perfil de Usuario: ' . $user->firstname . ' ' . $user->lastname;
	}

	/**
	* Edits information about the user.
	*
	* @param	string	- the section to edit
	* @access	public
	*/
	public function edit($section = null) {
		switch ($section) {
			case 'password':
			case 'email':
				$this->view = 'files/user/edit/' . $section;
				$section = '_' . $section;
				
				// update
				if ($this->input->post() != false) {
					$this->presenter->notification->create($this->$section(), 'toast');	
				}

			break;

			// nothing selected, go to profile
			default: redirect('user/profile'); break;
		}
	}

	/**
	* Updates the password.
	*
	* @return	array	- a message for the notification presenter
	* @access	private
	*/
	private function _password() {
		$this->load->library('form_validation');

		$old		= $this->input->post('old');
		$new		= $this->input->post('new');
		$current	= $this->input->post('new');

		$this->form_validation->set_rules('old', 'Contraseña anterior', 'required');
		$this->form_validation->set_rules('new', 'Contraseña nueva', 'required');
		$this->form_validation->set_rules('confirm', 'Confirmación', 'required');

		if (!$this->form_validation->run()) {
			return array(
				'status'	=> 'required',
				'message'	=> 'Todos los campos son requeridos',
				'type'		=> 'warning'
			);
		}

		// new and confirm must match
		$this->form_validation->set_rules('confirm', 'Confirmación', 'matches[new]');

		if (!$this->form_validation->run()) {
			return array(
				'status'	=> 'new_not_matching',
				'message'	=> 'Las contraseñas no coinciden',
				'type'		=> 'warning'
			);
		}

		// the password must match
		if (!$this->saav_user->match(hash('sha256', $old), 'password')) {
			return array(
				'status'	=> 'old_not_matching',
				'message'	=> 'La contraseña anterior no coincide',
				'type'		=> 'warning'
			);
		}

		// all good — change password
		$where = array('id' => $this->session->userdata('id'));
		$update = array('password' => hash('sha256', $new));

		if ($this->saav_user->update($where, $update)) {
			return array(
				'status'	=> 'changed',
				'message'	=> 'Contraseña actualizada',
				'type'		=> 'success'
			);

		// something happened
		} else {
			return array(
				'status'	=> 'error',
				'message'	=> 'No se pudo cambiar su contraseña',
				'type'		=> 'error'
			);
		}
	}
}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */
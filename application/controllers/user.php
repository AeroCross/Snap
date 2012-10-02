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
			case 'picture':
				$this->view = 'files/user/edit/' . $section;
				$section = '_' . $section;
				
				// update
				if ($this->input->post() != false or isset($_FILES['file'])) {
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

	/**
	* Updates the email.
	*
	* @return	array	- a message for the notification presenter
	* @access	private
	*/
	private function _email() {
		$this->load->library('form_validation');
		
		$password	= $this->input->post('password');
		$new		= $this->input->post('new');
		$confirm	= $this->input->post('confirm');

		$this->form_validation->set_rules('password', 'Contraseña', 'required');
		$this->form_validation->set_rules('new', 'Nueva dirección', 'required');
		$this->form_validation->set_rules('confirm', 'Confirmación de dirección', 'required');

		if (!$this->form_validation->run()) {
			return array(
				'status'	=> 'required',
				'message'	=> 'Todos los campos son requeridos',
				'type'		=> 'warning'
			);
		}

		// emails must be valid
		$this->form_validation->set_rules('new', 'Nueva dirección', 'valid_email');

		if (!$this->form_validation->run()) {
			return array(
				'status'	=> 'new_invalid',
				'message'	=> 'La nueva dirección no es válida',
				'type'		=> 'warning'
			);
		}

		$this->form_validation->set_rules('confirm', 'Confirmación de dirección', 'valid_email');

		// emails must match
		$this->form_validation->set_rules('confirm', 'Confirmación de dirección', 'matches[new]');

		if (!$this->form_validation->run()) {
			return array(
				'status'	=> 'new_not_matching',
				'message'	=> 'Las direcciones no coinciden',
				'type'		=> 'warning'
			);
		}

		// password verification
		if (!$this->saav_user->match(hash('sha256', $password), 'password')) {
			return array(
				'status'	=> 'password',
				'message'	=> 'Contraseña incorrecta',
				'type'		=> 'warning'
			);
		}

		// all good — update
		$where	= array('id'	=> $this->session->userdata('id'));
		$update	= array('email'	=> $new);

		if ($this->saav_user->update($where, $update)) {
			// all good — clear data
			$this->form_validation->reset_validation();
			return array(
				'status'	=> 'success',
				'message'	=> 'Correo electrónico actualizado',
				'type'		=> 'success'
			);

		// something happened
		} else {
			return array(
				'status'	=> 'error',
				'message'	=> 'No se pudo cambiar su dirección de correo electrónico',
				'type'		=> 'error'
			);
		}
	}

	/**
	* Uploads a new user profile picture.
	*
	* @access	private
	*/
	private function _picture() {
		// the uploaded file
		$file = $_FILES['file'];

		// upload the file
		$this->load->library('file');
		$status = $this->file->upload('avatar', $this->session->userdata('id'), $file);

		// message returned by the file upload method
		if (isset($status['message'])) {
			return $status;

		// all good
		} else {
			return array(
				'status'	=> 'success',
				'message'	=> 'Imagen de perfil actualizada',
				'type'		=> 'success'
			);
		}
	}
}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */
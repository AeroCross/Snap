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

	public function edit($section = null) {
		switch ($section) {
			case 'password': $this->view = 'files/user/edit/password'; break;
			default: redirect('user/profile'); break;
		}
	}
}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */
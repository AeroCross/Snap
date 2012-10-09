<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Role presenter.
*
* Shows various role assignment widgets.
*
* @package		SAAV
* @subpackage	Presenters
* @author		Mario Cuba <mario@mariocuba.net>
*/
class RolePresenter {

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		$this->app = & get_instance();
		$this->app->load->model('saav_role_assignment');
		$this->app->load->model('saav_user');
	}

	/**
	* Returns a list of the support personel.
	*
	* @access	public
	*/
	public function support() {
		$roles = $this->app->saav_role_assignment->getRoleUsers('support');

		// no support assigned
		if (empty($roles)) {
			return '<p>No existe personal de soporte técnico asignado.</p>';
		}

		foreach ($roles as $role) {
			$user = $this->app->saav_user->data('id, firstname, lastname, email')->id($role->user_id)->get();
			$users[$user->id] = '<li>' . safe_mailto($user->email, $user->firstname . ' ' . $user->lastname) . '</li>';
		}

		return '<ul>' . implode('', $users) . '</ul>';
	}

	/**
	* Returns a list of the admins.
	*
	* @access	public
	*/
	public function admins() {
		$this->app->load->model('saav_company');
		$roles = $this->app->saav_role_assignment->getRoleUsers('admin');

		// if this does happen, then something is seriously wrong
		// starting at "how can you enter this view if you're not an admin?" issue
		if (empty($roles)) {
			return '<p>No existe personal administrativo asignado.</p>';
		}

		foreach ($roles as $role) {
			$user		= $this->app->saav_user->data('id, firstname, lastname, email')->id($role->user_id)->get();
			$users[$user->id] = array(
				'id'		=> $user->id,
				'name'		=> $user->firstname . ' ' . $user->lastname,
				'email'		=> $user->email,
				'company'	=> $this->app->saav_company->getCompany($user->id),
			); 
		}

		return (object) $users;
	}
}

/* End of file role.php */
/* Location: ./application/presenters/role.php */
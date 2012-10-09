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
}

/* End of file role.php */
/* Location: ./application/presenters/role.php */
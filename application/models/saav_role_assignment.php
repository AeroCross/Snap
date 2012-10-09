<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Role model.
*
* Handles the user roles.
*
* @package		SAAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/ 
class Saav_role_assignment extends EXT_Model {

	// the table used in the model
	public $_table = 'role_assignments';

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}

	public function getRoleUsers($role = null) {
		// if empty, get them all
		if (empty($role)) {
			return $this->db->select()->get($this->_table)->result();
		}

		// transform string to int
		switch ($role) {
			case 'client':	$role = 3; break;
			case 'support':	$role = 2; break;
			case 'admin':	$role = 1; break;
			default: $this->getRoleUsers(); break;
		}

		return $this->db->select()->where('role_id', $role)->get($this->_table)->result();
	}
}

/* End of file saav_role_assignments.php */
/* Location: ./application/models/saav_role_assignments.php */
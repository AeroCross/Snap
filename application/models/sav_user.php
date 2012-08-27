<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Users model.
*
* Handles user creation, modification, login, etc.
*
* @package		SAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/ 
class Sav_user extends SAV_Model {

	// the table used in the model
	public $_table = 'user';

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}
	
	/**
	* Tries to log in an user to the system.
	*
	* @access	public
	*/ 
	public function login($username, $password) {
		$this->cdb
		->select('username, password')
		->where('username', $username)
		->where('password', hash('sha256', $password));

		$sql = $this->cdb->get($this->_table);

		// does the user exists?
		if ($sql->num_rows() === 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	* Checks for the user's current role.
	*
	* @param	int		- the role to check (1 admin, 2 support, 3 user)
	* @return	bool	- TRUE if the paramater matches the role, FALSE if not, NULL if there's not a session
	* @access	public
	*/
	public function currentRole($role = NULL) {
		$current_user = $this->session->userdata('id');

		if (empty($current_user)) {
			return NULL;
		}

		switch ($role) {
			case 'admin': 	$role = 1; break;
			case 'support':	$role = 2; break;
			case 'user':	$role = 3; break;
			default:		return NULL; break;
		}

		$this->cdb->select('role_id')
		->where('user_id', $current_user)
		->where('role_id', $role);

		$sql = $this->cdb->get('role_assignment');

		if ($sql->num_rows() === 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file sav_user.php */
/* Location: ./application/models/sav_user.php */
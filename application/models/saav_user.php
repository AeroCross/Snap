<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Users model.
*
* Handles user creation, modification, login, etc.
*
* @package		SAAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/ 
class Saav_user extends EXT_Model {

	// the table used in the model
	public $_table = 'users';

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
	* @param	string	- the username to log in
	* @param	string	- the password
	* @return	bool	- TRUE if the credentials are correct, FALSE otherwise
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
	* Checks permissions of an user.
	*
	* This will allow the calculation of the role hierarchy - if an user is
	* a certain role, then all of the remaining roles can (or can't) do something.
	*
	* @param	string	- the role to check (admin, support, user)
	* @return	bool	- TRUE if the paramater matches the role, FALSE if not, NULL if there's not a session
	* @access	public
	*/
	public function permission($role = NULL) {
		$current_user = $this->session->userdata('id');

		if (empty($current_user)) {
			return NULL;
		}

		switch ($role) {
			case 'admin': 	$role = array(1); break;
			case 'support':	$role = array(1, 2); break;
			case 'user':	$role = array(1, 2, 3); break;
			default:		return NULL; break;
		}

		$this->cdb->select('role_id')
		->where('user_id', $current_user)
		->where_in('role_id', $role);
		

		$sql = $this->cdb->get('role_assignments');

		if ($sql->num_rows() === 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	* Fetches the names and id's of certain users.
	*
	* @internal	uses for the generation of options, mainly
	* @param	array	- an array with the roles to fetch
	* @return	object	- the data object with the names and id's
	* @access	public
	*/
	public function getNamesByRole($role = array(1,2)) {
		$this->cdb
		->select('CONCAT(users.firstname, " ", users.lastname) AS "name", users.id', FALSE)
		->join('role_assignments', 'role_assignments.user_id = users.id')
		->where_in('role_assignments.role_id', $role);

		return $this->cdb->get($this->_table)->result();
	}
}

/* End of file saav_user.php */
/* Location: ./application/models/saav_user.php */
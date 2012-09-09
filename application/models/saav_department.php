<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Department model.
*
* Handles the relations of users / departments.
*
* @package		SAAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/ 
class Saav_department extends EXT_Model {

	// the table used in the model
	public $_table = 'departments';

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}
	
	/**
	* Fetches a department.
	*
	* @param	int		- the department id
	* @return	object	- the data from the department
	* @access	public
	*/ 
	public function getDepartment($id) {
		$this->db->where('id', $id);

		return $this->db->get($this->_table)->row();
	}

	/**
	* Fetches all departments.
	*
	* @return	object	- the data from the department
	* @access	public
	*/ 
	public function getDepartments() {
		return $this->db->get($this->_table)->result();
	}

	/**
	* Fetches all department members from an specific department.
	*
	* @param	int		- the department id
	* @return	object	- the data from the members
	* @access	public
	*/ 
	public function getDepartmentMembers($department_id) {
		$this->db
		->select('users.id, users.firstname, users.lastname, users.email, users.username')
		->join('department_members', 'department_members.user_id = users.id')
		->where('department_members.department_id', $department_id);

		return $this->db->get('users')->result();
	}
}

/* End of file saav_department.php */
/* Location: ./application/models/saav_department.php */
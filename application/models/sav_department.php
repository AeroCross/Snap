<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Department model.
*
* Handles the relations of users / departments.
*
* @package		SAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/ 
class Sav_department extends SAV_Model {

	// the table used in the model
	public $_table = 'department';

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
		$this->cdb
		->select('*')
		->where('id', $id);

		return $this->cdb->get($this->_table)->row();
	}

	/**
	* Fetches all departments.
	*
	* @return	object	- the data from the department
	* @access	public
	*/ 
	public function getDepartments() {
		$this->cdb
		->select('*');

		return $this->cdb->get($this->_table)->result();
	}

	/**
	* Fetches all department members from an specific department.
	*
	* @param	int		- the department id
	* @return	object	- the data from the members
	* @access	public
	*/ 
	public function getDepartmentMembers($id) {
		$this->cdb
		->select('user.id, user.firstname, user.lastname, user.email, user.username')
		->from('user')
		->join('department_member', 'department_member.user_id = user.id')
		->where('department_member.department_id', $id);

		return $this->cdb->get()->result();
	}
}

/* End of file sav_department.php */
/* Location: ./application/models/sav_department.php */
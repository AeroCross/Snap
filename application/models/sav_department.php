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
		->where('id', $$id);

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
}

/* End of file model.php */
/* Location: ./application/models/model.php */
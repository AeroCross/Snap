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
class Saav_role extends EXT_Model {

	// the table used in the model
	public $_table = 'roles';

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}
	
	/**
	* Gets all the roles.
	*
	* @param	int		- a user id
	* @return	object	- the company of the user
	* @access	public
	*/ 
	public function getRoles() {
		return $this->db->select('*')->get($this->_table)->result();
	}
}

/* End of file saav_role.php */
/* Location: ./application/models/saav_role.php */
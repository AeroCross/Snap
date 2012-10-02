<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Company model.
*
* Handles the companies inside the application.
*
* @package		SAAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/ 
class Saav_company extends EXT_Model {

	// the table used in the model
	public $_table = 'companies';

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}
	
	/**
	* Gets the company of an user.
	*
	* @param	int		- a user id
	* @return	object	- the company of the user
	* @access	public
	*/ 
	public function getCompany($user_id) {
		$this->db->select('companies.name')
		->join('company_users', 'company_users.company_id = ' . $this->_table . '.id')
		->join('users', 'company_users.user_id = users.id')
		->where('users.id', $user_id);

		return $this->db->get($this->_table)->row();
	}

	/**
	* Fetches all the companies.
	*
	* @return	object	- all the companies
	* @access	public
	*/
	public function getCompanies() {
		return $this->db->get($this->_table)->result();
	}
}

/* End of file saav_company.php */
/* Location: ./application/models/saav_company.php */
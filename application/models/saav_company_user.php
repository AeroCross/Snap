<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Company user model.
*
* Handles the users inside a company.
*
* @package		SAAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/ 
class Saav_company_user extends EXT_Model {

	// the table used in the model
	public $_table = 'company_users';

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}

	/**
	* Selects all the user information from the users of an specific company,
	*
	* @param	int		- the company id
	* @return	object	- the user information
	* @access	public
	*/
	public function getCompanyUsers($company_id) {
		$this->db->select('users.*')
		->from('users')
		->join('company_users', 'users.id = company_users.user_id')
		->where('company_users.company_id', $company_id);

		return $this->db->get()->result();
	}
}

/* End of file saav_company.php */
/* Location: ./application/models/saav_company.php */
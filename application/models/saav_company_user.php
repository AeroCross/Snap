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
	
}

/* End of file saav_company.php */
/* Location: ./application/models/saav_company.php */
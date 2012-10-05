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
}

/* End of file saav_role_assignments.php */
/* Location: ./application/models/saav_role_assignments.php */
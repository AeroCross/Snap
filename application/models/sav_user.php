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
}

/* End of file model.php */
/* Location: ./application/models/model.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Ticket model.
*
* Handles ticket CRUD methods.
*
* @package		SAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/ 
class Sav_ticket extends SAV_Model {

	// the table used in the model
	public $_table = 'ticket';

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}

	/**
	* Adds a new ticket to the system.
	*
	* @param	array	- the subject, the content, and the department
	* @return	mixed	- result ID if successful, FALSE otherwise 
	* @access	public
	*/
	public function addTicket($data) {
		foreach ($data as $key => $d) {
			$this->cdb->set($key, $d);
		}

		$this->cdb->set('reported_by', $this->session->userdata('id'));
		$this->cdb->set('date_created', 'NOW()', FALSE);

		$this->cdb->insert($this->_table);

		// get the insert ID
		$id = $this->cdb->insert_id();
		
		if ($id > 0) {
			return $id;
		} else {
			return FALSE;
		}
	}
}

/* End of file model.php */
/* Location: ./application/models/model.php */
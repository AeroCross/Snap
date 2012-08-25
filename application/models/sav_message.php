<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Messages model.
*
* Handles the messages inside tickets and request threads.
*
* @package		SAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/ 
class Sav_message extends SAV_Model {

	// the table used in the model
	public $_table = 'message';

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}
	
	/**
	* Fetches all messages from a thread.
	*
	* @param	int		- the ticket id
	* @return	object	- all the messages
	* @access	public
	*/ 
	public function getMessages($ticket_id) {
		$this->cdb->select('*')
		->where('ticket_id', $ticket_id)
		->order_by('date', 'asc');

		return $this->cdb->get($this->_table)->result();
	}
}

/* End of file sav_message.php */
/* Location: ./application/models/sav_message.php */
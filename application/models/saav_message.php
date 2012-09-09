<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Messages model.
*
* Handles the messages inside tickets and request threads.
*
* @package		SAAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/ 
class Saav_message extends EXT_Model {

	// the table used in the model
	public $_table = 'messages';

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}

	/**
	* Fetches a messages from a thread.
	*
	* @param	int		- the message id
	* @return	object	- the message data
	* @access	public
	*/ 
	public function getMessage($message_id) {
		$this->db->where('id', $message_id);

		return $this->db->get($this->_table)->row();
	}	

	/**
	* Fetches all messages from a thread.
	*
	* @param	int		- the ticket id
	* @return	object	- all the messages
	* @access	public
	*/ 
	public function getMessages($ticket_id) {
		$this->db
		->where('ticket_id', $ticket_id)
		->order_by('date', 'asc');

		return $this->db->get($this->_table)->result();
	}

	/**
	* Add a new message to a ticket.
	*
	* @param	int		- the ticket id to update
	* @param	object	- the database object to process
	* @return	bool	- TRUE if the ticket was updated, FALSE otherwise
	* @access	public
	*/
	public function addMessage($ticket_id, $content) {

		$data = array(
			'user_id'	=> $this->session->userdata('id'),
			'ticket_id' => $ticket_id,
			'content'	=> $content,
		);

		$this->db->set($data);
		$this->db->set('date', 'NOW()', FALSE);

		// proceed with the insert
		$this->db->insert($this->_table);
		$id = $this->db->insert_id(); 
		if ($id > 0) {
			// correct status
			$this->saav_ticket->updateStatus($ticket_id, 'open');

			// correct modification date
			$date = $this->saav_message->getMessage($id)->date;
			$this->saav_ticket->updateModificationDate($ticket_id, $date);

			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file saav_message.php */
/* Location: ./application/models/saav_message.php */
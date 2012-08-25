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
	* Fetches a messages from a thread.
	*
	* @param	int		- the message id
	* @return	object	- the message data
	* @access	public
	*/ 
	public function getMessage($message_id) {
		$this->cdb->select('*')
		->where('id', $message_id);

		return $this->cdb->get($this->_table)->row();
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

	/**
	* Add a new message to a ticket.
	*
	* @access	public
	*/
	public function addMessage($ticket_id, $content, $status = 'open') {

		$data = array(
			'user_id'	=> $this->session->userdata('id'),
			'ticket_id' => $ticket_id,
			'content'	=> $content,
		);

		$this->cdb->set($data);
		$this->cdb->set('date', 'NOW()', FALSE);

		// proceed with the insert
		$this->cdb->insert($this->_table);
		$id = $this->cdb->insert_id(); 
		if ($id > 0) {
			// correct status
			$this->sav_ticket->updateStatus($ticket_id, $status);

			// correct modification date
			$date = $this->sav_message->getMessage($id)->date;
			$this->sav_ticket->updateModificationDate($ticket_id, $date);

			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file sav_message.php */
/* Location: ./application/models/sav_message.php */
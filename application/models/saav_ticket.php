<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Ticket model.
*
* Handles ticket CRUD methods.
*
* @package		SAAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/ 
class Saav_ticket extends EXT_Model {

	// the table used in the model
	public $_table = 'tickets';

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
			$this->db->set($key, $d);
		}

		$this->db->set('reported_by', $this->session->userdata('id'));
		$this->db->set('date_created', 'NOW()', FALSE);

		$this->db->insert($this->_table);

		// get the new ticket ID
		$id = $this->db->insert_id();
	
		// inserted? send an email to department members
		if ($id > 0) {
			$this->load->library('email');
			$this->load->model('saav_setting');
			$this->load->model('saav_department');

			$department = $data['department'];
			$content	= $data['content'];
			$subject	= $data['subject'];

			if (isset($data['assigned_to'])) {
				$assigned_to = $data['assigned_to'];
			}

			// get all department members to notify of new ticket
			$members = $this->saav_department->getDepartmentMembers($department);

			// assigned at creating time - notify
			if (isset($assigned_to)) {
				$this->load->library('email');
				$this->init->email();
				
				$assigned	= $this->saav_user->data('firstname, lastname, email')->id($assigned_to)->get();
				$user		= array(
					'assigner_email'	=> $this->session->userdata('email'),
					'assigner_name'		=> $this->session->userdata('name'),
					'ticket_id'			=> $id,
					'ticket_subject'	=> $subject,
					'ticket_content'	=> $content
				);

				$this->email->to($assigned->email);
				$this->email->from($this->saav_setting->getSetting('smtp_user'));
				$this->email->subject('Asignación de Ticket #' . $id . ': ' . $subject);
				$this->email->message($this->load->view('messages/tickets/assigned', $user, TRUE));

				unset($user);
				unset($assigned);
				@$this->email->send();
				$this->email->clear();

				// since we assigned someone, don't notify the whole department
				return $id;
			}

			// no members related to that department, leave returning ticket id
			if(empty($members)) {
				return $id;
			}

			// set the emails to send
			foreach($members as $member) {
				$emails[] = $member->email;
			}

			// set email preferences
			$smtp_user = $this->saav_setting->getSetting('smtp_user');
			$this->init->email();
			$this->email->from($smtp_user);
			$this->email->bcc($emails);
			$this->email->subject('Ticket #' . $id . ': ' . $subject);

			$message = array(
				'content'	=> nl2br($content),
				'ticket_id'	=> $id,
				'reported_by' => mailto($this->session->userdata('email'), $this->session->userdata('name'))
			);

			$this->email->message($this->load->view('messages/tickets/new', $message, TRUE));

			// @TODO: how do we check if this is actually sent?
			@$this->email->send();

			return $id;

		// no insertion
		} else {
			return FALSE;
		}
	}


	/**
	* Gets the information of a single ticket
	*
	* @param	int		- the ticket id
	* @return	object	- the ticket data 
	*/
	public function getTicket($id) {
		$this->db->where('id', $id);

		return $this->db->get($this->_table)->row();
	}

	/**
	* Fetches the latest $amount of tickets from $reported
	*
	* @param	int		- the amount of tickets to fetch
	* @param	int		- the id of the reporter
	* @return	object	- the data
	* @access	public
	*/
	public function getLatestTickets($amount = 5, $reported = NULL) {
		$this->db->select('id, subject, content, date_created, status, department');

		// not selecting from someone in specific
		if (!empty($reported)) {
			$this->db->where('reported_by', $reported);
		}

		// limit and order the results
		$this->db->limit($amount)->order_by('id', 'desc');

		return $this->db->get($this->_table)->result();
	}
	
	/**
	* Gets tickets for a company.
	*
	* @param	int		- the company id
	* @return	object	- the database object 
	*/
	public function getTicketsByCompany($company_id) {
		$this->db->select($this->_table . '.*')
		->join('company_users', 'company_users.user_id = ' . $this->_table . '.reported_by')
		->where('company_users.company_id', $company_id)
		->order_by($this->_table . '.date_created', 'desc');

		return $this;
	}

	/**
	* Updates the ticket information.
	*
	* @param	array	- the data used to update the ticket
	* @return	bool	- TRUE on update, FALSE otherwise
	* @access	public
	*/
	public function updateTicket($ticket_id, $data) {
		foreach ($data as $key => $d) {
			$this->db->set($key, $d);
		}

		$this->db->where('id', $ticket_id);

		return $this->db->update($this->_table);
	}

	/**
	* Updates the status of a ticket.
	*
	* @param	int		- the ticket id
	* @param	string	- the status (open or closed)
	* @return	object	- the result
	*/
	public function updateStatus($ticket_id, $status) {
		$this->db->set('status', $status)
		->where('id', $ticket_id);

		return $this->db->update($this->_table);
	}

	/**
	* Updates the modification date of a ticket.
	*
	* @param	int		- the ticket id
	* @param	string	- the date
	* @return	object	- the result
	*/
	public function updateModificationDate($ticket_id, $date) {
		$this->db->set('date_modified', $date)
		->where('id', $ticket_id);

		return $this->db->update($this->_table);
	}
}

/* End of file saav_ticket.php */
/* Location: ./application/models/saav_ticket.php */
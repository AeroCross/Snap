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
		
		// inserted? send an email to department members
		if ($id > 0) {
			$this->load->library('email');
			$this->load->model('sav_setting');
			$this->load->model('sav_department');

			// set variables of form
			$department = $data['department'];
			$content	= $data['content'];
			$subject	= $data['subject'];

			// fetches the info of all department members, to send emails
			$members = $this->sav_department->getDepartmentMembers($department);

			// no members related to that department, insert and leave returning ticket #
			if(empty($members)) {
				return $id;
			}

			// set the emails to send
			foreach($members as $member) {
				$emails[] = $member->email;
			}

			// initialize email preferences
			$this->init->email();

			// set email preferences
			$smtp_user = $this->sav_setting->getSetting('smtp_user');
			$this->email->to($smtp_user);
			$this->email->from($smtp_user);

			// actual message
			$this->email->bcc($emails);
			$this->email->subject('Ticket #' . $id . ': ' . $subject);
			$this->email->message($content);

			// all good - return ticket number
			if ($this->email->send()) {
				return $id;

			// couldn't send email
			} else {
				return FALSE;
			}

		// no insertion
		} else {
			return FALSE;
		}
	}

	public function getLatestTickets($amount = 5, $reported = NULL) {
		$this->cdb->select('id, subject, content, date_created, status, department');

		// not selecting from someone in specific
		if (!empty($reported)) {
			$this->cdb->where('reported_by', $reported);
		}

		// limit and order the results
		$this->cdb->limit($amount)->order_by('id', 'desc');

		return $this->cdb->get($this->_table)->result();
	}
}

/* End of file sav_ticket.php */
/* Location: ./application/models/sav_ticket.php */
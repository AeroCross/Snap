<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TicketPresenter {
	// prevent overloading
	private $app;

	/**
	* The class contructor.
	*
	* @access	public
	*/
	public function __construct() {
		$this->app =& get_instance();
	}

	/**
	* Shows the person assigned to a ticket.
	*
	* @param	int		- the id of the ticket
	* @return	string	- the name or link of the assigned person
	* @access	public
	*/
	public function showAssignedTo($ticket_id) {
		// load necessary code
		$this->app->load->model('saav_user');
		$this->app->load->model('saav_ticket');

		$assigned	= $this->app->saav_ticket->getTicket($ticket_id)->assigned_to;

		// if there's noone assigned, return nothing
		if (empty($assigned)) {
			return NULL;
		}

		$user = $this->app->saav_user->data('firstname, lastname, email')->id($assigned)->get();
		$data = $user->firstname . ' ' . $user->lastname;

		if ($this->app->saav_user->permission('support')) {
			$data = safe_mailto($user->email, $data);
		}

		return $data;
	}

	public function showFiles($ticket_id) {
		$path = FCPATH . 'files/tickets/' . $ticket_id . '/';

		if (!file_exists($path)) {
			return NULL;
		}

		$folders	= scandir($path);
		unset($folders[0]); // this directory
		unset($folders[1]); // top level directory
		$users		= $this->app->saav_user->data('id, firstname, lastname, email')->in('id', array(1,3))->getAll();
		dd($users);
	}
}

/* End of file ticket.php */
/* Location: ./application/presenters/ticket.php */
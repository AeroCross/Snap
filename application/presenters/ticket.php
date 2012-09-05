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
		$this->app->load->model('saav_user');
		$this->app->load->model('saav_ticket');

		$assigned	= $this->app->saav_ticket->getTicket($ticket_id)->assigned_to;
		$user		= $this->app->saav_user->data('firstname, lastname, email')->id($assigned)->get();

		$data = $user->firstname . ' ' . $user->lastname;

		if ($this->app->saav_user->permission('support')) {
			$data = safe_mailto($user->email, $data);
		}

		return $data;
	}
}

/* End of file ticket.php */
/* Location: ./application/presenters/ticket.php */